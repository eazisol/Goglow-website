@extends('layouts.main')
{{-- Title --}}
@section('title', 'home')

{{-- Style Files --}}
@section('styles')
<link rel="stylesheet" href="{{ asset('css/search.css') }}">

@endsection

{{-- Content --}}
@section('content')
    <!-- Hero Section Start -->
    <div class="hero hero-bg-image bg-section dark-section parallaxie">
        <!-- Hero Section Start -->
        <div class="hero-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col" style="text-align: center;justify-content: center;display: flex;">
                        <!-- Hero Content Start -->
                        <div class="hero-content" style="width: 80%;">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h1 class="text-anime-style-2" >{{ __('app.home.hero_title') }}</h1>
                                <h3 class="wow fadeInUp">{{ __('app.home.hero_subtitle') }}</h3>
                                <div class="search-bar">
                                    <form action="{{ route('search') }}" method="GET" class="search-form">
                                        <div class="search-inputs">
                                            <div class="search-item">
                                                <i class="fas fa-search"></i>
                                                <div class="input-text">
                                                    <h5>{{ __('app.home.search_input_text') }}</h5>
                                                    <input type="text" id="searchInput" placeholder="{{ __('app.home.search_service_placeholder') }}" name="search" required>
                                                </div>
                                            </div>
                                            
                                            <div class="search-item">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <div class="input-text">
                                                    <h5>Or</h5>
                                                    <input type="text" id="locationInput" placeholder="{{ __('app.home.search_location_placeholder') }}" name="location">
                                                </div>
                                            </div>
                                            
                                            <button type="submit" class="search-button">{{ __('app.home.search_button') }}</button>

                                            <script>
                                                document.getElementById('searchInput').addEventListener('input', function() {
                                                    const searchValue = this.value.toLowerCase();
                                                    const locationInput = document.getElementById('locationInput');
                                                    
                                                    // Make an API call to check if the search term matches any provider names
                                                    fetch('https://us-central1-beauty-984c8.cloudfunctions.net/searchProviders')
                                                        .then(response => response.json())
                                                        .then(providers => {
                                                            const isProvider = providers.some(provider => 
                                                                provider.ownerName.toLowerCase().includes(searchValue)
                                                            );
                                                            
                                                            // If searching for a provider, location is not required
                                                            locationInput.required = !isProvider;
                                                            locationInput.placeholder = isProvider ? 
                                                                "{{ __('app.home.search_location_optional') }}" : 
                                                                "{{ __('app.home.search_location_placeholder') }}";
                                                        });
                                                });
                                            </script>
                                        </div>
                                    </form>
                                </div>
                                {{-- <p class="wow fadeInUp" data-wow-delay="0.2s">Every detail is thoughtfully designed to help you unwind—from the tranquil ambiance to our skilled therapists and holistic treatments. Whether you seek deep relaxation, skin rejuvenation, or stress relief, we offer a personalized experience.</p> --}}
                            </div>
                            <!-- Section Title End -->

                            <!-- Hero Button Start -->
                            <div class="wow fadeInUp" data-wow-delay="0.4s" style="gap: 22px; display: inline-flex;">
                                {{-- <a href="{{ url('/search') }}" class="btn-default btn-highlighted">{{ __('app.home.book_appointment_button') }}</a> --}}
                                <a href="{{ url('/search') }}" class="btn-default border-btn">{{ __('app.home.our_services_button') }}</a>
                            </div>
                            <!-- Hero Button End -->
                        </div>
                        <!-- Hero Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--Download app overlap section start-->
    <div class="overlap-box">                     
        <h1 class="text-anime-style-2">{{ __('app.home.get_app_title') }}</h1>
            <!-- Buttons -->
        <div class="app-button">
            <a href="#">
            <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" alt="Download on App Store" style="height: 50px;">
            </a>
            <a href="#">
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Get it on Google Play" style="height: 50px;">
            </a>
        </div>

        <p class="app-download-p" data-wow-delay="0.2s">{{ __('app.home.get_app_description') }}</p>
    </div>
    <!--Download app overlap section end-->
    
    <!-- Hero Section End -->
        <!-- Why Choose Us Section Start -->
        {{-- <div class="why-choose-us">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <!-- Why Choose Content Start -->
                        <div class="why-choose-content">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">{{ __('app.home.why_choose_title') }}</h3>
                                <h2 class="text-anime-style-2" >{{ __('app.home.why_choose_subtitle') }}</h2>
                                <p class="wow fadeInUp" data-wow-delay="0.2s">
                                    {{ __('app.home.why_choose_description') }}
                                </p>
                            </div>
                            <!-- Section Title End -->
                            
                            <!-- Why Choose Item List Start -->
                            <div class="why-choose-item-list">
                                <!-- Why Choose Item Start -->
                                <div class="why-choose-item wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="why-choose-item-header">
                                        <div class="icon-box">
                                            <img src="images/icon-why-choose-1.svg" alt="">
                                        </div>
                                        <div class="why-choose-item-title">
                                            <h3>{{ __('app.home.all_in_one_title') }}</h3>
                                        </div>
                                    </div>
                                    <div class="why-choose-item-content">
                                        <p>{{ __('app.home.all_in_one_description') }}</p>
                                    </div>
                                </div>
                                <!-- Why Choose Item End -->
                                
                                <!-- Why Choose Item Start -->
                                <div class="why-choose-item wow fadeInUp" data-wow-delay="0.6s">
                                    <div class="why-choose-item-header">
                                        <div class="icon-box">
                                            <img src="images/icon-why-choose-2.svg" alt="">
                                        </div>
                                        <div class="why-choose-item-title">
                                            <h3>{{ __('app.home.trusted_partners_title') }}</h3>
                                        </div>
                                    </div>
                                    <div class="why-choose-item-content">
                                        <p>{{ __('app.home.trusted_partners_description') }}</p>
                                    </div>
                                </div>
                                <!-- Why Choose Item End -->    
                            </div>
                            <!-- Why Choose Item List End -->
                        </div>
                        <!-- Why Choose Content End -->
                    </div>

                    <div class="col-lg-6">
                        <!-- Why Choose Images Start -->
                        <div class="why-choose-image">
                            <figure class="image-anime">
                                <img src="images/kimia-kazemi-u93nTfWqR9w-unsplash.jpg" alt="">
                            </figure>

                            <!-- Contact Us Circle Start -->
                            <div class="contact-us-circle">
                                <a href="{{ url('/contact-us') }}">
                                    <img src="images/contact-us-circle.svg" alt="">
                                </a>
                            </div>
                            <!-- Contact Us Circle End -->
                        </div>
                        <!-- Why Choose Images End -->
                    </div>
                </div>
            </div>
        </div> --}}

    <!-- Why Choose Us Section End -->

    <!-- Our Services Section Start -->
    <div class="our-services bg-section dark-section">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        
                        <h2 class="text-anime-style-2" >{{ __('app.home.glowees_love_title') }}</h2>
                        <hr>
                        <h3 class="wow fadeInUp">{{ __('app.home.glowees_love_subtitle') }}</h3>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row service-list">
                <div class="col-lg-4 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item active wow fadeInUp">
                        <div class="icon-box">
                            <img src="images/icon-service-1.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3>{{ __('app.home.get_inspired_title') }}</h3>
                            <p>{{ __('app.home.get_inspired_description') }}</p>
                        </div>
                        
                        {{-- <div class="service-btn">
                            <a href="{{ url('/service-detail') }}" class="readmore-btn">view more</a>
                        </div> --}}
                    </div>
                    <!-- Service Item End -->
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="images/icon-service-2.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3>{{ __('app.home.find_glowers_title') }}</h3>
                            <p>{{ __('app.home.find_glowers_description') }}</p>
                        </div>
                        {{-- <div class="service-item-list">
                            <ul>
                                <li>Skin Soul Shine</li>
                                <li>Your skin, only better.</li>
                            </ul>
                        </div> --}}
                        {{-- <div class="service-btn">
                            <a href="{{ url('/service-detail') }}" class="readmore-btn">view more</a>
                        </div> --}}
                    </div>
                    <!-- Service Item End -->
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="images/icon-service-3.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3>{{ __('app.home.make_appointment_title') }}</h3>
                            <p>{{ __('app.home.make_appointment_description') }}</p>
                        </div>
                        
                        {{-- <div class="service-btn">
                            <a href="{{ url('/service-detail') }}" class="readmore-btn">view more</a>
                        </div> --}}
                    </div>
                    <!-- Service Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item active wow fadeInUp">
                        <div class="icon-box">
                            <img src="images/icon-service-1.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3>{{ __('app.home.custom_engine_title') }}</h3>
                            <p>{{ __('app.home.custom_engine_description') }}</p>
                        </div>
                        
                        {{-- <div class="service-btn">
                            <a href="{{ url('/service-detail') }}" class="readmore-btn">view more</a>
                        </div> --}}
                    </div>
                    <!-- Service Item End -->
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="images/icon-service-2.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3>{{ __('app.home.secure_payment_title') }}</h3>
                            <p>{{ __('app.home.secure_payment_description') }}</p>
                        </div>
                        
                        {{-- <div class="service-btn">
                            <a href="{{ url('/service-detail') }}" class="readmore-btn">view more</a>
                        </div> --}}
                    </div>
                    <!-- Service Item End -->
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="images/icon-service-3.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3>{{ __('app.home.ultra_fast_title') }}</h3>
                            <p>{{ __('app.home.ultra_fast_description') }}</p>
                        </div>
                        
                        {{-- <div class="service-btn">
                            <a href="{{ url('/service-detail') }}" class="readmore-btn">view more</a>
                        </div> --}}
                    </div>
                    <!-- Service Item End -->
                </div>
                
            </div>            
        </div>
    </div>
    <!-- Our Services Section End -->
   <!-- What We Do Section Start -->
    <div class="what-we-do bg-section" style="background-color: initial;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- What We Do Content Start -->
                    <div class="what-we-do-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ __('app.home.how_it_works_title') }}</h3>
                            <h2 class="text-anime-style-2" >{{ __('app.home.how_it_works_subtitle') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('app.home.how_it_works_description') }}</p>
                        </div>
                        <!-- Section Title End -->
                        
                        <!-- What We Do Button Start -->
                        <div class="what-we-do-btn wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ url('/contact-us') }}" class="btn-default">{{ __('app.home.contact_us_button') }}</a>
                        </div>
                        <!-- What We Do Button End -->
                    </div>
                    <!-- What We Do Content End -->
                </div>

                <div class="col-lg-6">
                    <!-- What We Do Item List Start -->
                    <div class="what-we-do-item-list">
                        <!-- What We Do Item Start -->
                        <div class="what-we-do-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="images/icon-what-we-do-1.svg" alt="">
                            </div>
                            <div class="what-do-item-content">
                                <h3>{{ __('app.home.explore_services_title') }}</h3>
                                <p>{{ __('app.home.explore_services_description') }}</p>
                            </div>
                        </div>
                        <!-- What We Do Item End -->
                        
                        <!-- What We Do Item Start -->
                        <div class="what-we-do-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-box">
                                <img src="images/icon-what-we-do-2.svg" alt="">
                            </div>
                            <div class="what-do-item-content">
                                <h3>{{ __('app.home.choose_service_title') }}</h3>
                                <p>{{ __('app.home.choose_service_description') }}</p>
                            </div>
                        </div>
                        <!-- What We Do Item End -->
                        
                        <!-- What We Do Item Start -->
                        <div class="what-we-do-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="images/icon-service-1.svg" alt="">
                            </div>
                            
                            <div class="what-do-item-content">
                                <h3>{{ __('app.home.shine_title') }}</h3>
                                <p>{{ __('app.home.shine_description') }}</p>
                            </div>
                        </div>
                        <!-- What We Do Item End -->
                        
                    </div>
                    <!-- What We Do Item List End -->
                </div>
            </div>
        </div>
    </div>
    <!-- What We Do Section End -->    



    <!-- Our Testimonial Section Start -->
    <div class="our-testimonials bg-section dark-section">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ __('app.home.testimonials_title') }}</h3>
                        <h2 class="text-anime-style-2" >{{ __('app.home.testimonials_subtitle') }}</h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-lg-6">
                    <!-- Satisfy Client Box Start -->
                    <div class="satisfy-client-box wow fadeInUp" data-wow-delay="0.2s">
                        <!-- Satisfy Client Images Start -->
                        <div class="satisfy-client-images">
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="images/satisfy-client-img-1.jpg" alt="">
                                </figure>
                            </div>
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="images/satisfy-client-img-2.jpg" alt="">
                                </figure>
                            </div>
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="images/satisfy-client-img-3.jpg" alt="">
                                </figure>
                            </div>
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="images/satisfy-client-img-4.jpg" alt="">
                                </figure>
                            </div>
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="images/satisfy-client-img-5.jpg" alt="">
                                </figure>
                            </div>
                        </div>
                        <!-- Satisfy Client Images End -->
                        
                        <!-- Google Rating Content Start -->
                        <div class="goolge-rating-content">
                            <div class="icon-rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p>4.9 (29K Reviews)</p>
                        </div>
                        <!-- Google Rating Content End -->
                    </div>
                    <!-- Satisfy Client Box End -->
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-5">
                    <!-- Our Testimonial Image Start -->
                    <div class="testimonial-image">
                        <figure class="image-anime reveal">
                            <img src="images/shari-sirotnak-oM5YoMhTf8E-unsplash.jpg" alt="">
                        </figure>

                        <!-- Google Rating Box Start -->
                        <div class="goolge-rating-box">
                            <div class="icon-box">
                                <img src="images/icon-google.svg" alt="">
                            </div>
                            
                            <!-- Google Rating Content Start -->
                            <div class="goolge-rating-content">
                                <div class="icon-rating">
                                    <p>4.5</p>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <p>4.9 (29K Reviews)</p>
                            </div>
                            <!-- Google Rating Content End -->
                        </div>
                        <!-- Google Rating Box End -->
                    </div>
                    <!-- Our Testimonial Image End -->
                </div>

                <div class="col-lg-7">
                    <!-- Testimonial Slider Start -->
                    <div class="testimonial-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper" data-cursor-text="Drag">
                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-header">
                                            <div class="testimonial-company-logo">
                                                <img src="images/company-logo-white-1.svg" alt="">
                                            </div>
                                            <div class="testimonial-quote">
                                                <img src="images/testimonial-quote.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="testimonial-content">
                                            <p>
                                                Booking through this platform was so easy and smooth. I found a great salon near me, picked a convenient time, and was impressed by the professionalism from start to finish. The service was top-notch, and I walked out feeling refreshed and confident.
                                            </p>
                                        </div>

                                        <div class="testimonial-author">       
                                            <div class="author-image">
                                                <figure class="image-anime">
                                                    <img src="images/author-1.jpg" alt="">
                                                </figure>
                                            </div>
                                            <div class="author-content">
                                                <h3>Jenny Wilson</h3>
                                                <p>Senior Esthetician</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->
                                
                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-header">
                                            <div class="testimonial-company-logo">
                                                <img src="images/company-logo-white-1.svg" alt="">
                                            </div>
                                            <div class="testimonial-quote">
                                                <img src="images/testimonial-quote.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="testimonial-content">
                                            <p>
                                                Booking through this platform was so easy and smooth. I found a great salon near me, picked a convenient time, and was impressed by the professionalism from start to finish. The service was top-notch, and I walked out feeling refreshed and confident.
                                            </p>
                                        </div>

                                        <div class="testimonial-author">       
                                            <div class="author-image">
                                                <figure class="image-anime">
                                                    <img src="images/author-2.jpg" alt="">
                                                </figure>
                                            </div>
                                            <div class="author-content">
                                                <h3>Juliana Silva</h3>
                                                <p>Wellness Coach</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->
                                
                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-header">
                                            <div class="testimonial-company-logo">
                                                <img src="images/company-logo-white-1.svg" alt="">
                                            </div>
                                            <div class="testimonial-quote">
                                                <img src="images/testimonial-quote.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="testimonial-content">
                                            <p>
                                                Booking through this platform was so easy and smooth. I found a great salon near me, picked a convenient time, and was impressed by the professionalism from start to finish. The service was top-notch, and I walked out feeling refreshed and confident.
                                            </p>
                                        </div>

                                        <div class="testimonial-author">       
                                            <div class="author-image">
                                                <figure class="image-anime">
                                                    <img src="images/author-3.jpg" alt="">
                                                </figure>
                                            </div>
                                            <div class="author-content">
                                                <h3>Nicky Waode</h3>
                                                <p>Facial Expert</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->
                            </div>
                            <div class="testimonial-btn">
                                <div class="testimonial-button-prev"></div>
                                <div class="testimonial-button-next"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial Slider End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Testimonial Section End -->


    <!-- Our Partners Section Start -->
    <div class="our-partners bg-section" style="background-color: initial;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Our Partners Content Start -->
                    <div class="our-partners-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ __('app.home.partners_title') }}</h3>
                            <h2 class="text-anime-style-2" >{{ __('app.home.partners_subtitle') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('app.home.partners_description') }}</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- How It Work Button Start -->
                        <div class="our-partner-btn wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ url('/book-appointment') }}" class="btn-default">{{ __('app.home.book_appointment_partners') }}</a>
                        </div>
                        <!-- How It Work Button End -->
                    </div>
                    <!-- Our Partners Content End -->
                </div>

                <div class="col-lg-6">
                    <!-- Our Partners List Start -->
                    <div class="our-partners-list">
                        <!-- Our Partner Item Start -->
                        <div class="our-partner-item wow fadeInUp">
                            <img src="images/partner-logo-1.svg" alt="">
                        </div>
                        <!-- Our Partner Item End -->

                        <!-- Our Partner Item Start -->
                        <div class="our-partner-item wow fadeInUp" data-wow-delay="0.2s">
                            <img src="images/partner-logo-2.svg" alt="">
                        </div>
                        <!-- Our Partner Item End -->

                        <!-- Our Partner Item Start -->
                        <div class="our-partner-item wow fadeInUp" data-wow-delay="0.4s">
                            <img src="images/partner-logo-3.svg" alt="">
                        </div>
                        <!-- Our Partner Item End -->

                        <!-- Our Partner Item Start -->
                        <div class="our-partner-item wow fadeInUp" data-wow-delay="0.6s">
                            <img src="images/partner-logo-4.svg" alt="">
                        </div>
                        <!-- Our Partner Item End -->

                        <!-- Our Partner Item Start -->
                        <div class="our-partner-item wow fadeInUp" data-wow-delay="0.8s">
                            <img src="images/partner-logo-5.svg" alt="">
                        </div>
                        <!-- Our Partner Item End -->

                        <!-- Our Partner Item Start -->
                        <div class="our-partner-item wow fadeInUp" data-wow-delay="1s">
                            <img src="images/partner-logo-6.svg" alt="">
                        </div>
                        <!-- Our Partner Item End -->

                        <!-- Our Partner Item Start -->
                        <div class="our-partner-item wow fadeInUp" data-wow-delay="1.2s">
                            <img src="images/partner-logo-7.svg" alt="">
                        </div>
                        <!-- Our Partner Item End -->
                    </div>
                    <!-- Our Partners List Start -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Partners Section End -->


     
   
    <div class="our-pricing bg-section dark-section">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h2 class="text-anime-style-2" >{{ __('app.home.want_to_shine_title') }}</h2>
                        <hr>
                        <h3 class="wow fadeInUp">{{ __('app.home.discover_trends_subtitle') }}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-box wow fadeInUp">
                        <div class="pricing-header" style="border-bottom: initial;margin-bottom: initial;padding-bottom: initial;">
                            <p>🔥 POPULAR</p>
                        </div>
                        <div class="pricing-content">
                            <div class="pricing-header" style="display: flex; justify-content: space-between;">
                                <h3 style="word-wrap: break-word; overflow-wrap: break-word; white-space: normal;">Your very long heading text</h3>
                                <p>$30</p>
                            </div>
                            <p>We believe great design is more than just visuals — it's a feeling. </p>
                        </div>
                        <div class="pricing-list" style="margin-bottom: 20px;">
                            <ul>
                                <li>Full Body Scrub</li>
                                <li>Detoxifying Body Wrap</li>
                                <li>Hydrating Body Wrap</li>
                            </ul>
                        </div>
                        <div class="pricing-btn" style="margin-bottom: initial;">
                            <a href="" class="btn-default">
                                <i class="fa-solid fa-calendar-days" style="margin-right: 8px;"></i> To book
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-box highlighted-box wow fadeInUp" data-wow-delay="0.2s">
                        <div class="pricing-header" style="border-bottom: initial;margin-bottom: initial;padding-bottom: initial;">
                            <p>🔥 POPULAR</p>
                        </div>
                        <div class="pricing-content">
                            <div class="pricing-header" style="display: flex; justify-content: space-between;">
                                <h3 style="word-wrap: break-word; overflow-wrap: break-word; white-space: normal;">Your very long heading text</h3>
                                <h3>$30</h3>
                            </div>
                            {{-- <h2>$49 <span>Monthly</span></h2> --}}
                            <p>We believe great design is more than just visuals — it's a feeling. </p>
                        </div>
                         <div class="pricing-list" style="margin-bottom: 20px;">
                            <ul>
                                <li>Full Body Scrub</li>
                                <li>Detoxifying Body Wrap</li>
                                <li>Hydrating Body Wrap</li>
                            </ul>
                        </div>
                        <div class="pricing-btn" style="margin-bottom: initial;">
                            <a href="" class="btn-default">
                                <i class="fa-solid fa-calendar-days" style="margin-right: 8px;"></i> To book
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-box wow fadeInUp" data-wow-delay="0.4s">
                        <div class="pricing-header" style="border-bottom: initial;margin-bottom: initial;padding-bottom: initial;">
                            <p>🔥 POPULAR</p>
                        </div>
                        <div class="pricing-content">
                            <div class="pricing-header" style="display: flex; justify-content: space-between;">
                                <h3 style="word-wrap: break-word; overflow-wrap: break-word; white-space: normal;">Your very long heading text</h3>
                                <h3>$30</h3>
                            </div>
                            <p>We believe great design is more than just visuals — it's a feeling. </p>
                        </div>
                        <div class="pricing-list" style="margin-bottom: 20px;">
                            <ul>
                                <li>Full Body Scrub</li>
                                <li>Detoxifying Body Wrap</li>
                                <li>Hydrating Body Wrap</li>
                            </ul>
                        </div>
                        <div class="pricing-btn" style="margin-bottom: initial;">
                            <a href="" class="btn-default">
                                <i class="fa-solid fa-calendar-days" style="margin-right: 8px;"></i> To book
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="pricing-benefit-list wow fadeInUp" data-wow-delay="0.6s">
                        <ul>
                            <li><img src="images/icon-pricing-benefit-1.svg" alt="">Get 30 day free trial</li>
                            <li><img src="images/icon-pricing-benefit-2.svg" alt="">No any hidden fees pay</li>
                            <li><img src="images/icon-pricing-benefit-3.svg" alt="">You can cancel anytime</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- app --}}
    <section style="padding: 60px 0;">
        <div class="app-cta" style="max-width: 1200px; margin: auto; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 40px;">
            
            <!-- Left: Mobile App Image -->
                <div class="mobile-image" style="flex: 1; text-align: center; ">
                <img src="images/app5.png" alt="GoGlow App">
                </div>
            
            <!-- Right: Content -->
            <div class="app-section-content" style="flex: 1; max-width: 550px;">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ __('app.home.join_us_title') }}</h3>
                            <h2 class="text-anime-style-2" >{{ __('app.home.get_app_title') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">{{ __('app.home.get_app_description') }}</p>
                        </div>

            <!-- Buttons -->
            <div class="app-section-button" style="display:flex; gap: 20px; margin-bottom: 30px; flex-wrap: wrap; justify-content: center;">
                <a href="https://apps.apple.com/pk/app/goglow-app/id6743101981">
                <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" alt="Download on App Store" style="height: 50px;">
                </a>
                <a href="#">
                <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Get it on Google Play" style="height: 50px;">
                </a>
            </div>

            <!-- Feature List -->
                    <ul class="feature-list">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ __('app.home.find_salons_near') }}</span>
                        </li>
                        <li>
                            <i class="far fa-calendar"></i>
                            <span>{{ __('app.home.schedule_seconds') }}</span>
                        </li>
                        <li>
                            <i class="fas fa-star"></i>
                            <span>{{ __('app.home.rating_text') }}</span>
                        </li>
                    </ul>
            </div>

        </div>
    </section>

    {{-- app end --}}

@endsection



{{-- Scripts --}}
@section('scripts')


@endsection
