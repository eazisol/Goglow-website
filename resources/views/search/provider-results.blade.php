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
            {{-- <section class="search-outer-layout">
                <div class="search-outer-box"> --}}
                    {{-- <h3 class="search-outer-title">{{ __('app.provider.searchbar_section_heading')}}</h3>
                    <p class="search-outer-subtitle">{{ __('app.provider.searchbar_section_paragraph')}}</p> --}}

                    {{-- <div class="search-bar provider-search-bar">
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
                    </div> --}}
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
                                <button type="button" class="filter-pill active" data-category="all" aria-current="true">All</button>
                                {{-- Categories will be loaded via JavaScript from API --}}
                            </div>
        
        <!-- Loading State -->
        <div id="providers-loading" class="providers-loading">
            <div class="providers-spinner"></div>
            <p>Loading providers...</p>
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
            <h3>No providers found</h3>
            <p>No providers found matching your search criteria. Try adjusting your search terms or location.</p>
                                    </div>

        <!-- Providers Grid Container -->
        <div id="providers-grid" class="results-grid" style="display: none;">
            {{-- Providers will be rendered here by JavaScript --}}
                                    </div>
                                            </div>
                                    </div>
<!-- Search Results Section End -->
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
<style>
    /* Loading State - Similar to blog loader */
    .providers-loading {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 80px 20px;
        min-height: 400px;
    }

    .providers-spinner {
        width: 50px;
        height: 50px;
        border: 4px solid #d5bec6;
        border-top-color: #75213e;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-bottom: 20px;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .providers-loading p {
        font-family: 'Satoshi', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        font-size: 16px;
        color: #75213e;
    }

    /* Error State */
    .providers-error {
        text-align: center;
        padding: 80px 20px;
        min-height: 400px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .providers-error-icon {
        font-size: 64px;
        color: #75213e;
        margin-bottom: 24px;
        opacity: 0.6;
    }

    .providers-error h3 {
        font-family: 'Satoshi', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        font-size: 24px;
        font-weight: 600;
        color: #2c0d18;
        margin-bottom: 12px;
    }

    .providers-error p {
        font-family: 'Satoshi', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        font-size: 16px;
        color: #6b7280;
        margin-bottom: 24px;
    }

    .providers-retry-btn {
        background: rgba(229, 0, 80, 1);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
    }

    .providers-retry-btn:hover {
        background: #cc0046;
    }

    /* Empty State */
    .providers-empty {
        text-align: center;
        padding: 80px 20px;
        min-height: 400px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .providers-empty-icon {
        font-size: 64px;
        color: #75213e;
        margin-bottom: 24px;
        opacity: 0.6;
    }

    .providers-empty h3 {
        font-family: 'Satoshi', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        font-size: 24px;
        font-weight: 600;
        color: #2c0d18;
        margin-bottom: 12px;
    }

    .providers-empty p {
        font-family: 'Satoshi', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        font-size: 16px;
        color: #6b7280;
    }

    .provider-card-heading-section{
        justify-content: space-between;
        display: flex;
    }
    /* Outer layout around existing search bar */
    .search-outer-layout {
        margin: 45px 0 30px 0;
        background-image: url('images/images/provider_search_image.jpg');
        background-position: center;
        /* background: linear-gradient(180deg, rgb(159 159 159 / 73%) 0%, rgb(66 66 66 / 15%) 100%); */
        border-radius: 16px;
    }
    .search-outer-layout .search-outer-box {
        padding: 40px 40px 24px 40px;
    }
    .search-outer-layout .search-outer-title {
        text-transform: uppercase;
        letter-spacing: -1px;
        color: #fff;
        font-weight: 700;
        margin: 0 0 6px 0;
        font-size: 30px;
    }
    .search-outer-layout .search-outer-subtitle {
    color: rgba(255, 255, 255, 0.85);
    /* margin: 0 0 16px 0; */
    font-size: 22px;
    width: 50%;
    text-transform: lowercase;
    line-height: 23px;
    }
    /* Ensure existing search bar keeps its own layout inside */
    .search-outer-layout .provider-search-bar { margin-top: 0; }

    /* Provider card redesign */
    .search-results .provider-card {
        background: #fff6f8;
        border-radius: 40px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(16,24,40,0.08);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        height: 100%;
        border: 1px solid rgb(213 190 198);
    }
    .search-results .provider-card:hover { transform: translateY(-2px); box-shadow: 0 12px 24px rgba(16,24,40,0.12); }
    .search-results .provider-image { padding: 16px 16px 0 16px; }
    .search-results .provider-image-inner { position: relative; border-radius: 25px; overflow: hidden; }
    .search-results .provider-image img { width: 100%; height: 240px; object-fit: cover; display: block; }
    .search-results .image-overlay { position: absolute; left: 0; right: 0; bottom: 0; padding: 12px 17px; display: flex; align-items: center; justify-content: space-between; background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.55) 100%); }
    .overlay-left { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; }
    .overlay-title { color: #fff; font-weight: 700; font-size: 16px; text-shadow: 0 1px 2px rgba(0,0,0,0.3); }
    .overlay-meta { color: #e6e6e6; font-size: 14px; }
    .search-results .rating-badge { background: #fff; color: #111; border-radius: 999px; padding: 6px 10px; display: inline-flex; gap: 6px; align-items: center; font-weight: 700; box-shadow: 0 6px 14px rgba(0,0,0,0.15); }
    .search-results .rating-badge i { color: #ffb400; }

    .search-results .provider-details { color: #111827; }
    /* emulate Bootstrap p-4 utility locally */
    .search-results .p-4 { padding: 0.3rem 1.5rem 1.5rem 2.0rem; }
    /* emulate common Bootstrap utilities locally */
    .search-results .text-center { text-align: center; }
    .search-results .img-fluid { max-width: 100%; height: auto; display: block; }
    .search-results .card-title { font-size: 18px; font-weight: 700; margin: 0 0 6px 0; letter-spacing: -0.2px; }
    .search-results .provider-meta .address { color: #6b7280; font-size: 14px; display: flex; align-items: center; gap: 8px; }
    .search-results .provider-meta .address i { color: #ef4444; }
    /* reuse search-icon with a small variant for address */
    .search-results .search-icon { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; }
    .search-results .search-icon img { width: 17px; height: 17px; display: block; }
    .search-results .search-icon-sm { width: 30px; height: 30px; border-radius: 16px; }

    .search-results .tag-list { margin: 12px 0; display: flex; gap: 8px; flex-wrap: wrap; }
    .search-results .tag-chip { background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; padding: 6px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; }

    .search-results .card-footer-row { display: flex; align-items: center; justify-content: space-between; padding-top: 12px;}
    .search-results .reviews-text { color: #6b7280; font-weight: 700; font-size: 14px; }
    .provider-card .appointment-btn { background-color: #000000ff; color: #fff; border-radius: 10px; padding: 8px 14px; font-size: 14px; font-weight: 700; border: none; }
    .provider-card .appointment-btn:hover { background-color: #727272ff; }

    /* Timing status & tooltip */
    .timing-status .status-text{ font-size: 14px; font-weight: 400; }
    .timing-status {display: inline-flex; align-items: center; gap: 8px; cursor: pointer; color: #374151; font-weight: 600; }
    .timing-status .status-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; }
    .timing-status .status-dot.open { background: #10b981; }
    .timing-status .status-dot.closed { background: #ef4444; }
    .timing-tooltip { position: fixed; z-index: 9999; background: #fff; box-shadow: 0 10px 30px rgba(0,0,0,0.15); border: 1px solid #e5e7eb; border-radius: 12px; padding: 10px; width: 240px; display: none; }
    .timing-tooltip .timing-tooltip-inner { max-height: 260px; overflow: auto; }
    .timing-row { display: flex; justify-content: space-between; padding: 6px 8px; border-radius: 8px; font-size: 14px; }
    .timing-row.today { background: #f9fafb; font-weight: 700; }
    .timing-day { color: #374151; }
    .timing-hours { color: #111827; }

    /* Rating inline row */
    .rating-row { display: flex; align-items: center; gap: 6px; margin-top: 5px; color: #374151; font-weight: 600; }
    .rating-row .fa-star { color: #ffb400; }
    .rating-row .rating-value { font-weight: 400; color: #e50050;}
    .rating-row .rating-count { color: #e50050; font-weight: 600; }

    /* Availability section */
    .availability-section {}
    .availability-title { color: #374151; font-size: 16px; font-weight: 700; margin-bottom: 5px; letter-spacing: 0px; }
    .availability-row { display: flex; align-items: center; gap: 10px; margin: 4px 0; flex-wrap: wrap; }
    .time-of-day { color:rgba(118, 33, 62, 1); font-weight: 500; font-size: 15px; width: 80px; }
    .chip-group { display: flex; gap: 5px; flex-wrap: wrap; }
    .date-chip { padding: 4px 18px; border-radius: 10px; font-size: 12px; font-weight: 500; cursor: pointer; transition: all 0.2s ease; position: relative; }
    .date-chip b { font-weight: 500; }
    .date-chip.has-slot { background: rgba(229, 0, 80, 1); color: #ffffffff; border: 1px solid #ffd1df; }
    .date-chip.no-slot { background: #fff; color: #6b7280; border: 1px solid #e5e7eb; }
    .date-chip:hover { transform: translateY(-1px); box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
    
    /* Date chip tooltip */
    .date-chip-tooltip {
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        margin-bottom: 8px;
        padding: 6px 12px;
        background: #333;
        color: white;
        border-radius: 6px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s ease;
        z-index: 1000;
    }
    .date-chip-tooltip::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        border: 5px solid transparent;
        border-top-color: #333;
    }
    .date-chip:hover .date-chip-tooltip {
        opacity: 1;
    }

    /* Book now button */
    .book-now-btn { background: linear-gradient(270deg, #FF8C00 0%, #E50050 100%); color: #fff; border-radius: 999px; padding: 7px 18px; font-size: 13px; font-weight: 500; text-transform: uppercase; letter-spacing: .3px; }
    .book-now-btn:hover { background: #ff9900; }

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

/* Page-scoped responsive grid (Bootstrap-free) */
.results-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 24px; }
.results-item {  }
@media (max-width: 992px) { .results-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
@media (max-width: 640px) { .results-grid { grid-template-columns: 1fr; } }
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

.provider-image img { width: 100%; height: 220px; object-fit: cover; }

.provider-details {
    color: #333;
}

.company-name {
    color: #666;
    /* font-style: italic; */
}

.provider-meta {
    /* margin: 15px 0; */
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
@media (max-width: 480px) {
    .search-title {
        font-size: 17px!important;
    }
}

/* Category filter pills with icons */
.service-filter-pills .filter-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.service-filter-pills .filter-pill .category-icon {
    width: 20px;
    height: 20px;
    margin-right: 8px;
    vertical-align: middle;
    object-fit: contain;
    flex-shrink: 0;
}
</style>
@endsection
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Fetch categories from API and display them
  fetchAndDisplayCategories();
  
  // Fetch providers from API
  const searchParam = new URLSearchParams(window.location.search).get('search');
  const locationParam = new URLSearchParams(window.location.search).get('location');
  
  // Only fetch if we're not viewing a specific provider (no provider_id in URL)
  const providerIdParam = new URLSearchParams(window.location.search).get('provider_id');
  if (!providerIdParam) {
    fetchProviders(searchParam, locationParam);
  }

  // Function to fetch categories from API and display them
  async function fetchAndDisplayCategories() {
    const filterPillsContainer = document.getElementById('categoryFilterPills');
    if (!filterPillsContainer) return;
    
    try {
      const response = await fetch('https://us-central1-beauty-984c8.cloudfunctions.net/getSortedCategories');
      
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      
      const categories = await response.json();
      
      if (!Array.isArray(categories)) {
        console.error('Categories API did not return an array');
        return;
      }
      
      // Filter only active categories and sort by sortOrder
      const activeCategories = categories
        .filter(cat => cat.isActive === true)
        .sort((a, b) => (a.sortOrder || 0) - (b.sortOrder || 0));
      
      // Add category buttons to the filter pills container
      activeCategories.forEach(category => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'filter-pill';
        button.setAttribute('data-category', category.name);
        button.setAttribute('aria-current', 'false');
        
        // Create icon image if imageUrl exists
        if (category.imageUrl) {
          const icon = document.createElement('img');
          icon.src = category.imageUrl;
          icon.alt = category.name;
          icon.className = 'category-icon';
          button.appendChild(icon);
        }
        
        // Add category name
        const textNode = document.createTextNode(category.name);
        button.appendChild(textNode);
        
        filterPillsContainer.appendChild(button);
      });
      
    } catch (error) {
      console.error('Error fetching categories:', error);
    }
  }

  // Function to fetch providers from API
  async function fetchProviders(search = null, location = null) {
    const loadingEl = document.getElementById('providers-loading');
    const errorEl = document.getElementById('providers-error');
    const emptyEl = document.getElementById('providers-empty');
    const gridEl = document.getElementById('providers-grid');
    
    // Show loading, hide others
    if (loadingEl) loadingEl.style.display = 'flex';
    if (errorEl) errorEl.style.display = 'none';
    if (emptyEl) emptyEl.style.display = 'none';
    if (gridEl) gridEl.style.display = 'none';
    
    try {
      // Build API URL - fetch all providers (API handles filtering if params provided)
      let apiUrl = 'https://us-central1-beauty-984c8.cloudfunctions.net/searchProviders';
      const params = new URLSearchParams();
      if (search) params.append('name', search);
      if (location) params.append('location', location);
      if (params.toString()) {
        apiUrl += '?' + params.toString();
      }
      
      const response = await fetch(apiUrl);
      
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      
      const providers = await response.json();
      
      // Hide loading
      if (loadingEl) loadingEl.style.display = 'none';
      
      if (!Array.isArray(providers) || providers.length === 0) {
        if (emptyEl) emptyEl.style.display = 'flex';
        return;
      }
      
      // Render providers
      renderProviders(providers);
      
    } catch (error) {
      console.error('Error fetching providers:', error);
      if (loadingEl) loadingEl.style.display = 'none';
      if (errorEl) {
        errorEl.style.display = 'flex';
        const errorMsg = document.getElementById('providers-error-message');
        if (errorMsg) {
          errorMsg.textContent = 'Failed to load providers. Please check your connection and try again.';
        }
      }
    }
  }
  
  // Make fetchProviders available globally for retry button
  window.fetchProviders = function() {
    const searchParam = new URLSearchParams(window.location.search).get('search');
    const locationParam = new URLSearchParams(window.location.search).get('location');
    fetchProviders(searchParam, locationParam);
  };

  // Function to render providers in the grid
  function renderProviders(providers) {
    const gridEl = document.getElementById('providers-grid');
    if (!gridEl) return;
    
    gridEl.innerHTML = '';
    
    providers.forEach(provider => {
      const providerCard = createProviderCard(provider);
      gridEl.appendChild(providerCard);
    });
    
    // Show grid
    gridEl.style.display = 'grid';
    
    // Initialize tooltips for the new cards
    initializeProviderTooltips();
    
    // Initialize category filtering (though categories are empty for now)
    initializeCategoryFilters();
  }
  
  // Function to create a provider card element
  function createProviderCard(provider) {
    const defaultImage = '{{ asset("/images/adam-winger-FkAZqQJTbXM-unsplash.jpg") }}';
    const providerImage = provider.profileImg || defaultImage;
    const companyName = provider.companyName || provider.name || 'No Name';
    const avgRating = provider.avg_ratting || 0;
    const totalReviews = provider.total_review || 0;
    const address = provider.address || '';
    const providerId = provider.id || '';
    const timing = provider.timing || {};
    
    // Create timing status
    const timingStatus = calculateTimingStatus(timing);
    
    // Create the card
    const item = document.createElement('div');
    item.className = 'results-item';
    item.setAttribute('data-categories', ''); // Empty for now
    
    item.innerHTML = `
      <div class="provider-card">
        <a href="/search?provider_id=${providerId}" class="provider-link">
          <div class="provider-image">
            <div class="provider-image-inner">
              <img src="${escapeHtml(providerImage)}" 
                   alt="${escapeHtml(companyName)}" 
                   class="img-fluid"
                   loading="lazy"
                   onerror="this.src='${defaultImage}'">
              <div class="image-overlay">
                <div class="overlay-left">
                  ${provider.companyName ? `<span class="overlay-meta">${escapeHtml(provider.companyName)}</span>` : ''}
                </div>
              </div>
            </div>
          </div>
          <div class="provider-details p-4">
            <div class="provider-card-heading-section">
              <h3 class="card-title">${escapeHtml(companyName)}</h3>
              <div class="rating-row">
                <img src="images/images/star_cards.svg" alt="Location" width="15" height="15">
                <span class="rating-value">${avgRating.toFixed(1)}</span>
                <span class="rating-count">(${totalReviews})</span>
              </div>
            </div>
            <div class="provider-meta">
              ${address ? `
                <div class="address">
                  <span class="search-icon search-icon-sm" aria-hidden="true">
                    <img src="images/images/mage_map-marker-fill.svg" alt="Location" width="20" height="20">
                  </span>
                  <span>${escapeHtml(address)}</span>
                </div>
              ` : ''}
            </div>
            ${timingStatus.html || ''}
            ${timingStatus.availabilityHtml || ''}
          </div>
        </a>
      </div>
    `;
    
    // Add tooltip if needed
    if (timingStatus.tooltipHtml) {
      const tooltipContainer = document.createElement('div');
      tooltipContainer.innerHTML = timingStatus.tooltipHtml;
      document.body.appendChild(tooltipContainer.firstElementChild);
    }
    
    return item;
  }
  
  // Function to calculate timing status and availability
  function calculateTimingStatus(timing) {
    if (!timing || typeof timing !== 'object') {
      return { html: '', tooltipHtml: '', availabilityHtml: '', cardId: '' };
    }
    
    const daysOrder = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
    const dayNamesMap = {
      'Mon': 'Mon',
      'Tue': 'Tue', 
      'Wed': 'Wed',
      'Thu': 'Thu',
      'Fri': 'Fri',
      'Sat': 'Sat',
      'Sun': 'Sun'
    };
    
    const now = new Date();
    const dayNames = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
    const todayKey = dayNames[now.getDay()];
    const cardId = 'prov_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
    
    // Format time range helper
    function formatRange(range) {
      if (!Array.isArray(range) || range.length < 2 || !range[0] || !range[1]) {
        return null;
      }
      try {
        const open = new Date(range[0] * 1000);
        const close = new Date(range[1] * 1000);
        const openTime = open.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
        const closeTime = close.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
        return openTime + ' – ' + closeTime;
      } catch (e) {
        return null;
      }
    }
    
    const todayRange = timing[todayKey] || [];
    const todayRangeText = formatRange(todayRange);
    const isOpenToday = todayRangeText !== null;
    
    // Build status HTML
    const statusHtml = `
      <div class="timing-status" data-tooltip-id="timing-tooltip-${cardId}">
        <span class="search-icon search-icon-sm" aria-hidden="true">
          <span class="status-dot ${isOpenToday ? 'open' : 'closed'}"></span>
        </span>
        <span class="status-text">
          ${isOpenToday 
            ? 'Open · ' + todayRangeText 
            : 'Closed · Hours unavailable'}
        </span>
      </div>
    `;
    
    // Build tooltip HTML
    const tooltipHtml = `
      <div class="timing-tooltip" id="timing-tooltip-${cardId}" aria-hidden="true">
        <div class="timing-tooltip-inner">
          ${daysOrder.map(day => {
            const rangeText = formatRange(timing[day] || []);
            const isToday = todayKey === day;
            return `
              <div class="timing-row ${isToday ? 'today' : ''}">
                <span class="timing-day">${dayNamesMap[day] || day}</span>
                <span class="timing-hours">${rangeText || 'Closed'}</span>
              </div>
            `;
          }).join('')}
        </div>
      </div>
    `;
    
    // Build availability section (next 3 days with morning/evening slots)
    const chipDays = [];
    for (let i = 0; i < 3; i++) {
      const d = new Date(now);
      d.setDate(now.getDate() + i);
      const dayKey = dayNames[d.getDay()];
      const dayLabel = dayNamesMap[dayKey] || dayKey;
      const dayNumber = d.getDate().toString().padStart(2, '0');
      
      const dayTiming = timing[dayKey] || [];
      const hasTimeSlot = Array.isArray(dayTiming) && dayTiming.length >= 2 && dayTiming[0] && dayTiming[1];
      const timeSlotText = hasTimeSlot ? formatRange(dayTiming) : 'No time availability';
      
      chipDays.push({
        label: dayLabel,
        day: dayNumber,
        dayKey: dayKey,
        hasTimeSlot: hasTimeSlot,
        timeSlotText: timeSlotText
      });
    }
    
    const availabilityHtml = `
      <div class="availability-section">
        <div class="availability-title">Next Availability</div>
        <div class="availability-row">
          <span class="time-of-day">Morning</span>
          <div class="chip-group">
            ${chipDays.map(cd => `
              <span class="date-chip ${cd.hasTimeSlot ? 'has-slot' : 'no-slot'}" 
                    data-tooltip="${escapeHtml(cd.timeSlotText)}">
                ${cd.label} <b>${cd.day}</b>
                <span class="date-chip-tooltip">${escapeHtml(cd.timeSlotText)}</span>
              </span>
            `).join('')}
          </div>
        </div>
        <div class="availability-row">
          <span class="time-of-day">Evening</span>
          <div class="chip-group">
            ${chipDays.map(cd => `
              <span class="date-chip ${cd.hasTimeSlot ? 'has-slot' : 'no-slot'}" 
                    data-tooltip="${escapeHtml(cd.timeSlotText)}">
                ${cd.label} <b>${cd.day}</b>
                <span class="date-chip-tooltip">${escapeHtml(cd.timeSlotText)}</span>
              </span>
            `).join('')}
          </div>
        </div>
      </div>
    `;
    
    return { 
      html: statusHtml, 
      tooltipHtml: tooltipHtml, 
      availabilityHtml: availabilityHtml,
      cardId: cardId 
    };
  }
  
  // Helper function to escape HTML
  function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }
  
  // Function to initialize tooltips for provider cards
  function initializeProviderTooltips() {
    const containers = document.querySelectorAll('.provider-card');
    containers.forEach(function(card) {
      const status = card.querySelector('.timing-status');
      if (!status) return;
      const tooltipId = status.getAttribute('data-tooltip-id');
      const tooltip = tooltipId ? document.getElementById(tooltipId) : null;
      if (!tooltip) return;
      
      // Ensure tooltip is in body
      if (tooltip.parentElement !== document.body) {
        document.body.appendChild(tooltip);
      }
      
      function positionTooltip() {
        const rect = status.getBoundingClientRect();
        const top = rect.top + rect.height + 8;
        let left = rect.left;
        const maxLeft = window.innerWidth - tooltip.offsetWidth - 8;
        if (left > maxLeft) left = Math.max(8, maxLeft);
        tooltip.style.top = top + 'px';
        tooltip.style.left = left + 'px';
      }
      
      function show() {
        tooltip.style.display = 'block';
        positionTooltip();
      }
      
      function hide() {
        tooltip.style.display = 'none';
      }
      
      status.addEventListener('mouseenter', show);
      status.addEventListener('mouseleave', function() {
        setTimeout(function() {
          if (!tooltip.matches(':hover')) hide();
        }, 100);
      });
      tooltip.addEventListener('mouseleave', hide);
      tooltip.addEventListener('mouseenter', function() {
        tooltip.style.display = 'block';
      });
      
      status.addEventListener('click', function(e) {
        e.preventDefault();
        if (tooltip.style.display === 'block') {
          hide();
        } else {
          show();
        }
      });
      
      window.addEventListener('scroll', function() {
        if (tooltip.style.display === 'block') positionTooltip();
      });
      window.addEventListener('resize', function() {
        if (tooltip.style.display === 'block') positionTooltip();
      });
    });
  }
  
  // Function to initialize category filters (placeholder for now)
  function initializeCategoryFilters() {
    // Categories will be empty for now since we removed service fetching
    // This can be enhanced later if needed
  }

  // Delegate hover/click for timing tooltips
  const containers = document.querySelectorAll('.provider-card');
  containers.forEach(function(card){
    const status = card.querySelector('.timing-status');
    if(!status) return;
    const tooltipId = status.getAttribute('data-tooltip-id');
    const tooltip = tooltipId ? document.getElementById(tooltipId) : null;
    if(!tooltip) return;

    // Ensure tooltip is appended to body to avoid overflow clipping
    if (tooltip.parentElement !== document.body) {
      document.body.appendChild(tooltip);
    }

    // Position tooltip near status
    function positionTooltip(){
      const rect = status.getBoundingClientRect();
      const top = rect.top + rect.height + 8; // pixels from viewport top
      let left = rect.left; // pixels from viewport left
      // Keep inside viewport horizontally
      const maxLeft = window.innerWidth - tooltip.offsetWidth - 8;
      if (left > maxLeft) left = Math.max(8, maxLeft);
      tooltip.style.top = top + 'px';
      tooltip.style.left = left + 'px';
    }

    function show(){ tooltip.style.display = 'block'; positionTooltip(); }
    function hide(){ tooltip.style.display = 'none'; }

    // Hover behavior
    status.addEventListener('mouseenter', show);
    status.addEventListener('mouseleave', function(){ setTimeout(function(){
      // Only hide if not hovered over tooltip
      if(!tooltip.matches(':hover')) hide();
    }, 100); });
    tooltip.addEventListener('mouseleave', hide);
    // Also keep visible when moving from status to tooltip
    tooltip.addEventListener('mouseenter', function(){ tooltip.style.display = 'block'; });
    tooltip.addEventListener('mouseenter', function(){ /* keep visible */ });

    // Click toggle for mobile
    status.addEventListener('click', function(e){
      e.preventDefault();
      if(tooltip.style.display === 'block'){ hide(); } else { show(); }
    });

    window.addEventListener('scroll', function(){ if(tooltip.style.display==='block') positionTooltip(); });
    window.addEventListener('resize', function(){ if(tooltip.style.display==='block') positionTooltip(); });
  });

  // Category filtering functionality
  const filterPills = document.querySelectorAll('.filter-pill');
  const providerItems = document.querySelectorAll('.results-item');

  filterPills.forEach(function(pill) {
    pill.addEventListener('click', function() {
      const selectedCategory = this.getAttribute('data-category');
      
      // Update active state
      filterPills.forEach(function(p) {
        p.classList.remove('active');
        p.removeAttribute('aria-current');
      });
      this.classList.add('active');
      this.setAttribute('aria-current', 'true');
      
      // Filter providers
      providerItems.forEach(function(item) {
        if (selectedCategory === 'all') {
          item.style.display = '';
        } else {
          const categories = item.getAttribute('data-categories');
          if (categories && categories.trim() !== '') {
            const categoryList = categories.split(',').map(function(cat) { return cat.trim(); });
            if (categoryList.includes(selectedCategory)) {
              item.style.display = '';
            } else {
              item.style.display = 'none';
            }
          } else {
            item.style.display = 'none';
          }
        }
      });
    });
  });

  // Search autocomplete functionality
  const searchInput = document.getElementById('searchInput');
  const suggestionsDropdown = document.getElementById('searchSuggestionsDropdown');
  let debounceTimer = null;
  let currentSuggestions = { providers: [], services: [] };
  let selectedIndex = -1;
  let allSuggestions = []; // Flat array of all suggestion items for keyboard navigation

  if (searchInput && suggestionsDropdown) {
    // Debounce function to limit API calls
    function debounce(func, wait) {
      return function(...args) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => func.apply(this, args), wait);
      };
    }

    // Store original input value for hover functionality
    let originalInputValue = '';

    // Fetch suggestions from API
    async function fetchSuggestions(query) {
      if (!query || query.trim().length === 0) {
        hideSuggestions();
        return;
      }

      try {
        const response = await fetch(
          `https://us-central1-beauty-984c8.cloudfunctions.net/searchServiceSuggestions?query=${encodeURIComponent(query)}`
        );
        
        if (response.ok) {
          const data = await response.json();
          // Extract both providers and services from the response
          const providers = data.providers || [];
          const services = data.services || [];
          
          if ((Array.isArray(providers) && providers.length > 0) || (Array.isArray(services) && services.length > 0)) {
            displaySuggestions(providers, services);
          } else {
            hideSuggestions();
          }
        } else {
          hideSuggestions();
        }
      } catch (error) {
        // Silently handle errors - don't show dropdown on error
        hideSuggestions();
      }
    }

    // Display suggestions in dropdown with section headings
    function displaySuggestions(providers, services) {
      currentSuggestions = { providers: providers || [], services: services || [] };
      suggestionsDropdown.innerHTML = '';
      allSuggestions = [];
      selectedIndex = -1;
      
      let hasContent = false;

      // Display Providers section
      if (providers && providers.length > 0) {
        hasContent = true;
        
        // Create section heading
        const providerHeading = document.createElement('div');
        providerHeading.className = 'search-suggestion-heading';
        providerHeading.textContent = 'Salon';
        suggestionsDropdown.appendChild(providerHeading);
        
        // Create provider items
        providers.forEach((provider) => {
          const item = createSuggestionItem(provider.name, 'provider', provider.id);
          suggestionsDropdown.appendChild(item);
          allSuggestions.push({ element: item, name: provider.name, type: 'provider', id: provider.id });
        });
      }

      // Display Services section
      if (services && services.length > 0) {
        hasContent = true;
        
        // Create section heading (only if providers section exists)
        if (providers && providers.length > 0) {
          const divider = document.createElement('div');
          divider.className = 'search-suggestion-divider';
          suggestionsDropdown.appendChild(divider);
        }
        
        const serviceHeading = document.createElement('div');
        serviceHeading.className = 'search-suggestion-heading';
        serviceHeading.textContent = 'Services';
        suggestionsDropdown.appendChild(serviceHeading);
        
        // Create service items
        services.forEach((service) => {
          const item = createSuggestionItem(service.name, 'service', service.id, service.provider_id);
          suggestionsDropdown.appendChild(item);
          allSuggestions.push({ element: item, name: service.name, type: 'service', id: service.id, providerId: service.provider_id });
        });
      }

      if (hasContent) {
        suggestionsDropdown.classList.add('show');
      } else {
        hideSuggestions();
      }
    }

    // Create a suggestion item with hover functionality
    function createSuggestionItem(name, type, id, providerId = null) {
      const item = document.createElement('div');
      item.className = 'search-suggestion-item';
      item.setAttribute('data-type', type);
      item.setAttribute('data-id', id);
      if (providerId) {
        item.setAttribute('data-provider-id', providerId);
      }
      item.textContent = name;
      
      // Store original input value on first hover (only once)
      let isFirstHover = true;
      
      // Fill input on hover (like Google search)
      item.addEventListener('mouseenter', () => {
        if (isFirstHover) {
          originalInputValue = searchInput.value;
          isFirstHover = false;
        }
        searchInput.value = name;
        // Update selected index when hovering
        const index = allSuggestions.findIndex(s => s.element === item);
        if (index !== -1) {
          setSelectedIndex(index);
        }
      });
      
      // Click handler - keep the value filled
      item.addEventListener('click', () => {
        searchInput.value = name;
        originalInputValue = name; // Update original so blur doesn't restore
        hideSuggestions();
        // Optionally navigate or submit form
        searchInput.focus();
      });
      
      return item;
    }

    // Set selected index and update highlighting
    function setSelectedIndex(index) {
      // Remove previous selection
      if (selectedIndex >= 0 && allSuggestions[selectedIndex]) {
        allSuggestions[selectedIndex].element.classList.remove('selected');
      }
      
      // Set new selection
      selectedIndex = index;
      if (selectedIndex >= 0 && selectedIndex < allSuggestions.length) {
        allSuggestions[selectedIndex].element.classList.add('selected');
        searchInput.value = allSuggestions[selectedIndex].name;
        
        // Scroll into view if needed
        allSuggestions[selectedIndex].element.scrollIntoView({
          block: 'nearest',
          behavior: 'smooth'
        });
      }
    }

    // Handle keyboard navigation
    function handleKeyboardNavigation(e) {
      if (!suggestionsDropdown.classList.contains('show') || allSuggestions.length === 0) {
        return;
      }

      switch(e.key) {
        case 'ArrowDown':
          e.preventDefault();
          if (selectedIndex < allSuggestions.length - 1) {
            setSelectedIndex(selectedIndex + 1);
          } else {
            setSelectedIndex(0); // Loop to first
          }
          break;
          
        case 'ArrowUp':
          e.preventDefault();
          if (selectedIndex > 0) {
            setSelectedIndex(selectedIndex - 1);
          } else {
            setSelectedIndex(allSuggestions.length - 1); // Loop to last
          }
          break;
          
        case 'Enter':
          e.preventDefault();
          if (selectedIndex >= 0 && selectedIndex < allSuggestions.length) {
            const selected = allSuggestions[selectedIndex];
            searchInput.value = selected.name;
            originalInputValue = selected.name;
            hideSuggestions();
            // Optionally submit form or navigate
            searchInput.focus();
          }
          break;
          
        case 'Escape':
          e.preventDefault();
          hideSuggestions();
          searchInput.focus();
          break;
      }
    }

    // Hide suggestions dropdown
    function hideSuggestions() {
      suggestionsDropdown.classList.remove('show');
      suggestionsDropdown.innerHTML = '';
      currentSuggestions = { providers: [], services: [] };
      allSuggestions = [];
      selectedIndex = -1;
      // Restore original input value if it was changed by hover
      if (originalInputValue && searchInput.value !== originalInputValue) {
        searchInput.value = originalInputValue;
        originalInputValue = '';
      }
    }

    // Debounced search function
    const debouncedSearch = debounce((query) => {
      fetchSuggestions(query);
    }, 300);

    // Get the search-title element
    const searchTitle = searchInput.closest('.search-content')?.querySelector('.search-title');
    
    // Function to toggle search-title visibility
    function toggleSearchTitle() {
      if (searchTitle) {
        if (searchInput.value.trim().length > 0 || document.activeElement === searchInput) {
          searchTitle.style.display = 'none';
        } else {
          searchTitle.style.display = '';
        }
      }
    }

    // Listen for input events
    searchInput.addEventListener('input', (e) => {
      const query = e.target.value.trim();
      debouncedSearch(query);
      toggleSearchTitle();
      // Reset selection on new input
      selectedIndex = -1;
    });

    // Keyboard navigation
    searchInput.addEventListener('keydown', handleKeyboardNavigation);

    // Show/hide title on focus
    searchInput.addEventListener('focus', () => {
      if (searchTitle) {
        searchTitle.style.display = 'none';
      }
      if (searchInput.value.trim().length > 0 && 
          ((currentSuggestions.providers && currentSuggestions.providers.length > 0) || 
           (currentSuggestions.services && currentSuggestions.services.length > 0))) {
        displaySuggestions(currentSuggestions.providers || [], currentSuggestions.services || []);
      }
    });

    // Hide suggestions when input loses focus (with small delay to allow click on suggestion)
    searchInput.addEventListener('blur', () => {
      setTimeout(() => {
        hideSuggestions();
        toggleSearchTitle();
      }, 200);
    });
    
    // Initial check for existing value
    toggleSearchTitle();
  }

  // Location input field - same functionality
  const locationInput = document.getElementById('locationInput');
  if (locationInput) {
    const locationTitle = locationInput.closest('.search-content')?.querySelector('.search-title');
    
    // Function to toggle location title visibility
    function toggleLocationTitle() {
      if (locationTitle) {
        if (locationInput.value.trim().length > 0 || document.activeElement === locationInput) {
          locationTitle.style.display = 'none';
        } else {
          locationTitle.style.display = '';
        }
      }
    }

    // Listen for input events
    locationInput.addEventListener('input', () => {
      toggleLocationTitle();
    });

    // Show/hide title on focus
    locationInput.addEventListener('focus', () => {
      if (locationTitle) {
        locationTitle.style.display = 'none';
      }
    });

    // Show/hide title on blur
    locationInput.addEventListener('blur', () => {
      toggleLocationTitle();
    });
    
    // Initial check for existing value
    toggleLocationTitle();

    // Hide suggestions on form submit
    const searchForm = searchInput.closest('form');
    if (searchForm) {
      searchForm.addEventListener('submit', () => {
        hideSuggestions();
      });
    }

    // Hide suggestions when clicking outside
    document.addEventListener('click', (e) => {
      if (!searchInput.contains(e.target) && !suggestionsDropdown.contains(e.target)) {
        hideSuggestions();
      }
    });
  }
});
</script>
@endsection
