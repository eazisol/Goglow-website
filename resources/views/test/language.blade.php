@extends('layouts.main')

@section('title', 'Language Test')

@section('content')
<div class="container" style="padding: 60px 0;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h2>Language Test Page</h2>
                    <p>Current Language: <strong>{{ app()->getLocale() }}</strong></p>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h3>Language Switcher</h3>
                        @include('partials.language-switcher')
                    </div>
                    
                    <div class="mb-4">
                        <h3>Navigation Translations</h3>
                        <ul>
                            <li>{{ __('app.nav.home') }}</li>
                            <li>{{ __('app.nav.about_us') }}</li>
                            <li>{{ __('app.nav.services') }}</li>
                            <li>{{ __('app.nav.book_service') }}</li>
                            <li>{{ __('app.nav.contact_us') }}</li>
                            <li>{{ __('app.nav.login') }}</li>
                            <li>{{ __('app.nav.logout') }}</li>
                            <li>{{ __('app.nav.register') }}</li>
                        </ul>
                    </div>
                    
                    <div class="mb-4">
                        <h3>Authentication Translations</h3>
                        <ul>
                            <li>{{ __('app.auth.welcome') }}</li>
                            <li>{{ __('app.auth.sign_in') }}</li>
                            <li>{{ __('app.auth.sign_up') }}</li>
                            <li>{{ __('app.auth.email') }}</li>
                            <li>{{ __('app.auth.password') }}</li>
                            <li>{{ __('app.auth.confirm_password') }}</li>
                            <li>{{ __('app.auth.full_name') }}</li>
                            <li>{{ __('app.auth.phone') }}</li>
                            <li>{{ __('app.auth.location') }}</li>
                        </ul>
                    </div>
                    
                    <div class="mb-4">
                        <h3>Booking Translations</h3>
                        <ul>
                            <li>{{ __('app.booking.payment_options') }}</li>
                            <li>{{ __('app.booking.pay_deposit', ['percentage' => 15, 'amount' => '$30.00']) }}</li>
                            <li>{{ __('app.booking.pay_full', ['amount' => '$200.00']) }}</li>
                            <li>{{ __('app.booking.book_appointment') }}</li>
                            <li>{{ __('app.booking.select_date') }}</li>
                            <li>{{ __('app.booking.select_time') }}</li>
                        </ul>
                    </div>
                    
                    <div class="mb-4">
                        <h3>Schedule Translations</h3>
                        <ul>
                            <li>{{ __('app.schedule.monday') }}</li>
                            <li>{{ __('app.schedule.tuesday') }}</li>
                            <li>{{ __('app.schedule.wednesday') }}</li>
                            <li>{{ __('app.schedule.thursday') }}</li>
                            <li>{{ __('app.schedule.friday') }}</li>
                            <li>{{ __('app.schedule.saturday') }}</li>
                            <li>{{ __('app.schedule.sunday') }}</li>
                        </ul>
                    </div>
                    
                    <div class="mb-4">
                        <h3>Common Translations</h3>
                        <ul>
                            <li>{{ __('app.common.loading') }}</li>
                            <li>{{ __('app.common.error') }}</li>
                            <li>{{ __('app.common.success') }}</li>
                            <li>{{ __('app.common.cancel') }}</li>
                            <li>{{ __('app.common.save') }}</li>
                            <li>{{ __('app.common.edit') }}</li>
                            <li>{{ __('app.common.delete') }}</li>
                            <li>{{ __('app.common.close') }}</li>
                            <li>{{ __('app.common.submit') }}</li>
                        </ul>
                    </div>
                    
                    <div class="mb-4">
                        <h3>Messages Translations</h3>
                        <ul>
                            <li>{{ __('app.messages.login_success') }}</li>
                            <li>{{ __('app.messages.login_error') }}</li>
                            <li>{{ __('app.messages.register_success') }}</li>
                            <li>{{ __('app.messages.register_error') }}</li>
                            <li>{{ __('app.messages.booking_success') }}</li>
                            <li>{{ __('app.messages.booking_error') }}</li>
                        </ul>
                    </div>
                    
                    <div class="mb-4">
                        <h3>Footer Translations</h3>
                        <ul>
                            <li>{{ __('app.footer.about_description') }}</li>
                            <li>{{ __('app.footer.urgent_support') }}</li>
                            <li>{{ __('app.footer.email_us') }}</li>
                            <li>{{ __('app.footer.connect_with_us') }}</li>
                        </ul>
                    </div>
                    
                    <div class="mb-4">
                        <h3>Home Page Translations</h3>
                        <ul>
                            <li>{{ __('app.home.hero_title') }}</li>
                            <li>{{ __('app.home.hero_subtitle') }}</li>
                            <li>{{ __('app.home.search_button') }}</li>
                            <li>{{ __('app.home.book_appointment_button') }}</li>
                        </ul>
                    </div>
                    
                    <div class="mt-4">
                        <h3>Test Links</h3>
                        <a href="{{ route('language.switch', 'en') }}" class="btn btn-primary me-2">Switch to English</a>
                        <a href="{{ route('language.switch', 'fr') }}" class="btn btn-primary me-2">Switch to French</a>
                        <a href="{{ url('/') }}" class="btn btn-secondary">Go to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
