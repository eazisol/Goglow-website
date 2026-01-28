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
                            <ul class="menu-list">
                                <li>
                                    <a href="{{ route('my-bookings') }}" class="menu-link active">
                                        {{ __('app.bookings.my_appointments') ?? 'My appointments' }}
                                    </a>
                                </li>
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
                            <h1>{{ __('app.bookings.my_appointments') ?? 'My appointments' }}</h1>
                        </div>

                        <!-- Toggle Tabs -->
                        <div class="bookings-tabs">
                            <button class="tab-btn active" data-tab="0">
                                {{ __('app.bookings.upcoming') ?? 'Upcoming' }}
                            </button>
                            <button class="tab-btn" data-tab="1">
                                {{ __('app.bookings.past') ?? 'Past' }}
                            </button>
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
                            <h3 id="emptyTitle">{{ __('app.bookings.no_bookings') }}</h3>
                            <p id="emptyDesc">{{ __('app.bookings.no_bookings_desc') }}</p>
                            <a href="{{ url('/recherche') }}" class="btn-book-now">{{ __('app.bookings.book_now') }}</a>
                        </div>

                        <!-- Bookings List (populated by JavaScript) -->
                        <div id="bookingsGrid" class="bookings-list" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Confirmation Modal -->
    <div id="cancelModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <button class="modal-close" onclick="closeCancelModal()">&times;</button>
            <div class="modal-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3>{{ __('app.bookings.cancel_booking_question') ?? 'Cancel booking?' }}</h3>
            <p id="cancelModalMessage" class="modal-message"></p>
            <div class="modal-actions">
                <button id="rescheduleBtn" class="btn-reschedule" style="display: none;" onclick="handleReschedule()">
                    {{ __('app.bookings.reschedule') ?? 'Reschedule' }}
                </button>
                <button id="confirmCancelBtn" class="btn-confirm-cancel" onclick="confirmCancel()">
                    {{ __('app.bookings.confirm_cancel') ?? 'Confirm Cancel' }}
                </button>
                <button class="btn-keep-booking" onclick="closeCancelModal()">
                    {{ __('app.bookings.keep_booking') ?? 'Keep my booking' }}
                </button>
            </div>
            <div id="cancelLoading" class="modal-loading" style="display: none;">
                <div class="spinner"></div>
                <p>{{ __('app.bookings.processing') ?? 'Processing...' }}</p>
            </div>
        </div>
    </div>
@endsection


