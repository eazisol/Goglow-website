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
                            {{-- <h2>{{ $provider['storeName'] ?? $provider['name'] }}</h2> --}}
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
                                        
                                        <div class="provider-info-reviews">({{ $provider['total_review'] ?? 0 }} {{ __('app.service.reviews') }})</div>
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
                        // Collect images: first image is provider profileImg, rest from salon_images then services
                        $providerImages = [];
                        $defaultImage = asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg');
                        
                        // First image: provider profile image
                        $firstImage = isset($provider['profileImg']) && $provider['profileImg'] 
                            ? $provider['profileImg'] 
                            : $defaultImage;
                        $providerImages[] = $firstImage;
                        
                        // Track salon_images count for overlay logic
                        $salonImages = isset($provider['salon_images']) && is_array($provider['salon_images']) 
                            ? array_filter($provider['salon_images'], function($img) { return !empty($img); }) // Filter out empty images
                            : [];
                        $salonImages = array_values($salonImages); // Re-index array after filtering
                        $salonImagesCount = count($salonImages);
                        
                        // Add salon_images to the array (up to 4 images) before service images
                        // We need exactly 4 small images, so take first 4 salon images
                        $salonImagesToUse = array_slice($salonImages, 0, 4); // Take first 4 salon images
                        foreach ($salonImagesToUse as $salonImage) {
                            if (!empty($salonImage)) {
                                $providerImages[] = $salonImage;
                            }
                        }
                        
                        // Only collect images from services if we have fewer than 4 salon images
                        $salonImagesAdded = count($salonImagesToUse);
                        if ($salonImagesAdded < 4 && isset($services) && is_array($services) && count($services) > 0) {
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
                        
                        // Calculate total images for overlay (provider profile + all salon_images)
                        $totalImagesForOverlay = 1 + $salonImagesCount;
                        $showOverlay = $totalImagesForOverlay > 5;
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
                                     loading="lazy"
                                     onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                            </div>
                            <div class="provider-image-small">
                                <img src="{{ $providerImages[2] }}" 
                                     alt="{{ $provider['name'] ?? 'Provider' }}" 
                                     class="services-img-fluid"
                                     loading="lazy"
                                     onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                            </div>
                            <div class="provider-image-small">
                                <img src="{{ $providerImages[3] }}" 
                                     alt="{{ $provider['name'] ?? 'Provider' }}" 
                                     class="services-img-fluid"
                                     loading="lazy"
                                     onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                            </div>
                            <div class="provider-image-small" id="fourth-image-container">
                                <img src="{{ $providerImages[4] }}" 
                                     alt="{{ $provider['name'] ?? 'Provider' }}" 
                                     class="services-img-fluid"
                                     loading="lazy"
                                     onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                                @if(isset($provider['salon_images']) && is_array($provider['salon_images']) && count($provider['salon_images']) > 0)
                                    @php
                                        $galleryImages = array_merge(
                                            [$firstImage],
                                            $provider['salon_images']
                                        );
                                    @endphp
                                    <div class="see-all-photos-overlay" id="see-all-overlay" style="display: {{ $showOverlay ? 'flex' : 'none' }};">
                                        <span>See all {{ $totalImagesForOverlay }} photos</span>
                                    </div>
                                    <div class="gallery-data" 
                                         data-gallery-images='@json($galleryImages)'
                                         style="display: none;"></div>
                                @endif
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
                                             loading="lazy"
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
                            {{-- <h2>{{ $provider['storeName'] ?? $provider['name'] }}</h2> --}}
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
                                        
                                        <div class="provider-info-reviews">({{ $provider['total_review'] ?? 0 }} {{ __('app.service.reviews') }})</div>
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
                            {{-- Category filter pills - will be populated by JavaScript --}}
                            <div class="service-filter-pills" role="tablist" aria-label="Service categories" style="margin-bottom:0!important;">
                                <button type="button" class="filter-pill active" data-category="all" aria-current="true">All</button>
                                {{-- Categories will be added here by JavaScript --}}
                            </div>

    <!-- View Type Tabs Section Start -->
    <div class="view-type-tabs-container" style="margin-top: 20px;">
        <div class="view-type-tabs">
            <a href="{{ route('search') }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}" class="view-tab active" data-view="list">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 5H17.5M2.5 10H17.5M2.5 15H17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M2.5 2.5H5.83333V5H2.5V2.5Z" fill="currentColor"/>
                </svg>
                <span>Service List</span>
            </a>
            <a href="{{ route('search.videos.provider', ['provider_id' => $providerId ?? request()->get('provider_id')]) }}" class="view-tab" data-view="videos">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2.5" y="4.16667" width="15" height="11.6667" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M8.33333 7.5L13.3333 10L8.33333 12.5V7.5Z" fill="currentColor"/>
                </svg>
                <span>Service Videos</span>
            </a>
        </div>
    </div>
    <!-- View Type Tabs Section End -->

    <div class="services-row">
        <div class="services-col-lg-8">
                {{-- Loading state --}}
                <div id="servicesLoading" class="services-text-center services-py-4" style="display: none;">
                    <p>Loading services...</p>
                </div>
                
                {{-- Error state --}}
                <div id="servicesError" class="custom-service-list" style="display: none;">
                    <div class="services-text-center services-py-4">
                        <h5>Failed to load services. Please try again later.</h5>
                    </div>
                </div>
                
                {{-- Services container - will be populated by JavaScript --}}
                <div id="servicesContainer"></div>
                
                {{-- Empty state --}}
                <div id="servicesEmpty" class="custom-service-list" style="display: none;">
                    <div class="services-text-center services-py-4">
                        <h5>No services available from this provider.</h5>
                    </div>
                </div>

                
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
                        
                        <div class="provider-info-reviews">({{ $provider['total_review'] ?? 0 }} {{ __('app.service.reviews') }})</div>
                    </p>
                @endif
                </div>
            @endif
            {{-- <a href="#" class="to-book-btn">{{ __('app.service.to_book') }}</a> --}}
        </div>
        
        <!-- Separator -->
        <div class="provider-card-separator"></div>
        
        <!-- Hours of Operation Section -->
        <div class="hours-section">
            @php
$dayNames = [
    'Mon' => __('app.service.monday'),
    'Tue' => __('app.service.tuesday'),
    'Wed' => __('app.service.wednesday'),
    'Thu' => __('app.service.thursday'),
    'Fri' => __('app.service.friday'),
    'Sat' => __('app.service.saturday'),
    'Sun' => __('app.service.sunday'),
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

<!-- Share Popup Modal -->
<div id="sharePopup" class="share-popup" style="display: none;">
    <div class="share-popup-overlay"></div>
    <div class="share-popup-content">
        <div class="share-popup-header">
            <h3>Share this page</h3>
            <button class="share-popup-close" aria-label="Close">&times;</button>
        </div>
        <div class="share-popup-body">
            <div class="share-url-container">
                <input type="text" id="shareUrlInput" class="share-url-input" readonly value="{{ url()->current() }}">
                <button class="share-copy-btn" id="copyUrlBtn">Copy</button>
                <a href="#" class="share-social-btn share-whatsapp-btn" id="whatsappShareBtn" target="_blank" rel="noopener noreferrer" aria-label="Share on WhatsApp">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" fill="currentColor"/>
                    </svg>
                </a>
                <a href="#" class="share-social-btn share-instagram-btn" id="instagramShareBtn" target="_blank" rel="noopener noreferrer" aria-label="Share on Instagram">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" fill="currentColor"/>
                    </svg>
                </a>
            </div>
            <div class="share-copy-message" id="copyMessage" style="display: none;">URL copied to clipboard!</div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
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
    overflow: hidden;
    transition: max-height 0.3s ease, opacity 0.3s ease;
    max-height: 5000px;
    opacity: 1;
}

.category-services-list.collapsed {
    max-height: 0;
    opacity: 0;
    margin-bottom: 0;
    padding: 0;
}

.category-chevron.rotated {
    transform: rotate(180deg);
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
    width: 67px;
    height: 67px;
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

.custom-service-list .service-name a{
    text-decoration:none;
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
    background-color: #E50050;
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
    background: #c0104e;
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

/* Share Popup Styles */
.share-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.share-popup-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
}

.share-popup-content {
    position: relative;
    background: white;
    border-radius: 16px;
    padding: 0;
    max-width: 500px;
    width: 90%;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    z-index: 10001;
    animation: sharePopupSlideIn 0.3s ease-out;
}

@keyframes sharePopupSlideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.share-popup-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid rgba(213, 190, 198, 0.3);
}

.share-popup-header h3 {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
    color: #333;
}

.share-popup-close {
    background: none;
    border: none;
    font-size: 28px;
    color: #666;
    cursor: pointer;
    padding: 0;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.2s ease;
}

.share-popup-close:hover {
    background: rgba(0, 0, 0, 0.05);
    color: #333;
}

.share-popup-body {
    padding: 24px;
}

.share-url-container {
    display: flex;
    gap: 10px;
    align-items: center;
}

.share-url-input {
    flex: 1;
    padding: 12px 16px;
    border: 1px solid rgba(213, 190, 198, 1);
    border-radius: 8px;
    font-size: 14px;
    color: #333;
    background: #f9f9f9;
    outline: none;
}

.share-url-input:focus {
    border-color: rgba(229, 0, 80, 1);
    background: white;
}

.share-copy-btn {
    padding: 12px 24px;
    background: rgba(229, 0, 80, 1);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.share-copy-btn:hover {
    background: #cc0046;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(229, 0, 80, 0.3);
}

.share-copy-btn:active {
    transform: translateY(0);
}

.share-copy-message {
    margin-top: 12px;
    padding: 8px 12px;
    background: #d4edda;
    color: #155724;
    border-radius: 6px;
    font-size: 14px;
    text-align: center;
    animation: fadeIn 0.3s ease;
}

.share-social-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    text-decoration: none;
    transition: all 0.2s ease;
    border: 1px solid transparent;
    flex-shrink: 0;
}

.share-social-btn svg {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
}

.share-whatsapp-btn {
    background: #25D366;
    color: white;
    border-color: #25D366;
}

.share-whatsapp-btn:hover {
    background: #20BA5A;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(37, 211, 102, 0.3);
}

.share-instagram-btn {
    background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
    color: white;
    border-color: transparent;
}

.share-instagram-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(188, 24, 136, 0.3);
    opacity: 0.9;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@media (max-width: 480px) {
    .share-popup-content {
        width: 95%;
        max-width: none;
    }
    
    .share-url-container {
        gap: 5px;
        /* flex-direction: column; */
    }
    .share-url-input{
        padding: 12px 2px;
    }
    .share-popup-body{
        padding: 16px;
    }
    
    .share-copy-btn {
        width: 100%;
    }
    
    .share-social-btn {
        width: 36px;
        height: 36px;
    }
    
    .share-social-btn svg {
        width: 18px;
        height: 18px;
    }
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

/* View Type Tabs Styling */
.view-type-tabs-container {
    margin: 30px 0;
}

.view-type-tabs {
    display: flex;
    gap: 0;
    border: none;
    background: transparent;
    width: fit-content;
}

.view-tab {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    text-decoration: none;
    color: #6b7280;
    font-weight: 500;
    font-size: 16px;
    transition: all 0.3s ease;
    position: relative;
    background: transparent;
    border: none;
}

.view-tab:hover {
    color: rgba(229, 0, 80, 1);
}

.view-tab.active {
    color: rgba(229, 0, 80, 1);
    background: transparent;
}

.view-tab.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: rgba(229, 0, 80, 1);
}

.view-tab svg {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
}

.view-tab span {
    white-space: nowrap;
}

@media (max-width: 640px) {
    .view-type-tabs {
        width: 100%;
        justify-content: flex-start;
    }
    
    .view-tab {
        padding: 10px 16px;
        font-size: 14px;
    }
    
    .view-tab svg {
        width: 18px;
        height: 18px;
    }
}

/* See All Photos Overlay */
.see-all-photos-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    cursor: pointer;
    z-index: 100;
    transition: all 0.3s ease;
    pointer-events: auto;
}

