@extends('layouts.mainInnerPages')

@section('title', 'Provider Videos')

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
                                                <img src="{{ asset('images/images/Vector.svg') }}" alt="Search" width="32" height="32" aria-hidden="true">
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
                                                <img src="{{ asset('images/images/mage_map-marker-fill.svg') }}" alt="Location" width="32" height="32" aria-hidden="true">
                                            </div>
                                            <div class="search-content">
                                                <h3 class="search-title">{{ __('app.home.search_or_text') ?? 'Location' }}</h3>
                                                <input type="text" class="searchInput" id="locationInput" name="location" placeholder="{{ __('app.home.search_location_placeholder') }}" value="{{ $location ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="divider"></div>

                                        <button type="submit" class="btn-primary" style="margin-left: auto;">
                                            {{ __('app.home.search_button') }}
                                            <img src="{{ asset('images/images/Arrow_Right.svg') }}" alt="" width="16" height="16">
                                        </button>
                                    </div>
                                </form>
                            </div>
        </div>

    {{-- search bar end --}}
    <!-- Page Header End -->
     <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>

<!-- Videos Section Start -->
<div class="search-results" style="margin: 0 0 50px 0;">
    <div class="container">
                            <div class="service-filter-pills" role="tablist" aria-label="Service categories" id="categoryFilterPills">
                                <button type="button" class="filter-pill active" data-category="all" aria-current="true">All</button>
                                {{-- Categories will be loaded via JavaScript from API --}}
                            </div>

    <!-- View Type Tabs Section Start -->
    <div class="view-type-tabs-container" style="margin-top: 20px;">
        <div class="view-type-tabs">
            <a href="#" class="view-tab" id="listTabLink" data-view="list">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 5H17.5M2.5 10H17.5M2.5 15H17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M2.5 2.5H5.83333V5H2.5V2.5Z" fill="currentColor"/>
                </svg>
                <span>Salon List</span>
            </a>
            <a href="{{ url()->current() }}" class="view-tab active" id="videosTabLink" data-view="videos">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2.5" y="4.16667" width="15" height="11.6667" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M8.33333 7.5L13.3333 10L8.33333 12.5V7.5Z" fill="currentColor"/>
                </svg>
                <span>Salon Videos</span>
            </a>
        </div>
    </div>
    <!-- View Type Tabs Section End -->

        <!-- Loading State -->
        <div id="videos-loading" class="videos-loading">
            <div class="videos-spinner"></div>
            <p>Loading videos...</p>
        </div>

        <!-- Error State -->
        <div id="videos-error" class="videos-error" style="display: none;">
            <div class="videos-error-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <h3>Oops! Something went wrong</h3>
            <p id="videos-error-message">Failed to load videos. Please try again later.</p>
            <button class="videos-retry-btn" onclick="fetchVideos()">Try Again</button>
        </div>

        <!-- Empty State -->
        <div id="videos-empty" class="videos-empty" style="display: none;">
            <div class="videos-empty-icon">
                <i class="fas fa-video-slash"></i>
            </div>
            <h3>No videos found</h3>
            <p>There are no videos available at the moment.</p>
        </div>

        <!-- Videos Grid -->
        <div id="videos-grid" class="videos-grid" style="display: none;"></div>
    </div>
</div>
<!-- Videos Section End -->

