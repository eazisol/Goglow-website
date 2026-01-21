<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Get the Stripe live/test status from API
     * Fetches fresh data on every call
     */
    private function getStripeMode(): bool
    {
        try {
            $response = Http::timeout(10)->get('https://us-central1-beauty-984c8.cloudfunctions.net/getPaymentStatus');
            
            if ($response->ok()) {
                $data = $response->json();
                $isLive = $data['data']['isStripeLive'] ?? false;
                Log::info('Stripe mode fetched from API', ['isStripeLive' => $isLive]);
                return $isLive;
            }
            
            Log::warning('Failed to fetch Stripe mode from API, defaulting to test mode');
            return false;
        } catch (\Throwable $e) {
            Log::error('Error fetching Stripe mode', ['error' => $e->getMessage()]);
            return false; // Default to test mode on error
        }
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
        $isLive = $this->getStripeMode();
        $publishableKey = $this->getStripePublishableKey();
        
        return response()->json([
            'success' => true,
            'isLive' => $isLive,
            'publishableKey' => $publishableKey,
        ]);
    }

    public function createCheckoutSession(Request $request)
    {
        // Set Stripe API key dynamically based on payment status API
        $stripeSecretKey = $this->getStripeSecretKey();
        Stripe::setApiKey($stripeSecretKey);
        
        Log::info('Using Stripe mode', ['isLive' => $this->getStripeMode()]);

        // Log the request for debugging
        Log::info('Stripe checkout request', $request->all());
        
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
                $response = Http::get('https://us-central1-beauty-984c8.cloudfunctions.net/getServiceById', [
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

        // Create a checkout session
        try {
            // Log the amount being charged
            Log::info('Creating Stripe session', [
                'amount' => $amount,
                'amountInCents' => $amountInCents,
                'paymentType' => $paymentType,
                'serviceName' => $serviceName
            ]);
            
            // For Stripe v7.0, we need to use a different format
            
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
            ];
            session(['pending_booking_' . $session->id => $pendingBookingData]);

            // Return the session ID
            Log::info('Stripe session created', ['id' => $session->id]);
            return response()->json(['id' => $session->id]);

        } catch (\Exception $e) {
            Log::error('Stripe session creation failed', ['error' => $e->getMessage()]);
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

        $sessionId = $request->get('session_id');
        $serviceId = $request->get('serviceId');
        $serviceProviderId = $request->get('serviceProviderId');
        $paymentType = $request->get('paymentType');
        
        // These might not be present if we're using the simplified flow
        $formData = $request->has('formData') ? json_decode($request->get('formData'), true) : [];
        $bookingData = $request->has('bookingData') ? json_decode($request->get('bookingData'), true) : [];

        try {
            if (empty($sessionId)) {
                throw new \Exception('Session ID is missing from the request.');
            }
            
            // Check if this is a free booking (session_id starts with "free-booking")
            $isFreeBooking = strpos($sessionId, 'free-booking') === 0;
            
            if ($isFreeBooking) {
                // For free bookings, skip Stripe session retrieval
                Log::info('Free booking detected, skipping Stripe session retrieval', ['sessionId' => $sessionId]);
                $paymentIntentId = $sessionId; // Use the free-booking transaction ID
            } else {
                // Retrieve the session to get payment information
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
            
            Log::info('Payment ID', ['paymentIntentId' => $paymentIntentId]);

            // Retrieve booking data from session
            $sessionKey = 'pending_booking_' . $sessionId;
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
                $bookResponse = Http::post('https://us-central1-beauty-984c8.cloudfunctions.net/bookService', $bookingPayload);
                
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
