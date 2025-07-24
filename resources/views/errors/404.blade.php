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
                        <h1 class="text-anime-style-2" data-cursor="-opaque">Page <span>not found</span></h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">404 Error page</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
	
	<!-- error section start -->
    <div class="error-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Error Page Image Start -->
                    <div class="error-page-image wow fadeInUp">
                        <img src="images/404-error-img.png" alt="">
                    </div>
                    <!-- Error Page Image End -->
                    
                    <!-- Error Page Content Start -->
                    <div class="error-page-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Oops! page <span>not found</span></h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- Error Page Content Body Start -->
                        <div class="error-page-content-body">
                            <p class="wow fadeInUp" data-wow-delay="0.2s">The page you are looking for does not exist.</p>
                            <a class="btn-default wow fadeInUp" data-wow-delay="0.4s" href="index-2.html">back to home</a>
                        </div>
                        <!-- Error Page Content Body End -->
                    </div>
                    <!-- Error Page Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- error section end -->
@endsection


{{-- Scripts --}}
@section('scripts')


@endsection
