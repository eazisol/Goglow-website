@extends('layouts.main')
{{-- Title --}}
@section('title', 'home')

{{-- Style Files --}}
@section('styles')

@endsection


{{-- Content --}}
@section('content')
    <!-- Page Header Start -->
    <div class="page-header bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- About Us Section Start -->
    <div class="about-us">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-12">
                <!-- About Title Box Start -->
                <div class="about-title-box">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">About us</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">
                            A modern solution for effortless beauty — connecting you to trusted salons for a seamless <span>self-care experience</span>
                        </h2>
                    </div>
                    <!-- Section Title End -->

                    <!-- About Us Button Start -->
                    <div class="about-us-btn wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ url('/contact-us') }}" class="btn-default">contact us</a>
                    </div>
                    <!-- About Us Button End -->
                </div>
                <!-- About Title Box End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <!-- About Us Item Start -->
                <div class="about-us-item about-box-1 wow fadeInUp">
                    <div class="about-us-image">
                        <figure class="image-anime">
                            <img src="images/about-us-img-1.jpg" alt="">
                        </figure>
                    </div>
                    <div class="about-item-content">
                        <h3>Personalized Service Selection</h3>
                        <p>Whether it’s hair, nails, skin, or waxing—we help you find exactly what you need from top salons nearby.</p>
                    </div>
                </div>
                <!-- About Us Item End -->
            </div>

            <div class="col-lg-4 col-md-6">
                <!-- About Us Item Start -->
                <div class="about-us-item about-box-2 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="about-us-image">
                        <figure class="image-anime">
                            <img src="images/about-us-img-2.jpg" alt="">
                        </figure>
                    </div>
                    <div class="about-item-content">
                        <h3>Effortless Booking</h3>
                        <p>Book appointments online in just a few clicks—no calls, no hassle, just beauty on your schedule.</p>
                    </div>
                </div>
                <!-- About Us Item End -->
            </div>

            <div class="col-lg-4 col-md-6">
                <!-- About Us Item Start -->
                <div class="about-us-item about-box-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="about-us-image">
                        <figure class="image-anime">
                            <img src="images/about-us-img-3.jpg" alt="">
                        </figure>
                    </div>
                    <div class="about-item-content">
                        <h3>Trusted Beauty Partners</h3>
                        <p>We work only with verified, quality-focused salons to ensure every appointment exceeds expectations.</p>
                    </div>
                </div>
                <!-- About Us Item End -->
            </div>
        </div>
    </div>
</div>

    <!-- About Us Section End -->
    
    <!-- Our Approach Section Start -->
<div class="our-approach bg-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <!-- Approach Content Start -->
                <div class="approach-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Our approach</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">
                            Simplifying beauty with smart access to <span>trusted salons</span>
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">
                            We believe self-care should be simple, accessible, and enjoyable. That’s why we connect clients with professional salons through a seamless online experience—making booking beauty and grooming services easier than ever.
                        </p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Approach Image Start -->
                    <div class="approach-image">
                        <figure class="image-anime reveal">
                            <img src="images/prahant-designing-studio-USdbU5h4B-c-unsplash.jpg" alt="">
                        </figure>
                    </div>
                    <!-- Approach Image End -->
                </div>
                <!-- Approach Content End -->
            </div>

            <div class="col-lg-6">
                <!-- Approach List Box Start -->
                <div class="approach-list-box">
                    <!-- Approach Image Start -->
                    <div class="approach-image">
                        <figure class="image-anime reveal">
                            <img src="images/sunny-ng-KVIlNRoGwxk-unsplash.jpg" alt="">
                        </figure>
                    </div>
                    <!-- Approach Image End -->

                    <!-- Approach List Start -->
                    <div class="approach-list">
                        <!-- Mission -->
                        <div class="approach-list-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="images/icon-approach-1.svg" alt="">
                            </div>
                            <div class="approach-list-content">
                                <h3>Our mission</h3>
                                <p>To make salon services more accessible, convenient, and transparent by bridging the gap between clients and trusted beauty professionals.</p>
                            </div>
                        </div>

                        <!-- Vision -->
                        <div class="approach-list-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-box">
                                <img src="images/icon-approach-2.svg" alt="">
                            </div>
                            <div class="approach-list-content">
                                <h3>Our vision</h3>
                                <p>To become the go-to platform for effortless self-care by empowering users to discover, book, and enjoy top salon services in just a few taps.</p>
                            </div>
                        </div>

                        <!-- Goal -->
                        <div class="approach-list-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="images/icon-approach-3.svg" alt="">
                            </div>
                            <div class="approach-list-content">
                                <h3>Our goal</h3>
                                <p>To help every individual feel confident and cared for—whether it’s a quick touch-up or a full beauty transformation.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Approach List End -->
                </div>
                <!-- Approach List Box End -->
            </div>
        </div>
    </div>
