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
                        <h1 class="text-anime-style-2" >Saloons <span></span></h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                {{-- <li class="breadcrumb-item"><a href="index-2.html">home</a></li> --}}
                                {{-- <li class="breadcrumb-item active" aria-current="page">Case study</li> --}}
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
	
	<!-- Page Case Study Start -->
    <div class="page-case-study">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Case Study Item Start -->
                    <div class="case-study-item wow fadeInUp">
                        <!-- Case Study Image Start -->
                        <div class="case-study-image">
                            <a href="{{ url('/services') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/velvetyparis-saloon.png" alt="">
                                </figure>
                            </a>
                        </div>
                        <!-- Case Study Image End -->
                
                        <!-- Case Study Body Start -->
                        <div class="case-study-body">
                            <!-- Case Study Content Start -->
                            <div class="case-study-item-content">
                                <h3><a href="{{ url('/services') }}">Velvety Paris</a></h3>
                            </div>
                            <!-- Case Study Content End -->
                
                            <!-- Case Study Readmore Button Start -->
                            <div class="case-study-readmore-btn">
                                <a href="{{ url('/services') }}"><img src="images/arrow-secondary.svg" alt=""></a>
                            </div>
                            <!-- Case Study Readmore Button End -->
                        </div>
                        <!-- Case Study Body End -->                 
                    </div>
                    <!-- Case Study Item End -->
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <!-- Case Study Item Start -->
                    <div class="case-study-item wow fadeInUp" data-wow-delay="0.2s">
                        <!-- Case Study Image Start -->
                        <div class="case-study-image">
                            <a href="{{ url('/services') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/WoodySaeïé-saloon.png" alt="">
                                </figure>
                            </a>
                        </div>
                        <!-- Case Study Image End -->
                
                        <!-- Case Study Body Start -->
                        <div class="case-study-body">
                            <!-- Case Study Content Start -->
                            <div class="case-study-item-content">
                                <h3><a href="{{ url('/services') }}">Woody Saeïé</a></h3>
                            </div>
                            <!-- Case Study Content End -->
                
                            <!-- Case Study Readmore Button Start -->
                            <div class="case-study-readmore-btn">
                                <a href="{{ url('/services') }}"><img src="images/arrow-secondary.svg" alt=""></a>
                            </div>
                            <!-- Case Study Readmore Button End -->
                        </div>
                        <!-- Case Study Body End -->                 
                    </div>
                    <!-- Case Study Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Case Study Item Start -->
                    <div class="case-study-item wow fadeInUp" data-wow-delay="0.4s">
                        <!-- Case Study Image Start -->
                        <div class="case-study-image">
                            <a href="{{ url('/services') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/Yhairdressing-saloon.png" alt="">
                                </figure>
                            </a>
                        </div>
                        <!-- Case Study Image End -->
                
                        <!-- Case Study Body Start -->
                        <div class="case-study-body">
                            <!-- Case Study Content Start -->
                            <div class="case-study-item-content">
                                <h3><a href="{{ url('/services') }}">Y Hairdressing</a></h3>
                            </div>
                            <!-- Case Study Content End -->
                
                            <!-- Case Study Readmore Button Start -->
                            <div class="case-study-readmore-btn">
                                <a href="{{ url('/services') }}"><img src="images/arrow-secondary.svg" alt=""></a>
                            </div>
                            <!-- Case Study Readmore Button End -->
                        </div>
                        <!-- Case Study Body End -->                 
                    </div>
                    <!-- Case Study Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Case Study Item Start -->
                    <div class="case-study-item wow fadeInUp" data-wow-delay="0.6s">
                        <!-- Case Study Image Start -->
                        <div class="case-study-image">
                            <a href="{{ url('/services') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/Jean-MarcJoubert-saloon.png" alt="">
                                </figure>
                            </a>
                        </div>
                        <!-- Case Study Image End -->
                
                        <!-- Case Study Body Start -->
                        <div class="case-study-body">
                            <!-- Case Study Content Start -->
                            <div class="case-study-item-content">
                                <h3><a href="{{ url('/services') }}">Jean-Marc Joubert</a></h3>
                            </div>
                            <!-- Case Study Content End -->
                
                            <!-- Case Study Readmore Button Start -->
                            <div class="case-study-readmore-btn">
                                <a href="{{ url('/services') }}"><img src="images/arrow-secondary.svg" alt=""></a>
                            </div>
                            <!-- Case Study Readmore Button End -->
                        </div>
                        <!-- Case Study Body End -->                 
                    </div>
                    <!-- Case Study Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Case Study Item Start -->
                    <div class="case-study-item wow fadeInUp" data-wow-delay="0.8s">
                        <!-- Case Study Image Start -->
                        <div class="case-study-image">
                            <a href="{{ url('/services') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/IrisAdonia-saloon.png" alt="">
                                </figure>
                            </a>
                        </div>
                        <!-- Case Study Image End -->
                
                        <!-- Case Study Body Start -->
                        <div class="case-study-body">
                            <!-- Case Study Content Start -->
                            <div class="case-study-item-content">
                                <h3><a href="{{ url('/services') }}">Iris Adonia</a></h3>
                            </div>
                            <!-- Case Study Content End -->
                
                            <!-- Case Study Readmore Button Start -->
                            <div class="case-study-readmore-btn">
                                <a href="{{ url('/services') }}"><img src="images/arrow-secondary.svg" alt=""></a>
                            </div>
                            <!-- Case Study Readmore Button End -->
                        </div>
                        <!-- Case Study Body End -->                 
                    </div>
                    <!-- Case Study Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Case Study Item Start -->
                    <div class="case-study-item wow fadeInUp" data-wow-delay="1s">
                        <!-- Case Study Image Start -->
                        <div class="case-study-image">
                            <a href="{{ url('/services') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/EVEN-saloon.png" alt="">
                                </figure>
                            </a>
                        </div>
                        <!-- Case Study Image End -->
                
                        <!-- Case Study Body Start -->
                        <div class="case-study-body">
                            <!-- Case Study Content Start -->
                            <div class="case-study-item-content">
                                <h3><a href="{{ url('/services') }}">EVEN</a></h3>
                            </div>
                            <!-- Case Study Content End -->
                
                            <!-- Case Study Readmore Button Start -->
                            <div class="case-study-readmore-btn">
                                <a href="{{ url('/services') }}"><img src="images/arrow-secondary.svg" alt=""></a>
                            </div>
                            <!-- Case Study Readmore Button End -->
                        </div>
                        <!-- Case Study Body End -->                 
                    </div>
                    <!-- Case Study Item End -->
                </div>
{{-- 
                <div class="col-lg-4 col-md-6">
                    <!-- Case Study Item Start -->
                    <div class="case-study-item wow fadeInUp" data-wow-delay="1.2s">
                        <!-- Case Study Image Start -->
                        <div class="case-study-image">
                            <a href="{{ url('/case-study-single') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/case-study-7.jpg" alt="">
                                </figure>
                            </a>
                        </div>
                        <!-- Case Study Image End -->
                
                        <!-- Case Study Body Start -->
                        <div class="case-study-body">
                            <!-- Case Study Content Start -->
                            <div class="case-study-item-content">
                                <h3><a href="{{ url('/case-study-single') }}">Soothing Therapeutic Touch</a></h3>
                            </div>
                            <!-- Case Study Content End -->
                
                            <!-- Case Study Readmore Button Start -->
                            <div class="case-study-readmore-btn">
                                <a href="{{ url('/case-study-single') }}"><img src="images/arrow-secondary.svg" alt=""></a>
                            </div>
                            <!-- Case Study Readmore Button End -->
                        </div>
                        <!-- Case Study Body End -->                 
                    </div>
                    <!-- Case Study Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Case Study Item Start -->
                    <div class="case-study-item wow fadeInUp" data-wow-delay="1.4s">
                        <!-- Case Study Image Start -->
                        <div class="case-study-image">
                            <a href="{{ url('/case-study-single') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/case-study-8.jpg" alt="">
                                </figure>
                            </a>
                        </div>
                        <!-- Case Study Image End -->
                
                        <!-- Case Study Body Start -->
                        <div class="case-study-body">
                            <!-- Case Study Content Start -->
                            <div class="case-study-item-content">
                                <h3><a href="{{ url('/case-study-single') }}">Peaceful Rejuvenation Therapy</a></h3>
                            </div>
                            <!-- Case Study Content End -->
                
                            <!-- Case Study Readmore Button Start -->
                            <div class="case-study-readmore-btn">
                                <a href="{{ url('/case-study-single') }}"><img src="images/arrow-secondary.svg" alt=""></a>
                            </div>
                            <!-- Case Study Readmore Button End -->
                        </div>
                        <!-- Case Study Body End -->                 
                    </div>
                    <!-- Case Study Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Case Study Item Start -->
                    <div class="case-study-item wow fadeInUp" data-wow-delay="1.6s">
                        <!-- Case Study Image Start -->
                        <div class="case-study-image">
                            <a href="{{ url('/case-study-single') }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img src="images/case-study-9.jpg" alt="">
                                </figure>
                            </a>
                        </div>
                        <!-- Case Study Image End -->
                
                        <!-- Case Study Body Start -->
                        <div class="case-study-body">
                            <!-- Case Study Content Start -->
                            <div class="case-study-item-content">
                                <h3><a href="{{ url('/case-study-single') }}">Balanced Tranquility Space</a></h3>
                            </div>
                            <!-- Case Study Content End -->
                
                            <!-- Case Study Readmore Button Start -->
                            <div class="case-study-readmore-btn">
                                <a href="{{ url('/case-study-single') }}"><img src="images/arrow-secondary.svg" alt=""></a>
                            </div>
                            <!-- Case Study Readmore Button End -->
                        </div>
                        <!-- Case Study Body End -->                 
                    </div>
                    <!-- Case Study Item End -->
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Page Case Study End -->
@endsection


{{-- Scripts --}}
@section('scripts')


@endsection
