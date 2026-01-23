@extends('layouts.mainInnerPages')

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
                            <div class="search-section" style="margin: 30px 0!important;padding: 15px!important;box-shadow: 0 8px 24px rgba(16, 24, 40, 0.08);">
                                <form action="{{ route('search') }}" method="GET">
                                    <div class="search-row">
                                        <div class="search-item">
                                            <div class="search-icon">
                                                <img src="images/images/Vector.svg" alt="Search" width="32" height="32" aria-hidden="true">
                                            </div>
                                            <div class="search-content">
                                                <h3 class="search-title">{{ __('app.home.search_input_text') }}</h3>
                                                <div class="search-suggestions-container">
                                                    <input type="search" class="searchInput" id="searchInput" name="search" placeholder="{{ __('app.home.search_service_placeholder') }}" value="{{ $search ?? '' }}" required>
                                                    <div class="search-suggestions-dropdown" id="searchSuggestionsDropdown"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="divider"></div>

                                        <div class="search-item">
                                            <div class="search-icon">
                                                <img src="images/images/mage_map-marker-fill.svg" alt="Location" width="32" height="32" aria-hidden="true">
                                            </div>
                                            <div class="search-content">
                                                <h3 class="search-title">{{ __('app.home.search_or_text') ?? 'Location' }}</h3>
                                                <input type="text" class="searchInput" id="locationInput" name="location" placeholder="{{ __('app.home.search_location_placeholder') }}" value="{{ $location ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="divider"></div>

                                        <button type="submit" class="btn-primary" style="margin-left: auto;">
                                            {{ __('app.home.search_button') }}
                                            <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16">
                                        </button>
                                    </div>
                                </form>
                            </div>
                {{-- </div>
            </section> --}}
        </div>

    {{-- search bar end --}}
    <!-- Page Header End -->
     <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        {{-- <h2 class="text-anime-style-2" style="color:#e50050;" >Search Results for "{{ $search }}"
                        @if($location) in "{{ $location }}" @endif
                        </h2> --}}
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
                            <div class="service-filter-pills" role="tablist" aria-label="Service categories" id="categoryFilterPills">
                                <button type="button" class="filter-pill active" data-category="all" aria-current="true">{{ __('app.provider.filter_all') }}</button>
                                {{-- Categories will be loaded via JavaScript from API --}}
                            </div>

    <!-- View Type Tabs Section Start -->
    <div class="view-type-tabs-container" style="margin-top: 20px;">
        <div class="view-type-tabs">
            <a href="{{ route('search') }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}" class="view-tab active" data-view="list">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 5H17.5M2.5 10H17.5M2.5 15H17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M2.5 2.5H5.83333V5H2.5V2.5Z" fill="currentColor"/>
                </svg>
                <span>{{ __('app.provider.salon_list') }}</span>
            </a>
            {{-- <a href="{{ route('search.videos') }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}" class="view-tab" data-view="videos">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2.5" y="4.16667" width="15" height="11.6667" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M8.33333 7.5L13.3333 10L8.33333 12.5V7.5Z" fill="currentColor"/>
                </svg>
                <span>Salon Videos</span>
            </a> --}}
        </div>
    </div>
    <!-- View Type Tabs Section End -->
        
        <!-- Loading State -->
        <div id="providers-loading" class="providers-loading">
            <div class="providers-spinner"></div>
            <p>{{ __('app.common.loading_providers') }}</p>
        </div>

        <!-- Error State -->
        <div id="providers-error" class="providers-error" style="display: none;">
            <div class="providers-error-icon">
                <i class="fas fa-exclamation-circle"></i>
                                            </div>
            <h3>Oops! Something went wrong</h3>
            <p id="providers-error-message">Failed to load providers. Please try again later.</p>
            <button class="providers-retry-btn" onclick="fetchProviders()">Try Again</button>
                                        </div>

        <!-- Empty State -->
        <div id="providers-empty" class="providers-empty" style="display: none;">
            <div class="providers-empty-icon">
                <i class="fas fa-search"></i>
                                    </div>
            <h3>{{ __('app.provider.no_providers_title') }}</h3>
            <p>{{ __('app.provider.no_providers_message') }}</p>
                                    </div>

        <!-- Providers Grid Container -->
        <div id="providers-grid" class="results-grid" style="display: none;">
            {{-- Providers will be rendered here by JavaScript --}}
                                    </div>

        <!-- Infinite Scroll Loading Indicator -->
        <div id="providers-load-more" class="providers-load-more" style="display: none;">
            <div class="providers-spinner"></div>
            <p>{{ __('app.common.loading_more') }}</p>
        </div>
                                            </div>
                                    </div>
<!-- Search Results Section End -->
@endsection

@section('styles')
<link rel="stylesheet" href="{{ \App\Helpers\AssetHelper::versioned('css/search.css') }}">
<link rel="stylesheet" href="{{ \App\Helpers\AssetHelper::versioned('css/provider-results.css') }}">
@endsection
@section('scripts')
<script>
    // Global variable for default image path (used in provider-results.js)
    window.defaultProviderImage = '{{ asset("/images/default.jpeg") }}';
    
    // Translations for provider results
    window.providerTranslations = {
        open: @json(__('app.provider.provider_open')),
        closed: @json(__('app.provider.closed')),
        hours_unavailable: @json(__('app.provider.hours_unavailable')),
        next_availability: @json(__('app.provider.next_availability')),
        morning: @json(__('app.provider.morning')),
        evening: @json(__('app.provider.evening')),
        no_time_availability: @json(__('app.provider.no_time_availability')),
        monday: @json(__('app.service.monday')),
        tuesday: @json(__('app.service.tuesday')),
        wednesday: @json(__('app.service.wednesday')),
        thursday: @json(__('app.service.thursday')),
        friday: @json(__('app.service.friday')),
        saturday: @json(__('app.service.saturday')),
        sunday: @json(__('app.service.sunday')),
    };
</script>
<script src="{{ \App\Helpers\AssetHelper::versioned('js/provider-results.js') }}"></script>
@endsection
