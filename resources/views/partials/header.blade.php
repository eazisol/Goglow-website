@php($isHome = request()->is('/'))
<header class="main-header {{ $isHome ? 'bg-section header--transparent' : 'header--solid' }}">
		<div class="header-sticky">
			<nav class="navbar navbar-expand-lg" style="margin-bottom: 23px;">
				<div class="container-fluid">
					<a class="navbar-brand" href="{{ url('/') }}">
						<img src="images/goglowlogo.png" alt="Logo" style="width: 60px;">
						{{-- <h1 class="text-anime-style-2 header-logo {{ $isHome ? 'text-white' : 'text-dark' }}" data-cursor="-opaque">Go<span>Glow</span></h1> --}}
					</a>
					<div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            <ul class="navbar-nav mr-auto" id="menu">
                                {{-- <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a> --}}
                                    {{-- <ul>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home - Main1</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/home-image') }}">Home - Image</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/home-video') }}">Home - Video</a></li>
                                    </ul> --}}
                                </li>   
								<li class="nav-item"><a class="nav-link {{ $isHome ? 'text-white' : 'text-dark' }}" href="{{ url('/search') }}">{{ __('app.nav.book_service') }}</a></li>                             
								<li class="nav-item"><a class="nav-link {{ $isHome ? 'text-white' : 'text-dark' }}" href="{{ url('/about') }}">{{ __('app.nav.about_us') }}</a>
                                
                                {{-- <li class="nav-item"><a class="nav-link" href="{{ url('/blogs') }}">Blog</a></li> --}}
                                {{-- <li class="nav-item submenu"><a class="nav-link" href="#">Pages</a>
                                    <ul>                                        
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/service-detail') }}">Service Details</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/blog-single') }}">Blog Details</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/case-study') }}">Case Study</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/case-study-single') }}">Case Study details</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/team') }}">Our Team</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/team-single') }}">Team Details</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/pricing') }}">Pricing Plan</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/testimonials') }}">Testimonials</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/image-gallery') }}">Image Gallery</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/video-gallery') }}">Video Gallery</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/faqs') }}">FAQs</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/404') }}">404</a></li>
                                    </ul>
                                </li> --}}
								<li class="nav-item"><a class="nav-link {{ $isHome ? 'text-white' : 'text-dark' }}" href="{{ url('/contact-us') }}">{{ __('app.nav.contact_us') }}</a></li>
								<li class="nav-item highlighted-menu"><a class="nav-link {{ $isHome ? 'text-white' : 'text-dark' }}" href="{{ url('/book-appointment') }}">{{ __('app.nav.book_service') }}</a></li>
                            </ul>
                        </div>
                        <div class="header-btn" style="display: contents;">
                            @include('partials.language-switcher')
                            @if(session('firebase_uid'))
                                <a href="#" class="btn-default {{ $isHome ? 'border-btn' : '' }}"
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
					<div class="navbar-toggle"></div>
				</div>
			</nav>
			<div class="responsive-menu"></div>
		</div>
	</header>