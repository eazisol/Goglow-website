@php($isHome = request()->is('/') || request()->is('beauty-professional'))
<header class="{{ $isHome ? 'main-header bg-section header--transparent' : 'main-header-nav' }}">
		<div class="header-sticky">
			<nav class="navbar navbar-expand-lg">
				<div class="container-fluid">
					<a class="navbar-brand" href="{{ url('/') }}">
						<img src="images/WhatsApp_Image_2025-09-16_at_23.28.10_3ad6dde7-removebg-preview.png" alt="Logo" style="width: 125px;">
						{{-- <h1 class="text-anime-style-2 header-logo {{ $isHome ? 'text-white' : 'text-dark' }}" >Go<span>Glow</span></h1> --}}
					</a>
                    <a class="navbar-brand-mobile" href="{{ url('/') }}">
						<img src="images/Glow - mobile responsive.png" alt="Logo" style="width: 40px;">
						{{-- <h1 class="text-anime-style-2 header-logo {{ $isHome ? 'text-white' : 'text-dark' }}" >Go<span>Glow</span></h1> --}}
					</a>
					<div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            <ul class="navbar-nav mr-auto" id="menu"> 
								<li class="nav-item"><a class="nav-link text-white" href="{{ url('/search') }}">{{ __('app.nav.book_service') }}</a></li>                             
								<li class="nav-item"><a class="nav-link text-white" href="{{ url('/about') }}">{{ __('app.nav.about_us') }}</a>
								<li class="nav-item"><a class="nav-link text-white" href="{{ url('/contact-us') }}">{{ __('app.nav.contact_us') }}</a></li>
								{{-- <li class="nav-item highlighted-menu"><a class="nav-link {{ $isHome ? 'text-white' : 'text-dark' }}" href="{{ url('/book-appointment') }}">{{ __('app.nav.book_service') }}</a></li> --}}
                            </ul>
                        </div>
                        <div class="header-btn" style="display: contents;">
                            @include('partials.language-switcher')
                            @if(session('firebase_uid'))
                                <a href="#" class="btn-default {{ $isHome ? 'border-btn' : 'border-btn' }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="margin-right: 3px;">
                                {{ __('app.nav.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                    @csrf
                                </form>
                            @else
                                {{-- <a href="{{ url('/login') }}" class="btn-default {{ $isHome ? 'border-btn' : '' }}">Login</a>
                                <a href="{{ url('/signup') }}" class="btn-default {{ $isHome ? 'border-btn' : '' }}">Sign up</a> --}}
                            @endif
                            <a href="{{ url('/beauty-professional') }}" class="btn-default {{ $isHome ? 'btn-highlighted' : '' }}">{{ __('app.nav.hero_section_button') }}</a>
                        </div>
					</div>
                    <div class="mobile-actions d-lg-none" style="display:flex;align-items:center;margin-left:auto;">
                        @include('partials.language-switcher')
						<a href="{{ url('/beauty-professional') }}" class="btn-default border-btn">{{ __('app.nav.hero_section_button') }}</a>
					</div>
					<div class="navbar-toggle"></div>
				</div>
			</nav>
			<div class="responsive-menu"></div>
		</div>
	</header>