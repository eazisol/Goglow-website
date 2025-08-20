@extends('layouts.main')
{{-- Title --}}
@section('title', 'Payment Successful')

{{-- Content --}}
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Payment success page loaded');
    console.log('Transaction ID:', '{{ $transactionId }}');
    
    // Retrieve stored booking data
    const formData = JSON.parse(localStorage.getItem('bookingFormData') || '{}');
    const bookingPayload = JSON.parse(localStorage.getItem('bookingPayload') || '{}');
    
    console.log('Retrieved form data:', formData);
    console.log('Retrieved booking payload:', bookingPayload);

    bookingPayload.agent_id = formData.agentId;
    bookingPayload.agent_name = formData.agentName;
    
    // Update the booking payload with payment information
    bookingPayload.payment_id = '{{ $transactionId }}';
    bookingPayload.payment_type = '{{ $paymentType }}';
    bookingPayload.payment_status = 'completed';
    if (bookingPayload.payment_type === 'full') {
        bookingPayload.payed = true;
    } else {
        bookingPayload.payed = false;
    }
        console.log('After conditions booking payload:', bookingPayload);
    // Submit the booking to the API
    submitBooking(bookingPayload);
    
    // Function to submit the booking
    async function submitBooking(payload) {
        try {
            document.getElementById('apiResponseStatus').innerHTML = 
                '<span class="text-warning">Sending booking to server...</span>';
            
            console.log('Submitting booking with payment info:', payload);
            
            const response = await fetch('https://us-central1-beauty-984c8.cloudfunctions.net/bookService', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload)
            });
            
            const responseData = await response.json();
            console.log('API response:', responseData);
            
            if (response.ok) {
                document.getElementById('apiResponseStatus').innerHTML = 
                    '<strong class="text-success">✓ Booking confirmed on server</strong>';
                
                // Clear stored data
                localStorage.removeItem('bookingFormData');
                localStorage.removeItem('bookingPayload');
            } else {
                document.getElementById('apiResponseStatus').innerHTML = 
                    '<span class="text-danger">Error submitting booking</span>';
                console.error('Error submitting booking:', responseData);
            }
        } catch (error) {
            console.error('Error submitting booking:', error);
            document.getElementById('apiResponseStatus').innerHTML = 
                '<span class="text-danger">Error submitting booking</span>';
        }
    }
});
</script>
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
	
	<!-- Success Section Start -->
    <div class="page-book-appointment">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                        <h2 class="mt-4">Payment Successful!</h2>
                        <p class="lead">Your appointment has been booked successfully.</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">Service</p>
                                    <h5>{{ $serviceName }}</h5>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">Payment Type</p>
                                    <h5>{{ $paymentType === 'deposit' ? '15% Deposit' : 'Full Payment' }}</h5>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-12">
                                    <p class="mb-1 text-muted">Transaction ID</p>
                                    <p><code id="transactionId">{{ $transactionId }}</code></p>
                                </div>
                            </div>
                            
                            {{-- <div class="alert alert-info">
                                <i class="fas fa-info-circle mr-2"></i>
                                A confirmation has been sent to your email address.
                            </div> --}}
                            
                            <div class="alert alert-success" id="bookingConfirmation">
                                <i class="fas fa-check-circle mr-2"></i>
                                <strong>Booking Confirmed!</strong> Your appointment has been scheduled and payment processed successfully.
                                <div class="mt-2">
                                    <small>Server Response: <span id="apiResponseStatus">Booking sent to server</span></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <a href="/" class="btn-default"><span>Return to Home</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Success Section End -->
@endsection
