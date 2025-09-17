@extends('layouts.main')

@section('title', 'Search Results')

@section('content')

    <!-- Page Header Start -->
    <div class="page-header bg-section" style="margin-bottom: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
                                <div class="search-bar">
                                    <form action="{{ route('search') }}" method="GET" class="search-form">
                                        <div class="search-inputs">
                                            <div class="search-item">
                                                <i class="fas fa-search"></i>
                                                <div class="input-text">
                                                    <h5>{{ __('app.home.search_input_text') }}</h5>
                                                    <input type="text" id="searchInput" placeholder="{{ __('app.home.search_service_placeholder') }}" name="search" required>
                                                </div>
                                            </div>
                                            
                                            <div class="search-item">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <div class="input-text">
                                                    <h5>Or</h5>
                                                    <input type="text" id="locationInput" placeholder="{{ __('app.home.search_location_placeholder') }}" name="location">
                                                </div>
                                            </div>
                                            
                                            <button type="submit" class="search-button">{{ __('app.home.search_button') }}</button>

                                            <script>
                                                document.getElementById('searchInput').addEventListener('input', function() {
                                                    const searchValue = this.value.toLowerCase();
                                                    const locationInput = document.getElementById('locationInput');
                                                    
                                                    // Make an API call to check if the search term matches any provider names
                                                    fetch('https://us-central1-beauty-984c8.cloudfunctions.net/searchProviders')
                                                        .then(response => response.json())
                                                        .then(providers => {
                                                            const isProvider = providers.some(provider => 
                                                                provider.ownerName.toLowerCase().includes(searchValue)
                                                            );
                                                            
                                                            // If searching for a provider, location is not required
                                                            locationInput.required = !isProvider;
                                                            locationInput.placeholder = isProvider ? 
                                                                "{{ __('app.home.search_location_optional') }}" : 
                                                                "{{ __('app.home.search_location_placeholder') }}";
                                                        });
                                                });
                                            </script>
                                        </div>
                                    </form>
                                </div>
    <!-- Page Header End -->
     <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h2 class="text-anime-style-2" style="color:white;" >Search Results for "{{ $search }}"
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

<!-- Search Results Section Start -->
<div class="search-results" style="margin: 0 0 50px 0;">
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
                                    <h3>
                                        {{ !empty($provider['storeName']) 
                                            ? $provider['storeName'] 
                                            : (!empty($provider['name']) 
                                                ? $provider['name'] 
                                                : 'No Name') }}
                                    </h3>

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
                                        @if(isset($provider['timing']))
                                            <div class="timing d-flex gap-2 flex-wrap">
                                                @foreach($provider['timing'] as $day => $times)
                                                    @php
                                                        $date = \Carbon\Carbon::parse($day); // Make sure $day is a valid date string
                                                    @endphp
                                                    <div class="date-box">
                                                        {{ $date->format('D.d') }} <!-- e.g., Fri.08 -->
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <button class="appointment-btn">Make an appointment</button>


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
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
<style>
    .appointment-btn {
    margin-top: 20px;
    background-color: #1c1c1c;  /* Dark background */
    color: white;               /* White text */
    border: none;
    border-radius: 10px;        /* Rounded corners */
    padding: 10px 20px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s ease;
    }
    .appointment-btn:hover {
        background-color: #333;     /* Slightly lighter on hover */
    }
    .date-box {
    border: 1px solid #3F51B5; /* or your desired blue */
    border-radius: 10px;
    padding: 5px 10px;
    color: #3F51B5;
    font-weight: 500;
    display: inline-block;
}
.provider-card {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease;
    height: 100%;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
    /* font-style: italic; */
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
