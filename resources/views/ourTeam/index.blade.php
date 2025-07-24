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
                        <h1 class="text-anime-style-2" data-cursor="-opaque">Our <span>team</span></h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Our team</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
	
	<!-- Page Team Start -->
    <div class="page-team">
        <div class="container">
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
                
                <div class="col-lg-3 col-md-6">
                    <!-- Team Item Start -->
                    <div class="team-item wow fadeInUp" data-wow-delay="0.8s">
                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3><a href="{{ url('/team-single') }}">Lana Whitmore</a></h3>
                            <p>Beauty Therapist</p>
                        </div>
                        <!-- Team Content End -->
                        
                        <!-- team Image Start -->
                        <div class="team-image">
                            <figure>
                                <img src="images/team-5.png" alt="">
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
                    <div class="team-item wow fadeInUp" data-wow-delay="1s">
                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3><a href="{{ url('/team-single') }}">Ivy Kellington</a></h3>
                            <p>Massage Consultant</p>
                        </div>
                        <!-- Team Content End -->

                        <!-- team Image Start -->
                        <div class="team-image">
                            <figure>
                                <img src="images/team-6.png" alt="">
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
                    <div class="team-item wow fadeInUp" data-wow-delay="1.2s">
                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3><a href="{{ url('/team-single') }}">Celeste Monroe</a></h3>
                            <p>Skincare Specialist</p>
                        </div>
                        <!-- Team Content End -->

                        <!-- team Image Start -->
                        <div class="team-image">
                            <figure>
                                <img src="images/team-7.png" alt="">
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
                    <div class="team-item wow fadeInUp" data-wow-delay="1.4s">
                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3><a href="{{ url('/team-single') }}">Nora Ashfield</a></h3>
                            <p>Healing Practitioner</p>
                        </div>
                        <!-- Team Content End -->

                        <!-- team Image Start -->
                        <div class="team-image">
                            <figure>
                                <img src="images/team-8.png" alt="">
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
    <!-- Page Team End -->
@endsection


{{-- Scripts --}}
@section('scripts')


@endsection
