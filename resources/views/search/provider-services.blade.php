@extends('layouts.mainInnerPages')

@section('title', 'Provider Services')

@section('content')

    <!-- Page Header Start -->
    <div class="page-header bg-section">
        <div class="services-container">
            <div class="services-row">
                <div class="services-col-12">
                    <!-- Page Header Box Start -->
                    
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


<!-- Provider Services Section Start -->
<div class="provider-services" style="margin: 0 0 50px 0;">
    <div class="services-container">
        <div class="services-row section-row">
            <div class="services-col-12">
                <div class="provider-header services-mb-1">
                    <div class="services-row services-align-center service-proivder-desktop-view">
                        <div class="services-col-md-10 service-page-header-text">
                            <h2>{{ $provider['storeName'] ?? $provider['name'] }}</h2>
                            @if(isset($provider['companyName']))
                                <h4 class="service-name-heading">{{ $provider['companyName'] }}</h4>
                            @endif
                            <div class="provider-info">
                                <div class="provider-ratting-review">
                                @if(isset($provider['avg_ratting']) && $provider['avg_ratting'] > 0)
                                    <p>
                                        <div class="provider-info-ratting">{{ $provider['avg_ratting'] }}</div>
                                        <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                                        <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                                        <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                                        <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                                        <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                                        
                                        <div class="provider-info-reviews">({{ $provider['total_review'] ?? 0 }} reviews)</div>
                                    </p>
                                @endif
                                </div>
                                <div class="provider-service-address">
                                    @if(isset($provider['address']))
                                        <p>
                                            <img src="images/images/mage_map-marker-fill.svg" alt="Location" width="18" height="18">
                                            <div class="provider-info-address"> {{ $provider['address'] }} </div>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                            <div class="desktop-image-controls">
                                <button class="desktop-control-btn share-btn" aria-label="Share">
                                    <img src="images/images/share-icon.svg" alt="Location" width="25" height="25">
                                </button>
                                <button class="desktop-control-btn heart-btn" aria-label="Favorite">
                                    <img src="images/images/si_heart-line.svg" alt="Location" width="25" height="25">
                                </button>
                            </div>
                    </div>
                    @php
                        // Collect images: first image is provider profileImg, rest from services
                        $providerImages = [];
                        $defaultImage = asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg');
                        
                        // First image: provider profile image
                        $firstImage = isset($provider['profileImg']) && $provider['profileImg'] 
                            ? $provider['profileImg'] 
                            : $defaultImage;
                        $providerImages[] = $firstImage;
                        
                        // Collect images from services for the remaining 4 slots
                        if (isset($services) && is_array($services) && count($services) > 0) {
                            foreach ($services as $service) {
                                // Check if service has images array
                                if (isset($service['images']) && is_array($service['images']) && count($service['images']) > 0) {
                                    foreach ($service['images'] as $serviceImage) {
                                        if (count($providerImages) >= 5) {
                                            break 2; // Break both loops when we have 5 images
                                        }
                                        if (!empty($serviceImage)) {
                                            $providerImages[] = $serviceImage;
                                        }
                                    }
                                }
                                // If we already have 5 images, break
                                if (count($providerImages) >= 5) {
                                    break;
                                }
                            }
                        }
                        
                        // Fill remaining slots with default image if needed
                        while (count($providerImages) < 5) {
                            $providerImages[] = $defaultImage;
                        }
                        
                        // Ensure we have exactly 5 images
                        $providerImages = array_slice($providerImages, 0, 5);
                    @endphp
                    
                    <!-- Desktop Grid View -->
                    <div class="provider-images-grid">
                        <div class="provider-image-main">
                            <img src="{{ $providerImages[0] }}" 
                                 alt="{{ $provider['name'] ?? 'Provider' }}" 
                                 class="services-img-fluid"
                                 onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                        </div>
                        <div class="provider-images-small">
                            <div class="provider-image-small">
                                <img src="{{ $providerImages[1] }}" 
                                     alt="{{ $provider['name'] ?? 'Provider' }}" 
                                     class="services-img-fluid"
                                     onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                            </div>
                            <div class="provider-image-small">
                                <img src="{{ $providerImages[2] }}" 
                                     alt="{{ $provider['name'] ?? 'Provider' }}" 
                                     class="services-img-fluid"
                                     onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                            </div>
                            <div class="provider-image-small">
                                <img src="{{ $providerImages[3] }}" 
                                     alt="{{ $provider['name'] ?? 'Provider' }}" 
                                     class="services-img-fluid"
                                     onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                            </div>
                            <div class="provider-image-small">
                                <img src="{{ $providerImages[4] }}" 
                                     alt="{{ $provider['name'] ?? 'Provider' }}" 
                                     class="services-img-fluid"
                                     onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mobile Carousel View -->
                    <div class="provider-images-carousel">
                        <div class="carousel-controls-top">
                            <button class="carousel-btn-mobile share-btn" aria-label="Share">
                                <img src="images/images/share-icon.svg" alt="Location" width="25" height="25">
                            </button>
                            <button class="carousel-btn-mobile heart-btn" aria-label="Favorite">
                                <img src="images/images/si_heart-line.svg" alt="Location" width="25" height="25">
                            </button>
                        </div>
                        <div class="carousel-container">
                            <div class="carousel-track">
                                @foreach($providerImages as $index => $image)
                                    <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ $image }}" 
                                             alt="{{ $provider['name'] ?? 'Provider' }}" 
                                             class="services-img-fluid"
                                             onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="carousel-counter">
                            <span class="current-slide">1</span>/<span class="total-slides">5</span>
                        </div>
                        <div class="carousel-dots">
                            @foreach($providerImages as $index => $image)
                                <span class="carousel-dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></span>
                            @endforeach
                        </div>
                    </div>
                    <div class="services-row services-align-center service-proivder-mobile-view">
                        <div class="services-col-md-10 service-page-header-text">
                            <h2>{{ $provider['storeName'] ?? $provider['name'] }}</h2>
                            @if(isset($provider['companyName']))
                                <h4 class="service-name-heading">{{ $provider['companyName'] }}</h4>
                            @endif
                            <div class="provider-info">
                                <div class="provider-ratting-review">
                                @if(isset($provider['avg_ratting']) && $provider['avg_ratting'] > 0)
                                    <p>
                                        <div class="provider-info-ratting">{{ $provider['avg_ratting'] }}</div>
                                        <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                                        <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                                        <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                                        <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                                        <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                                        
                                        <div class="provider-info-reviews">({{ $provider['total_review'] ?? 0 }} reviews)</div>
                                    </p>
                                @endif
                                </div>
                                <div class="provider-service-address">
                                @if(isset($provider['address']))
                                    <p>
                                        <img src="images/images/mage_map-marker-fill.svg" alt="Location" width="18" height="18">
                                        <div class="provider-info-address"> {{ $provider['address'] }} </div>
                                    </p>
                                @endif
                                </div>
                            </div>
                        </div>
                            <div class="desktop-image-controls">
                                <button class="desktop-control-btn share-btn" aria-label="Share">
                                    <img src="images/images/share-icon.svg" alt="Location" width="25" height="25">
                                </button>
                                <button class="desktop-control-btn heart-btn" aria-label="Favorite">
                                    <img src="images/images/si_heart-line.svg" alt="Location" width="25" height="25">
                                </button>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        
                            {{-- <div class="section-title">
                                <h1 class="text-anime-style-2" >Book online for an appointment at<span> {{$provider['companyName']}}  </span></h1>
                                <h3 class="wow fadeInUp">24/7 - Free - Payment on site - Immediate confirmation</h3>
                            </div> --}}
