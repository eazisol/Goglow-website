@extends('layouts.main')
{{-- Title --}}
@section('title', 'home')

{{-- Style Files --}}
@section('styles')
<style>
    .service-details-box {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
    }

    .service-details-box label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }

    .service-details-box input[readonly] {
        background-color: #fff;
        color: #333;
        font-weight: 500;
    }

    .booking-days-buttons {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 15px;
        margin-top: 15px;
        margin-bottom: 20px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #e9ecef;
    }

    .day-btn {
        position: relative;
        padding: 15px 10px;
        border: 2px solid #e9ecef;
        background: #fff;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .day-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--theme-color);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .day-btn span {
        display: block;
        font-weight: 600;
        font-size: 14px;
        color: #333;
        transition: all 0.3s ease;
    }

    .day-btn:hover {
        border-color: var(--theme-color);
        transform: translateY(-2px);
    }

    .day-btn:hover::before {
        transform: scaleX(1);
    }

    .day-btn:hover span {
        color: var(--theme-color);
    }

    .day-btn.active {
        background: var(--theme-color);
        border-color: var(--theme-color);
        transform: translateY(-2px);
    }

    .day-btn.active::before {
        transform: scaleX(1);
        background: #fff;
    }

    .day-btn.active span {
        color: #fff;
    }

    @media (max-width: 991px) {
        .booking-days-buttons {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 575px) {
        .booking-days-buttons {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .form-label {
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }

    @media (max-width: 768px) {
        .booking-days-buttons {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Service summary card (left side) */
    .service-summary-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        position: sticky;
        top: 20px;
    }
    .service-summary-card .card-cover img {
        display: block;
        width: 100%;
        height: 220px; /* fixed so it doesn't stretch with form */
        object-fit: cover;
    }
    .service-summary-card .card-body {
        padding: 16px;
    }
    .service-summary-title {
        margin: 0 0 6px 0;
        font-size: 20px;
        font-weight: 600;
        color: #1c1c1c;
    }
    .service-summary-price {
        margin: 0 0 10px 0;
        font-weight: 600;
        color: #1c1c1c;
    }
    .service-summary-price .old-price {
        color: #999;
        text-decoration: line-through;
        margin-left: 8px;
        font-weight: 400;
    }
    .service-summary-desc {
        margin: 0;
        color: #555;
        line-height: 1.5;
    }

    /* Agents horizontal avatars */
    .agent-avatars {
        display: flex;
        gap: 16px;
        align-items: center;
        flex-wrap: nowrap;
        overflow-x: auto;
        padding: 10px 0;
        margin-top: 6px;
    }
    .agent-avatar {
        display: flex;
        flex-direction: column;
        align-items: center;
        cursor: pointer;
        min-width: 84px;
        user-select: none;
    }
    .agent-avatar .avatar-img {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        border: 3px solid #e9ecef;
        object-fit: cover;
        transition: border-color 0.2s ease, transform 0.2s ease;
    }
    .agent-avatar.active .avatar-img {
        border-color: var(--theme-color);
        transform: translateY(-2px);
    }
    .agent-avatar .agent-name {
        margin-top: 8px;
        font-size: 12px;
        color: #333;
        text-align: center;
        max-width: 80px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    /* Readonly schedule tiles styled like booking day buttons */
    #agentScheduleGrid .day-btn {
        cursor: default;
    }
    #agentScheduleGrid .day-btn.disabled {
        opacity: 0.5;
    }
    #agentScheduleGrid .day-btn .time-text {
        display: block;
        font-weight: 400;
        font-size: 12px;
        color: #666;
        margin-top: 6px;
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
                <div class="col-lg-6">
                    <!-- Service summary card Start -->
                    <div class="service-summary-card">
                        <div class="card-cover">
                            <img src="{{ (isset($selectedService['images']) && count($selectedService['images']) > 0) ? $selectedService['images'][0] : asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}"
                                 alt="{{ $selectedService['service_name'] ?? 'Service' }}"
                                 onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                        </div>
                        <div class="card-body">
                            <h4 class="service-summary-title">{{ $selectedService['service_name'] ?? 'Selected Service' }}</h4>
                            <p class="service-summary-price">
                                ${{ $selectedService['discounted_price'] ?? ($selectedService['service_price'] ?? 0) }}
                                @if(isset($selectedService['discounted_price']) && isset($selectedService['service_price']) && $selectedService['discounted_price'] < $selectedService['service_price'])
                                    <span class="old-price">${{ $selectedService['service_price'] }}</span>
                                @endif
                            </p>
                            @if(!empty($selectedService['service_details']))
                                <p class="service-summary-desc">{{ $selectedService['service_details'] }}</p>
                            @endif
                        </div>
                    </div>
                    <!-- Service summary card End -->
                </div>

                <div class="col-lg-6">
                    <!-- Book Appointment Form Start -->
                    <div class="appointment-form wow fadeInUp" data-wow-delay="0.2s">
                        <form id="appointmentForm" action="#" method="POST" data-toggle="validator">
                            <div class="row">
                                <!-- Service Details Section -->
                                @if(!empty($selectedService))
                                <div class="col-md-12 mb-4">
                                    <div class="service-details-box">
                                        <div class="form-group mb-3">
                                            <label for="service_name">Service Name</label>
                                            <input type="text" name="service_name" class="form-control" id="service_name" value="{{ $selectedService['service_name'] ?? '' }}" readonly>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="service_price">Service Price</label>
                                            <input type="text" name="service_price" class="form-control" id="service_price" value="${{ $selectedService['discounted_price'] ?? ($selectedService['service_price'] ?? '0') }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if(!empty($agents))
                                <div class="col-md-12 mb-4">
                                    <label class="form-label">Select Agent</label>
                                    <div id="agentList" class="agent-avatars">
                                        @foreach($agents as $agent)
                                            <div class="agent-avatar" data-agent='@json($agent)'>
                                                <img class="avatar-img" src="{{ asset('images/istockphoto-1300845620-612x612.jpg') }}" alt="{{ $agent['name'] ?? 'Agent' }}">
                                                <div class="agent-name">{{ $agent['name'] ?? 'Agent' }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="agentSchedule" class="mt-3" style="display:none;">
                                        <h5>Schedule</h5>
                                        <div id="agentScheduleGrid" class="booking-days-buttons"></div>
                                        <input type="hidden" name="selected_day" id="selected_day" required>
                                        <div class="row mt-3">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Select Date</label>
                                                <input type="date" id="selected_date" name="selected_date" class="form-control" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Select Time</label>
                                                <input type="time" id="selected_time" name="selected_time" class="form-control" step="60" required>
                                            </div>
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                @endif

                                <!-- Personal Information -->                                
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-12 mb-4">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" required>
                                    <div class="help-block with-errors"></div>
                                </div>
    
                                <div class="form-group col-md-12 mb-4">
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <!-- Notes Section -->
                                {{-- <div class="form-group col-md-12 mb-4">
                                    <label for="notes">Additional Notes</label>
                                    <textarea name="notes" id="notes" class="form-control" rows="4" placeholder="Any special requests or notes for your appointment"></textarea>
                                </div> --}}
    
                                <div class="col-md-12">
                                    <button type="submit" class="btn-default"><span>Book an appointment</span></button>
                                    <div id="msgSubmit" class="h3 hidden"></div>
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
@endsection


{{-- Scripts --}}
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const bootstrap = {
        service: @json($selectedService ?? null),
        category: @json($selectedCategory ?? null),
        agents: @json($agents ?? []),
        serviceId: @json($serviceId ?? null),
        serviceProviderId: @json($serviceProviderId ?? null),
    };
    const dayButtons = document.querySelectorAll('.day-btn');
    const selectedDayInput = document.getElementById('selected_day');
    const selectedDateInput = document.getElementById('selected_date');
    const selectedTimeInput = document.getElementById('selected_time');
    const form = document.getElementById('appointmentForm');

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
    const agentScheduleGrid = document.getElementById('agentScheduleGrid');
    let chosenAgent = null;

    function secondsToHHMM(seconds) {
        const date = new Date(seconds * 1000);
        const hh = String(date.getUTCHours()).padStart(2, '0');
        const mm = String(date.getUTCMinutes()).padStart(2, '0');
        return `${hh}:${mm}`;
    }

    function renderTimingTiles(timing) {
        const days = [
            { key: 'Mon', label: 'MON' },
            { key: 'Tue', label: 'TUE' },
            { key: 'Wed', label: 'WED' },
            { key: 'Thu', label: 'THU' },
            { key: 'Fri', label: 'FRI' },
            { key: 'Sat', label: 'SAT' },
            { key: 'Sun', label: 'SUN' },
        ];
        return days.map(({ key, label }) => {
            const range = timing?.[key] || [];
            let inner = `<span>${label}</span>`;
            let disabledClass = '';
            if (Array.isArray(range) && range.length === 2) {
                const [start, end] = range;
                if (typeof start === 'number' && typeof end === 'number' && start !== end) {
                    inner += `<span class="time-text">${secondsToHHMM(start)} - ${secondsToHHMM(end)}</span>`;
                } else {
                    disabledClass = ' disabled';
                    inner += `<span class="time-text">Closed</span>`;
                }
            } else {
                disabledClass = ' disabled';
                inner += `<span class="time-text">Closed</span>`;
            }
            return `<button type="button" class="day-btn${disabledClass}" disabled>${inner}</button>`;
        }).join('');
    }

    if (agentList) {
        agentList.addEventListener('click', (e) => {
            const avatar = e.target.closest('.agent-avatar');
            if (!avatar) return;
            // Highlight selection
            [...agentList.querySelectorAll('.agent-avatar')].forEach(el => el.classList.remove('active'));
            avatar.classList.add('active');

            const agent = JSON.parse(avatar.dataset.agent);
            agentSchedule.style.display = '';
            agentScheduleGrid.innerHTML = renderTimingTiles(agent.timing || {});
            chosenAgent = agent;
        });
    }

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        if (!chosenAgent) {
            alert('Please select an agent');
            return;
        }
        if (!selectedDateInput?.value || !selectedTimeInput?.value) {
            alert('Please select date and time');
            return;
        }

        // Get form values
        const fname = form.fname.value.trim();
        const lname = form.lname.value.trim();
        const email = form.email.value.trim();
        const phone = form.phone.value.trim();

        // Combine name (just in case you want it)
        const fullName = fname + ' ' + lname;

        // Get params from URL (fallback) and from server (preferred)
        const urlParams = new URLSearchParams(window.location.search);
        const serviceId = bootstrap.serviceId || urlParams.get('serviceId');
        const serviceProviderId = bootstrap.serviceProviderId || urlParams.get('service_provider_id');

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
        const serviceName = bootstrap.service?.service_name || 'Selected Service';
        const servicePrice = (bootstrap.service?.discounted_price ?? bootstrap.service?.service_price ?? 0);
        const durationMinutes = (bootstrap.service?.duration_minutes ?? 0);
        const userId = bootstrap.service?.user_id || serviceId; // TODO: replace with authenticated user id when available

        if (!serviceId || !serviceProviderId) {
            alert("Missing 'serviceId' or 'service_provider_id' in URL.");
            return;
        }

        // Construct payload
        const payload = {
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
                }
            ]
        };

        try {
            const response = await fetch('https://us-central1-beauty-984c8.cloudfunctions.net/bookService', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            if (response.ok) {
                alert('Appointment booked successfully!');
                form.reset();
                selectedDayInput.value = '';
                dayButtons.forEach(btn => btn.classList.remove('active'));
            } else {
                const errorData = await response.json();
                alert('Booking failed: ' + (errorData.message || 'Unknown error'));
            }
        } catch (err) {
            alert('An error occurred: ' + err.message);
        }
    });
});
</script>

@endsection

