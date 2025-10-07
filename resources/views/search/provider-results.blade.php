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
                                    @endphp

                                    <div class="timing-status" data-tooltip-id="timing-tooltip-{{ $cardId }}">
                                        <span class="status-dot {{ $isOpenToday ? 'open' : 'closed' }}"></span>
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

    /* Timing status & tooltip */
    .timing-status .status-text{ font-size: 14px; font-weight: 400; }
    .timing-status { margin-top: 10px; display: inline-flex; align-items: center; gap: 8px; cursor: pointer; color: #374151; font-weight: 600; }
    .timing-status .status-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; }
    .timing-status .status-dot.open { background: #10b981; }
    .timing-status .status-dot.closed { background: #ef4444; }
    .timing-tooltip { position: fixed; z-index: 9999; background: #fff; box-shadow: 0 10px 30px rgba(0,0,0,0.15); border: 1px solid #e5e7eb; border-radius: 12px; padding: 10px; width: 240px; display: none; }
    .timing-tooltip .timing-tooltip-inner { max-height: 260px; overflow: auto; }
    .timing-row { display: flex; justify-content: space-between; padding: 6px 8px; border-radius: 8px; font-size: 14px; }
    .timing-row.today { background: #f9fafb; font-weight: 700; }
    .timing-day { color: #374151; }
    .timing-hours { color: #111827; }

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
});
</script>
@endsection
