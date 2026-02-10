<!DOCTYPE html>
<html>
<head>

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-NFSQ4NS8');</script>
  <!-- End Google Tag Manager -->
    
  <title>Glaura - @yield('title')</title>
  @yield('styles')
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Awaiken">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	{{-- <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png"> --}}
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/svg+xml">

        {{-- new figma design --}}

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ __('app.meta.og_title') }}">
    <meta property="og:description" content="{{ __('app.meta.og_description') }}">





    {{-- ////////////////////////////////////// --}}
    {{-- Preconnect to external domains for faster loading --}}
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://js.stripe.com">
    
{{-- <link href="https://fonts.googleapis.com/css2?family=Satoshi:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> --}}
    
    {{-- CSS Files - Load in correct order --}}
    {{-- <link href="{{ \App\Helpers\AssetHelper::versioned('css/bootstrap.min.css') }}" rel="stylesheet" media="screen"> --}}
    <link href="{{ \App\Helpers\AssetHelper::versioned('css/fonts.css') }}" rel="stylesheet" media="screen">
    <link href="{{ \App\Helpers\AssetHelper::versioned('css/newdesign.css') }}" rel="stylesheet" media="screen">
    <link href="{{ \App\Helpers\AssetHelper::versioned('css/header.css') }}" rel="stylesheet" media="screen">
    <link href="{{ \App\Helpers\AssetHelper::versioned('css/form.css') }}" rel="stylesheet" media="screen">
    <link href="{{ \App\Helpers\AssetHelper::versioned('css/auth-modals.css') }}" rel="stylesheet" media="screen">
    
    {{-- External CSS (non-critical) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.6.6/css/flag-icons.min.css">

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
              
                  @yield('content')
                @if (!Route::is('terms_condition') && !Route::is('privacy_policy'))
                    @include('partials.footer-figma')
                @endif

                
                
         
    <!-- General JS Scripts -->
    
  {{-- <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/validator.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/jquery.slicknav.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/swiper-bundle.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/jquery.counterup.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/SmoothScroll.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/parallaxie.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/gsap.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/magiccursor.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/SplitText.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/ScrollTrigger.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/jquery.mb.YTPlayer.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/wow.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/function.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/datepicker.js') }}"></script> --}}



    {{-- JavaScript Files - Load in correct order --}}
    <script src="{{ \App\Helpers\AssetHelper::versioned('js/new-design.js') }}" defer></script>
    <script src="{{ \App\Helpers\AssetHelper::versioned('js/professional-form.js') }}" defer></script>
    <script src="{{ \App\Helpers\AssetHelper::versioned('js/header.js') }}" defer></script>
    <script src="{{ \App\Helpers\AssetHelper::versioned('js/auth-fetch.js') }}" defer></script>
    <script src="{{ \App\Helpers\AssetHelper::versioned('js/auth-modals.js') }}" defer></script>
    <script src="{{ \App\Helpers\AssetHelper::versioned('js/phone-auth.js') }}" defer></script>
    <script src="{{ \App\Helpers\AssetHelper::versioned('js/book-appointment-auth.js') }}" defer></script>

  {{-- External scripts - Moved to bottom and deferred for better performance --}}
  <!-- Datepicker - Deferred -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>

  {{-- Stripe.js - Deferred (loaded when needed) --}}
  <script src="https://js.stripe.com/v3/" defer></script>

  {{-- SweetAlert2 - Non-critical, loaded at bottom --}}
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" media="print" onload="this.media='all'">
  <noscript><link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet"></noscript>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

  {{-- Firebase JS SDK for OAuth --}}
  <script src="https://www.gstatic.com/firebasejs/11.3.0/firebase-app-compat.js" onerror="console.error('Failed to load firebase-app-compat.js')"></script>
  <script src="https://www.gstatic.com/firebasejs/11.3.0/firebase-auth-compat.js" onerror="console.error('Failed to load firebase-auth-compat.js')"></script>
  <script>
    // Initialize Firebase
    if (typeof firebase === 'undefined') {
      console.error('Firebase SDK not loaded!');
    } else {
      const apiKey = '{{ config("services.firebase.web_api_key") }}';
      const authDomain = '{{ config("services.firebase.auth_domain") }}';
      const projectId = '{{ config("services.firebase.project_id") }}';

      if (!apiKey || !authDomain || !projectId) {
        console.error('Firebase config values are missing!');
      } else {
        const firebaseConfig = {
          apiKey: apiKey,
          authDomain: authDomain,
          projectId: projectId,
        };

        try {
          if (firebase.apps.length === 0) {
            firebase.initializeApp(firebaseConfig);
          }
          window.firebaseAuth = firebase.auth();
        } catch (error) {
          console.error('Firebase initialization error:', error);
        }
      }
    }
  </script>

  @yield('scripts')
  
  @include('partials.auth-modals')
  
</body>
</html>
