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
                        <h1 class="text-anime-style-2" data-cursor="-opaque">Our <span>testimonials</span></h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Our testimonials</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
	
	<!-- Page Testimonials Start -->
    <div class="page-testimonials">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Testimonial Item Start -->
                    <div class="testimonial-item wow fadeInUp">
                        <div class="testimonial-header">
                            <div class="testimonial-company-logo">
                                <img src="images/company-logo-1.svg" alt="">
                            </div>
                            <div class="testimonial-quote">
                                <img src="images/testimonial-quote-accent.svg" alt="">
                            </div>
                        </div>
                        <div class="testimonial-content">
                            <p>My experience at Logoipsum was nothing short of incredible. From the moment I walked through the doors, I was greeted with warmth and professionalism. The atmosphere was serene and calming, making me feel relaxed even before my treatments began. I booked a full spa day.</p>
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
                    <!-- Testimonial Item End -->
                </div>
                
                <div class="col-md-6">
                    <!-- Testimonial Item Start -->
                    <div class="testimonial-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="testimonial-header">
                            <div class="testimonial-company-logo">
                                <img src="images/company-logo-1.svg" alt="">
                            </div>
                            <div class="testimonial-quote">
                                <img src="images/testimonial-quote-accent.svg" alt="">
                            </div>
                        </div>
                        <div class="testimonial-content">
                            <p>My experience at Logoipsum was nothing short of incredible. From the moment I walked through the doors, I was greeted with warmth and professionalism. The atmosphere was serene and calming, making me feel relaxed even before my treatments began. I booked a full spa day.</p>
                        </div>
                        <div class="testimonial-author">       
                            <div class="author-image">
                                <figure class="image-anime">
                                    <img src="images/author-2.jpg" alt="">
                                </figure>
                            </div>
                            <div class="author-content">
                                <h3>Camila Dawson</h3>
                                <p>Facial Expert</p>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial Item End -->
                </div>
                
                <div class="col-md-6">
                    <!-- Testimonial Item Start -->
                    <div class="testimonial-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="testimonial-header">
                            <div class="testimonial-company-logo">
                                <img src="images/company-logo-1.svg" alt="">
                            </div>
                            <div class="testimonial-quote">
                                <img src="images/testimonial-quote-accent.svg" alt="">
                            </div>
                        </div>
                        <div class="testimonial-content">
                            <p>My experience at Logoipsum was nothing short of incredible. From the moment I walked through the doors, I was greeted with warmth and professionalism. The atmosphere was serene and calming, making me feel relaxed even before my treatments began. I booked a full spa day.</p>
                        </div>
                        <div class="testimonial-author">       
                            <div class="author-image">
                                <figure class="image-anime">
                                    <img src="images/author-3.jpg" alt="">
                                </figure>
                            </div>
                            <div class="author-content">
                                <h3>Savannah Carter</h3>
                                <p>Facial Expert</p>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial Item End -->
                </div>
                
                <div class="col-md-6">
                    <!-- Testimonial Item Start -->
                    <div class="testimonial-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="testimonial-header">
                            <div class="testimonial-company-logo">
                                <img src="images/company-logo-1.svg" alt="">
                            </div>
                            <div class="testimonial-quote">
                                <img src="images/testimonial-quote-accent.svg" alt="">
                            </div>
                        </div>
                        <div class="testimonial-content">
                            <p>My experience at Logoipsum was nothing short of incredible. From the moment I walked through the doors, I was greeted with warmth and professionalism. The atmosphere was serene and calming, making me feel relaxed even before my treatments began. I booked a full spa day.</p>
                        </div>
                        <div class="testimonial-author">       
                            <div class="author-image">
                                <figure class="image-anime">
                                    <img src="images/author-4.jpg" alt="">
                                </figure>
                            </div>
                            <div class="author-content">
                                <h3>Elijah Bennett</h3>
                                <p>Wellness Coach</p>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial Item End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Testimonials End -->

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
