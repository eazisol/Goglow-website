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
                        <h1 class="text-anime-style-2" data-cursor="-opaque">Book <span>appointment</span></h1>
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
                            <img src="images/appointment-image.jpg" alt="">
                        </figure>
                        
                        <!-- Appointment Info List Start -->
                        {{-- <div class="appointment-timing-box">
                            <h3>Opening Hours:</h3>
                            <ul>
                                <li>Mon - Fri ( 09:00 - 21:00 )</li>
                                <li>Saturday ( 09:00 - 14:00 )</li>
                                <li>Sunday ( Closed )</li>
                            </ul>
                        </div> --}}
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
    
                                <div class="col-md-12">
                                    <button type="submit" class="btn-default"><span>Book an appointment</span></button>
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
@endsection


{{-- Scripts --}}
@section('scripts')


@endsection