@php
    // Group services by category and sort by category name
    $groupedServices = collect($services)
        ->groupBy(function ($service) {
            return $service['category']['name'] ?? 'Uncategorized';
        })
        ->sortKeys();
@endphp

    <div class="services-row">
        <div class="services-col-lg-8">
                @if(count($services) > 0)
                @foreach($groupedServices as $categoryName => $servicesInCategory)
                    <div class="section-title" style="display: flex;margin-bottom: 25px;margin-top: 20px;">
                        {{-- Display category name --}}
                        <h3 class="wow" style="font-size:30px; font-weight:500; letter-spacing: -1px; color:rgba(229, 0, 80, 1)">{{ $categoryName ?: 'Uncategorized' }}</h3>
                    </div>
                    <div class="custom-service-list">
                        @foreach($servicesInCategory as $service)
                            <div class="service-row services-d-flex services-justify-between services-flex-wrap">
                                
                                <!-- Left -->
                                <div class="service-info services-d-flex services-align-center">
                                    {{-- <div class="section-title" style="margin-bottom:initial;">
                                        <h3 class="wow fadeInUp">{{ $service['category']['name'] }}</h3>
                                    </div> --}}
                                    
                                
                                    <div class="service-image">
                                        <img src="{{ (isset($service['images']) && count($service['images']) > 0) ? $service['images'][0] : asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}" 
                                            alt="{{ $service['service_name'] }}" 
                                            class="services-img-fluid services-rounded-circle"
                                            onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                                    </div>
                                    <div class="service-list-details" style="margin-left: 35px;">
                                        <div class="service-name services-fw-semibold">
                                        {{-- {{ $service['service_name'] }} --}}
                                        {{ \Illuminate\Support\Str::limit($service['service_name'], 50, '...') }}
                                    </div>
                                    @if(!empty($service['service_details']))
                                        <div class="service-desc services-text-muted">
                                            {{ \Illuminate\Support\Str::limit($service['service_details'], 50, '...') }}
                                        </div>
                                    @endif

                                    </div>
                                </div>

                                <!-- Right -->
                                <div class="service-meta services-text-end">
                                    <div class="services-text-muted services-small services-mb-1">
                                        {{ $service['duration_minutes'] ?? 0 }} min 
                                        &bull; 
                                        {{ __('app.service.from') }} €{{ $service['service_price'] ?? '0' }}
                                    </div>
                                    <div class="choose-button">
                                        <a href="{{ url('/book-appointment?serviceId=' . $service['id'] . '&service_provider_id=' . ($provider['id'] ?? '')) }}" 
                                        class="choose-btn">{{ __('app.service.choose') }}</a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach 
                @else
                    <div class="custom-service-list">
                    <div class="services-text-center services-py-4">
                        <h5>No services available from this provider.</h5>
                    </div>
                    </div>
                @endif

                
        </div>
