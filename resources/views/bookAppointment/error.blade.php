@extends('layouts.main')
{{-- Title --}}
@section('title', 'Payment Error')

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
	
	<!-- Error Section Start -->
    <div class="page-book-appointment">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <i class="fas fa-exclamation-circle text-danger" style="font-size: 80px;"></i>
                        <h2 class="mt-4">Payment Error</h2>
                        <p class="lead">There was a problem processing your payment.</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                {{ $message }}
                            </div>
                            
                            <p class="mt-3">Please try again or contact our support team if the problem persists.</p>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <a href="/book-appointment" class="btn-default mr-3"><span>Try Again</span></a>
                        <a href="/" class="btn-alt"><span>Return to Home</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Error Section End -->
@endsection
