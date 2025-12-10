<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FirebaseAuthenticateModal
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('firebase_uid')) {
            // Use the stored book appointment URL if available, otherwise use the current URL
            $redirect = session('last_book_appointment_url', $request->fullUrl());
            
            // Check if request is AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'authenticated' => false,
                    'message' => 'Authentication required',
                    'redirect' => route('login', ['redirect' => $redirect])
                ], 401);
            }
            
            // For regular requests, show the auth modal via JavaScript
            // We'll set a session flag that will be checked in the layout to show the modal
            session()->flash('show_auth_modal', true);
            session()->flash('auth_redirect', $redirect);
            
            // For the book-appointment routes (both old format and slug-based), we want to allow access but show the modal via JavaScript
            $routeName = $request->route() ? $request->route()->getName() : null;
            if (strpos($request->path(), 'book-appointment') !== false || 
                $routeName === 'book-appointment.slug') {
                return $next($request);
            }
            
            // For other routes, return to the previous page
            return back();
        }

        return $next($request);
    }
}
