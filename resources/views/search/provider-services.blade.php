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
                <div id="providerLoading" class="services-text-center services-py-4" style="display: block;">
                    <p>Loading provider information...</p>
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
                                    <img src="images/images/share-icon.svg" alt="Location" width="25" height="25">
                                </button>
                                <button class="desktop-control-btn heart-btn" aria-label="Favorite">
                                    <img src="images/images/si_heart-line.svg" alt="Location" width="25" height="25">
                                </button>
                            </div>
                    </div>
                    @php
                        $defaultImage = asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg');
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
                                <img src="images/images/share-icon.svg" alt="Location" width="25" height="25">
                            </button>
                            <button class="carousel-btn-mobile heart-btn" aria-label="Favorite">
                                <img src="images/images/si_heart-line.svg" alt="Location" width="25" height="25">
                            </button>
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
            <a href="{{ url()->current() }}" class="view-tab active" id="listTabLink" data-view="list">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 5H17.5M2.5 10H17.5M2.5 15H17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M2.5 2.5H5.83333V5H2.5V2.5Z" fill="currentColor"/>
                </svg>
                <span>Service List</span>
            </a>
            <a href="{{ $companyUserName ? '/' . $companyUserName . '/videos' : '#' }}" class="view-tab" id="videosTabLink" data-view="videos">
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
                    <img src="images/images/iconoir_clock.svg" alt="Location" width="24" height="24">
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
<link rel="stylesheet" href="{{ asset('css/provider-services.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
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
    
    // Default image
    const defaultImage = '{{ asset("/images/adam-winger-FkAZqQJTbXM-unsplash.jpg") }}';
    
    // Set videos tab link immediately if username is available
    const videosTabLink = document.getElementById('videosTabLink');
    if (videosTabLink && companyUserName) {
        videosTabLink.href = `/${encodeURIComponent(companyUserName)}/videos`;
    }
    
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
        if (loadingEl) loadingEl.style.display = 'block';
        if (errorEl) errorEl.style.display = 'none';
        if (contentEl) contentEl.style.display = 'none';
        
        try {
            // Try to fetch by username first, then by providerId
            let apiUrl;
            if (companyUserName) {
                // Fetch all providers and filter by username (API might not support username parameter directly)
                apiUrl = 'https://us-central1-beauty-984c8.cloudfunctions.net/searchProviders';
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
            
            // If searching by username, filter the results
            if (companyUserName && providers.length > 0) {
                providers = providers.filter(p => 
                    (p.username && p.username.toLowerCase() === companyUserName.toLowerCase()) ||
                    (p.companyUserName && p.companyUserName.toLowerCase() === companyUserName.toLowerCase())
                );
            }
            
            if (providers.length === 0) {
                throw new Error('Provider not found');
            }
            
            // Extract provider from array (API returns array with single provider or filtered results)
            providerData = providers[0];
            
            // Hide loading, show content
            if (loadingEl) loadingEl.style.display = 'none';
            if (contentEl) contentEl.style.display = 'block';
            
            // Render provider data
            renderProviderData(providerData);
            
            return providerData;
            
        } catch (error) {
            console.error('Error fetching provider data:', error);
            
            // Try server-side fallback
            try {
                let fallbackUrl = '{{ route('search.provider.fallback') }}?';
                if (companyUserName) {
                    fallbackUrl += `username=${encodeURIComponent(companyUserName)}`;
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
                <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
                <img src="images/images/star_cards.svg" alt="Location" width="14" height="14">
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
                <img src="images/images/mage_map-marker-fill.svg" alt="Location" width="18" height="18">
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
        
        // Update videos tab link - use providerData username if available, otherwise keep the one set initially
        const videosTabLink = document.getElementById('videosTabLink');
        if (videosTabLink && providerData) {
            const username = providerData.username || providerData.companyUserName;
            if (username) {
                videosTabLink.href = `/${encodeURIComponent(username)}/videos`;
            } else if (providerData.id) {
                // Fallback to old format if username not available
                videosTabLink.href = `{{ route('search.videos.provider') }}?provider_id=${encodeURIComponent(providerData.id)}`;
            }
        } else if (videosTabLink && companyUserName && !videosTabLink.href || videosTabLink.href === '#') {
            // Ensure link is set even if providerData hasn't loaded yet
            videosTabLink.href = `/${encodeURIComponent(companyUserName)}/videos`;
        }
        
        // Update list tab link to current URL
        const listTabLink = document.getElementById('listTabLink');
        if (listTabLink) {
            listTabLink.href = window.location.pathname;
        }
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
        
        const defaultImage = '{{ asset("/images/adam-winger-FkAZqQJTbXM-unsplash.jpg") }}';
        // Get provider ID from providerData if available, otherwise from server
        const providerId = (providerData && providerData.id) ? providerData.id : '{{ $providerId ?? "" }}';
        
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
            
            // Build services HTML for this subcategory
            const servicesHTML = services.map(service => {
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
            }).join('');
            
            if (isNoSubcategory) {
                // Services without subcategory - render directly
                subcategorySectionsHTML += servicesHTML;
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