{{-- Scripts --}}
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const firebaseUid = @json($firebaseUid ?? null);
    let currentToggleIndex = 0;
    let allBookings = [];
    let selectedBooking = null;

    // DOM Elements
    const loadingEl = document.getElementById('bookingsLoading');
    const errorEl = document.getElementById('bookingsError');
    const emptyEl = document.getElementById('bookingsEmpty');
    const gridEl = document.getElementById('bookingsGrid');
    const tabBtns = document.querySelectorAll('.tab-btn');

    // Translation strings
    const translations = {
        totalAmount: @json(__('app.bookings.total_amount')),
        paid: @json(__('app.bookings.paid')),
        remaining: @json(__('app.bookings.remaining')),
        with: @json(__('app.bookings.with') ?? 'with'),
        statusCancelled: @json(__('app.bookings.status_cancelled')),
        cancel: @json(__('app.bookings.cancel') ?? 'Cancel'),
        reschedule: @json(__('app.bookings.reschedule') ?? 'Reschedule'),

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

        // Empty state
        noUpcomingBookings: @json(__('app.bookings.no_upcoming_bookings') ?? 'No upcoming bookings'),
        noUpcomingBookingsDesc: @json(__('app.bookings.no_upcoming_bookings_desc') ?? 'You don\'t have any upcoming appointments.'),
        noPastBookings: @json(__('app.bookings.no_past_bookings') ?? 'No past bookings'),
        noPastBookingsDesc: @json(__('app.bookings.no_past_bookings_desc') ?? 'You don\'t have any past appointments yet.'),

        // Cancel modal
        fullRefundMessage: @json(__('app.bookings.full_refund_message') ?? 'A full refund of {amount} will be processed.'),
        partialRefundMessage: @json(__('app.bookings.partial_refund_message') ?? 'A partial refund of {amount} will be processed. The deposit will be retained due to late cancellation.'),
        noRefundMessage: @json(__('app.bookings.no_refund_message') ?? 'The deposit will be retained due to late cancellation (less than 24 hours notice).'),
        cancelSuccess: @json(__('app.bookings.cancel_success') ?? 'Booking cancelled successfully'),
        cancelError: @json(__('app.bookings.cancel_error') ?? 'Failed to cancel booking. Please try again.'),
    };

    // Tab click handlers
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            tabBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentToggleIndex = parseInt(this.dataset.tab);
            renderFilteredBookings();
        });
    });

    // Status mapping based on status codes (matches mobile app)
    function getStatusInfo(status, bookingTime) {
        // Normalize status to string for map lookup
        const s = String(status);

        // Parse booking time for time-based status display
        let bookingDate = null;
        if (bookingTime) {
            if (typeof bookingTime === 'object' && bookingTime._seconds) {
                bookingDate = new Date(bookingTime._seconds * 1000);
            } else if (typeof bookingTime === 'object' && bookingTime.seconds) {
                bookingDate = new Date(bookingTime.seconds * 1000);
            } else {
                bookingDate = new Date(bookingTime);
            }
        }

        const now = new Date();

        // For active statuses (0,1,4,9), show Upcoming/Past based on booking time
        if (['0', '1', '4', '9'].includes(s) && bookingDate) {
            if (bookingDate > now) {
                return { label: translations.statusUpcoming, class: 'status-upcoming' };
            } else {
                return { label: translations.statusPast, class: 'status-past' };
            }
        }

        const statusMap = {
            '-1': { label: translations.statusUnknown, class: 'status-unknown' },
            '0':  { label: translations.statusPending, class: 'status-pending' },
            '1':  { label: translations.statusInProgress, class: 'status-in-progress' },
            '2':  { label: translations.statusCancelled, class: 'status-cancelled' },
            '3':  { label: translations.statusCancelled, class: 'status-cancelled' },
            '4':  { label: translations.statusBooked, class: 'status-booked' },
            '5':  { label: translations.statusCompleted, class: 'status-completed' },
            '6':  { label: translations.statusCancelled, class: 'status-cancelled' },
            '7':  { label: translations.statusReviewed, class: 'status-reviewed' },
            '8':  { label: translations.statusCompleted, class: 'status-completed' },
            '9':  { label: translations.statusReceived, class: 'status-pending' },
        };
        return statusMap[s] || statusMap['-1'];
    }

    // Format booking time (handles Firestore timestamp format)
    function formatBookingDate(bookingTime) {
        if (!bookingTime) return '';
        try {
            let date;
            if (typeof bookingTime === 'object' && bookingTime._seconds) {
                date = new Date(bookingTime._seconds * 1000);
            } else if (typeof bookingTime === 'object' && bookingTime.seconds) {
                date = new Date(bookingTime.seconds * 1000);
            } else {
                date = new Date(bookingTime);
            }

            const locale = '{{ app()->getLocale() }}' === 'fr' ? 'fr-FR' : 'en-US';

            return date.toLocaleDateString(locale, {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: '2-digit'
            });
        } catch (e) {
            return String(bookingTime);
        }
    }

    // Check if booking can be cancelled/rescheduled
    function canModifyBooking(booking) {
        // Normalize status to number
        const status = typeof booking.status === 'string' ? parseInt(booking.status, 10) : booking.status;

        // Only active statuses can be modified (0=Pending, 1=InProgress, 4=Booked, 9=ReceivedRequest)
        if (![0, 1, 4, 9].includes(status)) return { canCancel: false, canReschedule: false };

        // Parse booking time
        let bookingTime = null;
        if (booking.booking_time) {
            if (typeof booking.booking_time === 'object' && booking.booking_time._seconds) {
                bookingTime = new Date(booking.booking_time._seconds * 1000);
            } else if (typeof booking.booking_time === 'object' && booking.booking_time.seconds) {
                bookingTime = new Date(booking.booking_time.seconds * 1000);
            } else {
                bookingTime = new Date(booking.booking_time);
            }
        }

        const now = new Date();

        // Can't modify if booking time has passed
        if (!bookingTime || bookingTime <= now) return { canCancel: false, canReschedule: false };

        // Check 24-hour rule for reschedule (can always cancel, but reschedule only if >= 24h away)
        const hoursUntilBooking = (bookingTime - now) / (1000 * 60 * 60);
        const canReschedule = hoursUntilBooking >= 24;

        return { canCancel: true, canReschedule };
    }

    // Calculate refund info based on 24-hour rule
    function calculateRefundInfo(booking) {
        // Parse booking time
        let bookingTime = null;
        if (booking.booking_time) {
            if (typeof booking.booking_time === 'object' && booking.booking_time._seconds) {
                bookingTime = new Date(booking.booking_time._seconds * 1000);
            } else if (typeof booking.booking_time === 'object' && booking.booking_time.seconds) {
                bookingTime = new Date(booking.booking_time.seconds * 1000);
            } else {
                bookingTime = new Date(booking.booking_time);
            }
        }

        const now = new Date();
        const hoursUntilBooking = bookingTime ? (bookingTime - now) / (1000 * 60 * 60) : 0;
        const isBefore24h = hoursUntilBooking >= 24;

        const totalAmount = booking.amount || 0;
        // Use nullish check - depositPercentage of 0 is valid (free booking)
        const depositPercentage = (booking.depositPercentage !== undefined && booking.depositPercentage !== null) ? booking.depositPercentage : 25;
        const depositAmount = totalAmount * (depositPercentage / 100);
        const paymentType = booking.paymentType || booking.payment_type || 'deposit';

        const totalPaid = paymentType === 'full' ? totalAmount : depositAmount;

        let refundAmount = 0;
        let message = '';

        if (totalPaid > 0) {
            if (isBefore24h) {
                // Full refund if >= 24 hours before booking
                refundAmount = totalPaid;
                message = translations.fullRefundMessage.replace('{amount}', '€' + totalPaid.toFixed(2));
            } else {
                // Less than 24 hours - user loses deposit
                if (paymentType === 'full') {
                    refundAmount = Math.max(0, totalPaid - depositAmount);
                    if (refundAmount > 0.01) {
                        message = translations.partialRefundMessage.replace('{amount}', '€' + refundAmount.toFixed(2));
                    } else {
                        message = translations.noRefundMessage;
                    }
                } else {
                    refundAmount = 0;
                    message = translations.noRefundMessage;
                }
            }
        }

        return { refundAmount, message, isBefore24h };
    }

    // Create booking card HTML
    function createBookingCard(booking) {
        const providerPhoto = booking.serviceProviderInfo?.photo || '{{ asset("images/istockphoto-1300845620-612x612.jpg") }}';
        const providerName = booking.serviceProviderInfo?.name || 'Service Provider';
        const serviceName = booking.services?.[0]?.serviceName || 'Service';
        const serviceId = booking.services?.[0]?.serviceId || booking.serviceId || '';
        const address = booking.address || booking.serviceProviderInfo?.address || 'Location details unavailable';
        const bookingDateStr = formatBookingDate(booking.booking_time);
        const durationVal = booking.duration_minutes || booking.services?.[0]?.durationMinutes || '';
        const durationHtml = durationVal ? `<span>${durationVal} min</span> <span class="separator">•</span>` : '';
        const price = booking.amount?.toFixed(2) || '0.00';

        const statusInfo = getStatusInfo(booking.status, booking.booking_time);
        const statusLabel = statusInfo.label;
        const statusClass = statusInfo.class;

        const isCancelled = ['2', '3', '6'].includes(String(booking.status));
        const cardClass = isCancelled ? 'card-cancelled' : '';

        // Payment Logic
        let paymentHtml = '';
        const isDeposit = booking.paymentType === 'deposit' || booking.payment_type === 'deposit';

        if (isDeposit) {
            const totalVal = booking.amount || 0;
            // Use nullish check - depositPercentage of 0 is valid (free booking)
            const percentage = (booking.depositPercentage !== undefined && booking.depositPercentage !== null) ? (booking.depositPercentage / 100) : 0.25;
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
            paymentHtml = `
                <div class="payment-row">
                    <span class="badge-fully-paid">${translations.fullyPaid}</span>
                </div>
            `;
        }

        // Action buttons for upcoming bookings
        let actionsHtml = '';
        const modifyStatus = canModifyBooking(booking);

        if (currentToggleIndex === 0 && modifyStatus.canCancel) {
            actionsHtml = `
                <div class="booking-actions">
                    ${modifyStatus.canReschedule ? `
                        <a href="/book-appointment?serviceId=${serviceId}&reschedule=${booking.id || booking.bookingId}" class="btn-action btn-reschedule-action">
                            ${translations.reschedule}
                        </a>
                    ` : ''}
                    <button class="btn-action btn-cancel-action" onclick="openCancelModal('${booking.id || booking.bookingId}')">
                        ${translations.cancel}
                    </button>
                </div>
            `;
        }

        return `
            <div class="booking-card-horizontal ${cardClass}" data-booking-id="${booking.id || booking.bookingId}">
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
                        ${actionsHtml}
                    </div>
                </div>
            </div>
        `;
    }

    // Filter bookings based on toggle index (matches mobile app logic exactly)
    // Upcoming: Status 0,1,4,9 AND booking time is in future
    // Past: Status 0,1,4,9 AND booking time is in past, OR Cancelled (2,3,6), OR Completed (5,7,8,'Review')
    function filterBookings(bookings, toggleIndex) {
        const now = new Date();

        return bookings.filter(booking => {
            // Normalize status to number (API might return string or number)
            const status = typeof booking.status === 'string' ? parseInt(booking.status, 10) : booking.status;

            // Parse booking time - handle Firestore timestamp format
            let bookingTime = null;
            if (booking.booking_time) {
                if (typeof booking.booking_time === 'object' && booking.booking_time._seconds) {
                    bookingTime = new Date(booking.booking_time._seconds * 1000);
                } else if (typeof booking.booking_time === 'object' && booking.booking_time.seconds) {
                    bookingTime = new Date(booking.booking_time.seconds * 1000);
                } else {
                    bookingTime = new Date(booking.booking_time);
                }
            }

            // Active statuses that can be upcoming or past based on time
            const activeStatuses = [0, 1, 4, 9];
            const isActiveStatus = activeStatuses.includes(status);

            if (toggleIndex === 0) {
                // UPCOMING TAB: Active status AND booking time is in the future
                if (!isActiveStatus) return false;
                return bookingTime && bookingTime > now;
            } else {
                // PAST TAB:
                // 1. Active status (0,1,4,9) AND booking time is in the past (due date passed)
                // 2. Cancelled status (2,3,6)
                // 3. Completed status (5,7,8) or 'Review'

                if (isActiveStatus) {
                    // Active bookings go to Past if their time has passed
                    return bookingTime && bookingTime <= now;
                }

                // Cancelled bookings always go to Past
                const cancelledStatuses = [2, 3, 6];
                const isCancelled = cancelledStatuses.includes(status);

                // Completed bookings always go to Past
                const completedStatuses = [5, 7, 8];
                const isCompleted = completedStatuses.includes(status) || booking.status === 'Review';

                return isCancelled || isCompleted;
            }
        });
    }

    // Render filtered bookings
    function renderFilteredBookings() {
        const filtered = filterBookings(allBookings, currentToggleIndex);

        if (!filtered || filtered.length === 0) {
            gridEl.style.display = 'none';
            document.getElementById('emptyTitle').textContent = currentToggleIndex === 0
                ? translations.noUpcomingBookings
                : translations.noPastBookings;
            document.getElementById('emptyDesc').textContent = currentToggleIndex === 0
                ? translations.noUpcomingBookingsDesc
                : translations.noPastBookingsDesc;
            emptyEl.style.display = '';
            return;
        }

        // Sort by booking_time
        // Upcoming (toggleIndex 0): ascending (soonest first)
        // Past/Cancelled (toggleIndex 1): descending (closest to today first)
        if (currentToggleIndex === 0) {
            filtered.sort((a, b) => new Date(a.booking_time) - new Date(b.booking_time));
        } else {
            filtered.sort((a, b) => new Date(b.booking_time) - new Date(a.booking_time));
        }

        const html = filtered.map(booking => createBookingCard(booking)).join('');
        gridEl.innerHTML = html;

        emptyEl.style.display = 'none';
        gridEl.style.display = '';
    }

    // Render bookings
    function renderBookings(bookings) {
        allBookings = bookings;
        loadingEl.style.display = 'none';

        if (!bookings || bookings.length === 0) {
            emptyEl.style.display = '';
            return;
        }

        renderFilteredBookings();
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

            const bookings = Array.isArray(data) ? data : (data.bookings || []);
            renderBookings(bookings);

        } catch (error) {
            console.error('Error fetching bookings:', error);
            showError();
        }
    }

    // Cancel Modal Functions
    window.openCancelModal = function(bookingId) {
        selectedBooking = allBookings.find(b => (b.id || b.bookingId) === bookingId);
        if (!selectedBooking) {
            console.error('Booking not found:', bookingId);
            return;
        }

        const refundInfo = calculateRefundInfo(selectedBooking);
        console.log('Refund info:', refundInfo, 'isBefore24h:', refundInfo.isBefore24h);

        document.getElementById('cancelModalMessage').textContent = refundInfo.message;

        // Show reschedule button only if >= 24h away
        const rescheduleBtn = document.getElementById('rescheduleBtn');
        if (refundInfo.isBefore24h) {
            rescheduleBtn.style.display = 'block';
            console.log('Showing reschedule button');
        } else {
            rescheduleBtn.style.display = 'none';
            console.log('Hiding reschedule button (< 24h away)');
        }

        // Reset modal state (in case it was left in loading state)
        document.getElementById('cancelLoading').style.display = 'none';
        document.querySelector('#cancelModal .modal-actions').style.display = 'flex';

        document.getElementById('cancelModal').style.display = 'flex';
    };

    window.closeCancelModal = function() {
        const modal = document.getElementById('cancelModal');
        if (modal) {
            modal.style.display = 'none';
        }
        selectedBooking = null;
    };

    // Close modal when clicking outside (on the overlay)
    document.getElementById('cancelModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCancelModal();
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('cancelModal');
            if (modal && modal.style.display !== 'none') {
                closeCancelModal();
            }
        }
    });

    window.handleReschedule = function() {
        if (!selectedBooking) return;
        const serviceId = selectedBooking.services?.[0]?.serviceId || selectedBooking.serviceId || '';
        const bookingId = selectedBooking.id || selectedBooking.bookingId;
        window.location.href = `/book-appointment?serviceId=${serviceId}&reschedule=${bookingId}`;
    };

    window.confirmCancel = async function() {
        if (!selectedBooking) return;

        const bookingId = selectedBooking.id || selectedBooking.bookingId;
        const confirmBtn = document.getElementById('confirmCancelBtn');
        const cancelLoading = document.getElementById('cancelLoading');
        const modalActions = document.querySelector('.modal-actions');

        // Show loading
        modalActions.style.display = 'none';
        cancelLoading.style.display = '';

        try {
            // Try to get Firebase ID token (optional - falls back to session auth)
            let idToken = null;
            try {
                const auth = window.firebaseAuth || (window.firebase && firebase.auth());
                if (auth && auth.currentUser) {
                    idToken = await auth.currentUser.getIdToken(true);
                    console.log('Got Firebase ID token for cancel');
                }
            } catch (tokenError) {
                console.log('Could not get Firebase token, will use session auth:', tokenError.message);
            }

            // Build request headers - include token if available, otherwise rely on session cookie
            const headers = {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            };
            if (idToken) {
                headers['Authorization'] = `Bearer ${idToken}`;
            }

            const response = await fetch(`/api/bookings/${bookingId}/cancel`, {
                method: 'PUT',
                headers: headers,
                credentials: 'same-origin', // Send session cookies
            });

            const data = await response.json();

            if (!response.ok || !data.success) {
                throw new Error(data.message || 'Cancel failed');
            }

            // Success - close modal and refresh
            closeCancelModal();

            // Show success message
            alert(translations.cancelSuccess);

            // Refresh bookings
            loadingEl.style.display = '';
            gridEl.style.display = 'none';
            fetchBookings();

        } catch (error) {
            console.error('Error cancelling booking:', error);
            alert(translations.cancelError + '\n' + error.message);

            // Reset modal
            cancelLoading.style.display = 'none';
            modalActions.style.display = '';
        }
    };

    // Initialize
    fetchBookings();

    // Handle logout button click
    const logoutBtn = document.querySelector('.logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', async function(e) {
            e.preventDefault();
            console.log('Logout button clicked');

            // Clear sessionStorage
            try {
                for (let i = sessionStorage.length - 1; i >= 0; i--) {
                    const key = sessionStorage.key(i);
                    if (key && key.startsWith('user_profile_synced_')) {
                        sessionStorage.removeItem(key);
                    }
                }
            } catch (error) {
                console.error('Error clearing sessionStorage:', error);
            }

            // Sign out from Firebase with a short timeout to avoid slow logout
            if (window.firebaseAuth) {
                try {
                    await Promise.race([
                        window.firebaseAuth.signOut(),
                        new Promise((_, reject) => setTimeout(() => reject(new Error('timeout')), 1000))
                    ]);
                    console.log('Firebase signOut successful');
                } catch (err) {
                    console.warn('Firebase signOut issue:', err.message);
                }
            }

            // Submit form to logout from Laravel
            document.querySelector('.logout-form').submit();
        });
    }

    // Close modal on outside click
    document.getElementById('cancelModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCancelModal();
        }
    });
});
</script>
@endsection