<div class="services-col-lg-4">
    <div class="provider-info-card">
        <!-- Header Section -->
        <div class="provider-card-header">
                            @if(isset($provider['companyName']))
                                <h4 class="provider-card-company-name">{{ $provider['companyName'] }}</h4>
                            @endif
            {{-- <h2 class="provider-card-name">{{ $provider['storeName'] ?? $provider['name'] }}</h2> --}}
            @if(isset($provider['avg_ratting']) && $provider['avg_ratting'] > 0)
                <div class="provider-ratting-review">
                @if(isset($provider['avg_ratting']) && $provider['avg_ratting'] > 0)
                    <p>
                        <div class="provider-info-ratting">{{ $provider['avg_ratting'] }}</div>
                        <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                        <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                        <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                        <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                        <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                        
                        <div class="provider-info-reviews">({{ $provider['total_review'] ?? 0 }} reviews)</div>
                    </p>
                @endif
                </div>
            @endif
            <a href="#" class="to-book-btn">{{ __('app.service.to_book') }}</a>
        </div>
        
        <!-- Separator -->
        <div class="provider-card-separator"></div>
        
        <!-- Hours of Operation Section -->
        <div class="hours-section">
            @php
                $dayNames = [
                    'Mon' => 'Monday',
                    'Tue' => 'Tuesday',
                    'Wed' => 'Wednesday',
                    'Thu' => 'Thursday',
                    'Fri' => 'Friday',
                    'Sat' => 'Saturday',
                    'Sun' => 'Sunday',
                ];
                
                // Get current day and closing time for "Open until" display
                $now = \Carbon\Carbon::now('Europe/Paris');
                $todayKey = $now->format('D');
                $openUntil = '';
                if (isset($provider['timing'][$todayKey]) && count($provider['timing'][$todayKey]) === 2) {
                    $closeTime = \Carbon\Carbon::createFromTimestamp($provider['timing'][$todayKey][1], 'Europe/Paris');
                    $openTime = \Carbon\Carbon::createFromTimestamp($provider['timing'][$todayKey][0], 'Europe/Paris');
                    if ($openTime->format('H:i') !== $closeTime->format('H:i') && $openTime->format('H:i') < $closeTime->format('H:i')) {
                        $openUntil = $closeTime->format('ga');
                    }
                }
            @endphp
            
            <div class="hours-toggle-header" id="hoursToggle">
                <div class="hours-toggle-left">
                    <img src="images/images/iconoir_clock.svg" alt="Location" width="24" height="24">
                    <span class="open-until-text">@if($openUntil){{ __('app.service.open') }} <span class="until-text-time">{{ __('app.service.until') }} {{ $openUntil }}</span>@else Hours of operation @endif</span>
                </div>
                <i class="fas fa-chevron-up hours-chevron" id="hoursChevron"></i>
            </div>
            
            <div class="hours-list" id="hoursList">
                @if(isset($provider['timing']))
                    @foreach($dayNames as $shortDay => $fullDay)
                        <div class="hours-row">
                            <span class="hours-day">{{ $fullDay }}</span>
                            @if(isset($provider['timing'][$shortDay]) && count($provider['timing'][$shortDay]) === 2)
                                @php
                                    $openTime  = \Carbon\Carbon::createFromTimestamp($provider['timing'][$shortDay][0], 'Europe/Paris')->format('H:i');
                                    $closeTime = \Carbon\Carbon::createFromTimestamp($provider['timing'][$shortDay][1], 'Europe/Paris')->format('H:i');
                                @endphp
                                @if($openTime === $closeTime || $openTime > $closeTime)
                                    <span class="hours-time">Closed</span>
                                @else
                                    <span class="hours-time">{{ $openTime }} - {{ $closeTime }}</span>
                                @endif
                            @else
                                <span class="hours-time">Closed</span>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        
        <!-- Location Section -->
        <div class="provider-service-address">
            @if(isset($provider['address']))
                <p>
                    <img src="images/images/mage_map-marker-fill.svg" alt="Location" width="18" height="18">
                    <div class="provider-info-address"> {{ $provider['address'] }} </div>
                </p>
            @endif
        </div>
    </div>
