<?php

/**
 * Asset Version Configuration
 * 
 * This version string is appended to all CSS and JS assets as a query parameter
 * for cache busting. Update this value during deployment to force browsers to
 * download fresh copies of assets.
 * 
 * Usage in Blade templates:
 *   {{ \App\Helpers\AssetHelper::versioned('css/style.css') }}
 *   
 * Update methods:
 *   1. Run: php artisan version:bump (auto-increments patch version)
 *   2. Set ASSET_VERSION in .env file
 *   3. Manually edit this file
 */

return [
    'assets' => env('ASSET_VERSION', '1.0.2'),
];