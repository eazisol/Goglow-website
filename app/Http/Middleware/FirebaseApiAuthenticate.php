<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Auth as FirebaseAuth;

class FirebaseApiAuthenticate
{
    protected FirebaseAuth $auth;

    public function __construct(FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming API request.
     * Validates Firebase ID token from Authorization header and attaches firebase_uid to request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json([
                'success' => false,
                'message' => 'Authorization token required',
            ], 401);
        }

        $idToken = substr($authHeader, 7); // Remove 'Bearer ' prefix

        try {
            $verifiedToken = $this->auth->verifyIdToken($idToken);
            $uid = $verifiedToken->claims()->get('sub');
            $email = $verifiedToken->claims()->get('email');

            // Attach firebase user info to request for use in controllers
            $request->merge([
                'firebase_uid' => $uid,
                'firebase_email' => $email,
            ]);

            return $next($request);
        } catch (\Throwable $e) {
            Log::warning('Firebase API authentication failed', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired authentication token',
            ], 401);
        }
    }
}
