@extends('layouts.main')
{{-- Title --}}
@section('title', 'home')

{{-- Style Files --}}
@section('styles')
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Awaiken">
    <title>Spawell - Spa & Wellness HTML Template</title>
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
	<link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&amp;family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&amp;display=swap" rel="stylesheet">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
<link href="{{ asset('css/slicknav.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
<link href="{{ asset('css/all.min.css') }}" rel="stylesheet" media="screen">
<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('css/mousecursor.css') }}">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet" media="screen">
@endsection

{{-- Content --}}
@section('content')
    <!-- Hero Section Start -->
    <div class="hero hero-bg-image bg-section dark-section parallaxie">
        <!-- Hero Section Start -->
        <div class="hero-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Hero Content Start -->
                        <div class="hero-content">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">Step into a world of calm and care</h3>
                                <h1 class="text-anime-style-2" data-cursor="-opaque">Experience the ultimate escape into <span>relaxation and expert care</span></h1>
                                <p class="wow fadeInUp" data-wow-delay="0.2s">Every detail is thoughtfully designed to help you unwind—from the tranquil ambiance to our skilled therapists and holistic treatments. Whether you seek deep relaxation, skin rejuvenation, or stress relief, we offer a personalized experience.</p>
                            </div>
                            <!-- Section Title End -->

                            <!-- Hero Button Start -->
                            <div class="hero-btn wow fadeInUp" data-wow-delay="0.4s">
                                <a href="{{ url('/book-appointment') }}" class="btn-default btn-highlighted">Book An Appointment</a>
                                <a href="{{ url('/services') }}" class="btn-default border-btn">Our Services</a>
                            </div>
                            <!-- Hero Button End -->
                        </div>
                        <!-- Hero Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->

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
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Born from a love for natural beauty and inner peace, our spa is a sanctuary designed to restore balance, one <span>personalized experience at a time.</span></h2>
                        </div>
                        <!-- Section Title End -->
                        
                        <!-- About Us Button Start -->
                        <div class="about-us-btn wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ url('/about') }}" class="btn-default">Discover More</a>
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
                            <h3>Personalized Holistic Care</h3>
                            <p>We take a thoughtful, individual approach to every guest. From your first.</p>
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
                            <h3>Tailored Wellness Experience</h3>
                            <p>We take a thoughtful, individual approach to every guest. From your first.</p>
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
                            <h3>Soul-Aligned Wellness</h3>
                            <p>We take a thoughtful, individual approach to every guest. From your first.</p>
                        </div>
                    </div>
                    <!-- About Us Item End -->
                </div>
            </div>
        </div>
    </div>
    <!-- About Us Section End -->

    <!-- Our Services Section Start -->
    <div class="our-services bg-section dark-section">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Featured services</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">A curated collection of treatments to rejuvenate <span>your body</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row service-list">
                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item active wow fadeInUp">
                        <div class="icon-box">
                            <img src="images/icon-service-1.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3><a href="{{ url('/service-detail') }}">Signature Facials</a></h3>
                            <p>This all-in-one treatment begins with a thorough skin.</p>
                        </div>
                        <div class="service-item-list">
                            <ul>
                                <li>Skin Soul Shine</li>
                                <li>Your skin, only better.</li>
                            </ul>
                        </div>
                        <div class="service-btn">
                            <a href="{{ url('/service-detail') }}" class="readmore-btn">view more</a>
                        </div>
                    </div>
                    <!-- Service Item End -->
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="images/icon-service-2.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3><a href="{{ url('/service-detail') }}">Therapeutic Massage</a></h3>
                            <p>This all-in-one treatment begins with a thorough skin.</p>
                        </div>
                        <div class="service-item-list">
                            <ul>
                                <li>Skin Soul Shine</li>
                                <li>Your skin, only better.</li>
                            </ul>
                        </div>
                        <div class="service-btn">
                            <a href="{{ url('/service-detail') }}" class="readmore-btn">view more</a>
                        </div>
                    </div>
                    <!-- Service Item End -->
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="images/icon-service-3.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3><a href="{{ url('/service-detail') }}">Body Scrubs </a></h3>
                            <p>This all-in-one treatment begins with a thorough skin.</p>
                        </div>
                        <div class="service-item-list">
                            <ul>
                                <li>Skin Soul Shine</li>
                                <li>Your skin, only better.</li>
                            </ul>
                        </div>
                        <div class="service-btn">
                            <a href="{{ url('/service-detail') }}" class="readmore-btn">view more</a>
                        </div>
                    </div>
                    <!-- Service Item End -->
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="icon-box">
                            <img src="images/icon-service-4.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3><a href="{{ url('/service-detail') }}">Reflexology</a></h3>
                            <p>This all-in-one treatment begins with a thorough skin.</p>
                        </div>
                        <div class="service-item-list">
                            <ul>
                                <li>Skin Soul Shine</li>
                                <li>Your skin, only better.</li>
                            </ul>
                        </div>
                        <div class="service-btn">
                            <a href="{{ url('/service-detail') }}" class="readmore-btn">view more</a>
                        </div>
                    </div>
                    <!-- Service Item End -->
                </div>

                <div class="col-lg-12">
                    <!-- Section Footer Text Start -->
                    <div class="section-footer-text wow fadeInUp" data-wow-delay="0.8s">
                        <p><span>Free</span>Begin your path to total relaxation today. <a href="{{ url('/book-appointment') }}">Book your free wellness consultation!</a></p>
                    </div>
                    <!-- Section Footer Text End -->
                </div>
            </div>            
        </div>
    </div>
    <!-- Our Services Section End -->

    <!-- Our Feature Section Start -->
    <div class="our-feature">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Our feature</h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque">Discover the unique features <img src="images/feature-title-img.jpg" alt=""> that set our spa experience apart and elevate <span>your path to wellness</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row feature-item-box">
                <div class="col-lg-3 col-md-6">
                    <!-- Feature Item Start -->
                    <div class="feature-item wow fadeInUp">
                        <div class="icon-box">
                            <img src="images/icon-feature-1.svg" alt="">
                        </div>
                        <div class="feature-item-header">
                            <h3>Modern Interiors</h3>
                        </div>
                        <div class="feature-item-body">
                            <p>This all-in-one treatment begins with a thorough skin analysis, followed by deep cleansing.</p>
                            <h3>Elegant Trust Building</h3>
                        </div>
                    </div>
                    <!-- Feature Item End -->
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <!-- Feature Item Start -->
                    <div class="feature-item active wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="images/icon-feature-2.svg" alt="">
                        </div>
                        <div class="feature-item-header">
                            <h3>Complimentary</h3>
                        </div>
                        <div class="feature-item-body">
                            <p>This all-in-one treatment begins with a thorough skin analysis, followed by deep cleansing.</p>
                            <h3>Experience Focused</h3>
                        </div>
                    </div>
                    <!-- Feature Item End -->
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <!-- Feature Item Start -->
                    <div class="feature-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="images/icon-feature-3.svg" alt="">
                        </div>
                        <div class="feature-item-header">
                            <h3>Strict hygiene</h3>
                        </div>
                        <div class="feature-item-body">
                            <p>This all-in-one treatment begins with a thorough skin analysis, followed by deep cleansing.</p>
                            <h3>Holistic & Natural</h3>
                        </div>
                    </div>
                    <!-- Feature Item End -->
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <!-- Feature Item Start -->
                    <div class="feature-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="icon-box">
                            <img src="images/icon-feature-4.svg" alt="">
                        </div>
                        <div class="feature-item-header">
                            <h3>Safety standards</h3>
                        </div>
                        <div class="feature-item-body">
                            <p>This all-in-one treatment begins with a thorough skin analysis, followed by deep cleansing.</p>
                            <h3>Private Treatment</h3>
                        </div>
                    </div>
                    <!-- Feature Item End -->
                </div>

                <div class="col-lg-12">
                    <!-- Feature List Start -->
                    <div class="feature-list wow fadeInUp" data-wow-delay="0.8s">
                        <ul>
                            <li>10+ year of holistic spa</li>
                            <li>5000+ happy client</li>
                            <li>98% satisfaction rate</li>
                            <li>30+ treatment tailored</li>
                            <li>7 Days a week open</li>
                            <li>100% natural product</li>
                            <li>500+ customized wellness plan</li>
                        </ul>
                    </div>
                    <!-- Feature List End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Feature Section End -->

    <!-- What We Do Section Start -->
    <div class="what-we-do bg-section">
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
    </div>
    <!-- What We Do Section End -->    

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
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Why our clients trust us for their <span>wellness and care</span></h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Trust is built through our unwavering commitment to your health and well-being. We combine expert knowledge with personalized care.</p>
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
                                        <h3>Holistic Approach to Wellness</h3>
                                    </div>
                                </div>
                                <div class="why-choose-item-content">
                                    <p>We treat the whole you—mind, body, and spirit—through sessions.</p>
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
                                        <h3>Experienced & Caring Team</h3>
                                    </div>
                                </div>
                                <div class="why-choose-item-content">
                                    <p>Our certified therapists are not only skilled but genuinely committed.</p>
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
                            <img src="images/why-choose-image.jpg" alt="">
                        </figure>

                        <!-- Contact Us Circle Start -->
                        <div class="contact-us-circle">
                            <a href="{{ url('/contact-us') }}">
                                <img src="images/contact-us-circle.svg" alt="">
                            </a>
                        </div>
                        <!-- Contact Us Circle ENd -->
                    </div>
                    <!-- Why Choose Images End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Why Choose Us Section End -->

    <!-- Our Pricing Section Start -->
    <div class="our-pricing bg-section dark-section">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Pricing plan</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Transparent flexible packages for every <span>wellness need</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Pricing Box Start -->
                    <div class="pricing-box wow fadeInUp">
                        <!-- Pricing Header Start -->
                        <div class="pricing-header">
                            <h3>Basic Plan</h3>
                        </div>
                        <!-- Pricing Header End -->
                        
                        <!-- Pricing Content Start -->
                        <div class="pricing-content">
                            <h2>$39 <span>Monthly</span></h2>
                            <p>We believe great design is more than just visuals — it's a feeling. </p>
                        </div>
                        <!-- Pricing Content End -->

                        <!-- Pricing Button Start -->
                        <div class="pricing-btn">
                            <a href="{{ url('/contact-us') }}" class="btn-default">Get Started With Plan</a>
                        </div>
                        <!-- Pricing Button End -->

                        <!-- Pricing List Start -->
                        <div class="pricing-list">
                            <ul>
                                <li>Full Body Scrub</li>
                                <li>Detoxifying Body Wrap</li>
                                <li>Hydrating Body Wrap</li>
                            </ul>
                        </div>
                        <!-- Pricing List End -->
                    </div>
                    <!-- Pricing Box End -->
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <!-- Pricing Box Start -->
                    <div class="pricing-box highlighted-box wow fadeInUp" data-wow-delay="0.2s">
                        <!-- Pricing Header Start -->
                        <div class="pricing-header">
                            <h3>Standard Plan</h3>
                        </div>
                        <!-- Pricing Header End -->
                        
                        <!-- Pricing Content Start -->
                        <div class="pricing-content">
                            <h2>$49 <span>Monthly</span></h2>
                            <p>We believe great design is more than just visuals — it's a feeling. </p>
                        </div>
                        <!-- Pricing Content End -->

                        <!-- Pricing Button Start -->
                        <div class="pricing-btn">
                            <a href="{{ url('/contact-us') }}" class="btn-default">Get Started With Plan</a>
                        </div>
                        <!-- Pricing Button End -->

                        <!-- Pricing List Start -->
                        <div class="pricing-list">
                            <ul>
                                <li>Full Body Scrub</li>
                                <li>Detoxifying Body Wrap</li>
                                <li>Hydrating Body Wrap</li>
                            </ul>
                        </div>
                        <!-- Pricing List End -->
                    </div>
                    <!-- Pricing Box End -->
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <!-- Pricing Box Start -->
                    <div class="pricing-box wow fadeInUp" data-wow-delay="0.4s">
                        <!-- Pricing Header Start -->
                        <div class="pricing-header">
                            <h3>Premium Plan</h3>
                        </div>
                        <!-- Pricing Header End -->
                        
                        <!-- Pricing Content Start -->
                        <div class="pricing-content">
                            <h2>$59 <span>Monthly</span></h2>
                            <p>We believe great design is more than just visuals — it's a feeling. </p>
                        </div>
                        <!-- Pricing Content End -->

                        <!-- Pricing Button Start -->
                        <div class="pricing-btn">
                            <a href="{{ url('/contact-us') }}" class="btn-default">Get Started With Plan</a>
                        </div>
                        <!-- Pricing Button End -->

                        <!-- Pricing List Start -->
                        <div class="pricing-list">
                            <ul>
                                <li>Full Body Scrub</li>
                                <li>Detoxifying Body Wrap</li>
                                <li>Hydrating Body Wrap</li>
                            </ul>
                        </div>
                        <!-- Pricing List End -->
                    </div>
                    <!-- Pricing Box End -->
                </div>

                <div class="col-lg-12">
                    <!-- Pricing Benifit List Start -->
                    <div class="pricing-benefit-list wow fadeInUp" data-wow-delay="0.6s">
                        <ul>
                            <li><img src="images/icon-pricing-benefit-1.svg" alt="">Get 30 day free trial</li>
                            <li><img src="images/icon-pricing-benefit-2.svg" alt="">No any hidden fees pay</li>
                            <li><img src="images/icon-pricing-benefit-3.svg" alt="">You can cancel anytime</li>
                        </ul>
                    </div>
                    <!-- Pricing Benifit List End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Pricing Section End -->

    <!-- Book Appointment Section Start -->
    <div class="book-appointment">
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
    </div>
    <!-- Book Appointment Section End -->

    <!-- Our Faqs Section Start -->
    <div class="our-faqs bg-section">
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
    </div>
    <!-- Our Faqs Section End -->

    <!-- Our Team Section Start -->
    <div class="our-team">
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
    </div>
    <!-- Our Team Section End -->

    <!-- Our Partners Section Start -->
    <div class="our-partners bg-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Our Partners Content Start -->
                    <div class="our-partners-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Our partners</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Premium partnerships that enhance <span>every aspect</span></h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">We offer more than just treatments - we deliver personalized wellness experiences designed to relax the body, refresh the mind, and restore inner balance.</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- How It Work Button Start -->
                        <div class="our-partner-btn wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ url('/book-appointment') }}" class="btn-default">Book appointment</a>
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

    <!-- Join Us Section Start -->
    <div class="join-us">
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
    </div>
    <!-- Join Us Section End -->

    <!-- Our Testimonial Section Start -->
    <div class="our-testimonials bg-section dark-section">
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
    </div>
    <!-- Our Testimonial Section End -->

    <!-- Our Blog Section Start -->
    <div class="our-blog">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Latest blog</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Inside the ultimate luxury <span>spa experience</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-lg-6">
                    <!-- Section Button Start -->
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                        <a href="{{ url('/blogs') }}" class="btn-default">view all blog</a>
                    </div>
                    <!-- Section Button End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Post Item Start -->
                    <div class="post-item wow fadeInUp">
                        <!-- Post Featured Image Start-->
                        <div class="post-featured-image">
                            <a href="{{ url('/blog-single') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/post-1.jpg" alt="">
                                </figure>    
                            </a>                            
                        </div>
                        <!-- Post Featured Image End -->

                        <!-- Post Item Body Start -->
                        <div class="post-item-body">
                            <!-- Post Item Content Start -->
                            <div class="post-item-content">
                                <h2><a href="{{ url('/blog-single') }}">Keep the Glow Spa-Worthy Radiance, Right at Home</a></h2>
                            </div>
                            <!-- Post Item Content End -->

                            <!-- Post Item Readmore Button Start-->
                            <div class="post-item-btn">
                                <a href="{{ url('/blog-single') }}" class="readmore-btn">read more</a>
                            </div>
                            <!-- Post Item Readmore Button End-->
                        </div>
                        <!-- Post Item Body End -->
                    </div>
                    <!-- Post Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Post Item Start -->
                    <div class="post-item wow fadeInUp" data-wow-delay="0.2s">
                        <!-- Post Featured Image Start-->
                        <div class="post-featured-image">
                            <a href="{{ url('/blog-single') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/post-2.jpg" alt="">
                                </figure>    
                            </a>                            
                        </div>
                        <!-- Post Featured Image End -->

                        <!-- Post Item Body Start -->
                        <div class="post-item-body">
                            <!-- Post Item Content Start -->
                            <div class="post-item-content">
                                <h2><a href="{{ url('/blog-single') }}">Everything You Need to Know About Body Scrubs</a></h2>
                            </div>
                            <!-- Post Item Content End -->

                            <!-- Post Item Readmore Button Start-->
                            <div class="post-item-btn">
                                <a href="{{ url('/blog-single') }}" class="readmore-btn">read more</a>
                            </div>
                            <!-- Post Item Readmore Button End-->
                        </div>
                        <!-- Post Item Body End -->
                    </div>
                    <!-- Post Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Post Item Start -->
                    <div class="post-item wow fadeInUp" data-wow-delay="0.4s">
                        <!-- Post Featured Image Start-->
                        <div class="post-featured-image">
                            <a href="{{ url('/blog-single') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/post-3.jpg" alt="">
                                </figure>    
                            </a>                            
                        </div>
                        <!-- Post Featured Image End -->

                        <!-- Post Item Body Start -->
                        <div class="post-item-body">
                            <!-- Post Item Content Start -->
                            <div class="post-item-content">
                                <h2><a href="{{ url('/blog-single') }}">Hot Stone Therapy Deep Relaxation. Lasting Relief.</a></h2>
                            </div>
                            <!-- Post Item Content End -->

                            <!-- Post Item Readmore Button Start-->
                            <div class="post-item-btn">
                                <a href="{{ url('/blog-single') }}" class="readmore-btn">read more</a>
                            </div>
                            <!-- Post Item Readmore Button End-->
                        </div>
                        <!-- Post Item Body End -->
                    </div>
                    <!-- Post Item End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Blog Section End -->
        <div class="hero-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="hero-content">
                            <div class="section-title">
                                <h3 class="wow fadeInUp">Step into a world of calm and care</h3>
                                <h1 class="text-anime-style-2" data-cursor="-opaque">Experience the ultimate escape into <span>relaxation and expert care</span></h1>
                                <p class="wow fadeInUp" data-wow-delay="0.2s">Every detail is thoughtfully designed to help you unwind—from the tranquil ambiance to our skilled therapists and holistic treatments. Whether you seek deep relaxation, skin rejuvenation, or stress relief, we offer a personalized experience.</p>
                            </div>
                            <div class="hero-btn wow fadeInUp" data-wow-delay="0.4s">
                                <a href="{{ url('/book-appointment') }}" class="btn-default btn-highlighted">Book An Appointment</a>
                                <a href="{{ url('/services') }}" class="btn-default border-btn">Our Services</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-img">
                            <figure>
                                <img src="images/hero-image.png" alt="">
                            </figure>
                            <div class="hero-rating-box">
                                <div class="hero-rating-header">
                                    <img src="images/icon-google.svg" alt="">
                                    <p>Google Rating</p>
                                </div>
                                <div class="hero-rating-body">
                                    <div class="hero-rating-star">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="hero-rating-counter">
                                        <p><span class="counter">4.9</span> (29K Reviews)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-us">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="about-title-box">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">About us</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Born from a love for natural beauty and inner peace, our spa is a sanctuary designed to restore balance, one <span>personalized experience at a time.</span></h2>
                        </div>
                        <div class="about-us-btn wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ url('/about') }}" class="btn-default">Discover More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="about-us-item about-box-1 wow fadeInUp">
                        <div class="about-us-image">
                            <figure class="image-anime">
                                <img src="images/about-us-img-1.jpg" alt="">
                            </figure>
                        </div>
                        <div class="about-item-content">
                            <h3>Personalized Holistic Care</h3>
                            <p>We take a thoughtful, individual approach to every guest. From your first.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-us-item about-box-2 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="about-us-image">
                            <figure class="image-anime">
                                <img src="images/about-us-img-2.jpg" alt="">
                            </figure>
                        </div>
                        <div class="about-item-content">
                            <h3>Tailored Wellness Experience</h3>
                            <p>We take a thoughtful, individual approach to every guest. From your first.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-us-item about-box-3 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="about-us-image">
                            <figure class="image-anime">
                                <img src="images/about-us-img-3.jpg" alt="">
                            </figure>
                        </div>
                        <div class="about-item-content">
                            <h3>Soul-Aligned Wellness</h3>
                            <p>We take a thoughtful, individual approach to every guest. From your first.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="our-services bg-section dark-section">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Featured services</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">A curated collection of treatments to rejuvenate <span>your body</span></h2>
                    </div>
                </div>
            </div>
            <div class="row service-list">
                <div class="col-lg-3 col-md-6">
                    <div class="service-item active wow fadeInUp">
                        <div class="icon-box">
                            <img src="images/icon-service-1.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3><a href="{{ url('/service-detail') }}">Signature Facials</a></h3>
                            <p>This all-in-one treatment begins with a thorough skin.</p>
                        </div>
                        <div class="service-item-list">
                            <ul>
                                <li>Skin Soul Shine</li>
                                <li>Your skin, only better.</li>
                            </ul>
                        </div>
                        <div class="service-btn">
                            <a href="{{ url('/service-detail') }}" class="readmore-btn">view more</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="images/icon-service-2.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3><a href="{{ url('/service-detail') }}">Therapeutic Massage</a></h3>
                            <p>This all-in-one treatment begins with a thorough skin.</p>
                        </div>
                        <div class="service-item-list">
                            <ul>
                                <li>Skin Soul Shine</li>
                                <li>Your skin, only better.</li>
                            </ul>
                        </div>
                        <div class="service-btn">
                            <a href="{{ url('/service-detail') }}" class="readmore-btn">view more</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="images/icon-service-3.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3><a href="{{ url('/service-detail') }}">Body Scrubs </a></h3>
                            <p>This all-in-one treatment begins with a thorough skin.</p>
                        </div>
                        <div class="service-item-list">
                            <ul>
                                <li>Skin Soul Shine</li>
                                <li>Your skin, only better.</li>
                            </ul>
                        </div>
                        <div class="service-btn">
                            <a href="{{ url('/service-detail') }}" class="readmore-btn">view more</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="icon-box">
                            <img src="images/icon-service-4.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3><a href="{{ url('/service-detail') }}">Reflexology</a></h3>
                            <p>This all-in-one treatment begins with a thorough skin.</p>
                        </div>
                        <div class="service-item-list">
                            <ul>
                                <li>Skin Soul Shine</li>
                                <li>Your skin, only better.</li>
                            </ul>
                        </div>
                        <div class="service-btn">
                            <a href="{{ url('/service-detail') }}" class="readmore-btn">view more</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="section-footer-text wow fadeInUp" data-wow-delay="0.8s">
                        <p><span>Free</span>Begin your path to total relaxation today. <a href="{{ url('/book-appointment') }}">Book your free wellness consultation!</a></p>
                    </div>
                </div>
            </div>            
        </div>
    </div>
    <div class="our-feature">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Our feature</h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque">Discover the unique features <img src="images/feature-title-img.jpg" alt=""> that set our spa experience apart and elevate <span>your path to wellness</span></h2>
                    </div>
                </div>
            </div>
            <div class="row feature-item-box">
                <div class="col-lg-3 col-md-6">
                    <div class="feature-item wow fadeInUp">
                        <div class="icon-box">
                            <img src="images/icon-feature-1.svg" alt="">
                        </div>
                        <div class="feature-item-header">
                            <h3>Modern Interiors</h3>
                        </div>
                        <div class="feature-item-body">
                            <p>This all-in-one treatment begins with a thorough skin analysis, followed by deep cleansing.</p>
                            <h3>Elegant Trust Building</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-item active wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="images/icon-feature-2.svg" alt="">
                        </div>
                        <div class="feature-item-header">
                            <h3>Complimentary</h3>
                        </div>
                        <div class="feature-item-body">
                            <p>This all-in-one treatment begins with a thorough skin analysis, followed by deep cleansing.</p>
                            <h3>Experience Focused</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="images/icon-feature-3.svg" alt="">
                        </div>
                        <div class="feature-item-header">
                            <h3>Strict hygiene</h3>
                        </div>
                        <div class="feature-item-body">
                            <p>This all-in-one treatment begins with a thorough skin analysis, followed by deep cleansing.</p>
                            <h3>Holistic & Natural</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="icon-box">
                            <img src="images/icon-feature-4.svg" alt="">
                        </div>
                        <div class="feature-item-header">
                            <h3>Safety standards</h3>
                        </div>
                        <div class="feature-item-body">
                            <p>This all-in-one treatment begins with a thorough skin analysis, followed by deep cleansing.</p>
                            <h3>Private Treatment</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="feature-list wow fadeInUp" data-wow-delay="0.8s">
                        <ul>
                            <li>10+ year of holistic spa</li>
                            <li>5000+ happy client</li>
                            <li>98% satisfaction rate</li>
                            <li>30+ treatment tailored</li>
                            <li>7 Days a week open</li>
                            <li>100% natural product</li>
                            <li>500+ customized wellness plan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="what-we-do bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="what-we-do-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">What we do</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Thoughtfully designed for your <span>ultimate comfort</span></h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">We've crafted every element of our spa to enhance your relaxation and deliver care. From soothing ambiance.</p>
                        </div>
                        <div class="what-we-do-btn wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ url('/contact-us') }}" class="btn-default">contact us</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="what-we-do-item-list">
                        <div class="what-we-do-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="images/icon-what-we-do-1.svg" alt="">
                            </div>
                            <div class="what-do-item-content">
                                <h3>Tranquil Ambience</h3>
                                <p>Clean, sanitized spaces that meet the highest standards of spa hygiene.</p>
                            </div>
                        </div>
                        <div class="what-we-do-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-box">
                                <img src="images/icon-what-we-do-2.svg" alt="">
                            </div>
                            <div class="what-do-item-content">
                                <h3>Skilled Therapists</h3>
                                <p>Clean, sanitized spaces that meet the highest standards of spa hygiene.</p>
                            </div>
                        </div>
                        <div class="what-we-do-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="images/icon-what-we-do-3.svg" alt="">
                            </div>
                            <div class="what-do-item-content">
                                <h3>Natural Products</h3>
                                <p>Clean, sanitized spaces that meet the highest standards of spa hygiene.</p>
                            </div>
                        </div>
                        <div class="what-we-do-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="images/icon-what-we-do-4.svg" alt="">
                            </div>
                            <div class="what-do-item-content">
                                <h3>Customized Treatme</h3>
                                <p>Clean, sanitized spaces that meet the highest standards of spa hygiene.</p>
                            </div>
                        </div>
                        <div class="what-we-do-item wow fadeInUp" data-wow-delay="0.8s">
                            <div class="icon-box">
                                <img src="images/icon-what-we-do-5.svg" alt="">
                            </div>
                            <div class="what-do-item-content">
                                <h3>Hygienic Facilities</h3>
                                <p>Clean, sanitized spaces that meet the highest standards of spa hygiene.</p>
                            </div>
                        </div>
                        <div class="what-we-do-item wow fadeInUp" data-wow-delay="1s">
                            <div class="icon-box">
                                <img src="images/icon-what-we-do-6.svg" alt="">
                            </div>
                            <div class="what-do-item-content">
                                <h3>Easy Online Booking</h3>
                                <p>Clean, sanitized spaces that meet the highest standards of spa hygiene.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <div class="why-choose-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="why-choose-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Why choose us</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Why our clients trust us for their <span>wellness and care</span></h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Trust is built through our unwavering commitment to your health and well-being. We combine expert knowledge with personalized care.</p>
                        </div>
                        <div class="why-choose-item-list">
                            <div class="why-choose-item wow fadeInUp" data-wow-delay="0.4s">
                                <div class="why-choose-item-header">
                                    <div class="icon-box">
                                        <img src="images/icon-why-choose-1.svg" alt="">
                                    </div>
                                    <div class="why-choose-item-title">
                                        <h3>Holistic Approach to Wellness</h3>
                                    </div>
                                </div>
                                <div class="why-choose-item-content">
                                    <p>We treat the whole you—mind, body, and spirit—through sessions.</p>
                                </div>
                            </div>
                            <div class="why-choose-item wow fadeInUp" data-wow-delay="0.6s">
                                <div class="why-choose-item-header">
                                    <div class="icon-box">
                                        <img src="images/icon-why-choose-2.svg" alt="">
                                    </div>
                                    <div class="why-choose-item-title">
                                        <h3>Experienced & Caring Team</h3>
                                    </div>
                                </div>
                                <div class="why-choose-item-content">
                                    <p>Our certified therapists are not only skilled but genuinely committed.</p>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="why-choose-image">
                        <figure class="image-anime">
                            <img src="images/why-choose-image.jpg" alt="">
                        </figure>
                        <div class="contact-us-circle">
                            <a href="{{ url('/contact-us') }}">
                                <img src="images/contact-us-circle.svg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="our-pricing bg-section dark-section">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Pricing plan</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Transparent flexible packages for every <span>wellness need</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-box wow fadeInUp">
                        <div class="pricing-header">
                            <h3>Basic Plan</h3>
                        </div>
                        <div class="pricing-content">
                            <h2>$39 <span>Monthly</span></h2>
                            <p>We believe great design is more than just visuals — it's a feeling. </p>
                        </div>
                        <div class="pricing-btn">
                            <a href="{{ url('/contact-us') }}" class="btn-default">Get Started With Plan</a>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li>Full Body Scrub</li>
                                <li>Detoxifying Body Wrap</li>
                                <li>Hydrating Body Wrap</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-box highlighted-box wow fadeInUp" data-wow-delay="0.2s">
                        <div class="pricing-header">
                            <h3>Standard Plan</h3>
                        </div>
                        <div class="pricing-content">
                            <h2>$49 <span>Monthly</span></h2>
                            <p>We believe great design is more than just visuals — it's a feeling. </p>
                        </div>
                        <div class="pricing-btn">
                            <a href="{{ url('/contact-us') }}" class="btn-default">Get Started With Plan</a>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li>Full Body Scrub</li>
                                <li>Detoxifying Body Wrap</li>
                                <li>Hydrating Body Wrap</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-box wow fadeInUp" data-wow-delay="0.4s">
                        <div class="pricing-header">
                            <h3>Premium Plan</h3>
                        </div>
                        <div class="pricing-content">
                            <h2>$59 <span>Monthly</span></h2>
                            <p>We believe great design is more than just visuals — it's a feeling. </p>
                        </div>
                        <div class="pricing-btn">
                            <a href="{{ url('/contact-us') }}" class="btn-default">Get Started With Plan</a>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li>Full Body Scrub</li>
                                <li>Detoxifying Body Wrap</li>
                                <li>Hydrating Body Wrap</li>
                            </ul>
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
    <div class="book-appointment">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Book appointment</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Book appointment now for wellness, peace and <span>rejuvenation</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="appointment-image">
                        <figure class="image-anime reveal">
                            <img src="images/appointment-image.jpg" alt="">
                        </figure>
                        <div class="appointment-timing-box">
                            <h3>Opening Hours:</h3>
                            <ul>
                                <li>Mon - Fri ( 09:00 - 21:00 )</li>
                                <li>Saturday ( 09:00 - 14:00 )</li>
                                <li>Sunday ( Closed )</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
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
                </div>
                <div class="col-lg-12">
                    <div class="benefit-counter-list">
                        <div class="benefit-counter-item">
                            <div class="icon-box">
                                <img src="images/icon-benefit-counter-1.svg" alt="">
                            </div>
                            <div class="benefit-counter-content">
                                <h2><span class="counter">15</span>+</h2>
                                <p>Years of Experience</p>
                            </div>
                        </div>
                        <div class="benefit-counter-item">
                            <div class="icon-box">
                                <img src="images/icon-benefit-counter-2.svg" alt="">
                            </div>
                            <div class="benefit-counter-content">
                                <h2><span class="counter">500</span>+</h2>
                                <p>Happy Clients Served</p>
                            </div>
                        </div>
                        <div class="benefit-counter-item">
                            <div class="icon-box">
                                <img src="images/icon-benefit-counter-3.svg" alt="">
                            </div>
                            <div class="benefit-counter-content">
                                <h2><span class="counter">98</span>%</h2>
                                <p>Client Satisfaction Rate</p>
                            </div>
                        </div>
                        <div class="benefit-counter-item">
                            <div class="icon-box">
                                <img src="images/icon-benefit-counter-4.svg" alt="">
                            </div>
                            <div class="benefit-counter-content">
                                <h2><span class="counter">50</span>+</h2>
                                <p>Expert Therapists</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="our-faqs bg-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="faqs-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Frequently asked question</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Helpful answer for first-time & <span>returning guests</span></h2>
                        </div>
                        <div class="faq-accordion" id="faqaccordion">
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
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="faqs-image-box">
                        <div class="faq-image">
                            <figure class="image-anime reveal">
                                <img src="images/faq-image.jpg" alt="">
                            </figure>
                        </div>
                        <div class="faqs-cta-box">
                            <div class="icon-box">
                                <img src="images/icon-faqs-cta.svg" alt="">
                            </div>
                            <div class="faqs-cta-box-content">
                                <h3>Relax, We've Got the Answers</h3>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
        </div>
    </div>
    <div class="our-team">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Expert team member</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">A team of trained professionals dedicated to <span>your comfort</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="team-item wow fadeInUp">
                        <div class="team-content">
                            <h3><a href="{{ url('/team-single') }}">Adele Patkinson</a></h3>
                            <p>Spa Director</p>
                        </div>
                        <div class="team-image">
                            <figure>
                                <img src="images/team-1.png" alt="">
                            </figure>
                        </div>
                        <div class="team-social-list">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-content">
                            <h3><a href="{{ url('/team-single') }}">Jenny Wilson</a></h3>
                            <p>Senior Esthetician</p>
                        </div>
                        <div class="team-image">
                            <figure>
                                <img src="images/team-2.png" alt="">
                            </figure>
                        </div>
                        <div class="team-social-list">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="team-content">
                            <h3><a href="{{ url('/team-single') }}">Nicky Waode</a></h3>
                            <p>Facial Expert</p>
                        </div>
                        <div class="team-image">
                            <figure>
                                <img src="images/team-3.png" alt="">
                            </figure>
                        </div>
                        <div class="team-social-list">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="team-content">
                            <h3><a href="{{ url('/team-single') }}">Juliana Silva</a></h3>
                            <p>Wellness Coach</p>
                        </div>
                        <div class="team-image">
                            <figure>
                                <img src="images/team-4.png" alt="">
                            </figure>
                        </div>
                        <div class="team-social-list">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="our-partners bg-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="our-partners-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Our partners</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Premium partnerships that enhance <span>every aspect</span></h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">We offer more than just treatments - we deliver personalized wellness experiences designed to relax the body, refresh the mind, and restore inner balance.</p>
                        </div>
                        <div class="our-partner-btn wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ url('/book-appointment') }}" class="btn-default">Book appointment</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="our-partners-list">
                        <div class="our-partner-item wow fadeInUp">
                            <img src="images/partner-logo-1.svg" alt="">
                        </div>
                        <div class="our-partner-item wow fadeInUp" data-wow-delay="0.2s">
                            <img src="images/partner-logo-2.svg" alt="">
                        </div>
                        <div class="our-partner-item wow fadeInUp" data-wow-delay="0.4s">
                            <img src="images/partner-logo-3.svg" alt="">
                        </div>
                        <div class="our-partner-item wow fadeInUp" data-wow-delay="0.6s">
                            <img src="images/partner-logo-4.svg" alt="">
                        </div>
                        <div class="our-partner-item wow fadeInUp" data-wow-delay="0.8s">
                            <img src="images/partner-logo-5.svg" alt="">
                        </div>
                        <div class="our-partner-item wow fadeInUp" data-wow-delay="1s">
                            <img src="images/partner-logo-6.svg" alt="">
                        </div>
                        <div class="our-partner-item wow fadeInUp" data-wow-delay="1.2s">
                            <img src="images/partner-logo-7.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="join-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-lg-1 order-2">
                    <div class="join-us-image">
                        <figure>
                            <img src="images/hero-image.png" alt="">
                        </figure>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2 order-1">
                    <div class="join-us-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Join us</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Healing touch, holistic care, <span>lasting wellness</span></h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">We offer more than just treatments - we deliver personalized wellness experiences designed to relax the body, refresh the mind, and restore inner balance.</p>
                        </div>
                        <div class="join-us-item-box">
                            <div class="join-us-item wow fadeInUp" data-wow-delay="0.4s">
                                <h3>Need Any Help?</h3>
                                <p>We believe great design is more than just visuals.</p>
                                <a href="{{ url('/contact-us') }}" class="btn-default">learn more</a>
                            </div>
                            <div class="join-us-item wow fadeInUp" data-wow-delay="0.6s">
                                <ul>
                                    <li>Full Body Scrub</li>
                                    <li>Hydrating Body Wrap</li>
                                </ul>
                                <div class="join-live-chat">
                                    <div class="icon-box">
                                        <img src="images/icon-live-chat.svg" alt="">
                                    </div>
                                    <div class="join-live-chat-content">
                                        <h3>Live Chat</h3>
                                        <p>Connected Us</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="our-testimonials bg-section dark-section">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Testimonials</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">The spa experiences they can't stop <span>talking about</span></h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="satisfy-client-box wow fadeInUp" data-wow-delay="0.2s">
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
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="testimonial-image">
                        <figure class="image-anime reveal">
                            <img src="images/testimonial-image.jpg" alt="">
                        </figure>
                        <div class="goolge-rating-box">
                            <div class="icon-box">
                                <img src="images/icon-google.svg" alt="">
                            </div>
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
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="testimonial-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper" data-cursor-text="Drag">
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
                            </div>
                            <div class="testimonial-btn">
                                <div class="testimonial-button-prev"></div>
                                <div class="testimonial-button-next"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="our-blog">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Latest blog</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Inside the ultimate luxury <span>spa experience</span></h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                        <a href="{{ url('/blogs') }}" class="btn-default">view all blog</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="post-item wow fadeInUp">
                        <div class="post-featured-image">
                            <a href="{{ url('/blog-single') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/post-1.jpg" alt="">
                                </figure>    
                            </a>                            
                        </div>
                        <div class="post-item-body">
                            <div class="post-item-content">
                                <h2><a href="{{ url('/blog-single') }}">Keep the Glow Spa-Worthy Radiance, Right at Home</a></h2>
                            </div>
                            <div class="post-item-btn">
                                <a href="{{ url('/blog-single') }}" class="readmore-btn">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="post-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="post-featured-image">
                            <a href="{{ url('/blog-single') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/post-2.jpg" alt="">
                                </figure>    
                            </a>                            
                        </div>
                        <div class="post-item-body">
                            <div class="post-item-content">
                                <h2><a href="{{ url('/blog-single') }}">Everything You Need to Know About Body Scrubs</a></h2>
                            </div>
                            <div class="post-item-btn">
                                <a href="{{ url('/blog-single') }}" class="readmore-btn">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="post-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="post-featured-image">
                            <a href="{{ url('/blog-single') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/post-3.jpg" alt="">
                                </figure>    
                            </a>                            
                        </div>
                        <div class="post-item-body">
                            <div class="post-item-content">
                                <h2><a href="{{ url('/blog-single') }}">Hot Stone Therapy Deep Relaxation. Lasting Relief.</a></h2>
                            </div>
                            <div class="post-item-btn">
                                <a href="{{ url('/blog-single') }}" class="readmore-btn">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



{{-- Scripts --}}
@section('scripts')


@endsection
