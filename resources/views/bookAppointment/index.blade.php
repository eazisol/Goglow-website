@extends('layouts.mainInnerPages')
{{-- Title --}}
@section('title', 'home')

{{-- Style Files --}}
@section('styles')
@once
    <!-- Bootstrap CSS for modals -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endonce
<link rel="stylesheet" href="{{ asset('css/bookAppointment-index.css') }}">
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
                            <img src="{{ (isset($selectedService['images']) && count($selectedService['images']) > 0) ? $selectedService['images'][0] : asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}"
                                 alt="{{ $selectedService['service_name'] ?? 'Service' }}"
                                 onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                        </div> --}}
                        <div class="card-body">
                            <h4 class="service-summary-title">{{ $selectedService['service_name'] ?? 'Selected Service' }}</h4>
                            <p class="service-summary-price">
                                €{{ $selectedService['discounted_price'] ?? ($selectedService['service_price'] ?? 0) }}
                                @if(isset($selectedService['discounted_price']) && isset($selectedService['service_price']) && $selectedService['discounted_price'] < $selectedService['service_price'])
                                    <span class="old-price">€{{ $selectedService['service_price'] }}</span>
                                @endif
                            </p>
                            @if(!empty($selectedService['service_details']))
                                <p class="service-summary-desc">{{ \Illuminate\Support\Str::limit($selectedService['service_details'], 150, '.....') }}</p>
                                
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
                                    <div class="form-group col-md-12 mb-4">
                                        <label class="form-label">{{ __('app.agent_page.payment_options') }}</label>
                                        <div class="payment-options">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="paymentType" id="payDeposit" value="deposit" checked>
                                                <label class="form-check-label" for="payDeposit">
                                                    {{ __('app.agent_page.pay_15%_deposit_now') }} (€{{ number_format(($selectedService['discounted_price'] ?? ($selectedService['service_price'] ?? 0)) * 0.15, 2) }})
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="paymentType" id="payFull" value="full">
                                                <label class="form-check-label" for="payFull">
                                                    {{ __('app.agent_page.pay_full_amount_now') }} (€{{ $selectedService['discounted_price'] ?? ($selectedService['service_price'] ?? 0) }})
                                                </label>
                                            </div>
                                        </div>
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
                                                <input type="checkbox" name="terms_conditions" id="termsConditions" class="terms-checkbox-input" required style="width: 20px; height: 20px; margin: 0; cursor: pointer; flex-shrink: 0; margin-top: 2px;">
                                                <label class="terms-checkbox-label" for="termsConditions" style="font-size: 14px; line-height: 1.5; color: #2c0d18; cursor: pointer; margin: 0; flex: 1;">
                                                    {{ __('app.auth.i_agree_to') }} <a href="#" target="_blank" style="color: rgba(229, 0, 80, 1); text-decoration: underline; font-weight: 500;">{{ __('app.auth.terms') }}</a> {{ __('app.auth.and') }} <a href="#" target="_blank" style="color: rgba(229, 0, 80, 1); text-decoration: underline; font-weight: 500;">{{ __('app.auth.privacy_policy') }}</a>
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
@once
    <!-- Bootstrap JS for modals -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endonce
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
    };
    
    // Log logged-in user data at page load
    console.log('Logged-in user ID:', bookingBootstrap.userId);
    console.log('Logged-in user data:', bookingBootstrap.userData);
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
    
    let chosenAgent = null;
    let chosenAgentSlots = null;
    let selectedPeriod = null;
    
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
    
    // Convert timing data to slots format
    function convertTimingToSlots(timing) {
        const slots = {};
        
        Object.keys(timing).forEach(day => {
            const range = timing[day];
            if (Array.isArray(range) && range.length === 2) {
                const [start, end] = range;
                
                // Skip if closed or invalid range
                if (typeof start !== 'number' || typeof end !== 'number' || start === end) {
                    return;
                }
                
                // Convert seconds to hours and generate hourly slots
                const startHour = Math.floor(start / 3600);
                const endHour = Math.floor(end / 3600);
                
                slots[day] = [];
                
                // Generate hourly slots from start to end
                for (let hour = startHour; hour < endHour; hour++) {
                    const timeStr = `${hour.toString().padStart(2, '0')}:00`;
                    slots[day].push({
                        time: timeStr,
                        available: true
                    });
                }
            }
        });
        
        return slots;
    }
    
    // Create sample slots for testing
    function createSampleSlots() {
        const slots = {};
        const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
        
        // Create sample slots for each day
        days.forEach(day => {
            slots[day] = [];
            
            // Morning slots
            for (let hour = 9; hour <= 12; hour++) {
                slots[day].push({
                    time: `${hour.toString().padStart(2, '0')}:00`,
                    available: Math.random() > 0.3 // 70% chance of being available
                });
            }
            
            // Afternoon slots
            for (let hour = 14; hour <= 17; hour++) {
                slots[day].push({
                    time: `${hour.toString().padStart(2, '0')}:00`,
                    available: Math.random() > 0.3 // 70% chance of being available
                });
            }
        });
        
        return slots;
    }
    
    // Format time from "HH:MM" to 24-hour format (for timeSlotsStrip)
    function formatTimeDisplay24(timeStr) {
        const [hours, minutes] = timeStr.split(':').map(Number);
        return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
    }
    
    // Format time from "HH:MM" to 12-hour display format (for selectedDateTimeDisplay)
    function formatTimeDisplay(timeStr) {
        const [hours, minutes] = timeStr.split(':').map(Number);
        const ampm = hours >= 12 ? 'p.m.' : 'a.m.';
        const displayHours = hours % 12 || 12;
        return `${displayHours}:${minutes.toString().padStart(2, '0')} ${ampm}`;
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
        const endDate = new Date(currentWeekStart);
        endDate.setDate(endDate.getDate() + 6);
        
        // Use translated month names
        const startMonth = monthNames[currentWeekStart.getMonth()];
        const endMonth = monthNames[endDate.getMonth()];
        
        if (startMonth === endMonth) {
            weekDisplay.textContent = `${startMonth} ${currentWeekStart.getDate()} - ${endDate.getDate()}`;
        } else {
            weekDisplay.textContent = `${startMonth} ${currentWeekStart.getDate()} - ${endMonth} ${endDate.getDate()}`;
        }
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
                
                // Show period selector and hide time slots
                periodSelector.style.display = '';
                timeSlotGrid.innerHTML = '';
                if (timeSlotsStrip) {
                    timeSlotsStrip.style.display = 'none';
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
    
    // Keep function unused (no filtering). Left in place for future use if needed.
    function filterTimeSlotsByDay(dayKey) {}
    
    // Render time slots for selected day and period (horizontal layout)
    function renderTimeSlots(slots, selectedDay, selectedPeriod, selectedDate) {
        console.log('Rendering time slots:', { slots, selectedDay, selectedPeriod, selectedDate });
        timeSlotGrid.innerHTML = '';
        
        // Hide time slots strip initially
        if (timeSlotsStrip) {
            timeSlotsStrip.style.display = 'none';
        }
        
        if (!slots || !selectedDay || !selectedPeriod || !selectedDate) {
            timeSlotGrid.innerHTML = '<div class="col-12 text-center py-3" style="padding: 20px; color: #666;">There is no slot available</div>';
            // Show strip to display message, but hide arrows
            if (timeSlotsStrip) {
                timeSlotsStrip.style.display = '';
                if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = 'none';
                if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = 'none';
            }
            return;
        }
        
        // Get slots for the selected day
        const daySlots = slots[selectedDay] || [];
        
        if (!Array.isArray(daySlots) || daySlots.length === 0) {
            timeSlotGrid.innerHTML = '<div class="col-12 text-center py-3" style="padding: 20px; color: #666;">There is no slot available</div>';
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
            timeSlotGrid.innerHTML = '<div class="col-12 text-center py-3" style="padding: 20px; color: #666;">There is no slot available</div>';
            // Show strip to display message, but hide arrows
            if (timeSlotsStrip) {
                timeSlotsStrip.style.display = '';
                if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = 'none';
                if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = 'none';
            }
            return;
        }
        
        // Filter slots by period and availability
        const filteredSlots = daySlots.filter(slot => {
            if (!slot.available) return false;
            
            // Extract hour from time string (format: "HH:MM")
            const [hours] = slot.time.split(':').map(Number);
            
            // Check if hour falls within the selected period range
            return hours >= period.start && hours < period.end;
        });
        
        if (filteredSlots.length === 0) {
            timeSlotGrid.innerHTML = '<div class="col-12 text-center py-3" style="padding: 20px; color: #666;">There is no slot available</div>';
            // Show strip to display message, but hide arrows
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
        setTimeout(() => {
            updateTimeSlotArrows();
            // Center scroll position to show middle slots (like days header)
            if (timeSlotGrid && filteredSlots.length > 6) {
                const scrollWidth = timeSlotGrid.scrollWidth;
                const clientWidth = timeSlotGrid.clientWidth;
                timeSlotGrid.scrollLeft = (scrollWidth - clientWidth) / 2;
                updateTimeSlotArrows();
            }
        }, 100);
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
    
    // Function to update the prev week button state
    function updatePrevWeekButtonState() {
        // Calculate the date that would be the start of the previous week
        const prevWeekDate = new Date(currentWeekStart);
        prevWeekDate.setDate(prevWeekDate.getDate() - 7);
        
        // Disable the button if the previous week would be in the past
        if (isDateInPast(prevWeekDate)) {
            prevWeekBtn.classList.add('disabled');
            prevWeekBtn.setAttribute('disabled', 'disabled');
        } else {
            prevWeekBtn.classList.remove('disabled');
            prevWeekBtn.removeAttribute('disabled');
        }
    }
    
    // Navigate to previous week
    prevWeekBtn.addEventListener('click', function() {
        // Calculate the new week start
        const newWeekStart = new Date(currentWeekStart);
        newWeekStart.setDate(newWeekStart.getDate() - 7);
        
        // Only navigate if the new week start is not in the past
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
            selectedSlotInfo.style.display = 'none';
            selectedTimeInput.value = '';
            
            // Hide payment options section when week navigation changes
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
    
    // Navigate to next week
    nextWeekBtn.addEventListener('click', function() {
        currentWeekStart.setDate(currentWeekStart.getDate() + 7);
        updateWeekDisplay();
        renderDaysHeader();
        
        // Reset period selection and hide time slots
        selectedPeriod = null;
        periodSelector.querySelectorAll('.period-btn').forEach(btn => btn.classList.remove('active'));
        periodSelector.style.display = 'none';
        timeSlotGrid.innerHTML = '';
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
            
            // Store agent slots data for later use (don't render immediately)
            if (!agent.slots && agent.timing) {
                console.log('Converting timing to slots format');
                chosenAgentSlots = convertTimingToSlots(agent.timing);
                console.log('Generated slots:', chosenAgentSlots);
            } else if (agent.slots) {
                // Store time slots from agent data
                chosenAgentSlots = agent.slots;
            } else {
                // No slots or timing data, create sample data for testing
                console.log('No slots or timing data found, creating sample data');
                chosenAgentSlots = createSampleSlots();
                console.log('Sample slots:', chosenAgentSlots);
            }
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
            
            // Render time slots for selected day and period
            if (chosenAgentSlots) {
                const selectedDate = selectedDateInput.value;
                renderTimeSlots(chosenAgentSlots, dayKey, period, selectedDate);
            } else {
                timeSlotGrid.innerHTML = '<div class="col-12 text-center py-3" style="padding: 20px; color: #666;">There is no slot available</div>';
                // Show strip to display message, but hide arrows
                if (timeSlotsStrip) {
                    timeSlotsStrip.style.display = '';
                    if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = 'none';
                    if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = 'none';
                }
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
         const name = userData.name || '';
         const email = userData.email || '';
         const phone = userData.phone || '';
         
         // Log user data being used for the booking
         console.log('User data for booking:', {
             id: bookingBootstrap.userId,
             name: name,
             email: email,
             phone: phone,
             userData: userData
         });

         // Get payment option
         const paymentType = document.querySelector('input[name="paymentType"]:checked').value;

        // Get params from URL (fallback) and from server (preferred)
        const urlParams = new URLSearchParams(window.location.search);
        // Get serviceId from service data if available, otherwise from query params (for backward compatibility)
        const serviceId = bookingBootstrap.service?.id || bookingBootstrap.serviceId || urlParams.get('serviceId');
        const serviceProviderId = bookingBootstrap.serviceProviderId || urlParams.get('service_provider_id');

        // Build booking date object from selected date and time
        const [year, month, day] = selectedDateInput.value.split('-').map(Number);
        const [hour, minute] = selectedTimeInput.value.split(':').map(Number);
        const localDate = new Date(year, (month - 1), day, hour, minute, 0, 0);

        // Format as: July 17, 2025 at 6:24:00 PM UTC+5
        function formatForApi(d) {
            const monthNames = [
                'January','February','March','April','May','June','July','August','September','October','November','December'
            ];
            const months = monthNames[d.getMonth()];
            const dayNum = d.getDate();
            const yearNum = d.getFullYear();
            let hours = d.getHours();
            const minutes = String(d.getMinutes()).padStart(2, '0');
            const seconds = '00';
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12; if (hours === 0) hours = 12;

            const tzOffsetMin = -d.getTimezoneOffset(); // e.g., +300 for UTC+5
            const sign = tzOffsetMin >= 0 ? '+' : '-';
            const absMin = Math.abs(tzOffsetMin);
            const tzHours = Math.floor(absMin / 60);
            const tzStr = `UTC${sign}${tzHours}`;

            return `${months} ${dayNum}, ${yearNum} at ${hours}:${minutes}:${seconds} ${ampm} ${tzStr}`;
        }

        const bookingTime = formatForApi(localDate);
        const serviceName = bookingBootstrap.service?.service_name || 'Selected Service';
        const servicePrice = (bookingBootstrap.service?.discounted_price ?? bookingBootstrap.service?.service_price ?? 0);
        const durationMinutes = (bookingBootstrap.service?.duration_minutes ?? 0);
        const userId = bookingBootstrap.userId;
        if (!userId) {
            setButtonLoading(false);
            // Store the current URL for redirection after login
            localStorage.setItem('book_appointment_url', window.location.href);
            
            // Show the login modal instead of alert
            const showLoginModal = () => {
                const loginModalElement = document.getElementById('loginModal');
                if (!loginModalElement) {
                    console.error('Login modal element not found');
                    return;
                }
                
                // Try Bootstrap 5 first
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    try {
                        const modal = new bootstrap.Modal(loginModalElement);
                        modal.show();
                        return;
                    } catch (e) {
                        console.error('Error creating Bootstrap modal:', e);
                    }
                }
                
                // Fallback to jQuery if available
                if (typeof $ !== 'undefined' && $.fn.modal) {
                    $('#loginModal').modal('show');
                    return;
                }
                
                // Fallback: try again after a short delay
                console.warn('Bootstrap not loaded yet, retrying...');
                setTimeout(showLoginModal, 100);
            };
            
            // Wait a bit for Bootstrap to be ready
            setTimeout(showLoginModal, 50);
            return;
        }

        if (!serviceId || !serviceProviderId) {
            setButtonLoading(false);
            alert("Missing 'serviceId' or 'service_provider_id' in URL.");
            return;
        }

        // Construct booking payload
        const bookingPayload = {
            booking_time: bookingTime,
            service_provider_id: serviceProviderId,
            user_id: userId,
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
            userInfo:[
                {
                    id: userId,
                    name: name,
                    email: email,
                    phone: phone,
                }
            ]
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
                formData: formDataToStore
            });
            
            const checkoutUrl = '{{ route("checkout.session") }}';
            console.log('Checkout URL:', checkoutUrl);
            
            const response = await fetch(checkoutUrl, {
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
                    formData: formDataToStore,
                    bookingData: bookingPayload
                })
            });
            
            if (!response.ok) {
                setButtonLoading(false);
                const errorText = await response.text();
                console.error('Error response:', response.status, errorText);
                throw new Error(`Server responded with ${response.status}: ${errorText}`);
            }

            const session = await response.json();
            console.log('Received session:', session);
            
            if (session.error) {
                setButtonLoading(false);
                alert('Error: ' + session.error);
                return;
            }

            // Initialize Stripe object with publishable key
            const stripe = Stripe('pk_test_YvIcG9lWoxs6ITHB264wNchO');
            console.log('Redirecting to Stripe checkout with session ID:', session.id);
            
            // For Stripe v7.0 compatibility
            // Redirect to Stripe Checkout
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
            // Initialize Stripe with the publishable key
            const stripe = Stripe('pk_test_YvIcG9lWoxs6ITHB264wNchO');
            console.log('Test button clicked, Stripe initialized');
            
            // Create a minimal test session directly
            const response = await fetch('{{ route("checkout.session") }}', {
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
});
</script>

@endsection

