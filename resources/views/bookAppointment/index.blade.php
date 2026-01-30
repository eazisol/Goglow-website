@extends('layouts.mainInnerPages')
{{-- Title --}}
@section('title', 'home')

{{-- Style Files --}}
@section('styles')
{{-- Bootstrap removed - using vanilla CSS from auth-modals.css --}}
<link rel="stylesheet" href="{{ \App\Helpers\AssetHelper::versioned('css/bookAppointment-index.css') }}">
<style>
    /* Hide payment options in reschedule mode */
    .reschedule-hidden {
        display: none !important;
    }
</style>
@endsection


{{-- Content --}}
@section('content')
    <!-- Page Header Start -->
    <div class="page-header bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
	
	<!-- Book Appointment Section Start -->
    <div class="page-book-appointment">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Service summary card Start -->
                    <div class="service-summary-card">
                        {{-- <div class="card-cover">
                            <img src="{{ (isset($selectedService['images']) && count($selectedService['images']) > 0) ? $selectedService['images'][0] : asset('/images/default.jpeg') }}"
                                 alt="{{ $selectedService['service_name'] ?? 'Service' }}"
                                 onerror="this.src='{{ asset('/images/default.jpeg') }}'">
                        </div> --}}
                        <div class="card-body">
                            <h4 class="service-summary-title">{{ $selectedService['service_name'] ?? 'Selected Service' }}</h4>
                            <p class="service-summary-price">
                                {{ $selectedService['discounted_price'] ?? ($selectedService['service_price'] ?? 0) }}€
                                @if(isset($selectedService['discounted_price']) && isset($selectedService['service_price']) && $selectedService['discounted_price'] < $selectedService['service_price'])
                                    <span class="old-price">{{ $selectedService['service_price'] }}€</span>
                                @endif
                                {{-- @if(isset($selectedService['duration_minutes']) && $selectedService['duration_minutes'] > 0)
                                     <span class="service-duration" style="font-size: 14px; font-weight: 400; color: #6c757d; margin-left: 8px;">
                                        <i class="fa fa-clock-o" aria-hidden="true" style="margin-right: 3px;"></i> {{ $selectedService['duration_minutes'] }} min
                                    </span>
                                @endif --}}
                            </p>
                            @if(!empty($selectedService['service_details']))
                                @php
                                    $description = $selectedService['service_details'];
                                    $wordLimit = 8;
                                    $words = preg_split('/\s+/', trim($description), -1, PREG_SPLIT_NO_EMPTY);
                                    $needsTruncation = count($words) > $wordLimit;
                                    $truncatedDescription = implode(' ', array_slice($words, 0, $wordLimit)) . '...';
                                    $descId = 'desc-' . uniqid();
                                @endphp
                                
                                <div class="service-summary-desc">
                                    @if($needsTruncation)
                                        <span class="desc-text" data-desc-id="{{ $descId }}">{{ $truncatedDescription }}</span>
                                        <span class="desc-full" data-desc-id="{{ $descId }}" style="display: none;">{{ $description }}</span>
                                        <button type="button" class="see-more-desc-btn" data-desc-id="{{ $descId }}" onclick="window.toggleDescription('{{ $descId }}', event)" style="color: rgba(229, 0, 80, 1); background: none; border: none; cursor: pointer; font-size: 14px; padding: 0; margin-left: 5px; text-decoration: underline;">
                                            {{ __('app.service.see_more') }}
                                        </button>
                                    @else
                                        {{ $description }}
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Service summary card End -->

                                @if(!empty($agents))
                    <!-- Agent & Schedule (moved here) -->
                    <div class="mt-4 agent-scheduled-ui">
                                    <label class="form-label" style="justify-content: center;display: flex;">{{ __('app.agent_page.select_agent') }}</label>
                                    <div id="agentList" class="agent-avatars">
                                        @foreach($agents as $agent)
                                            <div class="agent-avatar" data-agent='@json($agent)'>
                                                <img class="avatar-img" src="{{ asset('images/istockphoto-1300845620-612x612.jpg') }}" alt="{{ $agent['name'] ?? 'Agent' }}">
                                                <div class="agent-name">{{ $agent['name'] ?? 'Agent' }}</div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div id="agentSchedule" class="mt-3" style="display:none;">
                            <h5 style="margin-bottom: 10px;font-size:18px;font-weight:700;text-align:center;">{{ __('app.agent_page.schedule') }}</h5>

                            <!-- Selected slot info (moved directly under heading) -->
                            <div id="selectedSlotInfo" class="alert alert-info mb-3" style="display: none;">
                                <i class="fa fa-info-circle"></i>
                                {{ __('app.agent_page.selected') }}: <span id="selectedDateTimeDisplay"></span>
                                            </div>

                            <div id="weekDisplay"></div>

                            <div class="calendar-strip">
                                <button type="button" id="prevWeek" class="calendar-arrow">
                                    <img src="{{ asset('images/images/leftarrow_days.svg') }}" alt="" width="16" height="16">
                                </button>
                                <div class="days-header"></div>
                                <button type="button" id="nextWeek" class="calendar-arrow">
                                    <img src="{{ asset('images/images/rightarrow_days.svg') }}" alt="" width="16" height="16">
                                </button>
                            </div>

                            <!-- Period Selector (hidden initially) -->
                            <div id="periodSelector" class="period-selector" style="display: none;">
                                <button type="button" class="period-btn" data-period="morning">{{ __('app.agent_page.the_morning') }}</button>
                                <button type="button" class="period-btn" data-period="afternoon">{{ __('app.agent_page.in_the_afternoon') }}</button>
                                <button type="button" class="period-btn" data-period="evening">{{ __('app.agent_page.in_the_evening') }}</button>
                            </div>

                            <!-- Time Slots with Navigation (hidden initially) -->
                            <div id="timeSlotsStrip" class="time-slots-strip" style="display: none;">
                                <button type="button" id="prevTimeSlot" class="time-slot-arrow">
                                    <img src="{{ asset('images/images/leftarrow_days.svg') }}" alt="" width="16" height="16">
                                </button>
                                <div id="timeSlotGrid" class="time-slots-container"></div>
                                <button type="button" id="nextTimeSlot" class="time-slot-arrow">
                                    <img src="{{ asset('images/images/rightarrow_days.svg') }}" alt="" width="16" height="16">
                                </button>
                            </div>
                            
                            <!-- Mobile Time Slots Container (vertical layout, hidden initially) -->
                            <div id="mobileTimeSlotsContainer" class="mobile-time-slots-container" style="display: none;"></div>
                                    </div>
                                </div>
                                @else
                                    <div class="mt-4 text-center">
                                        <div class="alert alert-info">
                                            {{ __('app.agent_page.no_agent_assigned') }}
                                        </div>
                                    </div>
                                @endif
                </div>

                <div class="col-12" style="display: grid;justify-content: center;">
                    <!-- Book Appointment Form Start -->
                    <div class="appointment-form wow fadeInUp" data-wow-delay="0.2s">
                        <form id="appointmentForm" action="{{ route('checkout.session') }}" method="POST" data-toggle="validator">
                                @csrf
                            <div class="row">
                                <!-- Service Details Section -->
                                @if(!empty($selectedService))
                                    <input type="hidden" name="service_name" id="service_name" value="{{ $selectedService['service_name'] ?? '' }}">
                                    <input type="hidden" name="service_price" id="service_price" value="{{ $selectedService['discounted_price'] ?? ($selectedService['service_price'] ?? '0') }}">
                                @endif

                                <!-- Hidden fields for the selected slot from left column -->
                                <input type="hidden" name="selected_day" id="selected_day" required>
                                <input type="hidden" id="selected_date" name="selected_date" required>
                                <input type="hidden" id="selected_time" name="selected_time" required>

                                <!-- Personal Information from logged-in user (hidden) -->
                                <input type="hidden" name="name" id="name" value="{{ $userData['name'] ?? '' }}">
                                <input type="hidden" name="email" id="email" value="{{ $userData['email'] ?? '' }}">
                                <input type="hidden" name="phone" id="phone" value="{{ $userData['phone'] ?? '' }}">
                                
                                <!-- Payment Options (hidden initially, shown after time slot selection) -->
                                <div id="paymentOptionsSection" class="col-12" style="display: none;">
                                    <!-- Payment choices - hidden in reschedule mode -->
                                    <div id="paymentChoicesSection" class="form-group col-md-12 mb-4">
                                        @php
                                            // Calculate deposit percentage based on priority: spDeposit > minimum_booking_percentage > commission
                                            $depositPercentage = null;
                                            $depositLabel = '';
                                            $servicePrice = $selectedService['discounted_price'] ?? ($selectedService['service_price'] ?? 0);
                                            
                                            if (!empty($selectedService)) {
                                                $spDeposit = $selectedService['spDeposit'] ?? 0;
                                                $commission = $selectedService['commission'] ?? [];
                                                $minimumBookingPercentage = $commission['minimum_booking_percentage'] ?? 0;
                                                $commissionValue = $commission['commission'] ?? 0;
                                                
                                                if ($spDeposit > 0) {
                                                    $depositPercentage = $spDeposit;
                                                    $depositLabel = __('app.booking.deposit_now', ['percentage' => $spDeposit]);
                                                } elseif ($minimumBookingPercentage > 0) {
                                                    $depositPercentage = $minimumBookingPercentage;
                                                    $depositLabel = __('app.booking.deposit_now', ['percentage' => $minimumBookingPercentage]);
                                                } elseif ($commissionValue > 0) {
                                                    $depositPercentage = $commissionValue;
                                                    $depositLabel = __('app.booking.deposit_now', ['percentage' => $commissionValue]);
                                                } else {
                                                    $depositPercentage = 0;
                                                    $depositLabel = __('app.booking.free_booking');
                                                }
                                                
                                                $depositAmount = ($depositPercentage > 0) ? ($servicePrice * ($depositPercentage / 100)) : 0;
                                            } else {
                                                $depositPercentage = 0;
                                                $depositLabel = __('app.booking.free_booking');
                                                $depositAmount = 0;
                                            }
                                        @endphp

                                        @if($depositPercentage == 0)
                                            <!-- Free Booking UI -->
                                            <label class="form-label" style="font-weight: 700; font-size: 18px; margin-bottom: 20px;">{{ __('app.booking.booking_payment_detail') }}</label>
                                            <div class="payment-details-container" style="max-width: 100%;">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span style="font-size: 16px; color: #333;">{{ __('app.booking.service_amount') }}</span>
                                                    <span style="font-size: 16px; font-weight: 600;">{{ number_format($servicePrice, 2) }}€</span>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span style="font-size: 16px; color: #333;">{{ __('app.booking.deposit_amount') }}</span>
                                                    <span style="font-size: 16px; font-weight: 600;">0.00€</span>
                                                </div>
                                                <hr style="margin: 15px 0; border-top: 1px solid #ddd;">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span style="font-size: 16px; color: #333;">{{ __('app.booking.total_remaining') }}</span>
                                                    <span style="font-size: 18px; font-weight: 700;">{{ number_format($servicePrice, 2) }}€</span>
                                                </div>
                                                
                                                <!-- Hidden input for JS compatibility -->
                                                <input type="radio" name="paymentType" id="payDeposit" value="deposit" checked style="display:none;">
                                                <input type="hidden" id="depositPercentage" value="{{ $depositPercentage }}">
                                                <!-- Hidden label for deposit logic referencing -->
                                                <span id="payDepositLabel" style="display:none;">{{ $depositLabel }} ({{ number_format($depositAmount, 2) }}€)</span>
                                            </div>
                                        @else
                                            <!-- Paid Booking UI (Existing) -->
                                            <label class="form-label">{{ __('app.agent_page.payment_options') }}</label>
                                            <div class="payment-options">
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" name="paymentType" id="payDeposit" value="deposit" checked>
                                                    <label class="form-check-label" for="payDeposit" id="payDepositLabel">
                                                        @if($depositPercentage > 0)
                                                            {{ $depositLabel }} ({{ number_format($depositAmount, 2) }}€)
                                                        @else
                                                            {{ $depositLabel }}
                                                        @endif
                                                    </label>
                                                    <input type="hidden" id="depositPercentage" value="{{ $depositPercentage }}">
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="paymentType" id="payFull" value="full">
                                                    <label class="form-check-label" for="payFull">
                                                        {{ __('app.agent_page.pay_full_amount_now') }} ({{ $selectedService['discounted_price'] ?? ($selectedService['service_price'] ?? 0) }}€)
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Notes Section -->
                                    {{-- <div class="form-group col-md-12 mb-4">
                                        <label for="notes">Additional Notes</label>
                                        <textarea name="notes" id="notes" class="form-control" rows="4" placeholder="Any special requests or notes for your appointment"></textarea>
                                    </div> --}}
        
                                    <!-- Terms and Conditions Checkbox -->
                                    <div class="form-group col-md-12 mb-4">
                                        <div class="terms-checkbox-wrapper" style="padding: 15px; background: rgba(255, 244, 248, 0.5); border: 1px solid rgba(213, 190, 198, 0.5); border-radius: 12px;">
                                            <div class="terms-checkbox-container" style="display: flex; align-items: flex-start; gap: 12px;">
                                                <input type="checkbox" name="terms_conditions" id="termsConditions" class="terms-checkbox-input" required style="width: 20px; height: 20px; margin: 0; cursor: pointer; flex-shrink: 0; margin-top: 2px;"
                                                    oninvalid="this.setCustomValidity('{{ __('app.booking.please_accept_terms') }}')"
                                                    oninput="this.setCustomValidity('')">
                                                <label class="terms-checkbox-label" for="termsConditions" style="font-size: 14px; line-height: 1.5; color: #2c0d18; cursor: pointer; margin: 0; flex: 1;">
                                                    {{ __('app.auth.i_agree_to') }} <a href="{{ url('/terms_condition') }}" target="_blank" style="color: rgba(229, 0, 80, 1); text-decoration: underline; font-weight: 500;">{{ __('app.auth.terms') }}</a> {{ __('app.auth.and') }} <a href="{{ url('/privacy_policy') }}" target="_blank" style="color: rgba(229, 0, 80, 1); text-decoration: underline; font-weight: 500;">{{ __('app.auth.privacy_policy') }}</a>
                                                </label>
                                            </div>
                                            <div class="invalid-feedback" id="termsError" style="display: none; color: #dc3545; font-size: 13px; margin-top: 8px; margin-left: 32px;">
                                                {{ __('app.auth.please_accept_terms') }}
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-md-12">
                                        <button type="submit" class="btn-default" id="bookAppointmentBtn">
                                            <span id="bookAppointmentBtnText">{{ __('app.agent_page.book_an_appointment') }}</span>
                                            <span id="bookAppointmentBtnLoader" style="display: none;">
                                                <i class="fa fa-spinner fa-spin" style="margin-right: 8px;"></i>{{ __('app.common.loading') }}
                                            </span>
                                        </button>
                                        {{-- <button type="button" id="testStripeBtn" class="btn-alt" style="margin-left: 10px;"><span>Test Stripe Connection</span></button> --}}
                                        <div id="msgSubmit" class="h3 hidden"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Book Appointment Form End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Book Appointment Section End -->
    {{-- <h1>Category:{{ $selectedCategory['name'] }}</h1> --}}

    <!-- Why Choose Us Section Start -->

    <!-- Why Choose Us Section End -->
    @include('partials.auth-modals')
