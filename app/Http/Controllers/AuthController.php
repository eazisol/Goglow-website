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
        // Clear any output buffer to ensure clean JSON response (prevents PHP warnings from corrupting JSON)
        if (ob_get_level()) {
            ob_clean();
        }

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
        // Clear any output buffer to ensure clean JSON response (prevents PHP warnings from corrupting JSON)
        if (ob_get_level()) {
            ob_clean();
        }

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'country_code' => ['required', 'string', 'regex:/^\+\d{1,4}$/'], // Accept prefix format like "+92"
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'terms' => ['accepted'],
        ]);
        
        // Convert prefix to country code for validation
        $prefixToCountryCode = $this->getPrefixToCountryCodeMap();
        $countryPrefix = $validated['country_code'];
        $countryCode = $prefixToCountryCode[$countryPrefix] ?? null;
        
        if (!$countryCode) {
            return back()->withErrors([
                'country_code' => 'Invalid country code selected.'
            ])->withInput();
        }
        
        // Validate phone number length based on country code
        $phoneLengthLimits = $this->getPhoneLengthLimits();
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
        // Clear any output buffer to ensure clean JSON response (prevents PHP warnings from corrupting JSON)
        if (ob_get_level()) {
            ob_clean();
        }

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
     * Refresh the Firebase ID token stored in the session.
     * Called when a 401 error is detected on the frontend.
     */
    public function refreshToken(Request $request, FirebaseAuth $auth)
    {
        $validated = $request->validate([
            'idToken' => ['required', 'string'],
        ]);

        try {
            // Verify the new ID token
            $verifiedToken = $auth->verifyIdToken($validated['idToken']);
            $uid = $verifiedToken->claims()->get('sub');

            // Check if this matches the current session user
            $sessionUid = session('firebase_uid');
            if ($sessionUid && $sessionUid !== $uid) {
                Log::warning('Token refresh attempted with different UID', [
                    'session_uid' => $sessionUid,
                    'token_uid' => $uid
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Token does not match current session'
                ], 403);
            }

            // Get user info from Firebase
            $user = $auth->getUser($uid);

            // Update session with new token
            session([
                'firebase_uid' => $uid,
                'firebase_email' => $user->email ?? session('firebase_email'),
                'firebase_id_token' => $validated['idToken'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Token refreshed successfully'
            ]);
        } catch (\Throwable $e) {
            Log::error('Token refresh failed', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Token refresh failed: ' . $e->getMessage()
            ], 401);
        }
    }
    
    /**
     * Verify phone auth: validate Firebase ID token and check if user profile exists.
     */
    public function phoneAuthVerify(Request $request, FirebaseAuth $auth)
    {
        if (ob_get_level()) {
            ob_clean();
        }

        $validated = $request->validate([
            'idToken' => ['required', 'string'],
        ]);

        try {
            $verifiedToken = $auth->verifyIdToken($validated['idToken']);
            $uid = $verifiedToken->claims()->get('sub');

            // Check if user profile exists in Firestore
            $firestore = app('firebase.firestore')->database();
            $userDoc = $firestore->collection('userProfile')->document($uid)->snapshot();
            $userExists = $userDoc->exists();

            // Store in session (firebase_email empty for phone users, kept for consistency)
            session([
                'firebase_uid' => $uid,
                'firebase_email' => '',
                'firebase_id_token' => $validated['idToken'],
            ]);

            // Determine redirect
            $redirect = session('last_book_appointment_url') ?: route('search');
            session()->forget('last_book_appointment_url');

            return response()->json([
                'success' => true,
                'isNewUser' => !$userExists,
                'redirect' => $redirect,
            ]);
        } catch (\Throwable $e) {
            Log::error('Phone auth verification failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Phone verification failed: ' . $e->getMessage()
            ], 422);
        }
    }

    /**
     * Complete profile for new phone auth users: create userProfile in Firestore.
     */
    public function phoneAuthCompleteProfile(Request $request, FirebaseAuth $auth)
    {
        if (ob_get_level()) {
            ob_clean();
        }

        $uid = session('firebase_uid');
        if (!$uid) {
            return response()->json([
                'success' => false,
                'message' => 'Not authenticated'
            ], 401);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        try {
            $firestore = app('firebase.firestore')->database();
            $phoneNumber = $auth->getUser($uid)->phoneNumber ?? '';

            $firestore->collection('userProfile')->document($uid)->set([
                'id' => $uid,
                'name' => $validated['name'],
                'email' => '',
                'phone' => $phoneNumber,
                'loginType' => 'phone',
                'linkedProviders' => ['phone'],
                'userRole' => 0,
                'enable' => true,
                'createdAt' => time(),
                'profileImg' => '',
                'available' => true,
                'days' => [1, 2, 3, 4, 5],
                'bookmarks' => [],
                'blockedUsers' => [],
                'followers' => [],
                'following' => [],
                'searchParameter' => $this->generateSearchArray($validated['name']),
            ]);

            $redirect = session('last_book_appointment_url') ?: route('search');
            session()->forget('last_book_appointment_url');

            return response()->json([
                'success' => true,
                'redirect' => $redirect,
            ]);
        } catch (\Throwable $e) {
            Log::error('Phone profile completion failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Profile creation failed: ' . $e->getMessage()
            ], 422);
        }
    }

    /**
     * Generate search array for name (matching mobile app's generateArray function).
     */
    private function generateSearchArray(string $name): array
    {
        $name = strtolower($name);
        $result = [];
        for ($i = 0; $i < strlen($name); $i++) {
            $result[] = substr($name, 0, $i + 1);
        }
        return $result;
    }

    /**
     * Get prefix to country code mapping
     * @return array
     */
    private function getPrefixToCountryCodeMap()
    {
        return [
            '+1' => 'US', // United States/Canada (US takes precedence for validation)
            '+44' => 'GB', // United Kingdom
            '+61' => 'AU', // Australia
            '+49' => 'DE', // Germany
            '+33' => 'FR', // France
            '+39' => 'IT', // Italy
            '+34' => 'ES', // Spain
            '+31' => 'NL', // Netherlands
            '+32' => 'BE', // Belgium
            '+41' => 'CH', // Switzerland
            '+43' => 'AT', // Austria
            '+46' => 'SE', // Sweden
            '+47' => 'NO', // Norway
            '+45' => 'DK', // Denmark
            '+358' => 'FI', // Finland
            '+48' => 'PL', // Poland
            '+351' => 'PT', // Portugal
            '+30' => 'GR', // Greece
            '+353' => 'IE', // Ireland
            '+64' => 'NZ', // New Zealand
            '+81' => 'JP', // Japan
            '+82' => 'KR', // South Korea
            '+86' => 'CN', // China
            '+91' => 'IN', // India
            '+55' => 'BR', // Brazil
            '+52' => 'MX', // Mexico
            '+54' => 'AR', // Argentina
            '+27' => 'ZA', // South Africa
            '+971' => 'AE', // UAE
            '+966' => 'SA', // Saudi Arabia
            '+20' => 'EG', // Egypt
            '+234' => 'NG', // Nigeria
            '+254' => 'KE', // Kenya
            '+233' => 'GH', // Ghana
            '+212' => 'MA', // Morocco
            '+216' => 'TN', // Tunisia
            '+213' => 'DZ', // Algeria
            '+90' => 'TR', // Turkey
            '+972' => 'IL', // Israel
            '+7' => 'RU', // Russia
            '+380' => 'UA', // Ukraine
            '+92' => 'PK', // Pakistan
            '+880' => 'BD', // Bangladesh
            '+63' => 'PH', // Philippines
            '+66' => 'TH', // Thailand
            '+84' => 'VN', // Vietnam
            '+62' => 'ID', // Indonesia
            '+60' => 'MY', // Malaysia
            '+65' => 'SG', // Singapore
            '+852' => 'HK', // Hong Kong
            '+886' => 'TW', // Taiwan
        ];
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


