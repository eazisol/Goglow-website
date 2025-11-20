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

        // Build API URL with search parameters
        $apiUrl = 'https://us-central1-beauty-984c8.cloudfunctions.net/searchProviders';
        $queryParams = [];
        
        if ($search) {
            $queryParams['name'] = $search;
        }
        
        if ($location) {
            $queryParams['location'] = $location;
        }
        
        // Build cache key based on search parameters
        $cacheKey = 'providers_search_' . md5($search . '_' . $location);
        
        // Get filtered providers from API - cached for 15 minutes
        // API already filters the data, so we use it directly without PHP filtering
        $matchingProviders = Cache::remember($cacheKey, 900, function () use ($apiUrl, $queryParams) {
            $response = Http::get($apiUrl, $queryParams);
            return $response->json() ?? [];
        });
        
        // Ensure it's an array
        if (!is_array($matchingProviders)) {
            $matchingProviders = [];
        }

        // Get all services to extract categories - cached for 15 minutes to improve performance
        // Note: We still need all services to extract categories for the matching providers
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
        
        // Map each provider to their categories (only for matching providers)
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
