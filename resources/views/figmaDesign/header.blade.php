    <!-- Navbar -->
  @php
    $isWhiteLabel = isset($whiteLabel) && $whiteLabel;
  @endphp
  <nav class="navbar {{ $isWhiteLabel ? 'navbar-white-label' : '' }}">
    <div class="logo">
              <!-- Logo Section -->
              <a href="{{ url('/') }}"><img src="{{ asset('images/images/LOGO-glaura-horizontal-couleur.png') }}" alt="GoGlow Logo" class="logo"></a>

    </div>

    @if(!$isWhiteLabel)
    <div class="menu" id="desktop-menu">
      <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}" @if(request()->is('/')) aria-current="page" @endif>{{ __('app.nav.home') }}</a>
      <span class="plus">+</span>
      {{-- <a href="#">{{ __('app.nav.about_us') }}</a>
      <span class="plus">+</span>
      <a href="#">{{ __('app.nav.services') }}</a>
      <span class="plus">+</span> --}}
      <a href="{{ url('/recherche') }}" class="{{ request()->is('recherche*') ? 'active' : '' }}" @if(request()->is('recherche*')) aria-current="page" @endif>{{ __('app.nav.book_service') }}</a>
      <span class="plus">+</span>
      <a href="{{ url('/blogs') }}">{{ __('app.nav.blogs') }}</a>
    </div>
    <div class="switcher-button">
          @include('partials.language-switcher')
          <a href="{{ url('/pro') }}" class="cta-btn">{{ __('app.nav.hero_section_button') }}<img src="{{ asset('images/images/Arrow_Right.svg') }}" alt="" width="16" height="16"></a>
          {{-- <button class="cta-btn">BECOME A GLOWER <img src="{{ asset('images/images/Arrow_Right.svg') }}" alt="" width="16" height="16"></button> --}}
          <button class="menu-icon" id="menu-toggle">
            <img src="{{ asset('images/images/Frame 1618873824.svg') }}" alt="Menu" class="menu-icon">
          </button>
          @if(session('firebase_uid'))
              {{-- Logged in: direct link to bookings --}}
              <a href="{{ route('my-bookings') }}" class="login-header-btn" style="text-decoration: none;">
                  <img src="{{ asset('images/images/flowbite_user-solid.svg') }}" alt="Profile" style="width:24px;">
                  <span>{{ __('app.nav.my_bookings') }}</span>
              </a>
          @elseif(!request()->is('pro') && !request()->is('pro/*'))
              {{-- Show login button for non-authenticated users (except on pro pages) --}}
              <button class="login-header-btn" id="header-login-btn" data-bs-toggle="modal" data-bs-target="#loginModal">
                  <img src="{{ asset('images/images/flowbite_user-solid.svg') }}" alt="Login" style="width:24px;">
                  <span>{{ __('app.auth.login') }}</span>
              </button>
          @endif
    </div>
    @else
    {{-- White-label mode: direct link to bookings if logged in, login modal if not --}}
    <div class="white-label-auth">
        @if(session('firebase_uid'))
            {{-- Logged in: direct link to bookings --}}
            <a href="{{ route('my-bookings') }}" class="login-header-btn" style="text-decoration: none;">
                <img src="{{ asset('images/images/flowbite_user-solid.svg') }}" alt="Profile" style="width:24px;">
                <span>{{ __('app.nav.my_bookings') }}</span>
            </a>
        @else
            {{-- Not logged in: open login modal --}}
            <button class="login-header-btn" id="header-login-btn-wl" data-bs-toggle="modal" data-bs-target="#loginModal">
                <img src="{{ asset('images/images/flowbite_user-solid.svg') }}" alt="Login" style="width:24px;">
                <span>{{ __('app.auth.login') }}</span>
            </button>
        @endif
    </div>
    @endif
  </nav>



  <!-- Sidebar for Mobile (hidden in white-label mode) -->
  @if(!$isWhiteLabel)
  <div class="sidebar" id="sidebar">
    <button class="close-btn" id="close-btn">
      <img src="{{ asset('images/images/Close.svg') }}" alt="close" style="width: 30px;">
    </button>
    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">{{ __('app.nav.home') }}</a>
    {{-- <a href="#">About Us</a>
    <a href="#">Services</a> --}}
    <a href="{{ url('/recherche') }}" class="{{ request()->is('recherche*') ? 'active' : '' }}">{{ __('app.nav.book_service') }}</a>
    <a href="{{ url('/blogs') }}">{{ __('app.nav.blogs') }}</a>
        <a href="https://glaura.typeform.com/carte-salons" class="mobile-sidebar-button">{{ __('app.nav.hero_section_button') }} <img src="{{ asset('images/images/Arrow_Right_white_color.svg') }}" alt="" width="16" height="16"></a>
    {{-- <button class="mobile-sidebar-button">BECOME A GLOWER <img src="{{ asset('images/images/Arrow_Right_white_color.svg') }}" alt="" width="16" height="16"></button> --}}
    <button class="cta-btn">BECOME A GLOWER →</button>
  </div>
  @endif


  <!-- Header JS is loaded from header.js -->

