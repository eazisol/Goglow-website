<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class RedirectController extends Controller
{
    public function handleRedirection(Request $request)
    {
        $input = $request->input('id');

        // Logic to detect Desktop vs Mobile
        $userAgent = $request->header('User-Agent');
        $isMobile = Str::contains(strtolower($userAgent), ['iphone', 'ipad', 'android', 'mobile', 'touch']);

        if (!$input) {
             return redirect()->route('home');
        }

        // Resolve Provider (Check ID first, then Username)
        $provider = $this->findProvider($input);

        if (!$provider) {
             // If completely not found, fallback to search with the raw input
             return redirect()->route('search', ['provider_id' => $input]);
        }

        $realId = $provider['id'];
        
        // Always pass the Real ID to the view for deep linking
        return view('redirect.sp', ['spId' => $realId]);
    }

    private function findProvider($input)
    {
        try {
            $providers = Cache::remember('all_providers', 900, function () {
                return Http::get('https://searchproviders-cn34hp55ga-uc.a.run.app')->json() ?? [];
            });
            
            // 1. Try exact ID match
            $byID = collect($providers)->firstWhere('id', $input);
            if ($byID) return $byID;

            // 2. Try companyUserName match
            $byUsername = collect($providers)->firstWhere('companyUserName', $input);
            if ($byUsername) return $byUsername;
            
             // 3. Try legacy username match
            $byLegacyUsername = collect($providers)->firstWhere('username', $input);
            if ($byLegacyUsername) return $byLegacyUsername;

        } catch (\Exception $e) {
            // Log error
        }
        return null;
    }
}
