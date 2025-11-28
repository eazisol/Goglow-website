<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        $location = $request->input('location');
        $providerId = $request->input('provider_id');

        // If provider_id is provided, show services for that provider
        if ($providerId) {
            // Get all providers to find the specific provider by ID
            $providers = Cache::remember('all_providers', 900, function () {
                return Http::get('https://searchproviders-cn34hp55ga-uc.a.run.app')->json() ?? [];
            });
            
            $provider = collect($providers)->firstWhere('id', $providerId);
            if (!$provider) {
                return back()->with('error', 'Provider not found');
            }

            // Services will be fetched via JavaScript from frontend
            return view('search.provider-services', [
                'services' => [], // Services loaded via JavaScript
                'provider' => $provider,
                'providerId' => $providerId // Pass provider ID for JavaScript API call
            ]);
        }

        // Providers will be fetched via JavaScript from frontend
        return view('search.provider-results', [
            'providers' => [], // Providers loaded via JavaScript
            'search' => $search,
            'location' => $location,
            'categories' => [], // Removed: was fetching all services to extract categories
            'providerCategories' => [] // Removed: was mapping categories from all services
        ]);
    }
    public function showProviderServices($providerId)
    {
    }
}
