<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Exception\FirebaseException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request, FirebaseAuth $auth)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        try {
            // Verify using email+password via custom endpoint isn't available in Admin SDK.
            // Instead, expect client to send an ID token or use REST API.
            // Here, we support REST signInWithPassword for convenience.
            $apiKey = config('services.firebase.web_api_key');
            if (!$apiKey) {
                throw new \RuntimeException('Firebase Web API key is not configured');
            }

            $response = \Illuminate\Support\Facades\Http::post('https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword?key=' . $apiKey, [
                'email' => $validated['email'],
                'password' => $validated['password'],
                'returnSecureToken' => true,
            ]);

            if (!$response->ok()) {
                $msg = $response->json('error.message') ?? 'Authentication failed';
                
                if ($request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => $msg
                    ], 422);
                }
                
                return back()->withErrors(['email' => $msg])->withInput();
            }

            $idToken = $response->json('idToken');
            $verified = $auth->verifyIdToken($idToken);
            $uid = $verified->claims()->get('sub');

            session([
                'firebase_uid' => $uid,
                'firebase_email' => $validated['email'],
                'firebase_id_token' => $idToken,
            ]);

            // Check for stored book appointment URL first, then request redirect, then default to search
            $redirect = session('last_book_appointment_url') ?: $request->input('redirect') ?: route('search');
            
            // Clear the stored URL after using it
            session()->forget('last_book_appointment_url');
            
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Logged in successfully',
                    'redirect' => $redirect
                ]);
            }
            
            return redirect($redirect)->with('success', 'Logged in successfully');
        } catch (\Throwable $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login failed: ' . $e->getMessage()
                ], 422);
            }
            
            return back()->withErrors(['email' => 'Login failed: ' . $e->getMessage()])->withInput();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['firebase_uid', 'firebase_email', 'firebase_id_token']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logged out');
    }
    public function showRegisterForm()
    {
        return view('auth.signup');
    }

    public function register(Request $request, FirebaseAuth $auth)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'country_code' => ['required', 'string', 'regex:/^[A-Z]{2}$/'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'terms' => ['accepted'],
        ]);
        
        // Validate phone number length based on country code
        $phoneLengthLimits = $this->getPhoneLengthLimits();
        $countryCode = $validated['country_code'];
        $phoneDigits = preg_replace('/\D/', '', $validated['phone']);
        
        if (isset($phoneLengthLimits[$countryCode])) {
            $limits = $phoneLengthLimits[$countryCode];
            $phoneLength = strlen($phoneDigits);
            
            if ($phoneLength < $limits['min'] || $phoneLength > $limits['max']) {
                return back()->withErrors([
                    'phone' => "Phone number must be {$limits['min']}-{$limits['max']} digits for the selected country."
                ])->withInput();
            }
        }

        try {
            $userProperties = [
                'email' => $validated['email'],
                'emailVerified' => false,
                'password' => $validated['password'],
                'displayName' => $validated['first_name'] . ' ' . $validated['last_name'],
                'disabled' => false,
            ];

            $createdUser = $auth->createUser($userProperties);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Account created successfully. You can now sign in.',
                    'uid' => $createdUser->uid,
                ]);
            }

            return redirect()->route('signup')->with('success', 'Account created successfully. You can now sign in.');
        } catch (AuthException|FirebaseException $e) {
            Log::error('Firebase registration failed', ['error' => $e->getMessage()]);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Registration failed: ' . $e->getMessage(),
                ], 422);
            }

            return back()->withErrors(['email' => $e->getMessage()])->withInput();
        }
    }

    public function oauthLogin(Request $request, FirebaseAuth $auth)
    {
        $validated = $request->validate([
            'idToken' => ['required', 'string'],
            'isSignup' => ['boolean'],
        ]);

        try {
            // Verify the ID token
            $verifiedToken = $auth->verifyIdToken($validated['idToken']);
            $uid = $verifiedToken->claims()->get('sub');
            
            // Get user info from Firebase
            $user = $auth->getUser($uid);
            
            // Store in session
            session([
                'firebase_uid' => $uid,
                'firebase_email' => $user->email ?? '',
                'firebase_id_token' => $validated['idToken'],
            ]);

            // Check for stored book appointment URL first, then request redirect, then default to search
            $redirect = session('last_book_appointment_url') ?: $request->input('redirect') ?: route('search');
            
            // Clear the stored URL after using it
            session()->forget('last_book_appointment_url');

            return response()->json([
                'success' => true,
                'message' => 'Logged in successfully',
                'redirect' => $redirect
            ]);
        } catch (\Throwable $e) {
            Log::error('OAuth login failed', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Authentication failed: ' . $e->getMessage()
            ], 422);
        }
    }
    
    /**
     * Get phone number length limits by country code
     * @return array
     */
    private function getPhoneLengthLimits()
    {
        return [
            'US' => ['min' => 10, 'max' => 10], // United States
            'CA' => ['min' => 10, 'max' => 10], // Canada
            'GB' => ['min' => 10, 'max' => 10], // United Kingdom
            'FR' => ['min' => 9, 'max' => 9], // France
            'DE' => ['min' => 10, 'max' => 11], // Germany
            'IT' => ['min' => 9, 'max' => 10], // Italy
            'ES' => ['min' => 9, 'max' => 9], // Spain
            'NL' => ['min' => 9, 'max' => 9], // Netherlands
            'BE' => ['min' => 9, 'max' => 9], // Belgium
            'CH' => ['min' => 9, 'max' => 9], // Switzerland
            'AT' => ['min' => 10, 'max' => 13], // Austria
            'SE' => ['min' => 9, 'max' => 9], // Sweden
            'NO' => ['min' => 8, 'max' => 8], // Norway
            'DK' => ['min' => 8, 'max' => 8], // Denmark
            'FI' => ['min' => 9, 'max' => 10], // Finland
            'PL' => ['min' => 9, 'max' => 9], // Poland
            'PT' => ['min' => 9, 'max' => 9], // Portugal
            'GR' => ['min' => 10, 'max' => 10], // Greece
            'IE' => ['min' => 9, 'max' => 9], // Ireland
            'AU' => ['min' => 9, 'max' => 9], // Australia
            'NZ' => ['min' => 8, 'max' => 10], // New Zealand
            'JP' => ['min' => 10, 'max' => 11], // Japan
            'KR' => ['min' => 9, 'max' => 10], // South Korea
            'CN' => ['min' => 11, 'max' => 11], // China
            'IN' => ['min' => 10, 'max' => 10], // India
            'BR' => ['min' => 10, 'max' => 11], // Brazil
            'MX' => ['min' => 10, 'max' => 10], // Mexico
            'AR' => ['min' => 10, 'max' => 10], // Argentina
            'ZA' => ['min' => 9, 'max' => 9], // South Africa
            'AE' => ['min' => 9, 'max' => 9], // UAE
            'SA' => ['min' => 9, 'max' => 9], // Saudi Arabia
            'EG' => ['min' => 10, 'max' => 10], // Egypt
            'NG' => ['min' => 10, 'max' => 10], // Nigeria
            'KE' => ['min' => 9, 'max' => 9], // Kenya
            'GH' => ['min' => 9, 'max' => 9], // Ghana
            'MA' => ['min' => 9, 'max' => 9], // Morocco
            'TN' => ['min' => 8, 'max' => 8], // Tunisia
            'DZ' => ['min' => 9, 'max' => 9], // Algeria
            'TR' => ['min' => 10, 'max' => 10], // Turkey
            'IL' => ['min' => 9, 'max' => 9], // Israel
            'RU' => ['min' => 10, 'max' => 10], // Russia
            'UA' => ['min' => 9, 'max' => 9], // Ukraine
            'PK' => ['min' => 10, 'max' => 10], // Pakistan
            'BD' => ['min' => 10, 'max' => 10], // Bangladesh
            'PH' => ['min' => 10, 'max' => 10], // Philippines
            'TH' => ['min' => 9, 'max' => 9], // Thailand
            'VN' => ['min' => 9, 'max' => 10], // Vietnam
            'ID' => ['min' => 9, 'max' => 11], // Indonesia
            'MY' => ['min' => 9, 'max' => 10], // Malaysia
            'SG' => ['min' => 8, 'max' => 8], // Singapore
            'HK' => ['min' => 8, 'max' => 8], // Hong Kong
            'TW' => ['min' => 9, 'max' => 9], // Taiwan
        ];
    }
}


