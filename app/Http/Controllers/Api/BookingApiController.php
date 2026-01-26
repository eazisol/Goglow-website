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
     */
    private function getPaymentSettings(): array
    {
        try {
            $response = Http::timeout(10)->get($this->getCloudFunctionsUrl() . '/getPaymentStatus');

            if ($response->ok()) {
                $data = $response->json();
                $settings = $data['data'] ?? [];

                return [
                    'isStripeLive' => $settings['isStripeLive'] ?? false,
                    'useStripeConnect' => $settings['useStripeConnect'] ?? false,
                    'isStripeConnectLive' => $settings['isStripeConnectLive'] ?? false,
                ];
            }
        } catch (\Throwable $e) {
            Log::error('Error fetching payment settings', ['error' => $e->getMessage()]);
        }

        return [
            'isStripeLive' => false,
            'useStripeConnect' => false,
            'isStripeConnectLive' => false,
        ];
    }

    /**
     * List user's bookings
     * GET /api/bookings?toggleIndex=0
     * toggleIndex: 0=Upcoming, 1=Past (Cancelled/Completed)
     */
    public function index(Request $request)
    {
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
                    'message' => 'Failed to fetch bookings',
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
        $userId = $request->input('firebase_uid');

        try {
            $response = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($this->getCloudFunctionsUrl() . '/getBookingById', [
                    'bookingId' => $id,
                ]);

            if (!$response->ok()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking not found',
                ], 404);
            }

            $data = $response->json();
            $booking = $data['booking'] ?? null;

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking not found',
                ], 404);
            }

            // Verify booking belongs to authenticated user
            if (($booking['userId'] ?? '') !== $userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access denied',
                ], 403);
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
                'message' => 'Error fetching booking',
            ], 500);
        }
    }

    /**
     * Cancel booking with refund logic
     * PUT /api/bookings/{id}/cancel
     */
    public function cancel(Request $request, string $id)
    {
        $userId = $request->input('firebase_uid');

        try {
            // Get booking details first
            $bookingResponse = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($this->getCloudFunctionsUrl() . '/getBookingById', [
                    'bookingId' => $id,
                ]);

            if (!$bookingResponse->ok()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking not found',
                ], 404);
            }

            $bookingData = $bookingResponse->json();
            $booking = $bookingData['booking'] ?? null;

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking not found',
                ], 404);
            }

            // Verify booking belongs to authenticated user
            if (($booking['userId'] ?? '') !== $userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access denied',
                ], 403);
            }

            // Check if booking can be cancelled
            $status = $booking['status'] ?? 0;
            if (in_array($status, [2, 3, 6])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking is already cancelled',
                ], 400);
            }

            if (in_array($status, [5, 7, 8]) || $status === 'Review') {
                return response()->json([
                    'success' => false,
                    'message' => 'Completed bookings cannot be cancelled',
                ], 400);
            }

            // Calculate refund
            $refundInfo = $this->calculateRefundInfo($booking);
            $refundAmount = $refundInfo['refundAmount'];

            // Process Stripe refund if applicable
            if ($refundAmount > 0.01) {
                $refundSuccess = $this->processStripeRefund($booking, $refundAmount);
                if (!$refundSuccess) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to process refund',
                    ], 500);
                }
            }

            // Update booking status to cancelled (status: 2)
            $cancelResponse = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($this->getCloudFunctionsUrl() . '/cancelBooking', [
                    'bookingId' => $id,
                    'status' => 2,
                    'cancelDate' => now()->toIso8601String(),
                ]);

            if (!$cancelResponse->ok()) {
                Log::error('Failed to update booking status', [
                    'bookingId' => $id,
                    'response' => $cancelResponse->body(),
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to cancel booking',
                ], 500);
            }

            // Send cancellation notification
            $this->sendCancellationNotification($booking, $userId);

            return response()->json([
                'success' => true,
                'message' => 'Booking cancelled successfully',
                'refundAmount' => $refundAmount,
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
        $userId = $request->input('firebase_uid');

        $request->validate([
            'booking_time' => 'required|date',
            'bookTime' => 'nullable|string', // e.g., "14:30"
        ]);

        $newBookingTime = $request->input('booking_time');
        $newBookTime = $request->input('bookTime');

        try {
            // Get booking details first
            $bookingResponse = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($this->getCloudFunctionsUrl() . '/getBookingById', [
                    'bookingId' => $id,
                ]);

            if (!$bookingResponse->ok()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking not found',
                ], 404);
            }

            $bookingData = $bookingResponse->json();
            $booking = $bookingData['booking'] ?? null;

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking not found',
                ], 404);
            }

            // Verify booking belongs to authenticated user
            if (($booking['userId'] ?? '') !== $userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access denied',
                ], 403);
            }

            // Check if booking can be rescheduled
            $status = $booking['status'] ?? 0;
            if (!in_array($status, [0, 1, 4, 9])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only active bookings can be rescheduled',
                ], 400);
            }

            // Verify booking is at least 24 hours away
            $bookingTime = $this->parseFirestoreTimestamp($booking['booking_time'] ?? null);
            if ($bookingTime && $bookingTime->diffInHours(now()) < 24) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bookings can only be rescheduled at least 24 hours in advance',
                ], 400);
            }

            // Update booking time
            $rescheduleResponse = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($this->getCloudFunctionsUrl() . '/rescheduleBooking', [
                    'bookingId' => $id,
                    'booking_time' => $newBookingTime,
                    'bookTime' => $newBookTime,
                ]);

            if (!$rescheduleResponse->ok()) {
                Log::error('Failed to reschedule booking', [
                    'bookingId' => $id,
                    'response' => $rescheduleResponse->body(),
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to reschedule booking',
                ], 500);
            }

            // Send reschedule notification
            $this->sendRescheduleNotification($booking, $newBookingTime, $userId);

            return response()->json([
                'success' => true,
                'message' => 'Booking rescheduled successfully',
                'newBookingTime' => $newBookingTime,
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
     * Process Stripe refund via Cloud Function
     */
    private function processStripeRefund(array $booking, float $refundAmount): bool
    {
        try {
            // Get payment intent ID from booking transactions
            $transactionsResponse = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($this->getCloudFunctionsUrl() . '/getBookingTransactions', [
                    'bookingId' => $booking['id'] ?? $booking['bookingId'],
                ]);

            $paymentIntentId = null;
            if ($transactionsResponse->ok()) {
                $txData = $transactionsResponse->json();
                $transactions = $txData['transactions'] ?? [];

                foreach ($transactions as $tx) {
                    if (($tx['isRefund'] ?? false) === false) {
                        $txId = $tx['transactionId'] ?? '';
                        if (str_starts_with($txId, 'pi_')) {
                            $paymentIntentId = $txId;
                            break;
                        }
                    }
                }
            }

            if (!$paymentIntentId) {
                Log::info('No Stripe payment intent found for booking, skipping Stripe refund', [
                    'bookingId' => $booking['id'] ?? $booking['bookingId'],
                ]);
                return true; // Not a Stripe payment, proceed with cancellation
            }

            // Get Stripe mode
            $settings = $this->getPaymentSettings();
            $isLive = $settings['useStripeConnect']
                ? $settings['isStripeConnectLive']
                : $settings['isStripeLive'];

            // Call refund Cloud Function
            $refundResponse = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($this->getCloudFunctionsUrl() . '/createStripeRefund', [
                    'paymentIntentId' => $paymentIntentId,
                    'amount' => (int) ($refundAmount * 100), // Convert to cents
                    'isStripeLive' => $isLive,
                ]);

            if (!$refundResponse->ok()) {
                Log::error('Stripe refund failed', [
                    'bookingId' => $booking['id'] ?? $booking['bookingId'],
                    'response' => $refundResponse->body(),
                ]);
                return false;
            }

            $refundData = $refundResponse->json();
            if ($refundData['success'] ?? false) {
                Log::info('Stripe refund processed successfully', [
                    'bookingId' => $booking['id'] ?? $booking['bookingId'],
                    'refundId' => $refundData['refundId'] ?? null,
                    'amount' => $refundAmount,
                ]);
                return true;
            }

            Log::error('Stripe refund returned failure', [
                'bookingId' => $booking['id'] ?? $booking['bookingId'],
                'response' => $refundData,
            ]);
            return false;
        } catch (\Throwable $e) {
            Log::error('Error processing Stripe refund', [
                'error' => $e->getMessage(),
                'bookingId' => $booking['id'] ?? $booking['bookingId'],
            ]);
            return false;
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
