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
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/services') }}">services</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Signature facials</li>
                            </ol>
                        </nav>
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

                        <!-- Sidebar CTA Box Start -->
                        <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.25s">
                            <div class="sidebar-cta-content">
                                <h3>Connect with Us to Begin Your Mindful Wellness Journey</h3>
                                <a href="tel:+246333085" class="btn-default"><img src="images/icon-phone.svg" alt=""> +1 (246) 333-085</a>
                            </div>
                            <div class="sidebar-cta-image">
                                <figure class="image-anime">
                                    <img src="images/sidebar-cta-image.jpg" alt="">
                                </figure>
                            </div>
                        </div>
                        <!-- Sidebar CTA Box End -->
                    </div>
                    <!-- Page Single Sidebar End -->
                </div>

                <div class="col-lg-8">
                    <!-- Service Single Content Start -->
                    <div class="service-single-content">
                        <!-- Service Featured Image Start -->
                        <div class="page-single-image">
                            <figure class="image-anime reveal">
                                <img src="images/service-featured-image.jpg" alt="">
                            </figure>
                        </div>
                        <!-- Service Featured Image End -->
                        
                        <!-- Service Entry Start -->
                        <div class="service-entry">
                            <p class="wow fadeInUp">Rediscover your natural glow with our Signature Facials, expertly designed to cleanse, hydrate, and rejuvenate your skin. Each facial is tailored to your unique skin type and concerns, combining high-performance skincare with gentle, therapeutic techniques. From deep pore cleansing to collagen-boosting serums, we bring out your skin's healthiest, most radiant version.</p>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Our experienced estheticians use only premium, skin-friendly products, ensuring a soothing and effective treatment with visible results. Whether you're seeking age-defying care, hydration, or a calming reset, our Signature Facials offer a deeply relaxing experience</p>

                            <!-- Service Experience Box Start -->
                            <div class="service-experience-box">
                                <h2 class="text-anime-style-2">What to expect your <span>facial experience</span></h2>
                                <p class="wow fadeInUp" data-wow-delay="0.4s">Rediscover your natural glow with our Signature Facials, expertly designed to cleanse, hydrate, and rejuvenate your skin. Each facial is tailored to your unique skin type and concerns, combining high-performance skincare gentle, therapeutic techniques from deep pore cleansing to collagen-boosting serums.</p>
                                
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
                                                <p>We treat the whole you—mind, body, and spirit—through.</p>
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
                                                <p>We treat the whole you—mind, body, and spirit—through.</p>
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
                                                <p>We treat the whole you—mind, body, and spirit—through.</p>
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
                                            <img src="images/service-intro-video-image.jpg" alt="">
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
                            
                        <!-- Page Single FAQs Start -->
                        <div class="page-single-faqs">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h2 class="text-anime-style-2" data-cursor="-opaque">Frequently asked <span>questions</span></h2>
                            </div>
                            <!-- Section Title End -->

                            <!-- FAQ Accordion Start -->
                            <div class="faq-accordion" id="faqaccordion">
                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp">
                                    <h2 class="accordion-header" id="faqheading1">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqcollapse1" aria-expanded="true" aria-controls="faqcollapse1">
                                            Q1. What should I wear to my spa appointment?
                                        </button>
                                    </h2>
                                    <div id="faqcollapse1" class="accordion-collapse collapse" aria-labelledby="faqheading1" data-bs-parent="#faqaccordion">
                                        <div class="accordion-body">
                                            <p>For your comfort and relaxation, we recommend wearing loose, comfortable clothing that you can easily change out of. For massage or body treatments, you'll typically be draped with a towel.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.2s">
                                    <h2 class="accordion-header" id="faqheading2">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqcollapse2" aria-expanded="false" aria-controls="faqcollapse2">
                                            Q2. Do I need to book in advance?
                                        </button>
                                    </h2>
                                    <div id="faqcollapse2" class="accordion-collapse collapse show" aria-labelledby="faqheading2" data-bs-parent="#faqaccordion">
                                        <div class="accordion-body">
                                            <p>For your comfort and relaxation, we recommend wearing loose, comfortable clothing that you can easily change out of. For massage or body treatments, you'll typically be draped with a towel.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.4s">
                                    <h2 class="accordion-header" id="faqheading3">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqcollapse3" aria-expanded="false" aria-controls="faqcollapse3">
                                            Q3. What is your cancellation policy?
                                        </button>
                                    </h2>
                                    <div id="faqcollapse3" class="accordion-collapse collapse" aria-labelledby="faqheading3" data-bs-parent="#faqaccordion">
                                        <div class="accordion-body">
                                            <p>For your comfort and relaxation, we recommend wearing loose, comfortable clothing that you can easily change out of. For massage or body treatments, you'll typically be draped with a towel.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->    

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.6s">
                                    <h2 class="accordion-header" id="faqheading4">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqfaqcollapse1" aria-expanded="false" aria-controls="faqfaqcollapse1">
                                            Q4. Are your products safe for sensitive skin?
                                        </button>
                                    </h2>
                                    <div id="faqfaqcollapse1" class="accordion-collapse collapse" aria-labelledby="faqheading4" data-bs-parent="#faqaccordion">
                                        <div class="accordion-body">
                                            <p>For your comfort and relaxation, we recommend wearing loose, comfortable clothing that you can easily change out of. For massage or body treatments, you'll typically be draped with a towel.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->
                            </div>
                            <!-- FAQ Accordion End -->
                        </div>
                        <!-- Page Single FAQs End -->
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
