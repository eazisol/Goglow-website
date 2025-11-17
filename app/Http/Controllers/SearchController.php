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

        // Get all providers - cached for 15 minutes to improve performance
        $providers = Cache::remember('all_providers', 900, function () {
            return Http::get('https://searchproviders-cn34hp55ga-uc.a.run.app')->json() ?? [];
        });
        
        // If provider_id is provided, show services for that provider
        if ($providerId) {
            $provider = collect($providers)->firstWhere('id', $providerId);
            if (!$provider) {
                return back()->with('error', 'Provider not found');
            }

            // Get all services - cached for 15 minutes to improve performance
            $services = Cache::remember('all_services', 900, function () {
                return Http::get('https://us-central1-beauty-984c8.cloudfunctions.net/getServicesOfProvider')->json() ?? [];
            });
            
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

        // Get all services to extract categories - cached for 15 minutes to improve performance
        $allServices = Cache::remember('all_services', 900, function () {
            return Http::get('https://us-central1-beauty-984c8.cloudfunctions.net/getServicesOfProvider')->json() ?? [];
        });
        
        // Handle API failure or null response
        if (!is_array($allServices)) {
            $allServices = [];
        }
        
        // Extract unique categories from all services
        $allCategories = collect($allServices)
            ->pluck('category.name')
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->all();
        
        // Map each provider to their categories
        $providerCategories = [];
        foreach ($matchingProviders as $provider) {
            $providerId = $provider['id'] ?? null;
            if (!$providerId) {
                continue;
            }
            
            $categories = collect($allServices)
                ->filter(function ($service) use ($providerId) {
                    return isset($service['ownerId']) && $service['ownerId'] === $providerId;
                })
                ->pluck('category.name')
                ->filter()
                ->unique()
                ->values()
                ->all();
            
            $providerCategories[$providerId] = $categories;
        }

        // Return the list of matching providers
        return view('search.provider-results', [
            'providers' => $matchingProviders,
            'search' => $search,
            'location' => $location,
            'categories' => $allCategories,
            'providerCategories' => $providerCategories
        ]);
    }
    public function showProviderServices($providerId)
    {
    }
}
