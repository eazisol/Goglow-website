@extends('layouts.main')
{{-- Title --}}
@section('title', 'home')

{{-- Style Files --}}
@section('styles')
<style>
    .hero.hero-bg-image{
        padding: 100px 0 0 !important;
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
        background:rgba(0, 0, 0, 0.58);
        border-radius:12px;
        box-shadow:0 8px 24px rgba(0,0,0,.2);
        backdrop-filter: blur(3px)
    }
</style>
    <!-- Professional Application Wizard (header/footer hidden for this route) -->
    <div class="hero hero-bg-image bg-section dark-section parallaxie pro-wizard-hero" style="background-image: url('images/image (13).png');">
    <div class="container bw-wizard" style="max-width: 860px; margin: 40px auto;">
        <div class="beauty-form-center">
            <div class="wizard-card">
                    <div class="section-title section-title-center">
                        <h2>Become a Glowee</h2>
                    </div>
            <div class="wizard-progress" id="wizardProgress">Step 1 of 5</div>
            <div class="wizard-progressbar" id="wizardProgressbar" aria-hidden="true">
                <div class="wizard-progressbar-track">
                    <span class="wizard-dot" data-step="1"></span>
                    <span class="wizard-dot" data-step="2"></span>
                    <span class="wizard-dot" data-step="3"></span>
                    <span class="wizard-dot" data-step="4"></span>
                    <span class="wizard-dot" data-step="5"></span>
                </div>
            </div>
            <form id="appointmentForm" action="#" method="POST" data-toggle="validator">
                <!-- Step 1 – Work Type -->
                <section class="wizard-step active" data-step="1">
                    <h2 class="wizard-title">Do you work independently or in a team?</h2>
                    <div class="wizard-options">
                        <button type="button" class="wizard-option" data-worktype="Independent" data-next="2">👤 Independent</button>
                        <button type="button" class="wizard-option" data-worktype="Team" data-next="2">👥 Team</button>
                    </div>
                    <input type="hidden" name="work_type" id="work_type">
                </section>

                <!-- Step 2 – Basic Info -->
                <section class="wizard-step" data-step="2">
                    <h2 class="wizard-title">Basic Info</h2>
                    <div class="form-group mb-3">
                        {{-- <label for="brand_name">Name / Brand Name</label> --}}
                        <input type="text" name="brand_name" class="form-control" id="brand_name" placeholder="Name / Brand Name" required>
                    </div>
                    <div class="form-group mb-3">
                        {{-- <label for="whatsapp">WhatsApp Number</label> --}}
                        <input type="tel" name="whatsapp" class="form-control" id="whatsapp" placeholder="Enter with country code (e.g., +1 for US). Special characters are removed automatically" required style="margin-bottom: 5px;">
                        {{-- <small class="text-muted">Enter with country code (e.g., +1 for US). Special characters are removed automatically.</small> --}}
                    </div>
                    <div class="form-group mb-4">
                        {{-- <label for="email">Email Address</label> --}}
                        <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                    </div>
                    <div class="wizard-actions">
                        <button type="button" class="btn-default btn-outline" data-prev="1">Back</button>
                        <button type="button" class="btn-default" data-next="3">Next</button>
                    </div>
                </section>

                <!-- Step 3 – Social Media (kept required to preserve current JS) -->
                <section class="wizard-step" data-step="3">
                    <h2 class="wizard-title">Social Media</h2>
                    <div class="form-group mb-3">
                        {{-- <label for="instagram">Instagram Handle</label> --}}
                        <input type="text" name="instagram" class="form-control" id="instagram" placeholder="@Instagram Handle" required>
                    </div>
                    <div class="form-group mb-4">
                        {{-- <label for="tiktok">TikTok Handle</label> --}}
                        <input type="text" name="tiktok" class="form-control" id="tiktok" placeholder="@TikTok Handle" required>
                    </div>
                    <div class="wizard-actions">
                        <button type="button" class="btn-default btn-outline" data-prev="2">Back</button>
                        <button type="button" class="btn-default" data-next="4">Next</button>
                    </div>
                </section>

                <!-- Step 4 – Current Platform -->
                <section class="wizard-step" data-step="4">
                    <h2 class="wizard-title">Which platform are you using now?</h2>
                    <div class="wizard-radio">
                        <label><input type="radio" name="platform_choice" value="Planity"> Planity</label>
                        <label><input type="radio" name="platform_choice" value="The treatwell stop"> The treatwell stop</label>
                        <label><input type="radio" name="platform_choice" value="Fresha"> Fresha</label>
                        <label class="mt-2">
                            <input type="radio" name="platform_choice" value="Other"> Other
                        </label>
                        <input type="text" class="form-control mt-2" id="platform_other_input" placeholder="Please specify" style="display:none;">
                    </div>
                    <input type="hidden" name="current_platform" id="current_platform" required>
                    <div class="wizard-actions">
                        <button type="button" class="btn-default btn-outline" data-prev="3">Back</button>
                        <button type="button" class="btn-default" data-next="5">Next</button>
                    </div>
                </section>

                <!-- Step 5 – Review & Submit -->
                <section class="wizard-step" data-step="5">
                    <h2 class="wizard-title">Review & Submit</h2>
                    <div id="review_summary" class="wizard-summary"></div>
                    <div class="form-group mt-3">
                        <div class="form-check">
                            <input type="checkbox" name="terms" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">I agree to the <a href="{{ url('/terms_condition') }}" target="_blank">Terms & Conditions</a></label>
                        </div>
                    </div>
                    <div class="wizard-actions">
                        <button type="button" class="btn-default btn-outline" data-prev="4">Back</button>
                        <button type="submit" class="btn-default"><span>Submit Application</span></button>
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
            // For step 4, persist platform choice
            const next = btn.getAttribute('data-next');
            if(next==='5'){
                buildReview();
            }
            setStep(next);
        });
    });

    // Platform choice wiring
    const platformOtherInput = document.getElementById('platform_other_input');
    document.querySelectorAll('input[name="platform_choice"]').forEach(r=>{
        r.addEventListener('change', ()=>{
            const chosen = r.value;
            if(chosen==='Other'){
                platformOtherInput.style.display='block';
                document.getElementById('current_platform').value = platformOtherInput.value || 'Other';
            } else {
                platformOtherInput.style.display='none';
                document.getElementById('current_platform').value = chosen;
            }
        });
    });
    platformOtherInput && platformOtherInput.addEventListener('input', ()=>{
        const val = platformOtherInput.value.trim();
        document.getElementById('current_platform').value = val || 'Other';
    });

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
        let html = '<dl class="review-grid">';
        Object.keys(data).forEach(k=>{
            const label = k.replace(/_/g,' ');
            const value = data[k] || '-';
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
            submitBtn.innerHTML = '<span><i class="fa fa-spinner fa-spin"></i> Submitting...</span>';
        } else {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<span>Submit Application</span>';
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

        // Simple validation: if any field is empty or terms not checked, do not submit or show alert
        if (!name || !email || !whatsapp || !instagram || !tiktok || !platform || !termsAccepted) {
            showLoading(false);
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please fill in all required fields'
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
                        title: 'Success!',
                        text: 'Your application has been submitted successfully!'
                    });
                } else {
                    // If not a success message, show the response text
                    Swal.fire({
                        icon: 'success',
                        title: 'Response Received',
                        text: responseText
                    });
                }
            } else {
                // Handle error response
                try {
                    // Try to parse as JSON first
                    const errorText = await response.text();
                    console.log('Error response (text):', errorText);
                    
                    let errorMessage = 'An error occurred while submitting your application';
                    
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
                        title: 'Submission Failed',
                        text: errorMessage
                    });
                } catch (parseError) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Submission Failed',
                        text: 'Could not process server response'
                    });
                }
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Network error: ' + (error.message || 'Could not connect to server')
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
