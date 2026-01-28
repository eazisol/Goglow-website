<!DOCTYPE html>
<html>
<head>
    
  <title>Glaura - @yield('title')</title>
  @yield('styles')
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Awaiken">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
	<link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&amp;family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&amp;display=swap" rel="stylesheet">
{{-- <link href="{{ \App\Helpers\AssetHelper::versioned('css/bootstrap.min.css') }}" rel="stylesheet" media="screen"> --}}
<link href="{{ \App\Helpers\AssetHelper::versioned('css/slicknav.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ \App\Helpers\AssetHelper::versioned('css/swiper-bundle.min.css') }}">
<link href="{{ \App\Helpers\AssetHelper::versioned('css/all.min.css') }}" rel="stylesheet" media="screen">
<link href="{{ \App\Helpers\AssetHelper::versioned('css/animate.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ \App\Helpers\AssetHelper::versioned('css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ \App\Helpers\AssetHelper::versioned('css/mousecursor.css') }}">
<link href="{{ \App\Helpers\AssetHelper::versioned('css/custom.css') }}" rel="stylesheet" media="screen">
<link href="{{ \App\Helpers\AssetHelper::versioned('css/auth-modals.css') }}" rel="stylesheet" media="screen">
<link href="{{ \App\Helpers\AssetHelper::versioned('css/form.css') }}" rel="stylesheet" media="screen">
<link href="{{ \App\Helpers\AssetHelper::versioned('css/style.css') }}" rel="stylesheet" media="screen">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.6.6/css/flag-icons.min.css">


