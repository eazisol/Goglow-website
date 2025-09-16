<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;

class LanguageHelper
{
    /**
     * Get current locale
     *
     * @return string
     */
    public static function getCurrentLocale()
    {
        return App::getLocale();
    }

    /**
     * Get available locales
     *
     * @return array
     */
    public static function getAvailableLocales()
    {
        return config('app.available_locales', ['en', 'fr']);
    }

    /**
     * Get locale name
     *
     * @param  string  $locale
     * @return string
     */
    public static function getLocaleName($locale)
    {
        $names = [
            'en' => 'English',
            'fr' => 'Français',
        ];

        return $names[$locale] ?? $locale;
    }

    /**
     * Get locale flag
     *
     * @param  string  $locale
     * @return string
     */
    public static function getLocaleFlag($locale)
    {
        $flags = [
            'en' => '🇺🇸',
            'fr' => '🇫🇷',
        ];

        return $flags[$locale] ?? '🌐';
    }

    /**
     * Switch locale
     *
     * @param  string  $locale
     * @return void
     */
    public static function switchLocale($locale)
    {
        $availableLocales = self::getAvailableLocales();
        
        if (in_array($locale, $availableLocales)) {
            App::setLocale($locale);
            session(['locale' => $locale]);
        }
    }

    /**
     * Check if locale is available
     *
     * @param  string  $locale
     * @return bool
     */
    public static function isLocaleAvailable($locale)
    {
        return in_array($locale, self::getAvailableLocales());
    }
}
