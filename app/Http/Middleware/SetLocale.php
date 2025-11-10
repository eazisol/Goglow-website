<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get available locales from config
        $availableLocales = config('app.available_locales', ['en', 'fr']);
        
        // Check for locale in URL parameter
        if ($request->has('lang')) {
            $locale = $request->get('lang');
            if (in_array($locale, $availableLocales)) {
                App::setLocale($locale);
                Session::put('locale', $locale);
            }
        }
        // Check for locale in session
        elseif (Session::has('locale')) {
            $locale = Session::get('locale');
            if (in_array($locale, $availableLocales)) {
                App::setLocale($locale);
            }
        }
        // Default to French
        else {
            App::setLocale('fr');
            Session::put('locale', 'fr');
        }

        return $next($request);
    }
}