</div>

    </div>


        
        <div class="services-row services-mt-4">
            <div class="services-col-12">
                <a href="{{ url()->previous() }}" class="btn-default">
                     {{ __('app.service.back_to_search_page') }}
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Provider Services Section End -->
@endsection

@section('styles')
<style>
/* Bootstrap-free grid system scoped to provider-services */
.service-proivder-mobile-view{
    display: none!important;
}
.provider-ratting-review{
    display: flex;
    gap: 7px;
}
.provider-service-address{
    display: flex;
}
.provider-services .services-container,
.page-header .services-container {
    width: 100%;
    max-width: 1275px;
    margin: 0 auto;
    padding: 0 15px;
}
.service-name-heading{
    letter-spacing: -2px;
    font-weight: 700;
    font-size: 80px;
}
.page-header .services-row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

.page-header .services-col-12 {
    padding: 0 15px;
    flex: 0 0 100%;
    width: 100%;
}

.provider-services .services-row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

.provider-services .services-col-12,
.provider-services .services-col-md-10,
.provider-services .services-col-lg-8,
.provider-services .services-col-lg-4 {
    padding: 0 15px;
    flex: 0 0 100%;
    width: 100%;
}

@media (min-width: 768px) {
    .provider-services .services-col-md-10 {
        flex: 0 0 83.333333%;
        max-width: 83.333333%;
    }
}

@media (min-width: 992px) {
    .provider-services .services-col-lg-8 {
        flex: 0 0 66.666667%;
        max-width: 66.666667%;
    }
    .provider-services .services-col-lg-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
}

