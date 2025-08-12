<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Exception\FirebaseException;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.signup');
    }

    public function register(Request $request, FirebaseAuth $auth)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:32'],
            'location' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'terms' => ['accepted'],
        ]);

        try {
            $userProperties = [
                'email' => $validated['email'],
                'emailVerified' => false,
                'password' => $validated['password'],
                'displayName' => $validated['name'],
                'disabled' => false,
            ];

            $createdUser = $auth->createUser($userProperties);

            // Optionally store phone and location in Firebase custom claims or your own DB.
            // If you want to store phone in Firebase user profile when possible:
            try {
                if (!empty($validated['phone'])) {
                    $auth->updateUser($createdUser->uid, ['phoneNumber' => $validated['phone']]);
                }
            } catch (\Throwable $e) {
                // Non-fatal if phone update fails (e.g., invalid E.164)
                \Log::warning('Phone update skipped', ['uid' => $createdUser->uid, 'error' => $e->getMessage()]);
            }

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'User created successfully',
                    'uid' => $createdUser->uid,
                    'phone' => $validated['phone'] ?? null,
                    'location' => $validated['location'] ?? null,
                ]);
            }

            return redirect()->route('signup')->with('success', 'Account created successfully. You can now sign in.');
        } catch (AuthException|FirebaseException $e) {
            Log::error('Firebase registration failed', ['error' => $e->getMessage()]);

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Registration failed',
                    'error' => $e->getMessage(),
                ], 422);
            }

            return back()->withErrors(['email' => $e->getMessage()])->withInput();
        }
    }
}


