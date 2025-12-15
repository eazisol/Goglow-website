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

        // If provider_id is provided, redirect to username-based URL
        if ($providerId) {
            try {
                // Get provider to find username
                $providers = Cache::remember('all_providers', 900, function () {
                    return Http::get('https://searchproviders-cn34hp55ga-uc.a.run.app')->json() ?? [];
                });
                
                $provider = collect($providers)->firstWhere('id', $providerId);
                
                if ($provider && isset($provider['username']) && $provider['username']) {
                    // Redirect to username-based URL
                    return redirect()->route('provider.by.username', ['companyUserName' => $provider['username']], 301);
                }
            } catch (\Exception $e) {
                // If redirect fails, fall back to old method
            }
            
            // Fallback: Provider data will be fetched via JavaScript from frontend
            return view('search.provider-services', [
                'services' => [], // Services loaded via JavaScript
                'provider' => null, // Provider loaded via JavaScript
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
    
    public function showProviderByUsername($companyUserName)
    {
        // Provider data will be fetched via JavaScript from frontend using username
        return view('search.provider-services', [
            'services' => [], // Services loaded via JavaScript
            'provider' => null, // Provider loaded via JavaScript
            'providerId' => null, // Not using provider_id anymore
            'companyUserName' => $companyUserName // Pass username for JavaScript API call
        ]);
    }
    public function showProviderServices($providerId)
    {
    }
    
    // Fallback endpoint for provider data (used when JavaScript fetch fails)
    public function providerFallback(Request $request)
    {
        $providerId = $request->input('provider_id');
        $username = $request->input('username');
        
        if (!$providerId && !$username) {
            return response()->json(['error' => 'Provider ID or username is required'], 400);
        }
        
        try {
            $provider = null;
            
            // Try to fetch single provider by username first
            if ($username) {
                $cacheKey = "provider_by_username_{$username}";
                $providers = Cache::remember($cacheKey, 900, function () use ($username) {
                    return Http::get('https://us-central1-beauty-984c8.cloudfunctions.net/searchProviders', [
                        'companyUserName' => $username
                    ])->json() ?? [];
                });
                
                if (is_array($providers) && count($providers) > 0) {
                    $provider = $providers[0];
                }
            }
            
            // Fallback to providerId if username didn't work
            if (!$provider && $providerId) {
                $cacheKey = "provider_by_id_{$providerId}";
                $providers = Cache::remember($cacheKey, 900, function () use ($providerId) {
                    return Http::get('https://us-central1-beauty-984c8.cloudfunctions.net/searchProviders', [
                        'providerId' => $providerId
                    ])->json() ?? [];
                });
                
                if (is_array($providers) && count($providers) > 0) {
                    $provider = $providers[0];
                }
            }
            
            if (!$provider) {
                return response()->json(['error' => 'Provider not found'], 404);
            }
            
            return response()->json(['provider' => $provider]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch provider data'], 500);
        }
    }

    public function searchVideos(Request $request)
    {
        $search = $request->input('search');
        $location = $request->input('location');
        
        // Return the videos view with same structure as results page
        return view('search.provider-videos', [
            'search' => $search,
            'location' => $location
        ]);
    }

    public function providerVideos(Request $request)
    {
        $providerId = $request->input('provider_id');
        
        if (!$providerId) {
            return redirect()->route('search')->with('error', 'Provider ID is required');
        }
        
        // Try to redirect to username-based URL
        try {
            $providers = Cache::remember('all_providers', 900, function () {
                return Http::get('https://searchproviders-cn34hp55ga-uc.a.run.app')->json() ?? [];
            });
            
            $provider = collect($providers)->firstWhere('id', $providerId);
            
            if ($provider && isset($provider['username']) && $provider['username']) {
                return redirect()->route('provider.videos.by.username', ['companyUserName' => $provider['username']], 301);
            }
        } catch (\Exception $e) {
            // Continue with old method if redirect fails
        }
        
        // Get provider data
        $providers = Cache::remember('all_providers', 900, function () {
            return Http::get('https://searchproviders-cn34hp55ga-uc.a.run.app')->json() ?? [];
        });
        
        $provider = collect($providers)->firstWhere('id', $providerId);
        if (!$provider) {
            return redirect()->route('search')->with('error', 'Provider not found');
        }
        
        return view('search.specific-provider-videos', [
            'provider' => $provider,
            'providerId' => $providerId
        ]);
    }
    
    public function showProviderVideosByUsername($companyUserName)
    {
        // Use the same provider-services view - it will detect /videos URL and show videos tab
        return view('search.provider-services', [
            'services' => [], // Services loaded via JavaScript
            'provider' => null, // Provider loaded via JavaScript
            'providerId' => null, // Not using provider_id anymore
            'companyUserName' => $companyUserName // Pass username for JavaScript API call
        ]);
    }
}