/* Utility classes scoped to provider-services */
.provider-services .services-d-flex { display: flex; }
.provider-services .services-align-center { align-items: center; }
.provider-services .services-justify-between { justify-content: space-between; }
.provider-services .services-flex-wrap { flex-wrap: wrap; }
.provider-services .services-text-center { text-align: center; }
.provider-services .services-text-end { text-align: right; }
.provider-services .services-text-muted { color: #6c757d; }
.provider-services .services-small { font-size: 0.875rem; }
.provider-services .services-fw-semibold { font-weight: 600; }
.provider-services .services-img-fluid { max-width: 100%; display: block; }
.provider-services .services-rounded-circle { border-radius: 50%; }
.provider-services .services-mb-1 { margin-bottom: 0.25rem; }
.provider-services .services-mt-4 { margin-top: 2.5rem; }
.provider-services .services-py-4 { padding-top: 1.5rem; padding-bottom: 1.5rem; }
.provider-services .services-border-bottom { border-bottom: 1px solid #dee2e6; }

.choose-button{
    margin-top: 20px;
}
.provider-header {
    /* background: #fff;
    border-radius: 10px;
    padding: 20px;
    color: #333;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1); */
}


/* Desktop Grid Layout */
.provider-images-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    margin-top: 20px;
}

.provider-image-main {
    grid-row: 1 / 3;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    height: 360px;
}

.desktop-image-controls {
    position: relative;
    top: 50px;
    right: -83px;
    z-index: 10;
    display: flex;
    gap: 10px;
}

.desktop-control-btn {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: transparent;
    border: 1.5px solid rgba(213, 190, 198, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #ff69b4;
    padding: 0;
}

.desktop-control-btn:hover {
    background: rgba(255, 255, 255, 0.9);
    transform: scale(1.05);
}

.desktop-control-btn i {
    font-size: 16px;
}

.desktop-control-btn.heart-btn.active {
    background: #ff69b4;
    color: white;
}

.desktop-control-btn.heart-btn.active i {
    color: white;
}

.provider-image-main img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.provider-images-small {
    grid-row: 1 / 3;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
    height: 360px;
    grid-template-rows: repeat(2, 1fr);
}

.provider-image-small {
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    height: 100%;
}

.provider-image-small img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

/* Mobile Carousel Layout */
.provider-images-carousel {
    display: none;
    position: relative;
    margin-top: 20px;
    border-radius: 10px;
    overflow: hidden;
}

.carousel-controls-top {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 10;
    display: flex;
    gap: 10px;
}

.carousel-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    color: #ff69b4;
}

.carousel-btn:hover {
    background: #f8f8f8;
    transform: scale(1.05);
}

.carousel-btn i {
    font-size: 16px;
}

.heart-btn.active i {
    color: #ff69b4;
}

.carousel-container {
    position: relative;
    width: 100%;
    height: 300px;
    overflow: hidden;
    border-radius: 10px;
}

.carousel-track {
    display: flex;
    position: relative;
    width: 100%;
    height: 300px;
}

.carousel-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.carousel-slide.active {
    opacity: 1;
    position: relative;
    pointer-events: auto;
}

.carousel-slide img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    display: block;
    border-radius: 10px;
}

.carousel-counter {
    position: absolute;
    bottom: 50px;
    right: 15px;
    background: rgba(0, 0, 0, 0.6);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 14px;
    z-index: 10;
}

.carousel-dots {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
}

.carousel-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: all 0.3s ease;
}

.carousel-dot.active {
    background: white;
    width: 24px;
    border-radius: 4px;
}

