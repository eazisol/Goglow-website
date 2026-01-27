@extends('layouts.main')
{{-- Title --}}
@section('title', __('app.auth.sign_up'))

{{-- Style Files --}}
@section('styles')
<style>
    .form-label { font-weight: 500; color: #333; margin-bottom: 8px; display: block; }
    .small-text { font-size: 13px; color: #666; }
    .input-group-text { background: #fff; }
    .password-toggle { cursor: pointer; }
    .required { color: var(--error-color); }
    .policy-link { text-decoration: underline; }
</style>
@endsection

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
	
	<!-- Signup Section Start -->
    <div class="page-book-appointment">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Signup image Start -->
                    <div class="appointment-image">
                        <figure class="image-anime reveal">
                            <img src="{{ asset('images/kimia-kazemi-u93nTfWqR9w-unsplash.jpg') }}" alt="{{ __('app.auth.sign_up') }}">
                        </figure>
                        
                        <!-- Feature List Start -->
                        {{-- <div class="mt-4">
                            <div class="section-title">
                                <h3 class="wow fadeInUp">why join</h3>
                                <h2 class="text-anime-style-2" >Beauty made <span>simple</span></h2>
                            </div>
                            <ul class="feature-list">
                                <li><i class="fa fa-check"></i><span>Book services with top-rated professionals</span></li>
                                <li><i class="fa fa-check"></i><span>Track appointments and manage reschedules</span></li>
                                <li><i class="fa fa-check"></i><span>Get personalized beauty recommendations</span></li>
                                <li><i class="fa fa-check"></i><span>Access member-only deals and perks</span></li>
                            </ul>
                        </div> --}}
                        <!-- Feature List End -->
                    </div>
                    <!-- Signup image End -->
                </div>

                <div class="col-lg-6">
                    <!-- Signup Form Start -->
                    <div class="appointment-form wow fadeInUp" data-wow-delay="0.2s">
                        <div class="section-title mb-4">
                            <h3 class="wow fadeInUp">{{ __('app.auth.create_account') }}</h3>
                            <h2 class="text-anime-style-2" >{{ __('app.auth.join') }} <span>Glaura</span></h2>
                            <p class="small-text">{{ __('app.auth.signup_description') }}</p>
                        </div>
                        
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('signup.store') }}" data-toggle="validator">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="{{ __('app.auth.first_name') }}" value="{{ old('first_name') }}" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="{{ __('app.auth.last_name') }}" value="{{ old('last_name') }}" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-12 mb-4">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="{{ __('app.auth.email') }}" value="{{ old('email') }}" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <label class="form-label">{{ __('app.auth.phone') }}</label>
                                    <div class="phone-input-group">
                                        <select name="country_code" class="form-control country-code-select" id="country-code" required data-old-value="{{ old('country_code') }}" data-initialized="false">
                                            <option value="">{{ __('app.auth.select_country') }}</option>
                                        </select>
                                        
                                        <input type="tel" name="phone" class="form-control phone-input" id="phone" placeholder="{{ __('app.auth.phone') }}" value="{{ old('phone') }}" required>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <script>
                                // Inline country data and initialization for signup page
                                (function() {
                                    // Function to get flag emoji from country code
                                    function getCountryFlag(code) {
                                        const flagMap = {
                                            'US': '🇺🇸', 'GB': '🇬🇧', 'CA': '🇨🇦', 'AU': '🇦🇺', 'DE': '🇩🇪',
                                            'FR': '🇫🇷', 'IT': '🇮🇹', 'ES': '🇪🇸', 'NL': '🇳🇱', 'BE': '🇧🇪',
                                            'CH': '🇨🇭', 'AT': '🇦🇹', 'SE': '🇸🇪', 'NO': '🇳🇴', 'DK': '🇩🇰',
                                            'FI': '🇫🇮', 'PL': '🇵🇱', 'PT': '🇵🇹', 'GR': '🇬🇷', 'IE': '🇮🇪',
                                            'NZ': '🇳🇿', 'JP': '🇯🇵', 'KR': '🇰🇷', 'CN': '🇨🇳', 'IN': '🇮🇳',
                                            'BR': '🇧🇷', 'MX': '🇲🇽', 'AR': '🇦🇷', 'ZA': '🇿🇦', 'AE': '🇦🇪',
                                            'SA': '🇸🇦', 'EG': '🇪🇬', 'NG': '🇳🇬', 'KE': '🇰🇪', 'GH': '🇬🇭',
                                            'MA': '🇲🇦', 'TN': '🇹🇳', 'DZ': '🇩🇿', 'TR': '🇹🇷', 'IL': '🇮🇱',
                                            'RU': '🇷🇺', 'UA': '🇺🇦', 'PK': '🇵🇰', 'BD': '🇧🇩', 'PH': '🇵🇭',
                                            'TH': '🇹🇭', 'VN': '🇻🇳', 'ID': '🇮🇩', 'MY': '🇲🇾', 'SG': '🇸🇬',
                                            'HK': '🇭🇰', 'TW': '🇹🇼'
                                        };
                                        return flagMap[code] || '🏳️';
                                    }
                                    
                                    const countryList = [
                                        {code: 'US', name: 'United States', prefix: '+1'},
                                        {code: 'GB', name: 'United Kingdom', prefix: '+44'},
                                        {code: 'CA', name: 'Canada', prefix: '+1'},
                                        {code: 'AU', name: 'Australia', prefix: '+61'},
                                        {code: 'DE', name: 'Germany', prefix: '+49'},
                                        {code: 'FR', name: 'France', prefix: '+33'},
                                        {code: 'IT', name: 'Italy', prefix: '+39'},
                                        {code: 'ES', name: 'Spain', prefix: '+34'},
                                        {code: 'NL', name: 'Netherlands', prefix: '+31'},
                                        {code: 'BE', name: 'Belgium', prefix: '+32'},
                                        {code: 'CH', name: 'Switzerland', prefix: '+41'},
                                        {code: 'AT', name: 'Austria', prefix: '+43'},
                                        {code: 'SE', name: 'Sweden', prefix: '+46'},
                                        {code: 'NO', name: 'Norway', prefix: '+47'},
                                        {code: 'DK', name: 'Denmark', prefix: '+45'},
                                        {code: 'FI', name: 'Finland', prefix: '+358'},
                                        {code: 'PL', name: 'Poland', prefix: '+48'},
                                        {code: 'PT', name: 'Portugal', prefix: '+351'},
                                        {code: 'GR', name: 'Greece', prefix: '+30'},
                                        {code: 'IE', name: 'Ireland', prefix: '+353'},
                                        {code: 'NZ', name: 'New Zealand', prefix: '+64'},
                                        {code: 'JP', name: 'Japan', prefix: '+81'},
                                        {code: 'KR', name: 'South Korea', prefix: '+82'},
                                        {code: 'CN', name: 'China', prefix: '+86'},
                                        {code: 'IN', name: 'India', prefix: '+91'},
                                        {code: 'BR', name: 'Brazil', prefix: '+55'},
                                        {code: 'MX', name: 'Mexico', prefix: '+52'},
                                        {code: 'AR', name: 'Argentina', prefix: '+54'},
                                        {code: 'ZA', name: 'South Africa', prefix: '+27'},
                                        {code: 'AE', name: 'UAE', prefix: '+971'},
                                        {code: 'SA', name: 'Saudi Arabia', prefix: '+966'},
                                        {code: 'EG', name: 'Egypt', prefix: '+20'},
                                        {code: 'NG', name: 'Nigeria', prefix: '+234'},
                                        {code: 'KE', name: 'Kenya', prefix: '+254'},
                                        {code: 'GH', name: 'Ghana', prefix: '+233'},
                                        {code: 'MA', name: 'Morocco', prefix: '+212'},
                                        {code: 'TN', name: 'Tunisia', prefix: '+216'},
                                        {code: 'DZ', name: 'Algeria', prefix: '+213'},
                                        {code: 'TR', name: 'Turkey', prefix: '+90'},
                                        {code: 'IL', name: 'Israel', prefix: '+972'},
                                        {code: 'RU', name: 'Russia', prefix: '+7'},
                                        {code: 'UA', name: 'Ukraine', prefix: '+380'},
                                        {code: 'PK', name: 'Pakistan', prefix: '+92'},
                                        {code: 'BD', name: 'Bangladesh', prefix: '+880'},
                                        {code: 'PH', name: 'Philippines', prefix: '+63'},
                                        {code: 'TH', name: 'Thailand', prefix: '+66'},
                                        {code: 'VN', name: 'Vietnam', prefix: '+84'},
                                        {code: 'ID', name: 'Indonesia', prefix: '+62'},
                                        {code: 'MY', name: 'Malaysia', prefix: '+60'},
                                        {code: 'SG', name: 'Singapore', prefix: '+65'},
                                        {code: 'HK', name: 'Hong Kong', prefix: '+852'},
                                        {code: 'TW', name: 'Taiwan', prefix: '+886'}
                                    ];
                                    
                                    function populateCountryDropdown() {
                                        const select = document.getElementById('country-code');
                                        if (!select) {
                                            return false;
                                        }
                                        
                                        if (select.getAttribute('data-initialized') === 'true') {
                                            return true;
                                        }
                                        
                                        const oldValue = select.getAttribute('data-old-value') || '';
                                        
                                        // Clear placeholder
                                        while (select.options.length > 1) {
                                            select.remove(1);
                                        }
                                        
                                        // Add countries with flags
                                        countryList.forEach(function(country) {
                                            const option = document.createElement('option');
                                            option.value = country.code;
                                            option.textContent = getCountryFlag(country.code) + ' ' + country.prefix;
                                            if (oldValue === country.code) {
                                                option.selected = true;
                                            }
                                            select.appendChild(option);
                                        });
                                        
                                        // Set default to US if no old value
                                        if (!oldValue) {
                                            const usOption = select.querySelector('option[value="US"]');
                                            if (usOption) {
                                                usOption.selected = true;
                                            }
                                        }
                                        
                                        select.setAttribute('data-initialized', 'true');
                                        console.log('Signup page country dropdown populated with', countryList.length, 'countries');
                                        return true;
                                    }
                                    
                                    // Try immediately
                                    if (document.readyState === 'loading') {
                                        document.addEventListener('DOMContentLoaded', populateCountryDropdown);
                                    } else {
                                        populateCountryDropdown();
                                    }
                                    
                                    // Also try after delays
                                    setTimeout(populateCountryDropdown, 100);
                                    setTimeout(populateCountryDropdown, 500);
                                })();
                                
                                // Convert country code to prefix before form submission
                                const signupForm = document.querySelector('form[action*="signup.store"]');
                                if (signupForm) {
                                    signupForm.addEventListener('submit', function(e) {
                                        const countryCodeSelect = document.getElementById('country-code');
                                        if (countryCodeSelect && countryCodeSelect.value) {
                                            // Find the country by code to get the prefix
                                            const countryCode = countryCodeSelect.value;
                                            const countryList = [
                                                {code: 'US', name: 'United States', prefix: '+1'},
                                                {code: 'GB', name: 'United Kingdom', prefix: '+44'},
                                                {code: 'CA', name: 'Canada', prefix: '+1'},
                                                {code: 'AU', name: 'Australia', prefix: '+61'},
                                                {code: 'DE', name: 'Germany', prefix: '+49'},
                                                {code: 'FR', name: 'France', prefix: '+33'},
                                                {code: 'IT', name: 'Italy', prefix: '+39'},
                                                {code: 'ES', name: 'Spain', prefix: '+34'},
                                                {code: 'NL', name: 'Netherlands', prefix: '+31'},
                                                {code: 'BE', name: 'Belgium', prefix: '+32'},
                                                {code: 'CH', name: 'Switzerland', prefix: '+41'},
                                                {code: 'AT', name: 'Austria', prefix: '+43'},
                                                {code: 'SE', name: 'Sweden', prefix: '+46'},
                                                {code: 'NO', name: 'Norway', prefix: '+47'},
                                                {code: 'DK', name: 'Denmark', prefix: '+45'},
                                                {code: 'FI', name: 'Finland', prefix: '+358'},
                                                {code: 'PL', name: 'Poland', prefix: '+48'},
                                                {code: 'PT', name: 'Portugal', prefix: '+351'},
                                                {code: 'GR', name: 'Greece', prefix: '+30'},
                                                {code: 'IE', name: 'Ireland', prefix: '+353'},
                                                {code: 'NZ', name: 'New Zealand', prefix: '+64'},
                                                {code: 'JP', name: 'Japan', prefix: '+81'},
                                                {code: 'KR', name: 'South Korea', prefix: '+82'},
                                                {code: 'CN', name: 'China', prefix: '+86'},
                                                {code: 'IN', name: 'India', prefix: '+91'},
                                                {code: 'BR', name: 'Brazil', prefix: '+55'},
                                                {code: 'MX', name: 'Mexico', prefix: '+52'},
                                                {code: 'AR', name: 'Argentina', prefix: '+54'},
                                                {code: 'ZA', name: 'South Africa', prefix: '+27'},
                                                {code: 'AE', name: 'UAE', prefix: '+971'},
                                                {code: 'SA', name: 'Saudi Arabia', prefix: '+966'},
                                                {code: 'EG', name: 'Egypt', prefix: '+20'},
                                                {code: 'NG', name: 'Nigeria', prefix: '+234'},
                                                {code: 'KE', name: 'Kenya', prefix: '+254'},
                                                {code: 'GH', name: 'Ghana', prefix: '+233'},
                                                {code: 'MA', name: 'Morocco', prefix: '+212'},
                                                {code: 'TN', name: 'Tunisia', prefix: '+216'},
                                                {code: 'DZ', name: 'Algeria', prefix: '+213'},
                                                {code: 'TR', name: 'Turkey', prefix: '+90'},
                                                {code: 'IL', name: 'Israel', prefix: '+972'},
                                                {code: 'RU', name: 'Russia', prefix: '+7'},
                                                {code: 'UA', name: 'Ukraine', prefix: '+380'},
                                                {code: 'PK', name: 'Pakistan', prefix: '+92'},
                                                {code: 'BD', name: 'Bangladesh', prefix: '+880'},
                                                {code: 'PH', name: 'Philippines', prefix: '+63'},
                                                {code: 'TH', name: 'Thailand', prefix: '+66'},
                                                {code: 'VN', name: 'Vietnam', prefix: '+84'},
                                                {code: 'ID', name: 'Indonesia', prefix: '+62'},
                                                {code: 'MY', name: 'Malaysia', prefix: '+60'},
                                                {code: 'SG', name: 'Singapore', prefix: '+65'},
                                                {code: 'HK', name: 'Hong Kong', prefix: '+852'},
                                                {code: 'TW', name: 'Taiwan', prefix: '+886'}
                                            ];
                                            
                                            const country = countryList.find(c => c.code === countryCode);
                                            if (country && country.prefix) {
                                                // Create a hidden input with the prefix value
                                                let hiddenInput = document.getElementById('country-code-prefix');
                                                if (!hiddenInput) {
                                                    hiddenInput = document.createElement('input');
                                                    hiddenInput.type = 'hidden';
                                                    hiddenInput.name = 'country_code';
                                                    hiddenInput.id = 'country-code-prefix';
                                                    signupForm.appendChild(hiddenInput);
                                                }
                                                hiddenInput.value = country.prefix;
                                                
                                                // Remove the original select from submission
                                                countryCodeSelect.disabled = true;
                                            }
                                        }
                                    });
                                }
                                </script>

                                <div class="form-group col-md-12 mb-4">
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('app.auth.password_min_chars') }}" required minlength="6">
                                        <span class="input-group-text password-toggle" onclick="togglePassword('password')">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('app.auth.confirm_password') }}" required minlength="6">
                                        <span class="input-group-text password-toggle" onclick="togglePassword('password_confirmation')">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="terms" name="terms" {{ old('terms') ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="terms">
                                            {{ __('app.auth.i_agree_to') }} <a class="policy-link" href="{{ url('/terms_condition') }}">{{ __('app.auth.terms') }}</a> {{ __('app.auth.and') }} <a class="policy-link" href="{{ url('/privacy_policy') }}">{{ __('app.auth.privacy_policy') }}</a>
                                        </label>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn-default"><span>{{ __('app.auth.create_account') }}</span></button>
                                    <div id="msgSubmit" class="h3 hidden"></div>
                                    <p class="mt-3 mb-0">{{ __('app.auth.already_have_account') }} <a href="{{ route('login') }}">{{ __('app.auth.login') }}</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Signup Form End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Signup Section End -->
@endsection

@section('scripts')
<script src="{{ asset('js/country-codes.js') }}"></script>
<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const toggleSpan = input.parentElement.querySelector('.password-toggle');
    const icon = toggleSpan ? toggleSpan.querySelector('i') : null;

    if (input.type === 'password') {
        input.type = 'text';
        if (icon) {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    } else {
        input.type = 'password';
        if (icon) {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
}
</script>
<script>
// client-side light validation feedback
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    
    // Initialize country code dropdown
    if (typeof getAllCountries !== 'undefined') {
        const countries = getAllCountries();
        const countrySelect = document.getElementById('country-code');
        
        if (countrySelect) {
            const oldCountryCode = countrySelect.dataset.oldValue || '';
            
            countries.forEach(country => {
                const option = document.createElement('option');
                option.value = country.code;
                option.textContent = `${country.prefix} - ${country.name}`;
                if (oldCountryCode === country.code) {
                    option.selected = true;
                }
                countrySelect.appendChild(option);
            });
            
            // Set default to US if no old value
            if (!oldCountryCode) {
                const usOption = countrySelect.querySelector('option[value="US"]');
                if (usOption) {
                    usOption.selected = true;
                    updatePhoneValidationForPage();
                }
            }
            
            // Update phone validation when country changes
            countrySelect.addEventListener('change', function() {
                updatePhoneValidationForPage();
            });
            
            // Initialize validation
            updatePhoneValidationForPage();
        }
    }
    
    function updatePhoneValidationForPage() {
        const countrySelect = document.getElementById('country-code');
        const phoneInput = document.getElementById('phone');
        
        if (!countrySelect || !phoneInput || typeof getPhoneValidationRules === 'undefined') {
            return;
        }
        
        const selectedCountryCode = countrySelect.value;
        if (!selectedCountryCode) {
            phoneInput.removeAttribute('minlength');
            phoneInput.removeAttribute('maxlength');
            return;
        }
        
        const rules = getPhoneValidationRules(selectedCountryCode);
        if (rules) {
            phoneInput.setAttribute('minlength', rules.min);
            phoneInput.setAttribute('maxlength', rules.max);
            phoneInput.placeholder = `Phone (${rules.min}-${rules.max} digits)`;
        }
    }
    
    form?.addEventListener('submit', function (e) {
        const password = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');
        if (password && confirm && password.value !== confirm.value) {
            e.preventDefault();
            alert('{{ __('app.auth.passwords_not_match') }}');
            confirm.focus();
            return;
        }
        
        // Validate country code and phone
        const countryCode = document.getElementById('country-code').value;
        const phoneInput = document.getElementById('phone');
        
        if (!countryCode) {
            e.preventDefault();
            alert('Please select a country code');
            document.getElementById('country-code').focus();
            return;
        }
        
        if (typeof getPhoneValidationRules !== 'undefined') {
            const rules = getPhoneValidationRules(countryCode);
            if (rules) {
                const phoneValue = phoneInput.value.replace(/\D/g, '');
                if (phoneValue.length < rules.min || phoneValue.length > rules.max) {
                    e.preventDefault();
                    alert(`Phone number must be ${rules.min}-${rules.max} digits`);
                    phoneInput.focus();
                    return;
                }
            }
        }
    });
});
</script>
@endsection


