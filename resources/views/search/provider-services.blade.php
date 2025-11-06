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
                        <h3 class="wow" style="font-size:30px; font-weight:600;">{{ $categoryName ?: 'Uncategorized' }}</h3>
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
                                        from €{{ $service['service_price'] ?? '0' }}
                                    </div>
                                    <div class="choose-button">
                                        <a href="{{ url('/book-appointment?serviceId=' . $service['id'] . '&service_provider_id=' . ($provider['id'] ?? '')) }}" 
                                        class="choose-btn">Choose</a>
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
    <div class="section-title" style="margin-bottom:initial; margin-top: 20px;">
        <h3 class="wow" style="font-size:30px; font-weight:600;">Hours of operation</h3>
    </div>
    <div class="custom-service-list" style="padding: 30px;">
        <div class="provider-details" style="color: #00000085;font-style: normal;font-size: 20px;">
            @if(isset($provider['timing']))
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
                @endphp

                @foreach($dayNames as $shortDay => $fullDay)
                    <div class="services-d-flex services-justify-between services-py-4 {{ !$loop->last ? 'services-border-bottom' : '' }}">
                        <span>{{ $fullDay }}</span>

                        @if(isset($provider['timing'][$shortDay]) && count($provider['timing'][$shortDay]) === 2)
                        @php
                            $openTime  = \Carbon\Carbon::createFromTimestamp($provider['timing'][$shortDay][0], 'Europe/Paris')->format('H:i');
                            $closeTime = \Carbon\Carbon::createFromTimestamp($provider['timing'][$shortDay][1], 'Europe/Paris')->format('H:i');
                        @endphp

                            @if($openTime === $closeTime || $openTime > $closeTime)
                                <span>Farm</span>
                            @else
                                <span>{{ $openTime }} - {{ $closeTime }}</span>
                            @endif
                        @else
                            <span>Farm</span>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

    </div>


        
        <div class="services-row services-mt-4">
            <div class="services-col-12">
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
/* Bootstrap-free grid system scoped to provider-services */
.service-proivder-mobile-view{
    display: none!important;
}
.provider-ratting-review{
    display: flex;
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
.provider-services .services-mt-4 { margin-top: 1.5rem; }
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
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.custom-service-list .service-row {
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}

.custom-service-list .service-row:last-child {
    border-bottom: none;
}

.custom-service-list .service-info {
    max-width: 70%;
}

.custom-service-list .service-name {
    font-size: 16px;
    margin-bottom: 4px;
}

.custom-service-list .service-desc {
    font-size: 14px;
    color: #666;
}

.custom-service-list .service-meta {
    min-width: 120px;
}

.custom-service-list .choose-btn {
    background-color: #1c1c1c;
    color: white;
    border: none;
    border-radius: 10px;
    padding: 6px 14px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.custom-service-list .choose-btn:hover {
    background-color: #333;
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
