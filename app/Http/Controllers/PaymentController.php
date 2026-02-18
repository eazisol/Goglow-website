<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use App\Services\PaymentSettingsService;

class PaymentController extends Controller
{
    /**
     * Get the appropriate Stripe secret key based on mode and Stripe Connect settings
     */
    private function getStripeSecretKey(): string
    {
        $settings = PaymentSettingsService::get();

        return $settings['isStripeConnectLive']
            ? config('services.stripe.live_connect_secret')
            : config('services.stripe.test_connect_secret');

    }

    /**
     * Get the appropriate Stripe publishable key based on mode and Stripe Connect settings
     */
    public function getStripePublishableKey(): string
    {
        $settings = PaymentSettingsService::get();

        return $settings['isStripeConnectLive']
        ? config('services.stripe.live_connect_key')
            : config('services.stripe.test_connect_key');
    }

    /**
     * API endpoint to get Stripe configuration for frontend
     */
    public function getStripeConfig()
    {
        // Clear any output buffer to ensure clean JSON response
        if (ob_get_level()) {
            ob_clean();
        }

        $settings = PaymentSettingsService::get();
        $publishableKey = $this->getStripePublishableKey();

        return response()->json([
            'success' => true,
            'isLive' => $settings['isStripeConnectLive'],
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
        $settings = PaymentSettingsService::get();

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
            'isStripeLive' => $settings['isStripeConnectLive'],
            'idempotencyKey' => $params['idempotencyKey'] ?? \Illuminate\Support\Str::uuid()->toString(),
            // Use Stripe Checkout instead of Payment Element
            'useCheckout' => $params['useCheckout'] ?? true,
            'successUrl' => $params['successUrl'] ?? null,
            'cancelUrl' => $params['cancelUrl'] ?? null,
            'serviceName' => $params['serviceName'] ?? null,
            'providerName' => $params['providerName'] ?? null,
            'locale' => $params['locale'] ?? app()->getLocale(),
        ];

        // Log sanitized payload (no PII)
        Log::info('Calling createStripeConnectPaymentIntent Cloud Function', [
            'amount' => $payload['amount'],
            'totalBookingAmount' => $payload['totalBookingAmount'],
            'providerId' => $payload['providerId'],
            'isStripeLive' => $payload['isStripeLive'],
            'useCheckout' => $payload['useCheckout'],
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
                    $responseData = $data['data'];
                    $isCheckout = $responseData['useCheckout'] ?? false;

                    Log::info('Stripe Connect payment created', [
                        'sessionId' => $responseData['sessionId'] ?? null,
                        'paymentIntentId' => $responseData['paymentIntentId'] ?? null,
                        'paymentMode' => $responseData['paymentMode'] ?? null,
                        'useCheckout' => $isCheckout,
                    ]);
                    return [
                        'success' => true,
                        'data' => $responseData,
                    ];
                } else {
                    Log::error('Stripe Connect payment creation failed', ['response' => $data]);
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
                'httpStatus' => $response->status(), // Pass through for auth error detection
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
        // Clear any output buffer to ensure clean JSON response (prevents PHP warnings from corrupting JSON)
        if (ob_get_level()) {
            ob_clean();
        }

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

        // Log the amount being charged
        Log::info('Creating payment', [
            'amount' => $amount,
            'amountInCents' => $amountInCents,
            'totalAmountInCents' => $totalAmountInCents,
            'paymentType' => $paymentType,
            'serviceName' => $serviceName,
        ]);

        try {
            // Extract customer info from bookingData or formData
                $bookingDataArray = is_string($bookingData) ? json_decode($bookingData, true) : $bookingData;
                $formDataArray = is_string($formData) ? json_decode($formData, true) : $formData;

                $userInfo = $bookingDataArray['userInfo'] ?? [];
                $customerEmail = $userInfo['email'] ?? $formDataArray['email'] ?? session('firebase_email');
                $customerName = $userInfo['name'] ?? $formDataArray['name'] ?? null;
                $customerPhone = $userInfo['phone'] ?? $formDataArray['phone'] ?? null;
                $customerId = $userInfo['userId'] ?? $bookingDataArray['userId'] ?? session('firebase_uid');

                if (empty($customerEmail) && empty($customerPhone)) {
                    Log::error('Stripe Connect requires customer email or phone');
                    return response()->json(['error' => 'Customer email or phone is required for payment'], 400);
                }

                // Build success/cancel URLs for Checkout
                $successUrl = route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}';
                $successParams = [
                    'serviceId' => $serviceId,
                    'serviceProviderId' => $serviceProviderId,
                    'paymentType' => $paymentType,
                    'stripeConnect' => '1', // Flag to indicate Stripe Connect payment
                ];
                $fullSuccessUrl = $successUrl . '&' . http_build_query($successParams);
                $cancelUrl = route('book-appointment', ['serviceId' => $serviceId]);

                // Get provider name for better checkout description
                $providerNameForCheckout = $bookingDataArray['salonName'] ?? $bookingDataArray['providerName'] ?? null;

                // Call Firebase Cloud Function for Stripe Connect payment (using Checkout)
                $connectResult = $this->createStripeConnectPaymentIntent([
                    'amountInCents' => max(50, $amountInCents), // Minimum 50 cents
                    'totalAmountInCents' => $totalAmountInCents,
                    'providerId' => $serviceProviderId,
                    'customerId' => $customerId,
                    'customerEmail' => $customerEmail,
                    'customerName' => $customerName,
                    'customerPhone' => $customerPhone,
                    'idempotencyKey' => $request->input('idempotencyKey'),
                    // Checkout-specific parameters
                    'useCheckout' => true,
                    'successUrl' => $fullSuccessUrl,
                    'cancelUrl' => $cancelUrl,
                    'serviceName' => $serviceName,
                    'providerName' => $providerNameForCheckout,
                ]);

                if (!$connectResult['success']) {
                    Log::error('Stripe Connect checkout creation failed', ['error' => $connectResult['error']]);
                    // Return 401 if Cloud Function returned auth error (token expired)
                    $httpStatus = $connectResult['httpStatus'] ?? 500;
                    if ($httpStatus === 401 || $httpStatus === 403) {
                        return response()->json(['error' => 'Authentication expired. Please refresh and try again.'], 401);
                    }
                    return response()->json(['error' => $connectResult['error']], 500);
                }

                $connectData = $connectResult['data'];
                $sessionId = $connectData['sessionId'];

                // Store booking data in session for later retrieval (using sessionId)
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
                session(['pending_booking_' . $sessionId => $pendingBookingData]);

                Log::info('Stripe Connect checkout session created', [
                    'sessionId' => $sessionId,
                    'paymentMode' => $connectData['paymentMode'] ?? 'stripe_connect',
                ]);

            // Return session ID for redirect
            return response()->json([
                'id' => $sessionId,
                'paymentMode' => $connectData['paymentMode'] ?? 'stripe_connect',
            ]);

        } catch (\Exception $e) {
            Log::error('Payment creation failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function handlePaymentSuccess(Request $request)
    {
        // Clear any output buffer to ensure clean JSON response
        if (ob_get_level()) {
            ob_clean();
        }

        // Log request data
        Log::info('Payment success callback received', $request->all());

        // Support both Stripe Checkout (session_id) and Stripe Connect (payment_intent or payment_intent_id)
        $sessionId = $request->get('session_id');
        $paymentIntentIdParam = $request->get('payment_intent') ?? $request->get('payment_intent_id');
        $serviceId = $request->get('serviceId');
        $serviceProviderId = $request->get('serviceProviderId');
        $paymentType = $request->get('paymentType');

        // Set Stripe API key (always use Connect keys)
        $stripeSecretKey = $this->getStripeSecretKey();

        Log::info('Setting Stripe API key', [
            'keyPresent' => !empty($stripeSecretKey),
        ]);

        Stripe::setApiKey($stripeSecretKey);

        // These might not be present if we're using the simplified flow
        $formData = $request->has('formData') ? json_decode($request->get('formData'), true) : [];
        $bookingData = $request->has('bookingData') ? json_decode($request->get('bookingData'), true) : [];

        try {
            // Use session_id as identifier (Connect flow uses Checkout sessions)
            $identifier = $sessionId ?? $paymentIntentIdParam;

            if (empty($identifier)) {
                throw new \Exception('Payment identifier is missing (session_id or payment_intent_id required).');
            }

            // Check if this is a free booking (identifier starts with "free-booking")
            $isFreeBooking = strpos($identifier, 'free-booking') === 0;

            if ($isFreeBooking) {
                // For free bookings, skip Stripe retrieval
                Log::info('Free booking detected, skipping Stripe retrieval', ['identifier' => $identifier]);
                $paymentIntentId = $identifier;
            } else {
                // For both Stripe Connect and standard Checkout, retrieve session to get payment_intent
                $checkoutSessionId = $sessionId;

                // If we have a session_id (Checkout flow), retrieve the session
                if ($checkoutSessionId && str_starts_with($checkoutSessionId, 'cs_')) {
                    Log::info('Retrieving Stripe Checkout session', ['sessionId' => $checkoutSessionId]);
                    $session = Session::retrieve($checkoutSessionId);

                    if (!is_object($session)) {
                        throw new \Exception('Failed to retrieve a valid session object');
                    }

                    Log::info('Session retrieved', [
                        'sessionId' => $session->id,
                        'payment_intent' => $session->payment_intent ?? null,
                    ]);

                    // Get payment_intent from session
                    $paymentIntentId = $session->payment_intent ?? null;
                } elseif ($paymentIntentIdParam && str_starts_with($paymentIntentIdParam, 'pi_')) {
                    // Direct payment intent ID passed (legacy flow)
                    $paymentIntentId = $paymentIntentIdParam;
                } else {
                    $paymentIntentId = null;
                }
            }

            Log::info('Payment ID', ['paymentIntentId' => $paymentIntentId]);

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
                $bookingPayload['paymentIntentId'] = $paymentIntentId; // For refund lookup
                $bookingPayload['payment_type'] = $pendingBooking['paymentType'] ?? 'full';
                $bookingPayload['payed'] = ($bookingPayload['payment_type'] === 'full');
                $bookingPayload['bookingOrigin'] = 'website';

                // Create booking via Cloud Function (handles atomic Firestore writes)
                Log::info('Creating booking via Cloud Function', ['payload_keys' => array_keys($bookingPayload ?? [])]);

                $bookingResponse = Http::timeout(30)->post(
                    config('services.firebase.cloud_functions_url') . '/bookService',
                    $bookingPayload
                );

                if ($bookingResponse->ok()) {
                    $bookingResult = $bookingResponse->json();

                    if (!empty($bookingResult['booking_id'])) {
                        Log::info('Booking created successfully via Cloud Function', [
                            'bookingId' => $bookingResult['booking_id'],
                        ]);

                        // Send emails (non-critical, done after booking creation)
                        $this->sendBookingEmails($bookingPayload, $pendingBooking);

                        // Clear session data
                        session()->forget($sessionKey);

                        // Redirect to My Bookings
                        return redirect()->route('my-bookings');
                    }
                }

                Log::error('Booking creation failed', [
                    'status' => $bookingResponse->status(),
                    'response' => $bookingResponse->json(),
                ]);
                // Still redirect to my-bookings even if there was an issue
                session()->forget($sessionKey);
                return redirect()->route('my-bookings');
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
