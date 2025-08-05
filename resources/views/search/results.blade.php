@extends('layouts.main')

@section('title', 'Search Results')

@section('content')
<!-- Search Results Section Start -->
<!-- Page Header Start -->
    <div class="page-header bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        
                        <h1 class="text-anime-style-2" data-cursor="-opaque">Search Results for "{{ $search }}"
                        @if($location) in "{{ $location }}" @endif
                        </h1>
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
<div class="search-results" style="margin-top: 50px;">
    <div class="container">
        {{-- <div class="row section-row">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Search Results for "{{ $search }}"
                        @if($location) in "{{ $location }}" @endif
                    </h2>
                </div>
            </div>
        </div> --}}

        <div class="row">
            @if(count($services) > 0)
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="service-card">
                            <div class="service-image">
                                @if(isset($service['images']) && count($service['images']) > 0)
                                    <img src="{{ $service['images'][0] }}" alt="{{ $service['service_name'] }}" class="img-fluid">
                                @endif
                            </div>
                            <div class="service-details p-4">
                                <h3>{{ $service['service_name'] }}</h3>
                                <p>{{ $service['service_details'] }}</p>
                                <div class="provider-info d-flex align-items-center mb-3">
                                    <img src="{{ $service['ownerImage'] ?? '' }}" alt="{{ $service['ownerName'] }}" class="rounded-circle mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                                    <span>{{ $service['ownerName'] }}</span>
                                </div>
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
                                    @if(isset($service['avg_ratting']) && $service['avg_ratting'] > 0)
                                        <div class="rating">
                                            <strong>Rating:</strong> {{ $service['avg_ratting'] }} ({{ $service['total_review'] ?? 0 }} reviews)
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <a href="{{ url('/book-appointment?service=' . $service['id']) }}" class="btn-default">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <h3>No services found matching your search criteria.</h3>
                    <p>Try adjusting your search terms or location.</p>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Search Results Section End -->
@endsection

@section('styles')
<style>
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

.provider-info img {
    margin-right: 10px;
}
</style>
@endsection
