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
            <section class="search-outer-layout">
                <div class="search-outer-box">
                    <h3 class="search-outer-title">{{ __('app.provider.searchbar_section_heading')}}</h3>
                    <p class="search-outer-subtitle">{{ __('app.provider.searchbar_section_paragraph')}}</p>

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
                            <div class="search-section" style="margin: 30px 0!important;padding: 15px!important;">
                                <form action="{{ route('search') }}" method="GET">
                                    <div class="search-row">
                                        <div class="search-item">
                                            <div class="search-icon">
                                                <img src="images/images/Vector.svg" alt="Search" width="32" height="32" aria-hidden="true">
                                            </div>
                                            <div class="search-content">
                                                <h3 class="search-title">{{ __('app.home.search_input_text') }}</h3>
                                                <input type="search" class="searchInput" id="searchInput" name="search" placeholder="{{ __('app.home.search_service_placeholder') }}" required>
                                            </div>
                                        </div>

                                        <div class="divider"></div>

                                        <div class="search-item">
                                            <div class="search-icon">
                                                <img src="images/images/mage_map-marker-fill.svg" alt="Location" width="32" height="32" aria-hidden="true">
                                            </div>
                                            <div class="search-content">
                                                <h3 class="search-title">{{ __('app.home.search_or_text') ?? 'Location' }}</h3>
                                                <input type="text" class="searchInput" id="locationInput" name="location" placeholder="{{ __('app.home.search_location_placeholder') }}">
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
                            <div class="service-filter-pills" role="tablist" aria-label="Service categories">
                                <button type="button" class="filter-pill active" data-category="all" aria-current="true">All</button>
                                @if(isset($categories) && count($categories) > 0)
                                    @foreach($categories as $category)
                                        <button type="button" class="filter-pill" data-category="{{ $category }}">{{ $category }}</button>
                                    @endforeach
                                @endif
                            </div>
        

        <div class="results-grid">
            @if(count($providers) > 0)
                @foreach($providers as $provider)
                    @php
                        $providerId = $provider['id'] ?? '';
                        $providerCategoriesList = isset($providerCategories[$providerId]) ? $providerCategories[$providerId] : [];
                        $categoriesString = implode(',', $providerCategoriesList);
                    @endphp
                    <div class="results-item" data-categories="{{ $categoriesString }}">
                        <div class="provider-card">
                            <a href="{{ url('/search?provider_id=' . $provider['id']) }}" class="provider-link">
                                @php
                                    $avgRating = isset($provider['avg_ratting']) ? floatval($provider['avg_ratting']) : 0;
                                @endphp
                                <div class="provider-image">
                                    <div class="provider-image-inner">
                                        <img src="{{ isset($provider['profileImg']) && $provider['profileImg'] ? $provider['profileImg'] : asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}" 
                                             alt="{{ $provider['name'] }}" 
                                             class="img-fluid"
                                             onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                                        <div class="image-overlay">
                                            <div class="overlay-left">
                                                {{-- <span class="overlay-title">
                                                    {{ !empty($provider['storeName']) 
                                                        ? $provider['storeName'] 
                                                        : (!empty($provider['name']) 
                                                            ? $provider['name'] 
                                                            : 'No Name') }}
                                                </span> --}}
                                                @if(isset($provider['companyName']) && $provider['companyName'])
                                                    <span class="overlay-meta">{{ $provider['companyName'] }}</span>
                                                @endif
                                            </div>
                                            {{-- <div class="rating-badge">
                                                <i class="fas fa-star"></i>
                                                <span>{{ number_format($avgRating, 1) }}</span>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="provider-details p-4">
                                    <div class="provider-card-heading-section">
                                    <h3 class="card-title">
                                        {{-- {{ !empty($provider['storeName']) 
                                            ? $provider['storeName'] 
                                            : (!empty($provider['name']) 
                                                ? $provider['name'] 
                                                : 'No Name') }} --}}
                                        {{ !empty($provider['companyName']) 
                                            ? $provider['companyName'] 
                                            : (!empty($provider['name']) 
                                                ? $provider['name'] 
                                                : 'No Name') }}
                                    </h3>
                                    <div class="rating-row">
                                        <img src="images/images/star_cards.svg" alt="Location" width="15" height="15">
                                        <span class="rating-value">{{ number_format($avgRating, 1) }}</span>
                                        <span class="rating-count">({{ $provider['total_review'] ?? 0 }})</span>
                                    </div>

                                    </div>
                                    <div class="provider-meta">
                                        @if(isset($provider['address']))
                                            <div class="address">
                                                <span class="search-icon search-icon-sm" aria-hidden="true">
                                                    <img src="images/images/mage_map-marker-fill.svg" alt="Location" width="20" height="20">
                                                </span>
                                                <span>{{ $provider['address'] }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    @php
                                        $weeklyTiming = isset($provider['timing']) && is_array($provider['timing']) ? $provider['timing'] : [];
                                        $daysOrder = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
                                        $now = \Carbon\Carbon::now();
                                        $todayKey = $now->format('D');
                                        $timezone = config('app.timezone') ?: 'UTC';

                                        $formatRange = function($range) use ($timezone) {
                                            if (!is_array($range) || count($range) < 2 || empty($range)) {
                                                return null;
                                            }
                                            $openTs = (int) ($range[0] ?? 0);
                                            $closeTs = (int) ($range[1] ?? 0);
                                            if ($openTs <= 0 || $closeTs <= 0) { return null; }
                                            $open = \Carbon\Carbon::createFromTimestamp($openTs, $timezone);
                                            $close = \Carbon\Carbon::createFromTimestamp($closeTs, $timezone);
                                            return $open->format('g:i A') . ' – ' . $close->format('g:i A');
                                        };

                                        $todayRangeText = $formatRange($weeklyTiming[$todayKey] ?? []);
                                        $isOpenToday = $todayRangeText !== null;

                                        // Find next opening day if closed today
                                        $nextOpenText = null;
                                        if (!$isOpenToday) {
                                            for ($i = 1; $i <= 7; $i++) {
                                                $day = $now->copy()->addDays($i);
                                                $key = $day->format('D');
                                                $r = $formatRange($weeklyTiming[$key] ?? []);
                                                if ($r) { $nextOpenText = 'Opens ' . ($i === 1 ? 'Tomorrow ' : $day->format('D ') ) . $r; break; }
                                            }
                                        }
                                        $cardId = $provider['id'] ?? uniqid('prov_');
                                        // Build 3 upcoming day chips (today + next two days)
                                        $chipDays = [];
                                        for ($i = 0; $i < 3; $i++) {
                                            $d = $now->copy()->addDays($i);
                                            $chipDays[] = [
                                                'label' => $d->format('D'),
                                                'day' => $d->format('d'),
                                            ];
                                        }
                                    @endphp

                                    <div class="timing-status" data-tooltip-id="timing-tooltip-{{ $cardId }}">
                                                <span class="search-icon search-icon-sm" aria-hidden="true">
                                                    <span class="status-dot {{ $isOpenToday ? 'open' : 'closed' }}"></span>
                                                </span>
                                        <span class="status-text">
                                            @if($isOpenToday)
                                                Open · {{ $todayRangeText }}
                                            @else
                                                Closed · {{ $nextOpenText ?: 'Hours unavailable' }}
                                            @endif
                                        </span>
                                    </div>

                                    <div class="timing-tooltip" id="timing-tooltip-{{ $cardId }}" aria-hidden="true">
                                        <div class="timing-tooltip-inner">
                                            @foreach($daysOrder as $dow)
                                                @php $rangeText = $formatRange($weeklyTiming[$dow] ?? []); @endphp
                                                <div class="timing-row {{ $todayKey === $dow ? 'today' : '' }}">
                                                    <span class="timing-day">{{ $dow }}</span>
                                                    <span class="timing-hours">{{ $rangeText ?: 'Closed' }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="availability-section">
                                        <div class="availability-title">Next Availability</div>
                                        @php
                                            $isAvailable = isset($provider['available']) && $provider['available'] === true;
                                        @endphp
                                        <div class="availability-row">
                                            <span class="time-of-day">
                                                Morning
                                            </span>
                                             @if(!$isAvailable)
                                             <div class="chip-group">
                                                    Not Available 
                                             </div>
                                                @endif
                                            @if($isAvailable)
                                            <div class="chip-group">
                                                @foreach($chipDays as $cd)
                                                    <span class="date-chip outline">{{ $cd['label'] }} <b>{{ $cd['day'] }}</b></span>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                        <div class="availability-row">
                                            <span class="time-of-day">
                                                Evening
                                            </span>
                                                @if(!$isAvailable)
                                                <div class="chip-group">
                                                    Not Available 
                                                </div>
                                                @endif
                                            @if($isAvailable)
                                            <div class="chip-group">
                                                @foreach($chipDays as $cd)
                                                    <span class="date-chip">{{ $cd['label'] }} <b>{{ $cd['day'] }}</b></span>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- <div class="card-footer-row">
                                        <div class="reviews-text">{{ $provider['total_review'] ?? 0 }} reviews</div>
                                        <span class="book-now-btn">BOOK NOW</span>
                                    </div> --}}
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
    .chip-group { display: flex; gap: 8px; flex-wrap: wrap; }
    .date-chip { background: rgba(229, 0, 80, 1); color: #ffffffff; border: 1px solid #ffd1df; padding: 4px 18px; border-radius: 10px; font-size: 14px; font-weight: 500; }
    .date-chip b { font-weight: 500; }
    .date-chip.outline { background: #fff; color: #6b7280; border-color: #e5e7eb; }

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
</style>
@endsection
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
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
});
</script>
@endsection
