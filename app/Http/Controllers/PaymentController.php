<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Cache TTL for payment settings (in seconds)
     */
    private const PAYMENT_SETTINGS_CACHE_TTL = 60;

    /**
     * Get all payment settings from API (cached for 60 seconds)
     * Returns: isStripeLive, useStripeConnect, isStripeConnectLive
     */
    private function getPaymentSettings(): array
    {
        return Cache::remember('payment_settings', self::PAYMENT_SETTINGS_CACHE_TTL, function () {
            try {
                $response = Http::timeout(10)->get(config('services.firebase.cloud_functions_url') . '/getPaymentStatus');

                if ($response->ok()) {
                    $data = $response->json();
                    $settings = $data['data'] ?? [];

                    $result = [
                        'isStripeLive' => $settings['isStripeLive'] ?? false,
                        'useStripeConnect' => $settings['useStripeConnect'] ?? false,
                        'isStripeConnectLive' => $settings['isStripeConnectLive'] ?? false,
                    ];

                    Log::info('Payment settings fetched from API', $result);
                    return $result;
                }

                Log::warning('Failed to fetch payment settings from API, using defaults');
            } catch (\Throwable $e) {
                Log::error('Error fetching payment settings', ['error' => $e->getMessage()]);
            }

            // Default values on error (not cached - will retry next request)
            return [
                'isStripeLive' => false,
                'useStripeConnect' => false,
                'isStripeConnectLive' => false,
            ];
        });
    }

    /**
     * Get the Stripe live/test status from API
     * Fetches fresh data on every call
     */
    private function getStripeMode(): bool
    {
        return $this->getPaymentSettings()['isStripeLive'];
    }

    /**
     * Get the appropriate Stripe secret key based on live/test mode
     */
    private function getStripeSecretKey(): string
    {
        $isLive = $this->getStripeMode();
        return $isLive 
            ? config('services.stripe.live_secret') 
            : config('services.stripe.test_secret');
    }

    /**
     * Get the appropriate Stripe publishable key based on live/test mode
     */
    public function getStripePublishableKey(): string
    {
        $isLive = $this->getStripeMode();
        return $isLive 
            ? config('services.stripe.live_key') 
            : config('services.stripe.test_key');
    }

    /**
     * API endpoint to get Stripe configuration for frontend
     */
    public function getStripeConfig()
    {
        $settings = $this->getPaymentSettings();
        $publishableKey = $this->getStripePublishableKey();

        return response()->json([
            'success' => true,
            'isLive' => $settings['isStripeLive'],
            'useStripeConnect' => $settings['useStripeConnect'],
            'isStripeConnectLive' => $settings['isStripeConnectLive'],
            'publishableKey' => $publishableKey,
        ]);
    }

    /**
     * Call Firebase Cloud Function to create Stripe Connect Payment Intent
     * This handles commission calculation and destination charges
     *
     * @param array $params Payment parameters
     * @return array Response from Cloud Function
     */
    private function createStripeConnectPaymentIntent(array $params): array
    {
        $settings = $this->getPaymentSettings();

        $payload = [
            'amount' => $params['amountInCents'],
            'totalBookingAmount' => $params['totalAmountInCents'],
            'currency' => 'eur',
            'providerId' => $params['providerId'],
            'customerId' => $params['customerId'] ?? null,
            'customerEmail' => $params['customerEmail'],
            'customerName' => $params['customerName'] ?? null,
            'customerPhone' => $params['customerPhone'] ?? null,
            'bookingId' => $params['bookingId'] ?? null,
            'isStripeConnectLive' => $settings['isStripeConnectLive'],
        ];

        // Log sanitized payload (no PII)
        Log::info('Calling createStripeConnectPaymentIntent Cloud Function', [
            'amount' => $payload['amount'],
            'totalBookingAmount' => $payload['totalBookingAmount'],
            'providerId' => $payload['providerId'],
            'isStripeConnectLive' => $payload['isStripeConnectLive'],
        ]);

        try {
            // Get Firebase ID token for authentication
            $firebaseIdToken = session('firebase_id_token');

            $headers = ['Content-Type' => 'application/json'];
            if ($firebaseIdToken) {
                $headers['Authorization'] = 'Bearer ' . $firebaseIdToken;
            }

            $response = Http::timeout(30)
                ->withHeaders($headers)
                ->post(config('services.firebase.cloud_functions_url') . '/createStripeConnectPaymentIntent', $payload);

            if ($response->ok()) {
                $data = $response->json();
                if ($data['success'] ?? false) {
                    Log::info('Stripe Connect Payment Intent created', [
                        'paymentIntentId' => $data['data']['paymentIntentId'] ?? null,
                        'paymentMode' => $data['data']['paymentMode'] ?? null,
                    ]);
                    return [
                        'success' => true,
                        'data' => $data['data'],
                    ];
                } else {
                    Log::error('Stripe Connect Payment Intent failed', ['response' => $data]);
                    return [
                        'success' => false,
                        'error' => $data['error'] ?? $data['message'] ?? 'Unknown error',
                    ];
                }
            }

            Log::error('Stripe Connect Cloud Function HTTP error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return [
                'success' => false,
                'error' => 'Cloud Function returned status ' . $response->status(),
            ];
        } catch (\Throwable $e) {
            Log::error('Stripe Connect Cloud Function exception', ['error' => $e->getMessage()]);
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function createCheckoutSession(Request $request)
    {
        // Log the request for debugging (sanitized - no PII)
        Log::info('Stripe checkout request', [
            'serviceId' => $request->input('serviceId'),
            'serviceProviderId' => $request->input('serviceProviderId'),
            'paymentType' => $request->input('paymentType'),
        ]);
        
        // Get data from request
        $serviceId = $request->input('serviceId');
        $serviceProviderId = $request->input('serviceProviderId');
        $serviceName = $request->input('serviceName');
        $servicePrice = (float) $request->input('servicePrice');
        $paymentType = $request->input('paymentType'); // 'deposit' or 'full'
        $formData = $request->input('formData');
        $bookingData = $request->input('bookingData');
        
        // Get deposit percentage from request or calculate from service data
        $depositPercentage = $request->input('depositPercentage');
        $serviceData = $request->input('serviceData');
        
        // If depositPercentage is not provided, calculate it from service data
        if ($depositPercentage === null && $serviceData) {
            $spDeposit = $serviceData['spDeposit'] ?? 0;
            $commission = $serviceData['commission'] ?? [];
            $minimumBookingPercentage = $commission['minimum_booking_percentage'] ?? 0;
            $commissionValue = $commission['commission'] ?? 0;
            
            if ($spDeposit > 0) {
                $depositPercentage = $spDeposit;
            } elseif ($minimumBookingPercentage > 0) {
                $depositPercentage = $minimumBookingPercentage;
            } elseif ($commissionValue > 0) {
                $depositPercentage = $commissionValue;
            } else {
                $depositPercentage = 0;
            }
        }
        
        // If still not available, try to fetch service data from API
        if ($depositPercentage === null && $serviceId) {
            try {
                $response = Http::get(config('services.firebase.cloud_functions_url') . '/getServiceById', [
                    'service_id' => $serviceId,
                ]);
                
                if ($response->ok()) {
                    $json = $response->json();
                    $service = $json['service'] ?? null;
                    
                    if ($service) {
                        $spDeposit = $service['spDeposit'] ?? 0;
                        $commission = $service['commission'] ?? [];
                        $minimumBookingPercentage = $commission['minimum_booking_percentage'] ?? 0;
                        $commissionValue = $commission['commission'] ?? 0;
                        
                        if ($spDeposit > 0) {
                            $depositPercentage = $spDeposit;
                        } elseif ($minimumBookingPercentage > 0) {
                            $depositPercentage = $minimumBookingPercentage;
                        } elseif ($commissionValue > 0) {
                            $depositPercentage = $commissionValue;
                        } else {
                            $depositPercentage = 0;
                        }
                    }
                }
            } catch (\Throwable $e) {
                Log::warning('Failed to fetch service data for deposit calculation', ['error' => $e->getMessage()]);
                // Fallback to 0 if we can't fetch
                $depositPercentage = 0;
            }
        }
        
        // Default to 0 if still not set
        $depositPercentage = $depositPercentage ?? 0;

        // Calculate the payment amount based on payment type
        if ($paymentType === 'deposit') {
            if ($depositPercentage > 0) {
                $amount = $servicePrice * ($depositPercentage / 100);
            } else {
                // Free booking - set amount to 0 (but Stripe requires minimum 50 cents)
                $amount = 0;
            }
        } else {
            $amount = $servicePrice;
        }
        
        $amountInCents = (int) ($amount * 100); // Stripe requires amounts in cents
        $totalAmountInCents = (int) ($servicePrice * 100); // Total booking amount for commission calculation

        // Check if Stripe Connect is enabled
        $settings = $this->getPaymentSettings();
        $useStripeConnect = $settings['useStripeConnect'] ?? false;

        // Log the amount being charged
        Log::info('Creating payment', [
            'amount' => $amount,
            'amountInCents' => $amountInCents,
            'totalAmountInCents' => $totalAmountInCents,
            'paymentType' => $paymentType,
            'serviceName' => $serviceName,
            'useStripeConnect' => $useStripeConnect,
        ]);

        try {
            // ========================================
            // STRIPE CONNECT FLOW
            // ========================================
            if ($useStripeConnect) {
                // Extract customer info from bookingData or formData
                $bookingDataArray = is_string($bookingData) ? json_decode($bookingData, true) : $bookingData;
                $formDataArray = is_string($formData) ? json_decode($formData, true) : $formData;

                $userInfo = $bookingDataArray['userInfo'] ?? [];
                $customerEmail = $userInfo['email'] ?? $formDataArray['email'] ?? session('firebase_email');
                $customerName = $userInfo['name'] ?? $formDataArray['name'] ?? null;
                $customerPhone = $userInfo['phone'] ?? $formDataArray['phone'] ?? null;
                $customerId = $userInfo['userId'] ?? $bookingDataArray['userId'] ?? session('firebase_uid');

                if (empty($customerEmail)) {
                    Log::error('Stripe Connect requires customer email');
                    return response()->json(['error' => 'Customer email is required for payment'], 400);
                }

                // Call Firebase Cloud Function for Stripe Connect payment
                $connectResult = $this->createStripeConnectPaymentIntent([
                    'amountInCents' => max(50, $amountInCents), // Minimum 50 cents
                    'totalAmountInCents' => $totalAmountInCents,
                    'providerId' => $serviceProviderId,
                    'customerId' => $customerId,
                    'customerEmail' => $customerEmail,
                    'customerName' => $customerName,
                    'customerPhone' => $customerPhone,
                ]);

                if (!$connectResult['success']) {
                    Log::error('Stripe Connect payment intent creation failed', ['error' => $connectResult['error']]);
                    return response()->json(['error' => $connectResult['error']], 500);
                }

                $connectData = $connectResult['data'];

                // Store booking data in session for later retrieval
                $pendingBookingData = [
                    'bookingData' => $bookingData,
                    'formData' => $formData,
                    'serviceProviderId' => $serviceProviderId,
                    'paymentType' => $paymentType,
                    'serviceName' => $serviceName,
                    'serviceId' => $serviceId,
                    'servicePrice' => $servicePrice,
                    'useStripeConnect' => true,
                    'paymentMode' => $connectData['paymentMode'] ?? 'stripe_connect',
                ];
                session(['pending_booking_' . $connectData['paymentIntentId'] => $pendingBookingData]);

                Log::info('Stripe Connect payment intent created', [
                    'paymentIntentId' => $connectData['paymentIntentId'],
                    'paymentMode' => $connectData['paymentMode'] ?? 'stripe_connect',
                ]);

                // Return data for frontend Payment Element
                return response()->json([
                    'id' => $connectData['paymentIntentId'],
                    'clientSecret' => $connectData['clientSecret'],
                    'useStripeConnect' => true,
                    'paymentMode' => $connectData['paymentMode'] ?? 'stripe_connect',
                    'applicationFee' => $connectData['applicationFee'] ?? 0,
                    'feeType' => $connectData['feeType'] ?? null,
                    'providerReceives' => $connectData['providerReceives'] ?? 0,
                ]);
            }

            // ========================================
            // STANDARD STRIPE CHECKOUT FLOW
            // ========================================
            $stripeSecretKey = $this->getStripeSecretKey();
            Stripe::setApiKey($stripeSecretKey);

            // Generate success URL
            $successUrl = route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}';
            $successParams = [
                'serviceId' => $serviceId,
                'serviceProviderId' => $serviceProviderId,
                'paymentType' => $paymentType,
            ];
            $fullSuccessUrl = $successUrl . '&' . http_build_query($successParams);
            $cancelUrl = route('book-appointment', ['serviceId' => $serviceId]);

            // Create session with proper format for v7.0
            $sessionParams = [
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'name' => $serviceName ?: 'Beauty Service',
                        'description' => ($paymentType === 'deposit')
                            ? ($depositPercentage > 0 ? $depositPercentage . '% Deposit' : 'Free Booking')
                            : 'Full Payment',
                        'amount' => max(50, $amountInCents), // Minimum 50 cents
                        'currency' => 'eur',
                        'quantity' => 1,
                    ]
                ],
                'success_url' => $fullSuccessUrl,
                'cancel_url' => $cancelUrl,
            ];

            Log::info('Session params', $sessionParams);

            $session = Session::create($sessionParams);

            // Store booking data in session to retrieve after payment success
            $pendingBookingData = [
                'bookingData' => $bookingData,
                'formData' => $formData,
                'serviceProviderId' => $serviceProviderId,
                'paymentType' => $paymentType,
                'serviceName' => $serviceName,
                'serviceId' => $serviceId,
                'servicePrice' => $servicePrice,
                'useStripeConnect' => false,
            ];
            session(['pending_booking_' . $session->id => $pendingBookingData]);

            // Return the session ID
            Log::info('Stripe session created', ['id' => $session->id]);
            return response()->json(['id' => $session->id]);

        } catch (\Exception $e) {
            Log::error('Payment creation failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function handlePaymentSuccess(Request $request)
    {
        // Set Stripe API key dynamically based on payment status API
        $stripeSecretKey = $this->getStripeSecretKey();
        Stripe::setApiKey($stripeSecretKey);

        // Log request data
        Log::info('Payment success callback received', $request->all());

        // Support both Stripe Checkout (session_id) and Stripe Connect (payment_intent_id)
        $sessionId = $request->get('session_id');
        $paymentIntentIdParam = $request->get('payment_intent_id');
        $serviceId = $request->get('serviceId');
        $serviceProviderId = $request->get('serviceProviderId');
        $paymentType = $request->get('paymentType');

        // These might not be present if we're using the simplified flow
        $formData = $request->has('formData') ? json_decode($request->get('formData'), true) : [];
        $bookingData = $request->has('bookingData') ? json_decode($request->get('bookingData'), true) : [];

        try {
            // Determine which identifier we have
            $isStripeConnect = !empty($paymentIntentIdParam) && empty($sessionId);
            $identifier = $isStripeConnect ? $paymentIntentIdParam : $sessionId;

            if (empty($identifier)) {
                throw new \Exception('Payment identifier is missing (session_id or payment_intent_id required).');
            }

            // Check if this is a free booking (identifier starts with "free-booking")
            $isFreeBooking = strpos($identifier, 'free-booking') === 0;

            if ($isFreeBooking) {
                // For free bookings, skip Stripe retrieval
                Log::info('Free booking detected, skipping Stripe retrieval', ['identifier' => $identifier]);
                $paymentIntentId = $identifier;
            } elseif ($isStripeConnect) {
                // Stripe Connect flow - we already have the payment intent ID
                Log::info('Stripe Connect payment success', ['paymentIntentId' => $paymentIntentIdParam]);
                $paymentIntentId = $paymentIntentIdParam;
            } else {
                // Standard Stripe Checkout flow - retrieve session
                Log::info('Retrieving Stripe session', ['sessionId' => $sessionId]);
                $session = Session::retrieve($sessionId);

                if (!is_object($session)) {
                    throw new \Exception('Failed to retrieve a valid session object');
                }

                Log::info('Session retrieved', ['sessionId' => $session->id]);

                // Use safe property access for Stripe v7.0 compatibility
                $paymentIntentId = $sessionId; // Default to session ID

                // Try to get payment_intent if it exists
                if (isset($session->payment_intent)) {
                    $paymentIntentId = $session->payment_intent;
                }
            }

            Log::info('Payment ID', ['paymentIntentId' => $paymentIntentId, 'isStripeConnect' => $isStripeConnect]);

            // Retrieve booking data from session (key is based on the identifier)
            $sessionKey = 'pending_booking_' . $identifier;
            $pendingBooking = session($sessionKey);
            
            if ($pendingBooking) {
                // We have booking data from the session - finalize server-side
                Log::info('Found pending booking in session', ['sessionKey' => $sessionKey]);
                
                $bookingPayload = $pendingBooking['bookingData'];
                if (is_string($bookingPayload)) {
                    $bookingPayload = json_decode($bookingPayload, true);
                }
                
                // Update payload with payment info
                $bookingPayload['payment_id'] = $paymentIntentId;
                $bookingPayload['payment_type'] = $pendingBooking['paymentType'] ?? 'full';
                $bookingPayload['payment_status'] = 'completed';
                $bookingPayload['payed'] = ($bookingPayload['payment_type'] === 'full');
                
                // Call bookService Cloud Function
                Log::info('Submitting booking to Cloud Function', ['payload_keys' => array_keys($bookingPayload ?? [])]);
                $bookResponse = Http::post(config('services.firebase.cloud_functions_url') . '/bookService', $bookingPayload);
                
                if ($bookResponse->ok()) {
                    Log::info('Booking created successfully');
                    
                    // Send emails
                    $this->sendBookingEmails($bookingPayload, $pendingBooking);
                    
                    // Clear session data
                    session()->forget($sessionKey);
                    
                    // Redirect to My Bookings
                    return redirect()->route('my-bookings');
                } else {
                    Log::error('Booking API failed', ['response' => $bookResponse->body()]);
                    // Still redirect to my-bookings even if there was an issue
                    session()->forget($sessionKey);
                    return redirect()->route('my-bookings');
                }
            } else {
                // No session data - fallback to success page (for backwards compatibility)
                Log::warning('No pending booking data found in session', ['sessionKey' => $sessionKey]);
                return view('bookAppointment.success', [
                    'transactionId' => $paymentIntentId,
                    'serviceName' => 'Beauty Service',
                    'paymentType' => $paymentType ?? 'full',
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error in payment success handler', ['error' => $e->getMessage()]);
            return view('bookAppointment.error', [
                'message' => 'Error processing payment: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Send booking confirmation emails
     */
    private function sendBookingEmails($payload, $pendingBooking)
    {
        try {
            $lang = app()->getLocale();
            $userInfo = $payload['userInfo'] ?? [];
            $serviceInfo = $payload['services'][0] ?? [];
            $serviceData = $payload['serviceData'] ?? [];
            $serviceProviderInfo = $payload['serviceProviderInfo'] ?? [];
            
            $clientEmail = $userInfo['email'] ?? null;
            $ownerEmail = $serviceProviderInfo['email'] ?? $serviceData['ownerMail'] ?? null;
            
            // Parse booking date/time
            $bookingTime = $payload['booking_time'] ?? null;
            $bookTime = $payload['bookTime'] ?? null;
            $bookingDate = $this->parseBookingDate($bookingTime);
            $parsedTime = $bookTime ?: $this->parseBookingTime($bookingTime);
            
            // Prepare address and map link
            $address = $payload['address'] ?? $serviceData['companyAddress'] ?? '';
            $spLocation = $serviceData['spLocation'] ?? [];
            $lat = $spLocation['geometry']['location']['lat'] ?? null;
            $lng = $spLocation['geometry']['location']['lng'] ?? null;
            $mapLink = '';
            if ($lat && $lng) {
                $mapLink = "https://www.google.com/maps/dir/?api=1&destination={$lat},{$lng}&travelmode=transit";
            } elseif ($address) {
                $mapLink = "https://www.google.com/maps/dir/?api=1&destination=" . urlencode($address) . "&travelmode=transit";
            }
            
            // Customer email
            if ($clientEmail && $bookingDate && $parsedTime) {
                Http::post('https://backend.glaura.ai/api/send-email', [
                    'to' => $clientEmail,
                    'type' => 'bookingCreated',
                    'lang' => $lang,
                    'data' => [
                        'clientName' => $userInfo['name'] ?? 'Customer',
                        'serviceName' => $serviceInfo['serviceName'] ?? $pendingBooking['serviceName'] ?? '',
                        'salonName' => $serviceData['companyName'] ?? '',
                        'date' => $bookingDate,
                        'time' => $parsedTime,
                        'address' => $address,
                        'mapLink' => $mapLink
                    ]
                ]);
            }
            
            // Provider email
            if ($ownerEmail && $bookingDate && $parsedTime) {
                $amount = $serviceInfo['servicePrice'] ?? $payload['amount'] ?? 0;
                Http::post('https://backend.glaura.ai/api/send-email', [
                    'to' => $ownerEmail,
                    'type' => 'providerNewBookingReceived',
                    'lang' => $lang,
                    'data' => [
                        'proName' => $serviceProviderInfo['name'] ?? $serviceData['ownerName'] ?? '',
                        'clientName' => $userInfo['name'] ?? 'Customer',
                        'serviceName' => $serviceInfo['serviceName'] ?? $pendingBooking['serviceName'] ?? '',
                        'date' => $bookingDate,
                        'time' => $parsedTime,
                        'bookingAmount' => '€' . number_format($amount, 2)
                    ]
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error sending booking emails', ['error' => $e->getMessage()]);
        }
    }
    
    private function parseBookingDate($bookingTimeString)
    {
        if (!$bookingTimeString) return null;
        try {
            $parts = explode(' at ', $bookingTimeString);
            if (count($parts) < 1) return null;
            $date = strtotime($parts[0]);
            return $date ? date('Y-m-d', $date) : null;
        } catch (\Exception $e) {
            return null;
        }
    }
    
    private function parseBookingTime($bookingTimeString)
    {
        if (!$bookingTimeString) return null;
        try {
            $parts = explode(' at ', $bookingTimeString);
            if (count($parts) < 2) return null;
            $time = strtotime($parts[1]);
            return $time ? date('H:i', $time) : null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
