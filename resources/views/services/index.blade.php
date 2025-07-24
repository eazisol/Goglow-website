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
                        <h1 class="text-anime-style-2" data-cursor="-opaque">Our <span>services</span></h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Our services</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Page Services Start -->
    <div class="page-services">
        <div class="container">
            <div class="row service-list">
                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp">
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
                    <div class="service-item active wow fadeInUp" data-wow-delay="0.2s">
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
                
                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.8s">
                        <div class="icon-box">
                            <img src="images/icon-service-5.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3><a href="{{ url('/service-detail') }}">Healing Therapy</a></h3>
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
                    <div class="service-item wow fadeInUp" data-wow-delay="1s">
                        <div class="icon-box">
                            <img src="images/icon-service-6.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3><a href="{{ url('/service-detail') }}">Rejuvenation Ritual</a></h3>
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
                    <div class="service-item wow fadeInUp" data-wow-delay="1.2s">
                        <div class="icon-box">
                            <img src="images/icon-service-7.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3><a href="{{ url('/service-detail') }}">Revitalizing Facial</a></h3>
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
                    <div class="service-item wow fadeInUp" data-wow-delay="1.4s">
                        <div class="icon-box">
                            <img src="images/icon-service-8.svg" alt="">
                        </div>                        
                        <div class="service-content">
                            <h3><a href="{{ url('/service-detail') }}">Bliss Therapy</a></h3>
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
            </div>            
        </div>
    </div>
    <!-- Page Services End -->

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
@endsection

{{-- Scripts --}}
@section('scripts')


@endsection
