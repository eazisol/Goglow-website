# Web-to-Store Redirection Guide

Matches users who visit your website (e.g., `https://glaura.ai/sp?id=...`) to the app.
- **If App Installed**: Opens the app directly.
- **If App NOT Installed**: Redirects to App Store (iOS) or Play Store (Android).

## Implementation Instructions

**File to Edit**: `resources/views/service_provider_profile.blade.php`  
(Or specifically the file that handles the `/sp` route).

### Complete Code Snippet

Replace or update your Blade file with the following code. It is pre-configured with your specific **App IDs**.

```blade
@extends('layouts.app') 

<!-- 1. HEAD SECTION: Adds the iOS Smart App Banner -->
@section('head')
    <!-- This meta tag indicates to iOS Safari that this page is associated with your App Store App -->
    <!-- It creates the native "OPEN" banner at the top of the screen -->
    <meta name="apple-itunes-app" content="app-id=6743101981, app-argument=https://glaura.ai/sp?id={{ $spId }}">
@endsection

<!-- 2. BODY SECTION: Fallback Button & Auto-Redirect Script -->
@section('content')
    <div style="text-align: center; padding: 50px;">
        <h1>Opening Glaura App...</h1>
        <p>If the app doesn't open automatically, please tap the button below.</p>
        
        <!-- Manual Button (Backup for when auto-redirect doesn't fire) -->
        <a id="openButton" href="#" class="btn btn-primary" style="margin-top: 20px;">Open in App</a>
    </div>

    <script type="text/javascript">
        // --- CONFIGURATION ---
        var ANDROID_PACKAGE = 'com.salif.beautyapp'; 
        var IOS_APP_ID = '6743101981'; 
        var SCHEME = 'glaura';
        // Ensure $spId is passed from your Laravel Controller
        var spId = "{{ $spId }}"; 
        // ---------------------

        function redirect() {
            var userAgent = navigator.userAgent || navigator.vendor || window.opera;
            var isAndroid = /android/i.test(userAgent);
            var isIOS = /iPad|iPhone|iPod/.test(userAgent) && !window.MSStream;

            // Deep Link URL (Tries to open the app directly via custom scheme)
            var appDeepLink = SCHEME + '://sp?id=' + spId;
            
            // Store URLs (Where to go if app is missing)
            var playStoreLink = 'https://play.google.com/store/apps/details?id=' + ANDROID_PACKAGE;
            var appStoreLink = 'https://apps.apple.com/app/id' + IOS_APP_ID;

            // Update the Manual Button
            var btn = document.getElementById('openButton');
            if (isAndroid) {
                btn.href = appDeepLink; 
                btn.innerText = "Open App";
            } else if (isIOS) {
                // iOS: Button acts as a standard link; Smart Banner handles the rest
                btn.href = 'https://glaura.ai/sp?id=' + spId;
                btn.innerText = "Open App";
            } else {
                btn.style.display = 'none'; // Hide on Desktop
            }

            // --- ANDROID AUTO-REDIRECT LOGIC ---
            // 1. Try to open the app immediately.
            // 2. If the user is still on this page after 1.5 seconds, redirect to Play Store.
            if (isAndroid) {
                window.location.href = appDeepLink;
                setTimeout(function() {
                    if (!document.hidden) {
                        window.location.href = playStoreLink;
                    }
                }, 1500);
            }
            
            // --- iOS LOGIC ---
            // iOS is handled entirely by the 'apple-itunes-app' meta tag in the <head>.
            // That provides the most reliable "Smart Banner" experience.
        }

        // Run on page load
        window.onload = redirect;
    </script>
@endsection
```

### How It Works

1.  **Android**:
    *   The script runs immediately (`window.onload`).
    *   It tries to open `glaura://sp?id=...`.
    *   If the app opens, the browser is backgrounded, so the `setTimeout` code never runs (or runs when you return).
    *   If the app is **not** installed, the browser stays open, and after 1.5 seconds, it changes `window.location` to the Google Play Store URL.

2.  **iOS**:
    *   The `<meta name="apple-itunes-app"...>` tag is detected by Safari.
    *   Safari shows a small banner below the URL bar.
        *   If Installed: Button says **OPEN**.
        *   If Not Installed: Button says **GET** (or VIEW) and leads to the App Store.
    *   This is the standard Apple-approved method and avoids "Safari cannot open the page" errors.