{{-- datepicker --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

{{-- Stripe.js --}}
<script src="https://js.stripe.com/v3/"></script>

<script>
    // Auth status for JS
    window.isAuthenticated = {{ session()->has('firebase_uid') ? 'true' : 'false' }};
    // window.showAuthModal = {{ session()->has('show_auth_modal') ? 'true' : 'false' }};
    window.authRedirect = "{{ session('auth_redirect', '') }}";
    
    // Make sure bootstrap is defined globally
    window.bootstrap = window.bootstrap || {};
    
    // Clean up old user_profile_synced keys from sessionStorage
    // Keep only the current logged-in user's key
    (function() {
        try {
            const currentUserId = {{ session()->has('firebase_uid') ? "'" . session('firebase_uid') . "'" : 'null' }};
            if (currentUserId) {
                const keysToRemove = [];
                for (let i = 0; i < sessionStorage.length; i++) {
                    const key = sessionStorage.key(i);
                    if (key && key.startsWith('user_profile_synced_') && !key.endsWith(currentUserId)) {
                        keysToRemove.push(key);
                    }
                }
                keysToRemove.forEach(key => {
                    sessionStorage.removeItem(key);
                    console.log('Cleaned up old sessionStorage key:', key);
                });
            } else {
                // If no user is logged in, clear all user_profile_synced keys
                const keysToRemove = [];
                for (let i = 0; i < sessionStorage.length; i++) {
                    const key = sessionStorage.key(i);
                    if (key && key.startsWith('user_profile_synced_')) {
                        keysToRemove.push(key);
                    }
                }
                keysToRemove.forEach(key => {
                    sessionStorage.removeItem(key);
                    console.log('Cleared sessionStorage key (no user logged in):', key);
                });
            }
        } catch (error) {
            console.error('Error cleaning up sessionStorage:', error);
        }
    })();
</script>
</head>
<body>
  <style>
    :root {
        --primary-color: {{ $theme['primary_color'] }};
        --secondary-color: {{ $theme['secondary_color'] }};
        --accent-secondary-color: {{ $theme['accent_secondary'] }};
        --bg-color: {{ $theme['bg_color'] }};
        --text-color: {{ $theme['text_color'] }};
        --accent-color: {{ $theme['accent_color'] }};
        --white-color: {{ $theme['white_color'] }};
        --divider-color: {{ $theme['divider_color'] }};
        --dark-divider-color: {{ $theme['dark_divider_color'] }};
        --error-color: {{ $theme['error_color'] }};
        /* --default-font: {{ $theme['default_font'] }};
        --accent-font: {{ $theme['accent_font'] }}; */
        --default-font: "DM Sans", sans-serif;
        --accent-font: "Lora", serif;
    }

    body {
    background-color: var(--bg-color);
    color: var(--text-color);
    font-family: var(--default-font);
    }

    .button {
        background-color: var(--primary-color);
        color: var(--white-color);
    }

    .feature-list {
    list-style: none;
    padding: 0;
    margin: 20px 0;
}

.feature-list li {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    color: #666;
    font-size: 14px;
}

.feature-list li i {
    width: 20px;
    margin-right: 10px;
    color: #666;
}

.feature-list li span {
    font-weight: 400;
}
.app-description {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 30px;
    color: #ccc;
}

/* Header color modes */
.header--solid {
  background: #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
.header--solid .nav-link,
.header--solid .header-logo {
  color: #1c1c1c !important;
}
.header--solid .header-btn .btn-default {
  background: #000 !important;
  color: #fff !important;
  border-color: #000 !important;
}
.header--solid .header-btn .btn-default:hover {
  background: #333 !important;
  border-color: #333 !important;
}
.header--transparent .nav-link,
.header--transparent .header-logo {
  color: #fff !important;
}
.text-white { color: #fff !important; }
.text-dark { color: #1c1c1c !important; }
</style>

    {{-- <div class="preloader">
		<div class="loading-container">
			<div class="loading"></div>
			<div id="loading-icon"><img src="{{ asset('images/loader.svg') }}" alt=""></div>
		</div>
	</div> --}}
    
    
                @if (!Route::is('terms_condition') && !Route::is('privacy_policy'))
                    @include('partials.header')
                @endif             
                  @yield('content')
                @if (!Route::is('terms_condition') && !Route::is('privacy_policy'))
                    @include('partials.footer')
                @endif

                
                
         
    <!-- General JS Scripts -->
    
    <script src="{{ \App\Helpers\AssetHelper::versioned('js/jquery-3.7.1.min.js') }}"></script>
  {{-- <script src="{{ \App\Helpers\AssetHelper::versioned('js/bootstrap.min.js') }}"></script> --}}
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/validator.min.js') }}"></script>
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/jquery.slicknav.js') }}"></script>
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/swiper-bundle.min.js') }}"></script>
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/jquery.counterup.min.js') }}"></script>
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/SmoothScroll.js') }}"></script>
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/parallaxie.js') }}"></script>
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/gsap.min.js') }}"></script>
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/magiccursor.js') }}"></script>
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/SplitText.js') }}"></script>
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/ScrollTrigger.min.js') }}"></script>
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/jquery.mb.YTPlayer.min.js') }}"></script>
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/wow.min.js') }}"></script>
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/function.js') }}"></script>
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/datepicker.js') }}"></script>
  <!-- Add in the head section -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<!-- Add before closing body tag -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ \App\Helpers\AssetHelper::versioned('js/professional-form.js') }}"></script>
  @yield('scripts')
  
  @include('partials.auth-modals')
  
  <!-- Country codes script must be loaded before auth-modals.js -->
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/country-codes.js') }}" onload="console.log('country-codes.js loaded successfully')" onerror="console.error('Failed to load country-codes.js')"></script>

  <!-- Header script for login button and sidebar -->
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/header.js') }}"></script>

  <!-- Auth fetch utility with automatic token refresh -->
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/auth-fetch.js') }}"></script>

  <!-- Auth modals script must be loaded after Bootstrap and modals are in the DOM -->
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/auth-modals.js') }}"></script>
  
  <!-- Book appointment auth script -->
  <script src="{{ \App\Helpers\AssetHelper::versioned('js/book-appointment-auth.js') }}"></script>
</body>
</html>
