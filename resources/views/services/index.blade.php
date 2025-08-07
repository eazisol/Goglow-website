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
                            <h3><a href="{{ url('/service-provider') }}">Signature Facials</a></h3>
                            <p>This all-in-one treatment begins with a thorough skin.</p>
                        </div>
                        <div class="service-item-list">
                            <ul>
                                <li>Skin Soul Shine</li>
                                <li>Your skin, only better.</li>
                            </ul>
                        </div>
                        <div class="service-btn">
                            <a href="{{ url('/service-provider') }}" class="readmore-btn">view more</a>
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
                            <h3><a href="{{ url('/service-provider') }}">Therapeutic Massage</a></h3>
                            <p>This all-in-one treatment begins with a thorough skin.</p>
                        </div>
                        <div class="service-item-list">
                            <ul>
                                <li>Skin Soul Shine</li>
                                <li>Your skin, only better.</li>
                            </ul>
                        </div>
                        <div class="service-btn">
                            <a href="{{ url('/service-provider') }}" class="readmore-btn">view more</a>
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
                            <h3><a href="{{ url('/service-provider') }}">Body Scrubs </a></h3>
                            <p>This all-in-one treatment begins with a thorough skin.</p>
                        </div>
                        <div class="service-item-list">
                            <ul>
                                <li>Skin Soul Shine</li>
                                <li>Your skin, only better.</li>
                            </ul>
                        </div>
                        <div class="service-btn">
                            <a href="{{ url('/service-provider') }}" class="readmore-btn">view more</a>
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
                            <h3><a href="{{ url('/service-provider') }}">Reflexology</a></h3>
                            <p>This all-in-one treatment begins with a thorough skin.</p>
                        </div>
                        <div class="service-item-list">
                            <ul>
                                <li>Skin Soul Shine</li>
                                <li>Your skin, only better.</li>
                            </ul>
                        </div>
                        <div class="service-btn">
                            <a href="{{ url('/service-provider') }}" class="readmore-btn">view more</a>
                        </div>                      
                    </div>
                    <!-- Service Item End -->
                </div>
            </div>            
        </div>
    </div>
    <!-- Page Services End -->

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

@endsection

{{-- Scripts --}}
@section('scripts')


@endsection
