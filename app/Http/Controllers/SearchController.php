<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        $location = $request->input('location');
        $providerId = $request->input('provider_id');

        // Get all providers
        $providers = Http::get('https://searchproviders-cn34hp55ga-uc.a.run.app')->json();
        
        // If provider_id is provided, show services for that provider
        if ($providerId) {
            $provider = collect($providers)->firstWhere('id', $providerId);
            if (!$provider) {
                return back()->with('error', 'Provider not found');
            }

            // Get all services
            $services = Http::get('https://us-central1-beauty-984c8.cloudfunctions.net/getServicesOfProvider')->json();
            
            // Filter services for this provider
            $filteredServices = collect($services)
                ->filter(function ($service) use ($providerId) {
                    return $service['ownerId'] === $providerId;
                })
                ->values()
                ->all();

            return view('search.provider-services', [
                'services' => $filteredServices,
                'provider' => $provider
            ]);
        }

        // Check if search matches any provider names, store names, or company names
        $matchingProviders = collect($providers)->filter(function ($provider) use ($search, $location) {
            $searchLower = strtolower($search);
            $matchesSearch = str_contains(strtolower($provider['name'] ?? ''), $searchLower) ||
                           str_contains(strtolower($provider['storeName'] ?? ''), $searchLower) ||
                           str_contains(strtolower($provider['companyName'] ?? ''), $searchLower) ||
                           in_array(strtolower($search), array_map('strtolower', $provider['searchParameter'] ?? []));

            // If location is provided, filter by it
            if ($location) {
                return $matchesSearch && str_contains(strtolower($provider['address'] ?? ''), strtolower($location));
            }

            return $matchesSearch;
        })->values();

        // Return the list of matching providers
        return view('search.provider-results', [
            'providers' => $matchingProviders,
            'search' => $search,
            'location' => $location
        ]);
    }
    public function showProviderServices($providerId)
    {
    }
}
