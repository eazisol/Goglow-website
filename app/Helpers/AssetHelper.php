<?php

namespace App\Helpers;

/**
 * Asset Helper for versioned cache busting
 * 
 * This helper generates versioned asset URLs to bust browser cache
 * on deployment while allowing normal caching between deploys.
 */
class AssetHelper
{
    /**
     * Generate a versioned asset URL
     * 
     * Appends a version query parameter to the asset URL.
     * The version is read from config/version.php and only changes on deployment.
     * 
     * @param string $path The asset path relative to public directory
     * @return string The full asset URL with version query parameter
     * 
     * @example
     * AssetHelper::versioned('css/style.css')
     * // Returns: https://example.com/css/style.css?v=1.0.0
     */
    public static function versioned(string $path): string
    {
        $version = config('version.assets', '1.0.0');
        return asset($path) . '?v=' . $version;
    }
}