<!-- Video Popup Modal -->
<div id="videoModal" class="video-modal">
    <div class="video-modal-content">
        <!-- Video Player with Overlays -->
        <div class="video-modal-player">
            <video id="modalVideo" controls>
                Your browser does not support the video tag.
            </video>
            
            <!-- Close Button (Top Left) -->
            <button class="video-modal-close" id="videoModalCloseBtn" aria-label="Close">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 5L5 15M5 5L15 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            
            <!-- Navigation Arrows (Right Middle) -->
            <div class="video-modal-navigation">
                <button class="video-nav-btn video-nav-up" id="videoNavUpBtn" aria-label="Previous Video">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12.5L10 7.5L15 12.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <button class="video-nav-btn video-nav-down" id="videoNavDownBtn" aria-label="Next Video">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 7.5L10 12.5L15 7.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            
            <!-- User Info Overlay (Bottom Left) -->
            <div class="video-modal-user-overlay">
                <img id="modalUserImage" src="" alt="User" class="video-modal-user-image">
                <div class="video-modal-user-text">
                    <div class="video-modal-username" id="modalUsername"></div>
                    <div class="video-modal-hashtags" id="modalHashtags"></div>
                </div>
                <a id="modalBookingBtn" href="#" class="video-modal-booking-btn">
                    RÉSERVER
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
<link rel="stylesheet" href="{{ asset('css/specific-provider-videos.css') }}">
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Fetch categories from API and display them
  fetchAndDisplayCategories();

  // Video functionality
  let videos = [];
  let lastDocId = null;
  let hasMore = true;
  let isLoading = false;
  let currentVideoIndex = -1;
  const defaultThumbnail = '{{ asset("images/images/default-video-thumbnail.jpg") }}';
  const defaultUserImage = '{{ asset("images/adam-winger-FkAZqQJTbXM-unsplash.jpg") }}';
  // Get username from URL path or provider_id from server (for backward compatibility)
  const companyUserNameFromServer = '{{ $companyUserName ?? "" }}';
  const pathParts = window.location.pathname.split('/').filter(part => part);
  const companyUserName = companyUserNameFromServer || (pathParts.length > 0 && pathParts[pathParts.length - 1] !== 'videos' ? pathParts[pathParts.length - 1] : pathParts[pathParts.length - 2]) || '';
  const providerIdFromServer = '{{ $providerId ?? "" }}';
  
  // Will be set after fetching provider data
  let providerId = providerIdFromServer;
  let providerData = null;

  // Fetch provider data if username is available
  if (companyUserName && !providerId) {
    fetchProviderDataByUsername(companyUserName).then(() => {
      // After provider data is loaded, fetch videos using companyUserName
      fetchVideos();
    }).catch((error) => {
      console.error('Failed to load provider data:', error);
      // Still try to fetch videos using companyUserName from URL
      if (companyUserName) {
        fetchVideos();
      }
    });
  } else if (companyUserName) {
    // If companyUserName is available, fetch videos directly using it
    fetchVideos();
  } else if (providerId) {
    // Fallback: If providerId is available but no username, fetch videos using providerId
    fetchVideos();
  }

  // Fetch provider data by username
  async function fetchProviderDataByUsername(username) {
    try {
      // Fetch all providers and filter by username
      const apiUrl = 'https://us-central1-beauty-984c8.cloudfunctions.net/searchProviders';
      const response = await fetch(apiUrl);
      
      if (!response.ok) {
        throw new Error('Failed to fetch provider data');
      }
      
      let providers = await response.json();
      
      if (!Array.isArray(providers)) {
        throw new Error('Invalid response format');
      }
      
      // Filter by username
      providers = providers.filter(p => 
        (p.username && p.username.toLowerCase() === username.toLowerCase()) ||
        (p.companyUserName && p.companyUserName.toLowerCase() === username.toLowerCase())
      );
      
      if (providers.length === 0) {
        throw new Error('Provider not found');
      }
      
      providerData = providers[0];
      providerId = providerData.id;
      
      // Update links
      updateLinks();
      
      return providerData;
    } catch (error) {
      console.error('Error fetching provider data:', error);
      throw error;
    }
  }

  // Update navigation links
  function updateLinks() {
    if (!providerData) return;
    
    const username = providerData.username || providerData.companyUserName;
    const listTabLink = document.getElementById('listTabLink');
    const videosTabLink = document.getElementById('videosTabLink');
    
    if (username) {
      if (listTabLink) listTabLink.href = `/${encodeURIComponent(username)}`;
      if (videosTabLink) videosTabLink.href = `/${encodeURIComponent(username)}/videos`;
    } else if (providerId) {
      // Fallback to old format
      if (listTabLink) listTabLink.href = `/search?provider_id=${encodeURIComponent(providerId)}`;
      if (videosTabLink) videosTabLink.href = `{{ route('search.videos.provider') }}?provider_id=${encodeURIComponent(providerId)}`;
    }
  }

  // Drag functionality
  let isDragging = false;
  let dragStartX = 0;
  let dragStartY = 0;
  let modalStartX = 0;
  let modalStartY = 0;
  let currentX = 0;
  let currentY = 0;

  // Fetch videos from API
  async function fetchVideos(lastDocIdParam = null) {
    if (isLoading) return;
    
    isLoading = true;
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
      
      if (username) {
        params.append('companyUserName', username);
      } else if (providerId) {
        // Fallback to serviceProviderId if username not available
        params.append('serviceProviderId', providerId);
      }
      
      // Add lastDocId for pagination if provided
      if (lastDocIdParam) {
        params.append('lastDocId', lastDocIdParam);
      }
      
      // Append query string if we have any parameters
      if (params.toString()) {
        apiUrl += '?' + params.toString();
      }
      
      const response = await fetch(apiUrl);
      
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      
      const data = await response.json();
      
      if (loadingEl) loadingEl.style.display = 'none';
      
      if (!data.videos || !Array.isArray(data.videos) || data.videos.length === 0) {
        if (videos.length === 0) {
          if (emptyEl) emptyEl.style.display = 'flex';
        }
        hasMore = false;
        isLoading = false;
        return;
      }
      
      // Update pagination info
      if (data.pagination) {
        hasMore = data.pagination.hasMore === true;
        lastDocId = data.pagination.lastDocId || null;
      }
      
      // Append new videos
      videos = [...videos, ...data.videos];
      
      // Render videos
      renderVideos(data.videos);
      
      if (gridEl) gridEl.style.display = 'grid';
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
      isLoading = false;
    }
  }

  // Render video cards
  function renderVideos(videosArray) {
    const gridEl = document.getElementById('videos-grid');
    if (!gridEl) return;
    
    videosArray.forEach(video => {
      const videoCard = createVideoCard(video);
      gridEl.appendChild(videoCard);
    });
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
    const videoUrl = video.videoUrl || '';
    const serviceProviderId = video.serviceProviderId || '';
    
    card.innerHTML = `
      <div class="video-thumbnail-container">
        <img src="${escapeHtml(thumbnail)}" 
             alt="Video thumbnail" 
             class="video-thumbnail"
             onerror="this.src='${defaultThumbnail}'">
        <div class="video-play-overlay">
          <div class="video-play-icon"></div>
        </div>
        <div class="video-user-info">
          <img src="${escapeHtml(userImage)}" 
               alt="${escapeHtml(username)}" 
               class="video-user-image"
               onerror="this.src='${defaultUserImage}'">
          <div class="video-user-text">
            <div class="video-username-overlay">${escapeHtml(username)}</div>
            ${hashtags ? `<div class="video-hashtags-overlay">${escapeHtml(hashtags)}</div>` : ''}
          </div>
        </div>
      </div>
    `;
    
    // Add click handler to open modal
    card.addEventListener('click', function() {
      const videoIndex = videos.findIndex(v => v.id === video.id);
      openVideoModal(video, videoIndex);
    });
    
    return card;
  }

  // Escape HTML to prevent XSS
  function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  // Open video modal
  function openVideoModal(video, videoIndex = -1) {
    const modal = document.getElementById('videoModal');
    const modalContent = document.querySelector('.video-modal-content');
    const modalVideo = document.getElementById('modalVideo');
    const modalUserImage = document.getElementById('modalUserImage');
    const modalUsername = document.getElementById('modalUsername');
    const modalHashtags = document.getElementById('modalHashtags');
    const bookingBtn = document.getElementById('modalBookingBtn');
    
    if (!modal) return;
    
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
    
    // Set booking button link with service ID
    if (bookingBtn && video.serviceProviderId && video.serviceId) {
      bookingBtn.href = '/book-appointment?serviceId=' + encodeURIComponent(video.serviceId) + '&service_provider_id=' + encodeURIComponent(video.serviceProviderId);
    } else if (bookingBtn && video.serviceProviderId) {
      // Use companyUserName from video data if available, otherwise fallback to provider_id
      if (video.companyUserName) {
        bookingBtn.href = `/${encodeURIComponent(video.companyUserName)}`;
      } else if (providerData && (providerData.username || providerData.companyUserName)) {
        const username = providerData.username || providerData.companyUserName;
        bookingBtn.href = `/${encodeURIComponent(username)}`;
      } else {
        // Fallback to old format if username not available
        bookingBtn.href = '/search?provider_id=' + encodeURIComponent(video.serviceProviderId);
      }
    }
    
    // Only reset modal position if opening a NEW video (not navigating)
    // Check if this is a new video by comparing video IDs
    const currentVideoId = modalVideo ? modalVideo.getAttribute('data-video-id') : null;
    const newVideoId = video.id || '';
    
    if (modalContent) {
      if (!modalManuallyPositioned || currentVideoId !== newVideoId) {
        // Reset to center for new videos
        modalContent.style.transform = 'translate(-50%, -50%)';
        modalContent.style.top = '50%';
        modalContent.style.left = '50%';
        modalManuallyPositioned = false;
        savedModalPosition = { left: null, top: null };
      } else {
        // Preserve position when navigating between videos if already positioned
        restoreModalPosition();
      }
    }
    
    // Update navigation buttons
    updateNavigationButtons();
    
    // Show modal
    modal.classList.add('active');
    // Don't prevent background scrolling - allow users to scroll video list
    
    // Play video
    if (modalVideo) {
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
      if (newIndex < 0) return; // Already at first video
    } else if (direction === 'next') {
      newIndex = currentVideoIndex + 1;
      if (newIndex >= videos.length) return; // Already at last video
    }
    
    if (newIndex >= 0 && newIndex < videos.length) {
      openVideoModal(videos[newIndex], newIndex);
    }
  }

  // Track if mouse is over video modal for touchpad scroll
  let isMouseOverModal = false;
  let scrollCooldown = false;

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
    
    // Reset drag state
    isDragging = false;
    if (modalContent) {
      modalContent.classList.remove('dragging');
    }
  }

  // Drag functionality
  function startDrag(e) {
    const modal = document.getElementById('videoModal');
    if (!modal || !modal.classList.contains('active')) return;
    
    const modalContent = document.querySelector('.video-modal-content');
    if (!modalContent) return;
    
    // Don't start drag if clicking on buttons or links
    const target = e.target;
    if (target.closest('button, a, .video-modal-close, .video-nav-btn, .video-modal-booking-btn')) {
      return;
    }
    
    // Allow dragging from video area, but check if clicking on video controls
    if (target.tagName === 'VIDEO' || target.closest('video')) {
      const video = document.getElementById('modalVideo');
      if (video) {
        const rect = video.getBoundingClientRect();
        const clickY = e.touches ? e.touches[0].clientY : e.clientY;
        // If clicking in bottom 15% of video (where controls usually are), don't drag
        if (clickY > rect.top + rect.height * 0.85) {
          return;
        }
      }
    }
    
    isDragging = true;
    modalManuallyPositioned = true; // Mark that modal has been manually positioned
    modalContent.classList.add('dragging');
    
    // Save initial position
    saveModalPosition();
    
    // Get initial touch/mouse position
    const clientX = e.touches ? e.touches[0].clientX : e.clientX;
    const clientY = e.touches ? e.touches[0].clientY : e.clientY;
    
    dragStartX = clientX;
    dragStartY = clientY;
    
    // Get current modal position from computed style
    const computedStyle = window.getComputedStyle(modalContent);
    let currentLeft = parseFloat(computedStyle.left);
    let currentTop = parseFloat(computedStyle.top);
    
    // If not set, use center of screen
    if (isNaN(currentLeft)) {
      currentLeft = window.innerWidth / 2;
    }
    if (isNaN(currentTop)) {
      currentTop = window.innerHeight / 2;
    }
    
    modalStartX = currentLeft;
    modalStartY = currentTop;
    
    currentX = modalStartX;
    currentY = modalStartY;
    
    // Prevent default to avoid text selection and scrolling
    e.preventDefault();
    e.stopPropagation();
  }

  function drag(e) {
    if (!isDragging) return;
    
    const modalContent = document.querySelector('.video-modal-content');
    if (!modalContent) return;
    
    // Get current touch/mouse position
    const clientX = e.touches ? e.touches[0].clientX : e.clientX;
    const clientY = e.touches ? e.touches[0].clientY : e.clientY;
    
    // Calculate new position
    const deltaX = clientX - dragStartX;
    const deltaY = clientY - dragStartY;
    
    currentX = modalStartX + deltaX;
    currentY = modalStartY + deltaY;
    
    // Update modal position - fully draggable across entire screen
    modalContent.style.left = currentX + 'px';
    modalContent.style.top = currentY + 'px';
    modalContent.style.transform = 'translate(-50%, -50%)';
    
    // Save position continuously while dragging
    savedModalPosition.left = currentX + 'px';
    savedModalPosition.top = currentY + 'px';
    
    e.preventDefault();
    e.stopPropagation();
  }

  function endDrag() {
    if (!isDragging) return;
    
    const modalContent = document.querySelector('.video-modal-content');
    if (modalContent) {
      modalContent.classList.remove('dragging');
      // Save final position
      saveModalPosition();
    }
    
    isDragging = false;
  }

  // Handle RÉSERVER button click - close modal and redirect
  function handleReserverClick(event) {
    event.preventDefault();
    const bookingBtn = event.currentTarget;
    const url = bookingBtn.href;
    
    // Close modal first
    closeVideoModal();
    
    // Redirect after a short delay to allow modal to close
    setTimeout(function() {
      if (url && url !== '#') {
        window.location.href = url;
      }
    }, 100);
  }

  // Make functions globally accessible
  window.closeVideoModal = closeVideoModal;
  window.navigateVideo = navigateVideo;
  window.handleReserverClick = handleReserverClick;

  // Attach event listeners to buttons
  const closeBtn = document.getElementById('videoModalCloseBtn');
  if (closeBtn) {
    closeBtn.addEventListener('click', closeVideoModal);
  }

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

  const bookingBtn = document.getElementById('modalBookingBtn');
  if (bookingBtn) {
    bookingBtn.addEventListener('click', handleReserverClick);
  }

  // Attach drag event listeners - use direct attachment when modal is active
  function attachDragListeners() {
    const modalContent = document.querySelector('.video-modal-content');
    if (!modalContent) return;
    
    // Remove existing listeners to avoid duplicates
    modalContent.removeEventListener('mousedown', startDrag);
    document.removeEventListener('mousemove', drag);
    document.removeEventListener('mouseup', endDrag);
    modalContent.removeEventListener('touchstart', startDrag);
    document.removeEventListener('touchmove', drag);
    document.removeEventListener('touchend', endDrag);
    
    // Add new listeners
    modalContent.addEventListener('mousedown', startDrag);
    document.addEventListener('mousemove', drag);
    document.addEventListener('mouseup', endDrag);
    
    modalContent.addEventListener('touchstart', startDrag, { passive: false });
    document.addEventListener('touchmove', drag, { passive: false });
    document.addEventListener('touchend', endDrag);
  }
  
  // Attach listeners when modal opens
  const originalOpenVideoModal = openVideoModal;
  openVideoModal = function(video, videoIndex) {
    originalOpenVideoModal(video, videoIndex);
    setTimeout(function() {
      attachDragListeners();
      attachScrollNavigation();
    }, 100);
  };
  
  // Also attach on page load if modal exists
  attachDragListeners();
  attachScrollNavigation();

  // Touchpad scroll navigation for video modal
  function attachScrollNavigation() {
    const modalContent = document.querySelector('.video-modal-content');
    if (!modalContent) return;
    
    // Track mouse enter/leave on modal
    modalContent.addEventListener('mouseenter', function() {
      isMouseOverModal = true;
    });
    
    modalContent.addEventListener('mouseleave', function() {
      isMouseOverModal = false;
    });
  }

  // Handle wheel/touchpad scroll on video modal
  let wheelTimeout = null;
  let lastWheelTime = 0;
  
  function handleWheelScroll(e) {
    const modal = document.getElementById('videoModal');
    if (!modal || !modal.classList.contains('active')) return;
    
    // Check if mouse is over modal content
    const modalContent = document.querySelector('.video-modal-content');
    if (!modalContent) return;
    
    // Get mouse position from the event (wheel events have clientX/Y)
    const mouseX = e.clientX !== undefined ? e.clientX : (window.mouseX || 0);
    const mouseY = e.clientY !== undefined ? e.clientY : (window.mouseY || 0);
    
    // If clientX/Y not available, use the last known mouse position
    if (mouseX === 0 && mouseY === 0) {
      // Fallback: check if we're currently over the modal using isMouseOverModal
      if (!isMouseOverModal) return;
    } else {
      // Check if mouse is within modal bounds
      const rect = modalContent.getBoundingClientRect();
      const isOverModal = mouseX >= rect.left && mouseX <= rect.right && 
                          mouseY >= rect.top && mouseY <= rect.bottom;
      
      if (!isOverModal) return;
    }
    
    // Prevent default scroll behavior when over modal
    e.preventDefault();
    e.stopPropagation();
    
    // Throttle to prevent too rapid navigation (minimum 400ms between navigations)
    const now = Date.now();
    if (now - lastWheelTime < 400) {
      return;
    }
    lastWheelTime = now;
    
    // Determine scroll direction
    const deltaY = e.deltaY;
    
    // Use a threshold to avoid accidental small scrolls
    if (Math.abs(deltaY) > 10) {
      if (deltaY > 0) {
        // Scrolling down - next video
        navigateVideo('next');
      } else {
        // Scrolling up - previous video
        navigateVideo('prev');
      }
    }
  }
  
  // Track mouse position globally for wheel events
  document.addEventListener('mousemove', function(e) {
    window.mouseX = e.clientX;
    window.mouseY = e.clientY;
  });
  
  // Attach wheel event listener
  document.addEventListener('wheel', handleWheelScroll, { passive: false });


  // Store if modal has been manually positioned (dragged)
  let modalManuallyPositioned = false;
  let savedModalPosition = { left: null, top: null };

  // Save modal position when it's dragged
  function saveModalPosition() {
    const modalContent = document.querySelector('.video-modal-content');
    if (modalContent && modalManuallyPositioned) {
      const computedStyle = window.getComputedStyle(modalContent);
      savedModalPosition.left = computedStyle.left;
      savedModalPosition.top = computedStyle.top;
    }
  }

  // Restore modal position after scroll or resize
  function restoreModalPosition() {
    const modalContent = document.querySelector('.video-modal-content');
    const modal = document.getElementById('videoModal');
    if (modal && modal.classList.contains('active') && modalContent && modalManuallyPositioned) {
      if (savedModalPosition.left && savedModalPosition.top) {
        // Use requestAnimationFrame to ensure it happens after any layout recalculation
        requestAnimationFrame(function() {
          const modalContent = document.querySelector('.video-modal-content');
          const modal = document.getElementById('videoModal');
          if (modal && modal.classList.contains('active') && modalContent && modalManuallyPositioned) {
            modalContent.style.left = savedModalPosition.left;
            modalContent.style.top = savedModalPosition.top;
            modalContent.style.transform = 'translate(-50%, -50%)';
          }
        });
      }
    }
  }
  
  // Continuously monitor and maintain position if manually positioned
  function maintainModalPosition() {
    if (!modalManuallyPositioned) return;
    
    const modalContent = document.querySelector('.video-modal-content');
    const modal = document.getElementById('videoModal');
    if (modal && modal.classList.contains('active') && modalContent) {
      const computedStyle = window.getComputedStyle(modalContent);
      const currentLeft = computedStyle.left;
      const currentTop = computedStyle.top;
      
      // If position has been reset to percentage values, restore pixel values
      if (savedModalPosition.left && savedModalPosition.top) {
        if (currentLeft !== savedModalPosition.left || currentTop !== savedModalPosition.top) {
          if (currentLeft.includes('%') || currentTop.includes('%')) {
            // Position was reset, restore it
            modalContent.style.left = savedModalPosition.left;
            modalContent.style.top = savedModalPosition.top;
            modalContent.style.transform = 'translate(-50%, -50%)';
          }
        }
      }
    }
  }
  
  // Monitor position periodically to catch any resets
  setInterval(maintainModalPosition, 50);

  // Handle window resize - preserve position if manually positioned
  window.addEventListener('resize', function() {
    if (!isDragging) {
      if (modalManuallyPositioned) {
        // Restore saved position after resize
        setTimeout(restoreModalPosition, 0);
      } else {
        const modalContent = document.querySelector('.video-modal-content');
        const modal = document.getElementById('videoModal');
        if (modal && modal.classList.contains('active') && modalContent) {
          // Only reset to center if it hasn't been dragged
          modalContent.style.left = '50%';
          modalContent.style.top = '50%';
          modalContent.style.transform = 'translate(-50%, -50%)';
        }
      }
    }
  });

  // Handle scroll - preserve modal position using requestAnimationFrame for smooth updates
  let scrollRAF = null;
  window.addEventListener('scroll', function() {
    if (scrollRAF) {
      cancelAnimationFrame(scrollRAF);
    }
    
    scrollRAF = requestAnimationFrame(function() {
      if (modalManuallyPositioned && !isDragging) {
        const modalContent = document.querySelector('.video-modal-content');
        const modal = document.getElementById('videoModal');
        if (modal && modal.classList.contains('active') && modalContent) {
          // Force maintain the saved position
          if (savedModalPosition.left && savedModalPosition.top) {
            modalContent.style.left = savedModalPosition.left;
            modalContent.style.top = savedModalPosition.top;
            modalContent.style.transform = 'translate(-50%, -50%)';
          }
        }
      }
    });
  }, { passive: true });

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

  // Infinite scroll
  let scrollTimeout = null;
  window.addEventListener('scroll', function() {
    if (scrollTimeout) {
      clearTimeout(scrollTimeout);
    }
    
    scrollTimeout = setTimeout(function() {
      if (isLoading || !hasMore) return;
      
      const scrollPosition = window.innerHeight + window.scrollY;
      const documentHeight = document.documentElement.scrollHeight;
      const threshold = 600; // Load when 200px from bottom
      
      if (scrollPosition >= documentHeight - threshold) {
        fetchVideos(lastDocId);
      }
    }, 100);
  });

  // Make fetchVideos available globally for retry button
  window.fetchVideos = function() {
    videos = [];
    lastDocId = null;
    hasMore = true;
    const gridEl = document.getElementById('videos-grid');
    if (gridEl) gridEl.innerHTML = '';
    fetchVideos();
  };

  // Note: Initial fetch is handled by the conditional logic above (lines 213-231)
  // No need to call fetchVideos() here to avoid duplicate API calls
  
  // Search autocomplete functionality (same as provider-results)
  const searchInput = document.getElementById('searchInput');
  const suggestionsDropdown = document.getElementById('searchSuggestionsDropdown');

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
  let debounceTimer = null;
  let currentSuggestions = { providers: [], services: [] };
  let selectedIndex = -1;
  let allSuggestions = [];

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
        const providerHeading = document.createElement('div');
        providerHeading.className = 'search-suggestion-heading';
        providerHeading.textContent = 'Salon';
        suggestionsDropdown.appendChild(providerHeading);
        
        providers.forEach((provider) => {
          const item = createSuggestionItem(provider.name, 'provider', provider.id);
          suggestionsDropdown.appendChild(item);
          allSuggestions.push({ element: item, name: provider.name, type: 'provider', id: provider.id });
        });
      }

      // Display Services section
      if (services && services.length > 0) {
        hasContent = true;
        if (providers && providers.length > 0) {
          const divider = document.createElement('div');
          divider.className = 'search-suggestion-divider';
          suggestionsDropdown.appendChild(divider);
        }
        
        const serviceHeading = document.createElement('div');
        serviceHeading.className = 'search-suggestion-heading';
        serviceHeading.textContent = 'Services';
        suggestionsDropdown.appendChild(serviceHeading);
        
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
      
      let isFirstHover = true;
      
      item.addEventListener('mouseenter', () => {
        if (isFirstHover) {
          originalInputValue = searchInput.value;
          isFirstHover = false;
        }
        searchInput.value = name;
        const index = allSuggestions.findIndex(s => s.element === item);
        if (index !== -1) {
          setSelectedIndex(index);
        }
      });
      
      item.addEventListener('click', () => {
        searchInput.value = name;
        originalInputValue = name;
        hideSuggestions();
        searchInput.focus();
      });
      
      return item;
    }

    // Set selected index and update highlighting
    function setSelectedIndex(index) {
      if (selectedIndex >= 0 && allSuggestions[selectedIndex]) {
        allSuggestions[selectedIndex].element.classList.remove('selected');
      }
      
      selectedIndex = index;
      if (selectedIndex >= 0 && selectedIndex < allSuggestions.length) {
        allSuggestions[selectedIndex].element.classList.add('selected');
        searchInput.value = allSuggestions[selectedIndex].name;
        
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
            setSelectedIndex(0);
          }
          break;
          
        case 'ArrowUp':
          e.preventDefault();
          if (selectedIndex > 0) {
            setSelectedIndex(selectedIndex - 1);
          } else {
            setSelectedIndex(allSuggestions.length - 1);
          }
          break;
          
        case 'Enter':
          e.preventDefault();
          if (selectedIndex >= 0 && selectedIndex < allSuggestions.length) {
            const selected = allSuggestions[selectedIndex];
            searchInput.value = selected.name;
            originalInputValue = selected.name;
            hideSuggestions();
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

    // Hide suggestions when input loses focus
    searchInput.addEventListener('blur', () => {
      setTimeout(() => {
        hideSuggestions();
        toggleSearchTitle();
      }, 200);
    });
    
    // Initial check for existing value
    toggleSearchTitle();
  }

  // Location input field
  const locationInput = document.getElementById('locationInput');
  if (locationInput) {
    const locationTitle = locationInput.closest('.search-content')?.querySelector('.search-title');
    
    function toggleLocationTitle() {
      if (locationTitle) {
        if (locationInput.value.trim().length > 0 || document.activeElement === locationInput) {
          locationTitle.style.display = 'none';
        } else {
          locationTitle.style.display = '';
        }
      }
    }

    locationInput.addEventListener('input', () => {
      toggleLocationTitle();
    });

    locationInput.addEventListener('focus', () => {
      if (locationTitle) {
        locationTitle.style.display = 'none';
      }
    });

    locationInput.addEventListener('blur', () => {
      toggleLocationTitle();
    });
    
    toggleLocationTitle();

    // Hide suggestions on form submit
    const searchForm = searchInput.closest('form');
    if (searchForm) {
      searchForm.addEventListener('submit', () => {
        if (suggestionsDropdown) {
          suggestionsDropdown.classList.remove('show');
        }
      });
    }

    // Hide suggestions when clicking outside
    document.addEventListener('click', (e) => {
      if (searchInput && suggestionsDropdown && !searchInput.contains(e.target) && !suggestionsDropdown.contains(e.target)) {
        if (suggestionsDropdown) {
          suggestionsDropdown.classList.remove('show');
        }
      }
    });
  }
});
</script>
@endsection

