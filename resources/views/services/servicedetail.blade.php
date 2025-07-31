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
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">Signature <span>facials</span></h1>
                        {{-- <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/services') }}">services</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Signature facials</li>
                            </ol>
                        </nav> --}}
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Page Service Single Start -->
    <div class="page-service-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <!-- Page Single Sidebar Start -->
                    <div class="page-single-sidebar">
                        <!-- Sidebar CTA Box Start -->
                        <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.25s">
                            <div class="sidebar-cta-content">
                                <h3>Ready to Begin Your Beauty & Wellness Journey?</h3>
                                <a href="{{ url('/book-appointment') }}" class="btn-default">Book an Appointment</a>
                            </div>
                            <div class="sidebar-cta-image">
                                <figure class="image-anime">
                                    <img src="images/adam-winger-FkAZqQJTbXM-unsplash.jpg" alt="">
                                </figure>
                            </div>
                        </div>
                        <!-- Sidebar CTA Box End -->
                        <!-- Page Category List Start -->
                        <div class="page-catagery-list wow fadeInUp">
                            <h3>Service category</h3>
                            <ul>
                                <li><a href="#">Signature Facials</a></li>
                                <li><a href="#">Therapeutic Massages</a></li>
                                <li><a href="#">Body Scrubs</a></li>
                                <li><a href="#">Reflexology</a></li>
                                <li><a href="#">Healing Therapy</a></li>
                            </ul>
                        </div>
                        <!-- Page Category List End -->
                    </div>
                    <!-- Page Single Sidebar End -->
                </div>

                <div class="col-lg-8">
                    <!-- Service Single Content Start -->
                    <div class="service-single-content">
                        <!-- Service Featured Image Start -->
                        <div class="page-single-image">
                            <figure class="image-anime reveal">
                                <img src="images/benyamin-bohlouli-LGXN4OSQSa4-unsplash.jpg" alt="">
                            </figure>
                        </div>
                        <!-- Service Featured Image End -->
                        
                        <!-- Service Entry Start -->
                        <div class="service-entry">
                            <p class="wow fadeInUp">
                                Refresh your skin with our Signature Facials—available at top-rated partner salons near you. Each session is tailored to your unique skin type, focusing on cleansing, hydration, and rejuvenation through advanced yet gentle techniques.
                            </p>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                Performed by experienced estheticians using premium skincare products, these facials deliver visible results—whether you're looking for deep cleansing, anti-aging, or a calming glow-up. Book your facial today and reveal your most radiant skin.
                            </p>


                            <!-- Service Experience Box Start -->
                            <div class="service-experience-box">
                                <h2 class="text-anime-style-2">What to expect from your <span>facial experience</span></h2>
                                <p class="wow fadeInUp" data-wow-delay="0.4s">
                                    Rediscover your natural glow with our Signature Facials—available through expert salons near you. Each facial is personalized to your skin type and concerns, using high-performance skincare and gentle techniques. From deep pore cleansing to collagen-boosting serums, enjoy a treatment designed to refresh, hydrate, and renew your skin.
                                </p>

                                
                                <!-- Service Experience Info Start -->
                                <div class="service-experience-info">
                                    <!-- Why Choose Item List Start -->
                                    <div class="why-choose-item-list">
                                        <!-- Why Choose Item Start -->
                                        <div class="why-choose-item wow fadeInUp" data-wow-delay="0.6s">
                                            <div class="why-choose-item-header">
                                                <div class="icon-box">
                                                    <img src="images/icon-service-2.svg" alt="">
                                                </div>
                                                <div class="why-choose-item-title">
                                                    <h3>Approach & Wellness</h3>
                                                </div>
                                            </div>
                                            <div class="why-choose-item-content">
                                                <p>We connect you with salons that prioritize both your beauty and comfort.</p>
                                            </div>

                                        </div>
                                        <!-- Why Choose Item End -->
                                        
                                        <!-- Why Choose Item Start -->
                                        <div class="why-choose-item wow fadeInUp" data-wow-delay="0.8s">
                                            <div class="why-choose-item-header">
                                                <div class="icon-box">
                                                    <img src="images/icon-service-3.svg" alt="">
                                                </div>
                                                <div class="why-choose-item-title">
                                                    <h3>Balance & Harmony</h3>
                                                </div>
                                            </div>
                                            <div class="why-choose-item-content">
                                                <p>We connect you with salons that prioritize both your beauty and comfort.</p>
                                            </div>
                                        </div>
                                        <!-- Why Choose Item End -->    
                                        
                                        <!-- Why Choose Item Start -->
                                        <div class="why-choose-item wow fadeInUp" data-wow-delay="1s">
                                            <div class="why-choose-item-header">
                                                <div class="icon-box">
                                                    <img src="images/icon-service-7.svg" alt="">
                                                </div>
                                                <div class="why-choose-item-title">
                                                    <h3>Nature & Healing</h3>
                                                </div>
                                            </div>
                                            <div class="why-choose-item-content">
                                                <p>We connect you with salons that prioritize both your beauty and comfort.</p>
                                            </div>
                                        </div>
                                        <!-- Why Choose Item End -->    
                                    </div>
                                    <!-- Why Choose Item List End -->    

                                    <!-- Service Item Start -->
                                    <div class="service-item wow fadeInUp" data-wow-delay="0.6s">
                                        <div class="icon-box">
                                            <img src="images/icon-service-3.svg" alt="">
                                        </div>                        
                                        <div class="service-content">
                                            <h3><a href="{{ url('/service-detail') }}">Hydration Boost</a></h3>
                                            <p>This all-in-one treatment begins with thorough skin.</p>
                                        </div>                     
                                    </div>
                                    <!-- Service Item End -->
                                </div>
                                <!-- Service Experience Info End -->
                            </div>
                            <!-- Service Experience Box End -->

                            <!-- Service Results Box Start -->
                            <div class="service-results-box">
                                <h2 class="text-anime-style-2">Real results <span>glowing confidence</span></h2>
                                <p class="wow fadeInUp">See the difference our Signature Facials make. From brighter skin tone to reduced blemishes and a visible glow, our clients walk out feeling renewed and radiant. Each treatment is more than just skincare — it's a step toward lasting confidence and well-being.</p>
                                
                                <!-- Service Results Counters Start -->
                                <div class="service-results-counters">
                                    <!-- Service Results Counter Item Start -->
                                    <div class="service-result-counter-item">
                                        <h2><span class="counter">12</span>k+</h2>
                                        <p>Years of experience</p>
                                    </div>
                                    <!-- Service Results Counter Item End -->
                                    
                                    <!-- Service Results Counter Item Start -->
                                    <div class="service-result-counter-item">
                                        <h2><span class="counter">10</span>k+</h2>
                                        <p>Satisfied member</p>
                                    </div>
                                    <!-- Service Results Counter Item End -->
                                    
                                    <!-- Service Results Counter Item Start -->
                                    <div class="service-result-counter-item">
                                        <h2><span class="counter">90</span>%</h2>
                                        <p>Reduced dullness</p>
                                    </div>
                                    <!-- Service Results Counter Item End -->
                                    
                                    <!-- Service Results Counter Item Start -->
                                    <div class="service-result-counter-item">
                                        <h2><span class="counter">98</span>%</h2>
                                        <p>Positive result</p>
                                    </div>
                                    <!-- Service Results Counter Item End -->
                                </div>
                                <!-- Service Results Counters End -->
                                
                                <!-- Service Results List Start -->
                                <div class="service-results-list wow fadeInUp" data-wow-delay="0.2s">
                                    <ul>
                                        <li>Personalize facial design meet your unique</li>
                                        <li>Experience deep calm while achiev visible</li>
                                        <li>We use only safe, effective & skin-friendly</li>
                                        <li>Performe certifie esthetician with proven</li>
                                    </ul>
                                </div>
                                <!-- Service Results List End -->
                                
                                <!-- Service Intro Video Start -->
                                <div class="service-intro-video">
                                    <!-- Service Intro Video Image Start -->
                                    <div class="service-intro-video-image">
                                        <figure class="image-anime reveal">
                                            <img src="images/vinicius-amnx-amano-lK8oXGycy88-unsplash.jpg" alt="">
                                        </figure>
                                    </div>
                                    <!-- Service Intro Video Image End -->

                                    <!-- Video Play Button Start -->
                                    <div class="video-play-button">
                                        <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play">
                                            <i class="fa-solid fa-play"></i>
                                        </a>
                                    </div>
                                    <!-- Video Play Button End -->
                                </div>
                                <!-- Service Intro Video End -->
                            </div>
                            <!-- Service Results Box End -->
                                
                            <!-- Service Extend Box Start -->
                            <div class="service-extend-box">
                                <h2 class="text-anime-style-2">Extend the glow beyond the <span>spa</span></h2>
                                <p class="wow fadeInUp">Your facial doesn't end when you leave our space. We guide you with personalized post-treatment care tips to help maintain your glow, protect your skin, and enhance results in your daily routine.</p>
                                
                                <!-- Service Extend List Start -->
                                <div class="service-extend-list">
                                    <!-- Approach List Item Start -->
                                    <div class="approach-list-item wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="icon-box">
                                            <img src="images/icon-approach-1.svg" alt="">
                                        </div>
                                        <div class="approach-list-content">
                                            <h3>Aftercare Tips</h3>
                                            <p>To provide a sanctuary where holistic wellness meets mindful relaxation. Through personalized care, natural therapies, and a tranquil.</p>
                                        </div>
                                    </div>
                                    <!-- Approach List Item End -->
                                    
                                    <!-- Approach List Item Start -->
                                    <div class="approach-list-item wow fadeInUp" data-wow-delay="0.4s">
                                        <div class="icon-box">
                                            <img src="images/icon-approach-2.svg" alt="">
                                        </div>
                                        <div class="approach-list-content">
                                            <h3>Daily Routine</h3>
                                            <p>To provide a sanctuary where holistic wellness meets mindful relaxation. Through personalized care, natural therapies, and a tranquil.</p>
                                        </div>
                                    </div>
                                    <!-- Approach List Item End -->
                                    
                                    <!-- Approach List Item Start -->
                                    <div class="approach-list-item wow fadeInUp" data-wow-delay="0.6s">
                                        <div class="icon-box">
                                            <img src="images/icon-approach-3.svg" alt="">
                                        </div>
                                        <div class="approach-list-content">
                                            <h3>Expert Guidance</h3>
                                            <p>To provide a sanctuary where holistic wellness meets mindful relaxation. Through personalized care, natural therapies, and a tranquil.</p>
                                        </div>
                                    </div>
                                    <!-- Approach List Item End -->
                                </div>
                                <!-- Service Extend List End -->
                            </div>
                            <!-- Service Extend Box End -->
                        </div>
                        <!-- Service Entry End -->
                            
                        
                    </div>
                    <!-- Service Single Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Service Single End -->
@endsection


{{-- Scripts --}}
@section('scripts')


@endsection
