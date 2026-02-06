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

    {{-- Booking App Container with Data Attributes for JavaScript --}}
    @php
        // Prepare translations for JavaScript
        $jsTranslations = [
            'service' => [
                'see_more' => __('app.service.see_more'),
                'see_less' => __('app.service.see_less'),
            ],
            'schedule' => [
                'short_sunday' => __('app.schedule.short_sunday'),
                'short_monday' => __('app.schedule.short_monday'),
                'short_tuesday' => __('app.schedule.short_tuesday'),
                'short_wednesday' => __('app.schedule.short_wednesday'),
                'short_thursday' => __('app.schedule.short_thursday'),
                'short_friday' => __('app.schedule.short_friday'),
                'short_saturday' => __('app.schedule.short_saturday'),
                'month_january' => __('app.schedule.month_january'),
                'month_february' => __('app.schedule.month_february'),
                'month_march' => __('app.schedule.month_march'),
                'month_april' => __('app.schedule.month_april'),
                'month_may' => __('app.schedule.month_may'),
                'month_june' => __('app.schedule.month_june'),
                'month_july' => __('app.schedule.month_july'),
                'month_august' => __('app.schedule.month_august'),
                'month_september' => __('app.schedule.month_september'),
                'month_october' => __('app.schedule.month_october'),
                'month_november' => __('app.schedule.month_november'),
                'month_december' => __('app.schedule.month_december'),
                'at' => __('app.schedule.at'),
                'select_date' => __('app.schedule.select_date') ?? 'Select a date',
                'no_slot_available' => __('app.schedule.no_slot_available'),
            ],
            'agent_page' => [
                'choose_with_whom' => __('app.agent_page.choose_with_whom'),
                'no_preference' => __('app.agent_page.no_preference'),
                'schedule' => __('app.agent_page.schedule'),
                'selected' => __('app.agent_page.selected'),
                'the_morning' => __('app.agent_page.the_morning'),
                'in_the_afternoon' => __('app.agent_page.in_the_afternoon'),
                'in_the_evening' => __('app.agent_page.in_the_evening'),
                'please_select_day' => __('app.agent_page.please_select_day'),
                'please_select_agent' => __('app.agent_page.please_select_agent'),
                'please_select_time_slot' => __('app.agent_page.please_select_time_slot'),
                'see_more' => __('app.agent_page.see_more'),
                'more' => __('app.agent_page.more'),
                'no_agent_assigned' => __('app.agent_page.no_agent_assigned'),
                'payment_options' => __('app.agent_page.payment_options'),
                'pay_full_amount_now' => __('app.agent_page.pay_full_amount_now'),
                'book_an_appointment' => __('app.agent_page.book_an_appointment'),
            ],
            'booking' => [
                'loading_available_slots' => __('app.booking.loading_available_slots'),
                'failed_to_load_slots' => __('app.booking.failed_to_load_slots') ?? 'Failed to load time slots. Please try again.',
            ],
            'bookings' => [
                'confirm_reschedule' => __('app.bookings.confirm_reschedule') ?? 'Confirm Reschedule',
                'reschedule_error' => __('app.bookings.reschedule_error') ?? 'An error occurred while rescheduling',
            ],
            'common' => [
                'loading' => __('app.common.loading'),
            ],
        ];
    @endphp

    <div id="booking-app"
         data-service='@json($selectedService ?? null)'
         data-category='@json($selectedCategory ?? null)'
         data-agents='@json($agents ?? [])'
         data-service-id="{{ $serviceId ?? '' }}"
         data-service-provider-id="{{ $serviceProviderId ?? '' }}"
         data-company-username="{{ $companyUserName ?? '' }}"
         data-services-slug="{{ $servicesSlug ?? '' }}"
         data-user-id="{{ $userId ?? '' }}"
         data-user-data='@json($userData ?? null)'
         data-reschedule-booking-id="{{ $rescheduleBookingId ?? '' }}"
         data-csrf-token="{{ csrf_token() }}"
         data-checkout-url="{{ route('checkout.session') }}"
         data-my-bookings-url="{{ route('my-bookings') }}"
         data-firebase-url="{{ config('services.firebase.cloud_functions_url') }}"
         data-backend-url="{{ config('services.backend.url', 'https://backend.glaura.ai') }}"
         data-locale="{{ app()->getLocale() }}"
         data-translations='@json($jsTranslations)'>

        <!-- Book Appointment Section Start -->
        <div class="page-book-appointment">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Service summary card -->
                        @include('bookAppointment.partials._service-summary')

                        <!-- Agent & Schedule (Planity-style) -->
                        @include('bookAppointment.partials._agent-selection')
                    </div>

                    <div class="col-12" style="display: grid;justify-content: center;">
                        <!-- Book Appointment Form -->
                        @include('bookAppointment.partials._booking-form')
                    </div>
                </div>
            </div>
        </div>
        <!-- Book Appointment Section End -->

    </div>

    @include('partials.auth-modals')
@endsection


{{-- Scripts --}}
@section('scripts')
{{-- External JavaScript file with all booking logic (includes description toggle via delegated event) --}}
<script src="{{ \App\Helpers\AssetHelper::versioned('js/bookAppointment.js') }}"></script>
@endsection
