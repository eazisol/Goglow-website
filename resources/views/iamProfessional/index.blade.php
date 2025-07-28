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
                        <h1 class="text-anime-style-2" data-cursor="-opaque">I am a <span>Beauty Professional</span></h1>
                        {{-- <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Book appointment</li>
                            </ol>
                        </nav> --}}
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
	
	<!-- Book Appointment Section Start -->
    <div class="page-book-appointment">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Appointment image Start -->
                    <div class="appointment-image">
                        <figure class="image-anime reveal">
                            <img src="images/anastasiia-chepinska-_VtWHnrYm4k-unsplash.jpg" alt="">
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
                                    <button type="submit" class="btn-default"><span>Get a quote</span></button>
                                    <div id="msgSubmit" class="h3 hidden"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Book Appointment Form End -->
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
                                <img src="images/hayley-kim-studios-sRSRuxkOuzI-unsplash.jpg" alt="">
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

@endsection


{{-- Scripts --}}
@section('scripts')


@endsection
