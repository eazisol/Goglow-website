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
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'terms' => ['accepted'],
        ]);

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
}


