@extends('layouts.mainInnerPages')
{{-- Title --}}
@section('title', __('app.bookings.title'))

{{-- Style Files --}}
@section('styles')
<link rel="stylesheet" href="{{ \App\Helpers\AssetHelper::versioned('css/my-bookings.css') }}">
@endsection


{{-- Content --}}
@section('content')
    <!-- Page Header Start -->
    <div class="bookings-page-header">
        <div class="container">
            <h1>{{ __('app.bookings.title') }}</h1>
            <p>{{ __('app.bookings.subtitle') }}</p>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Bookings Section Start -->
    <div class="bookings-container">
        <div class="container">
            <!-- Loading State -->
            <div id="bookingsLoading" class="bookings-loading">
                <div class="spinner"></div>
                <p>{{ __('app.bookings.loading') }}</p>
            </div>

            <!-- Error State (hidden by default) -->
            <div id="bookingsError" class="bookings-error" style="display: none;">
                <h3>{{ __('app.bookings.error_title') }}</h3>
                <p>{{ __('app.bookings.error_desc') }}</p>
            </div>

            <!-- Empty State (hidden by default) -->
            <div id="bookingsEmpty" class="bookings-empty" style="display: none;">
                <div class="bookings-empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3>{{ __('app.bookings.no_bookings') }}</h3>
                <p>{{ __('app.bookings.no_bookings_desc') }}</p>
                <a href="{{ url('/search') }}" class="btn-book-now">{{ __('app.bookings.book_now') }}</a>
            </div>

            <!-- Bookings Grid (populated by JavaScript) -->
            <div id="bookingsGrid" class="bookings-grid" style="display: none;"></div>
        </div>
    </div>
    <!-- Bookings Section End -->
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
        fullyPaid: @json(__('app.bookings.fully_paid')),
        bookingTime: @json(__('app.bookings.booking_time')),
        statusUnknown: @json(__('app.bookings.status_unknown')),
        statusPending: @json(__('app.bookings.status_pending')),
        statusInProgress: @json(__('app.bookings.status_in_progress')),
        statusCancelled: @json(__('app.bookings.status_cancelled')),
        statusBooked: @json(__('app.bookings.status_booked')),
        statusCompleted: @json(__('app.bookings.status_completed')),
        statusReviewed: @json(__('app.bookings.status_reviewed')),
        statusReceived: @json(__('app.bookings.status_received')),
    };
    
    // Status mapping
    function getStatusInfo(status) {
        const statusMap = {
            '-1': { label: translations.statusUnknown, class: 'status-unknown' },
            '0': { label: translations.statusPending, class: 'status-pending' },
            '1': { label: translations.statusInProgress, class: 'status-in-progress' },
            '2': { label: translations.statusCancelled, class: 'status-cancelled' },
            '3': { label: translations.statusCancelled, class: 'status-cancelled' },
            '4': { label: translations.statusBooked, class: 'status-booked' },
            '5': { label: translations.statusCompleted, class: 'status-completed' },
            '6': { label: translations.statusCancelled, class: 'status-cancelled' },
            '7': { label: translations.statusReviewed, class: 'status-reviewed' },
            '8': { label: translations.statusCompleted, class: 'status-completed' },
            '9': { label: translations.statusReceived, class: 'status-pending' },
        };
        return statusMap[String(status)] || statusMap['-1'];
    }
    
    // Format booking time
    function formatBookingTime(bookingTime, bookTime) {
        if (!bookingTime) return 'N/A';
        
        try {
            const date = new Date(bookingTime);
            const locale = '{{ app()->getLocale() }}' === 'fr' ? 'fr-FR' : 'en-US';
            const dateStr = date.toLocaleDateString(locale, {
                weekday: 'short',
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
            
            const timeStr = bookTime || date.toLocaleTimeString(locale, {
                hour: '2-digit',
                minute: '2-digit'
            });
            
            return `${dateStr} @ ${timeStr}`;
        } catch (e) {
            return bookingTime;
        }
    }
    
    // Calculate payment amounts
    function calculatePayment(amount, depositPercentage, paymentType) {
        if (paymentType === 'full') {
            return {
                paid: amount,
                remaining: 0,
                isFullyPaid: true
            };
        }
        
        const paidAmount = (amount * depositPercentage) / 100;
        const remainingAmount = amount - paidAmount;
        
        return {
            paid: paidAmount,
            remaining: remainingAmount,
            isFullyPaid: false
        };
    }
    
    // Create booking card HTML
    function createBookingCard(booking) {
        const providerPhoto = booking.serviceProviderInfo?.photo || '{{ asset("images/istockphoto-1300845620-612x612.jpg") }}';
        const providerName = booking.serviceProviderInfo?.name || 'Service Provider';
        const serviceName = booking.services?.[0]?.serviceName || 'Service';
        const statusInfo = getStatusInfo(booking.status);
        const bookingTimeStr = formatBookingTime(booking.booking_time, booking.bookTime);
        const payment = calculatePayment(booking.amount || 0, booking.depositPercentage || 0, booking.paymentType);
        
        return `
            <div class="booking-card">
                <div class="booking-card-header">
                    <img class="provider-avatar" src="${providerPhoto}" alt="${providerName}" onerror="this.src='{{ asset("images/istockphoto-1300845620-612x612.jpg") }}'">
                    <div class="provider-info">
                        <h4 class="provider-name">${providerName}</h4>
                        <p class="service-name">${serviceName}</p>
                    </div>
                    <span class="status-badge ${statusInfo.class}">${statusInfo.label}</span>
                </div>
                <div class="booking-card-body">
                    <div class="booking-detail">
                        <span class="detail-label">${translations.bookingTime}</span>
                        <span class="detail-value">${bookingTimeStr}</span>
                    </div>
                    <div class="booking-detail">
                        <span class="detail-label">${translations.totalAmount}</span>
                        <span class="detail-value amount">${booking.amount?.toFixed(2) || '0.00'}€</span>
                    </div>
                    <div class="booking-detail">
                        <span class="detail-label">${translations.paid}</span>
                        <span class="detail-value paid">${payment.paid.toFixed(2)}€</span>
                    </div>
                    <div class="booking-detail">
                        <span class="detail-label">${translations.remaining}</span>
                        <span class="detail-value ${payment.isFullyPaid ? 'fully-paid' : 'remaining'}">
                            ${payment.isFullyPaid ? translations.fullyPaid : payment.remaining.toFixed(2) + '€'}
                        </span>
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
});
</script>
@endsection
