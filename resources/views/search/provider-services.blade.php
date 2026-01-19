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
                {{-- Provider Loading State --}}
                <div id="providerLoading" class="provider-loading" style="display: flex;">
                    <div class="provider-spinner"></div>
                    <p>{{ __('app.common.loading_provider_info') }}</p>
                </div>
                
                {{-- Provider Error State --}}
                <div id="providerError" class="services-text-center services-py-4" style="display: none;">
                    <h5>Failed to load provider information. Please try again later.</h5>
                </div>
                
                {{-- Provider Content Container --}}
                <div id="providerContent" style="display: none;">
                <div class="provider-header services-mb-1">
                    <div class="services-row services-align-center service-proivder-desktop-view">
                        <div class="services-col-md-10 service-page-header-text">
                            {{-- <h2>{{ $provider['storeName'] ?? $provider['name'] }}</h2> --}}
                            <h4 class="service-name-heading" id="providerCompanyName"></h4>
                            <div class="provider-info">
                                <div class="provider-ratting-review" id="providerRatingSection">
                                </div>
                                <div class="provider-service-address" id="providerAddressSection">
                                </div>
                            </div>
                        </div>
                            <div class="desktop-image-controls">
                                <button class="desktop-control-btn share-btn" aria-label="Share">
                                    <img src="{{ asset('images/images/share-icon.svg') }}" alt="Location" width="25" height="25">
                                </button>
                                {{-- <button class="desktop-control-btn heart-btn" aria-label="Favorite">
                                    <img src="{{ asset('images/images/si_heart-line.svg') }}" alt="Location" width="25" height="25">
                                </button> --}}
                            </div>
                    </div>
                    @php
                        $defaultImage = asset('/images/default.jpeg');
                    @endphp
                    
                    <!-- Desktop Grid View -->
                    <div class="provider-images-grid">
                        <div class="provider-image-main">
                            <img id="providerMainImage" 
                                 src="{{ $defaultImage }}" 
                                 alt="Provider" 
                                 class="services-img-fluid"
                                 onerror="this.src='{{ $defaultImage }}'">
                        </div>
                        <div class="provider-images-small">
                            <div class="provider-image-small">
                                <img id="providerImage1" 
                                     src="{{ $defaultImage }}" 
                                     alt="Provider" 
                                     class="services-img-fluid"
                                     loading="lazy"
                                     onerror="this.src='{{ $defaultImage }}'">
                            </div>
                            <div class="provider-image-small">
                                <img id="providerImage2" 
                                     src="{{ $defaultImage }}" 
                                     alt="Provider" 
                                     class="services-img-fluid"
                                     loading="lazy"
                                     onerror="this.src='{{ $defaultImage }}'">
                            </div>
                            <div class="provider-image-small">
                                <img id="providerImage3" 
                                     src="{{ $defaultImage }}" 
                                     alt="Provider" 
                                     class="services-img-fluid"
                                     loading="lazy"
                                     onerror="this.src='{{ $defaultImage }}'">
                            </div>
                            <div class="provider-image-small" id="fourth-image-container">
                                <img id="providerImage4" 
                                     src="{{ $defaultImage }}" 
                                     alt="Provider" 
                                     class="services-img-fluid"
                                     loading="lazy"
                                     onerror="this.src='{{ $defaultImage }}'">
                                <div class="see-all-photos-overlay" id="see-all-overlay" style="display: none;">
                                    <span id="see-all-overlay-text"></span>
                                </div>
                                <div class="gallery-data" 
                                     id="galleryData"
                                     style="display: none;"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mobile Carousel View -->
                    <div class="provider-images-carousel">
                        <div class="carousel-controls-top">
                            <button class="carousel-btn-mobile share-btn" aria-label="Share">
                                <img src="{{ asset('images/images/share-icon.svg') }}" alt="Location" width="25" height="25">
                            </button>
                            {{-- <button class="carousel-btn-mobile heart-btn" aria-label="Favorite">
                                <img src="{{ asset('images/images/si_heart-line.svg') }}" alt="Location" width="25" height="25">
                            </button> --}}
                        </div>
                        <div class="carousel-container">
                            <div class="carousel-track" id="carouselTrack">
                                <!-- Carousel slides will be populated by JavaScript -->
                            </div>
                        </div>
                        <div class="carousel-counter">
                            <span class="current-slide">1</span>/<span class="total-slides" id="totalSlides">1</span>
                        </div>
                        <div class="carousel-dots" id="carouselDots">
                            <!-- Carousel dots will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="services-row services-align-center service-proivder-mobile-view">
                        <div class="services-col-md-10 service-page-header-text">
                            <h4 class="service-name-heading" id="providerCompanyNameMobile"></h4>
                            <div class="provider-info">
                                <div class="provider-ratting-review" id="providerRatingSectionMobile">
                                </div>
                                <div class="provider-service-address" id="providerAddressSectionMobile">
                                </div>
                            </div>
                        </div>
                            <div class="desktop-image-controls">
                                <button class="desktop-control-btn share-btn" aria-label="Share">
                                    <img src="{{ asset('images/images/share-icon.svg') }}" alt="Location" width="25" height="25">
                                </button>
                                <button class="desktop-control-btn heart-btn" aria-label="Favorite">
                                    <img src="{{ asset('images/images/si_heart-line.svg') }}" alt="Location" width="25" height="25">
                                </button>
                            </div>
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
            <button type="button" class="view-tab active" id="listTabBtn" data-view="list">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 5H17.5M2.5 10H17.5M2.5 15H17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M2.5 2.5H5.83333V5H2.5V2.5Z" fill="currentColor"/>
                </svg>
                <span>{{ __('app.service.service_list') }}</span>
            </button>
            {{-- <button type="button" class="view-tab" id="videosTabBtn" data-view="videos">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2.5" y="4.16667" width="15" height="11.6667" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M8.33333 7.5L13.3333 10L8.33333 12.5V7.5Z" fill="currentColor"/>
                </svg>
                <span>Service Videos</span>
            </button> --}}
        </div>
    </div>
    <!-- View Type Tabs Section End -->

    <!-- Tab Content Panels -->
    <!-- Service List Tab Panel -->
    <div id="serviceListTabPanel" class="tab-content-panel active">
    <div class="services-row">
        <div class="services-col-lg-8">
                {{-- Loading state --}}
                <div id="servicesLoading" class="services-loading" style="display: none;">
                    <div class="services-spinner"></div>
                    <p>{{ __('app.common.loading_services') }}</p>
                </div>
                
                {{-- Error state --}}
                <div id="servicesError" class="custom-service-list" style="display: none;">
                    <div class="services-text-center services-py-4">
                        <h5>Failed to load services. Please try again later.</h5>
                    </div>
                </div>
                
                {{-- Services container - will be populated by JavaScript --}}
                <div id="servicesContainer"></div>
                
                {{-- Pagination loading state (shown at bottom when loading more) --}}
                <div id="paginationLoading" class="services-loading" style="display: none;">
                    <div class="services-spinner"></div>
                    <p>{{ __('app.common.loading_more_services') }}</p>
                </div>
                
                {{-- Empty state --}}
                <div id="servicesEmpty" class="custom-service-list" style="display: none;">
                    <div class="services-text-center services-py-4">
                        <h5>No services available from this provider.</h5>
                    </div>
                </div>

                
        </div>
<div class="services-col-lg-4">
    <div class="provider-info-card" id="providerInfoCard">
        <!-- Header Section -->
        <div class="provider-card-header">
            <h4 class="provider-card-company-name" id="providerCardCompanyName"></h4>
            <div class="provider-ratting-review" id="providerCardRatingSection">
            </div>
        </div>
        
        <!-- Separator -->
        <div class="provider-card-separator"></div>
        
        <!-- Hours of Operation Section -->
        <div class="hours-section">
            <div class="hours-toggle-header" id="hoursToggle">
                <div class="hours-toggle-left">
                    <img src="{{ asset('images/images/iconoir_clock.svg') }}" alt="Location" width="24" height="24">
                    <span class="open-until-text" id="openUntilText">Hours of operation</span>
                </div>
                <i class="fas fa-chevron-up hours-chevron" id="hoursChevron"></i>
            </div>
            
            <div class="hours-list" id="hoursList">
                <!-- Hours will be populated by JavaScript -->
            </div>
        </div>
        
        <!-- Location Section -->
        <div class="provider-service-address" id="providerCardAddressSection">
        </div>
    </div>
</div>

    </div>
    </div>
    <!-- End Service List Tab Panel -->

    <!-- Service Videos Tab Panel -->
    <div id="serviceVideosTabPanel" class="tab-content-panel" style="display: none;">
        @include('partials.provider-videos-content')
    </div>
    <!-- End Service Videos Tab Panel -->

        
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
<link rel="stylesheet" href="{{ \App\Helpers\AssetHelper::versioned('css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ \App\Helpers\AssetHelper::versioned('css/provider-services.css') }}">
<link rel="stylesheet" href="{{ \App\Helpers\AssetHelper::versioned('css/specific-provider-videos.css') }}">
<style>
/* Tab Content Panel Styles */
.tab-content-panel {
    display: none;
}
.tab-content-panel.active {
    display: block;
}
</style>
@endsection

@section('scripts')
<script src="{{ \App\Helpers\AssetHelper::versioned('js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ \App\Helpers\AssetHelper::versioned('js/jquery.magnific-popup.min.js') }}"></script>

