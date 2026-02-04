<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BookingApiController extends Controller
{
    /**
     * Cloud Functions base URL
     */
    private function getCloudFunctionsUrl(): string
    {
        return config('services.firebase.cloud_functions_url');
    }

    /**
     * Get payment settings (reusing pattern from PaymentController)
     * Returns: isStripeConnectLive
     */
    private function getPaymentSettings(): array
    {
        try {
            $response = Http::timeout(10)->get($this->getCloudFunctionsUrl() . '/getPaymentStatus');

            if ($response->ok()) {
                $data = $response->json();
                $settings = $data['data'] ?? [];

                return [
                    'isStripeConnectLive' => $settings['isStripeConnectLive'] ?? false,
                ];
            }
        } catch (\Throwable $e) {
            Log::error('Error fetching payment settings', ['error' => $e->getMessage()]);
        }

        return [
            'isStripeConnectLive' => false,
        ];
    }

    /**
     * Fetch a specific booking for a user
     * Uses getBookingsByUserId Cloud Function and filters by booking ID
     * Also verifies the booking belongs to the user
     */
    private function fetchBookingForUser(string $bookingId, string $userId): ?array
    {
        try {
            // Fetch all bookings for the user
            $response = Http::timeout(30)
                ->get($this->getCloudFunctionsUrl() . '/getBookingsByUserId', [
                    'userId' => $userId,
                ]);

            if (!$response->ok()) {
                Log::warning('Failed to fetch user bookings', [
                    'userId' => $userId,
                    'status' => $response->status(),
                ]);
                return null;
            }

            $data = $response->json();
            $bookings = $data['bookings'] ?? [];

            // Find the specific booking by ID
            foreach ($bookings as $booking) {
                if (($booking['id'] ?? '') === $bookingId) {
                    return $booking;
                }
            }

            // Booking not found for this user
            return null;
        } catch (\Throwable $e) {
            Log::error('Error fetching booking for user', [
                'bookingId' => $bookingId,
                'userId' => $userId,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * List user's bookings
     * GET /api/bookings?toggleIndex=0
     * toggleIndex: 0=Upcoming, 1=Past (Cancelled/Completed)
     */
    public function index(Request $request)
    {
        // Clear any output buffer to ensure clean JSON response
        if (ob_get_level()) {
            ob_clean();
        }

        $userId = $request->input('firebase_uid');
        $toggleIndex = (int) $request->input('toggleIndex', 0);

        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post($this->getCloudFunctionsUrl() . '/getBookingsByUserId', [
                    'userId' => $userId,
                ]);

            if (!$response->ok()) {
                Log::error('Failed to fetch bookings from Cloud Function', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return response()->json([
                    'success' => false,
                    'message' => __('app.booking.fetch_error'),
                ], 500);
            }

            $data = $response->json();
            $bookings = $data['bookings'] ?? [];
            $now = now();

            // Filter bookings based on toggleIndex (same logic as mobile app)
            $filteredBookings = array_filter($bookings, function ($booking) use ($toggleIndex, $now) {
                $status = $booking['status'] ?? 0;
                $bookingTime = isset($booking['booking_time'])
                    ? $this->parseFirestoreTimestamp($booking['booking_time'])
                    : null;

                if ($toggleIndex === 0) {
                    // Upcoming: Status 0,1,4,9 AND booking time is in future
                    $isActiveStatus = in_array($status, [0, 1, 4, 9]);
                    if (!$isActiveStatus) return false;
                    return $bookingTime && $bookingTime->isAfter($now);
                } else {
                    // Past:
                    // 1. Status 0,1,4,9 AND booking time is in past
                    // 2. Status Cancelled (2,3,6)
                    // 3. Status Completed (5,7,8, 'Review')
                    $isActiveStatus = in_array($status, [0, 1, 4, 9]);

                    if ($isActiveStatus) {
                        return $bookingTime && $bookingTime->isBefore($now);
                    }

                    $isCancelled = in_array($status, [2, 3, 6]);
                    $isCompleted = in_array($status, [5, 7, 8]) || $status === 'Review';

                    return $isCancelled || $isCompleted;
                }
            });

            // Sort by createdAt descending
            usort($filteredBookings, function ($a, $b) {
                $aTime = $this->parseFirestoreTimestamp($a['createdAt'] ?? null);
                $bTime = $this->parseFirestoreTimestamp($b['createdAt'] ?? null);
                if (!$aTime || !$bTime) return 0;
                return $bTime->timestamp - $aTime->timestamp;
            });

            return response()->json([
                'success' => true,
                'bookings' => array_values($filteredBookings),
            ]);
        } catch (\Throwable $e) {
            Log::error('Error fetching bookings', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Error fetching bookings: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get single booking details
     * GET /api/bookings/{id}
     */
    public function show(Request $request, string $id)
    {
        // Clear any output buffer to ensure clean JSON response
        if (ob_get_level()) {
            ob_clean();
        }

        $userId = $request->input('firebase_uid');

        try {
            // Fetch booking using getBookingsByUserId and find the specific booking
            $booking = $this->fetchBookingForUser($id, $userId);

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => __('app.booking.not_found'),
                ], 404);
            }

            // Add refund eligibility info
            $booking['refundInfo'] = $this->calculateRefundInfo($booking);

            return response()->json([
                'success' => true,
                'booking' => $booking,
            ]);
        } catch (\Throwable $e) {
            Log::error('Error fetching booking', ['error' => $e->getMessage(), 'bookingId' => $id]);
            return response()->json([
                'success' => false,
                'message' => __('app.booking.fetch_error'),
            ], 500);
        }
    }

    /**
     * Cancel booking with refund logic
     * PUT /api/bookings/{id}/cancel
     */
    public function cancel(Request $request, string $id)
    {
        // Clear any output buffer to ensure clean JSON response
        if (ob_get_level()) {
            ob_clean();
        }

        $userId = $request->input('firebase_uid');

        try {
            // Fetch booking using getBookingsByUserId and find the specific booking
            $booking = $this->fetchBookingForUser($id, $userId);

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => __('app.booking.not_found'),
                ], 404);
            }

            // Check if booking can be cancelled
            $status = $booking['status'] ?? 0;
            if (in_array($status, [2, 3, 6])) {
                return response()->json([
                    'success' => false,
                    'message' => __('app.booking.already_cancelled'),
                ], 400);
            }

            if (in_array($status, [5, 7, 8]) || $status === 'Review') {
                return response()->json([
                    'success' => false,
                    'message' => __('app.booking.completed_cannot_cancel'),
                ], 400);
            }

            // Calculate refund for Stripe processing
            $refundInfo = $this->calculateRefundInfo($booking);
            $refundAmount = $refundInfo['refundAmount'];

            // Find paymentIntentId (used for Stripe refund and passed to Cloud Function)
            $paymentIntentId = $this->findPaymentIntentId($booking);

            // Process Stripe refund if applicable (done BEFORE Cloud Function call)
            $stripeRefundId = null;
            if ($refundAmount > 0.01 && $paymentIntentId) {
                $stripeRefundResult = $this->processStripeRefundWithPaymentIntent($booking, $refundAmount, $paymentIntentId);
                // null means Stripe API failed
                if ($stripeRefundResult === null) {
                    return response()->json([
                        'success' => false,
                        'message' => __('app.booking.refund_error'),
                    ], 500);
                }
                $stripeRefundId = $stripeRefundResult;
            }

            // Call cancelBooking Cloud Function (handles atomic Firestore writes)
            $cancelResponse = Http::timeout(30)->post(
                $this->getCloudFunctionsUrl() . '/cancelBooking',
                [
                    'bookingId' => $id,
                    'userId' => $userId,
                    'cancelledBy' => 'customer',
                    'stripeRefundId' => $stripeRefundId,
                    'paymentIntentId' => $paymentIntentId,
                ]
            );

            if (!$cancelResponse->ok()) {
                Log::error('Cancel booking Cloud Function failed', [
                    'status' => $cancelResponse->status(),
                    'body' => $cancelResponse->body(),
                ]);
                return response()->json([
                    'success' => false,
                    'message' => __('app.booking.cancel_error'),
                ], 500);
            }

            $cancelData = $cancelResponse->json();

            if (!($cancelData['success'] ?? false)) {
                return response()->json([
                    'success' => false,
                    'message' => $cancelData['message'] ?? __('app.booking.cancel_error'),
                ], 500);
            }

            Log::info('Booking cancelled successfully via Cloud Function', [
                'bookingId' => $id,
                'refundAmount' => $cancelData['refundAmount'] ?? $refundAmount,
                'stripeRefundId' => $stripeRefundId,
                'refundTransactionId' => $cancelData['refundTransactionId'] ?? null,
            ]);

            // Send cancellation notification
            $this->sendCancellationNotification($booking, $userId);

            return response()->json([
                'success' => true,
                'message' => __('app.booking.cancel_success'),
                'refundAmount' => $cancelData['refundAmount'] ?? $refundAmount,
                'refundInfo' => $refundInfo,
            ]);
        } catch (\Throwable $e) {
            Log::error('Error cancelling booking', ['error' => $e->getMessage(), 'bookingId' => $id]);
            return response()->json([
                'success' => false,
                'message' => 'Error cancelling booking: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Reschedule booking
     * PUT /api/bookings/{id}/reschedule
     */
    public function reschedule(Request $request, string $id)
    {
        // Clear any output buffer to ensure clean JSON response
        if (ob_get_level()) {
            ob_clean();
        }

        $userId = $request->input('firebase_uid');

        $request->validate([
            'booking_time' => 'required|string', // Formatted like "February 10, 2026 at 14:15:00 UTC+1"
            'bookTime' => 'nullable|string', // e.g., "14:30"
            'agentId' => 'nullable|string',
            'agentName' => 'nullable|string',
        ]);

        $newBookingTime = $request->input('booking_time');
        $newBookTime = $request->input('bookTime');
        $newAgentId = $request->input('agentId');
        $newAgentName = $request->input('agentName');

        try {
            // Fetch booking to verify ownership and check status
            $booking = $this->fetchBookingForUser($id, $userId);

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => __('app.booking.not_found'),
                ], 404);
            }

            // Verify booking is at least 24 hours away
            $bookingTime = $this->parseFirestoreTimestamp($booking['booking_time'] ?? null);
            if ($bookingTime && $bookingTime->diffInHours(now()) < 24) {
                return response()->json([
                    'success' => false,
                    'message' => __('app.booking.reschedule_24h_advance'),
                ], 400);
            }

            // Call rescheduleBooking Cloud Function
            $rescheduleResponse = Http::timeout(30)->post(
                $this->getCloudFunctionsUrl() . '/rescheduleBooking',
                [
                    'bookingId' => $id,
                    'userId' => $userId,
                    'bookingTime' => $newBookingTime,
                    'bookTime' => $newBookTime,
                    'agentId' => $newAgentId,
                    'agentName' => $newAgentName,
                ]
            );

            if (!$rescheduleResponse->ok()) {
                Log::error('Reschedule booking Cloud Function failed', [
                    'status' => $rescheduleResponse->status(),
                    'body' => $rescheduleResponse->body(),
                ]);
                return response()->json([
                    'success' => false,
                    'message' => __('app.booking.reschedule_error'),
                ], 500);
            }

            $rescheduleData = $rescheduleResponse->json();

            if (!($rescheduleData['success'] ?? false)) {
                return response()->json([
                    'success' => false,
                    'message' => $rescheduleData['message'] ?? __('app.booking.reschedule_error'),
                ], 400);
            }

            Log::info('Booking rescheduled successfully via Cloud Function', [
                'bookingId' => $id,
                'newBookingTime' => $newBookingTime,
            ]);

            // Send reschedule notification
            $this->sendRescheduleNotification($booking, $newBookingTime, $userId);

            return response()->json([
                'success' => true,
                'message' => __('app.booking.reschedule_success'),
                'newBookingTime' => $newBookingTime,
                'newAgentId' => $newAgentId,
                'newAgentName' => $newAgentName,
            ]);
        } catch (\Throwable $e) {
            Log::error('Error rescheduling booking', ['error' => $e->getMessage(), 'bookingId' => $id]);
            return response()->json([
                'success' => false,
                'message' => 'Error rescheduling booking: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Calculate refund info based on 24-hour rule
     */
    private function calculateRefundInfo(array $booking): array
    {
        $bookingTime = $this->parseFirestoreTimestamp($booking['booking_time'] ?? null);
        $now = now();

        $isBefore24h = $bookingTime && $bookingTime->diffInHours($now) >= 24;

        // Get amounts
        $totalAmount = (float) ($booking['amount'] ?? 0);
        $depositAmount = $this->getDepositAmount($booking);
        $paymentType = $booking['paymentType'] ?? 'deposit';

        // Calculate total paid from transactions (simplified - use amount for deposit, totalAmount for full)
        $totalPaid = $paymentType === 'full' ? $totalAmount : $depositAmount;

        $refundAmount = 0.0;
        $refundMessage = '';

        if ($totalPaid > 0) {
            if ($isBefore24h) {
                // Full refund
                $refundAmount = $totalPaid;
                $refundMessage = "Full refund of €" . number_format($totalPaid, 2) . " will be processed.";
            } else {
                // Within 24h - user loses deposit
                if ($paymentType === 'full') {
                    $refundAmount = max(0, $totalPaid - $depositAmount);
                    if ($refundAmount > 0.01) {
                        $refundMessage = "Partial refund of €" . number_format($refundAmount, 2) . ". Deposit of €" . number_format($depositAmount, 2) . " will be retained.";
                    } else {
                        $refundMessage = "Deposit of €" . number_format($depositAmount, 2) . " will be retained. No refund available.";
                    }
                } else {
                    $refundAmount = 0.0;
                    $refundMessage = "Deposit of €" . number_format($totalPaid, 2) . " will be retained due to late cancellation.";
                }
            }
        }

        return [
            'isBefore24h' => $isBefore24h,
            'totalPaid' => $totalPaid,
            'depositAmount' => $depositAmount,
            'refundAmount' => $refundAmount,
            'refundMessage' => $refundMessage,
            'canReschedule' => $isBefore24h,
        ];
    }

    /**
     * Get deposit amount for a booking
     */
    private function getDepositAmount(array $booking): float
    {
        // Use stored deposit amount if available
        if (isset($booking['depositAmount'])) {
            return (float) $booking['depositAmount'];
        }

        // Calculate from deposit percentage
        $totalAmount = (float) ($booking['amount'] ?? 0);
        $depositPercentage = (float) ($booking['depositPercentage'] ?? 25);

        return $totalAmount * ($depositPercentage / 100);
    }

    /**
     * Find payment intent ID from booking data
     * Checks: paymentIntentId field, transaction_uid (string or array)
     * Note: Firestore lookup is handled by cancelBooking Cloud Function if needed
     */
    private function findPaymentIntentId(array $booking): ?string
    {
        $bookingId = $booking['id'] ?? $booking['bookingId'] ?? null;

        // 1. Check paymentIntentId field (website bookings)
        $paymentIntentId = $booking['paymentIntentId'] ?? null;
        if ($paymentIntentId && str_starts_with($paymentIntentId, 'pi_')) {
            Log::info('Found paymentIntentId in booking.paymentIntentId', [
                'bookingId' => $bookingId,
                'paymentIntentId' => $paymentIntentId,
            ]);
            return $paymentIntentId;
        }

        // 2. Check transaction_uid field (string format - old website bookings)
        $transactionUid = $booking['transaction_uid'] ?? null;
        if (is_string($transactionUid) && str_starts_with($transactionUid, 'pi_')) {
            Log::info('Found paymentIntentId in booking.transaction_uid (string)', [
                'bookingId' => $bookingId,
                'paymentIntentId' => $transactionUid,
            ]);
            return $transactionUid;
        }

        // 3. Check transaction_uid field (array format)
        if (is_array($transactionUid)) {
            foreach ($transactionUid as $uid) {
                if (is_string($uid) && str_starts_with($uid, 'pi_')) {
                    Log::info('Found paymentIntentId in booking.transaction_uid (array)', [
                        'bookingId' => $bookingId,
                        'paymentIntentId' => $uid,
                    ]);
                    return $uid;
                }
            }
        }

        Log::info('No Stripe payment intent found in booking data', ['bookingId' => $bookingId]);
        return null;
    }

    /**
     * Process Stripe refund via Cloud Function
     * Returns Stripe refund ID (re_xxx) on success, null on failure
     */
    private function processStripeRefundWithPaymentIntent(array $booking, float $refundAmount, string $paymentIntentId): ?string
    {
        try {
            // Get Stripe mode (always using Stripe Connect)
            $settings = $this->getPaymentSettings();
            $isLive = $settings['isStripeConnectLive'];
            $isLive = false; // for testing

            // Build refund payload
            $refundPayload = [
                'paymentIntentId' => $paymentIntentId,
                'amount' => (int) ($refundAmount * 100), // Convert to cents
                'isStripeLive' => $isLive,
            ];

            Log::info('Calling createStripeRefund Cloud Function', [
                'bookingId' => $booking['id'] ?? $booking['bookingId'],
                'payload' => $refundPayload,
                'cloudFunctionUrl' => $this->getCloudFunctionsUrl() . '/createStripeRefund',
            ]);

            // Call refund Cloud Function
            $refundResponse = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($this->getCloudFunctionsUrl() . '/createStripeRefund', $refundPayload);

            Log::info('createStripeRefund response', [
                'bookingId' => $booking['id'] ?? $booking['bookingId'],
                'status' => $refundResponse->status(),
                'body' => $refundResponse->body(),
            ]);

            if (!$refundResponse->ok()) {
                Log::error('Stripe refund HTTP error', [
                    'bookingId' => $booking['id'] ?? $booking['bookingId'],
                    'httpStatus' => $refundResponse->status(),
                    'response' => $refundResponse->body(),
                ]);
                return null;
            }

            $refundData = $refundResponse->json();
            if ($refundData['success'] ?? false) {
                $stripeRefundId = $refundData['refundId'] ?? null;
                Log::info('Stripe refund processed successfully', [
                    'bookingId' => $booking['id'] ?? $booking['bookingId'],
                    'refundId' => $stripeRefundId,
                    'amount' => $refundAmount,
                ]);
                // Return the Stripe refund ID (re_xxx) for transaction record
                return $stripeRefundId;
            }

            Log::error('Stripe refund returned failure', [
                'bookingId' => $booking['id'] ?? $booking['bookingId'],
                'response' => $refundData,
            ]);
            return null;
        } catch (\Throwable $e) {
            Log::error('Error processing Stripe refund', [
                'error' => $e->getMessage(),
                'bookingId' => $booking['id'] ?? $booking['bookingId'],
            ]);
            return null;
        }
    }

    /**
     * Send cancellation notification
     */
    private function sendCancellationNotification(array $booking, string $userId): void
    {
        try {
            Http::timeout(10)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($this->getCloudFunctionsUrl() . '/sendPushNotification', [
                    'type' => 'booking_cancelled_by_customer',
                    'recipientId' => $booking['service_provider_id'] ?? $booking['serviceProviderId'],
                    'senderId' => $userId,
                    'bookingId' => $booking['id'] ?? $booking['bookingId'],
                    'data' => [
                        'title' => 'Booking Cancelled',
                        'body' => 'A customer has cancelled their booking.',
                    ],
                ]);
        } catch (\Throwable $e) {
            Log::warning('Failed to send cancellation notification', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Send reschedule notification
     */
    private function sendRescheduleNotification(array $booking, string $newTime, string $userId): void
    {
        try {
            Http::timeout(10)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($this->getCloudFunctionsUrl() . '/sendPushNotification', [
                    'type' => 'booking_rescheduled',
                    'recipientId' => $booking['service_provider_id'] ?? $booking['serviceProviderId'],
                    'senderId' => $userId,
                    'bookingId' => $booking['id'] ?? $booking['bookingId'],
                    'data' => [
                        'title' => 'Booking Rescheduled',
                        'body' => 'A customer has rescheduled their booking.',
                        'newTime' => $newTime,
                    ],
                ]);
        } catch (\Throwable $e) {
            Log::warning('Failed to send reschedule notification', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Parse Firestore timestamp to Carbon instance
     */
    private function parseFirestoreTimestamp($timestamp): ?\Carbon\Carbon
    {
        if (!$timestamp) {
            return null;
        }

        try {
            // Handle Firestore timestamp format { _seconds: ..., _nanoseconds: ... }
            if (is_array($timestamp)) {
                if (isset($timestamp['_seconds'])) {
                    return \Carbon\Carbon::createFromTimestamp($timestamp['_seconds']);
                }
                if (isset($timestamp['seconds'])) {
                    return \Carbon\Carbon::createFromTimestamp($timestamp['seconds']);
                }
            }

            // Handle ISO string
            if (is_string($timestamp)) {
                return \Carbon\Carbon::parse($timestamp);
            }

            return null;
        } catch (\Throwable $e) {
            return null;
        }
    }
}