.see-all-photos-overlay:hover {
    background: rgba(0, 0, 0, 0.6);
}

.see-all-photos-overlay span {
    color: white;
    font-size: 16px;
    font-weight: 600;
    text-align: center;
    padding: 0 15px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.provider-image-small {
    position: relative;
}

@media (max-width: 767px) {
    .see-all-photos-overlay span {
        font-size: 14px;
        padding: 0 10px;
    }
}

</style>
@endsection

@section('scripts')
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fetch services for provider via API
    const providerId = '{{ $providerId ?? '' }}';
    const providerData = @json($provider ?? []);
    
    // Global variable to store gallery items for direct access
    let globalGalleryItems = [];
    
    // Initialize overlay on page load if salon_images exist
    const salonImages = (providerData.salon_images && Array.isArray(providerData.salon_images)) 
        ? providerData.salon_images 
        : [];
    const salonImagesCount = salonImages.length;
    const totalImagesForOverlay = 1 + salonImagesCount;
    const showOverlay = totalImagesForOverlay > 5;
    
    if (showOverlay && salonImagesCount > 0) {
        const overlay = document.getElementById('see-all-overlay');
        if (overlay) {
            overlay.style.display = 'flex';
            const span = overlay.querySelector('span');
            if (span) {
                span.textContent = `See all ${totalImagesForOverlay} photos`;
            }
        }
        
        // Initialize gallery and attach click handler on page load
        setTimeout(function() {
            initializeProviderGallery();
            attachOverlayClickHandler();
        }, 300);
    }
    
    if (providerId) {
        fetchProviderServices(providerId);
    }
    
    async function fetchProviderServices(providerId) {
        const loadingEl = document.getElementById('servicesLoading');
        const errorEl = document.getElementById('servicesError');
        const emptyEl = document.getElementById('servicesEmpty');
        const containerEl = document.getElementById('servicesContainer');
        
        // Show loading
        loadingEl.style.display = 'block';
        errorEl.style.display = 'none';
        emptyEl.style.display = 'none';
        containerEl.innerHTML = '';
        
        try {
            const apiUrl = `https://us-central1-beauty-984c8.cloudfunctions.net/getServicesOfProvider?provider_id=${encodeURIComponent(providerId)}`;
            const response = await fetch(apiUrl);
            
            if (!response.ok) {
                throw new Error('Failed to fetch services');
            }
            
            const services = await response.json();
            
            // Hide loading
            loadingEl.style.display = 'none';
            
            if (!Array.isArray(services) || services.length === 0) {
                emptyEl.style.display = 'block';
                return;
            }
            
            // Render services
            renderServices(services);
            
            // Update provider images with service images
            updateProviderImages(services);
            
        } catch (error) {
            console.error('Error fetching services:', error);
            loadingEl.style.display = 'none';
            errorEl.style.display = 'block';
        }
    }
    
    function renderServices(services) {
        // Group services by category
        const groupedServices = {};
        const categories = new Set();
        
        services.forEach(service => {
            const categoryName = service.category?.name || 'Uncategorized';
            categories.add(categoryName);
            
            if (!groupedServices[categoryName]) {
                groupedServices[categoryName] = [];
            }
            groupedServices[categoryName].push(service);
        });
        
        // Sort categories
        const sortedCategories = Array.from(categories).sort();
        
        // Render category filter pills
        renderCategoryFilters(sortedCategories);
        
        // Render services by category
        const containerEl = document.getElementById('servicesContainer');
        containerEl.innerHTML = '';
        
        sortedCategories.forEach(categoryName => {
            const categorySection = createCategorySection(categoryName, groupedServices[categoryName]);
            containerEl.appendChild(categorySection);
        });
        
        // Re-initialize category filtering and toggle functionality
        initializeCategoryFilters();
        initializeCategoryToggles();
    }
    
    function renderCategoryFilters(categories) {
        const filterContainer = document.querySelector('.service-filter-pills');
        if (!filterContainer) return;
        
        // Keep "All" button, remove others
        const allButton = filterContainer.querySelector('[data-category="all"]');
        filterContainer.innerHTML = '';
        if (allButton) {
            filterContainer.appendChild(allButton);
        }
        
        // Add category buttons
        categories.forEach(category => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'filter-pill';
            button.setAttribute('data-category', category);
            button.textContent = category;
            filterContainer.appendChild(button);
        });
    }
    
    function createCategorySection(categoryName, services) {
        const section = document.createElement('div');
        section.className = 'category-section';
        section.setAttribute('data-category', categoryName);
        
        const defaultImage = '{{ asset("/images/adam-winger-FkAZqQJTbXM-unsplash.jpg") }}';
        const providerId = '{{ $providerId ?? "" }}';
        
        section.innerHTML = `
            <div class="section-title category-toggle-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; margin-top: 20px; cursor: pointer;" data-category-toggle="${categoryName}">
                <h3 class="wow" style="font-size:30px; font-weight:500; letter-spacing: -1px; color:rgba(229, 0, 80, 1); margin: 0;">${categoryName}</h3>
                <i class="fas fa-chevron-up category-chevron" style="color: rgba(229, 0, 80, 1); font-size: 16px; transition: transform 0.3s ease; margin-left: 15px;"></i>
            </div>
            <div class="custom-service-list category-services-list">
                ${services.map(service => {
                    const serviceImage = (service.images && service.images.length > 0) ? service.images[0] : defaultImage;
                    const serviceName = service.service_name || 'Unnamed Service';
                    const serviceDetails = service.service_details || '';
                    const duration = service.duration_minutes || 0;
                    const price = service.service_price || 0;
                    const serviceId = service.id || '';
                    const bookUrl = `/book-appointment?serviceId=${serviceId}&service_provider_id=${providerId}`;
                    
                    return `
                        <div class="service-row services-d-flex services-justify-between services-flex-wrap">
                            <div class="service-info services-d-flex services-align-center">
                                <div class="service-image">
                                    <img src="${serviceImage}" 
                                         alt="${serviceName}" 
                                         class="services-img-fluid services-rounded-circle"
                                         loading="lazy"
                                         onerror="this.src='${defaultImage}'">
                                </div>
                                <div class="service-list-details" style="margin-left: 35px;">
                                    <div class="service-name services-fw-semibold">
                                        <a href="${bookUrl}">${truncateText(serviceName, 50)}</a>
                                    </div>
                                    ${serviceDetails ? `<div class="service-desc services-text-muted">${truncateText(serviceDetails, 50)}</div>` : ''}
                                </div>
                            </div>
                            <div class="service-meta services-text-end">
                                <div class="services-text-muted services-small services-mb-1">
                                    ${duration} min &bull; {{ __('app.service.from') }} €${price}
                                </div>
                                <div class="choose-button">
                                    <a href="${bookUrl}" class="choose-btn">{{ __('app.service.choose') }}</a>
                                </div>
                            </div>
                        </div>
                    `;
                }).join('')}
            </div>
        `;
        
        return section;
    }
    
    function truncateText(text, length) {
        if (text.length <= length) return text;
        return text.substring(0, length) + '...';
    }
    
    // Attach click handler to overlay
    function attachOverlayClickHandler() {
        const overlay = document.getElementById('see-all-overlay');
        if (!overlay) {
            console.log('Overlay not found for click handler');
            return;
        }
        
        // Check if gallery items are ready
        if (globalGalleryItems.length === 0) {
            console.log('Gallery items not ready, retrying...');
            setTimeout(function() {
                attachOverlayClickHandler();
            }, 100);
            return;
        }
        
        // Remove existing listeners by cloning
        const newOverlay = overlay.cloneNode(true);
        // Preserve the display style
        newOverlay.style.display = overlay.style.display;
        overlay.parentNode.replaceChild(newOverlay, overlay);
        
        // Attach click handler - use magnificPopup.open() directly
        newOverlay.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Overlay clicked, opening gallery with', globalGalleryItems.length, 'images');
            
            // Open gallery directly using magnificPopup API
            if (typeof jQuery !== 'undefined' && jQuery.magnificPopup) {
                jQuery.magnificPopup.open({
                    items: globalGalleryItems,
                    type: 'image',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0, 1]
                    },
                    image: {
                        verticalFit: true
                    },
                    mainClass: 'mfp-with-zoom mfp-img-mobile',
                    closeOnContentClick: false,
                    closeBtnInside: false
                });
            } else {
                console.error('MagnificPopup not available');
            }
        });
        
        // Also make it visually clear it's clickable
        newOverlay.style.cursor = 'pointer';
        console.log('Overlay click handler attached successfully');
    }
    
    // Initialize magnificPopup gallery for provider images
    function initializeProviderGallery() {
        const galleryData = document.querySelector('.gallery-data');
        if (!galleryData) return;
        
        const galleryImagesJson = galleryData.getAttribute('data-gallery-images');
        if (!galleryImagesJson) return;
        
        let galleryImages = [];
        try {
            galleryImages = JSON.parse(galleryImagesJson);
        } catch (e) {
            console.error('Error parsing gallery images:', e);
            return;
        }
        
        if (galleryImages.length === 0) return;
        
        // Check if jQuery and magnificPopup are available
        if (typeof jQuery === 'undefined' || typeof jQuery.fn.magnificPopup === 'undefined') {
            console.warn('magnificPopup library not loaded, retrying...');
            setTimeout(initializeProviderGallery, 200);
            return;
        }
        
        // Create gallery links dynamically
        const fourthImageContainer = document.getElementById('fourth-image-container');
        if (!fourthImageContainer) return;
        
        // Remove existing gallery link if any
        const existingLink = fourthImageContainer.querySelector('a.gallery-trigger');
        if (existingLink) {
            existingLink.remove();
        }
        
        // Create anchor element for gallery
        const galleryLink = document.createElement('a');
        galleryLink.href = galleryImages[0]; // First image
        galleryLink.className = 'gallery-trigger';
        galleryLink.style.display = 'none';
        fourthImageContainer.appendChild(galleryLink);
        
        // Filter and format gallery images for magnificPopup (needs objects with src property)
        const galleryItems = galleryImages
            .filter(function(img) {
                return img && typeof img === 'string' && img.trim() !== '' && (img.startsWith('http') || img.startsWith('//'));
            })
            .map(function(img) {
                return {
                    src: img.trim(),
                    type: 'image'
                };
            });
        
        if (galleryItems.length === 0) {
            console.error('No valid gallery images found. Gallery images:', galleryImages);
            return;
        }
        
        // Ensure the link href matches the first gallery item
        galleryLink.href = galleryItems[0].src;
        
        console.log('Initializing gallery with', galleryItems.length, 'images');
        
        // Store gallery items globally for direct access
        globalGalleryItems = galleryItems;
        
        // Initialize magnificPopup with items array
        jQuery(galleryLink).magnificPopup({
            items: galleryItems,
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function(item) {
                    return '';
                }
            },
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1]
            },
            zoom: {
                enabled: true,
                duration: 300,
            },
            callbacks: {
                imageLoadComplete: function() {
                    var self = this;
                    setTimeout(function() {
                        self.wrap.addClass('mfp-image-loaded');
                    }, 16);
                },
                error: function(msg, item) {
                    console.error('MagnificPopup error:', msg, item);
                }
            }
        });
        
        // Make overlay clickable - attach click handler after gallery is initialized
        setTimeout(function() {
            attachOverlayClickHandler();
        }, 50);
    }
    
    function updateProviderImages(services) {
        // Collect service images for provider gallery
        const providerImages = [];
        const defaultImage = '{{ asset("/images/adam-winger-FkAZqQJTbXM-unsplash.jpg") }}';
        const providerProfileImg = providerData.profileImg || defaultImage;
        
        // First image is provider profile
        providerImages.push(providerProfileImg);
        
        // Get salon_images from provider data
        const salonImages = (providerData.salon_images && Array.isArray(providerData.salon_images)) 
            ? providerData.salon_images.filter(img => img && img.trim() !== '') // Filter out empty images
            : [];
        const salonImagesCount = salonImages.length;
        
        // Add salon_images to the array (up to 4 images) before service images
        // We need exactly 4 small images, so take first 4 salon images
        const salonImagesToUse = salonImages.slice(0, 4); // Take first 4 salon images
        salonImagesToUse.forEach((salonImage) => {
            if (salonImage) {
                providerImages.push(salonImage);
            }
        });
        
        // Only collect images from services if we have fewer than 4 salon images
        const salonImagesAdded = salonImagesToUse.length;
        if (salonImagesAdded < 4) {
            const remainingSlots = 4 - salonImagesAdded;
            services.forEach(service => {
                if (service.images && Array.isArray(service.images) && providerImages.length < 5) {
                    service.images.forEach(img => {
                        if (img && providerImages.length < 5) {
                            providerImages.push(img);
                        }
                    });
                }
            });
        }
        
        // Fill remaining slots with default image
        while (providerImages.length < 5) {
            providerImages.push(defaultImage);
        }
        
        // Calculate total images for overlay (provider profile + all salon_images)
        const totalImagesForOverlay = 1 + salonImagesCount;
        const showOverlay = totalImagesForOverlay > 5;
        
        // Update desktop grid images
        const mainImage = document.querySelector('.provider-image-main img');
        if (mainImage) mainImage.src = providerImages[0];
        
        const smallImages = document.querySelectorAll('.provider-image-small img');
        smallImages.forEach((img, index) => {
            if (providerImages[index + 1]) {
                img.src = providerImages[index + 1];
            }
        });
        
        // Update overlay visibility and text
        const overlay = document.getElementById('see-all-overlay');
        const fourthImageContainer = document.getElementById('fourth-image-container');
        
        if (showOverlay && salonImagesCount > 0) {
            // Create overlay if it doesn't exist
            let overlayElement = overlay;
            if (!overlayElement && fourthImageContainer) {
                overlayElement = document.createElement('div');
                overlayElement.id = 'see-all-overlay';
                overlayElement.className = 'see-all-photos-overlay';
                const span = document.createElement('span');
                overlayElement.appendChild(span);
                fourthImageContainer.appendChild(overlayElement);
            }
            
            if (overlayElement) {
                overlayElement.style.display = 'flex';
                const span = overlayElement.querySelector('span');
                if (span) {
                    span.textContent = `See all ${totalImagesForOverlay} photos`;
                }
            }
            
            // Update or create gallery data
            let galleryData = document.querySelector('.gallery-data');
            if (!galleryData && fourthImageContainer) {
                galleryData = document.createElement('div');
                galleryData.className = 'gallery-data';
                galleryData.style.display = 'none';
                fourthImageContainer.appendChild(galleryData);
            }
            
            if (galleryData) {
                const galleryImages = [providerProfileImg, ...salonImages];
                galleryData.setAttribute('data-gallery-images', JSON.stringify(galleryImages));
            }
            
            // Initialize gallery and attach click handler after overlay is created/updated
            setTimeout(function() {
                initializeProviderGallery();
                attachOverlayClickHandler();
            }, 100);
        } else if (overlay) {
            overlay.style.display = 'none';
        }
        
        // Update mobile carousel images
        const carouselSlides = document.querySelectorAll('.carousel-slide img');
        carouselSlides.forEach((img, index) => {
            if (providerImages[index]) {
                img.src = providerImages[index];
            }
        });
    }
    
    function initializeCategoryFilters() {
        const filterPills = document.querySelectorAll('.filter-pill');
        const categorySections = document.querySelectorAll('.category-section');
        
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
                
                // Filter category sections
                categorySections.forEach(function(section) {
                    if (selectedCategory === 'all') {
                        section.style.display = '';
                    } else {
                        const sectionCategory = section.getAttribute('data-category');
                        if (sectionCategory === selectedCategory) {
                            section.style.display = '';
                        } else {
                            section.style.display = 'none';
                        }
                    }
                });
            });
        });
    }
    
    function initializeCategoryToggles() {
        const categoryToggleHeaders = document.querySelectorAll('.category-toggle-header');
        
        categoryToggleHeaders.forEach(function(toggleHeader) {
            // Remove existing listeners by cloning
            const newToggle = toggleHeader.cloneNode(true);
            toggleHeader.parentNode.replaceChild(newToggle, toggleHeader);
            
            newToggle.addEventListener('click', function() {
                const categorySection = this.closest('.category-section');
                const servicesList = categorySection.querySelector('.category-services-list');
                const chevron = this.querySelector('.category-chevron');
                
                if (servicesList && chevron) {
                    servicesList.classList.toggle('collapsed');
                    chevron.classList.toggle('rotated');
                }
            });
        });
    }
    
    // Carousel functionality (only run if carousel exists)
    const carousel = document.querySelector('.provider-images-carousel');
    
    if (carousel) {
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
    }
    
    // Desktop heart button toggle (works independently of carousel)
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
    
    // Category filtering functionality
    const filterPills = document.querySelectorAll('.filter-pill');
    const categorySections = document.querySelectorAll('.category-section');
    
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
            
            // Filter category sections
            categorySections.forEach(function(section) {
                if (selectedCategory === 'all') {
                    section.style.display = '';
                } else {
                    const sectionCategory = section.getAttribute('data-category');
                    if (sectionCategory === selectedCategory) {
                        section.style.display = '';
                    } else {
                        section.style.display = 'none';
                    }
                }
            });
        });
    });
    
    // Category expand/collapse functionality
    const categoryToggleHeaders = document.querySelectorAll('.category-toggle-header');
    
    categoryToggleHeaders.forEach(function(toggleHeader) {
        toggleHeader.addEventListener('click', function() {
            const categorySection = this.closest('.category-section');
            const servicesList = categorySection.querySelector('.category-services-list');
            const chevron = this.querySelector('.category-chevron');
            
            if (servicesList && chevron) {
                servicesList.classList.toggle('collapsed');
                chevron.classList.toggle('rotated');
            }
        });
    });
    
    // Share popup functionality
    const sharePopup = document.getElementById('sharePopup');
    const shareButtons = document.querySelectorAll('.share-btn');
    const sharePopupClose = document.querySelector('.share-popup-close');
    const sharePopupOverlay = document.querySelector('.share-popup-overlay');
    const copyUrlBtn = document.getElementById('copyUrlBtn');
    const shareUrlInput = document.getElementById('shareUrlInput');
    const copyMessage = document.getElementById('copyMessage');
    const whatsappShareBtn = document.getElementById('whatsappShareBtn');
    const instagramShareBtn = document.getElementById('instagramShareBtn');
    
    // Function to show popup
    function showSharePopup() {
        if (sharePopup) {
            sharePopup.style.display = 'flex';
            // Update URL in case it changed
            if (shareUrlInput) {
                shareUrlInput.value = window.location.href;
            }
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        }
    }
    
    // Function to hide popup
    function hideSharePopup() {
        if (sharePopup) {
            sharePopup.style.display = 'none';
            // Restore body scroll
            document.body.style.overflow = '';
            // Hide copy message if visible
            if (copyMessage) {
                copyMessage.style.display = 'none';
            }
        }
    }
    
    // Add click handlers to all share buttons
    shareButtons.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            showSharePopup();
        });
    });
    
    // Close button handler
    if (sharePopupClose) {
        sharePopupClose.addEventListener('click', hideSharePopup);
    }
    
    // Overlay click handler
    if (sharePopupOverlay) {
        sharePopupOverlay.addEventListener('click', hideSharePopup);
    }
    
    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && sharePopup && sharePopup.style.display === 'flex') {
            hideSharePopup();
        }
    });
    
    // Copy URL functionality
    if (copyUrlBtn && shareUrlInput) {
        copyUrlBtn.addEventListener('click', function() {
            shareUrlInput.select();
            shareUrlInput.setSelectionRange(0, 99999); // For mobile devices
            
            try {
                // Use modern Clipboard API if available
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(shareUrlInput.value).then(function() {
                        showCopyMessage();
                    }).catch(function() {
                        // Fallback to execCommand
                        fallbackCopy();
                    });
                } else {
                    // Fallback for older browsers
                    fallbackCopy();
                }
            } catch (err) {
                fallbackCopy();
            }
        });
    }
    
    function fallbackCopy() {
        try {
            document.execCommand('copy');
            showCopyMessage();
        } catch (err) {
            console.error('Failed to copy URL:', err);
            alert('Failed to copy URL. Please copy it manually.');
        }
    }
    
    function showCopyMessage() {
        if (copyMessage) {
            copyMessage.style.display = 'block';
            setTimeout(function() {
                copyMessage.style.display = 'none';
            }, 2000);
        }
    }
    
    // WhatsApp share functionality
    if (whatsappShareBtn && shareUrlInput) {
        whatsappShareBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const url = encodeURIComponent(shareUrlInput.value);
            const text = encodeURIComponent('Check out this page: ');
            const whatsappUrl = 'https://wa.me/?text=' + text + url;
            window.open(whatsappUrl, '_blank');
        });
    }
    
    // Instagram share functionality
    if (instagramShareBtn && shareUrlInput) {
        instagramShareBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const url = shareUrlInput.value;
            
            // Check if mobile device
            const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
            
            if (isMobile) {
                // Try Instagram app URL scheme first, fallback to web
                const instagramAppUrl = 'instagram://share?url=' + encodeURIComponent(url);
                const instagramWebUrl = 'https://www.instagram.com/';
                
                // Try to open Instagram app, fallback to web after timeout
                const startTime = Date.now();
                window.location.href = instagramAppUrl;
                
                setTimeout(function() {
                    // If still on page after 500ms, Instagram app didn't open, use web
                    if (Date.now() - startTime < 600) {
                        // Copy URL to clipboard and show message since Instagram doesn't support direct URL sharing
                        shareUrlInput.select();
                        shareUrlInput.setSelectionRange(0, 99999);
                        
                        if (navigator.clipboard && navigator.clipboard.writeText) {
                            navigator.clipboard.writeText(url).then(function() {
                                showCopyMessage();
                                // Optionally open Instagram web
                                window.open(instagramWebUrl, '_blank');
                            });
                        } else {
                            try {
                                document.execCommand('copy');
                                showCopyMessage();
                                window.open(instagramWebUrl, '_blank');
                            } catch (err) {
                                alert('Please copy the URL manually and share it on Instagram.');
                            }
                        }
                    }
                }, 500);
            } else {
                // Desktop: Copy URL and open Instagram web
                shareUrlInput.select();
                shareUrlInput.setSelectionRange(0, 99999);
                
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(url).then(function() {
                        showCopyMessage();
                        window.open('https://www.instagram.com/', '_blank');
                    });
                } else {
                    try {
                        document.execCommand('copy');
                        showCopyMessage();
                        window.open('https://www.instagram.com/', '_blank');
                    } catch (err) {
                        alert('Please copy the URL manually and share it on Instagram.');
                    }
                }
            }
        });
    }
    
    // Initialize gallery after images are updated
    if (providerId) {
        // Wait a bit for updateProviderImages to complete
        setTimeout(function() {
            initializeProviderGallery();
        }, 500);
    } else {
        // Initialize immediately if no services to fetch
        initializeProviderGallery();
    }
});
</script>
@endsection