/* Responsive: Show carousel on mobile, grid on desktop */
@media (max-width: 767px) {
    .provider-images-grid {
        display: none;
    }
    
    .provider-images-carousel {
        display: block;
    }
    .service-proivder-desktop-view{
        display: none!important;
    }
    .service-proivder-mobile-view{
        display: block!important;
    }
    .desktop-image-controls{
        display: none;
    }
    .service-name-heading{
        font-size: 35px;
        letter-spacing: 0px;
    }
    .provider-info{
        display: block!important;
    }
    .provider-ratting-review{
        gap: 7px;
    }
    .carousel-btn-mobile{
        width: 50px;
        height: 50px;
        border-radius: 40px;
        background-color: rgb(255 255 255);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .provider-card-company-name{
        letter-spacing: 0px!important;
        font-size: 30px!important;
    }
    .hours-row{
        padding:initial!important;
    }
}

@media (min-width: 768px) {
    .provider-images-grid {
        display: grid;
    }
    
    .provider-images-carousel {
        display: none;
    }
}

.provider-info {
    /* margin-top: 10px; */
    display: flex;
    align-items: center;
    gap: 5px;
}
.provider-info-ratting{
    font-weight: 700;
    font-size: 14px;
    color: #000000ff;
}
.provider-info-reviews{
    font-weight: 700;
    font-size: 14px;
    color: rgba(233, 93, 142, 1);
}
.provider-info-address{
    font-weight: 500;
    font-size: 14px;
    color: rgba(44, 13, 24, 0.5);
}
/* .service-page-header-text{
    margin-top: 29px;
    line-height: 65px;
} */

.provider-info p {
    gap: 5px;
    display: flex;
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
    width: 60px;
    height: 60px;
    object-fit: cover;
}
.service-image{
    /* margin-bottom: 10px; */
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
/* SCOPED to .custom-service-list */
.custom-service-list {
    background: transparent;
    border-radius: 0;
    padding: 0;
    box-shadow: none;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.custom-service-list .service-row {
    padding: 7px 20px;
    border: 1px solid rgba(213, 190, 198, 1);
    border-radius: 20px;
    background: rgba(255, 240, 245, 0.5);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.custom-service-list .service-row:last-child {
    border-bottom: 1px solid rgba(229, 0, 80, 0.2);
}

.custom-service-list .service-info {
    max-width: 70%;
    display: flex;
    align-items: center;
    gap: 20px;
    flex: 1;
}

.custom-service-list .service-image {
    flex-shrink: 0;
    position: relative;
}

.custom-service-list .service-image img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    background: #f5f5dc;
    border: none;
}

.custom-service-list .service-image-placeholder {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #f5f5dc;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: 600;
    color: #8b7355;
    text-align: center;
    line-height: 1.2;
    padding: 5px;
    word-break: break-word;
}

.custom-service-list .service-list-details {
    flex: 1;
    margin-left: 0 !important;
}

.custom-service-list .service-name {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #1a1a1a;
    line-height: 1.4;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.custom-service-list .service-desc {
    font-size: 14px;
    color: rgba(26, 26, 26, 0.65);
    line-height: 1.5;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.custom-service-list .service-meta {
    /* display: flex; */
    flex-direction: column;
    align-items: flex-end;
    /* gap: 12px; */
    min-width: 140px;
}

.custom-service-list .service-meta > div:first-child {
    color: rgba(44, 13, 24, 0.5);
    font-size: 14px;
    font-weight: 500;
}

.custom-service-list .choose-btn {
    background: linear-gradient(90deg, #e50050 0%, #ff6b35 100%);
    color: white;
    border: none;
    border-radius: 40px;
    padding: 10px 24px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.custom-service-list .choose-btn:hover {
    background: linear-gradient(90deg, #cc0046 0%, #e55a2b 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(229, 0, 80, 0.3);
}

/* Provider Info Card Styles */
.provider-info-card {
    border: 1px solid rgba(213, 190, 198, 1);
    background: rgba(255, 240, 245, 0.5);
    border-radius: 20px;
    padding: 25px;
    margin-top: 20px;
}

.provider-card-header {
    margin-bottom: 20px;
}
.provider-card-company-name{
    letter-spacing: -2px;
    font-weight: 700;
    font-size: 50px;
}

.provider-card-name {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin-bottom: 12px;
    line-height: 1.2;
}

.provider-card-rating {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.rating-number {
    font-size: 16px;
    font-weight: 600;
    color: #333;
}

.rating-stars {
    display: flex;
    gap: 2px;
}

.rating-stars i {
    color: #ffa500;
    font-size: 14px;
}

.review-count-text {
    font-size: 14px;
    font-weight: 600;
    color: rgba(233, 93, 142, 1);
}

.to-book-btn {
    display: block;
    width: 100%;
    background: rgba(229, 0, 80, 1);
    color: white;
    text-align: center;
    padding: 12px 20px;
    border-radius: 45px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    margin-top: 15px;
}

.to-book-btn:hover {
    background: #e55a9f;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(255, 105, 180, 0.3);
}

.provider-card-separator {
    height: 1px;
    background: rgba(0, 0, 0, 0.1);
    margin: 20px 0;
}

.hours-section {
    margin-bottom: 20px;
}

.hours-toggle-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    padding: 10px 0;
    user-select: none;
}

.hours-toggle-left {
    display: flex;
    align-items: center;
    gap: 8px;
}

.hours-icon {
    color: rgba(233, 93, 142, 1);
    font-size: 16px;
}

.open-until-text {
    font-size: 14px;
    font-weight: 500;
    color: rgba(233, 93, 142, 1);
}
.until-text-time{
    font-size: 14px;
    font-weight: 500;
    color: rgba(118, 33, 62, 1);
}

.hours-chevron {
    color: rgba(233, 93, 142, 1);
    font-size: 12px;
    transition: transform 0.3s ease;
}

.hours-chevron.rotated {
    transform: rotate(180deg);
}

.hours-list {
    max-height: 500px;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.hours-list.collapsed {
    max-height: 0;
    overflow: hidden;
}

.hours-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: none;
}

.hours-day {
    font-size: 18px;
    font-weight: 700;
    color: #333;
}

.hours-time {
    font-size: 14px;
    font-weight: 400;
    color: rgba(0, 0, 0, 0.6);
}

.provider-card-location {
    display: flex;
    align-items: center;
    gap: 8px;
    padding-top: 15px;
    margin-top: 15px;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.location-pin {
    color: #e50050;
    font-size: 14px;
}

.location-address {
    font-size: 12px;
    font-weight: 400;
    color: rgba(0, 0, 0, 0.5);
    line-height: 1.4;
}

</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.provider-images-carousel');
    if (!carousel) return;
    
    const slides = carousel.querySelectorAll('.carousel-slide');
    const dots = carousel.querySelectorAll('.carousel-dot');
    const currentSlideSpan = carousel.querySelector('.current-slide');
    const totalSlidesSpan = carousel.querySelector('.total-slides');
    const heartBtn = carousel.querySelector('.heart-btn');
    
    let currentSlide = 0;
    const totalSlides = slides.length;
    
    if (totalSlidesSpan) {
        totalSlidesSpan.textContent = totalSlides;
    }
    
    // Function to update carousel
    function updateCarousel(index) {
        // Remove active class from all slides and dots
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        // Add active class to current slide and dot
        if (slides[index]) {
            slides[index].classList.add('active');
        }
        if (dots[index]) {
            dots[index].classList.add('active');
        }
        
        // Update counter
        if (currentSlideSpan) {
            currentSlideSpan.textContent = index + 1;
        }
        
        currentSlide = index;
    }
    
    // Dot click handlers
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            updateCarousel(index);
        });
    });
    
    // Swipe functionality for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    carousel.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    });
    
    carousel.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0 && currentSlide < totalSlides - 1) {
                // Swipe left - next slide
                updateCarousel(currentSlide + 1);
            } else if (diff < 0 && currentSlide > 0) {
                // Swipe right - previous slide
                updateCarousel(currentSlide - 1);
            }
        }
    }
    
    // Heart button toggle
    if (heartBtn) {
        heartBtn.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    }
    
    // Desktop heart button toggle
    const desktopHeartBtn = document.querySelector('.provider-image-main .heart-btn');
    if (desktopHeartBtn) {
        desktopHeartBtn.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    }
    
    // Hours toggle functionality
    const hoursToggle = document.getElementById('hoursToggle');
    const hoursList = document.getElementById('hoursList');
    const hoursChevron = document.getElementById('hoursChevron');
    
    if (hoursToggle && hoursList && hoursChevron) {
        hoursToggle.addEventListener('click', function() {
            hoursList.classList.toggle('collapsed');
            hoursChevron.classList.toggle('rotated');
        });
    }
    
    // Auto-play (optional - can be removed if not needed)
    // let autoPlayInterval = setInterval(() => {
    //     const nextSlide = (currentSlide + 1) % totalSlides;
    //     updateCarousel(nextSlide);
    // }, 5000);
    
    // Pause auto-play on hover/touch
    // carousel.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
    // carousel.addEventListener('mouseleave', () => {
    //     autoPlayInterval = setInterval(() => {
    //         const nextSlide = (currentSlide + 1) % totalSlides;
    //         updateCarousel(nextSlide);
    //     }, 5000);
    // });
});
</script>
@endsection
