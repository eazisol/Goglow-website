<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'firebase' => [
        'web_api_key' => env('FIREBASE_WEB_API_KEY'),
        'project_id' => env('FIREBASE_PROJECT_ID'),
        'auth_domain' => env('FIREBASE_AUTH_DOMAIN'),
        'cloud_functions_url' => env('FIREBASE_CLOUD_FUNCTIONS_URL', 'https://us-central1-beauty-984c8.cloudfunctions.net'),
    ],
    
    'stripe' => [
        // Test keys (used when isStripeLive = false)
        'test_key' => env('TEST_STRIPE_PUBLISHABLE_KEY'),
        'test_secret' => env('TEST_STRIPE_SECRET_KEY'),
        // Live keys (used when isStripeLive = true)
        'live_key' => env('LIVE_STRIPE_PUBLISHABLE_KEY'),
        'live_secret' => env('LIVE_STRIPE_SECRET_KEY'),
    ],

];
