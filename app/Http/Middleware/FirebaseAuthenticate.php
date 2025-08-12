<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FirebaseAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('firebase_uid')) {
            $redirect = $request->fullUrl();
            return redirect()->route('login', ['redirect' => $redirect]);
        }

        return $next($request);
    }
}


