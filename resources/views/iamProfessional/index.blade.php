@extends('layouts.main2')
{{-- Title --}}
@section('title', 'home')

{{-- Style Files --}}
@section('styles')
<style>
    .hero.hero-bg-image{
        padding: 35px 0 0 !important;
    }
    
    /* Add spacing between form and footer */
    .pro-wizard-hero {
        padding-bottom: 40px !important;
        margin-bottom: 20px !important;
        min-height: auto !important;
    }
    
    /* Custom CSS to replace Bootstrap classes */
    /* Container */
    .bw-wizard.container {
        max-width: 860px;
        margin: 40px auto 40px auto !important;
        padding-left: 15px;
        padding-right: 15px;
        box-sizing: border-box;
    }
    
    /* Ensure hero section doesn't stick to footer */
    .pro-wizard-hero::after {
        content: '';
        display: block;
        height: 40px;
        width: 100%;
    }
    
    /* Form Group - replaces .form-group */
    .bw-wizard .form-group {
        margin-bottom: 1rem;
        display: block;
    }
    /* Two-column layout for form fields */
    .bw-wizard .form-row-two {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    
    /* Remove bottom margin from form-group inside form-row-two */
    .bw-wizard .form-row-two .form-group {
        margin-bottom: 0;
    }
    
    /* Responsive: stack on smaller screens */
    @media (max-width: 768px) {
        .bw-wizard .form-row-two {
            grid-template-columns: 1fr;
            gap: 0rem;
        }
    }
    
    /* Margin utilities - replaces Bootstrap mb-3, mb-4, mt-2, mt-3 */
    .bw-wizard .mb-3 {
        margin-bottom: 1rem !important;
    }
    .bw-wizard .mb-4 {
        margin-bottom: 1.5rem !important;
    }
    .bw-wizard .mt-2 {
        /* margin-top: 0.5rem !important; */
    }
    .bw-wizard .mt-3 {
        margin-top: 1rem !important;
    }
    
    /* Form Control - replaces .form-control */
    .bw-wizard .form-control {
        display: block;
        width: 100%;
        padding: 14px 16px;
        font-size: 16px;
        line-height: 1.5;
        color: #212529;
        background-color: #fff4f8;
        border-radius: 2px;
        box-sizing: border-box;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        font-family: 'Satoshi', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    
    .bw-wizard .form-control:focus {
        outline: 0;
        border-color: #111;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.12);
    }
    
    /* Placeholder font to match theme */
    .bw-wizard .form-control::placeholder {
        color: #6c757d;
        opacity: 1;
        font-family: 'Satoshi', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    
    /* Browser-specific placeholder styles */
    .bw-wizard .form-control::-webkit-input-placeholder {
        font-family: 'Satoshi', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    .bw-wizard .form-control::-moz-placeholder {
        font-family: 'Satoshi', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    .bw-wizard .form-control:-ms-input-placeholder {
        font-family: 'Satoshi', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    .bw-wizard .form-control::-ms-input-placeholder {
        font-family: 'Satoshi', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    
    /* Form Check - replaces .form-check */
    .bw-wizard .form-check {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0;
    }
    
    /* Form Check Input - replaces .form-check-input */
    .bw-wizard .form-check-input {
        width: 18px;
        height: 18px;
        margin: 0;
        vertical-align: middle;
        appearance: none;
        background-color: #fff;
        border: 1px solid #d6d6d6;
        border-radius: 4px;
        cursor: pointer;
        position: relative;
        flex-shrink: 0;
    }
    
    .bw-wizard .form-check-input:checked {
        background-color: #111;
        border-color: #111;
    }
    
    .bw-wizard .form-check-input:checked::after {
        content: '';
        position: absolute;
        top: 2px;
        left: 5px;
        width: 4px;
        height: 8px;
        border: solid #fff;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }
    
    /* Form Check Label - replaces .form-check-label */
    .bw-wizard .form-check-label {
        margin: 0;
        line-height: 1.2;
        cursor: pointer;
        color: rgba(118, 33, 62, 1);
    }
    
    /* Wizard Checkbox container - similar to wizard-radio */
    .bw-wizard .wizard-checkbox {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    
    .bw-wizard .wizard-checkbox label {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        color: rgba(118, 33, 62, 1);
        font-weight: 500;
        cursor: pointer;
        gap: 8px;
    }
    
    .bw-wizard .wizard-checkbox input[type="checkbox"] {
        margin: 0;
        width: 18px;
        height: 18px;
        cursor: pointer;
        flex-shrink: 0;
    }
    
    /* Button Default - already exists but ensure it works */
    .bw-wizard .btn-default {
        display: inline-block;
        padding: 7px 25px;
        font-size: 16px;
        font-weight: 600;
        line-height: 1.5;
        text-align: center;
        text-decoration: none;
        vertical-align: middle;
        cursor: pointer;
        user-select: none;
        border: none;
        border-radius: 999px;
        background: #fff;
        color: #e50050;
        transition: all 0.2s ease;
    }
    
    .bw-wizard .btn-default:hover {
        background: #ce0048;
        color: #fff;
        border-color: #111;
    }
    
    .bw-wizard .btn-default:active {
        transform: scale(0.98);
    }
    
    .bw-wizard .btn-default:disabled {
        opacity: 0.65;
        cursor: not-allowed;
    }
    
    /* Button Outline - replaces .btn-outline */
    .bw-wizard .btn-default.btn-outline {
        background: #fff;
        color: #e50050;
        border: none;
    }
    
    .bw-wizard .btn-default.btn-outline:hover {
        background: #ce0048;
        color: #fff;
        border-color: #111;
    }
    
    /* Submit button specific styling */
    .bw-wizard .wizard-actions button[type="submit"].btn-default {
        background: #fff;
        /* color: #000000; */
        border: none;
    }
    
    .bw-wizard .wizard-actions button[type="submit"].btn-default:hover {
        background: #111;
        color: #fff;
        border-color: #111;
    }
    
    /* Hidden utility */
    .bw-wizard .hidden {
        display: none !important;
    }
    
    /* Wizard Options - Matching Image Design */
    .bw-wizard .wizard-options {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        justify-content: center;
        margin: 24px 0;
    }
    
    .bw-wizard .wizard-option {
        flex: 1 1 240px;
        min-width: 200px;
        background: #fff4f8;
        border: none;
        border-radius: 4px;
        padding: 8px 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.3s ease;
        text-align: left;
    }
    
    .bw-wizard .wizard-option:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }
    
    .bw-wizard .wizard-option:active {
        transform: translateY(0);
    }
    
    /* Icon container - circular outline */
    .bw-wizard .wizard-option-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 50%;
        border: 2px solid #f3d9e2; /* Light reddish-pink outline */
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .bw-wizard .wizard-option-icon svg {
        width: 24px;
        height: 24px;
    }
    
    /* Text styling */
    .bw-wizard .wizard-option-text {
        font-size: 15px;
        font-weight: 500;
        color: #75213e; /* Dark reddish-pink */
        flex: 1;
    }
    
    /* Active/Selected state */
    .bw-wizard .wizard-option.selected {
        border: 2px solid #e50050;
        box-shadow: 0 4px 12px rgba(229, 0, 80, 0.2);
    }
    
    .bw-wizard .wizard-option.selected .wizard-option-icon {
        border-color: #e50050;
        background: #fff5f8;
    }
    
    /* Progress Bar UI - Matching Image Design */
    .bw-wizard .wizard-progressbar {
        margin-bottom: 20px;
        position: relative;
        padding: 5px 0; /* Add padding to accommodate dots */
        width: 85%;
        margin-left: auto;
        margin-right: auto;
    }
    
    .bw-wizard .wizard-progressbar-track {
        position: relative;
        height: 2px;
        background: #d3d3d3; /* Light grey line */
        border-radius: 999px;
        width: 100%;
        margin: 0;
        --progress: 0%; /* CSS variable for progress fill */
    }
    
    /* Fill effect - pink/red line up to current step */
    .bw-wizard .wizard-progressbar-track::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        height: 2px;
        background: #e50050; /* Same pink/red color as active dots */
        border-radius: 999px;
        width: var(--progress);
        transition: width 0.35s ease;
        z-index: 1;
    }
    
    /* Make dots visible and style them - centered on the line */
    .bw-wizard .wizard-dot {
        display: block !important;
        position: absolute;
        top: 50%;
        left: 0;
        transform: translate(-50%, -50%);
        width: 12px;
        height: 12px;
        background: #d3d3d3; /* Light grey for inactive dots */
        border: none;
        border-radius: 50%;
        transition: all 0.3s ease;
        z-index: 3;
        margin: 0;
        padding: 0;
    }
    
    /* Active dot - vibrant pink/red */
    .bw-wizard .wizard-dot.active {
        background: #e50050; /* Vibrant pink/red */
        border: none;
        width: 12px;
        height: 12px;
    }
    
    /* Completed dots - also pink/red */
    .bw-wizard .wizard-dot.completed {
        background: #e50050; /* Pink/red for completed steps */
        border: none;
    }
    
    /* Position dots evenly along the line - centered on the line */
    .bw-wizard .wizard-dot[data-step="1"] {
        left: 0%;
        transform: translate(-50%, -50%);
    }
    .bw-wizard .wizard-dot[data-step="2"] {
        left: 25%;
        transform: translate(-50%, -50%);
    }
    .bw-wizard .wizard-dot[data-step="3"] {
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .bw-wizard .wizard-dot[data-step="4"] {
        left: 75%;
        transform: translate(-50%, -50%);
    }
    .bw-wizard .wizard-dot[data-step="5"] {
        left: 100%;
        transform: translate(-50%, -50%);
    }
</style>

@endsection


{{-- Content --}}
@section('content')
<style>
    label{
        margin-bottom: 10px;
    }
    li{
        margin-bottom: 6px;
    }
    .section-title{
        text-align: center;
    }
    .beauty-form-center{
        background: rgba(255, 244, 248, 0.9);
        border-radius:12px;
        box-shadow:0 8px 24px rgba(0,0,0,.2);
        backdrop-filter: blur(10px)
    }
</style>
    <!-- Professional Application Wizard (header/footer hidden for this route) -->
    <div class="hero hero-bg-image bg-section dark-section parallaxie pro-wizard-hero" style="background-image: url('images/images/9d496329fa0876e9cdbdb7fd5a40a93b3058a588.jpg');">
    <div class="container">
        @include('figmaDesign.header')
    </div>
    <div class="container bw-wizard" style="max-width: 860px; margin: 40px auto 40px auto;">
        <div class="beauty-form-center">
            <div class="wizard-card">
                    <div class="become-glower-step1-heading">
                        <h2 class="heading">{!! __('app.iam_professional.page_title') !!}</h2>
                    </div>
            {{-- <div class="wizard-progress" id="wizardProgress">Step 1 of 5</div> --}}
            <div class="wizard-progressbar" id="wizardProgressbar" aria-hidden="true">
                <div class="wizard-progressbar-track">
                    <span class="wizard-dot" data-step="1"></span>
                    <span class="wizard-dot" data-step="2"></span>
                    <span class="wizard-dot" data-step="3"></span>
                    <span class="wizard-dot" data-step="4"></span>
                    <span class="wizard-dot" data-step="5"></span>
                </div>
            </div>
            <form id="appointmentForm" action="#" method="POST">
                <!-- Step 1 – Work Type -->
                <section class="wizard-step active" data-step="1">
                    <h2 class="wizard-title">{{ __('app.iam_professional.step1_title') }}</h2>
                    <div class="wizard-options">
                        <button type="button" class="wizard-option" data-worktype="Independent" data-next="2">
                            <span class="wizard-option-icon">
                                <img src="images/images/flowbite_user-solid.svg" alt="" width="25" height="25">
                            </span>
                            <span class="wizard-option-text">{{ __('app.iam_professional.work_type_independent') }}</span>
                        </button>
                        <button type="button" class="wizard-option" data-worktype="Team" data-next="2">
                            <span class="wizard-option-icon">
                                <img src="images/images/fluent_people-team-16-filled.svg" alt="" width="25" height="25">
                            </span>
                            <span class="wizard-option-text">{{ __('app.iam_professional.work_type_team') }}</span>
                        </button>
                    </div>
                    <input type="hidden" name="work_type" id="work_type">
                </section>

                <!-- Step 2 – Basic Info -->
                <section class="wizard-step" data-step="2">
                    <h2 class="wizard-title">{{ __('app.iam_professional.step2_title') }}</h2>
                    <div class="form-row-two">
                        <div class="form-group mb-3">
                            {{-- <label for="brand_name">Name / Brand Name</label> --}}
                            <input type="text" name="brand_name" class="form-control" id="brand_name" placeholder="{{ __('app.iam_professional.placeholder_name_brand') }}" required>
                        </div>
                        <div class="form-group mb-3">
                            {{-- <label for="whatsapp">WhatsApp Number</label> --}}
                            <input type="tel" name="whatsapp" class="form-control" id="whatsapp" placeholder="{{ __('app.iam_professional.placeholder_phone') }}" required>
                        </div>
                    </div>
                    <div class="form-row-two">
                        <div class="form-group mb-4">
                            {{-- <label for="email">Email Address</label> --}}
                            <input type="email" name="email" class="form-control" id="email" placeholder="{{ __('app.iam_professional.placeholder_email') }}" required>
                        </div>
                    </div>
                    <div class="wizard-actions">
                        <button type="button" class="btn-default btn-outline" data-prev="1">{{ __('app.common.back') }}</button>
                        <button type="button" class="btn-default" data-next="3">{{ __('app.common.next') }}</button>
                    </div>
                </section>

                <!-- Step 3 – Social Media (optional fields) -->
                <section class="wizard-step" data-step="3">
                    <h2 class="wizard-title">{{ __('app.iam_professional.step3_title') }}</h2>
                    <div class="form-row-two">
                        <div class="form-group mb-3">
                            {{-- <label for="instagram">Instagram Handle</label> --}}
                            <input type="text" name="instagram" class="form-control" id="instagram" placeholder="{{ __('app.iam_professional.placeholder_instagram') }}">
                        </div>
                        <div class="form-group mb-4">
                            {{-- <label for="tiktok">TikTok Handle</label> --}}
                            <input type="text" name="tiktok" class="form-control" id="tiktok" placeholder="{{ __('app.iam_professional.placeholder_tiktok') }}">
                        </div>
                    </div>
                    <div class="wizard-actions">
                        <button type="button" class="btn-default btn-outline" data-prev="2">{{ __('app.common.back') }}</button>
                        <button type="button" class="btn-default" data-next="4">{{ __('app.common.next') }}</button>
                    </div>
                </section>

                <!-- Step 4 – Current Platform -->
                <section class="wizard-step" data-step="4">
                    <h2 class="wizard-title">{{ __('app.iam_professional.step4_title') }}</h2>
                    <div class="wizard-checkbox">
                        <label><input type="checkbox" name="platform_choice" value="Planity"> {{ __('app.iam_professional.platform_planity') }}</label>
                        <label><input type="checkbox" name="platform_choice" value="The treatwell stop"> {{ __('app.iam_professional.platform_treatwell') }}</label>
                        <label><input type="checkbox" name="platform_choice" value="Fresha"> {{ __('app.iam_professional.platform_fresha') }}</label>
                        <label class="mt-2">
                            <input type="checkbox" name="platform_choice" value="Other" id="platform_other_checkbox"> {{ __('app.iam_professional.platform_other') }}
                        </label>
                        <input type="text" class="form-control mt-2" id="platform_other_input" placeholder="{{ __('app.iam_professional.placeholder_platform_other') }}" style="display:none;">
                    </div>
                    <input type="hidden" name="current_platform" id="current_platform" required>
                    <div class="wizard-actions">
                        <button type="button" class="btn-default btn-outline" data-prev="3">{{ __('app.common.back') }}</button>
                        <button type="button" class="btn-default" data-next="5">{{ __('app.common.next') }}</button>
                    </div>
                </section>

                <!-- Step 5 – Review & Submit -->
                <section class="wizard-step" data-step="5">
                    <h2 class="wizard-title">{{ __('app.iam_professional.step5_title') }}</h2>
                    <div id="review_summary" class="wizard-summary"></div>
                    <div class="form-group mt-3">
                        <div class="form-check">
                            <input type="checkbox" name="terms" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">{{ __('app.iam_professional.terms_agree') }} <a href="{{ url('/terms_condition') }}" target="_blank">{{ __('app.iam_professional.terms_conditions') }}</a></label>
                        </div>
                    </div>
                    <div class="wizard-actions">
                        <button type="button" class="btn-default btn-outline" data-prev="4">{{ __('app.common.back') }}</button>
                        <button type="submit" class="btn-default"><span>{{ __('app.iam_professional.button_submit') }}</span></button>
                    </div>
                    <div id="msgSubmit" class="h3 hidden"></div>
                </section>
            </form>
        </div>
        </div> 
    </div>
    </div>
@endsection


{{-- Scripts --}}
@section('scripts')
<script>
// Pass translations to JavaScript
const translations = {
    validation_missing_info_title: @json(__('app.iam_professional.validation_missing_info_title')),
    validation_missing_info_text: @json(__('app.iam_professional.validation_missing_info_text')),
    validation_platform_required_title: @json(__('app.iam_professional.validation_platform_required_title')),
    validation_platform_required_text: @json(__('app.iam_professional.validation_platform_required_text')),
    validation_platform_details_title: @json(__('app.iam_professional.validation_platform_details_title')),
    validation_platform_details_text: @json(__('app.iam_professional.validation_platform_details_text')),
    validation_error_title: @json(__('app.iam_professional.validation_error_title')),
    validation_error_text: @json(__('app.iam_professional.validation_error_text')),
    success_title: @json(__('app.iam_professional.success_title')),
    success_text: @json(__('app.iam_professional.success_text')),
    response_received_title: @json(__('app.iam_professional.response_received_title')),
    submission_failed_title: @json(__('app.iam_professional.submission_failed_title')),
    submission_failed_text: @json(__('app.iam_professional.submission_failed_text')),
    submission_failed_response: @json(__('app.iam_professional.submission_failed_response')),
    error_title: @json(__('app.iam_professional.error_title')),
    error_network: @json(__('app.iam_professional.error_network')),
    error_network_connection: @json(__('app.iam_professional.error_network_connection')),
    loading_submitting: @json(__('app.iam_professional.loading_submitting')),
    button_submit_application: @json(__('app.iam_professional.button_submit_application')),
    review_work_type: @json(__('app.iam_professional.review_work_type')),
    review_brand_name: @json(__('app.iam_professional.review_brand_name')),
    review_whatsapp: @json(__('app.iam_professional.review_whatsapp')),
    review_email: @json(__('app.iam_professional.review_email')),
    review_instagram: @json(__('app.iam_professional.review_instagram')),
    review_tiktok: @json(__('app.iam_professional.review_tiktok')),
    review_current_platform: @json(__('app.iam_professional.review_current_platform'))
};

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('appointmentForm');
    const steps = Array.from(document.querySelectorAll('.wizard-step'));
    const progress = document.getElementById('wizardProgress');

    function setStep(step){
        steps.forEach(s=>s.classList.toggle('active', s.getAttribute('data-step')===String(step)));
        if(progress){ progress.textContent = `Step ${step} of 5`; }

        // update progress bar
        const dots = Array.from(document.querySelectorAll('.wizard-dot'));
        dots.forEach(dot=>{
            const dStep = parseInt(dot.getAttribute('data-step'));
            dot.classList.toggle('active', dStep===parseInt(step));
            dot.classList.toggle('completed', dStep<parseInt(step));
        });
        const track = document.querySelector('.wizard-progressbar-track');
        if(track){
            const fill = track.querySelector(':scope::before');
        }
        // set width of fill via inline style on ::before is not possible; use data attribute
        const trackEl = document.querySelector('.wizard-progressbar-track');
        if(trackEl){ trackEl.style.setProperty('--progress', ((parseInt(step)-1)/4*100)+'%'); }
    }

    // Work type option handlers
    document.querySelectorAll('.wizard-option[data-worktype]').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            const value = btn.getAttribute('data-worktype');
            const next = btn.getAttribute('data-next');
            const hidden = document.getElementById('work_type');
            if(hidden){ hidden.value = value; }
            setStep(next);
        });
    });

    // Prev/Next buttons
    document.querySelectorAll('[data-prev]').forEach(btn=>{
        btn.addEventListener('click', ()=> setStep(btn.getAttribute('data-prev')));
    });
    document.querySelectorAll('[data-next]').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            const next = btn.getAttribute('data-next');
            const currentStep = btn.closest('.wizard-step').getAttribute('data-step');
            
            // Validate current step before proceeding
            if (!validateStep(currentStep)) {
                return; // Stop if validation fails
            }
            
            // For step 4, persist platform choice
            if(next==='5'){
                buildReview();
            }
            setStep(next);
        });
    });

    // Platform choice wiring - handle checkboxes
    const platformOtherInput = document.getElementById('platform_other_input');
    const platformOtherCheckbox = document.getElementById('platform_other_checkbox');
    
    // Function to update current_platform hidden field with all selected platforms
    function updatePlatformValue() {
        const selected = Array.from(document.querySelectorAll('input[name="platform_choice"]:checked'))
            .map(cb => cb.value === 'Other' && platformOtherInput.value.trim() 
                ? platformOtherInput.value.trim() 
                : cb.value);
        document.getElementById('current_platform').value = selected.join(', ') || '';
    }
    
    // Handle checkbox changes
    document.querySelectorAll('input[name="platform_choice"]').forEach(cb=>{
        cb.addEventListener('change', ()=>{
            if(cb.value === 'Other' && cb.checked){
                platformOtherInput.style.display='block';
            } else if(cb.value === 'Other' && !cb.checked){
                platformOtherInput.style.display='none';
                platformOtherInput.value = '';
            }
            updatePlatformValue();
        });
    });
    
    // Handle "Other" text input
    platformOtherInput && platformOtherInput.addEventListener('input', ()=>{
        updatePlatformValue();
    });

    // Step validation function
    function validateStep(step) {
        switch(step) {
            case '2':
                // Step 2: Basic Info - require brand_name, email, whatsapp
                const name = form.brand_name.value.trim();
                const email = form.email.value.trim();
                const whatsapp = form.whatsapp.value.trim();
                
                if (!name || !email || !whatsapp) {
                    Swal.fire({
                        icon: 'warning',
                        title: translations.validation_missing_info_title,
                        text: translations.validation_missing_info_text
                    });
                    return false;
                }
                return true;
                
            case '4':
                // Step 4: Platform choice - require at least one platform selection
                const selectedPlatforms = Array.from(document.querySelectorAll('input[name="platform_choice"]:checked'));
                const platformOtherInput = document.getElementById('platform_other_input');
                const platformOtherCheckbox = document.getElementById('platform_other_checkbox');
                
                if (selectedPlatforms.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: translations.validation_platform_required_title,
                        text: translations.validation_platform_required_text
                    });
                    return false;
                }
                
                // If "Other" is selected, require text input
                if (platformOtherCheckbox && platformOtherCheckbox.checked && (!platformOtherInput || !platformOtherInput.value.trim())) {
                    Swal.fire({
                        icon: 'warning',
                        title: translations.validation_platform_details_title,
                        text: translations.validation_platform_details_text
                    });
                    return false;
                }
                
                return true;
                
            default:
                return true; // No validation for other steps
        }
    }

    function buildReview(){
        const summary = document.getElementById('review_summary');
        const data = {
            work_type: document.getElementById('work_type')?.value || '',
            brand_name: form.brand_name.value,
            whatsapp: form.whatsapp.value,
            email: form.email.value,
            instagram: form.instagram.value,
            tiktok: form.tiktok.value,
            current_platform: document.getElementById('current_platform').value
        };
        const labelMap = {
            work_type: translations.review_work_type,
            brand_name: translations.review_brand_name,
            whatsapp: translations.review_whatsapp,
            email: translations.review_email,
            instagram: translations.review_instagram,
            tiktok: translations.review_tiktok,
            current_platform: translations.review_current_platform
        };
        const valueMap = {
            'Independent': @json(__('app.iam_professional.work_type_independent')),
            'Team': @json(__('app.iam_professional.work_type_team'))
        };
        let html = '<dl class="review-grid">';
        Object.keys(data).forEach(k=>{
            const label = labelMap[k] || k.replace(/_/g,' ');
            let value = data[k] || '-';
            if (k === 'work_type' && valueMap[value]) {
                value = valueMap[value];
            }
            html += `<dt>${label}</dt><dd>${value}</dd>`;
        });
        html += '</dl>';
        if(summary){ summary.innerHTML = html; }
    }

    
    // Function to format phone number - remove all non-numeric characters except the + at the beginning
    function formatPhoneNumber(phoneNumber) {
        // Keep the + sign if it exists at the beginning, then remove all non-numeric characters
        if (phoneNumber.startsWith('+')) {
            return '+' + phoneNumber.substring(1).replace(/[^0-9]/g, '');
        }
        // If no + sign, just remove all non-numeric characters
        return phoneNumber.replace(/[^0-9]/g, '');
    }
    
    // Add a loading indicator
    function showLoading(isLoading) {
        const submitBtn = form.querySelector('button[type="submit"]');
        if (isLoading) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span><i class="fa fa-spinner fa-spin"></i> ' + translations.loading_submitting + '</span>';
        } else {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<span>' + translations.button_submit_application + '</span>';
        }
    }
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Show loading state
        showLoading(true);

        // Gather form data
        const name = form.brand_name.value.trim();
        const email = form.email.value.trim();
        let whatsapp = form.whatsapp.value.trim();
        const instagram = form.instagram.value.trim();
        const tiktok = form.tiktok.value.trim();
        const platform = form.current_platform.value.trim();
        const termsAccepted = form.terms.checked;

        // Format the phone number to remove parentheses, spaces, and other non-numeric characters
        whatsapp = formatPhoneNumber(whatsapp);
        
        console.log('Formatted WhatsApp number:', whatsapp);

        // Simple validation: if any required field is empty or terms not checked, do not submit or show alert
        if (!name || !email || !whatsapp || !platform || !termsAccepted) {
            showLoading(false);
            Swal.fire({
                icon: 'error',
                title: translations.validation_error_title,
                text: translations.validation_error_text
            });
            return;
        }

        const payload = {
            name,
            email,
            whatsapp,
            instagram,
            tiktok,
            platform,
            termsAccepted,
            type: 'professionalQuery'
        };

        try {
            console.log('Submitting payload:', payload);
            
            const response = await fetch('https://us-central1-beauty-984c8.cloudfunctions.net/submitQuery', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            });
            
            // Check if the response is OK first
            if (response.ok) {
                // Try to get the response as text first
                const responseText = await response.text();
                console.log('API Response (text):', responseText);
                
                // Check if the response contains "successfully"
                if (responseText.includes("successfully")) {
                    form.reset();
                    Swal.fire({
                        icon: 'success',
                        title: translations.success_title,
                        text: translations.success_text
                    }).then(() => { window.location.href = '/'; });
                } else {
                    // If not a success message, show the response text
                    Swal.fire({
                        icon: 'success',
                        title: translations.response_received_title,
                        text: responseText
                    }).then(() => { window.location.href = '/'; });
                }
            } else {
                // Handle error response
                try {
                    // Try to parse as JSON first
                    const errorText = await response.text();
                    console.log('Error response (text):', errorText);
                    
                    let errorMessage = translations.submission_failed_text;
                    
                    // Try to parse as JSON if possible
                    try {
                        const errorData = JSON.parse(errorText);
                        errorMessage = errorData.message || errorMessage;
                    } catch (jsonError) {
                        // If not valid JSON, use the text as is
                        errorMessage = errorText;
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: translations.submission_failed_title,
                        text: errorMessage
                    });
                } catch (parseError) {
                    Swal.fire({
                        icon: 'error',
                        title: translations.submission_failed_title,
                        text: translations.submission_failed_response
                    });
                }
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            Swal.fire({
                icon: 'error',
                title: translations.error_title,
                text: translations.error_network + (error.message || translations.error_network_connection)
            });
        } finally {
            // Reset loading state
            showLoading(false);
        }
    });
    // Initialize step
    setStep(1);
});
</script>
@endsection
