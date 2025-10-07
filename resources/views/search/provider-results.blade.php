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

    {{-- search bar start (inner search preserved) --}}

        <div class="container">
            <section class="search-outer-layout">
                <div class="search-outer-box">
                    <h3 class="search-outer-title">{{ __('app.provider.searchbar_section_heading')}}</h3>
                    <p class="search-outer-subtitle">{{ __('app.provider.searchbar_section_paragraph')}}</p>

                    <div class="search-bar provider-search-bar">
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
                </div>
            </section>
        </div>

    {{-- search bar end --}}
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
                                @php
                                    $avgRating = isset($provider['avg_ratting']) ? floatval($provider['avg_ratting']) : 0;
                                @endphp
                                <div class="provider-image">
                                    <img src="{{ isset($provider['profileImg']) && $provider['profileImg'] ? $provider['profileImg'] : asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}" 
                                         alt="{{ $provider['name'] }}" 
                                         class="img-fluid"
                                         onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                                    <div class="image-overlay">
                                        <div class="overlay-left">
                                            <span class="overlay-title">
                                                {{ !empty($provider['storeName']) 
                                                    ? $provider['storeName'] 
                                                    : (!empty($provider['name']) 
                                                        ? $provider['name'] 
                                                        : 'No Name') }}
                                            </span>
                                            @if(isset($provider['companyName']) && $provider['companyName'])
                                                <span class="overlay-meta">{{ $provider['companyName'] }}</span>
                                            @endif
                                        </div>
                                        <div class="rating-badge">
                                            <i class="fas fa-star"></i>
                                            <span>{{ number_format($avgRating, 1) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="provider-details p-4">
                                    <h3 class="card-title">
                                        {{ !empty($provider['storeName']) 
                                            ? $provider['storeName'] 
                                            : (!empty($provider['name']) 
                                                ? $provider['name'] 
                                                : 'No Name') }}
                                    </h3>

                                    <div class="provider-meta">
                                        @if(isset($provider['address']))
                                            <div class="address">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span>{{ $provider['address'] }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    @if(isset($provider['timing']))
                                        <div class="tag-list">
                                            @foreach($provider['timing'] as $day => $times)
                                                @php
                                                    $date = \Carbon\Carbon::parse($day);
                                                @endphp
                                                <span class="tag-chip">{{ $date->format('D.d') }}</span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="card-footer-row">
                                        <div class="reviews-text">{{ $provider['total_review'] ?? 0 }} reviews</div>
                                        <button class="appointment-btn">Book Now</button>
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
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
<style>
    /* Outer layout around existing search bar */
    .search-outer-layout {
        margin: 20px 0 30px 0;
        background: linear-gradient(180deg, rgb(159 159 159 / 73%) 0%, rgb(66 66 66 / 15%) 100%);
        border-radius: 16px;
    }
    .search-outer-layout .search-outer-box {
        padding: 50px 40px 24px 40px;
    }
    .search-outer-layout .search-outer-title {
        color: #fff;
        font-weight: 700;
        margin: 0 0 6px 0;
        font-size: 22px;
    }
    .search-outer-layout .search-outer-subtitle {
        color: rgba(255,255,255,0.85);
        margin: 0 0 16px 0;
        font-size: 14px;
    }
    /* Ensure existing search bar keeps its own layout inside */
    .search-outer-layout .provider-search-bar { margin-top: 0; }

    /* Provider card redesign */
    .search-results .provider-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(16,24,40,0.08);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        height: 100%;
        border: 1px solid rgba(0,0,0,0.06);
    }
    .search-results .provider-card:hover { transform: translateY(-2px); box-shadow: 0 12px 24px rgba(16,24,40,0.12); }
    .search-results .provider-image { position: relative; }
    .search-results .provider-image img { width: 100%; height: 180px; object-fit: cover; display: block; }
    .search-results .image-overlay { position: absolute; left: 0; right: 0; bottom: 0; padding: 10px 12px; display: flex; align-items: center; justify-content: space-between; background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.55) 100%); }
    .overlay-left { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; }
    .overlay-title { color: #fff; font-weight: 700; font-size: 14px; text-shadow: 0 1px 2px rgba(0,0,0,0.3); }
    .overlay-meta { color: #e6e6e6; font-size: 12px; }
    .search-results .rating-badge { background: #fff; color: #111; border-radius: 999px; padding: 6px 10px; display: inline-flex; gap: 6px; align-items: center; font-weight: 700; box-shadow: 0 6px 14px rgba(0,0,0,0.15); }
    .search-results .rating-badge i { color: #ffb400; }

    .search-results .provider-details { color: #111827; }
    .search-results .card-title { font-size: 16px; font-weight: 700; margin: 0 0 6px 0; }
    .search-results .provider-meta .address { color: #6b7280; font-size: 14px; display: flex; align-items: center; gap: 8px; }
    .search-results .provider-meta .address i { color: #ef4444; }

    .search-results .tag-list { margin: 12px 0; display: flex; gap: 8px; flex-wrap: wrap; }
    .search-results .tag-chip { background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; padding: 6px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; }

    .search-results .card-footer-row { display: flex; align-items: center; justify-content: space-between; margin-top: 12px; padding-top: 12px; border-top: 1px solid #f1f1f1; }
    .search-results .reviews-text { color: #6b7280; font-weight: 700; font-size: 14px; }
    .provider-card .appointment-btn { background-color: #000000ff; color: #fff; border-radius: 10px; padding: 8px 14px; font-size: 14px; font-weight: 700; border: none; }
    .provider-card .appointment-btn:hover { background-color: #727272ff; }

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
