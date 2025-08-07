@extends('layouts.main')

@section('title', 'Provider Services')

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
<!-- Provider Services Section Start -->
<div class="provider-services" style="margin: 50px 0 50px 0;">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="provider-header mb-1">
                    <div class="row align-items-center">
                        <div class="col-md-10">
                            <h2>{{ $provider['storeName'] ?? $provider['name'] }}</h2>
                            @if(isset($provider['companyName']))
                                <h4>{{ $provider['companyName'] }}</h4>
                            @endif
                            <div class="provider-info">
                                @if(isset($provider['address']))
                                    <p><i class="fas fa-map-marker-alt"></i> {{ $provider['address'] }}</p>
                                @endif
                                @if(isset($provider['avg_ratting']) && $provider['avg_ratting'] > 0)
                                    <p>
                                        <i class="fas fa-star text-warning"></i>
                                        {{ $provider['avg_ratting'] }} ({{ $provider['total_review'] ?? 0 }} reviews)
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="provider-image">
                                <img src="{{ isset($provider['profileImg']) && $provider['profileImg'] ? $provider['profileImg'] : asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}" 
                                     alt="{{ $provider['name'] }}" 
                                     class="img-fluid"
                                     onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                            </div>
                </div>
            </div>
        </div>


        <div class="row">
            @if(count($services) > 0)
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="service-card">
                            <div class="service-image">
                                <img src="{{ (isset($service['images']) && count($service['images']) > 0) ? $service['images'][0] : asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}" 
                                     alt="{{ $service['service_name'] }}" 
                                     class="img-fluid"
                                     onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                            </div>
                            <div class="service-details p-4">
                                <h3>{{ $service['service_name'] }}</h3>
                                <p>{{ $service['service_details'] }}</p>
                                <div class="service-meta">
                                    <div class="price">
                                        <strong>Price:</strong> ${{ $service['service_price'] ?? '0' }}
                                        @if(isset($service['discounted_price']) && isset($service['service_price']) && $service['discounted_price'] < $service['service_price'])
                                            <span class="discounted">${{ $service['discounted_price'] }}</span>
                                        @endif
                                    </div>
                                    @if(isset($service['duration_minutes']))
                                        <div class="duration">
                                            <strong>Duration:</strong> {{ $service['duration_minutes'] }} minutes
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-3">
                                   <a href="{{ url('/book-appointment?serviceId=' . $service['id'] . '&service_provider_id=' . $provider['id']) }}" class="btn-default">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <h3>No services available from this provider.</h3>
                </div>
            @endif
        </div>
        
        <div class="row mt-4">
            <div class="col-12">
                <a href="{{ url()->previous() }}" class="btn-default">
                    <i></i> Back to Search Results
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Provider Services Section End -->
@endsection

@section('styles')
<style>
.provider-header {
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    color: #333;
}

.provider-image img {
    width: 100%;
    height: 300px;
    object-fit: cover;
}

.provider-info {
    margin-top: 10px;
}

.provider-info p {
    margin-bottom: 3px;
}

.provider-info i {
    margin-right: 8px;
}

.service-card {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease;
    height: 100%;
}

.service-card:hover {
    transform: translateY(-5px);
}

.service-image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.service-details {
    color: #333;
}

.discounted {
    color: #ff4444;
    text-decoration: line-through;
    margin-left: 5px;
}

.service-meta {
    margin: 15px 0;
}

.service-meta > div {
    margin-bottom: 8px;
}
</style>
@endsection