</div>

    <!-- Our Approach Section End -->

    <!-- Intro Video Section Start -->
    {{-- <div class="intro-video dark-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Intro Video Box Start -->
                    <div class="intro-video-box">
                        <!-- Intro Video Image Start -->
                        <div class="intro-video-image">
                            <figure>
                                <img src="images/intro-video-image.jpg" alt="">
                            </figure>
                        </div>
                        <!-- Intro Video Image End -->

                        <!-- Intro Video Content Start -->
                        <div class="intro-video-content">
                            <!-- Video Play Button Start -->
                            <div class="video-play-button">
                                <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play">
                                    <i class="fa-solid fa-play"></i>
                                </a>
                            </div>
                            <!-- Video Play Button End -->

                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h2 class="text-anime-style-2" data-cursor="-opaque">Inspired by the harmony of nature and the soul's need for serenity, <span>detail nurtures your well-being.</span></h2>
                            </div>
                            <!-- Section Title End -->
                        </div>
                        <!-- Intro Video Content End -->                      
                    </div>
                    <!-- Intro Video Box End -->
                </div>

                <div class="col-lg-12">
                    <!-- Intro Video List Start -->
                    <div class="intro-video-list">
                        <!-- Intro Video List Item Start -->
                        <div class="intro-video-list-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="images/icon-intro-video-item-1.svg" alt="">
                            </div>
                            <div class="intro-video-item-content">
                                <p>Facial Treatments</p>
                            </div>
                        </div>
                        <!-- Intro Video List Item End -->
                        
                        <!-- Intro Video List Item Start -->
                        <div class="intro-video-list-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-box">
                                <img src="images/icon-intro-video-item-2.svg" alt="">
                            </div>
                            <div class="intro-video-item-content">
                                <p>Body Therapies</p>
                            </div>
                        </div>
                        <!-- Intro Video List Item End -->
                        
                        <!-- Intro Video List Item Start -->
                        <div class="intro-video-list-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="images/icon-intro-video-item-3.svg" alt="">
                            </div>
                            <div class="intro-video-item-content">
                                <p>Relaxation Rituals</p>
                            </div>
                        </div>
                        <!-- Intro Video List Item End -->
                        
                        <!-- Intro Video List Item Start -->
                        <div class="intro-video-list-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="images/icon-intro-video-item-4.svg" alt="">
                            </div>
                            <div class="intro-video-item-content">
                                <p>Holistic Wellness</p>
                            </div>
                        </div>
                        <!-- Intro Video List Item End -->
                        
                        <!-- Intro Video List Item Start -->
                        <div class="intro-video-list-item wow fadeInUp" data-wow-delay="0.8s">
                            <div class="icon-box">
                                <img src="images/icon-intro-video-item-5.svg" alt="">
                            </div>
                            <div class="intro-video-item-content">
                                <p>Herbal Remedies</p>
                            </div>
                        </div>
                        <!-- Intro Video List Item End -->
                    </div>
                    <!-- Intro Video List End -->
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Intro Video Section End -->

    <!-- Our Philosophy Section Start -->
    {{-- <div class="our-philosophy bg-section dark-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Philosophy Image Box Start -->
                    <div class="philosophy-image-box">
                        <!-- Philosophy Image Start -->
                        <div class="philosophy-image">
                            <figure class="image-anime reveal">
                                <img src="images/philosophy-image.jpg" alt="">
                            </figure>
                        </div>
                        <!-- Philosophy Image End -->
                        
                        <!-- Philosophy Counter List Start -->
                        <div class="philosophy-counter-list">
                            <!-- Philosophy Counter Item Start -->
                            <div class="philosophy-counter-item">
                                <h2><span class="counter">162</span>+</h2>
                                <p>Satisfied clients</p>
                            </div>
                            <!-- Philosophy Counter Item End -->
                            
                            <!-- Philosophy Counter Item Start -->
                            <div class="philosophy-counter-item">
                                <h2><span class="counter">80</span>+</h2>
                                <p>experienced staff</p>
                            </div>
                            <!-- Philosophy Counter Item End -->
                            
                            <!-- Philosophy Counter Item Start -->
                            <div class="philosophy-counter-item">
                                <h2><span class="counter">60</span>%</h2>
                                <p>Happy Customers</p>
                            </div>
                            <!-- Philosophy Counter Item End -->
                            
                            <!-- Philosophy Counter Item Start -->
                            <div class="philosophy-counter-item">
                                <h2><span class="counter">4.9</span></h2>
                                <p>Positive feedbacks</p>
                            </div>
                            <!-- Philosophy Counter Item End -->
                        </div>
                        <!-- Philosophy Counter List End -->
                    </div>
                    <!-- Philosophy Image Box End -->
                </div>
                
                <div class="col-lg-6">
                    <!-- Philosophy Content Start -->
                    <div class="philosophy-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Our philosophy</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Wellness embracing <span>it as a way of life</span></h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Trust is built through our unwavering commitment to your health and well-being. We combine expert knowledge with personalized care to deliver treatments that are not only effective but also deeply relaxing.</p>
                            <p class="wow fadeInUp" data-wow-delay="0.4s">At the heart of our philosophy lies a deep respect for your unique wellness journey. Every treatment is thoughtfully curated to harmonize mind, body, and spirit—blending time-honored techniques with modern expertise to create an experience that rejuvenates from within.</p>
                        </div>
                        <!-- Section Title End -->
                        
                        <!-- Philosophy Button Start -->
                        <div class="philosophy-btn wow fadeInUp" data-wow-delay="0.6s">
                            <a href="{{ url('/book-appointment') }}" class="btn-default btn-highlighted">book appointment</a>
                        </div>
                        <!-- Philosophy Button End -->
                    </div>
                    <!-- Philosophy Content End -->
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Our Philosophy Section End -->
    
    <!-- Why Choose Us Section Start -->
<div class="why-choose-us">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- Why Choose Content Start -->
                <div class="why-choose-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Why choose us</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Why our clients trust us for their <span>salon experiences</span></h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">
                            We bring all your beauty and grooming needs under one roof. Our trusted network of professional salons, transparent booking system, and quality-focused service help us deliver consistent satisfaction to every client.
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
                                    <h3>All-in-One Salon Platform</h3>
                                </div>
                            </div>
                            <div class="why-choose-item-content">
                                <p>From Hair to Nails, Skin to Waxing—book any service at top-rated salons near you, all in one place.</p>
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
                                    <h3>Trusted Salon Partners</h3>
                                </div>
                            </div>
                            <div class="why-choose-item-content">
                                <p>We partner only with licensed, well-reviewed salons to ensure you get quality care from skilled professionals.</p>
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
</div>
    <!-- Why Choose Us Section End -->

    <!-- What We Do Section Start -->
    {{-- <div class="what-we-do bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- What We Do Content Start -->
                    <div class="what-we-do-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">What we do</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Thoughtfully designed for your <span>ultimate comfort</span></h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">We've crafted every element of our spa to enhance your relaxation and deliver care. From soothing ambiance.</p>
                        </div>
                        <!-- Section Title End -->
                        
                        <!-- What We Do Button Start -->
                        <div class="what-we-do-btn wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ url('/contact-us') }}" class="btn-default">contact us</a>
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
                                <h3>Tranquil Ambience</h3>
                                <p>Clean, sanitized spaces that meet the highest standards of spa hygiene.</p>
                            </div>
                        </div>
                        <!-- What We Do Item End -->
                        
                        <!-- What We Do Item Start -->
                        <div class="what-we-do-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-box">
                                <img src="images/icon-what-we-do-2.svg" alt="">
                            </div>
                            <div class="what-do-item-content">
                                <h3>Skilled Therapists</h3>
                                <p>Clean, sanitized spaces that meet the highest standards of spa hygiene.</p>
                            </div>
                        </div>
                        <!-- What We Do Item End -->
                        
                        <!-- What We Do Item Start -->
                        <div class="what-we-do-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="images/icon-what-we-do-3.svg" alt="">
                            </div>
                            <div class="what-do-item-content">
                                <h3>Natural Products</h3>
                                <p>Clean, sanitized spaces that meet the highest standards of spa hygiene.</p>
                            </div>
                        </div>
                        <!-- What We Do Item End -->
                        
                        <!-- What We Do Item Start -->
                        <div class="what-we-do-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="images/icon-what-we-do-4.svg" alt="">
                            </div>
                            <div class="what-do-item-content">
                                <h3>Customized Treatme</h3>
                                <p>Clean, sanitized spaces that meet the highest standards of spa hygiene.</p>
                            </div>
                        </div>
                        <!-- What We Do Item End -->
                        
                        <!-- What We Do Item Start -->
                        <div class="what-we-do-item wow fadeInUp" data-wow-delay="0.8s">
                            <div class="icon-box">
                                <img src="images/icon-what-we-do-5.svg" alt="">
                            </div>
                            <div class="what-do-item-content">
                                <h3>Hygienic Facilities</h3>
                                <p>Clean, sanitized spaces that meet the highest standards of spa hygiene.</p>
                            </div>
                        </div>
                        <!-- What We Do Item End -->
                          
                        <!-- What We Do Item Start -->
                        <div class="what-we-do-item wow fadeInUp" data-wow-delay="1s">
                            <div class="icon-box">
                                <img src="images/icon-what-we-do-6.svg" alt="">
                            </div>
                            <div class="what-do-item-content">
                                <h3>Easy Online Booking</h3>
                                <p>Clean, sanitized spaces that meet the highest standards of spa hygiene.</p>
                            </div>
                        </div>
                        <!-- What We Do Item End -->
                    </div>
                    <!-- What We Do Item List End -->
                </div>
            </div>
        </div>
    </div> --}}
    <!-- What We Do Section End --> 

    <!-- Our Team Section Start -->
    {{-- <div class="our-team">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Expert team member</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">A team of trained professionals dedicated to <span>your comfort</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <!-- Team Item Start -->
                    <div class="team-item wow fadeInUp">
                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3><a href="{{ url('/team-single') }}">Adele Patkinson</a></h3>
                            <p>Spa Director</p>
                        </div>
                        <!-- Team Content End -->
                        
                        <!-- team Image Start -->
                        <div class="team-image">
                            <figure>
                                <img src="images/team-1.png" alt="">
                            </figure>
                        </div>
                        <!-- team Image End -->

                        <!-- Team Social List Start -->
                        <div class="team-social-list">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- Team Social List End -->
                    </div>
                    <!-- Team Item End -->
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <!-- Team Item Start -->
                    <div class="team-item wow fadeInUp" data-wow-delay="0.2s">
                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3><a href="{{ url('/team-single') }}">Jenny Wilson</a></h3>
                            <p>Senior Esthetician</p>
                        </div>
                        <!-- Team Content End -->

                        <!-- team Image Start -->
                        <div class="team-image">
                            <figure>
                                <img src="images/team-2.png" alt="">
                            </figure>
                        </div>
                        <!-- team Image End -->

                        <!-- Team Social List Start -->
                        <div class="team-social-list">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- Team Social List End -->
                    </div>
                    <!-- Team Item End -->
                </div>

                <div class="col-lg-3 col-md-6">
                    <!-- Team Item Start -->
                    <div class="team-item wow fadeInUp" data-wow-delay="0.4s">
                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3><a href="{{ url('/team-single') }}">Nicky Waode</a></h3>
                            <p>Facial Expert</p>
                        </div>
                        <!-- Team Content End -->

                        <!-- team Image Start -->
                        <div class="team-image">
                            <figure>
                                <img src="images/team-3.png" alt="">
                            </figure>
                        </div>
                        <!-- team Image End -->

                        <!-- Team Social List Start -->
                        <div class="team-social-list">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- Team Social List End -->
                    </div>
                    <!-- Team Item End -->
                </div>

                <div class="col-lg-3 col-md-6">
                    <!-- Team Item Start -->
                    <div class="team-item wow fadeInUp" data-wow-delay="0.6s">
                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3><a href="{{ url('/team-single') }}">Juliana Silva</a></h3>
                            <p>Wellness Coach</p>
                        </div>
                        <!-- Team Content End -->

                        <!-- team Image Start -->
                        <div class="team-image">
                            <figure>
                                <img src="images/team-4.png" alt="">
                            </figure>
                        </div>
                        <!-- team Image End -->

                        <!-- Team Social List Start -->
                        <div class="team-social-list">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- Team Social List End -->
                    </div>
                    <!-- Team Item End -->
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Our Team Section End -->

    <!-- Our Faqs Section Start -->
    {{-- <div class="our-faqs bg-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Faqs Content Start -->
                    <div class="faqs-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Frequently asked question</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Helpful answer for first-time & <span>returning guests</span></h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- FAQ Accordion Start -->
                        <div class="faq-accordion" id="faqaccordion">
                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp">
                                <h2 class="accordion-header" id="heading1">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        Q1. What should I wear to my spa appointment?
                                    </button>
                                </h2>
                                <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#faqaccordion">
                                    <div class="accordion-body">
                                        <p>For your comfort and relaxation, we recommend wearing loose, comfortable clothing that you can easily change out of for massage or body treatments you'll typically be draped with a towel.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.2s">
                                <h2 class="accordion-header" id="heading2">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                        Q2. Do I need to book in advance?
                                    </button>
                                </h2>
                                <div id="collapse2" class="accordion-collapse collapse show" aria-labelledby="heading2" data-bs-parent="#faqaccordion">
                                    <div class="accordion-body">
                                        <p>For your comfort and relaxation, we recommend wearing loose, comfortable clothing that you can easily change out of for massage or body treatments you'll typically be draped with a towel.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.4s">
                                <h2 class="accordion-header" id="heading3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                        Q3. What is your cancellation policy?
                                    </button>
                                </h2>
                                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#faqaccordion">
                                    <div class="accordion-body">
                                        <p>For your comfort and relaxation, we recommend wearing loose, comfortable clothing that you can easily change out of for massage or body treatments you'll typically be draped with a towel.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->    

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.6s">
                                <h2 class="accordion-header" id="heading4">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                        Q4. Are your products safe for sensitive skin?
                                    </button>
                                </h2>
                                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#faqaccordion">
                                    <div class="accordion-body">
                                        <p>For your comfort and relaxation, we recommend wearing loose, comfortable clothing that you can easily change out of for massage or body treatments you'll typically be draped with a towel.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->
                        </div>
                        <!-- FAQ Accordion End -->
                    </div>
                    <!-- Faqs Content End -->
                </div>
                
                <div class="col-lg-6">
                    <!-- Faqs Image Box Start -->
                    <div class="faqs-image-box">
                        <div class="faq-image">
                            <figure class="image-anime reveal">
                                <img src="images/faq-image.jpg" alt="">
                            </figure>
                        </div>

                        <!-- Faqs CTA Box Start -->
                        <div class="faqs-cta-box">
                            <div class="icon-box">
                                <img src="images/icon-faqs-cta.svg" alt="">
                            </div>
                            <div class="faqs-cta-box-content">
                                <h3>Relax, We've Got the Answers</h3>
                            </div>
                        </div>
                        <!-- Faqs CTA Box End -->
                    </div>
                    <!-- Faqs Image Box End -->
                </div>               
            </div>
        </div>
    </div> --}}
    <!-- Our Faqs Section End -->

    <!-- Join Us Section Start -->
    {{-- <div class="join-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-lg-1 order-2">
                    <!-- Join Us Image Start -->
                    <div class="join-us-image">
                        <figure>
                            <img src="images/hero-image.png" alt="">
                        </figure>
                    </div>
                    <!-- Join Us Image End -->
                </div>

                <div class="col-lg-6 order-lg-2 order-1">
                    <!-- Join Us Content Start -->
                    <div class="join-us-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Join us</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Healing touch, holistic care, <span>lasting wellness</span></h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">We offer more than just treatments - we deliver personalized wellness experiences designed to relax the body, refresh the mind, and restore inner balance.</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Join Us Item Box Start -->
                        <div class="join-us-item-box">
                            <!-- Join Us Item Start -->
                            <div class="join-us-item wow fadeInUp" data-wow-delay="0.4s">
                                <h3>Need Any Help?</h3>
                                <p>We believe great design is more than just visuals.</p>
                                <a href="{{ url('/contact-us') }}" class="btn-default">learn more</a>
                            </div>
                            <!-- Join Us Item End -->

                            <!-- Join Us Item Start -->
                            <div class="join-us-item wow fadeInUp" data-wow-delay="0.6s">
                                <ul>
                                    <li>Full Body Scrub</li>
                                    <li>Hydrating Body Wrap</li>
                                </ul>

                                <!-- Join Live Chat Start -->
                                <div class="join-live-chat">
                                    <div class="icon-box">
                                        <img src="images/icon-live-chat.svg" alt="">
                                    </div>
                                    <div class="join-live-chat-content">
                                        <h3>Live Chat</h3>
                                        <p>Connected Us</p>
                                    </div>
                                </div>
                                <!-- Join Live Chat End -->
                            </div>
                            <!-- Join Us Item End -->
                        </div>
                        <!-- Join Us Item Box End -->
                    </div>
                    <!-- Join Us Content End -->
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Join Us Section End -->

    <!-- Our Testimonial Section Start -->
    {{-- <div class="our-testimonials bg-section dark-section">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Testimonials</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">The spa experiences they can't stop <span>talking about</span></h2>
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
                            <img src="images/testimonial-image.jpg" alt="">
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
                                            <p>My experience at Logoipsum was nothing short of incredible. From the moment I walked through the doors, I was greeted with warmth and professionalism. The atmosphere was serene and calming, making me feel relaxed even before my treatments began. I booked a full spa day, including a massage, facial, and body wrap.</p>
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
                                            <p>My experience at Logoipsum was nothing short of incredible. From the moment I walked through the doors, I was greeted with warmth and professionalism. The atmosphere was serene and calming, making me feel relaxed even before my treatments began. I booked a full spa day, including a massage, facial, and body wrap.</p>
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
                                            <p>My experience at Logoipsum was nothing short of incredible. From the moment I walked through the doors, I was greeted with warmth and professionalism. The atmosphere was serene and calming, making me feel relaxed even before my treatments began. I booked a full spa day, including a massage, facial, and body wrap.</p>
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
    </div> --}}
    <!-- Our Testimonial Section End -->

    <!-- Book Appointment Section Start -->
    {{-- <div class="book-appointment">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Book appointment</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Book appointment now for wellness, peace and <span>rejuvenation</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <!-- Appointment image Start -->
                    <div class="appointment-image">
                        <figure class="image-anime reveal">
                            <img src="images/appointment-image.jpg" alt="">
                        </figure>
                        
                        <!-- Appointment Info List Start -->
                        <div class="appointment-timing-box">
                            <h3>Opening Hours:</h3>
                            <ul>
                                <li>Mon - Fri ( 09:00 - 21:00 )</li>
                                <li>Saturday ( 09:00 - 14:00 )</li>
                                <li>Sunday ( Closed )</li>
                            </ul>
                        </div>
                        <!-- Appointment Info List End -->
                    </div>
                    <!-- Appointment image End -->
                </div>

                <div class="col-lg-6">
                    <!-- Book Appointment Form Start -->
                    <div class="appointment-form wow fadeInUp" data-wow-delay="0.2s">
                        <form id="appointmentForm" action="#" method="POST" data-toggle="validator">
                            <div class="row">                                
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-12 mb-4">
                                    <input type="email" name ="email" class="form-control" id="email" placeholder="Email Address" required>
                                    <div class="help-block with-errors"></div>
                                </div>
    
                                <div class="form-group col-md-12 mb-4">
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-6 mb-4">
                                    <select name="services" class="form-control form-select" id="services" required>
                                        <option value="" disabled selected>Select Category</option>
                                        <option value="signature_facials">Signature Facials</option>
                                        <option value="therapeutic_massages">Therapeutic Massages</option>
                                        <option value="body_scrubs">Body Scrubs</option>
                                        <option value="reflexology">reflexology</option>
                                        <option value="healing_therapy">healing therapy</option>
                                        <option value="rejuvenation_ritual">rejuvenation ritual</option>
                                        <option value="revitalizing_facial">revitalizing facial</option>
                                        <option value="aromatherapy_session">aromatherapy session</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
    
                                <div class="form-group col-md-6 mb-5">
                                    <input type="date" name="date" class="form-control" id="date" required>
                                    <div class="help-block with-errors"></div>
                                </div>
    
                                <div class="col-md-12">
                                    <button type="submit" class="btn-default"><span>Book an appointment</span></button>
                                    <div id="msgSubmit" class="h3 hidden"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Book Appointment Form End -->
                </div>

                <div class="col-lg-12">
                    <!-- Benefit Counter List Start -->
                    <div class="benefit-counter-list">
                        <!-- Benefit Counter Item Start -->
                        <div class="benefit-counter-item">
                            <div class="icon-box">
                                <img src="images/icon-benefit-counter-1.svg" alt="">
                            </div>
                            <div class="benefit-counter-content">
                                <h2><span class="counter">15</span>+</h2>
                                <p>Years of Experience</p>
                            </div>
                        </div>
                        <!-- Benefit Counter Item End -->

                        <!-- Benefit Counter Item Start -->
                        <div class="benefit-counter-item">
                            <div class="icon-box">
                                <img src="images/icon-benefit-counter-2.svg" alt="">
                            </div>
                            <div class="benefit-counter-content">
                                <h2><span class="counter">500</span>+</h2>
                                <p>Happy Clients Served</p>
                            </div>
                        </div>
                        <!-- Benefit Counter Item End -->

                        <!-- Benefit Counter Item Start -->
                        <div class="benefit-counter-item">
                            <div class="icon-box">
                                <img src="images/icon-benefit-counter-3.svg" alt="">
                            </div>
                            <div class="benefit-counter-content">
                                <h2><span class="counter">98</span>%</h2>
                                <p>Client Satisfaction Rate</p>
                            </div>
                        </div>
                        <!-- Benefit Counter Item End -->

                        <!-- Benefit Counter Item Start -->
                        <div class="benefit-counter-item">
                            <div class="icon-box">
                                <img src="images/icon-benefit-counter-4.svg" alt="">
                            </div>
                            <div class="benefit-counter-content">
                                <h2><span class="counter">50</span>+</h2>
                                <p>Expert Therapists</p>
                            </div>
                        </div>
                        <!-- Benefit Counter Item End -->
                    </div>
                    <!-- Benefit Counter List End -->
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Book Appointment Section End -->
@endsection

{{-- Scripts --}}
@section('scripts')


@endsection
