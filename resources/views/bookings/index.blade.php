@extends('layouts.mainInnerPages')
{{-- Title --}}
@section('title', __('app.bookings.title'))

{{-- Style Files --}}
@section('styles')
<link rel="stylesheet" href="{{ \App\Helpers\AssetHelper::versioned('css/my-bookings.css') }}">
@endsection


{{-- Content --}}
@section('content')
    <div class="account-layout">
        <div class="container">
            <div class="layout-grid">
                <!-- Sidebar -->
                <div class="account-sidebar">
                    <div class="sidebar-menu">
                        <div class="menu-group">
                            {{-- <h3 class="menu-title">{{ __('app.bookings.my_account') ?? 'My account' }}</h3> --}}
                            <ul class="menu-list">
                                <li>
                                    <a href="{{ route('my-bookings') }}" class="menu-link active">
                                        {{ __('app.bookings.my_appointments') ?? 'My appointments' }}
                                    </a>
                                </li>
                                {{-- <li>
                                    <a href="#" class="menu-link placeholder-link">
                                        {{ __('app.bookings.my_information') ?? 'My information' }}
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="menu-link placeholder-link">
                                        {{ __('app.bookings.my_loved_ones') ?? 'My loved ones' }}
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                        
                        <div class="menu-group">
                            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                                @csrf
                                <button type="submit" class="menu-link logout-btn">
                                    {{ __('app.bookings.log_out') ?? 'Log out' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="account-content">


                    <!-- Bookings Section -->
                    <div class="bookings-list-container">
                        <div class="content-header">
                            <h1>{{ __('app.bookings.my_past_appointments') ?? 'My past appointments' }}</h1>
                        </div>
                        <!-- Loading State -->
                        <div id="bookingsLoading" class="bookings-loading">
                            <div class="spinner"></div>
                            <p>{{ __('app.bookings.loading') }}</p>
                        </div>

                        <!-- Error State -->
                        <div id="bookingsError" class="bookings-error" style="display: none;">
                            <h3>{{ __('app.bookings.error_title') }}</h3>
                            <p>{{ __('app.bookings.error_desc') }}</p>
                        </div>

                        <!-- Empty State -->
                        <div id="bookingsEmpty" class="bookings-empty" style="display: none;">
                            <div class="bookings-empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3>{{ __('app.bookings.no_bookings') }}</h3>
                            <p>{{ __('app.bookings.no_bookings_desc') }}</p>
                            <a href="{{ url('/recherche') }}" class="btn-book-now">{{ __('app.bookings.book_now') }}</a>
                        </div>

                        <!-- Bookings List (populated by JavaScript) -->
                        <div id="bookingsGrid" class="bookings-list" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- Scripts --}}
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const firebaseUid = @json($firebaseUid ?? null);
    
    // DOM Elements
    const loadingEl = document.getElementById('bookingsLoading');
    const errorEl = document.getElementById('bookingsError');
    const emptyEl = document.getElementById('bookingsEmpty');
    const gridEl = document.getElementById('bookingsGrid');
    
    // Translation strings
    const translations = {
        totalAmount: @json(__('app.bookings.total_amount')),
        paid: @json(__('app.bookings.paid')),
        remaining: @json(__('app.bookings.remaining')),
        with: @json(__('app.bookings.with') ?? 'with'),
        statusCancelled: @json(__('app.bookings.status_cancelled')),
        
        // Status Translations
        statusUnknown: @json(__('app.bookings.status_unknown')),
        fullyPaid: @json(__('app.bookings.fully_paid')),
        statusPending: @json(__('app.bookings.status_pending')),
        statusInProgress: @json(__('app.bookings.status_in_progress')),
        statusBooked: @json(__('app.bookings.status_booked')),
        statusUpcoming: @json(__('app.bookings.status_upcoming')),
        statusPast: @json(__('app.bookings.status_past')),
        statusCompleted: @json(__('app.bookings.status_completed')),
        statusReviewed: @json(__('app.bookings.status_reviewed')),
        statusReceived: @json(__('app.bookings.status_received')),
    };

    // Status mapping based on user provided codes
    function getStatusInfo(status, bookingTime) {
        const s = String(status);
        
        // Special handling for status 4 (Booked) - check if booking time is past or future
        if (s === '4' && bookingTime) {
            try {
                const bookingDate = new Date(bookingTime);
                const now = new Date();
                
                // Compare booking time with current time
                if (bookingDate > now) {
                    // Booking time is in the future - show "Upcoming"
                    return { label: translations.statusUpcoming, class: 'status-upcoming' };
                } else {
                    // Booking time is in the past - show "Past"
                    return { label: translations.statusPast, class: 'status-past' };
                }
            } catch (e) {
                // If date parsing fails, fall back to default "Booked"
                console.error('Error parsing booking time:', e);
            }
        }
        
        const statusMap = {
            '-1': { label: translations.statusUnknown, class: 'status-unknown' },      // Unknown
            '0':  { label: translations.statusPending, class: 'status-pending' },      // Pending
            '1':  { label: translations.statusInProgress, class: 'status-in-progress' }, // Progress
            '2':  { label: translations.statusCancelled, class: 'status-cancelled' },  // CancelledByCustomer
            '3':  { label: translations.statusCancelled, class: 'status-cancelled' },  // CancelledByServiceProvider
            '4':  { label: translations.statusBooked, class: 'status-booked' },        // Booked (fallback)
            '5':  { label: translations.statusCompleted, class: 'status-completed' },  // Completed
            '6':  { label: translations.statusCancelled, class: 'status-cancelled' },  // Cancelled fallback
            '7':  { label: translations.statusReviewed, class: 'status-reviewed' },    // Reviewed
            '8':  { label: translations.statusCompleted, class: 'status-completed' },  // CompletedAlt
            '9':  { label: translations.statusReceived, class: 'status-pending' },     // ReceivedRequest
        };
        return statusMap[s] || statusMap['-1'];
    }

    // Format booking time for the new design: "Tuesday, December 16, 1:30 PM"
    function formatBookingDate(bookingTime) {
        if (!bookingTime) return '';
        try {
            const date = new Date(bookingTime);
            const locale = '{{ app()->getLocale() }}' === 'fr' ? 'fr-FR' : 'en-US';
            
            // Format: Tuesday, December 16, 1:30 PM
            return date.toLocaleDateString(locale, {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: '2-digit'
            });
        } catch (e) {
            return bookingTime;
        }
    }
    
    // Create new horizontal booking card HTML
    function createBookingCard(booking) {
        const providerPhoto = booking.serviceProviderInfo?.photo || '{{ asset("images/istockphoto-1300845620-612x612.jpg") }}';
        const providerName = booking.serviceProviderInfo?.name || 'Service Provider';
        const serviceName = booking.services?.[0]?.serviceName || 'Service';
        
        // Address check: Root address first, then provider info
        const address = booking.address || booking.serviceProviderInfo?.address || 'Location details unavailable';
        
        const bookingDateStr = formatBookingDate(booking.booking_time);
        
        // Duration: Root duration_minutes or first service durationMinutes
        const durationVal = booking.duration_minutes || booking.services?.[0]?.durationMinutes || ''; 
        const durationHtml = durationVal ? `<span>${durationVal} min</span> <span class="separator">•</span>` : '';
        
        const price = booking.amount?.toFixed(2) || '0.00';
        
        // Status Info (pass booking_time for status 4 to check if it's upcoming or past)
        const statusInfo = getStatusInfo(booking.status, booking.booking_time);
        const statusLabel = statusInfo.label;
        const statusClass = statusInfo.class; // e.g., 'status-cancelled', 'status-booked', 'status-upcoming', 'status-past'
        
        // Handle cancelled style for the whole card if needed
        const isCancelled = ['2', '3', '6'].includes(String(booking.status));
        const cardClass = isCancelled ? 'card-cancelled' : '';

        // Payment Logic (Pre-calculation)
        let paymentHtml = '';
        const isDeposit = booking.paymentType === 'deposit' || booking.payment_type === 'deposit';
        
        // Use dynamic depositPercentage if available, default to 15%
        // Check both possible keys or just depositPercentage
        
        if (isDeposit) {
            const totalVal = booking.amount || 0;
            const percentage = booking.depositPercentage ? (booking.depositPercentage / 100) : 0;
            const paidVal = (totalVal * percentage).toFixed(2);
            const remainingVal = (totalVal - paidVal).toFixed(2);
            
            paymentHtml = `
                <div class="payment-row">
                    <div class="payment-breakdown">
                        <span class="paid-text text-success">${translations.paid}: €${paidVal}</span>
                        <span class="separator">•</span>
                        <span class="remaining-text text-danger">${translations.remaining}: €${remainingVal}</span>
                    </div>
                </div>
            `;
        } else {
            // Full payment (or default)
            paymentHtml = `
                <div class="payment-row">
                    <span class="badge-fully-paid">${translations.fullyPaid}</span>
                </div>
            `;
        }

        return `
            <div class="booking-card-horizontal ${cardClass}">
                <div class="card-header-date">
                    <span>${bookingDateStr}</span>
                    <span class="status-badge-inline ${statusClass}">${statusLabel}</span>
                </div>
                <div class="card-body-flex">
                    <div class="card-image-col">
                        <img src="${providerPhoto}" alt="${providerName}" class="provider-image" onerror="this.src='{{ asset("images/istockphoto-1300845620-612x612.jpg") }}'">
                    </div>
                    <div class="card-details-col">
                        <h4 class="provider-title">${providerName}</h4>
                        
                        <div class="location-row">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-location"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            <span class="location-text">${address}</span>
                        </div>
                        
                        <div class="services-row">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-diamond"><path d="M6 3h12l4 6-10 13L2 9z"></path></svg>
                            <span class="services-text">${serviceName}</span>
                        </div>
                        
                        <div class="meta-row">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            ${durationHtml}
                            
                            <div class="price-info">
                                <span class="price">€${price}</span>
                            </div>

                            <span class="separator">•</span>
                            <span class="with-provider">${translations.with} ${providerName}</span>
                        </div>
                        ${paymentHtml}
                    </div>
                </div>
            </div>
        `;
    }
    
    // Render bookings
    function renderBookings(bookings) {
        if (!bookings || bookings.length === 0) {
            loadingEl.style.display = 'none';
            emptyEl.style.display = '';
            return;
        }
        
        // Sort by booking_time descending (newest first)
        bookings.sort((a, b) => new Date(b.booking_time) - new Date(a.booking_time));
        
        const html = bookings.map(booking => createBookingCard(booking)).join('');
        gridEl.innerHTML = html;
        
        loadingEl.style.display = 'none';
        gridEl.style.display = '';
    }
    
    // Show error state
    function showError() {
        loadingEl.style.display = 'none';
        errorEl.style.display = '';
    }
    
    // Fetch bookings from API
    async function fetchBookings() {
        if (!firebaseUid) {
            console.error('No firebase UID found');
            showError();
            return;
        }
        
        try {
            const apiUrl = `https://us-central1-beauty-984c8.cloudfunctions.net/getBookingsByUserId?userId=${firebaseUid}`;
            console.log('Fetching bookings from:', apiUrl);
            
            const response = await fetch(apiUrl);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            console.log('Bookings data:', data);
            
            // API returns bookings array directly or wrapped in a property
            const bookings = Array.isArray(data) ? data : (data.bookings || []);
            renderBookings(bookings);
            
        } catch (error) {
            console.error('Error fetching bookings:', error);
            showError();
        }
    }
    
    // Initialize
    fetchBookings();
    
    // Placeholder links prevention
    document.querySelectorAll('.placeholder-link').forEach(link => {
        link.addEventListener('click', (e) => e.preventDefault());
    });
    
    // Handle logout form submission - clear sessionStorage
    const logoutForm = document.querySelector('.logout-form');
    if (logoutForm) {
        logoutForm.addEventListener('submit', function(e) {
            // Clear all user_profile_synced keys from sessionStorage before logout
            try {
                const keysToRemove = [];
                for (let i = 0; i < sessionStorage.length; i++) {
                    const key = sessionStorage.key(i);
                    if (key && key.startsWith('user_profile_synced_')) {
                        keysToRemove.push(key);
                    }
                }
                keysToRemove.forEach(key => {
                    sessionStorage.removeItem(key);
                    console.log('Cleared sessionStorage key:', key);
                });
            } catch (error) {
                console.error('Error clearing sessionStorage:', error);
            }
            
            // Try to sign out from Firebase first
            if (window.firebase && window.firebase.auth) {
                e.preventDefault(); // Prevent form submission until Firebase signout completes
                firebase.auth().signOut()
                    .then(() => {
                        console.log('Firebase signed out successfully');
                        logoutForm.submit(); // Now submit the form
                    })
                    .catch((error) => {
                        console.error('Firebase sign out error:', error);
                        // Still submit form even if firebase logout fails
                        logoutForm.submit();
                    });
            }
        });
    }
});
</script>
@endsection