@endsection


{{-- Scripts --}}
@section('scripts')
{{-- Bootstrap JS removed - using vanilla modal functions --}}
<script>
    // Global translation strings from Blade
    window.serviceTranslations = {
        seeMore: "{{ __('app.service.see_more') }}",
        seeLess: "{{ __('app.service.see_less') }}"
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
document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM fully loaded - initializing booking form');
    // Check if Stripe is loaded
    console.log('Stripe object availability:', typeof Stripe !== 'undefined' ? 'Available' : 'Not available');
    
    // Extract companyUserName and servicesSlug from URL path if available
    const pathParts = window.location.pathname.split('/').filter(part => part);
    let companyUserNameFromPath = null;
    let servicesSlugFromPath = null;
    
    // Check if URL matches pattern /{companyUserName}/{servicesSlug}
    if (pathParts.length >= 2) {
        // Last two parts should be companyUserName and servicesSlug
        servicesSlugFromPath = pathParts[pathParts.length - 1];
        companyUserNameFromPath = pathParts[pathParts.length - 2];
    }
    
    // Renamed to avoid namespace collision with Bootstrap JS
    const bookingBootstrap = {
        service: @json($selectedService ?? null),
        category: @json($selectedCategory ?? null),
        agents: @json($agents ?? []),
        serviceId: @json($serviceId ?? null),
        serviceProviderId: @json($serviceProviderId ?? null),
        companyUserName: @json($companyUserName ?? null) || companyUserNameFromPath,
        servicesSlug: @json($servicesSlug ?? null) || servicesSlugFromPath,
        userId: @json($userId ?? null),
        userData: @json($userData ?? null),
        stripeConfig: null, // Will be fetched from API
        rescheduleBookingId: @json($rescheduleBookingId ?? null), // Booking ID for reschedule mode
    };

    // Check if we're in reschedule mode
    const isRescheduleMode = !!bookingBootstrap.rescheduleBookingId;
    console.log('Reschedule mode:', isRescheduleMode, 'Booking ID:', bookingBootstrap.rescheduleBookingId);
    
    // Fetch Stripe configuration (test/live mode and publishable key) from API
    fetch('/api/stripe-config')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                bookingBootstrap.stripeConfig = {
                    isLive: data.isLive,
                    publishableKey: data.publishableKey
                };
                console.log('💳 Stripe config loaded:', bookingBootstrap.stripeConfig.isLive ? 'LIVE MODE' : 'TEST MODE');
            } else {
                console.warn('⚠️ Failed to load Stripe config, using fallback');
            }
        })
        .catch(err => {
            console.error('❌ Error fetching Stripe config:', err);
        });
    
    // Log logged-in user data at page load
    console.log('Logged-in user ID:', bookingBootstrap.userId);
    console.log('Logged-in user data:', bookingBootstrap.userData);
    console.log('fire-base-status', firebase.auth().currentUser);

    // Clean up old user_profile_synced keys from previous sessions
    // Keep only the current user's key
    if (bookingBootstrap.userData && bookingBootstrap.userData.id) {
        try {
            const currentUserId = bookingBootstrap.userData.id;
            const keysToRemove = [];
            for (let i = 0; i < sessionStorage.length; i++) {
                const key = sessionStorage.key(i);
                if (key && key.startsWith('user_profile_synced_') && !key.endsWith(currentUserId)) {
                    keysToRemove.push(key);
                }
            }
            keysToRemove.forEach(key => {
                sessionStorage.removeItem(key);
                console.log('Cleaned up old sessionStorage key:', key);
            });
        } catch (error) {
            console.error('Error cleaning up sessionStorage:', error);
        }
    }
    
    // Sync User Profile to External API
    if (bookingBootstrap.userData && bookingBootstrap.userData.id) {
        const SYNC_KEY = 'user_profile_synced_' + bookingBootstrap.userData.id;
        
        if (!sessionStorage.getItem(SYNC_KEY)) {
            console.log('🔄 User data found, syncing profile to external API...', bookingBootstrap.userData);
            
            const userProfilePayload = {
                id: bookingBootstrap.userData.id,
                email: bookingBootstrap.userData.email,
                name: bookingBootstrap.userData.name,
                profileImg: bookingBootstrap.userData.photo || bookingBootstrap.userData.photoURL || "",
                countryCode: "+33", // Default as per requirements
                phone: bookingBootstrap.userData.phone || "",
                platform: "web",
                userRole: 0,
                initialUserRole: 0
            };

            fetch('https://us-central1-beauty-984c8.cloudfunctions.net/createUserProfile', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(userProfilePayload)
            })
            .then(response => {
                if (response.ok) {
                    console.log('✅ User profile synced successfully');
                    sessionStorage.setItem(SYNC_KEY, 'true');
                    return response.json(); 
                } else {
                    console.warn('⚠️ User profile sync returned status:', response.status);
                }
            })
            .then(data => {
                if(data) console.log('Sync response:', data);
            })
            .catch(err => {
                console.error('❌ Error syncing user profile:', err);
            });
        } else {
            console.log('ℹ️ User profile already synced this session.');
        }
    }
    
    // Debug: Log service data to verify ownerMail and ownerProfile are present
    if (bookingBootstrap.service) {
        console.log('=== SERVICE DATA DEBUG (Page Load) ===');
        console.log('Full service object:', bookingBootstrap.service);
        console.log('ownerMail:', bookingBootstrap.service.ownerMail);
        console.log('ownerProfile:', bookingBootstrap.service.ownerProfile);
        console.log('ownerName:', bookingBootstrap.service.ownerName);
        console.log('ownerId:', bookingBootstrap.service.ownerId);
        console.log('All service keys:', Object.keys(bookingBootstrap.service));
        console.log('=====================================');
    }
    
    const dayButtons = document.querySelectorAll('.day-btn');
    const selectedDayInput = document.getElementById('selected_day');
    const selectedDateInput = document.getElementById('selected_date');
    const selectedTimeInput = document.getElementById('selected_time');
    const form = document.getElementById('appointmentForm');
    
    // Terms and conditions checkbox handler
    const termsCheckbox = document.getElementById('termsConditions');
    const termsError = document.getElementById('termsError');
    if (termsCheckbox && termsError) {
        termsCheckbox.addEventListener('change', function() {
            if (this.checked) {
                termsError.style.display = 'none';
                this.classList.remove('is-invalid');
            } else {
                termsError.style.display = 'none';
            }
        });
    }

    // Handle day button selection
    dayButtons.forEach(button => {
        button.addEventListener('click', function () {
            dayButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            selectedDayInput.value = this.dataset.day;
        });
    });

    // Agent selection and schedule rendering
    const agentList = document.getElementById('agentList');
    const agentSchedule = document.getElementById('agentSchedule');
    const timeSlotGrid = document.getElementById('timeSlotGrid');
    const daysHeader = document.querySelector('.days-header');
    const weekDisplay = document.getElementById('weekDisplay');
    const prevWeekBtn = document.getElementById('prevWeek');
    const nextWeekBtn = document.getElementById('nextWeek');
    const selectedSlotInfo = document.getElementById('selectedSlotInfo');
    const selectedDateTimeDisplay = document.getElementById('selectedDateTimeDisplay');
    const periodSelector = document.getElementById('periodSelector');
    const timeSlotsStrip = document.getElementById('timeSlotsStrip');
    const prevTimeSlotBtn = document.getElementById('prevTimeSlot');
    const nextTimeSlotBtn = document.getElementById('nextTimeSlot');
    const paymentOptionsSection = document.getElementById('paymentOptionsSection');
    const mobileTimeSlotsContainer = document.getElementById('mobileTimeSlotsContainer');
    const bookAppointmentBtnText = document.getElementById('bookAppointmentBtnText');

    // Reschedule mode: hide payment choices (but keep terms and button visible)
    const paymentChoicesSection = document.getElementById('paymentChoicesSection');
    if (isRescheduleMode) {
        // Hide only the payment choices, not the entire section (which has terms and button)
        if (paymentChoicesSection) {
            paymentChoicesSection.classList.add('reschedule-hidden');
        }
        // Change button text to indicate reschedule action
        if (bookAppointmentBtnText) {
            bookAppointmentBtnText.textContent = '{{ __('app.bookings.confirm_reschedule') ?? "Confirm Reschedule" }}';
        }
        console.log('Reschedule mode activated - payment choices hidden, button text changed');
    }

    let chosenAgent = null;
    let chosenAgentSlots = null;
    let selectedPeriod = null;
    let cachedAvailableSlots = null; // Cache for API-fetched slots
    let cachedSlotsDate = null; // Track which date the cached slots are for
    
    // Start with today's date as the reference point
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    // Initialize current week start to today
    let currentWeekStart = new Date(today);
    
    // Store today's date for reference
    const todayDate = today.getDate();
    const todayMonth = today.getMonth();
    const todayYear = today.getFullYear();
    
    // Day names mapping - using translations
    const dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    // Short day names from translations (Sunday=0, Monday=1, ..., Saturday=6)
    const shortDayNames = [
        '{{ __('app.schedule.short_sunday') }}',
        '{{ __('app.schedule.short_monday') }}',
        '{{ __('app.schedule.short_tuesday') }}',
        '{{ __('app.schedule.short_wednesday') }}',
        '{{ __('app.schedule.short_thursday') }}',
        '{{ __('app.schedule.short_friday') }}',
        '{{ __('app.schedule.short_saturday') }}'
    ];
    // Month names from translations (January=0, February=1, ..., December=11)
    const monthNames = [
        '{{ __('app.schedule.month_january') }}',
        '{{ __('app.schedule.month_february') }}',
        '{{ __('app.schedule.month_march') }}',
        '{{ __('app.schedule.month_april') }}',
        '{{ __('app.schedule.month_may') }}',
        '{{ __('app.schedule.month_june') }}',
        '{{ __('app.schedule.month_july') }}',
        '{{ __('app.schedule.month_august') }}',
        '{{ __('app.schedule.month_september') }}',
        '{{ __('app.schedule.month_october') }}',
        '{{ __('app.schedule.month_november') }}',
        '{{ __('app.schedule.month_december') }}'
    ];
    const dayKeys = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    // Translation for "at" in date/time display
    const dateTimeAt = '{{ __('app.schedule.at') }}';
    // Current locale (fr or en)
    const currentLocale = '{{ app()->getLocale() }}';
    
    // Fetch available time slots from API
    async function fetchAvailableSlots(serviceId, agentId, date) {
        try {
            console.log('Fetching slots for:', { serviceId, agentId, date });
            
            const apiUrl = `https://us-central1-beauty-984c8.cloudfunctions.net/getAvailableTimeSlots?serviceId=${encodeURIComponent(serviceId)}&agentId=${encodeURIComponent(agentId)}&date=${encodeURIComponent(date)}`;
            
            const response = await fetch(apiUrl);
            
            if (!response.ok) {
                throw new Error(`API returned ${response.status}`);
            }
            
            const data = await response.json();
            console.log('API response:', data);
            
            // Filter to only return available slots
            const availableSlots = (data.slots || []).filter(slot => slot.available === true);
            
            console.log('Available slots:', availableSlots);
            
            return availableSlots;
        } catch (error) {
            console.error('Error fetching time slots:', error);
            throw error;
        }
    }
    
    // Show loading state in time slot grid
    function showSlotsLoading() {
        if (isMobileView()) {
            if (mobileTimeSlotsContainer) {
                mobileTimeSlotsContainer.innerHTML = '<div class="slots-loading" style="text-align: center; padding: 40px; color: #666;"><i class="fas fa-spinner fa-spin" style="font-size: 24px; margin-bottom: 10px;"></i><br>Loading available slots...</div>';
                mobileTimeSlotsContainer.style.display = '';
            }
        } else {
            timeSlotGrid.innerHTML = '<div class="col-12 text-center py-3" style="padding: 20px; color: #666;"><i class="fas fa-spinner fa-spin" style="font-size: 24px; margin-bottom: 10px;"></i><br>Loading available slots...</div>';
            if (timeSlotsStrip) {
                timeSlotsStrip.style.display = '';
                if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = 'none';
                if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = 'none';
            }
        }
    }
    
    // Show error state in time slot grid
    function showSlotsError(message = 'Failed to load time slots. Please try again.') {
        if (isMobileView()) {
            if (mobileTimeSlotsContainer) {
                mobileTimeSlotsContainer.innerHTML = `<div class="slots-error" style="text-align: center; padding: 40px; color: #d9534f;"><i class="fas fa-exclamation-circle" style="font-size: 24px; margin-bottom: 10px;"></i><br>${message}</div>`;
            }
        } else {
            timeSlotGrid.innerHTML = `<div class="col-12 text-center py-3" style="padding: 20px; color: #d9534f;"><i class="fas fa-exclamation-circle" style="font-size: 24px; margin-bottom: 10px;"></i><br>${message}</div>`;
            if (timeSlotsStrip) {
                timeSlotsStrip.style.display = '';
                if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = 'none';
                if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = 'none';
            }
        }
    }
    
    // Format time from "HH:MM" to 24-hour format (for timeSlotsStrip)
    function formatTimeDisplay24(timeStr) {
        const [hours, minutes] = timeStr.split(':').map(Number);
        return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
    }
    
    // Format time from "HH:MM" to 12-hour display format (for selectedDateTimeDisplay)
    // UPDATE: Switched to 24-hour format as per user request
    function formatTimeDisplay(timeStr) {
        const [hours, minutes] = timeStr.split(':').map(Number);
        // Return 24-hour format: 14:00
        return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
    }
    
    // Format date for display (with locale support)
    function formatDate(date) {
        const locale = currentLocale === 'fr' ? 'fr-FR' : 'en-US';
        return date.toLocaleDateString(locale, { 
            month: 'long', 
            day: 'numeric',
            year: 'numeric'
        });
    }
    
    // Format date in YYYY-MM-DD using LOCAL date parts (avoid UTC / timezone shift)
    function formatDateValue(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
    
    // Update the week display
    function updateWeekDisplay() {
        const daysToShow = isMobileView() ? 3 : 7;
        const endDate = new Date(currentWeekStart);
        endDate.setDate(endDate.getDate() + (daysToShow - 1));
        
        // Use translated month names
        const startMonth = monthNames[currentWeekStart.getMonth()];
        const endMonth = monthNames[endDate.getMonth()];
        
        if (startMonth === endMonth) {
            weekDisplay.textContent = `${startMonth} ${currentWeekStart.getDate()} - ${endDate.getDate()}`;
        } else {
            weekDisplay.textContent = `${startMonth} ${currentWeekStart.getDate()} - ${endMonth} ${endDate.getDate()}`;
        }
    }

    // Check if a specific day is open based on agent's timing
    // timing object format: { 'Mon': [openTimestamp, closeTimestamp], 'Tue': [...], ... }
    function isDayOpen(date) {
        if (!chosenAgent || !chosenAgent.timing) {
            // If no agent selected or no timing data, show all days
            return true;
        }

        const dayKey = dayKeys[date.getDay()]; // 'Sun', 'Mon', 'Tue', etc.
        const timing = chosenAgent.timing;

        // Check if this day exists in timing and has valid open/close times
        if (timing[dayKey] && Array.isArray(timing[dayKey]) && timing[dayKey].length === 2) {
            const openTime = timing[dayKey][0];
            const closeTime = timing[dayKey][1];
            // Valid if both times are positive and close is after open
            return openTime > 0 && closeTime > 0 && closeTime > openTime;
        }

        // Day not in timing or invalid - salon is closed
        return false;
    }

    // Render the days header
    function renderDaysHeader() {
        daysHeader.innerHTML = '';
        
        // Calculate how many days to show (up to 7 days from today)
        const daysToShow = 7;
        
        for (let i = 0; i < daysToShow; i++) {
            const date = new Date(currentWeekStart);
            date.setDate(date.getDate() + i);
            
            // Skip rendering if the date is before today
            if (date < today) {
                continue;
            }

            // Skip rendering if the salon/agent is closed on this day
            if (!isDayOpen(date)) {
                continue;
            }

            const dayCol = document.createElement('div');
            dayCol.className = 'day-column';
            dayCol.dataset.date = formatDateValue(date);
            dayCol.dataset.dayIndex = i;
            
            // Check if this is today
            const isToday = date.getDate() === todayDate && 
                           date.getMonth() === todayMonth && 
                           date.getFullYear() === todayYear;
            
            if (isToday) {
                dayCol.classList.add('today');
            }
            
            const dayName = document.createElement('span');
            dayName.className = 'day-name';
            dayName.textContent = shortDayNames[(date.getDay() + 7) % 7];
            
            const dayDate = document.createElement('span');
            dayDate.className = 'day-date';
            dayDate.textContent = date.getDate();
            
            dayCol.appendChild(dayName);
            dayCol.appendChild(dayDate);
            daysHeader.appendChild(dayCol);
            
            // Add click event to select the day and show period selector
            dayCol.addEventListener('click', function() {
                document.querySelectorAll('.day-column').forEach(col => col.classList.remove('active'));
                this.classList.add('active');
                const dayKey = dayKeys[date.getDay()];
                selectedDayInput.value = dayKey;
                selectedDateInput.value = formatDateValue(date);
                
                // Reset period selection when day changes
                selectedPeriod = null;
                periodSelector.querySelectorAll('.period-btn').forEach(btn => btn.classList.remove('active'));
                
                // Show period selector
                periodSelector.style.display = '';
                
                // Check if mobile view
                if (isMobileView()) {
                    // On mobile: Show period selector + render all time slots vertically
                    renderTimeSlotsMobile(dayKey, formatDateValue(date));
                    if (mobileTimeSlotsContainer) {
                        mobileTimeSlotsContainer.style.display = '';
                    }
                    // Hide desktop time slots strip
                    if (timeSlotsStrip) {
                        timeSlotsStrip.style.display = 'none';
                    }
                } else {
                    // On desktop: Fetch slots when date is selected (not on period change)
                    const selectedDate = formatDateValue(date);
                    
                    // Clear cache and fetch new slots for this date
                    cachedAvailableSlots = null;
                    cachedSlotsDate = selectedDate;
                    
                    // Show loading state in desktop view
                    // UPDATE: User requested to remove loader on date selection
                    // timeSlotGrid.innerHTML = '<div class="col-12 text-center py-3" style="padding: 20px; color: #666;"><i class="fas fa-spinner fa-spin" style="font-size: 24px; margin-bottom: 10px;"></i><br>Loading available slots...</div>';
                    timeSlotGrid.innerHTML = '';
                    if (timeSlotsStrip) {
                        timeSlotsStrip.style.display = 'none';
                    }
                    
                    // Fetch slots from API
                    (async () => {
                        try {
                            const urlParams = new URLSearchParams(window.location.search);
                            const serviceId = bookingBootstrap.service?.id || bookingBootstrap.serviceId || urlParams.get('serviceId');
                            
                            if (!serviceId) {
                                throw new Error('Service ID not found');
                            }
                            
                            // Fetch and cache slots
                            cachedAvailableSlots = await fetchAvailableSlots(serviceId, chosenAgent.id, selectedDate);
                            
                            // Clear the grid after fetch completes
                            timeSlotGrid.innerHTML = '';
                            if (timeSlotsStrip) {
                                timeSlotsStrip.style.display = 'none';
                            }
                            
                            console.log('Cached slots for desktop:', cachedAvailableSlots);
                            
                            // Only auto-select period if there's a saved time (for restoration after login)
                            // Check input first, then fallback to localStorage to robustly handle restoration timing
                            let savedTime = selectedTimeInput?.value;
                            
                            if (!savedTime) {
                                try {
                                    const pendingStateStr = localStorage.getItem('pendingBookingState');
                                    if (pendingStateStr) {
                                        const state = JSON.parse(pendingStateStr);
                                        // Ensure state matches current selection
                                        if (state && state.selectedTime && state.selectedDate === selectedDate) {
                                            console.log('Found pending state in localStorage:', state);
                                            savedTime = state.selectedTime;
                                            // Pre-fill input so renderTimeSlots auto-clicker works
                                            selectedTimeInput.value = savedTime;
                                        }
                                    }
                                } catch (e) {
                                    console.error('Error reading pending state:', e);
                                }
                            }
                            
                            if (savedTime) {
                                // Parse the saved time to determine which period it belongs to
                                const [hours] = savedTime.split(':').map(Number);
                                let periodToSelect = 'morning';
                                
                                if (hours >= 6 && hours < 12) {
                                    periodToSelect = 'morning';
                                } else if (hours >= 12 && hours < 17) {
                                    periodToSelect = 'afternoon';
                                } else if (hours >= 17 && hours < 21) {
                                    periodToSelect = 'evening';
                                }
                                
                                console.log('Restoring saved time:', savedTime, '→ period:', periodToSelect);
                                
                                selectedPeriod = periodToSelect;
                                const periodBtn = periodSelector.querySelector(`[data-period="${periodToSelect}"]`);
                                if (periodBtn) {
                                    // Highlight the period button
                                    periodSelector.querySelectorAll('.period-btn').forEach(btn => btn.classList.remove('active'));
                                    periodBtn.classList.add('active');
                                    
                                    // Render slots for the restored period
                                    renderTimeSlots(dayKey, periodToSelect, selectedDate);
                                }
                            }
                            // If no saved time, user needs to manually select a period
                        } catch (error) {
                            console.error('Error fetching slots on date selection:', error);
                            timeSlotGrid.innerHTML = '<div class="col-12 text-center py-3" style="padding: 20px; color: #d9534f;"><i class="fas fa-exclamation-circle" style="font-size: 24px; margin-bottom: 10px;"></i><br>Failed to load time slots. Please try again.</div>';
                        }
                    })();
                    
                    // Hide mobile container
                    if (mobileTimeSlotsContainer) {
                        mobileTimeSlotsContainer.style.display = 'none';
                    }
                }
                
                selectedSlotInfo.style.display = 'none';
                selectedTimeInput.value = '';
                
                // Hide payment options section when day changes
                if (paymentOptionsSection) {
                    paymentOptionsSection.style.display = 'none';
                }
            });
        }
    }
    
    // // Check if enough consecutive slots are available for service duration
    // // Returns true if booking can proceed, false if there's a conflict
    // function hasEnoughConsecutiveSlots(selectedTime, availableSlots, durationMinutes) {
    //     // If no duration specified or no slots, allow (fallback)
    //     if (!durationMinutes || durationMinutes <= 0) return true;
    //     if (!availableSlots || availableSlots.length === 0) return true;
        
    //     const slotIntervalMinutes = 15;
    //     // Calculate how many consecutive slots are needed
    //     // e.g., 45 min service needs slots at 0, 15, 30 mins = 3 slots
    //     const requiredSlots = Math.ceil(durationMinutes / slotIntervalMinutes);
        
    //     // If only 1 slot required, no consecutive check needed
    //     if (requiredSlots <= 1) return true;
        
    //     // Get list of available time strings
    //     const availableTimes = availableSlots.map(s => s.time);
        
    //     // Parse selected time
    //     const [startHour, startMinute] = selectedTime.split(':').map(Number);
    //     const startTotalMinutes = startHour * 60 + startMinute;
        
    //     // Check each required consecutive slot (starting from the selected slot)
    //     for (let i = 0; i < requiredSlots; i++) {
    //         const checkTotalMinutes = startTotalMinutes + (i * slotIntervalMinutes);
    //         const checkHour = Math.floor(checkTotalMinutes / 60);
    //         const checkMin = checkTotalMinutes % 60;
    //         const checkTime = `${checkHour}:${String(checkMin).padStart(2, '0')}`;
            
    //         if (!availableTimes.includes(checkTime)) {
    //             console.log(`Consecutive slot validation failed: ${checkTime} is not available`);
    //             return false; // Missing consecutive slot
    //         }
    //     }
        
    //     console.log(`Consecutive slot validation passed for ${selectedTime} (${requiredSlots} slots needed)`);
    //     return true;
    // }
    
    // Keep function unused (no filtering). Left in place for future use if needed.
    function filterTimeSlotsByDay(dayKey) {}
    
    // Render time slots for selected day and period (horizontal layout)
    // Now uses cached API results (fetched on date selection)
    function renderTimeSlots(selectedDay, selectedPeriod, selectedDate) {
        console.log('Rendering time slots:', { selectedDay, selectedPeriod, selectedDate });
        timeSlotGrid.innerHTML = '';
        
        // Hide time slots strip initially
        if (timeSlotsStrip) {
            timeSlotsStrip.style.display = 'none';
        }
        
        // Hide mobile container (desktop view)
        if (mobileTimeSlotsContainer) {
            mobileTimeSlotsContainer.style.display = 'none';
        }
        
            if (!selectedDay || !selectedDate || !chosenAgent) {
            timeSlotGrid.innerHTML = '<div class="col-12 text-center py-3" style="padding: 20px; color: #666;">{{ __('app.schedule.no_slot_available') }}</div>';
            // Show strip to display message, but hide arrows
            if (timeSlotsStrip) {
                timeSlotsStrip.style.display = '';
                if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = 'none';
                if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = 'none';
            }
            return;
        }
        
        // Use cached slots (already fetched on date selection)
        const availableSlots = cachedAvailableSlots;
        
        if (!availableSlots || availableSlots.length === 0) {
            timeSlotGrid.innerHTML = '<div class="col-12 text-center py-3" style="padding: 20px; color: #666;">{{ __('app.schedule.no_slot_available') }}</div>';
            // Show strip to display message, but hide arrows
            if (timeSlotsStrip) {
                timeSlotsStrip.style.display = '';
                if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = 'none';
                if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = 'none';
            }
            return;
        }
        
        // Define time period ranges (hours)
        const periodRanges = {
            morning: { start: 6, end: 12 },      // 6:00 AM - 11:59 AM
            afternoon: { start: 12, end: 17 },   // 12:00 PM - 4:59 PM
            evening: { start: 17, end: 21 }      // 5:00 PM - 8:59 PM
        };
        
        const period = periodRanges[selectedPeriod];
        if (!period) {
            timeSlotGrid.innerHTML = '<div class="col-12 text-center py-3" style="padding: 20px; color: #666;">{{ __('app.schedule.no_slot_available') }}</div>';
            if (timeSlotsStrip) {
                timeSlotsStrip.style.display = '';
                if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = 'none';
                if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = 'none';
            }
            return;
        }
        
        // Filter slots by selected period (API already filtered by availability)
        const filteredSlots = availableSlots.filter(slot => {
            // Extract hour from time string (format: "HH:MM")
            const [hours, minutes] = slot.time.split(':').map(Number);
            
            // Check if hour falls within the selected period range
            return hours >= period.start && hours < period.end;
        });
        
        if (filteredSlots.length === 0) {
            timeSlotGrid.innerHTML = '<div class="col-12 text-center py-3" style="padding: 20px; color: #666;">{{ __('app.schedule.no_slot_available') }}</div>';
            if (timeSlotsStrip) {
                timeSlotsStrip.style.display = '';
                if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = 'none';
                if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = 'none';
            }
            return;
        }
        
        // Show time slots strip when we have slots to display
        if (timeSlotsStrip) {
            timeSlotsStrip.style.display = '';
            // Show arrows when we have slots
            if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = '';
            if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = '';
        }
        
        // Create horizontal scrollable row of time slots
        filteredSlots.forEach(slot => {
            const timeSlot = document.createElement('div');
            timeSlot.className = 'time-slot';
            timeSlot.dataset.day = selectedDay;
            timeSlot.dataset.time = slot.time;
            timeSlot.dataset.date = selectedDate;
            timeSlot.textContent = formatTimeDisplay24(slot.time);

            // Add click handler for slot selection
            timeSlot.addEventListener('click', function() {
                // const clickedTime = this.dataset.time;
                // const serviceDuration = bookingBootstrap.service?.duration_minutes || 0;
                
                // // Validate consecutive slot availability
                // if (!hasEnoughConsecutiveSlots(clickedTime, cachedAvailableSlots, serviceDuration)) {
                //     const requiredSlots = Math.ceil(serviceDuration / 15);
                //     const alertMsg = `{{ __('app.booking.slot_conflict_alert') }}`.replace(':duration', serviceDuration);
                    
                //     if (typeof Swal !== 'undefined') {
                //         Swal.fire({
                //             icon: 'warning',
                //             text: alertMsg || `This service requires ${serviceDuration} minutes. The next available slots are not free. Please select an earlier time or a different slot.`,
                //             confirmButtonColor: '#000000',
                //             confirmButtonText: 'OK',
                //             customClass: {
                //                 confirmButton: 'btn btn-dark'
                //             }
                //         });
                //     } else {
                //         alert(alertMsg || `This service requires ${serviceDuration} minutes. The next available slots are not free. Please select an earlier time or a different slot.`);
                //     }
                //     return; // Don't proceed with selection
                // }
                
                // Deselect any previously selected slot
                document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));

                // Select this slot
                this.classList.add('selected');

                // Update hidden inputs
                selectedDateInput.value = this.dataset.date;
                selectedTimeInput.value = this.dataset.time;

                // Show selected date/time info (parse as local to avoid UTC offset issues)
                const [yy, mm, dd] = this.dataset.date.split('-').map(Number);
                const selectedDateObj = new Date(yy, mm - 1, dd);
                const formattedDate = formatDate(selectedDateObj);
                const formattedTime = formatTimeDisplay(this.dataset.time);
                selectedDateTimeDisplay.textContent = `${formattedDate} ${dateTimeAt} ${formattedTime}`;
                selectedSlotInfo.style.display = '';
                // Ensure hidden selected day reflects the clicked slot's day
                selectedDayInput.value = this.dataset.day;
                
                // Show payment options section after time slot selection
                if (paymentOptionsSection) {
                    paymentOptionsSection.style.display = '';
                }
            });

            timeSlotGrid.appendChild(timeSlot);
        });
        
        // Update arrow button states after rendering and center the view
        // Update arrow button states after rendering and center the view
        setTimeout(() => {
            updateTimeSlotArrows();
            
            // Auto-select time slot if there's a pre-selected value (for restoration after login)
            const preSelectedTime = selectedTimeInput?.value;
            let slotAutoSelected = false;
            
            if (preSelectedTime) {
                const matchingSlot = timeSlotGrid.querySelector(`[data-time="${preSelectedTime}"]`);
                if (matchingSlot) {
                    console.log('Auto-selecting restored time slot:', preSelectedTime);
                    matchingSlot.click();
                    slotAutoSelected = true;
                    
                    // Scroll to centered position of the selected slot
                    // Use scrollIntoView with inline: 'center' which handles the math reliably
                    setTimeout(() => {
                        matchingSlot.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                    }, 50); // Small delay to ensure layout is stable
                    
                    updateTimeSlotArrows();
                }
            }
            
            // If no slot was auto-selected, just center the list generally
            if (!slotAutoSelected && timeSlotGrid && filteredSlots.length > 6) {
                // Default centering logic for when nothing is selected
                const scrollWidth = timeSlotGrid.scrollWidth;
                const clientWidth = timeSlotGrid.clientWidth;
                timeSlotGrid.scrollLeft = (scrollWidth - clientWidth) / 2;
                updateTimeSlotArrows();
            }
        }, 100);
    }
    
    // Render time slots for mobile (3 vertical columns - one for each period)
    // Now fetches slots from API
    async function renderTimeSlotsMobile(selectedDay, selectedDate) {
        console.log('Rendering mobile time slots:', { selectedDay, selectedDate });
        
        if (!mobileTimeSlotsContainer) return;
        
        mobileTimeSlotsContainer.innerHTML = '';
        
        if (!selectedDay || !selectedDate || !chosenAgent) {
            mobileTimeSlotsContainer.innerHTML = '<div class="mobile-no-slots">{{ __('app.schedule.no_slot_available') }}</div>';
            return;
        }
        
        // Show loading state
        showSlotsLoading();
        
        try {
            // Get serviceId from bookingBootstrap
            const urlParams = new URLSearchParams(window.location.search);
            const serviceId = bookingBootstrap.service?.id || bookingBootstrap.serviceId || urlParams.get('serviceId');
            
            if (!serviceId) {
                throw new Error('Service ID not found');
            }
            
            // Fetch available slots from API
            const availableSlots = await fetchAvailableSlots(serviceId, chosenAgent.id, selectedDate);
            
            if (!availableSlots || availableSlots.length === 0) {
                mobileTimeSlotsContainer.innerHTML = '<div class="mobile-no-slots">{{ __('app.schedule.no_slot_available') }}</div>';
                mobileTimeSlotsContainer.style.display = '';
                return;
            }
            
            // Define time period ranges (hours) - in order: Morning, Afternoon, Evening
            const periodRanges = [
                { key: 'morning', start: 6, end: 12, label: '{{ __('app.agent_page.the_morning') }}' },
                { key: 'afternoon', start: 12, end: 17, label: '{{ __('app.agent_page.in_the_afternoon') }}' },
                { key: 'evening', start: 17, end: 21, label: '{{ __('app.agent_page.in_the_evening') }}' }
            ];
            
            // Create a container for the 3 columns
            const columnsContainer = document.createElement('div');
            columnsContainer.className = 'mobile-slots-columns-container';
            
            // Create a column for each period (Morning, Afternoon, Evening)
            periodRanges.forEach(period => {
                // Filter available slots by period
                const filteredSlots = availableSlots.filter(slot => {
                    const [hours] = slot.time.split(':').map(Number);
                    return hours >= period.start && hours < period.end;
                });
                
                // Create column container
                const column = document.createElement('div');
                column.className = 'mobile-period-column';
                column.id = `mobile-period-${period.key}`;
                
                // Create time slots container for this period (vertical list)
                const slotsContainer = document.createElement('div');
                slotsContainer.className = 'mobile-period-slots';
                slotsContainer.dataset.period = period.key;
                slotsContainer.dataset.allSlots = JSON.stringify(filteredSlots);
                
                if (filteredSlots.length === 0) {
                    const noSlotsMsg = document.createElement('div');
                    noSlotsMsg.className = 'mobile-period-no-slots';
                    noSlotsMsg.textContent = '{{ __('app.schedule.no_slot') }}';
                    slotsContainer.appendChild(noSlotsMsg);
                } else {
                    // Show only first 3 slots initially
                    const initialSlots = filteredSlots.slice(0, 3);
                    const remainingSlots = filteredSlots.slice(3);
                    
                    // Create time slot buttons vertically (only first 3 visible)
                    initialSlots.forEach(slot => {
                        const timeSlot = document.createElement('div');
                        timeSlot.className = 'mobile-time-slot';
                        timeSlot.dataset.day = selectedDay;
                        timeSlot.dataset.time = slot.time;
                        timeSlot.dataset.date = selectedDate;
                        timeSlot.dataset.period = period.key;
                        timeSlot.textContent = formatTimeDisplay24(slot.time);
                        
                        // Add click handler for slot selection
                        timeSlot.addEventListener('click', function() {
                            // const clickedTime = this.dataset.time;
                            // const serviceDuration = bookingBootstrap.service?.duration_minutes || 0;
                            
                            // // Validate consecutive slot availability
                            // if (!hasEnoughConsecutiveSlots(clickedTime, availableSlots, serviceDuration)) {
                            //     const alertMsg = `{{ __('app.booking.slot_conflict_alert') }}`.replace(':duration', serviceDuration);
                                
                            //     if (typeof Swal !== 'undefined') {
                            //         Swal.fire({
                            //             icon: 'warning',
                            //             text: alertMsg || `This service requires ${serviceDuration} minutes. The next available slots are not free. Please select an earlier time or a different slot.`,
                            //             confirmButtonColor: '#000000',
                            //             confirmButtonText: 'OK',
                            //             customClass: {
                            //                 confirmButton: 'btn btn-dark'
                            //             }
                            //         });
                            //     } else {
                            //         alert(alertMsg || `This service requires ${serviceDuration} minutes. The next available slots are not free. Please select an earlier time or a different slot.`);
                            //     }
                            //     return; // Don't proceed with selection
                            // }
                            
                            // Deselect any previously selected slot
                            document.querySelectorAll('.mobile-time-slot, .time-slot').forEach(s => s.classList.remove('selected'));
                            
                            // Select this slot
                            this.classList.add('selected');
                            
                            // Update hidden inputs
                            selectedDateInput.value = this.dataset.date;
                            selectedTimeInput.value = this.dataset.time;
                            selectedDayInput.value = this.dataset.day;
                            
                            // Set selected period
                            selectedPeriod = this.dataset.period;
                            
                            // Highlight the corresponding period button
                            periodSelector.querySelectorAll('.period-btn').forEach(btn => {
                                if (btn.dataset.period === period.key) {
                                    btn.classList.add('active');
                                } else {
                                    btn.classList.remove('active');
                                }
                            });
                            
                            // Show selected date/time info
                            const [yy, mm, dd] = this.dataset.date.split('-').map(Number);
                            const selectedDateObj = new Date(yy, mm - 1, dd);
                            const formattedDate = formatDate(selectedDateObj);
                            const formattedTime = formatTimeDisplay(this.dataset.time);
                            selectedDateTimeDisplay.textContent = `${formattedDate} ${dateTimeAt} ${formattedTime}`;
                            selectedSlotInfo.style.display = '';
                            
                            // Show payment options section after time slot selection
                            if (paymentOptionsSection) {
                                paymentOptionsSection.style.display = '';
                            }
                        });
                        
                        slotsContainer.appendChild(timeSlot);
                    });
                    
                    // Store remaining slots data for "See More" functionality
                    slotsContainer.dataset.hasMore = remainingSlots.length > 0 ? 'true' : 'false';
                    slotsContainer.dataset.remainingSlots = JSON.stringify(remainingSlots);
                }
                
                column.appendChild(slotsContainer);
                columnsContainer.appendChild(column);
            });
            
            mobileTimeSlotsContainer.innerHTML = '';
            mobileTimeSlotsContainer.appendChild(columnsContainer);
            mobileTimeSlotsContainer.style.display = '';
            
            // Add "See More" button if any column has more slots
            const hasMoreSlots = Array.from(columnsContainer.querySelectorAll('.mobile-period-slots')).some(
                container => container.dataset.hasMore === 'true'
            );
            
            if (hasMoreSlots) {
                const seeMoreBtn = document.createElement('button');
                seeMoreBtn.className = 'mobile-see-more-btn';
                seeMoreBtn.textContent = '{{ __('app.agent_page.see_more') }}';
                seeMoreBtn.type = 'button';
                
                seeMoreBtn.addEventListener('click', function() {
                    // Expand all columns to show all slots
                    const allSlotsContainers = columnsContainer.querySelectorAll('.mobile-period-slots');
                    allSlotsContainers.forEach(container => {
                        if (container.dataset.hasMore === 'true') {
                            const remainingSlots = JSON.parse(container.dataset.remainingSlots);
                            const selectedDay = container.querySelector('.mobile-time-slot')?.dataset.day || selectedDayInput.value;
                            const selectedDate = container.querySelector('.mobile-time-slot')?.dataset.date || selectedDateInput.value;
                            const periodKey = container.dataset.period;
                            
                            // Add remaining slots
                            remainingSlots.forEach(slot => {
                                const timeSlot = document.createElement('div');
                                timeSlot.className = 'mobile-time-slot';
                                timeSlot.dataset.day = selectedDay;
                                timeSlot.dataset.time = slot.time;
                                timeSlot.dataset.date = selectedDate;
                                timeSlot.dataset.period = periodKey;
                                timeSlot.textContent = formatTimeDisplay24(slot.time);
                                
                                // Add click handler for slot selection
                                timeSlot.addEventListener('click', function() {
                                    // const clickedTime = this.dataset.time;
                                    // const serviceDuration = bookingBootstrap.service?.duration_minutes || 0;
                                    
                                    // // Use availableSlots from closure (contains ALL slots for the day) for correct boundary checking
                                    // // box container.dataset.allSlots only contains filtered slots for this period
                                    
                                    // // Validate consecutive slot availability
                                    // if (!hasEnoughConsecutiveSlots(clickedTime, availableSlots, serviceDuration)) {
                                    //     const alertMsg = `{{ __('app.booking.slot_conflict_alert') }}`.replace(':duration', serviceDuration);
                                        
                                    //     if (typeof Swal !== 'undefined') {
                                    //         Swal.fire({
                                    //             icon: 'warning',
                                    //             text: alertMsg || `This service requires ${serviceDuration} minutes. The next available slots are not free. Please select an earlier time or a different slot.`,
                                    //             confirmButtonColor: '#000000',
                                    //             confirmButtonText: 'OK',
                                    //             customClass: {
                                    //                 confirmButton: 'btn btn-dark'
                                    //             }
                                    //         });
                                    //     } else {
                                    //         alert(alertMsg || `This service requires ${serviceDuration} minutes. The next available slots are not free. Please select an earlier time or a different slot.`);
                                    //     }
                                    //     return; // Don't proceed with selection
                                    // }
                                    
                                    // Deselect any previously selected slot
                                    document.querySelectorAll('.mobile-time-slot, .time-slot').forEach(s => s.classList.remove('selected'));
                                    
                                    // Select this slot
                                    this.classList.add('selected');
                                    
                                    // Update hidden inputs
                                    selectedDateInput.value = this.dataset.date;
                                    selectedTimeInput.value = this.dataset.time;
                                    selectedDayInput.value = this.dataset.day;
                                    
                                    // Set selected period
                                    selectedPeriod = this.dataset.period;
                                    
                                    // Highlight the corresponding period button
                                    periodSelector.querySelectorAll('.period-btn').forEach(btn => {
                                        if (btn.dataset.period === periodKey) {
                                            btn.classList.add('active');
                                        } else {
                                            btn.classList.remove('active');
                                        }
                                    });
                                    
                                    // Show selected date/time info
                                    const [yy, mm, dd] = this.dataset.date.split('-').map(Number);
                                    const selectedDateObj = new Date(yy, mm - 1, dd);
                                    const formattedDate = formatDate(selectedDateObj);
                                    const formattedTime = formatTimeDisplay(this.dataset.time);
                                    selectedDateTimeDisplay.textContent = `${formattedDate} ${dateTimeAt} ${formattedTime}`;
                                    selectedSlotInfo.style.display = '';
                                    
                                    // Show payment options section after time slot selection
                                    if (paymentOptionsSection) {
                                        paymentOptionsSection.style.display = '';
                                    }
                                });
                                
                                container.appendChild(timeSlot);
                            });
                            
                            // Mark as expanded
                            container.dataset.hasMore = 'false';
                        }
                    });
                    
                    // Hide the "See More" button after expanding
                    this.style.display = 'none';
                });
                
                mobileTimeSlotsContainer.appendChild(seeMoreBtn);
            }
            
            // Auto-select time slot if there's a pre-selected value (for restoration after login)
            setTimeout(() => {
                const preSelectedTime = selectedTimeInput?.value;
                if (preSelectedTime) {
                    const matchingSlot = mobileTimeSlotsContainer.querySelector(`.mobile-time-slot[data-time="${preSelectedTime}"]`);
                    if (matchingSlot) {
                        console.log('Auto-selecting restored time slot (mobile):', preSelectedTime);
                        matchingSlot.click();
                    }
                }
            }, 150);
        } catch (error) {
            console.error('Error rendering mobile time slots:', error);
            showSlotsError();
        }
    }
    
    // Helper function to update time slot arrow states
    function updateTimeSlotArrows() {
        if (!timeSlotGrid || !prevTimeSlotBtn || !nextTimeSlotBtn) return;
        
        const isAtStart = timeSlotGrid.scrollLeft <= 0;
        const isAtEnd = timeSlotGrid.scrollLeft >= (timeSlotGrid.scrollWidth - timeSlotGrid.clientWidth - 1);
        
        prevTimeSlotBtn.disabled = isAtStart;
        if (isAtStart) {
            prevTimeSlotBtn.classList.add('disabled');
        } else {
            prevTimeSlotBtn.classList.remove('disabled');
        }
        
        nextTimeSlotBtn.disabled = isAtEnd;
        if (isAtEnd) {
            nextTimeSlotBtn.classList.add('disabled');
        } else {
            nextTimeSlotBtn.classList.remove('disabled');
        }
    }
    
    // Function to check if a date is in the past (before today)
    function isDateInPast(date) {
        return date < today;
    }
    
    // Helper function to detect mobile viewport (width <= 768px)
    function isMobileView() {
        return window.innerWidth <= 768;
    }
    
    // Get the number of days to navigate based on viewport
    function getDaysToNavigate() {
        return isMobileView() ? 3 : 7;
    }
    
    // Function to update the prev week button state
    function updatePrevWeekButtonState() {
        // Calculate the date that would be the start of the previous period
        const daysToNavigate = getDaysToNavigate();
        const prevWeekDate = new Date(currentWeekStart);
        prevWeekDate.setDate(prevWeekDate.getDate() - daysToNavigate);
        
        // Disable the button if the previous period would be in the past
        if (isDateInPast(prevWeekDate)) {
            prevWeekBtn.classList.add('disabled');
            prevWeekBtn.setAttribute('disabled', 'disabled');
        } else {
            prevWeekBtn.classList.remove('disabled');
            prevWeekBtn.removeAttribute('disabled');
        }
    }
    
    // Navigate to previous week/period
    prevWeekBtn.addEventListener('click', function() {
        // Calculate the new period start based on viewport
        const daysToNavigate = getDaysToNavigate();
        const newWeekStart = new Date(currentWeekStart);
        newWeekStart.setDate(newWeekStart.getDate() - daysToNavigate);
        
        // Only navigate if the new period start is not in the past
        if (!isDateInPast(newWeekStart)) {
            currentWeekStart = newWeekStart;
            updateWeekDisplay();
            renderDaysHeader();
            
            // Reset period selection and hide time slots
            selectedPeriod = null;
            periodSelector.querySelectorAll('.period-btn').forEach(btn => btn.classList.remove('active'));
            periodSelector.style.display = 'none';
            timeSlotGrid.innerHTML = '';
            if (timeSlotsStrip) {
                timeSlotsStrip.style.display = 'none';
            }
            if (mobileTimeSlotsContainer) {
                mobileTimeSlotsContainer.style.display = 'none';
                mobileTimeSlotsContainer.innerHTML = '';
            }
            selectedSlotInfo.style.display = 'none';
            selectedTimeInput.value = '';
            
            // Hide payment options section when period navigation changes
            if (paymentOptionsSection) {
                paymentOptionsSection.style.display = 'none';
            }
            
            // Clear day selection
            document.querySelectorAll('.day-column').forEach(col => col.classList.remove('active'));
            selectedDayInput.value = '';
            selectedDateInput.value = '';
        }
        
        // Update button state
        updatePrevWeekButtonState();
    });
    
    // Navigate to next week/period
    nextWeekBtn.addEventListener('click', function() {
        // Calculate the new period start based on viewport
        const daysToNavigate = getDaysToNavigate();
        currentWeekStart.setDate(currentWeekStart.getDate() + daysToNavigate);
        updateWeekDisplay();
        renderDaysHeader();
        
        // Reset period selection and hide time slots
        selectedPeriod = null;
        periodSelector.querySelectorAll('.period-btn').forEach(btn => btn.classList.remove('active'));
        periodSelector.style.display = 'none';
        timeSlotGrid.innerHTML = '';
        if (timeSlotsStrip) {
            timeSlotsStrip.style.display = 'none';
        }
        if (mobileTimeSlotsContainer) {
            mobileTimeSlotsContainer.style.display = 'none';
            mobileTimeSlotsContainer.innerHTML = '';
        }
        selectedSlotInfo.style.display = 'none';
        selectedTimeInput.value = '';
        
        // Clear day selection
        document.querySelectorAll('.day-column').forEach(col => col.classList.remove('active'));
        selectedDayInput.value = '';
        selectedDateInput.value = '';
        
        // Update button state
        updatePrevWeekButtonState();
    });
    
    // Initialize the calendar when an agent is selected
    if (agentList) {
        agentList.addEventListener('click', (e) => {
            const avatar = e.target.closest('.agent-avatar');
            if (!avatar) return;
            
            // Highlight selection
            [...agentList.querySelectorAll('.agent-avatar')].forEach(el => el.classList.remove('active'));
            avatar.classList.add('active');

            // Parse agent data
            const agent = JSON.parse(avatar.dataset.agent);
            chosenAgent = agent;
            
            // Debug agent data
            console.log('Agent data:', agent);
            console.log('Agent slots:', agent.slots);
            console.log('Agent timing:', agent.timing);
            
            // Log logged-in user data
            console.log('Logged-in user data:', bookingBootstrap.userData);
            
            
            // Show the schedule section
            agentSchedule.style.display = '';
            
            // Reset selection
            selectedDayInput.value = '';
            selectedDateInput.value = '';
            selectedTimeInput.value = '';
            selectedSlotInfo.style.display = 'none';
            selectedPeriod = null;
            
            // Hide period selector and time slot grid initially
            periodSelector.style.display = 'none';
            timeSlotGrid.innerHTML = '';
            if (timeSlotsStrip) {
                timeSlotsStrip.style.display = 'none';
            }
            if (mobileTimeSlotsContainer) {
                mobileTimeSlotsContainer.style.display = 'none';
                mobileTimeSlotsContainer.innerHTML = '';
            }
            
            // Hide payment options section when agent changes
            if (paymentOptionsSection) {
                paymentOptionsSection.style.display = 'none';
            }
            
            // Reset period selector active states
            periodSelector.querySelectorAll('.period-btn').forEach(btn => btn.classList.remove('active'));
            
            // Initialize the week display
            updateWeekDisplay();
            renderDaysHeader();
            
            // Initialize the button state
            updatePrevWeekButtonState();
            
            // No longer need to store agent slots - they will be fetched from API when needed
            
            // Automatically select today's date
            setTimeout(() => {
                const todayColumn = document.querySelector('.day-column.today');
                if (todayColumn) {
                    todayColumn.click();
                } else {
                    // If today is not visible, find the first available day column
                    const firstDayColumn = document.querySelector('.day-column');
                    if (firstDayColumn) {
                        firstDayColumn.click();
                    }
                }
            }, 100);
        });
    }

    // Period selector click handler
    if (periodSelector) {
        periodSelector.addEventListener('click', (e) => {
            const periodBtn = e.target.closest('.period-btn');
            if (!periodBtn) return;
            
            // Check if a day is selected
            const activeDay = document.querySelector('.day-column.active');
            if (!activeDay) {
                alert('Please select a day first');
                return;
            }
            
            const dayKey = selectedDayInput.value;
            if (!dayKey) {
                alert('Please select a day first');
                return;
            }
            
            // Get selected period
            const period = periodBtn.dataset.period;
            selectedPeriod = period;
            
            // Highlight selection
            periodSelector.querySelectorAll('.period-btn').forEach(btn => btn.classList.remove('active'));
            periodBtn.classList.add('active');
            
            // Check if mobile view
            if (isMobileView()) {
                // On mobile: Scroll to the period's time slots section
                const periodSection = document.getElementById(`mobile-period-${period}`);
                if (periodSection) {
                    periodSection.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    // Add a temporary highlight effect
                    periodSection.style.transition = 'background-color 0.3s ease';
                    periodSection.style.backgroundColor = 'rgba(229, 0, 80, 0.1)';
                    setTimeout(() => {
                        periodSection.style.backgroundColor = '';
                    }, 1000);
                }
            } else {
                // On desktop: Render horizontal time slots for selected period
                const selectedDate = selectedDateInput.value;
                renderTimeSlots(dayKey, period, selectedDate);
            }
        });
    }

    // Time slot navigation arrows
    if (prevTimeSlotBtn && nextTimeSlotBtn) {
        // Previous time slot button
        prevTimeSlotBtn.addEventListener('click', function() {
            if (timeSlotGrid) {
                timeSlotGrid.scrollBy({
                    left: -150,
                    behavior: 'smooth'
                });
            }
        });

        // Next time slot button
        nextTimeSlotBtn.addEventListener('click', function() {
            if (timeSlotGrid) {
                timeSlotGrid.scrollBy({
                    left: 150,
                    behavior: 'smooth'
                });
            }
        });

        // Update arrow states on scroll
        if (timeSlotGrid) {
            timeSlotGrid.addEventListener('scroll', updateTimeSlotArrows);
        }
    }

    // Function to show/hide loading state on button
    function setButtonLoading(isLoading) {
        const submitBtn = document.getElementById('bookAppointmentBtn');
        const btnText = document.getElementById('bookAppointmentBtnText');
        const btnLoader = document.getElementById('bookAppointmentBtnLoader');
        
        if (submitBtn && btnText && btnLoader) {
            if (isLoading) {
                submitBtn.disabled = true;
                btnText.style.display = 'none';
                btnLoader.style.display = 'inline';
            } else {
                submitBtn.disabled = false;
                btnText.style.display = 'inline';
                btnLoader.style.display = 'none';
            }
        }
    }

    // Helper function to wait for an element to appear (with timeout)
    function waitForElement(selector, maxWait = 500, interval = 20) {
        return new Promise((resolve) => {
            const element = document.querySelector(selector);
            if (element) {
                resolve(element);
                return;
            }

            const startTime = Date.now();
            const checkInterval = setInterval(() => {
                const el = document.querySelector(selector);
                if (el) {
                    clearInterval(checkInterval);
                    resolve(el);
                } else if (Date.now() - startTime >= maxWait) {
                    clearInterval(checkInterval);
                    resolve(null);
                }
            }, interval);
        });
    }

    // Helper function to restore time slot and payment options
    function restoreTimeSlotAndPayment(state, skipSlotClick = false) {
        // Use requestAnimationFrame for faster DOM sync
        requestAnimationFrame(() => {
            if (state.selectedDate && state.selectedTime && selectedDateInput && selectedTimeInput) {
                // Check if mobile or desktop view
                const isMobile = isMobileView();
                const slotSelector = isMobile 
                    ? `.mobile-time-slot[data-date="${state.selectedDate}"][data-time="${state.selectedTime}"]`
                    : `.time-slot[data-date="${state.selectedDate}"][data-time="${state.selectedTime}"]`;
                
                // Find and click the time slot
                let timeSlot = document.querySelector(slotSelector);
                
                // On mobile, if slot not found, it might be in "See More" section - try to expand it
                if (!timeSlot && isMobile && state.selectedPeriod) {
                    // Find the period container that should have this slot
                    const periodContainer = document.querySelector(
                        `.mobile-period-slots[data-period="${state.selectedPeriod}"]`
                    );
                    
                    if (periodContainer && periodContainer.dataset.hasMore === 'true') {
                        // Check if the slot is in remaining slots
                        try {
                            const remainingSlots = JSON.parse(periodContainer.dataset.remainingSlots || '[]');
                            const slotExists = remainingSlots.some(slot => slot.time === state.selectedTime);
                            
                            if (slotExists) {
                                // Click "See More" button to expand slots
                                const seeMoreBtn = document.querySelector('.mobile-see-more-btn');
                                if (seeMoreBtn) {
                                    seeMoreBtn.click();
                                    // Poll for slot to appear (faster than fixed timeout)
                                    (async () => {
                                        const expandedSlot = await waitForElement(slotSelector, 300, 20);
                                        if (expandedSlot) {
                                            expandedSlot.click();
                                            console.log('Restored mobile time slot selection (after expand):', state.selectedDate, state.selectedTime);
                                        }
                                    })();
                                }
                            }
                        } catch (e) {
                            console.warn('Error checking remaining slots:', e);
                        }
                    }
                }
                
                if (timeSlot && !timeSlot.classList.contains('unavailable')) {
                    timeSlot.click();
                    console.log('Restored time slot selection:', state.selectedDate, state.selectedTime, isMobile ? '(mobile)' : '(desktop)');
                } else {
                    // If exact slot not found or unavailable, try to set values directly
                    // This handles cases where slot might have become unavailable
                    selectedDateInput.value = state.selectedDate;
                    selectedTimeInput.value = state.selectedTime;
                    if (state.selectedDay) {
                        selectedDayInput.value = state.selectedDay;
                    }
                    // Show payment options if time was selected
                    if (paymentOptionsSection) {
                        paymentOptionsSection.style.display = '';
                    }
                    // Update selected slot info display if available
                    if (selectedSlotInfo && selectedDateTimeDisplay) {
                        const [yy, mm, dd] = state.selectedDate.split('-').map(Number);
                        const selectedDateObj = new Date(yy, mm - 1, dd);
                        const formattedDate = formatDate(selectedDateObj);
                        const formattedTime = formatTimeDisplay(state.selectedTime);
                        selectedDateTimeDisplay.textContent = `${formattedDate} ${dateTimeAt} ${formattedTime}`;
                        selectedSlotInfo.style.display = '';
                    }
                    if (!timeSlot) {
                        console.warn('Time slot not found, restored values directly. Slot may no longer be available.', isMobile ? '(mobile)' : '(desktop)');
                    } else {
                        console.warn('Time slot is unavailable, restored values directly.');
                    }
                }
            }

            // Restore payment type selection
            if (state.paymentType) {
                const paymentRadio = document.querySelector(`input[name="paymentType"][value="${state.paymentType}"]`);
                if (paymentRadio) {
                    paymentRadio.checked = true;
                    console.log('Restored payment type:', state.paymentType);
                }
            }

            // Restore terms checkbox
            if (state.termsChecked && termsCheckbox) {
                termsCheckbox.checked = true;
                console.log('Restored terms checkbox');
            }

            // Clear the saved state after successful restoration
            localStorage.removeItem('pendingBookingState');
            console.log('Booking state restored successfully');
        });
    }

    // Function to restore pending booking state after login
    function restorePendingBookingState() {
        try {
            const savedState = localStorage.getItem('pendingBookingState');
            if (!savedState) {
                return; // No saved state to restore
            }

            const state = JSON.parse(savedState);
            console.log('Restoring pending booking state:', state);

            // Check if user is now logged in (state should only be restored after login)
            if (!bookingBootstrap.userId) {
                console.log('User not logged in yet, skipping state restoration');
                return;
            }

            // Restore the week navigation position BEFORE clicking agent
            // This ensures the correct week is displayed when the days header is rendered
            if (state.currentWeekStartDate) {
                const [yy, mm, dd] = state.currentWeekStartDate.split('-').map(Number);
                const savedWeekStart = new Date(yy, mm - 1, dd);
                savedWeekStart.setHours(0, 0, 0, 0);
                
                // Only restore if the saved date is valid and not in the past
                if (!isNaN(savedWeekStart.getTime()) && savedWeekStart >= today) {
                    currentWeekStart = savedWeekStart;
                    console.log('Restored week start to:', currentWeekStart);
                } else if (state.selectedDate) {
                    // Fallback: calculate week start from the selected date
                    const [sy, sm, sd] = state.selectedDate.split('-').map(Number);
                    const selectedDateObj = new Date(sy, sm - 1, sd);
                    selectedDateObj.setHours(0, 0, 0, 0);
                    
                    if (!isNaN(selectedDateObj.getTime()) && selectedDateObj >= today) {
                        // Calculate the start of the week/period containing this date
                        const daysToNavigate = isMobileView() ? 3 : 7;
                        const daysDiff = Math.floor((selectedDateObj - today) / (1000 * 60 * 60 * 24));
                        const periodsToAdvance = Math.floor(daysDiff / daysToNavigate);
                        
                        currentWeekStart = new Date(today);
                        currentWeekStart.setDate(today.getDate() + (periodsToAdvance * daysToNavigate));
                        console.log('Calculated week start from selected date:', currentWeekStart);
                    }
                }
            } else if (state.selectedDate) {
                // No saved week start, calculate from selected date
                const [sy, sm, sd] = state.selectedDate.split('-').map(Number);
                const selectedDateObj = new Date(sy, sm - 1, sd);
                selectedDateObj.setHours(0, 0, 0, 0);
                
                if (!isNaN(selectedDateObj.getTime()) && selectedDateObj >= today) {
                    // Calculate the start of the week/period containing this date
                    const daysToNavigate = isMobileView() ? 3 : 7;
                    const daysDiff = Math.floor((selectedDateObj - today) / (1000 * 60 * 60 * 24));
                    const periodsToAdvance = Math.floor(daysDiff / daysToNavigate);
                    
                    currentWeekStart = new Date(today);
                    currentWeekStart.setDate(today.getDate() + (periodsToAdvance * daysToNavigate));
                    console.log('Calculated week start from selected date (no saved week):', currentWeekStart);
                }
            }

            // Check if agent still exists in the list
            let agentFound = false;
            if (state.agentId && agentList) {
                const agentAvatars = agentList.querySelectorAll('.agent-avatar');
                for (const avatar of agentAvatars) {
                    try {
                        const agent = JSON.parse(avatar.dataset.agent);
                        if (agent.id === state.agentId) {
                            agentFound = true;
                            // Trigger click on agent avatar to initialize everything
                            // Note: The agent click will call renderDaysHeader() which uses the restored currentWeekStart
                            avatar.click();
                            console.log('Restored agent selection:', agent.name);
                            break;
                        }
                    } catch (e) {
                        console.warn('Error parsing agent data:', e);
                    }
                }
            }

            if (!agentFound && state.agentId) {
                console.warn('Agent not found in list, cannot restore booking state');
                localStorage.removeItem('pendingBookingState');
                return;
            }

            // Wait for agent selection to initialize, then restore other selections
            setTimeout(() => {
                // Restore day selection first - find the day column by date
                if (state.selectedDate && selectedDateInput) {
                    let dayColumn = document.querySelector(`.day-column[data-date="${state.selectedDate}"]`);
                    
                    // If day column not found, it might be because the week display doesn't show it yet
                    // Navigate forward until we find it
                    if (!dayColumn) {
                        console.log('Day column not found in current view, attempting to navigate to correct week...');
                        
                        const [sy, sm, sd] = state.selectedDate.split('-').map(Number);
                        const targetDate = new Date(sy, sm - 1, sd);
                        targetDate.setHours(0, 0, 0, 0);
                        
                        // Calculate how many navigation steps needed
                        const daysToNavigate = isMobileView() ? 3 : 7;
                        let attempts = 0;
                        const maxAttempts = 52; // Max 1 year of weeks
                        
                        while (!dayColumn && attempts < maxAttempts) {
                            const periodEnd = new Date(currentWeekStart);
                            periodEnd.setDate(periodEnd.getDate() + (daysToNavigate - 1));
                            
                            // Check if target date is within current period
                            if (targetDate >= currentWeekStart && targetDate <= periodEnd) {
                                // Refresh the display and try to find the day column again
                                updateWeekDisplay();
                                renderDaysHeader();
                                updatePrevWeekButtonState();
                                dayColumn = document.querySelector(`.day-column[data-date="${state.selectedDate}"]`);
                                break;
                            }
                            
                            // Navigate forward
                            currentWeekStart.setDate(currentWeekStart.getDate() + daysToNavigate);
                            updateWeekDisplay();
                            renderDaysHeader();
                            updatePrevWeekButtonState();
                            
                            dayColumn = document.querySelector(`.day-column[data-date="${state.selectedDate}"]`);
                            attempts++;
                        }
                        
                        if (dayColumn) {
                            console.log('Found day column after navigating', attempts, 'periods');
                        }
                    }
                    
                    if (dayColumn) {
                        // Click the day column to trigger day selection
                        dayColumn.click();
                        console.log('Restored day selection:', state.selectedDate);

                        // Use async/await with polling instead of fixed timeouts
                        const isMobile = isMobileView();

                        (async () => {
                            if (isMobile) {
                                // On mobile: slots render sync, just need a frame for DOM update
                                await new Promise(r => requestAnimationFrame(r));

                                // Restore period highlight
                                if (state.selectedPeriod && periodSelector) {
                                    selectedPeriod = state.selectedPeriod;
                                    const periodBtn = periodSelector.querySelector(`[data-period="${state.selectedPeriod}"]`);
                                    if (periodBtn) {
                                        periodBtn.classList.add('active');
                                        console.log('Restored period selection (mobile):', state.selectedPeriod);
                                    }
                                }
                                // Restore time slot directly
                                restoreTimeSlotAndPayment(state, false);
                            } else {
                                // On desktop: wait for period selector to appear (means day selection complete)
                                await waitForElement('.period-btn', 300, 20);

                                if (state.selectedPeriod && periodSelector) {
                                    selectedPeriod = state.selectedPeriod;
                                    const periodBtn = periodSelector.querySelector(`[data-period="${state.selectedPeriod}"]`);
                                    if (periodBtn) {
                                        const activeDay = document.querySelector('.day-column.active');
                                        if (activeDay && selectedDayInput.value) {
                                            periodBtn.click();
                                            console.log('Restored period selection (desktop):', state.selectedPeriod);

                                            // Wait for time slots to render (API call + DOM)
                                            const slotSelector = `.time-slot[data-date="${state.selectedDate}"][data-time="${state.selectedTime}"]`;
                                            await waitForElement(slotSelector, 800, 30);

                                            restoreTimeSlotAndPayment(state);
                                        } else {
                                            console.warn('Day not properly selected, cannot restore period');
                                            restoreTimeSlotAndPayment(state, true);
                                        }
                                    } else {
                                        console.warn('Period button not found');
                                        restoreTimeSlotAndPayment(state, true);
                                    }
                                } else {
                                    restoreTimeSlotAndPayment(state, true);
                                }
                            }
                        })();
                    } else {
                        console.warn('Day column not found for date:', state.selectedDate);
                        // Try to set values directly
                        if (state.selectedDay) {
                            selectedDayInput.value = state.selectedDay;
                        }
                        if (state.selectedDate) {
                            selectedDateInput.value = state.selectedDate;
                        }
                        restoreTimeSlotAndPayment(state, true);
                    }
                } else {
                    console.warn('No selected date in saved state');
                    restoreTimeSlotAndPayment(state, true);
                }
            }, 100); // Reduced from 800ms - agent selection is sync, just need DOM to update
        } catch (error) {
            console.error('Error restoring pending booking state:', error);
            // Clear invalid state
            localStorage.removeItem('pendingBookingState');
        }
    }

    // Restore pending booking state if user just logged in
    restorePendingBookingState();

    // === Email Sending Helper Functions (for direct redirect flow) ===
    // Note: currentLocale is already defined earlier in this file (around line 568)
    
    // Helper function to parse date from booking_time string
    function parseBookingDate(bookingTimeString) {
        if (!bookingTimeString) return null;
        try {
            const datePart = bookingTimeString.split(' at ')[0];
            if (!datePart) return null;
            const date = new Date(datePart);
            if (isNaN(date.getTime())) return null;
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        } catch (error) {
            console.error('Error parsing booking date:', error);
            return null;
        }
    }
    
    // Helper function to parse time from booking_time string
    function parseBookingTime(bookingTimeString, bookTimeField) {
        if (bookTimeField) return bookTimeField;
        if (!bookingTimeString) return null;
        try {
            const timePart = bookingTimeString.split(' at ')[1];
            if (!timePart) return null;
            const timeMatch = timePart.match(/(\d+):(\d+):\d+\s+(AM|PM)/i);
            if (timeMatch) {
                let hour = parseInt(timeMatch[1]);
                const minute = timeMatch[2];
                const ampm = timeMatch[3].toUpperCase();
                if (ampm === 'PM' && hour !== 12) hour += 12;
                else if (ampm === 'AM' && hour === 12) hour = 0;
                return `${hour}:${minute}`;
            }
            const fallbackMatch = timePart.match(/(\d+):(\d+):/);
            if (fallbackMatch) {
                return `${parseInt(fallbackMatch[1])}:${fallbackMatch[2]}`;
            }
            return null;
        } catch (error) {
            console.error('Error parsing booking time:', error);
            return null;
        }
    }
    
    // Function to generate Google Maps directions link
    function getMapLink(lat, lng, address) {
        if (lat != null && lng != null) {
            return `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}&travelmode=transit`;
        } else if (address != null && address !== '') {
            return `https://www.google.com/maps/dir/?api=1&destination=${encodeURIComponent(address)}&travelmode=transit`;
        }
        return "";
    }
    
    // Function to send booking emails
    async function sendBookingEmails(payload) {
        try {
            const userInfo = payload.userInfo || {};
            const serviceInfo = payload.services?.[0] || {};
            const serviceProviderInfo = payload.serviceProviderInfo || {};
            const serviceData = payload.serviceData || {};
            
            const clientName = userInfo.name || 'Customer';
            const clientEmail = userInfo.email;
            const serviceName = serviceInfo.serviceName || '';
            const salonName = serviceData.companyName || '';
            const ownerName = serviceProviderInfo.name || serviceData.ownerName || '';
            const ownerEmail = serviceProviderInfo.email || serviceData.ownerMail || null;
            const address = payload.address || serviceData.companyAddress || '';
            const bookingAmount = serviceInfo.servicePrice || payload.amount || 0;
            
            const spLocation = serviceData.spLocation || {};
            const geometry = spLocation.geometry || {};
            const location = geometry.location || {};
            const lat = location.lat;
            const lng = location.lng;
            const mapLink = getMapLink(lat, lng, address);
            
            const bookingDate = parseBookingDate(payload.booking_time);
            const bookingTime = parseBookingTime(payload.booking_time, payload.bookTime);
            
            // Send customer email
            if (clientEmail && bookingDate && bookingTime) {
                try {
                    await fetch('https://backend.glaura.ai/api/send-email', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            to: clientEmail,
                            type: 'bookingCreated',
                            lang: currentLocale,
                            data: {
                                clientName: clientName,
                                serviceName: serviceName,
                                salonName: salonName,
                                date: bookingDate,
                                time: bookingTime,
                                address: address,
                                mapLink: mapLink
                            }
                        })
                    });
                } catch (e) { console.error('Error sending customer email:', e); }
            }
            
            // Send provider email
            if (ownerEmail && bookingDate && bookingTime) {
                try {
                    const formattedAmount = `€${parseFloat(bookingAmount).toFixed(2)}`;
                    await fetch('https://backend.glaura.ai/api/send-email', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            to: ownerEmail,
                            type: 'providerNewBookingReceived',
                            lang: currentLocale,
                            data: {
                                proName: ownerName,
                                clientName: clientName,
                                serviceName: serviceName,
                                date: bookingDate,
                                time: bookingTime,
                                bookingAmount: formattedAmount
                            }
                        })
                    });
                } catch (e) { console.error('Error sending provider email:', e); }
            }
        } catch (error) {
            console.error('Error in sendBookingEmails:', error);
        }
    }

    // Function to fetch user data from API (phone and countryCode)
    async function fetchUserDataFromAPI(userId) {
        try {
            const response = await fetch(`https://us-central1-beauty-984c8.cloudfunctions.net/getCurrentUserData?UserId=${encodeURIComponent(userId)}`);
            if (response.ok) {
                const data = await response.json();
                return {
                    phone: data.phone || null,
                    countryCode: data.countryCode || null
                };
            }
        } catch (error) {
            console.error('Error fetching user data from API:', error);
        }
        return { phone: null, countryCode: null };
    }

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        if (!chosenAgent) {
            alert('Please select an agent');
            return;
        }
        if (!selectedDateInput?.value || !selectedTimeInput?.value) {
            alert('Please select a time slot');
            return;
        }

        // Check terms and conditions
        const termsCheckbox = document.getElementById('termsConditions');
        const termsError = document.getElementById('termsError');
        if (!termsCheckbox || !termsCheckbox.checked) {
            if (termsError) {
                termsError.style.display = 'block';
            }
            if (termsCheckbox) {
                termsCheckbox.focus();
                termsCheckbox.classList.add('is-invalid');
            }
            // Scroll to terms checkbox
            if (termsCheckbox) {
                termsCheckbox.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            return;
        } else {
            if (termsError) {
                termsError.style.display = 'none';
            }
            if (termsCheckbox) {
                termsCheckbox.classList.remove('is-invalid');
            }
        }

        // Show loading state after validation passes
        setButtonLoading(true);

        // Get user data from bookingBootstrap
        const userData = bookingBootstrap.userData || {};
        
        // Get userId from bookingBootstrap or userData as fallback
        const userId = bookingBootstrap.userId || userData.id || null;
        
        // Fetch user data from API if user is logged in (to get phone and countryCode)
        let apiUserData = { phone: null, countryCode: null };
        if (userId) {
            apiUserData = await fetchUserDataFromAPI(userId);
            console.log('API user data fetched:', apiUserData);
        }
        
        // Ensure we have valid values, not empty strings
        // Use API phone if available, otherwise fall back to userData.phone
        const name = (userData.name && userData.name.trim()) ? userData.name.trim() : null;
        const email = (userData.email && userData.email.trim()) ? userData.email.trim() : null;
        const phone = apiUserData.phone || ((userData.phone && userData.phone.trim()) ? userData.phone.trim() : null);
        
        // Log user data being used for the booking
        console.log('User data for booking:', {
            id: userId,
            name: name,
            email: email,
            phone: phone,
            apiUserData: apiUserData,
            userData: userData,
            bookingBootstrap: bookingBootstrap
        });

         // Get payment option
         const paymentType = document.querySelector('input[name="paymentType"]:checked').value;

        // Get params from URL (fallback) and from server (preferred)
        const urlParams = new URLSearchParams(window.location.search);
        // Get serviceId from service data if available, otherwise from query params (for backward compatibility)
        const serviceId = bookingBootstrap.service?.id || bookingBootstrap.serviceId || urlParams.get('serviceId');
        // Get serviceProviderId from service.ownerId (primary), then fallback to controller-passed value, then URL params
        const serviceProviderId = bookingBootstrap.service?.ownerId || bookingBootstrap.serviceProviderId || urlParams.get('service_provider_id');

        // Build booking date object from selected date and time
        const [year, month, day] = selectedDateInput.value.split('-').map(Number);
        const [hour, minute] = selectedTimeInput.value.split(':').map(Number);
        const localDate = new Date(year, (month - 1), day, hour, minute, 0, 0);

        // Format as: July 17, 2025 at 18:24:00 UTC+5
        function formatForApi(d) {
            const monthNames = [
                'January','February','March','April','May','June','July','August','September','October','November','December'
            ];
            const months = monthNames[d.getMonth()];
            const dayNum = d.getDate();
            const yearNum = d.getFullYear();
            const hours = String(d.getHours()).padStart(2, '0');
            const minutes = String(d.getMinutes()).padStart(2, '0');
            const seconds = '00';
            // No AM/PM needed for 24-hour format
            
            const tzOffsetMin = -d.getTimezoneOffset(); // e.g., +300 for UTC+5
            const sign = tzOffsetMin >= 0 ? '+' : '-';
            const absMin = Math.abs(tzOffsetMin);
            const tzHours = Math.floor(absMin / 60);
            const tzStr = `UTC${sign}${tzHours}`;

            return `${months} ${dayNum}, ${yearNum} at ${hours}:${minutes}:${seconds} ${tzStr}`;
        }

        const bookingTime = formatForApi(localDate);
        
        // Extract bookTime (e.g., "18:24" from "July 17, 2025 at 18:24:00 UTC+5")
        // Updated regex to handle 24-hour format (no AM/PM)
        const bookTimeMatch = bookingTime.match(/at (\d+):(\d+):/);
        const bookTime = bookTimeMatch ? `${bookTimeMatch[1]}:${bookTimeMatch[2]}` : null;
        
        const serviceName = bookingBootstrap.service?.service_name || 'Selected Service';
        const servicePrice = parseFloat(bookingBootstrap.service?.discounted_price ?? bookingBootstrap.service?.service_price ?? 0) || 0;
        const durationMinutes = (bookingBootstrap.service?.duration_minutes ?? 0);
        // userId is already declared above, check if it exists for booking
        if (!userId) {
            setButtonLoading(false);
            // Store the current URL for redirection after login
            localStorage.setItem('book_appointment_url', window.location.href);
            
            // Save booking form state before showing login modal
            const pendingBookingState = {
                agentId: chosenAgent?.id || null,
                agent: chosenAgent || null,
                selectedDate: selectedDateInput?.value || '',
                selectedTime: selectedTimeInput?.value || '',
                selectedDay: selectedDayInput?.value || '',
                selectedPeriod: selectedPeriod || null,
                paymentType: document.querySelector('input[name="paymentType"]:checked')?.value || null,
                termsChecked: termsCheckbox?.checked || false,
                // Save the current week start so we can navigate to the correct week after login
                currentWeekStartDate: formatDateValue(currentWeekStart)
            };
            localStorage.setItem('pendingBookingState', JSON.stringify(pendingBookingState));
            console.log('Saved pending booking state:', pendingBookingState);
            
            // Show the login modal (vanilla JS)
            const loginModalElement = document.getElementById('loginModal');
            if (loginModalElement) {
                loginModalElement.classList.add('show');
                document.body.classList.add('modal-open');
            }
            return;
        }

        // RESCHEDULE MODE: Call reschedule API instead of creating a new booking
        if (isRescheduleMode) {
            try {
                console.log('Reschedule mode - calling reschedule API');

                // Try to get Firebase ID token (optional - falls back to session auth)
                let idToken = null;
                try {
                    const auth = window.firebaseAuth || (window.firebase && firebase.auth());
                    if (auth && auth.currentUser) {
                        idToken = await auth.currentUser.getIdToken(true);
                        console.log('Got Firebase ID token for reschedule');
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

                // Call the reschedule API (includes credentials for session-based auth)
                const rescheduleResponse = await fetch(`/api/bookings/${bookingBootstrap.rescheduleBookingId}/reschedule`, {
                    method: 'PUT',
                    headers: headers,
                    credentials: 'same-origin', // Send session cookies
                    body: JSON.stringify({
                        booking_time: localDate.toISOString(),
                        bookTime: bookTime,
                        agentId: chosenAgent?.id || null,
                        agentName: chosenAgent?.name || null,
                    })
                });

                const rescheduleData = await rescheduleResponse.json();
                console.log('Reschedule API response:', rescheduleData);

                if (!rescheduleResponse.ok || !rescheduleData.success) {
                    throw new Error(rescheduleData.message || '{{ __("app.bookings.reschedule_error") ?? "Failed to reschedule booking" }}');
                }

                // Success - redirect to bookings page
                setButtonLoading(false);
                alert('{{ __("app.bookings.reschedule_success") ?? "Booking rescheduled successfully" }}');
                window.location.href = '{{ route("my-bookings") }}';
                return;
            } catch (rescheduleError) {
                console.error('Error rescheduling booking:', rescheduleError);
                setButtonLoading(false);
                alert(rescheduleError.message || '{{ __("app.bookings.reschedule_error") ?? "An error occurred while rescheduling" }}');
                return;
            }
        }

        if (!serviceId || !serviceProviderId) {
            setButtonLoading(false);
            alert("Missing 'serviceId' or 'service_provider_id' in URL.");
            return;
        }

        // Extract deposit percentage from label if available
        const depositLabelElement = document.getElementById('payDepositLabel');
        let depositPercentage = null;
        if (depositLabelElement) {
            const labelText = depositLabelElement.textContent || depositLabelElement.innerText;
            const percentageMatch = labelText.match(/(\d+)%/);
            if (percentageMatch) {
                depositPercentage = parseFloat(percentageMatch[1]);
            }
        }
        
        // Get deposit percentage from hidden input or calculate from service data
        if (depositPercentage === null) {
            const depositPercentageInput = document.getElementById('depositPercentage');
            depositPercentage = depositPercentageInput ? parseFloat(depositPercentageInput.value) : null;
            
            // If not found in input, calculate from service data
            if (depositPercentage === null || isNaN(depositPercentage)) {
                const service = bookingBootstrap.service || {};
                const spDeposit = service.spDeposit || 0;
                const commission = service.commission || {};
                const minimumBookingPercentage = commission.minimum_booking_percentage || 0;
                const commissionValue = commission.commission || 0;
                
                if (spDeposit > 0) {
                    depositPercentage = spDeposit;
                } else if (minimumBookingPercentage > 0) {
                    depositPercentage = minimumBookingPercentage;
                } else if (commissionValue > 0) {
                    depositPercentage = commissionValue;
                } else {
                    depositPercentage = 0;
                }
            }
        }
        
        // Get service provider info (try to get from service data, otherwise set to null)
        // Debug: Log service data to see what fields are available
        console.log('=== SERVICE PROVIDER INFO DEBUG ===');
        console.log('Full service object:', bookingBootstrap.service);
        console.log('ownerMail:', bookingBootstrap.service?.ownerMail);
        console.log('ownerProfile:', bookingBootstrap.service?.ownerProfile);
        console.log('ownerName:', bookingBootstrap.service?.ownerName);
        console.log('ownerId:', bookingBootstrap.service?.ownerId);
        console.log('All service keys:', bookingBootstrap.service ? Object.keys(bookingBootstrap.service) : 'No service data');
        
        // Try multiple ways to access the data (in case of case sensitivity or different structure)
        let ownerMail = bookingBootstrap.service?.ownerMail || 
                       bookingBootstrap.service?.owner_mail || 
                       bookingBootstrap.service?.ownerEmail ||
                       null;
        let ownerProfile = bookingBootstrap.service?.ownerProfile || 
                          bookingBootstrap.service?.owner_profile || 
                          bookingBootstrap.service?.ownerPhoto ||
                          null;
        
        // If data is missing, try to fetch from API as fallback
        if ((!ownerMail || !ownerProfile) && (bookingBootstrap.servicesSlug || bookingBootstrap.serviceId)) {
            console.warn('ownerMail or ownerProfile missing, attempting API fallback...');
            try {
                // Fetch service data directly from API
                const apiUrl = bookingBootstrap.servicesSlug 
                    ? `https://us-central1-beauty-984c8.cloudfunctions.net/getServiceById?services_slug=${encodeURIComponent(bookingBootstrap.servicesSlug)}`
                    : `https://us-central1-beauty-984c8.cloudfunctions.net/getServiceById?service_id=${encodeURIComponent(bookingBootstrap.serviceId)}`;
                
                const apiResponse = await fetch(apiUrl);
                if (apiResponse.ok) {
                    const apiData = await apiResponse.json();
                    const apiService = apiData?.service || {};
                    
                    console.log('API fallback response:', apiService);
                    
                    // Update ownerMail and ownerProfile from API response
                    if (!ownerMail && apiService.ownerMail) {
                        ownerMail = apiService.ownerMail;
                        console.log('Retrieved ownerMail from API:', ownerMail);
                    }
                    if (!ownerProfile && apiService.ownerProfile) {
                        ownerProfile = apiService.ownerProfile;
                        console.log('Retrieved ownerProfile from API:', ownerProfile);
                    }
                    
                    // Update bookingBootstrap.service with fresh data
                    if (bookingBootstrap.service) {
                        bookingBootstrap.service.ownerMail = ownerMail || bookingBootstrap.service.ownerMail;
                        bookingBootstrap.service.ownerProfile = ownerProfile || bookingBootstrap.service.ownerProfile;
                        // Also update address-related fields if missing
                        if (!bookingBootstrap.service.companyAddress && apiService.companyAddress) {
                            bookingBootstrap.service.companyAddress = apiService.companyAddress;
                        }
                        if (!bookingBootstrap.service.address && apiService.address) {
                            bookingBootstrap.service.address = apiService.address;
                        }
                    }
                }
            } catch (apiError) {
                console.error('Error fetching service data from API fallback:', apiError);
            }
        }
        
        console.log('Resolved ownerMail:', ownerMail);
        console.log('Resolved ownerProfile:', ownerProfile);
        console.log('===================================');
        
        const serviceProviderInfo = {
            email: ownerMail,
            id: serviceProviderId || null,
            // Prefer companyName; fallback to ownerName for backward compatibility
            name: bookingBootstrap.service?.companyName || bookingBootstrap.service?.ownerName || null,
            photo: ownerProfile
        };
        
        console.log('Constructed serviceProviderInfo:', serviceProviderInfo);
        
        // Get address from service provider data (try multiple possible fields)
        // Debug: Log address fields to see what's available
        console.log('=== ADDRESS DEBUG ===');
        console.log('address:', bookingBootstrap.service?.address);
        console.log('companyAddress:', bookingBootstrap.service?.companyAddress);
        console.log('serviceProviderAddress:', bookingBootstrap.service?.serviceProviderAddress);
        console.log('location:', bookingBootstrap.service?.location);
        console.log('serviceLocation:', bookingBootstrap.service?.serviceLocation);
        console.log('========================');
        
        const address = bookingBootstrap.service?.address || 
                       bookingBootstrap.service?.companyAddress ||
                       bookingBootstrap.service?.serviceProviderAddress || 
                       bookingBootstrap.service?.location || 
                       bookingBootstrap.service?.serviceLocation || 
                       null;
        
        console.log('Resolved address:', address);
        
        // Always save the full service amount regardless of payment type
        const amount = Math.round(servicePrice * 100) / 100;
        
        // Use countryCode from API if available, otherwise extract from phone number
        let countryCode = apiUserData.countryCode || null;
        if (!countryCode && phone) {
            const phoneMatch = phone.match(/^\+(\d{1,3})/);
            if (phoneMatch) {
                countryCode = '+' + phoneMatch[1];
            }
        }
        
        // Get user photo from Firebase user data if available
        const userPhoto = bookingBootstrap.userData?.photoURL || bookingBootstrap.userData?.photo || null;
        
        // Construct booking payload
        const bookingPayload = {
            booking_time: bookingTime,
            bookTime: bookTime,
            service_provider_id: serviceProviderId,
            serviceProviderInfo: serviceProviderInfo,
            userId: userId,
            depositPercentage: depositPercentage,
            address: address,
            amount: amount,
            services: [
                {
                    serviceId: serviceId,
                    serviceName: serviceName,
                    durationMinutes: durationMinutes,
                    discountedPrice: servicePrice,
                    servicePrice: servicePrice,
                    isCompleted: false,
                    startTime: bookingTime,
                    agentId: chosenAgent?.id || null,
                    agentName: chosenAgent?.name || 'Selected Agent'
                }
            ],
            userInfo: {
                id: userId,
                name: name,
                email: email || null,
                phone: phone,
                countryCode: countryCode,
                photo: userPhoto
            },
            // Include service data for deposit calculation on success page
            serviceData: bookingBootstrap.service || null
        };
        
        // Collect form data to pass through the payment process
        const formData = {
            name,
            email,
            phone
        };

        try {
            // Store form data in localStorage before going to Stripe
            const formDataToStore = {
                name,
                email,
                phone,
                selectedDate: selectedDateInput.value,
                selectedTime: selectedTimeInput.value,
                agentId: chosenAgent?.id || null,
                agentName: chosenAgent?.name || 'Selected Agent'
            };
            
            // Store full booking data in localStorage so we can retrieve it after payment
            localStorage.setItem('bookingFormData', JSON.stringify(formDataToStore));
            localStorage.setItem('bookingPayload', JSON.stringify(bookingPayload));
            
            console.log('Preparing to send checkout request with data:', {
                serviceId,
                serviceProviderId,
                serviceName,
                servicePrice,
                paymentType,
                depositPercentage,
                formData: formDataToStore
            });
            
            // Check if this is a free booking (deposit is 0 and payment type is deposit)
            const isFreeBooking = (depositPercentage === 0 && paymentType === 'deposit');
            
            if (isFreeBooking) {
                // For free bookings, skip Stripe and directly submit the booking
                console.log('Free booking detected, skipping Stripe payment');

                // Add payment information to booking payload (matching mobile app format)
                const freeBookingTransactionId = 'FREE_' + Date.now();
                bookingPayload.payment_id = freeBookingTransactionId;
                bookingPayload.payment_type = 'deposit';
                bookingPayload.payed = false; // Free booking, no payment made
                bookingPayload.depositPercentage = 0; // No deposit percentage
                bookingPayload.depositAmount = 0; // No deposit amount was paid
                bookingPayload.alreadySubmitted = true; // Flag to prevent double submission
                
                // Store booking data in localStorage for success page (same as paid bookings)
                localStorage.setItem('bookingFormData', JSON.stringify(formDataToStore));
                localStorage.setItem('bookingPayload', JSON.stringify(bookingPayload));
                
                try {
                    // Submit booking directly to API
                    const bookingResponse = await fetch('https://us-central1-beauty-984c8.cloudfunctions.net/bookService', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(bookingPayload)
                    });
                    
                    const bookingResponseData = await bookingResponse.json();
                    console.log('Booking API response:', bookingResponseData);
                    
                    if (bookingResponse.ok) {
                        // Send booking confirmation emails
                        console.log('Booking successful, sending confirmation emails...');
                        await sendBookingEmails(bookingPayload);
                        
                        // Clear all booking data from localStorage
                        localStorage.removeItem('pendingBookingState');
                        localStorage.removeItem('bookingFormData');
                        localStorage.removeItem('bookingPayload');
                        
                        // Redirect directly to My Bookings page
                        window.location.href = '{{ route("my-bookings") }}';
                    } else {
                        setButtonLoading(false);
                        alert('Error submitting booking: ' + (bookingResponseData.message || 'Unknown error'));
                        console.error('Error submitting booking:', bookingResponseData);
                    }
                } catch (bookingError) {
                    setButtonLoading(false);
                    console.error('Error submitting free booking:', bookingError);
                    alert('An error occurred while submitting your booking: ' + bookingError.message);
                }
                return; // Exit early for free bookings
            }
            
            // For paid bookings, proceed with Stripe checkout
            const checkoutUrl = '{{ route("checkout.session") }}';

            // authFetch handles 401 errors with automatic token refresh
            const response = await (window.authFetch || fetch)(checkoutUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    serviceId,
                    serviceProviderId,
                    serviceName,
                    servicePrice,
                    paymentType,
                    depositPercentage,
                    serviceData: bookingBootstrap.service || null,
                    formData: formDataToStore,
                    bookingData: bookingPayload
                })
            });

            if (!response.ok) {
                setButtonLoading(false);
                const errorText = await response.text();
                console.error('Error response:', response.status, errorText);

                // If 401, show login modal instead of error
                if (response.status === 401) {
                    const loginModalEl = document.getElementById('loginModal');
                    if (loginModalEl) {
                        loginModalEl.classList.add('show');
                        document.body.classList.add('modal-open');
                        return;
                    }
                }
                throw new Error(`Server responded with ${response.status}: ${errorText}`);
            }

            const session = await response.json();
            console.log('Received session:', session);
            
            if (session.error) {
                setButtonLoading(false);
                alert('Error: ' + session.error);
                return;
            }

            // Clear pending booking state before redirecting to Stripe
            localStorage.removeItem('pendingBookingState');

            // Initialize Stripe object with dynamically fetched publishable key
            const stripePublishableKey = bookingBootstrap.stripeConfig?.publishableKey;
            if (!stripePublishableKey) {
                setButtonLoading(false);
                alert('Stripe configuration not loaded. Please refresh the page and try again.');
                console.error('Stripe publishable key not available');
                return;
            }
            const stripe = Stripe(stripePublishableKey);

            // Both Stripe Connect and regular Stripe now use Checkout Sessions
            // Always redirect to Stripe's hosted checkout page
            const isStripeConnect = session.useStripeConnect || false;
            console.log('Redirecting to Stripe checkout with session ID:', session.id, '| Mode:', bookingBootstrap.stripeConfig?.isLive ? 'LIVE' : 'TEST', '| Connect:', isStripeConnect);

            const result = await stripe.redirectToCheckout({
                sessionId: session.id
            });

            if (result.error) {
                setButtonLoading(false);
                alert('Error: ' + result.error.message);
            }
            // Note: If redirect is successful, the page will navigate away, so we don't need to reset loading state
        } catch (err) {
            console.error('Error in form submission:', err);
            setButtonLoading(false);
            alert('An error occurred: ' + err.message);
        }
    });
    
    // Add test button functionality (if button exists)
    const testStripeBtn = document.getElementById('testStripeBtn');
    if (testStripeBtn) {
        testStripeBtn.addEventListener('click', async function() {
        try {
            // Initialize Stripe with dynamically fetched publishable key
            const stripePublishableKey = bookingBootstrap.stripeConfig?.publishableKey;
            if (!stripePublishableKey) {
                alert('Stripe configuration not loaded. Please refresh the page and try again.');
                console.error('Stripe publishable key not available');
                return;
            }
            const stripe = Stripe(stripePublishableKey);
            console.log('Test button clicked, Stripe initialized | Mode:', bookingBootstrap.stripeConfig?.isLive ? 'LIVE' : 'TEST');
            
            // Create a minimal test session directly (use authFetch for token refresh)
            const response = await (window.authFetch || fetch)('{{ route("checkout.session") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    serviceId: '1',
                    serviceProviderId: '1',
                    serviceName: 'Test Service',
                    servicePrice: 1.00,
                    paymentType: 'full',
                                         formData: {
                        name: 'Test User',
                        email: 'test@example.com',
                        phone: '1234567890'
                    },
                    bookingData: {
                        booking_time: 'Test Time',
                        service_provider_id: '1',
                        user_id: '1',
                        services: [
                            {
                                serviceId: '1',
                                serviceName: 'Test Service',
                                durationMinutes: 30,
                                discountedPrice: 1.00,
                                servicePrice: 1.00,
                                isCompleted: false,
                                startTime: 'Test Time',
                                agentId: '1',
                            }
                        ]
                    }
                })
            });
            
            if (!response.ok) {
                const errorText = await response.text();
                console.error('Error response:', response.status, errorText);
                throw new Error(`Server responded with ${response.status}: ${errorText}`);
            }
            
            const session = await response.json();
            console.log('Test session created:', session);
            
            if (session.error) {
                alert('Error creating test session: ' + session.error);
                return;
            }
            
            // Redirect to Stripe checkout with the test session
            console.log('Redirecting to Stripe checkout with test session ID:', session.id);
            // For Stripe v7.0 compatibility
            const result = await stripe.redirectToCheckout({
                sessionId: session.id
            });
            
            if (result.error) {
                alert('Error in test redirect: ' + result.error.message);
            }
        } catch (err) {
            console.error('Test button error:', err);
            alert('Test failed: ' + err.message);
        }
        });
    }
    
    // Handle window resize to update calendar when switching between mobile/desktop views
    let resizeTimeout;
    let lastMobileState = isMobileView();
    window.addEventListener('resize', function() {
        // Debounce resize events to avoid excessive updates
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            // Only update if calendar is already initialized (agent selected)
            if (chosenAgent && agentSchedule && agentSchedule.style.display !== 'none') {
                const currentMobileState = isMobileView();
                
                // If viewport type changed (mobile <-> desktop), re-render time slots
                if (currentMobileState !== lastMobileState) {
                    const activeDay = document.querySelector('.day-column.active');
                    if (activeDay && chosenAgentSlots) {
                        const dayKey = selectedDayInput.value;
                        const selectedDate = selectedDateInput.value;
                        
                        if (currentMobileState) {
                            // Switched to mobile: render mobile vertical layout
                            if (dayKey && selectedDate) {
                                renderTimeSlotsMobile(chosenAgentSlots, dayKey, selectedDate);
                                if (mobileTimeSlotsContainer) {
                                    mobileTimeSlotsContainer.style.display = '';
                                }
                                if (timeSlotsStrip) {
                                    timeSlotsStrip.style.display = 'none';
                                }
                            }
                        } else {
                            // Switched to desktop: render desktop horizontal layout if period selected
                            if (selectedPeriod && dayKey && selectedDate) {
                                renderTimeSlots(chosenAgentSlots, dayKey, selectedPeriod, selectedDate);
                            } else {
                                // No period selected, just hide mobile container
                                if (mobileTimeSlotsContainer) {
                                    mobileTimeSlotsContainer.style.display = 'none';
                                }
                            }
                        }
                    }
                    lastMobileState = currentMobileState;
                }
                
                updateWeekDisplay();
                renderDaysHeader();
                updatePrevWeekButtonState();
            }
        }, 250);
    });
});
</script>

@endsection

