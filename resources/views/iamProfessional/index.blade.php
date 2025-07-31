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
                            <img src="images/john-arano-CCTCHXEsan8-unsplash.jpg" alt="">
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
                                <div class="form-group col-md-12 mb-4">
                                    <input type="text" name="brand_name" class="form-control" id="brand_name" placeholder="Name / Brand Name" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-12 mb-4">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <input type="tel" name="whatsapp" class="form-control" id="whatsapp" placeholder="WhatsApp Number" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="instagram" class="form-control" id="instagram" placeholder="Instagram Handle" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="tiktok" class="form-control" id="tiktok" placeholder="TikTok Handle" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <input type="text" name="current_platform" class="form-control" id="current_platform" placeholder="What platform are you using now?" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="terms" class="form-check-input" id="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="{{ url('/terms-conditions') }}" target="_blank">Terms & Conditions</a>
                                        </label>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn-default"><span>Submit Application</span></button>
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
@endsection


{{-- Scripts --}}
@section('scripts')


@endsection
