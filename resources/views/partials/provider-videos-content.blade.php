{{-- 
    Provider Videos Tab Content Partial
    This partial is included in provider-services.blade.php for the tab-based view
    It uses providerData and companyUserName variables from the parent scope
--}}

<!-- Videos Loading State -->
<div id="videos-loading" class="videos-loading" style="display: none;">
    <div class="videos-spinner"></div>
    <p>Loading videos...</p>
</div>

<!-- Videos Error State -->
<div id="videos-error" class="videos-error" style="display: none;">
    <div class="videos-error-icon">
        <i class="fas fa-exclamation-circle"></i>
    </div>
    <h3>Oops! Something went wrong</h3>
    <p id="videos-error-message">Failed to load videos. Please try again later.</p>
    <button class="videos-retry-btn" onclick="window.retryFetchVideos()">Try Again</button>
</div>

<!-- Videos Empty State -->
<div id="videos-empty" class="videos-empty" style="display: none;">
    <div class="videos-empty-icon">
        <i class="fas fa-video-slash"></i>
    </div>
    <h3>No videos found</h3>
    <p>There are no videos available at the moment.</p>
</div>

<!-- Videos Grid -->
<div id="videos-grid" class="videos-grid" style="display: none;"></div>

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
