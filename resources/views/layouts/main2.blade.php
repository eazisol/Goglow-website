<!DOCTYPE html>
<html>
<head>
    
  <title>GoGlow - @yield('title')</title>
  @yield('styles')
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Awaiken">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
        {{-- new figma design --}}

    <!-- Open Graph / Facebook -->
    <link href="{{ asset('css/newdesign.css') }}" rel="stylesheet" media="screen">  
    <meta property="og:type" content="website">
    <meta property="og:title" content="GoGlow - Book Beauty Services | Discover Local Salons">
    <meta property="og:description" content="Discover and book trusted salon services with GoGlow. Connect with local beauty professionals for hair, nails, skincare, and wellness treatments.">





    {{-- ////////////////////////////////////// --}}
	<link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&amp;family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&amp;display=swap" rel="stylesheet">
    {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" media="screen"> --}}
    {{-- <link href="{{ asset('css/slicknav.min.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}"> --}}
    {{-- <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" media="screen"> --}}
    {{-- <link href="{{ asset('css/animate.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/mousecursor.css') }}"> --}}
    {{-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet" media="screen"> --}}
    <link href="{{ asset('css/auth-modals.css') }}" rel="stylesheet" media="screen">
    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet" media="screen"> --}}
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



  {{-- new figma design scripts --}}
  <script src="{{ asset('js/new-design.js') }}"></script>


  <!-- Add in the head section -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<!-- Add before closing body tag -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/professional-form.js') }}"></script>
  @yield('scripts')
  
  {{-- @include('partials.auth-modals') --}}
  
  <!-- Auth modals script must be loaded after Bootstrap and modals are in the DOM -->
  <script src="{{ asset('js/auth-modals.js') }}"></script>
  <!-- Book appointment auth script -->
  <script src="{{ asset('js/book-appointment-auth.js') }}"></script>


</body>
</html>
