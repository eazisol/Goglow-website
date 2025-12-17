<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        // Set Stripe API key directly (fallback in case env isn't working)
        Stripe::setApiKey(config('services.stripe.secret'));

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
        // Set Stripe API key directly for consistency
        Stripe::setApiKey(config('services.stripe.secret'));
        
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

            // We'll handle the API call client-side to maintain the same flow as before
            // Just log payment information
            Log::info('Payment successful', [
                'transactionId' => $paymentIntentId,
                'paymentType' => $paymentType,
                'serviceId' => $serviceId,
                'serviceProviderId' => $serviceProviderId,
                'isFreeBooking' => $isFreeBooking
            ]);
            
            // Return the success view with payment information
            // The form submission to API will happen client-side with the original form data
            return view('bookAppointment.success', [
                'transactionId' => $paymentIntentId,
                'serviceName' => 'Beauty Service',
                'paymentType' => $paymentType ?? 'full',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in payment success handler', ['error' => $e->getMessage()]);
            return view('bookAppointment.error', [
                'message' => 'Error processing payment: ' . $e->getMessage()
            ]);
        }
    }
}