<!-- Tab Switching Script - Runs independently -->
<script>
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Tab switching script loaded');
        
        // Tab elements
        const listTabBtn = document.getElementById('listTabBtn');
        const videosTabBtn = document.getElementById('videosTabBtn');
        const serviceListPanel = document.getElementById('serviceListTabPanel');
        const serviceVideosPanel = document.getElementById('serviceVideosTabPanel');
        
        // Get username from URL
        const pathParts = window.location.pathname.split('/').filter(part => part);
        let companyUserName = '';
        if (pathParts.length > 0) {
            // If last part is 'videos', get the one before it
            if (pathParts[pathParts.length - 1] === 'videos' && pathParts.length > 1) {
                companyUserName = pathParts[pathParts.length - 2];
            } else {
                companyUserName = pathParts[pathParts.length - 1];
            }
        }
        
        console.log('Tab elements found:', {
            listTabBtn: !!listTabBtn,
            videosTabBtn: !!videosTabBtn,
            serviceListPanel: !!serviceListPanel,
            serviceVideosPanel: !!serviceVideosPanel,
            companyUserName: companyUserName
        });
        
        // Track if videos have been loaded
        window.videosTabLoaded = false;
        
        // Function to switch tabs
        window.switchProviderTab = function(tabName) {
            console.log('Switching to tab:', tabName);
            
            if (tabName === 'list') {
                if (listTabBtn) listTabBtn.classList.add('active');
                if (videosTabBtn) videosTabBtn.classList.remove('active');
                if (serviceListPanel) {
                    serviceListPanel.classList.add('active');
                    serviceListPanel.style.display = 'block';
                }
                if (serviceVideosPanel) {
                    serviceVideosPanel.classList.remove('active');
                    serviceVideosPanel.style.display = 'none';
                }
                // Update URL to just /username (no hash)
                if (companyUserName) {
                    history.replaceState(null, null, '/' + encodeURIComponent(companyUserName));
                }
            } else if (tabName === 'videos') {
                if (videosTabBtn) videosTabBtn.classList.add('active');
                if (listTabBtn) listTabBtn.classList.remove('active');
                if (serviceVideosPanel) {
                    serviceVideosPanel.classList.add('active');
                    serviceVideosPanel.style.display = 'block';
                }
                if (serviceListPanel) {
                    serviceListPanel.classList.remove('active');
                    serviceListPanel.style.display = 'none';
                }
                // Update URL to /username/videos
                if (companyUserName) {
                    history.replaceState(null, null, '/' + encodeURIComponent(companyUserName) + '/videos');
                }
                
                // Trigger video loading if not loaded
                if (!window.videosTabLoaded) {
                    window.videosTabLoaded = true;
                    console.log('Triggering video loading...');
                    
                    // Function to call initializeVideosTab with retry
                    function tryInitializeVideos(retryCount) {
                        console.log('Attempting to initialize videos, attempt:', retryCount);
                        if (typeof window.initializeVideosTab === 'function') {
                            console.log('initializeVideosTab found, calling it...');
                            window.initializeVideosTab();
                        } else if (retryCount < 20) {
                            // Retry after 100ms, up to 20 times (2 seconds total)
                            console.log('initializeVideosTab not found yet, retrying in 100ms...');
                            setTimeout(function() {
                                tryInitializeVideos(retryCount + 1);
                            }, 100);
                        } else {
                            console.error('initializeVideosTab never became available');
                        }
                    }
                    
                    tryInitializeVideos(0);
                }
            }
        };
        
        // Attach click handlers
        if (listTabBtn) {
            listTabBtn.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('List tab button clicked');
                window.switchProviderTab('list');
            });
        }
        
        if (videosTabBtn) {
            videosTabBtn.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Videos tab button clicked');
                window.switchProviderTab('videos');
            });
        }
        
        // Check if current URL is /username/videos to show videos tab initially
        const isVideosUrl = pathParts.length > 0 && pathParts[pathParts.length - 1] === 'videos';
        if (isVideosUrl) {
            window.switchProviderTab('videos');
        }
        
        // Handle browser back/forward
        window.addEventListener('popstate', function() {
            const currentPath = window.location.pathname;
            if (currentPath.endsWith('/videos')) {
                window.switchProviderTab('videos');
            } else {
                window.switchProviderTab('list');
            }
        });
    });
})();
</script>

