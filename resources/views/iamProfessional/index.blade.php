@extends('layouts.main')
{{-- Title --}}
@section('title', 'home')

{{-- Style Files --}}
@section('styles')

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
                    <!-- Appointment image Start -->
                    <div class="appointment-image">
                        <figure class="image-anime reveal">
                            <img src="images/john-arano-CCTCHXEsan8-unsplash.jpg" alt="">
                        </figure>
                        
                        <!-- Appointment Info List Start -->
                        {{-- <div class="appointment-timing-box">
                            <h3>Opening Hours:</h3>
                            <ul>
                                <li>Mon - Fri ( 09:00 - 21:00 )</li>
                                <li>Saturday ( 09:00 - 14:00 )</li>
                                <li>Sunday ( Closed )</li>
                            </ul>
                        </div> --}}
                        <!-- Appointment Info List End -->
                    </div>
                    <!-- Appointment image End -->
                </div>

                <div class="col-lg-6">
                    <!-- Book Appointment Form Start -->
                    <div class="appointment-form wow fadeInUp" data-wow-delay="0.2s">
                        <form id="appointmentForm" action="#" method="POST" data-toggle="validator">
                            <div class="row">                                
                                <div class="form-group col-md-12 mb-4">
                                    <input type="text" name="brand_name" class="form-control" id="brand_name" placeholder="Name / Brand Name" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-12 mb-4">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <input type="tel" name="whatsapp" class="form-control" id="whatsapp" placeholder="WhatsApp Number with country code (e.g. +1234567890)" required>
                                    <small class="text-muted">Enter with country code (e.g., +1 for US). Special characters will be removed automatically.</small>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="instagram" class="form-control" id="instagram" placeholder="Instagram Handle" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="tiktok" class="form-control" id="tiktok" placeholder="TikTok Handle" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <input type="text" name="current_platform" class="form-control" id="current_platform" placeholder="What platform are you using now?" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="terms" class="form-check-input" id="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="{{ url('/terms_condition') }}" target="_blank">Terms & Conditions</a>
                                        </label>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn-default"><span>Submit Application</span></button>
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
@endsection


{{-- Scripts --}}
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('appointmentForm');
    
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
});
</script>
@endsection
