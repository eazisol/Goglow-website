<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentSettingsService
{
    private const CACHE_TTL = 60;

    /**
     * Get all payment settings from API (cached for 60 seconds)
     * Returns: isStripeConnectLive
     */
    public static function get(): array
    {
        return Cache::remember('payment_settings', self::CACHE_TTL, function () {
            try {
                $response = Http::timeout(10)->get(config('services.firebase.cloud_functions_url') . '/getPaymentStatus');

                if ($response->ok()) {
                    $data = $response->json();
                    $settings = $data['data'] ?? [];

                    $result = [
                        'isStripeConnectLive' => $settings['isStripeConnectLive'] ?? true,
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
                'isStripeConnectLive' => true,
            ];
        });
    }
}