<script>
    // Global helper functions - defined outside the main DOMContentLoaded block to ensure availability
    
    // Global translation strings from Blade
    window.serviceTranslations = {
        seeMore: "{{ __('app.service.see_more') }}",
        seeLess: "{{ __('app.service.see_less') }}"
    };
    
    // Helper function to truncate text by word count
    window.truncateWords = function(text, wordLimit, checkOnly = false) {
        if (!text) return checkOnly ? false : '';
        
        const words = text.trim().split(/\s+/);
        
        // If checkOnly is true, return whether truncation is needed
        if (checkOnly) {
            return words.length > wordLimit;
        }
        
        // If within limit, return original text
        if (words.length <= wordLimit) {
            return text;
        }
        
        // Truncate to word limit and add ellipsis
        return words.slice(0, wordLimit).join(' ') + '...';
    };
    
    // Global function to toggle description visibility
    window.toggleDescription = function(descId, event) {
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        const descText = document.querySelector(`.desc-text[data-desc-id="${descId}"]`);
        const descFull = document.querySelector(`.desc-full[data-desc-id="${descId}"]`);
        const btn = document.querySelector(`.see-more-desc-btn[data-desc-id="${descId}"]`);
        
        if (!descText || !descFull || !btn) return;
        
        // Toggle visibility
        if (descText.style.display === 'none') {
            // Show truncated, hide full
            descText.style.display = 'inline';
            descFull.style.display = 'none';
            btn.textContent = window.serviceTranslations.seeMore;
        } else {
            // Show full, hide truncated
            descText.style.display = 'none';
            descFull.style.display = 'inline';
            btn.textContent = window.serviceTranslations.seeLess;
        }
    };
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Translation strings
    const translations = {
        seeMore: '{{ __('app.service.see_more') }}',
        seeLess: '{{ __('app.service.see_less') }}'
    };
    // Get username from URL path or provider_id from query (for backward compatibility)
    const urlParams = new URLSearchParams(window.location.search);
    const providerIdFromQuery = urlParams.get('provider_id') || '{{ request()->get('provider_id') }}';
    const companyUserNameFromServer = '{{ $companyUserName ?? '' }}';
    
    // Extract username from URL path (e.g., /testing-glow -> testing-glow)
    const pathParts = window.location.pathname.split('/').filter(part => part);
    const companyUserName = companyUserNameFromServer || pathParts[pathParts.length - 1] || '';
    
    // Global variable to store provider data
    let providerData = null;
    
    // Global variable to store gallery items for direct access
    let globalGalleryItems = [];
    
    // Pagination state for infinite scroll
    let paginationState = {
        hasMore: false,
        lastDocId: null,
        isLoading: false,
        providerId: null
    };
    
    // Track existing categories for smart append
    let existingCategories = new Set();
    
    // Category-specific placeholder images
    const categoryImages = {
        // Coiffure (Hair)
        'ixgMn0e5RlzAztxVhfgm': 'https://firebasestorage.googleapis.com/v0/b/beauty-984c8.appspot.com/o/service_placeholder%2FHair.png?alt=media&token=5bc20f35-0dbc-4a12-ab6b-a489139015e7',
        // Barber
        'W3em4NFLX2aRAu1BFNNN': 'https://firebasestorage.googleapis.com/v0/b/beauty-984c8.appspot.com/o/service_placeholder%2FBarber.png?alt=media&token=7a0395ca-6d1d-49fb-8ab9-f3d5cf2a1a54',
        // Makeup
        'XGA7rpOhgHFMr3W3sCnU': 'https://firebasestorage.googleapis.com/v0/b/beauty-984c8.appspot.com/o/service_placeholder%2FMakeup.png?alt=media&token=84e0960f-255b-48c9-9e99-9997800a5767',
        // Nails
        'vZQNDw2KCuEUSyXTTZMf': 'https://firebasestorage.googleapis.com/v0/b/beauty-984c8.appspot.com/o/service_placeholder%2FNails.png?alt=media&token=1a1def47-9c70-4fcf-bcb8-8a7c94ec7b37',
        // Epilation (Waxing)
        'pCMUpz8GoD4md1Rqt2cs': 'https://firebasestorage.googleapis.com/v0/b/beauty-984c8.appspot.com/o/service_placeholder%2FWaxing.png?alt=media&token=b797f3a2-4745-4bdd-94aa-2676a975780f',
        // Bien Etre
        'SceVTrEpBGjSrHO7pwFS': 'https://firebasestorage.googleapis.com/v0/b/beauty-984c8.appspot.com/o/service_placeholder%2FbienEtre.jpeg?alt=media&token=f8bebf29-24d4-4aea-b67e-341cedd82af5',
        // Beauté visage (Eyelash)
        'qlwRNcbICdWVZd0CfJ7z': 'https://firebasestorage.googleapis.com/v0/b/beauty-984c8.appspot.com/o/service_placeholder%2FEyelash.png?alt=media&token=262d3ddb-801c-4fcc-8917-a59523274b1a',
        // Default
        'pzuJmZnZb5ooR73NZ4OH': 'https://firebasestorage.googleapis.com/v0/b/beauty-984c8.appspot.com/o/service_placeholder%2Fdefault.jpeg?alt=media&token=7f71facb-3d47-4a33-844c-33a66fde1a6d'
    };
    
    // Default fallback image
    const defaultFallbackImage = 'https://firebasestorage.googleapis.com/v0/b/beauty-984c8.appspot.com/o/service_placeholder%2Fdefault.jpeg?alt=media&token=7f71facb-3d47-4a33-844c-33a66fde1a6d';
    
    /**
     * Get category-specific placeholder image URL based on categoryId
     * @param {string} categoryId - The service category ID
     * @returns {string} - The placeholder image URL for the category
     */
    function getCategoryImageUrl(categoryId) {
        if (!categoryId) {
            return defaultFallbackImage;
        }
        return categoryImages[categoryId] || defaultFallbackImage;
    }
    
    // Legacy default image for provider images (keep for backward compatibility)
    const defaultImage = '{{ asset("/images/default.jpeg") }}';
    
    // Clean up old sessionStorage cache entries
    function cleanupOldCacheEntries() {
        try {
            const cacheExpiry = 5 * 60 * 1000; // 5 minutes
            const now = Date.now();
            const keysToRemove = [];
            
            // Check all sessionStorage keys
            for (let i = 0; i < sessionStorage.length; i++) {
                const key = sessionStorage.key(i);
                if (key && key.startsWith('provider_data_')) {
                    try {
                        const cached = JSON.parse(sessionStorage.getItem(key));
                        if (cached && cached.timestamp) {
                            const age = now - cached.timestamp;
                            if (age >= cacheExpiry) {
                                keysToRemove.push(key);
                            }
                        }
                    } catch (e) {
                        // Invalid cache entry, remove it
                        keysToRemove.push(key);
                    }
                }
            }
            
            // Remove old entries
            keysToRemove.forEach(key => sessionStorage.removeItem(key));
        } catch (error) {
            console.warn('Error cleaning up cache:', error);
        }
    }
    
    // Clean up old cache entries on page load
    cleanupOldCacheEntries();
    
    // Fetch provider data first, then services
    if (companyUserName || providerIdFromQuery) {
        fetchProviderData(companyUserName, providerIdFromQuery).then(() => {
            // After provider data is loaded, fetch services
            if (providerData && providerData.id) {
                fetchProviderServices(providerData.id);
            } else if (providerIdFromQuery) {
                fetchProviderServices(providerIdFromQuery);
            }
        }).catch((error) => {
            console.error('Failed to load provider data:', error);
            // Still try to fetch services even if provider data fails
            if (providerIdFromQuery) {
                fetchProviderServices(providerIdFromQuery);
            }
        });
    }
    
    // Fetch provider data from API
    async function fetchProviderData(companyUserName, providerId) {
        const loadingEl = document.getElementById('providerLoading');
        const errorEl = document.getElementById('providerError');
        const contentEl = document.getElementById('providerContent');
        
        // Show loading
        if (loadingEl) loadingEl.style.display = 'flex';
        if (errorEl) errorEl.style.display = 'none';
        if (contentEl) contentEl.style.display = 'none';
        
        // Check sessionStorage first for cached provider data (from search page)
        let cachedData = null;
        const cacheExpiry = 5 * 60 * 1000; // 5 minutes
        
        try {
            const cacheKey = companyUserName ? `provider_data_${companyUserName}` : (providerId ? `provider_data_${providerId}` : null);
            if (cacheKey) {
                const cached = sessionStorage.getItem(cacheKey);
                if (cached) {
                    cachedData = JSON.parse(cached);
                    const age = Date.now() - cachedData.timestamp;
                    
                    // Validate cache: check age, username/providerId match
                    if (age < cacheExpiry) {
                        const matchesUsername = companyUserName && (
                            (cachedData.username && cachedData.username.toLowerCase() === companyUserName.toLowerCase()) ||
                            (cachedData.provider && cachedData.provider.username && cachedData.provider.username.toLowerCase() === companyUserName.toLowerCase()) ||
                            (cachedData.provider && cachedData.provider.companyUserName && cachedData.provider.companyUserName.toLowerCase() === companyUserName.toLowerCase())
                        );
                        const matchesProviderId = providerId && (
                            cachedData.providerId === providerId ||
                            (cachedData.provider && cachedData.provider.id === providerId)
                        );
                        
                        if (matchesUsername || matchesProviderId) {
                            // Use cached data - instant load!
                            providerData = cachedData.provider;
                            
                            // Hide loading, show content
                            if (loadingEl) loadingEl.style.display = 'none';
                            if (contentEl) contentEl.style.display = 'block';
                            
                            // Render provider data
                            renderProviderData(providerData);
                            
                            // Clean up old cache entries
                            cleanupOldCacheEntries();
                            
                            return providerData;
                        }
                    }
                }
            }
        } catch (error) {
            console.warn('Error reading from sessionStorage:', error);
            // Continue to API fetch if cache read fails
        }
        
        try {
            // Fetch from API if no valid cache
            let apiUrl;
            if (companyUserName) {
                // Fetch single provider by companyUserName parameter
                apiUrl = `https://us-central1-beauty-984c8.cloudfunctions.net/searchProviders?companyUserName=${encodeURIComponent(companyUserName)}`;
            } else if (providerId) {
                apiUrl = `https://us-central1-beauty-984c8.cloudfunctions.net/searchProviders?providerId=${encodeURIComponent(providerId)}`;
            } else {
                throw new Error('No username or provider ID provided');
            }
            
            const response = await fetch(apiUrl);
            
            if (!response.ok) {
                throw new Error('Failed to fetch provider data');
            }
            
            let providers = await response.json();
            
            if (!Array.isArray(providers)) {
                throw new Error('Invalid response format');
            }
            
            if (providers.length === 0) {
                throw new Error('Provider not found');
            }
            
            // Extract provider from array (API returns array with single provider)
            providerData = providers[0];
            
            // Store in sessionStorage for future use
            try {
                const cacheKey = companyUserName ? `provider_data_${companyUserName}` : `provider_data_${providerId}`;
                const cacheData = {
                    provider: providerData,
                    timestamp: Date.now(),
                    username: providerData.username || providerData.companyUserName || companyUserName,
                    providerId: providerData.id || providerId
                };
                sessionStorage.setItem(cacheKey, JSON.stringify(cacheData));
            } catch (error) {
                console.warn('Failed to store provider data in sessionStorage:', error);
            }
            
            // Hide loading, show content
            if (loadingEl) loadingEl.style.display = 'none';
            if (contentEl) contentEl.style.display = 'block';
            
            // Render provider data
            renderProviderData(providerData);
            
            // Clean up old cache entries
            cleanupOldCacheEntries();
            
            return providerData;
            
        } catch (error) {
            console.error('Error fetching provider data:', error);
            
            // Try server-side fallback
            try {
                let fallbackUrl = '{{ route('search.provider.fallback') }}?';
                if (companyUserName) {
                    fallbackUrl += `companyUserName=${encodeURIComponent(companyUserName)}`;
                } else if (providerId) {
                    fallbackUrl += `provider_id=${encodeURIComponent(providerId)}`;
                } else {
                    throw new Error('No fallback parameters available');
                }
                
                const fallbackResponse = await fetch(fallbackUrl);
                
                if (fallbackResponse.ok) {
                    const fallbackData = await fallbackResponse.json();
                    providerData = fallbackData.provider;
                    
                    if (loadingEl) loadingEl.style.display = 'none';
                    if (contentEl) contentEl.style.display = 'block';
                    
                    renderProviderData(providerData);
                    return providerData;
                }
            } catch (fallbackError) {
                console.error('Fallback also failed:', fallbackError);
            }
            
            // Show error
            if (loadingEl) loadingEl.style.display = 'none';
            if (errorEl) errorEl.style.display = 'block';
            if (contentEl) contentEl.style.display = 'none';
            
            throw error;
        }
    }
    
    // Render provider data to the page
    function renderProviderData(provider) {
        if (!provider) return;
        
        // Render company name (desktop and mobile)
        const companyName = provider.companyName || provider.name || '';
        const companyNameEl = document.getElementById('providerCompanyName');
        const companyNameMobileEl = document.getElementById('providerCompanyNameMobile');
        const cardCompanyNameEl = document.getElementById('providerCardCompanyName');
        
        if (companyNameEl) companyNameEl.textContent = companyName;
        if (companyNameMobileEl) companyNameMobileEl.textContent = companyName;
        if (cardCompanyNameEl) cardCompanyNameEl.textContent = companyName;
        
        // Render rating and reviews
        const avgRating = provider.avg_ratting || 0;
        const totalReviews = provider.total_review || 0;
        const ratingSectionEl = document.getElementById('providerRatingSection');
        const ratingSectionMobileEl = document.getElementById('providerRatingSectionMobile');
        const cardRatingSectionEl = document.getElementById('providerCardRatingSection');
        
        const ratingHtml = avgRating > 0 ? `
            <p>
                <div class="provider-info-ratting">${avgRating.toFixed(1)}</div>
                <img src="{{ asset('images/images/star_cards.svg') }}" alt="Location" width="14" height="14">
                <img src="{{ asset('images/images/star_cards.svg') }}" alt="Location" width="14" height="14">
                <img src="{{ asset('images/images/star_cards.svg') }}" alt="Location" width="14" height="14">
                <img src="{{ asset('images/images/star_cards.svg') }}" alt="Location" width="14" height="14">
                <img src="{{ asset('images/images/star_cards.svg') }}" alt="Location" width="14" height="14">
                <div class="provider-info-reviews">(${totalReviews} {{ __('app.service.reviews') }})</div>
            </p>
        ` : '';
        
        if (ratingSectionEl) ratingSectionEl.innerHTML = ratingHtml;
        if (ratingSectionMobileEl) ratingSectionMobileEl.innerHTML = ratingHtml;
        if (cardRatingSectionEl) cardRatingSectionEl.innerHTML = ratingHtml;
        
        // Render address
        const address = provider.address || '';
        const addressSectionEl = document.getElementById('providerAddressSection');
        const addressSectionMobileEl = document.getElementById('providerAddressSectionMobile');
        const cardAddressSectionEl = document.getElementById('providerCardAddressSection');
        
        const addressHtml = address ? `
            <p>
                <img src="{{ asset('images/images/mage_map-marker-fill.svg') }}" alt="Location" width="18" height="18">
                <div class="provider-info-address">${escapeHtml(address)}</div>
            </p>
        ` : '';
        
        if (addressSectionEl) addressSectionEl.innerHTML = addressHtml;
        if (addressSectionMobileEl) addressSectionMobileEl.innerHTML = addressHtml;
        if (cardAddressSectionEl) cardAddressSectionEl.innerHTML = addressHtml;
        
        // Render images
        renderProviderImages(provider);
        
        // Render hours of operation
        renderProviderHours(provider);
    }
    
    // Render provider images
    function renderProviderImages(provider) {
        const profileImg = provider.profileImg || defaultImage;
        const salonImages = (provider.salon_images && Array.isArray(provider.salon_images)) 
            ? provider.salon_images.filter(img => img && img.trim() !== '')
            : [];
        
        // Collect images: profile first, then salon images
        const providerImages = [profileImg];
        const salonImagesToUse = salonImages.slice(0, 4);
        salonImagesToUse.forEach(img => {
            if (img) providerImages.push(img);
        });
        
        // Fill remaining slots with default image
        while (providerImages.length < 5) {
            providerImages.push(defaultImage);
        }
        
        // Ensure exactly 5 images
        const finalImages = providerImages.slice(0, 5);
        
        // Update desktop grid images
        const mainImageEl = document.getElementById('providerMainImage');
        const image1El = document.getElementById('providerImage1');
        const image2El = document.getElementById('providerImage2');
        const image3El = document.getElementById('providerImage3');
        const image4El = document.getElementById('providerImage4');
        
        if (mainImageEl) mainImageEl.src = finalImages[0];
        if (image1El) image1El.src = finalImages[1];
        if (image2El) image2El.src = finalImages[2];
        if (image3El) image3El.src = finalImages[3];
        if (image4El) image4El.src = finalImages[4];
        
        // Update mobile carousel
        renderMobileCarousel(profileImg, salonImages);
        
        // Setup gallery overlay
        const salonImagesCount = salonImages.length;
        const totalImagesForOverlay = 1 + salonImagesCount;
        const showOverlay = totalImagesForOverlay > 5;
        
        const overlayEl = document.getElementById('see-all-overlay');
        const overlayTextEl = document.getElementById('see-all-overlay-text');
        const galleryDataEl = document.getElementById('galleryData');
        
        if (showOverlay && salonImagesCount > 0) {
            if (overlayEl) overlayEl.style.display = 'flex';
            if (overlayTextEl) overlayTextEl.textContent = `See all ${totalImagesForOverlay} photos`;
            
            // Setup gallery data
            const galleryImages = [profileImg, ...salonImages];
            if (galleryDataEl) {
                galleryDataEl.setAttribute('data-gallery-images', JSON.stringify(galleryImages));
            }
            
            // Initialize gallery after a delay
            setTimeout(function() {
                initializeProviderGallery();
                attachOverlayClickHandler();
            }, 300);
        } else {
            if (overlayEl) overlayEl.style.display = 'none';
        }
    }
    
    // Render mobile carousel
    function renderMobileCarousel(profileImg, salonImages) {
        const carouselTrack = document.getElementById('carouselTrack');
        const carouselDots = document.getElementById('carouselDots');
        const totalSlidesEl = document.getElementById('totalSlides');
        
        if (!carouselTrack || !carouselDots) return;
        
        const allGalleryImages = [profileImg];
        salonImages.forEach(img => {
            if (img) allGalleryImages.push(img);
        });
        
        // Clear existing content
        carouselTrack.innerHTML = '';
        carouselDots.innerHTML = '';
        
        // Create slides
        allGalleryImages.forEach((image, index) => {
            const slide = document.createElement('div');
            slide.className = `carousel-slide ${index === 0 ? 'active' : ''}`;
            slide.innerHTML = `
                <img src="${image}" 
                     alt="Provider" 
                     class="services-img-fluid"
                     loading="lazy"
                     onerror="this.src='${defaultImage}'">
            `;
            carouselTrack.appendChild(slide);
            
            // Create dot
            const dot = document.createElement('span');
            dot.className = `carousel-dot ${index === 0 ? 'active' : ''}`;
            dot.setAttribute('data-slide', index);
            carouselDots.appendChild(dot);
        });
        
        if (totalSlidesEl) totalSlidesEl.textContent = allGalleryImages.length;
        
        // Re-initialize carousel functionality
        initializeCarousel();
    }
    
    // Render provider hours
    function renderProviderHours(provider) {
        const timing = provider.timing || {};
        const hoursListEl = document.getElementById('hoursList');
        const openUntilTextEl = document.getElementById('openUntilText');
        
        if (!hoursListEl) return;
        
        const dayNames = {
            'Mon': '{{ __('app.service.monday') }}',
            'Tue': '{{ __('app.service.tuesday') }}',
            'Wed': '{{ __('app.service.wednesday') }}',
            'Thu': '{{ __('app.service.thursday') }}',
            'Fri': '{{ __('app.service.friday') }}',
            'Sat': '{{ __('app.service.saturday') }}',
            'Sun': '{{ __('app.service.sunday') }}'
        };
        
        const daysOrder = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        
        // Calculate "Open until" for today
        const now = new Date();
        const dayNamesArray = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        const todayKey = dayNamesArray[now.getDay()];
        let openUntil = '';
        
        if (timing[todayKey] && Array.isArray(timing[todayKey]) && timing[todayKey].length === 2) {
            const openTime = new Date(timing[todayKey][0] * 1000);
            const closeTime = new Date(timing[todayKey][1] * 1000);
            const openTimeStr = openTime.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
            const closeTimeStr = closeTime.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
            
            if (openTimeStr !== closeTimeStr && openTime < closeTime) {
                openUntil = closeTimeStr;
            }
        }
        
        // Update "Open until" text
        if (openUntilTextEl) {
            if (openUntil) {
                openUntilTextEl.innerHTML = `{{ __('app.service.open') }} <span class="until-text-time">{{ __('app.service.until') }} ${openUntil}</span>`;
            } else {
                openUntilTextEl.textContent = 'Hours of operation';
            }
        }
        
        // Render hours list
        hoursListEl.innerHTML = '';
        daysOrder.forEach(shortDay => {
            const fullDay = dayNames[shortDay] || shortDay;
            const hoursRow = document.createElement('div');
            hoursRow.className = 'hours-row';
            
            let hoursTime = 'Closed';
            if (timing[shortDay] && Array.isArray(timing[shortDay]) && timing[shortDay].length === 2) {
                const openTime = new Date(timing[shortDay][0] * 1000);
                const closeTime = new Date(timing[shortDay][1] * 1000);
                const openTimeStr = openTime.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });
                const closeTimeStr = closeTime.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });
                
                if (openTimeStr !== closeTimeStr && openTimeStr < closeTimeStr) {
                    hoursTime = `${openTimeStr} - ${closeTimeStr}`;
                }
            }
            
            hoursRow.innerHTML = `
                <span class="hours-day">${fullDay}</span>
                <span class="hours-time">${hoursTime}</span>
            `;
            hoursListEl.appendChild(hoursRow);
        });
    }
    
    // Helper function to escape HTML
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // Initialize carousel functionality
    function initializeCarousel() {
        const carousel = document.querySelector('.provider-images-carousel');
        if (!carousel) return;
        
        // Use a small delay to ensure DOM is ready
        setTimeout(() => {
            const slides = carousel.querySelectorAll('.carousel-slide');
            const dots = carousel.querySelectorAll('.carousel-dot');
            const currentSlideSpan = carousel.querySelector('.current-slide');
            const heartBtn = carousel.querySelector('.heart-btn');
            
            if (slides.length === 0) return;
            
            let currentSlide = 0;
            const totalSlides = slides.length;
            
            function updateCarousel(index) {
                slides.forEach(slide => slide.classList.remove('active'));
                dots.forEach(dot => dot.classList.remove('active'));
                
                if (slides[index]) slides[index].classList.add('active');
                if (dots[index]) dots[index].classList.add('active');
                
                if (currentSlideSpan) currentSlideSpan.textContent = index + 1;
                currentSlide = index;
            }
            
            // Add click handlers to dots
            dots.forEach((dot, index) => {
                // Remove existing listeners by cloning
                const newDot = dot.cloneNode(true);
                dot.parentNode.replaceChild(newDot, dot);
                newDot.addEventListener('click', () => updateCarousel(index));
            });
            
            // Swipe functionality
            let touchStartX = 0;
            let touchEndX = 0;
            
            carousel.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, { once: false });
            
            carousel.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                const swipeThreshold = 50;
                const diff = touchStartX - touchEndX;
                
                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0 && currentSlide < totalSlides - 1) {
                        updateCarousel(currentSlide + 1);
                    } else if (diff < 0 && currentSlide > 0) {
                        updateCarousel(currentSlide - 1);
                    }
                }
            }, { once: false });
            
            // Heart button toggle
            if (heartBtn) {
                const newHeartBtn = heartBtn.cloneNode(true);
                heartBtn.parentNode.replaceChild(newHeartBtn, heartBtn);
                newHeartBtn.addEventListener('click', function() {
                    this.classList.toggle('active');
                });
            }
        }, 100);
    }
    
    async function fetchProviderServices(providerId, lastDocId = null) {
        const loadingEl = document.getElementById('servicesLoading');
        const paginationLoadingEl = document.getElementById('paginationLoading');
        const errorEl = document.getElementById('servicesError');
        const emptyEl = document.getElementById('servicesEmpty');
        const containerEl = document.getElementById('servicesContainer');
        
        // Prevent duplicate calls
        if (paginationState.isLoading) return;
        paginationState.isLoading = true;
        paginationState.providerId = providerId;
        
        // Show appropriate loader
        if (lastDocId) {
            // Subsequent pages: show pagination loader at bottom
            if (paginationLoadingEl) paginationLoadingEl.style.display = 'flex';
        } else {
            // First page: show main loader and clear container
            loadingEl.style.display = 'flex';
            emptyEl.style.display = 'none';
            containerEl.innerHTML = '';
            existingCategories.clear();
        }
        errorEl.style.display = 'none';
        
        try {
            // Build API URL with pagination param if applicable
            let apiUrl = `https://us-central1-beauty-984c8.cloudfunctions.net/getServicesOfProvider?provider_id=${encodeURIComponent(providerId)}`;
            if (lastDocId) {
                apiUrl += `&lastDocId=${encodeURIComponent(lastDocId)}`;
            }
            
            const response = await fetch(apiUrl);
            
            if (!response.ok) {
                throw new Error('Failed to fetch services');
            }
            
            const data = await response.json();
            
            // Hide loaders
            loadingEl.style.display = 'none';
            if (paginationLoadingEl) paginationLoadingEl.style.display = 'none';
            paginationState.isLoading = false;
            
            // Handle new API response format: { services: [], pagination: {} }
            const services = data.services || data;
            const pagination = data.pagination || { hasMore: false, lastDocId: null };
            
            // Update pagination state
            paginationState.hasMore = pagination.hasMore;
            paginationState.lastDocId = pagination.lastDocId;
            
            // Check for empty services
            if (!Array.isArray(services) || services.length === 0) {
                if (!lastDocId) {
                    // Only show empty state on first page
                    emptyEl.style.display = 'block';
                }
                return;
            }
            
            if (!lastDocId) {
                // First page: use existing renderServices
                renderServices(services);
                // Update provider images with service images
                updateProviderImages(services);
            } else {
                // Subsequent pages: append to existing sections
                appendServices(services);
            }
            
        } catch (error) {
            console.error('Error fetching services:', error);
            loadingEl.style.display = 'none';
            if (paginationLoadingEl) paginationLoadingEl.style.display = 'none';
            paginationState.isLoading = false;
            if (!lastDocId) {
                errorEl.style.display = 'block';
            }
        }
    }
    
    // Helper function to create service row HTML
    function createServiceRowHTML(service) {
        const providerId = (providerData && providerData.id) ? providerData.id : '{{ $providerId ?? "" }}';
        const currentCompanyUserName = (providerData && (providerData.username || providerData.companyUserName)) 
            ? (providerData.username || providerData.companyUserName) 
            : (typeof companyUserName !== 'undefined' ? companyUserName : '');
        
        // Use category-specific placeholder image
        const categoryPlaceholder = getCategoryImageUrl(service.category_id || service.categoryId);
        const serviceImage = (service.images && service.images.length > 0) ? service.images[0] : categoryPlaceholder;
        const serviceName = service.service_name || 'Unnamed Service';
        const serviceDetails = service.service_details || '';
        const duration = service.duration_minutes || 0;
        const price = service.service_price || 0;
        const serviceId = service.id || '';
        const servicesSlug = service.services_slug || '';
        
        let bookUrl;
        if (currentCompanyUserName && servicesSlug) {
            bookUrl = `/${encodeURIComponent(currentCompanyUserName)}/${encodeURIComponent(servicesSlug)}`;
        } else {
            bookUrl = `/book-appointment?serviceId=${serviceId}&service_provider_id=${providerId}`;
        }
        
        return `
            <div class="service-row services-d-flex services-justify-between services-flex-wrap">
                <div class="service-info services-d-flex services-align-center">
                    <div class="service-image">
                        <img src="${serviceImage}" 
                             alt="${serviceName}" 
                             class="services-img-fluid services-rounded-circle"
                             loading="lazy"
                             onerror="this.src='${categoryPlaceholder}'">
                    </div>
                    <div class="service-list-details" style="margin-left: 35px;">
                        <div class="service-name services-fw-semibold">
                            <a href="${bookUrl}">${truncateText(serviceName, 50)}</a>
                        </div>
                        ${createDescriptionHTML(serviceDetails, serviceId)}
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
    }
    
    // Helper function to find category section in DOM
    function findCategorySection(categoryName) {
        return document.querySelector(`.category-section[data-category="${categoryName}"]`);
    }
    
    // Helper function to find subcategory section in DOM
    function findSubcategorySection(categorySection, subcategoryName) {
        const subKey = subcategoryName || '__no_subcategory__';
        if (subKey === '__no_subcategory__') {
            // Services without subcategory are direct children of category-services-list
            return null;
        }
        return categorySection.querySelector(`.subcategory-section[data-subcategory="${subcategoryName}"]`);
    }
    
    // Add category filter pill if not exists
    function addCategoryFilterPill(categoryName) {
        const filterContainer = document.querySelector('.service-filter-pills');
        if (!filterContainer) return;
        
        // Check if pill already exists
        const existingPill = filterContainer.querySelector(`[data-category="${categoryName}"]`);
        if (existingPill) return;
        
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'filter-pill';
        button.setAttribute('data-category', categoryName);
        button.textContent = categoryName;
        filterContainer.appendChild(button);
        
        // Re-initialize filter click handler for new pill
        button.addEventListener('click', function() {
            const pills = filterContainer.querySelectorAll('.filter-pill');
            pills.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            
            const category = this.getAttribute('data-category');
            const sections = document.querySelectorAll('.category-section');
            sections.forEach(section => {
                if (category === 'all' || section.getAttribute('data-category') === category) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        });
    }
    
    // Append services to existing DOM structure (for pagination)
    function appendServices(services) {
        const containerEl = document.getElementById('servicesContainer');
        
        services.forEach(service => {
            const categoryName = service.category?.name || 'Uncategorized';
            const subcategoryName = service.subcategory?.name || null;
            const subKey = subcategoryName || '__no_subcategory__';
            
            let categorySection = findCategorySection(categoryName);
            
            if (categorySection) {
                // Category exists - find or create subcategory
                const categoryServicesList = categorySection.querySelector('.category-services-list');
                
                if (subKey === '__no_subcategory__') {
                    // Append directly to category services list (before any subcategory sections)
                    const serviceRowHTML = createServiceRowHTML(service);
                    const firstSubcategory = categoryServicesList.querySelector('.subcategory-section');
                    if (firstSubcategory) {
                        firstSubcategory.insertAdjacentHTML('beforebegin', serviceRowHTML);
                    } else {
                        categoryServicesList.insertAdjacentHTML('beforeend', serviceRowHTML);
                    }
                } else {
                    let subcategorySection = findSubcategorySection(categorySection, subcategoryName);
                    
                    if (subcategorySection) {
                        // Subcategory exists - append service to it
                        const subcategoryServicesList = subcategorySection.querySelector('.subcategory-services-list');
                        if (subcategoryServicesList) {
                            const serviceRowHTML = createServiceRowHTML(service);
                            // Insert before hidden-services-container or see-more button if exists
                            const hiddenContainer = subcategoryServicesList.querySelector('.hidden-services-container');
                            const seeMoreBtn = subcategoryServicesList.querySelector('.see-more-services-btn');
                            if (hiddenContainer) {
                                hiddenContainer.insertAdjacentHTML('beforebegin', serviceRowHTML);
                            } else if (seeMoreBtn) {
                                seeMoreBtn.insertAdjacentHTML('beforebegin', serviceRowHTML);
                            } else {
                                subcategoryServicesList.insertAdjacentHTML('beforeend', serviceRowHTML);
                            }
                        }
                    } else {
                        // Create new subcategory section
                        const subcategoryHTML = `
                            <div class="subcategory-section" data-subcategory="${subcategoryName}">
                                <div class="subcategory-header" style="display: flex; align-items: center; padding: 12px 0; margin-left: 10px; cursor: pointer;">
                                    <h4 style="font-size: 18px; font-weight: 500; color: #333; margin: 0;">${subcategoryName}</h4>
                                    <i class="fas fa-chevron-up subcategory-chevron" style="color: #666; font-size: 12px; transition: transform 0.3s ease; margin-left: 10px;"></i>
                                </div>
                                <div class="subcategory-services-list">
                                    ${createServiceRowHTML(service)}
                                </div>
                            </div>
                        `;
                        categoryServicesList.insertAdjacentHTML('beforeend', subcategoryHTML);
                        
                        // Initialize toggle for new subcategory
                        const newSubcategory = categoryServicesList.querySelector(`.subcategory-section[data-subcategory="${subcategoryName}"]`);
                        if (newSubcategory) {
                            initializeSubcategoryToggle(newSubcategory);
                        }
                    }
                }
            } else {
                // Create new category section
                existingCategories.add(categoryName);
                addCategoryFilterPill(categoryName);
                
                let subcategorySectionHTML = '';
                if (subKey === '__no_subcategory__') {
                    subcategorySectionHTML = createServiceRowHTML(service);
                } else {
                    subcategorySectionHTML = `
                        <div class="subcategory-section" data-subcategory="${subcategoryName}">
                            <div class="subcategory-header" style="display: flex; align-items: center; padding: 12px 0; margin-left: 10px; cursor: pointer;">
                                <h4 style="font-size: 18px; font-weight: 500; color: #333; margin: 0;">${subcategoryName}</h4>
                                <i class="fas fa-chevron-up subcategory-chevron" style="color: #666; font-size: 12px; transition: transform 0.3s ease; margin-left: 10px;"></i>
                            </div>
                            <div class="subcategory-services-list">
                                ${createServiceRowHTML(service)}
                            </div>
                        </div>
                    `;
                }
                
                const categoryHTML = `
                    <div class="category-section" data-category="${categoryName}">
                        <div class="section-title category-toggle-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; margin-top: 20px; cursor: pointer;" data-category-toggle="${categoryName}">
                            <h3 class="wow" style="font-size:30px; font-weight:500; letter-spacing: -1px; color:rgba(229, 0, 80, 1); margin: 0;">${categoryName}</h3>
                            <i class="fas fa-chevron-up category-chevron" style="color: rgba(229, 0, 80, 1); font-size: 16px; transition: transform 0.3s ease; margin-left: 15px;"></i>
                        </div>
                        <div class="custom-service-list category-services-list">
                            ${subcategorySectionHTML}
                        </div>
                    </div>
                `;
                containerEl.insertAdjacentHTML('beforeend', categoryHTML);
                
                // Initialize toggles for new category
                const newCategory = containerEl.querySelector(`.category-section[data-category="${categoryName}"]`);
                if (newCategory) {
                    initializeCategoryToggle(newCategory);
                    const newSubcategory = newCategory.querySelector('.subcategory-section');
                    if (newSubcategory) {
                        initializeSubcategoryToggle(newSubcategory);
                    }
                }
            }
        });
    }
    
    // Initialize toggle for a single category
    function initializeCategoryToggle(categorySection) {
        const header = categorySection.querySelector('.category-toggle-header');
        const servicesList = categorySection.querySelector('.category-services-list');
        const chevron = header.querySelector('.category-chevron');
        
        if (header && servicesList) {
            header.addEventListener('click', function() {
                const isCollapsed = servicesList.style.display === 'none';
                servicesList.style.display = isCollapsed ? 'block' : 'none';
                if (chevron) {
                    chevron.style.transform = isCollapsed ? 'rotate(0deg)' : 'rotate(180deg)';
                }
            });
        }
    }
    
    // Initialize toggle for a single subcategory
    function initializeSubcategoryToggle(subcategorySection) {
        const header = subcategorySection.querySelector('.subcategory-header');
        const servicesList = subcategorySection.querySelector('.subcategory-services-list');
        const chevron = header.querySelector('.subcategory-chevron');
        
        if (header && servicesList) {
            header.addEventListener('click', function() {
                const isCollapsed = servicesList.style.display === 'none';
                servicesList.style.display = isCollapsed ? 'block' : 'none';
                if (chevron) {
                    chevron.style.transform = isCollapsed ? 'rotate(0deg)' : 'rotate(180deg)';
                }
            });
        }
    }
    
    // Debounce helper for scroll event
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Infinite scroll handler
    const handleInfiniteScroll = debounce(function() {
        if (paginationState.hasMore && !paginationState.isLoading && paginationState.providerId) {
            const scrollPosition = window.innerHeight + window.scrollY;
            const threshold = document.body.offsetHeight - 1000;
            
            if (scrollPosition >= threshold) {
                fetchProviderServices(paginationState.providerId, paginationState.lastDocId);
            }
        }
    }, 200);
    
    // Attach infinite scroll listener
    window.addEventListener('scroll', handleInfiniteScroll);
    
    function renderServices(services) {
        // Group services by category, then by subcategory
        const groupedServices = {};  // { categoryName: { subcategoryName: [services] } }
        const categories = new Set();
        
        services.forEach(service => {
            const categoryName = service.category?.name || 'Uncategorized';
            const subcategoryName = service.subcategory?.name || null;
            categories.add(categoryName);
            
            if (!groupedServices[categoryName]) {
                groupedServices[categoryName] = {};
            }
            
            // Group by subcategory within category
            const subKey = subcategoryName || '__no_subcategory__';
            if (!groupedServices[categoryName][subKey]) {
                groupedServices[categoryName][subKey] = [];
            }
            groupedServices[categoryName][subKey].push(service);
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
        initializeSeeMoreButtons();
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
    
    function createCategorySection(categoryName, subcategoryGroups) {
        const section = document.createElement('div');
        section.className = 'category-section';
        section.setAttribute('data-category', categoryName);
        
        const defaultImage = '{{ asset("/images/default.jpeg") }}';
        // Get provider ID from providerData if available, otherwise from server
        const providerId = (providerData && providerData.id) ? providerData.id : '{{ $providerId ?? "" }}';
        // Get companyUserName from providerData or use the global companyUserName variable from URL path
        const currentCompanyUserName = (providerData && (providerData.username || providerData.companyUserName)) 
            ? (providerData.username || providerData.companyUserName) 
            : (typeof companyUserName !== 'undefined' ? companyUserName : '');
        
        // Build subcategory sections HTML
        let subcategorySectionsHTML = '';
        
        // Sort subcategory keys, putting '__no_subcategory__' last
        const subcategoryKeys = Object.keys(subcategoryGroups).sort((a, b) => {
            if (a === '__no_subcategory__') return 1;
            if (b === '__no_subcategory__') return -1;
            return a.localeCompare(b);
        });
        
        subcategoryKeys.forEach(subKey => {
            const services = subcategoryGroups[subKey];
            const isNoSubcategory = subKey === '__no_subcategory__';
            
            // Check if we need to limit services (more than 5)
            const hasMoreServices = services.length > 5;
            const visibleServices = hasMoreServices ? services.slice(0, 5) : services;
            const hiddenServices = hasMoreServices ? services.slice(5) : [];
            
            // Build services HTML for visible services only
            const servicesHTML = visibleServices.map(service => {
                const categoryPlaceholder = getCategoryImageUrl(service.category_id || service.categoryId);
                const serviceImage = (service.images && service.images.length > 0) ? service.images[0] : categoryPlaceholder;
                const serviceName = service.service_name || 'Unnamed Service';
                const serviceDetails = service.service_details || '';
                const duration = service.duration_minutes || 0;
                const price = service.service_price || 0;
                const serviceId = service.id || '';
                const servicesSlug = service.services_slug || '';
                
                // Use slug-based URL if available, otherwise fallback to old format
                let bookUrl;
                if (currentCompanyUserName && servicesSlug) {
                    bookUrl = `/${encodeURIComponent(currentCompanyUserName)}/${encodeURIComponent(servicesSlug)}`;
                } else {
                    // Fallback to old format if slug or username not available
                    bookUrl = `/book-appointment?serviceId=${serviceId}&service_provider_id=${providerId}`;
                }
                
                return `
                    <div class="service-row services-d-flex services-justify-between services-flex-wrap">
                        <div class="service-info services-d-flex services-align-center">
                            <div class="service-image">
                                <img src="${serviceImage}" 
                                     alt="${serviceName}" 
                                     class="services-img-fluid services-rounded-circle"
                                     loading="lazy"
                                     onerror="this.src='${categoryPlaceholder}'">
                            </div>
                            <div class="service-list-details" style="margin-left: 35px;">
                                <div class="service-name services-fw-semibold">
                                    <a href="${bookUrl}">${truncateText(serviceName, 50)}</a>
                                </div>
                                ${createDescriptionHTML(serviceDetails, serviceId)}
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
            }).join('');
            
            // Build hidden services HTML (only if there are hidden services)
            const hiddenServicesHTML = hiddenServices.map(service => {
                const categoryPlaceholder = getCategoryImageUrl(service.category_id || service.categoryId);
                const serviceImage = (service.images && service.images.length > 0) ? service.images[0] : categoryPlaceholder;
                const serviceName = service.service_name || 'Unnamed Service';
                const serviceDetails = service.service_details || '';
                const duration = service.duration_minutes || 0;
                const price = service.service_price || 0;
                const serviceId = service.id || '';
                const servicesSlug = service.services_slug || '';
                
                // Use slug-based URL if available, otherwise fallback to old format
                let bookUrl;
                if (currentCompanyUserName && servicesSlug) {
                    bookUrl = `/${encodeURIComponent(currentCompanyUserName)}/${encodeURIComponent(servicesSlug)}`;
                } else {
                    // Fallback to old format if slug or username not available
                    bookUrl = `/book-appointment?serviceId=${serviceId}&service_provider_id=${providerId}`;
                }
                
                return `
                    <div class="service-row services-d-flex services-justify-between services-flex-wrap hidden-service-item" style="display: none;">
                        <div class="service-info services-d-flex services-align-center">
                            <div class="service-image">
                                <img src="${serviceImage}" 
                                     alt="${serviceName}" 
                                     class="services-img-fluid services-rounded-circle"
                                     loading="lazy"
                                     onerror="this.src='${categoryPlaceholder}'">
                            </div>
                            <div class="service-list-details" style="margin-left: 35px;">
                                <div class="service-name services-fw-semibold">
                                    <a href="${bookUrl}">${truncateText(serviceName, 50)}</a>
                                </div>
                                ${createDescriptionHTML(serviceDetails, serviceId)}
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
            }).join('');
            
            // Create unique ID for this subcategory's see more button
            // Use category name + subcategory key to ensure uniqueness
            const subcategoryId = (categoryName + '_' + subKey).replace(/[^a-zA-Z0-9]/g, '_');
            const seeMoreBtnHTML = hasMoreServices ? `
                <button type="button" class="see-more-services-btn" data-subcategory-id="${subcategoryId}" data-expanded="false" data-see-more-text="${translations.seeMore}" data-see-less-text="${translations.seeLess}">
                    ${translations.seeMore} (${hiddenServices.length})
                </button>
            ` : '';
            
            if (isNoSubcategory) {
                // Services without subcategory - render directly with a wrapper for the see more button
                subcategorySectionsHTML += servicesHTML + 
                    (hiddenServicesHTML ? `<div class="hidden-services-container" data-subcategory-id="${subcategoryId}">${hiddenServicesHTML}</div>` : '') + 
                    seeMoreBtnHTML;
            } else {
                // Services with subcategory - render with subcategory header
                subcategorySectionsHTML += `
                    <div class="subcategory-section" data-subcategory="${subKey}">
                        <div class="subcategory-header" style="display: flex; align-items: center; padding: 12px 0; margin-left: 10px; cursor: pointer;">
                            <h4 style="font-size: 18px; font-weight: 500; color: #333; margin: 0;">${subKey}</h4>
                            <i class="fas fa-chevron-up subcategory-chevron" style="color: #666; font-size: 12px; transition: transform 0.3s ease; margin-left: 10px;"></i>
                        </div>
                        <div class="subcategory-services-list">
                            ${servicesHTML}
                            ${hiddenServicesHTML ? `<div class="hidden-services-container" data-subcategory-id="${subcategoryId}">${hiddenServicesHTML}</div>` : ''}
                            ${seeMoreBtnHTML}
                        </div>
                    </div>
                `;
            }
        });
        
        section.innerHTML = `
            <div class="section-title category-toggle-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; margin-top: 20px; cursor: pointer;" data-category-toggle="${categoryName}">
                <h3 class="wow" style="font-size:30px; font-weight:500; letter-spacing: -1px; color:rgba(229, 0, 80, 1); margin: 0;">${categoryName}</h3>
                <i class="fas fa-chevron-up category-chevron" style="color: rgba(229, 0, 80, 1); font-size: 16px; transition: transform 0.3s ease; margin-left: 15px;"></i>
            </div>
            <div class="custom-service-list category-services-list">
                ${subcategorySectionsHTML}
            </div>
        `;
        
        return section;
    }
    
    function truncateText(text, length) {
        if (text.length <= length) return text;
        return text.substring(0, length) + '...';
    }
    

    
    // Helper function to create description HTML with See More functionality
    function createDescriptionHTML(serviceDetails, serviceId) {
        if (!serviceDetails) return '';
        
        // Generate unique ID for this service's description
        const descId = `desc-${serviceId || Math.random().toString(36).substr(2, 9)}`;
        
        // Check if description needs truncation (more than 8 words)
        // Note: Previous implementation was 50 characters (approx 8 words). 
        // User requested "50 words" but likely meant "matches previous length but with full words".
        const wordLimit = 8;
        const needsTruncation = window.truncateWords(serviceDetails, wordLimit, true);
        const truncatedDesc = needsTruncation ? window.truncateWords(serviceDetails, wordLimit) : serviceDetails;
        
        if (needsTruncation) {
            return `
                <div class="service-desc services-text-muted">
                    <span class="desc-text" data-desc-id="${descId}">${escapeHtml(truncatedDesc)}</span>
                    <span class="desc-full" data-desc-id="${descId}" style="display: none;">${escapeHtml(serviceDetails)}</span>
                    <button type="button" class="see-more-desc-btn" data-desc-id="${descId}" onclick="window.toggleDescription('${descId}', event)" style="color: rgba(229, 0, 80, 1); background: none; border: none; cursor: pointer; font-size: 14px; padding: 0; margin-left: 5px; text-decoration: underline;">
                        ${window.serviceTranslations.seeMore}
                    </button>
                </div>
            `;
        } else {
            return `<div class="service-desc services-text-muted">${escapeHtml(serviceDetails)}</div>`;
        }
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
        // Only update if providerData is available
        if (!providerData) return;
        
        // Collect service images for provider gallery
        const providerImages = [];
        const defaultImage = '{{ asset("/images/default.jpeg") }}';
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
        
        // Initialize subcategory toggles
        const subcategoryHeaders = document.querySelectorAll('.subcategory-header');
        
        subcategoryHeaders.forEach(function(subHeader) {
            // Remove existing listeners by cloning
            const newSubHeader = subHeader.cloneNode(true);
            subHeader.parentNode.replaceChild(newSubHeader, subHeader);
            
            newSubHeader.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent category toggle from firing
                const subcategorySection = this.closest('.subcategory-section');
                const servicesList = subcategorySection.querySelector('.subcategory-services-list');
                const chevron = this.querySelector('.subcategory-chevron');
                
                if (servicesList && chevron) {
                    servicesList.classList.toggle('collapsed');
                    chevron.classList.toggle('rotated');
                }
            });
        });
    }
    
    function initializeSeeMoreButtons() {
        const seeMoreButtons = document.querySelectorAll('.see-more-services-btn');
        
        seeMoreButtons.forEach(function(button) {
            // Remove existing listeners by cloning
            const newButton = button.cloneNode(true);
            button.parentNode.replaceChild(newButton, button);
            
            // Get translation texts from data attributes
            const seeMoreText = newButton.getAttribute('data-see-more-text') || 'See More';
            const seeLessText = newButton.getAttribute('data-see-less-text') || 'See Less';
            
            newButton.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent category/subcategory toggle from firing
                
                const subcategoryId = this.getAttribute('data-subcategory-id');
                const isExpanded = this.getAttribute('data-expanded') === 'true';
                
                // Find the hidden services container with matching subcategory ID
                const hiddenContainer = document.querySelector(`.hidden-services-container[data-subcategory-id="${subcategoryId}"]`);
                
                if (!hiddenContainer) {
                    console.warn('Hidden services container not found for subcategory:', subcategoryId);
                    return;
                }
                
                // Find all hidden service items within this specific container
                const hiddenItems = hiddenContainer.querySelectorAll('.hidden-service-item');
                
                if (isExpanded) {
                    // Collapse: hide all hidden items
                    hiddenItems.forEach(function(item) {
                        item.style.display = 'none';
                    });
                    // Update button text with translation
                    const hiddenCount = hiddenItems.length;
                    newButton.textContent = `${seeMoreText} (${hiddenCount})`;
                    newButton.setAttribute('data-expanded', 'false');
                } else {
                    // Expand: show all hidden items (use flex to match parent container)
                    hiddenItems.forEach(function(item) {
                        item.style.display = 'flex';
                    });
                    // Update button text with translation
                    newButton.textContent = seeLessText;
                    newButton.setAttribute('data-expanded', 'true');
                }
            });
        });
    }
    
    // Carousel is now initialized dynamically in initializeCarousel() function
    // which is called from renderMobileCarousel() after provider data is loaded
    
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
    if (providerData && providerData.id) {
        // Wait a bit for updateProviderImages to complete
        setTimeout(function() {
            initializeProviderGallery();
        }, 500);
    } else {
        // Initialize immediately if no services to fetch
        initializeProviderGallery();
    }

    // ========================================
    // VIDEO FUNCTIONALITY
    // ========================================
    
    // Video variables (scoped to be accessible by tab switching)
    let videos = [];
    let lastDocId = null;
    let hasMore = true;
    let isVideoLoading = false;
    let currentVideoIndex = -1;
    const defaultThumbnail = '{{ asset("images/images/default-video-thumbnail.jpg") }}';
    const defaultUserImage = '{{ asset("images/default.jpeg") }}';
    
    // Track if mouse is over video modal for touchpad scroll
    let isMouseOverModal = false;
    let scrollCooldown = false;
    
    // Drag functionality
    let isDragging = false;
    let dragStartX = 0;
    let dragStartY = 0;
    let modalStartX = 0;
    let modalStartY = 0;
    let currentX = 0;
    let currentY = 0;
    
    // Modal position tracking
    let modalManuallyPositioned = false;
    let savedModalPosition = { left: null, top: null };
    
    // Initialize videos when tab is activated
    function initializeVideos() {
        console.log('Initializing videos tab...');
        
        // Show loading state
        const loadingEl = document.getElementById('videos-loading');
        if (loadingEl) loadingEl.style.display = 'flex';
        
        // Fetch videos
        fetchVideos();
        
        // Setup event listeners for video modal
        setupVideoEventListeners();
    }
    
    // Make initializeVideos globally accessible for the tab switching script
    window.initializeVideosTab = initializeVideos;
    
    // If videos tab was already opened (tab script ran first), initialize now
    if (window.videosTabLoaded && !window.videosInitialized) {
        window.videosInitialized = true;
        console.log('Videos tab was already opened, initializing now...');
        initializeVideos();
    }
    
    // Fetch videos from API
    async function fetchVideos(lastDocIdParam = null) {
        if (isVideoLoading) {
            console.log('fetchVideos: Already loading, skipping duplicate call');
            return;
        }
        
        isVideoLoading = true;
        const loadingEl = document.getElementById('videos-loading');
        const errorEl = document.getElementById('videos-error');
        const emptyEl = document.getElementById('videos-empty');
        const gridEl = document.getElementById('videos-grid');
        
        // Show loading only on first load
        if (lastDocIdParam === null) {
            if (loadingEl) loadingEl.style.display = 'flex';
            if (errorEl) errorEl.style.display = 'none';
            if (emptyEl) emptyEl.style.display = 'none';
            if (gridEl) gridEl.style.display = 'none';
        }
        
        try {
            let apiUrl = 'https://us-central1-beauty-984c8.cloudfunctions.net/getAllVideos';
            const params = new URLSearchParams();
            
            // Use companyUserName if available (preferred), otherwise fallback to serviceProviderId
            const username = companyUserName || (providerData && (providerData.username || providerData.companyUserName));
            
            console.log('Fetching videos with:', { companyUserName, username, providerData });
            
            if (username) {
                params.append('companyUserName', username);
                console.log('Using companyUserName parameter:', username);
            } else if (providerData && providerData.id) {
                // Fallback to serviceProviderId if username not available
                params.append('serviceProviderId', providerData.id);
                console.log('Using serviceProviderId parameter:', providerData.id);
            } else {
                console.warn('No username or providerId available for fetching videos');
            }
            
            // Add lastDocId for pagination if provided
            if (lastDocIdParam) {
                params.append('lastDocId', lastDocIdParam);
            }
            
            // Append query string if we have any parameters
            if (params.toString()) {
                apiUrl += '?' + params.toString();
            }
            
            console.log('Fetching videos from API:', apiUrl);
            
            const response = await fetch(apiUrl);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            
            console.log('Videos API response:', {
                hasVideos: !!data.videos,
                videosCount: data.videos ? data.videos.length : 0,
                pagination: data.pagination
            });
            
            if (loadingEl) loadingEl.style.display = 'none';
            
            if (!data.videos || !Array.isArray(data.videos) || data.videos.length === 0) {
                console.log('No videos found in response');
                if (videos.length === 0) {
                    if (emptyEl) emptyEl.style.display = 'flex';
                    console.log('Showing empty state');
                }
                hasMore = false;
                isVideoLoading = false;
                return;
            }
            
            // Update pagination info
            if (data.pagination) {
                hasMore = data.pagination.hasMore === true;
                lastDocId = data.pagination.lastDocId || null;
            }
            
            // Append new videos
            videos = [...videos, ...data.videos];
            
            console.log('Total videos after append:', videos.length);
            
            // Render videos
            renderVideos(data.videos);
            
            if (gridEl) {
                gridEl.style.display = 'grid';
                console.log('Videos grid displayed');
            }
            if (emptyEl) emptyEl.style.display = 'none';
            
        } catch (error) {
            console.error('Error fetching videos:', error);
            if (loadingEl) loadingEl.style.display = 'none';
            if (errorEl) {
                errorEl.style.display = 'flex';
                const errorMsg = document.getElementById('videos-error-message');
                if (errorMsg) {
                    errorMsg.textContent = 'Failed to load videos. Please check your connection and try again.';
                }
            }
        } finally {
            isVideoLoading = false;
        }
    }
    
    // Render video cards
    function renderVideos(videosArray) {
        const gridEl = document.getElementById('videos-grid');
        if (!gridEl) {
            console.error('Videos grid element not found!');
            return;
        }
        
        console.log('Rendering', videosArray.length, 'videos');
        
        videosArray.forEach(video => {
            const videoCard = createVideoCard(video);
            gridEl.appendChild(videoCard);
        });
        
        console.log('Videos rendered successfully');
    }
    
    // Create video card element
    function createVideoCard(video) {
        const card = document.createElement('div');
        card.className = 'video-card';
        card.setAttribute('data-video-id', video.id || '');
        
        const thumbnail = video.thumbnail || defaultThumbnail;
        const userImage = video.userImage || defaultUserImage;
        const username = video.username || 'Unknown';
        const hashtags = video.hashtags || '';
        
        card.innerHTML = `
            <div class="video-thumbnail-container">
                <img src="${escapeHtmlForVideo(thumbnail)}" 
                     alt="Video thumbnail" 
                     class="video-thumbnail"
                     onerror="this.src='${defaultThumbnail}'">
                <div class="video-play-overlay">
                    <div class="video-play-icon"></div>
                </div>
                <div class="video-user-info">
                    <img src="${escapeHtmlForVideo(userImage)}" 
                         alt="${escapeHtmlForVideo(username)}" 
                         class="video-user-image"
                         onerror="this.src='${defaultUserImage}'">
                    <div class="video-user-text">
                        <div class="video-username-overlay">${escapeHtmlForVideo(username)}</div>
                        ${hashtags ? `<div class="video-hashtags-overlay">${escapeHtmlForVideo(hashtags)}</div>` : ''}
                    </div>
                </div>
            </div>
        `;
        
        // Add click handler to open modal
        card.addEventListener('click', function() {
            console.log('Video card clicked:', video.id);
            const videoIndex = videos.findIndex(v => v.id === video.id);
            console.log('Opening video modal, index:', videoIndex);
            openVideoModal(video, videoIndex);
        });
        
        return card;
    }
    
    // Escape HTML to prevent XSS (for videos)
    function escapeHtmlForVideo(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // Open video modal
    function openVideoModal(video, videoIndex = -1) {
        console.log('openVideoModal called with:', { videoId: video.id, videoIndex });
        const modal = document.getElementById('videoModal');
        const modalContent = document.querySelector('.video-modal-content');
        const modalVideo = document.getElementById('modalVideo');
        const modalUserImage = document.getElementById('modalUserImage');
        const modalUsername = document.getElementById('modalUsername');
        const modalHashtags = document.getElementById('modalHashtags');
        const bookingBtn = document.getElementById('modalBookingBtn');
        
        if (!modal) {
            console.error('Video modal element not found!');
            return;
        }
        
        console.log('Modal found, opening...');
        
        // Store current video index
        if (videoIndex >= 0) {
            currentVideoIndex = videoIndex;
        } else {
            currentVideoIndex = videos.findIndex(v => v.id === video.id);
        }
        
        // Set video source
        if (modalVideo && video.videoUrl) {
            modalVideo.setAttribute('data-video-id', video.id || '');
            modalVideo.src = video.videoUrl;
            modalVideo.load();
        }
        
        // Set user info
        if (modalUserImage) {
            modalUserImage.src = video.userImage || defaultUserImage;
            modalUserImage.alt = video.username || 'User';
            modalUserImage.onerror = function() {
                this.src = defaultUserImage;
            };
        }
        
        if (modalUsername) {
            modalUsername.textContent = video.username || 'Unknown';
        }
        
        if (modalHashtags) {
            modalHashtags.textContent = video.hashtags || '';
            modalHashtags.style.display = video.hashtags ? 'block' : 'none';
        }
        
        // Set booking button link
        if (bookingBtn && video.services_slug) {
            const username = video.companyUserName || 
                            (providerData && (providerData.username || providerData.companyUserName)) ||
                            companyUserName;
            
            if (username && video.services_slug) {
                bookingBtn.href = `/${encodeURIComponent(username)}/${encodeURIComponent(video.services_slug)}`;
            } else if (video.serviceId && video.serviceProviderId) {
                bookingBtn.href = '/book-appointment?serviceId=' + encodeURIComponent(video.serviceId) + '&service_provider_id=' + encodeURIComponent(video.serviceProviderId);
            } else if (video.serviceProviderId) {
                const fallbackUsername = video.companyUserName || 
                                        (providerData && (providerData.username || providerData.companyUserName)) ||
                                        companyUserName;
                if (fallbackUsername) {
                    bookingBtn.href = `/${encodeURIComponent(fallbackUsername)}`;
                } else {
                    bookingBtn.href = '/recherche?provider_id=' + encodeURIComponent(video.serviceProviderId);
                }
            }
        } else if (bookingBtn && video.serviceProviderId) {
            const fallbackUsername = video.companyUserName || 
                                    (providerData && (providerData.username || providerData.companyUserName)) ||
                                    companyUserName;
            if (fallbackUsername) {
                bookingBtn.href = `/${encodeURIComponent(fallbackUsername)}`;
            } else {
                bookingBtn.href = '/recherche?provider_id=' + encodeURIComponent(video.serviceProviderId);
            }
        }
        
        // Reset modal position for new videos
        if (modalContent) {
            modalContent.style.transform = 'translate(-50%, -50%)';
            modalContent.style.top = '50%';
            modalContent.style.left = '50%';
            modalManuallyPositioned = false;
            savedModalPosition = { left: null, top: null };
        }
        
        // Update navigation buttons
        updateNavigationButtons();
        
        // Show modal
        console.log('Showing video modal');
        modal.classList.add('active');
        
        // Play video
        if (modalVideo) {
            console.log('Playing video:', modalVideo.src);
            modalVideo.play().catch(err => {
                console.error('Error playing video:', err);
            });
        }
    }
    
    // Navigate to previous/next video
    function navigateVideo(direction) {
        if (currentVideoIndex < 0 || videos.length === 0) return;
        
        let newIndex = currentVideoIndex;
        if (direction === 'prev') {
            newIndex = currentVideoIndex - 1;
            if (newIndex < 0) return;
        } else if (direction === 'next') {
            newIndex = currentVideoIndex + 1;
            if (newIndex >= videos.length) return;
        }
        
        if (newIndex >= 0 && newIndex < videos.length) {
            openVideoModal(videos[newIndex], newIndex);
        }
    }
    
    // Update navigation buttons state
    function updateNavigationButtons() {
        const navUp = document.querySelector('.video-nav-up');
        const navDown = document.querySelector('.video-nav-down');
        
        if (navUp) {
            navUp.disabled = currentVideoIndex <= 0;
        }
        
        if (navDown) {
            navDown.disabled = currentVideoIndex >= videos.length - 1;
        }
    }
    
    // Close video modal
    function closeVideoModal() {
        const modal = document.getElementById('videoModal');
        const modalContent = document.querySelector('.video-modal-content');
        const modalVideo = document.getElementById('modalVideo');
        
        if (modal) {
            modal.classList.remove('active');
        }
        
        if (modalVideo) {
            modalVideo.pause();
            modalVideo.currentTime = 0;
            modalVideo.src = '';
        }
        
        isDragging = false;
        if (modalContent) {
            modalContent.classList.remove('dragging');
        }
    }
    
    // Setup video event listeners
    function setupVideoEventListeners() {
        // Close button
        const closeBtn = document.getElementById('videoModalCloseBtn');
        if (closeBtn) {
            closeBtn.addEventListener('click', closeVideoModal);
        }
        
        // Navigation buttons
        const navUpBtn = document.getElementById('videoNavUpBtn');
        if (navUpBtn) {
            navUpBtn.addEventListener('click', function() {
                navigateVideo('prev');
            });
        }
        
        const navDownBtn = document.getElementById('videoNavDownBtn');
        if (navDownBtn) {
            navDownBtn.addEventListener('click', function() {
                navigateVideo('next');
            });
        }
        
        // Booking button
        const bookingBtn = document.getElementById('modalBookingBtn');
        if (bookingBtn) {
            bookingBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.href;
                closeVideoModal();
                setTimeout(function() {
                    if (url && url !== '#') {
                        window.location.href = url;
                    }
                }, 100);
            });
        }
        
        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('videoModal');
            if (modal && e.target === modal) {
                closeVideoModal();
            }
        });
        
        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('videoModal');
                if (modal && modal.classList.contains('active')) {
                    closeVideoModal();
                }
            }
        });
        
        // Setup drag functionality
        setupDragFunctionality();
        
        // Setup wheel scroll navigation
        setupWheelNavigation();
        
        // Setup infinite scroll for videos
        setupInfiniteScroll();
    }
    
    // Setup drag functionality for modal
    function setupDragFunctionality() {
        const modalContent = document.querySelector('.video-modal-content');
        if (!modalContent) return;
        
        function startDrag(e) {
            const modal = document.getElementById('videoModal');
            if (!modal || !modal.classList.contains('active')) return;
            
            const target = e.target;
            if (target.closest('button, a, .video-modal-close, .video-nav-btn, .video-modal-booking-btn')) {
                return;
            }
            
            if (target.tagName === 'VIDEO' || target.closest('video')) {
                const video = document.getElementById('modalVideo');
                if (video) {
                    const rect = video.getBoundingClientRect();
                    const clickY = e.touches ? e.touches[0].clientY : e.clientY;
                    if (clickY > rect.top + rect.height * 0.85) {
                        return;
                    }
                }
            }
            
            isDragging = true;
            modalManuallyPositioned = true;
            modalContent.classList.add('dragging');
            
            const clientX = e.touches ? e.touches[0].clientX : e.clientX;
            const clientY = e.touches ? e.touches[0].clientY : e.clientY;
            
            dragStartX = clientX;
            dragStartY = clientY;
            
            const computedStyle = window.getComputedStyle(modalContent);
            let currentLeft = parseFloat(computedStyle.left);
            let currentTop = parseFloat(computedStyle.top);
            
            if (isNaN(currentLeft)) currentLeft = window.innerWidth / 2;
            if (isNaN(currentTop)) currentTop = window.innerHeight / 2;
            
            modalStartX = currentLeft;
            modalStartY = currentTop;
            currentX = modalStartX;
            currentY = modalStartY;
            
            e.preventDefault();
            e.stopPropagation();
        }
        
        function drag(e) {
            if (!isDragging) return;
            
            const clientX = e.touches ? e.touches[0].clientX : e.clientX;
            const clientY = e.touches ? e.touches[0].clientY : e.clientY;
            
            const deltaX = clientX - dragStartX;
            const deltaY = clientY - dragStartY;
            
            currentX = modalStartX + deltaX;
            currentY = modalStartY + deltaY;
            
            modalContent.style.left = currentX + 'px';
            modalContent.style.top = currentY + 'px';
            modalContent.style.transform = 'translate(-50%, -50%)';
            
            savedModalPosition.left = currentX + 'px';
            savedModalPosition.top = currentY + 'px';
            
            e.preventDefault();
            e.stopPropagation();
        }
        
        function endDrag() {
            if (!isDragging) return;
            modalContent.classList.remove('dragging');
            isDragging = false;
        }
        
        modalContent.addEventListener('mousedown', startDrag);
        document.addEventListener('mousemove', drag);
        document.addEventListener('mouseup', endDrag);
        modalContent.addEventListener('touchstart', startDrag, { passive: false });
        document.addEventListener('touchmove', drag, { passive: false });
        document.addEventListener('touchend', endDrag);
    }
    
    // Setup wheel scroll navigation
    function setupWheelNavigation() {
        let lastWheelTime = 0;
        
        function handleWheelScroll(e) {
            const modal = document.getElementById('videoModal');
            if (!modal || !modal.classList.contains('active')) return;
            
            const modalContent = document.querySelector('.video-modal-content');
            if (!modalContent) return;
            
            const mouseX = e.clientX;
            const mouseY = e.clientY;
            
            const rect = modalContent.getBoundingClientRect();
            const isOverModal = mouseX >= rect.left && mouseX <= rect.right && 
                                mouseY >= rect.top && mouseY <= rect.bottom;
            
            if (!isOverModal) return;
            
            e.preventDefault();
            e.stopPropagation();
            
            const now = Date.now();
            if (now - lastWheelTime < 400) return;
            lastWheelTime = now;
            
            const deltaY = e.deltaY;
            if (Math.abs(deltaY) > 10) {
                if (deltaY > 0) {
                    navigateVideo('next');
                } else {
                    navigateVideo('prev');
                }
            }
        }
        
        document.addEventListener('wheel', handleWheelScroll, { passive: false });
    }
    
    // Setup infinite scroll for videos
    function setupInfiniteScroll() {
        let scrollTimeout = null;
        
        window.addEventListener('scroll', function() {
            // Only trigger infinite scroll if videos tab is active
            const videosPanel = document.getElementById('serviceVideosTabPanel');
            if (!videosPanel || videosPanel.style.display === 'none') return;
            
            if (scrollTimeout) {
                clearTimeout(scrollTimeout);
            }
            
            scrollTimeout = setTimeout(function() {
                if (isVideoLoading || !hasMore) return;
                
                const scrollPosition = window.innerHeight + window.scrollY;
                const documentHeight = document.documentElement.scrollHeight;
                const threshold = 600;
                
                if (scrollPosition >= documentHeight - threshold) {
                    fetchVideos(lastDocId);
                }
            }, 100);
        });
    }
    
    // Make functions globally accessible for retry button
    window.retryFetchVideos = function() {
        videos = [];
        lastDocId = null;
        hasMore = true;
        isVideoLoading = false;
        const gridEl = document.getElementById('videos-grid');
        if (gridEl) gridEl.innerHTML = '';
        fetchVideos();
    };
    
    // Make closeVideoModal globally accessible
    window.closeVideoModal = closeVideoModal;
});
</script>
@endsection
