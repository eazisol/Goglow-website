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
	
	<!-- Page Contact Us Start -->
    <div class="page-contact-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Contact Us Content Start -->
                    <div class="contact-us-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">contact us</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Get in touch <span>with us</span></h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                Have questions or need help booking your next salon service? We're here to assist you—reach out anytime and let’s make beauty simple.
                            </p>
                        </div>

                        <!-- Section Title End -->

                        <!-- Contact Info Box Start -->
                        <div class="contact-info-box wow fadeInUp" data-wow-delay="0.4s">
                            <!-- Contact Info List Start -->
                            <div class="contact-info-list">
                                <!-- Contact Info Item Start -->
                                <div class="contact-info-item">
                                    <div class="icon-box">
                                        <img src="images/icon-phone-accent.svg" alt="">
                                    </div>
                                    <div class="contact-item-content">
                                        <h3>Contact</h3>
                                        <p><a href="tel:246333085">+33 (607) 424-151</a></p>
                                    </div>
                                </div>
                                <!-- Contact Info Item End -->

                                <!-- Contact Info Item Start -->
                                <div class="contact-info-item">
                                    <div class="icon-box">
                                        <img src="images/icon-location-accent.svg" alt="">
                                    </div>
                                    <div class="contact-item-content">
                                        <h3>Location</h3>
                                        <p>23 boulevard de sebastopol, 75001 Paris</p>
                                    </div>
                                </div>
                                <!-- Contact Info Item End -->

                                <!-- Contact Info Item Start -->
                                <div class="contact-info-item">
                                    <div class="icon-box">
                                        <img src="images/icon-mail-accent.svg" alt="">
                                    </div>
                                    <div class="contact-item-content">
                                        <h3>Email</h3>
                                        <p><a href="mailto:support@domain.com">contact@goglow.com</a></p>
                                    </div>
                                </div>
                                <!-- Contact Info Item End -->

                                <!-- Contact Info Item Start -->
                                <div class="contact-info-item">
                                    <div class="icon-box">
                                        <img src="images/icon-clock-accent.svg" alt="">
                                    </div>
                                    <div class="contact-item-content">
                                        <h3>Working Hours</h3>
                                        <p>24/7</p>
                                    </div>
                                </div>
                                <!-- Contact Info Item End -->
                            </div>
                            <!-- Contact Info List End -->

                            <!-- Contact Social List Start -->
                            <div class="contact-social-links">
                                <h3>Follow on social :</h3>
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                            <!-- Contact Social List End -->
                        </div>
                        <!-- Contact Info Box End -->
                    </div>
                    <!-- Contact Us Content End -->                       
                </div>

                <div class="col-lg-6">
                    <!-- Contact Us Form Start -->
                    <div class="contact-us-form">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Send us a message</h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- Contact Form Start -->
                        <div class="contact-form">
                            <form id="contactForm" action="#" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.2s">
                                <div class="row">                                
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="email" name ="email" class="form-control" id="email" placeholder="E - mail Address" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-12 mb-5">
                                        <textarea name="message" class="form-control" id="message" rows="4" placeholder="Message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn-default">Submit Message</button>
                                        <div id="msgSubmit" class="h3 hidden"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Contact Form End -->
                    </div>
                    <!-- Contact Us Form End -->
                </div>

                <div class="col-lg-12">
                    <!-- Google Map IFrame Start -->
                    <div class="google-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96737.10562045308!2d-74.08535042841811!3d40.739265258395164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1703158537552!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <!-- Google Map IFrame End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Contact Us End -->
@endsection


{{-- Scripts --}}
@section('scripts')


@endsection
