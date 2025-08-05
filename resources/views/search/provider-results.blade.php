@extends('layouts.main')

@section('title', 'Search Results')

@section('content')

    <!-- Page Header Start -->
    <div class="page-header bg-section" style="margin-bottom: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h2 class="text-anime-style-2" style="color:white;" data-cursor="-opaque">Search Results for "{{ $search }}"
                        @if($location) in "{{ $location }}" @endif
                        </h2>
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

<!-- Search Results Section Start -->
<div class="search-results" style="margin: 50px 0 50px 0;">
    <div class="container">
        

        <div class="row">
            @if(count($providers) > 0)
                @foreach($providers as $provider)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="provider-card">
                            <a href="{{ url('/search?provider_id=' . $provider['id']) }}" class="provider-link">
                                <div class="provider-image">
                                    <img src="{{ isset($provider['profileImg']) && $provider['profileImg'] ? $provider['profileImg'] : asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}" 
                                         alt="{{ $provider['name'] }}" 
                                         class="img-fluid"
                                         onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                                </div>
                                <div class="provider-details p-4">
                                    <h3>{{ $provider['storeName'] ?? $provider['name'] }}</h3>
                                    @if(isset($provider['companyName']))
                                        <p class="company-name">{{ $provider['companyName'] }}</p>
                                    @endif
                                    <div class="provider-meta">
                                        @if(isset($provider['address']))
                                            <div class="address">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span>{{ $provider['address'] }}</span>
                                            </div>
                                        @endif
                                        @if(isset($provider['avg_ratting']) && $provider['avg_ratting'] > 0)
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>{{ $provider['avg_ratting'] }} ({{ $provider['total_review'] ?? 0 }} reviews)</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="provider-details mt-3">
                                        @if(isset($provider['proType']))
                                            <div class="type">
                                                <strong>Type:</strong> {{ $provider['proType'] }}
                                            </div>
                                        @endif
                                        @if(isset($provider['timing']))
                                            <div class="timing">
                                                <strong>Available:</strong> 
                                                @foreach($provider['timing'] as $day => $times)
                                                    {{ $day }},
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <h3>No providers found matching your search criteria.</h3>
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
.provider-card {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease;
    height: 100%;
}

.provider-card:hover {
    transform: translateY(-5px);
}

.provider-link {
    text-decoration: none;
    color: inherit;
}

.provider-link:hover {
    text-decoration: none;
    color: inherit;
}

.provider-image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.provider-details {
    color: #333;
}

.company-name {
    color: #666;
    font-style: italic;
}

.provider-meta {
    margin: 15px 0;
}

.provider-meta > div {
    margin-bottom: 8px;
}

.provider-meta i {
    margin-right: 8px;
    color: #666;
}

.rating i {
    color: #ffd700;
}

.timing {
    font-size: 0.9em;
}
</style>
@endsection
