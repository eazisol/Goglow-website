@extends('layouts.mainInnerPages')
{{-- Title --}}
@section('title', 'home')

{{-- Style Files --}}
@section('styles')
@once
    <!-- Bootstrap CSS for modals -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endonce
<style>
    /* Bootstrap compatibility layer for inner pages */
    .page-book-appointment {
        display: flex;
        justify-content: center;
        padding: 60px 0 80px;
        background: rgba(255, 244, 248, 1);
    }

    .page-book-appointment > .container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 24px;
        width: 100%;
    }

    .page-book-appointment .row {
        display: flex;
        flex-wrap: wrap;
        margin-left: -16px;
        margin-right: -16px;
    }

    .page-book-appointment .row > [class*="col-"] {
        padding-left: 16px;
        padding-right: 16px;
        width: 100%;
    }

    .page-book-appointment .col-md-12,
    .page-book-appointment .col-lg-12,
    .page-book-appointment .col-xl-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    @media (min-width: 992px) {
        .page-book-appointment .col-lg-7 {
            flex: 0 0 58.333%;
            max-width: 58.333%;
        }

        .page-book-appointment .col-lg-5 {
            flex: 0 0 41.667%;
            max-width: 41.667%;
        }
    }

    @media (min-width: 1200px) {
        .page-book-appointment .col-xl-8 {
            flex: 0 0 66.667%;
            max-width: 66.667%;
        }

        .page-book-appointment .col-xl-4 {
            flex: 0 0 33.333%;
            max-width: 33.333%;
        }
    }

    .page-book-appointment .d-flex {
        display: flex !important;
    }

    .page-book-appointment .justify-content-between {
        justify-content: space-between !important;
    }

    .page-book-appointment .align-items-center {
        align-items: center !important;
    }

    .page-book-appointment .fw-bold {
        font-weight: 600 !important;
    }

    .page-book-appointment .text-center {
        text-align: center !important;
    }

    .page-book-appointment .mt-3 {
        margin-top: 1rem !important;
    }

    .page-book-appointment .mt-4 {
        margin-top: 1.5rem !important;
    }

    .page-book-appointment .mb-2 {
        margin-bottom: 0.5rem !important;
    }

    .page-book-appointment .mb-3 {
        margin-bottom: 1rem !important;
    }

    .page-book-appointment .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    .page-book-appointment .py-3 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .page-book-appointment .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid transparent;
        border-radius: 6px;
        background-color: #f1f3f5;
        color: #1c1c1c;
        font-size: 0.875rem;
        font-weight: 500;
        line-height: 1.5;
        padding: 0.4rem 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
        text-decoration: none;
    }

    .page-book-appointment .btn:hover {
        background-color: #e9ecef;
    }

    .page-book-appointment .btn-sm {
        padding: 0.25rem 0.65rem;
        font-size: 0.75rem;
    }

    .page-book-appointment .btn-secondary {
        background-color: #e9ecef;
        border-color: #dfe3e6;
        color: #1c1c1c;
    }

    .page-book-appointment .btn-secondary:hover {
        background-color: #dfe3e6;
    }

    .page-book-appointment .alert {
        position: relative;
        padding: 0.75rem 1rem;
        border-radius: 6px;
        border: 1px solid transparent;
        font-size: 0.95rem;
    }

    .page-book-appointment .alert-info {
        color: #055160;
        background-color: #cff4fc;
        border-color: #b6effb;
    }

    .page-book-appointment .form-group {
        margin-bottom: 1.5rem;
    }

    .page-book-appointment .form-control {
        width: 100%;
        padding: 0.65rem 0.9rem;
        border-radius: 6px;
        border: 1px solid #ced4da;
        font-size: 0.95rem;
        background-color: #fff;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .page-book-appointment .form-control:focus {
        border-color: var(--theme-color, #1c1c1c);
        outline: none;
        box-shadow: 0 0 0 0.1rem rgba(0, 0, 0, 0.08);
    }

    .page-book-appointment .form-check {
        display: flex;
        align-items: flex-start;
        gap: 0.65rem;
        margin-bottom: 0.75rem;
    }

    .page-book-appointment .form-check-input {
        width: 1.1rem;
        height: 1.1rem;
        margin-top: 0.1rem;
        border: 1px solid #adb5bd;
        border-radius: 50%;
        appearance: none;
        background-color: #fff;
        position: relative;
        cursor: pointer;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .page-book-appointment .form-check-input:checked {
        border-color: var(--theme-color, #1c1c1c);
        background-color: var(--theme-color, #1c1c1c);
    }

    .page-book-appointment .form-check-input:checked::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0.45rem;
        height: 0.45rem;
        border-radius: 50%;
        background-color: #fff;
        transform: translate(-50%, -50%);
    }

    .page-book-appointment .form-check-label {
        font-size: 0.95rem;
        color: #333;
        line-height: 1.4;
        cursor: pointer;
    }

    .page-book-appointment .hidden {
        display: none !important;
    }

    .page-book-appointment .h3 {
        font-size: 1.35rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .page-book-appointment .text-muted {
        color: #6c757d !important;
    }

    .page-book-appointment .w-100 {
        width: 100% !important;
    }

    .page-book-appointment .gap-2 {
        gap: 0.5rem !important;
    }

    .page-book-appointment .rounded-circle {
        border-radius: 50% !important;
    }

    .page-book-appointment .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }

    .page-book-appointment .badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        border-radius: 10rem;
        background-color: #1c1c1c;
        color: #fff;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .page-book-appointment .position-relative {
        position: relative !important;
    }

    .page-book-appointment .position-absolute {
        position: absolute !important;
    }

    .page-book-appointment .top-0 {
        top: 0 !important;
    }

    .page-book-appointment .start-50 {
        left: 50% !important;
    }

    .page-book-appointment .translate-middle {
        transform: translate(-50%, -50%) !important;
    }

    @media (max-width: 767.98px) {
        .page-book-appointment .row > [class*="col-"] {
            padding-left: 10px;
            padding-right: 10px;
        }

        .page-book-appointment > .container {
            padding: 0 18px;
        }
    }

    /* Prevent Bootstrap CSS from affecting header/footer */
    .nav-header-section,
    .nav-header-section *,
    footer,
    footer * {
        box-sizing: border-box !important;
    }

    /* Ensure modals work properly */
    .modal {
        z-index: 1055;
    }

    .modal-backdrop {
        z-index: 1050;
        background-color: rgba(0, 0, 0, 0.5);
    }

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
        font-weight: 700;
        color: rgba(44, 13, 24, 1);
        margin-bottom: 18px;
        display: block;
    }

    @media (max-width: 768px) {
        .booking-days-buttons {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Service summary card (left side) */
    .service-summary-card {
        border: 1px solid rgba(213, 190, 198, 1);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        /* previously sticky; make it normal so it scrolls with the page */
        position: static;
    }
    .service-summary-card .card-cover img {
        border-radius : 20px;
        display: block;
        width: 100%;
        height: 220px; /* fixed so it doesn't stretch with form */
        object-fit: cover;
    }
    .card-cover{
        padding: 30px 30px 0 30px;
    }
    .service-summary-card .card-body {
        padding: 10px 30px 10px;
    }
    .service-summary-title {
        margin: 0 0 6px 0;
        font-size: 30px;
        font-weight: 700;
        text-transform: capitalize;
        color: #1c1c1c;
    }
    .service-summary-price {
        font-size:18px;
        margin: 0 0 10px 0;
        font-weight: 700;
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
        justify-content: center;
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
        border-color: #e50050;
        transform: translateY(-2px);
    }
    .agent-avatar .agent-name {
        margin-top: 8px;
        font-size: 14px;
        font-weight:500;
        color: #333;
        text-align: center;
        max-width: 80px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    /* Weekly calendar header */
    #weekDisplay {
        font-weight: 700;
        letter-spacing: 0.06em;
        color: rgba(77, 38, 64, 0.85);
        text-align: center;
        font-size: 18px;
        margin-bottom: 18px;
    }

    /* .calendar-strip {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 18px;
        margin-bottom: 24px;
    } */

    .calendar-arrow {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: none;
        background: transparent;
        color: #ff2d2dff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .calendar-arrow:hover:not(:disabled) {
        color: #c71a6a;
        transform: translateY(-1px);
    }

    .calendar-arrow:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    .calendar-strip {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 55px;
        margin-bottom: 24px;
    }

    .days-header {
        display: flex;
        gap: 12px;
        align-items: center;
        justify-content: center;
        overflow-x: auto;
        padding: 6px 2px 10px;
    }

    .day-column {
        min-width: 84px;
        background: #fff;
        border-radius: 10px;
        padding: 40px 0 40px;
        text-align: center;
        transition: all 0.25s ease;
        color: rgba(77, 38, 64, 0.75);
        font-weight: 600;
        border: 2px solid rgba(213, 190, 198, 0.9);
        position: relative;
    }

    .day-column .day-name {
        font-size: 12px;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .day-column .day-date {
        font-size: 16px;
        font-weight: 700;
        color: rgba(77, 38, 64, 0.85);
    }

    .day-column::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 12px;
        transform: translateX(-50%);
        width: 28px;
        height: 6px;
        border-radius: 999px;
        background: rgba(229, 0, 80, 1);
        transition: all 0.2s ease;
    }

    .day-column:hover {
        border-color: rgba(255, 45, 139, 0.35);
        transform: translateY(-1px);
        color: rgba(77, 38, 64, 0.95);
    }

    .day-column.active {
        background: rgba(229, 0, 80, 1);
        border-color: rgba(229, 0, 80, 1);
        color: #fff;
        transform: translateY(-2px);
    }

    .day-column.active .day-name,
    .day-column.active .day-date {
        color: #fff;
    }

    .day-column.active::after {
        background: #fff;
        width: 30px;
    }

    @media (max-width: 768px) {
        .calendar-strip {
            width: 100%;
            gap: 14px;
        }

        .calendar-strip .calendar-arrow {
            flex-shrink: 0;
        }

        .days-header {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            padding: 0;
            overflow: visible;
        }

        .day-column {
            min-width: 0;
        }

        .days-header .day-column:nth-child(n + 4) {
            display: none;
        }
    }
    
    /* Align 7 vertical columns of slots under the 7 days */
    .time-slots-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(0, 85px));
        justify-content: center;
        column-gap: 10px;
        row-gap: 8px;
        margin-top: 24px;
        align-items: start;
    }

    /* Each day's vertical stack */
    .day-slots-column {
        display: flex;
        flex-direction: column;
        gap: 6px;
        min-height: 48px;
        width: 85px;
    }

    @media (max-width: 768px) {
        .time-slots-container .day-slots-column:nth-child(n + 4) {
            display: none;
        }
    }
    
    .time-slot {
        padding: 6px 4px;
        text-align: center;
        background-color: #f8f9fa;
        border-radius: 6px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid #e9ecef;
    }
    
    .time-slot:hover {
        background-color: #e9ecef;
        transform: translateY(-2px);
    }
    
    .time-slot.selected {
        background-color: black;
        color: white;
        border-color: var(--theme-color);
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .time-slot.unavailable {
        display: none;
    }
    .footer-section ul{
        padding-left:initial!important;
    }

    /* Layout fixes: ensure right form column doesn't get vertically centered
       or add large top/bottom whitespace when left column grows */
    .page-book-appointment .row { align-items: flex-start !important; }
    /* Keep uniform padding so top/bottom match left/right */
    .appointment-form { min-height: unset !important; height: auto !important; display: block !important; padding: 24px !important; }
    
    /* Highlight today's date in the schedule */
    /* .day-column.today:not(.active) {
        border-color: rgba(255, 45, 139, 0.35);
        background: rgba(255, 45, 139, 0.08);
        color: rgba(255, 45, 139, 0.85);
    } */

    /* .day-column.today:not(.active)::after {
        background: rgba(255, 45, 139, 0.4);
    }

    .day-column.today:not(.active) .day-name,
    .day-column.today:not(.active) .day-date {
        color: rgba(255, 45, 139, 0.85);
    } */
/* 
    .day-slots-column.today {
        background-color: rgba(255, 45, 139, 0.06);
        border-left: 2px solid rgba(255, 45, 139, 0.25);
        border-right: 2px solid rgba(255, 45, 139, 0.25);
    }
     */
    /* User info summary styling */
    .user-info-summary {
        background-color: #f8f9fa;
        border-left: 4px solid var(--theme-color);
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    
    .user-info-summary h5 {
        color: var(--theme-color);
        margin-bottom: 10px;
        font-weight: 600;
    }
    
    .user-info-summary p {
        margin-bottom: 5px;
        font-size: 14px;
    }
    
    .user-info-summary p:last-child {
        margin-bottom: 0;
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
                                <p class="service-summary-desc">{{ \Illuminate\Support\Str::limit($selectedService['service_details'], 150, '.....') }}</p>
                                
                            @endif
                        </div>
                    </div>
                    <!-- Service summary card End -->

                                @if(!empty($agents))
                    <!-- Agent & Schedule (moved here) -->
                    <div class="mt-4" style="justify-content: center;display: grid;">
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
                            <h5 style="margin-bottom: 10px;font-size:18px;font-weight:700;">{{ __('app.agent_page.schedule') }}</h5>

                            <!-- Selected slot info (moved directly under heading) -->
                            <div id="selectedSlotInfo" class="alert alert-info mb-3" style="display: none;">
                                <i class="fa fa-info-circle"></i>
                                {{ __('app.agent_page.selected') }}: <span id="selectedDateTimeDisplay"></span>
                                            </div>

                            <div id="weekDisplay"></div>

                            <div class="calendar-strip">
                                <button type="button" id="prevWeek" class="calendar-arrow">
                                    <img src="images/images/leftarrow_days.svg" alt="" width="16" height="16">
                                </button>
                                <div class="days-header"></div>
                                <button type="button" id="nextWeek" class="calendar-arrow">
                                    <img src="images/images/rightarrow_days.svg" alt="" width="16" height="16">
                                </button>
                            </div>

                            <div id="timeSlotGrid" class="time-slots-container"></div>
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
                                
                                <!-- Payment Options -->
                                <div class="form-group col-md-12 mb-4">
                                    <label class="form-label">{{ __('app.agent_page.payment_options') }}</label>
                                    <div class="payment-options">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="paymentType" id="payDeposit" value="deposit" checked>
                                            <label class="form-check-label" for="payDeposit">
                                                {{ __('app.agent_page.pay_15%_deposit_now') }} (${{ number_format(($selectedService['discounted_price'] ?? ($selectedService['service_price'] ?? 0)) * 0.15, 2) }})
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="paymentType" id="payFull" value="full">
                                            <label class="form-check-label" for="payFull">
                                                {{ __('app.agent_page.pay_full_amount_now') }} (${{ $selectedService['discounted_price'] ?? ($selectedService['service_price'] ?? 0) }})
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Notes Section -->
                                {{-- <div class="form-group col-md-12 mb-4">
                                    <label for="notes">Additional Notes</label>
                                    <textarea name="notes" id="notes" class="form-control" rows="4" placeholder="Any special requests or notes for your appointment"></textarea>
                                </div> --}}
    
                                <div class="col-md-12">
                                    <button type="submit" class="btn-default"><span>{{ __('app.agent_page.book_an_appointment') }}</span></button>
                                    {{-- <button type="button" id="testStripeBtn" class="btn-alt" style="margin-left: 10px;"><span>Test Stripe Connection</span></button> --}}
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
    
    // Renamed to avoid namespace collision with Bootstrap JS
    const bookingBootstrap = {
        service: @json($selectedService ?? null),
        category: @json($selectedCategory ?? null),
        agents: @json($agents ?? []),
        serviceId: @json($serviceId ?? null),
        serviceProviderId: @json($serviceProviderId ?? null),
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
    
    let chosenAgent = null;
    
    // Start with today's date as the reference point
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    // Initialize current week start to today
    let currentWeekStart = new Date(today);
    
    // Store today's date for reference
    const todayDate = today.getDate();
    const todayMonth = today.getMonth();
    const todayYear = today.getFullYear();
    
    // Day names mapping
    const dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const shortDayNames = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
    const dayKeys = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    
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
    
    // Format time from "HH:MM" to display format
    function formatTimeDisplay(timeStr) {
        const [hours, minutes] = timeStr.split(':').map(Number);
        const ampm = hours >= 12 ? 'p.m.' : 'a.m.';
        const displayHours = hours % 12 || 12;
        return `${displayHours}:${minutes.toString().padStart(2, '0')} ${ampm}`;
    }
    
    // Format date for display
    function formatDate(date) {
        return date.toLocaleDateString('en-US', { 
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
        
        const startMonth = currentWeekStart.toLocaleString('default', { month: 'long' });
        const endMonth = endDate.toLocaleString('default', { month: 'long' });
        
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
            
            // Add click event to focus the chosen day (no filtering – keep all slots visible)
            dayCol.addEventListener('click', function() {
                document.querySelectorAll('.day-column').forEach(col => col.classList.remove('active'));
                this.classList.add('active');
                const dayKey = dayKeys[date.getDay()];
                selectedDayInput.value = dayKey;
                // Smoothly scroll the corresponding column into view
                const col = document.querySelector(`.day-slots-column[data-day="${dayKey}"]`);
                col?.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
            });
        }
    }
    
    // Keep function unused (no filtering). Left in place for future use if needed.
    function filterTimeSlotsByDay(dayKey) {}
    
    // Render time slots for the week
    function renderTimeSlots(slots) {
        console.log('Rendering time slots:', slots);
        timeSlotGrid.innerHTML = '';
        
        if (!slots || Object.keys(slots).length === 0) {
            timeSlotGrid.innerHTML = '<div class="col-12 text-center py-3">No available time slots</div>';
            return;
        }
        
        // Debug: Count total available slots
        let totalSlots = 0;
        Object.keys(slots).forEach(day => {
            const availableSlots = Array.isArray(slots[day]) ? 
                slots[day].filter(slot => slot.available).length : 0;
            totalSlots += availableSlots;
            console.log(`Day ${day}: ${availableSlots} available slots`);
        });
        console.log(`Total available slots: ${totalSlots}`);
        
        // If no slots are available after filtering, show a message
        if (totalSlots === 0) {
            timeSlotGrid.innerHTML = '<div class="col-12 text-center py-3">No available time slots for this week</div>';
            return;
        }
        
        // Create a vertical column for each day and fill with that day's slots
        for (let i = 0; i < 7; i++) {
            const date = new Date(currentWeekStart);
            date.setDate(date.getDate() + i);
            
            // Skip rendering if the date is before today
            if (date < today) {
                continue;
            }
            
            const dayKey = dayKeys[date.getDay()];
            const daySlots = slots[dayKey] || [];

            // Create the column wrapper regardless, to keep alignment
            const col = document.createElement('div');
            col.className = 'day-slots-column';
            col.dataset.day = dayKey;
            
            // Check if this is today
            const isToday = date.getDate() === todayDate && 
                           date.getMonth() === todayMonth && 
                           date.getFullYear() === todayYear;
            
            if (isToday) {
                col.classList.add('today');
            }

            if (Array.isArray(daySlots) && daySlots.length > 0) {
                daySlots.forEach(slot => {
                    if (!slot.available) return; // Skip unavailable slots

                    const timeSlot = document.createElement('div');
                    timeSlot.className = 'time-slot';
                    timeSlot.dataset.day = dayKey;
                    timeSlot.dataset.time = slot.time;
                    timeSlot.dataset.date = formatDateValue(date);
                    timeSlot.textContent = formatTimeDisplay(slot.time);

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
                        const selectedDate = new Date(yy, mm - 1, dd);
                        const formattedDate = formatDate(selectedDate);
                        const formattedTime = formatTimeDisplay(this.dataset.time);
                        selectedDateTimeDisplay.textContent = `${formattedDate} at ${formattedTime}`;
                        selectedSlotInfo.style.display = '';
                        // Ensure hidden selected day reflects the clicked slot's day
                        selectedDayInput.value = this.dataset.day;
                    });

                    col.appendChild(timeSlot);
                });
            }

            timeSlotGrid.appendChild(col);
        }
        
        // Do not auto-select any day; show all columns with their slots by default
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
            if (chosenAgent && chosenAgent.slots) {
                renderTimeSlots(chosenAgent.slots);
            }
        }
        
        // Update button state
        updatePrevWeekButtonState();
    });
    
    // Navigate to next week
    nextWeekBtn.addEventListener('click', function() {
        currentWeekStart.setDate(currentWeekStart.getDate() + 7);
        updateWeekDisplay();
        renderDaysHeader();
        if (chosenAgent && chosenAgent.slots) {
            renderTimeSlots(chosenAgent.slots);
        }
        
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
            
            // Initialize the week display
            updateWeekDisplay();
            renderDaysHeader();
            
            // Initialize the button state
            updatePrevWeekButtonState();
            
            // If agent has timing data but no slots, convert timing to slots format
            if (!agent.slots && agent.timing) {
                console.log('Converting timing to slots format');
                const slots = convertTimingToSlots(agent.timing);
                console.log('Generated slots:', slots);
                renderTimeSlots(slots);
            } else if (agent.slots) {
                // Render time slots from agent data
                renderTimeSlots(agent.slots);
            } else {
                // No slots or timing data, create sample data for testing
                console.log('No slots or timing data found, creating sample data');
                const sampleSlots = createSampleSlots();
                console.log('Sample slots:', sampleSlots);
                renderTimeSlots(sampleSlots);
            }
        });
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
        const serviceId = bookingBootstrap.serviceId || urlParams.get('serviceId');
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
                const errorText = await response.text();
                console.error('Error response:', response.status, errorText);
                throw new Error(`Server responded with ${response.status}: ${errorText}`);
            }

            const session = await response.json();
            console.log('Received session:', session);
            
            if (session.error) {
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
                alert('Error: ' + result.error.message);
            }
        } catch (err) {
            console.error('Error in form submission:', err);
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

