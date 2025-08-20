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
    
    // Populate booking details in the UI
    populateBookingDetails(formData, bookingPayload);
    
    // Submit the booking to the API
    submitBooking(bookingPayload);
    
    // Function to format date
    function formatDate(dateString) {
        if (!dateString) return 'Not available';
        
        const date = new Date(dateString);
        if (isNaN(date.getTime())) {
            // Try to parse from "Month Day, Year at HH:MM:SS AM/PM" format
            if (typeof dateString === 'string') {
                const parts = dateString.split(' at ');
                if (parts.length >= 1) {
                    return parts[0]; // Return just the date part
                }
            }
            return dateString;
        }
        
        return date.toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }
    
    // Function to format time
    function formatTime(dateString) {
        if (!dateString) return 'Not available';
        
        // Try to extract time from "Month Day, Year at HH:MM:SS AM/PM" format
        if (typeof dateString === 'string') {
            const parts = dateString.split(' at ');
            if (parts.length >= 2) {
                const timePart = parts[1].split(' ');
                if (timePart.length >= 2) {
                    return timePart[0] + ' ' + timePart[1]; // Return "HH:MM:SS AM/PM"
                }
            }
            
            // If the above didn't work, try to extract from the time field
            if (dateString.includes(':')) {
                const timeParts = dateString.split(':');
                if (timeParts.length >= 2) {
                    const hour = parseInt(timeParts[0]);
                    const minute = timeParts[1];
                    const period = hour >= 12 ? 'PM' : 'AM';
                    const displayHour = hour % 12 || 12;
                    return `${displayHour}:${minute} ${period}`;
                }
            }
        }
        
        return dateString;
    }
    
    // Function to format currency
    function formatCurrency(amount) {
        if (amount === undefined || amount === null) return 'Not available';
        return '$' + parseFloat(amount).toFixed(2);
    }
    
    // Function to populate booking details
    function populateBookingDetails(formData, bookingPayload) {
        try {
            // Service Information
            document.getElementById('service-name').textContent = 
                bookingPayload.services?.[0]?.serviceName || '{{ $serviceName }}';
            
            document.getElementById('service-provider').textContent = 
                bookingPayload.service_provider_id || 'Not available';
                
            document.getElementById('agent-name').textContent = 
                bookingPayload.agent_name || formData.agentName || 'Not available';
                
            const duration = bookingPayload.services?.[0]?.durationMinutes || 0;
            document.getElementById('service-duration').textContent = 
                duration ? `${duration} minutes` : 'Not available';
            
            // Appointment Information
            const bookingDate = bookingPayload.booking_time || formData.selectedDate;
            document.getElementById('appointment-date').textContent = formatDate(bookingDate);
            
            const bookingTime = bookingPayload.booking_time || formData.selectedTime;
            document.getElementById('appointment-time').textContent = formatTime(bookingTime);
            
            // Payment Information
            const servicePrice = bookingPayload.services?.[0]?.servicePrice || 0;
            const paymentType = '{{ $paymentType }}';
            
            let amountPaid = servicePrice;
            let remainingAmount = 0;
            
            if (paymentType === 'deposit') {
                amountPaid = servicePrice * 0.15;
                remainingAmount = servicePrice - amountPaid;
                
                // Show remaining amount section
                document.getElementById('remaining-amount-container').style.display = '';
                document.getElementById('remaining-amount').textContent = formatCurrency(remainingAmount);
            }
            
            document.getElementById('amount-paid').textContent = formatCurrency(amountPaid);
            
            // Customer Information
            const userInfo = bookingPayload.userInfo?.[0] || {};
            document.getElementById('customer-name').textContent = userInfo.name || 'Not available';
            document.getElementById('customer-email').textContent = userInfo.email || 'Not available';
            document.getElementById('customer-phone').textContent = userInfo.phone || 'Not available';
            
            // Hide loading and show details
            document.getElementById('booking-details-loading').style.display = 'none';
            document.getElementById('booking-details').style.display = 'block';
            
        } catch (error) {
            console.error('Error populating booking details:', error);
            document.getElementById('booking-details-loading').innerHTML = 
                '<div class="alert alert-danger">Error loading booking details</div>';
        }
    }
    
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
                
                // Don't clear stored data until we've displayed all the information
                // localStorage.removeItem('bookingFormData');
                // localStorage.removeItem('bookingPayload');
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
    
    // Set up download receipt functionality
    document.getElementById('download-receipt').addEventListener('click', function() {
        generateReceipt(formData, bookingPayload);
    });
    
    // Function to generate and download receipt
    function generateReceipt(formData, bookingPayload) {
        try {
            const serviceName = bookingPayload.services?.[0]?.serviceName || '{{ $serviceName }}';
            const servicePrice = bookingPayload.services?.[0]?.servicePrice || 0;
            const paymentType = '{{ $paymentType }}';
            const transactionId = '{{ $transactionId }}';
            const bookingDate = formatDate(bookingPayload.booking_time || formData.selectedDate);
            const bookingTime = formatTime(bookingPayload.booking_time || formData.selectedTime);
            const agentName = bookingPayload.agent_name || formData.agentName || 'Not available';
            
            let amountPaid = servicePrice;
            let remainingAmount = 0;
            
            if (paymentType === 'deposit') {
                amountPaid = servicePrice * 0.15;
                remainingAmount = servicePrice - amountPaid;
            }
            
            // Customer info
            const userInfo = bookingPayload.userInfo?.[0] || {};
            const customerName = userInfo.name || 'Not available';
            const customerEmail = userInfo.email || 'Not available';
            const customerPhone = userInfo.phone || 'Not available';
            
            // Current date for receipt
            const today = new Date();
            const receiptDate = today.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            
            // Create receipt HTML
            const receiptHtml = `
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <title>Receipt - ${serviceName}</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            line-height: 1.6;
                            color: #333;
                            max-width: 800px;
                            margin: 0 auto;
                            padding: 20px;
                        }
                        .receipt {
                            border: 1px solid #ddd;
                            padding: 20px;
                            margin-bottom: 30px;
                        }
                        .receipt-header {
                            text-align: center;
                            border-bottom: 2px solid #333;
                            padding-bottom: 10px;
                            margin-bottom: 20px;
                        }
                        .receipt-header h1 {
                            margin: 0;
                            color: #333;
                            font-size: 24px;
                        }
                        .receipt-header p {
                            margin: 5px 0;
                            color: #666;
                        }
                        .receipt-details {
                            margin-bottom: 20px;
                        }
                        .receipt-details h2 {
                            font-size: 18px;
                            margin-bottom: 10px;
                            border-bottom: 1px solid #eee;
                            padding-bottom: 5px;
                        }
                        .receipt-details p {
                            margin: 5px 0;
                        }
                        .receipt-details .label {
                            font-weight: bold;
                            display: inline-block;
                            width: 150px;
                        }
                        .receipt-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin: 20px 0;
                        }
                        .receipt-table th, .receipt-table td {
                            padding: 10px;
                            text-align: left;
                            border-bottom: 1px solid #ddd;
                        }
                        .receipt-table th {
                            background-color: #f5f5f5;
                        }
                        .receipt-total {
                            margin-top: 20px;
                            text-align: right;
                        }
                        .receipt-total .total-row {
                            margin: 5px 0;
                        }
                        .receipt-total .total-label {
                            display: inline-block;
                            width: 150px;
                            text-align: right;
                            margin-right: 10px;
                            font-weight: bold;
                        }
                        .receipt-total .total-value {
                            display: inline-block;
                            width: 100px;
                            text-align: right;
                        }
                        .receipt-footer {
                            margin-top: 30px;
                            text-align: center;
                            font-size: 14px;
                            color: #666;
                        }
                    </style>
                </head>
                <body>
                    <div class="receipt">
                        <div class="receipt-header">
                            <h1>GoGlow Beauty Services</h1>
                            <p>Receipt for ${serviceName}</p>
                            <p>Date: ${receiptDate}</p>
                        </div>
                        
                        <div class="receipt-details">
                            <h2>Customer Information</h2>
                            <p><span class="label">Name:</span> ${customerName}</p>
                            <p><span class="label">Email:</span> ${customerEmail}</p>
                            <p><span class="label">Phone:</span> ${customerPhone}</p>
                        </div>
                        
                        <div class="receipt-details">
                            <h2>Appointment Details</h2>
                            <p><span class="label">Service:</span> ${serviceName}</p>
                            <p><span class="label">Date:</span> ${bookingDate}</p>
                            <p><span class="label">Time:</span> ${bookingTime}</p>
                            <p><span class="label">Agent:</span> ${agentName}</p>
                        </div>
                        
                        <table class="receipt-table">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th style="text-align: right;">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>${serviceName} ${paymentType === 'deposit' ? '(15% Deposit)' : ''}</td>
                                    <td style="text-align: right;">${formatCurrency(amountPaid)}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="receipt-total">
                            <div class="total-row">
                                <span class="total-label">Total:</span>
                                <span class="total-value">${formatCurrency(servicePrice)}</span>
                            </div>
                            <div class="total-row">
                                <span class="total-label">Amount Paid:</span>
                                <span class="total-value">${formatCurrency(amountPaid)}</span>
                            </div>
                            ${paymentType === 'deposit' ? `
                            <div class="total-row">
                                <span class="total-label">Remaining Balance:</span>
                                <span class="total-value">${formatCurrency(remainingAmount)}</span>
                            </div>
                            ` : ''}
                        </div>
                        
                        <div class="receipt-details">
                            <h2>Payment Information</h2>
                            <p><span class="label">Payment Type:</span> ${paymentType === 'deposit' ? '15% Deposit' : 'Full Payment'}</p>
                            <p><span class="label">Transaction ID:</span> ${transactionId}</p>
                            <p><span class="label">Payment Status:</span> Completed</p>
                        </div>
                        
                        <div class="receipt-footer">
                            <p>Thank you for choosing GoGlow Beauty Services!</p>
                            <p>For any questions regarding your appointment, please contact us.</p>
                        </div>
                    </div>
                </body>
                </html>
            `;
            
            // Create blob and download
            const blob = new Blob([receiptHtml], { type: 'text/html' });
            const url = URL.createObjectURL(blob);
            
            const downloadLink = document.createElement('a');
            downloadLink.href = url;
            downloadLink.download = `receipt-${transactionId.substring(0, 8)}.html`;
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
            
        } catch (error) {
            console.error('Error generating receipt:', error);
            alert('Error generating receipt. Please try again.');
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
                            <h4 class="mb-4">Booking Details</h4>
                            
                            <div id="booking-details-loading" class="text-center py-4">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2">Loading booking details...</p>
                            </div>
                            
                            <div id="booking-details" style="display: none;">
                                <!-- Service Information -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="border-bottom pb-2 mb-3">Service Information</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <p class="mb-1 text-muted">Service Name</p>
                                                <h6 id="service-name">{{ $serviceName }}</h6>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="mb-1 text-muted">Service Provider</p>
                                                <h6 id="service-provider">Loading...</h6>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="mb-1 text-muted">Agent Name</p>
                                                <h6 id="agent-name">Loading...</h6>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="mb-1 text-muted">Duration</p>
                                                <h6 id="service-duration">Loading...</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Appointment Information -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="border-bottom pb-2 mb-3">Appointment Information</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <p class="mb-1 text-muted">Date</p>
                                                <h6 id="appointment-date">Loading...</h6>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="mb-1 text-muted">Time</p>
                                                <h6 id="appointment-time">Loading...</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Payment Information -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="border-bottom pb-2 mb-3">Payment Information</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <p class="mb-1 text-muted">Payment Type</p>
                                                <h6>{{ $paymentType === 'deposit' ? '15% Deposit' : 'Full Payment' }}</h6>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="mb-1 text-muted">Transaction ID</p>
                                                <p><code id="transactionId">{{ $transactionId }}</code></p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="mb-1 text-muted">Amount Paid</p>
                                                <h6 id="amount-paid">Loading...</h6>
                                            </div>
                                            <div class="col-md-6 mb-3" id="remaining-amount-container" style="display: none;">
                                                <p class="mb-1 text-muted">Remaining Amount</p>
                                                <h6 id="remaining-amount">Loading...</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Customer Information -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="border-bottom pb-2 mb-3">Customer Information</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <p class="mb-1 text-muted">Name</p>
                                                <h6 id="customer-name">Loading...</h6>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="mb-1 text-muted">Email</p>
                                                <h6 id="customer-email">Loading...</h6>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="mb-1 text-muted">Phone</p>
                                                <h6 id="customer-phone">Loading...</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-success" id="bookingConfirmation">
                                <i class="fas fa-check-circle mr-2"></i>
                                <strong>Booking Confirmed!</strong> Your appointment has been scheduled and payment processed successfully.
                                <div class="mt-2">
                                    <small>Server Response: <span id="apiResponseStatus">Booking sent to server</span></small>
                                </div>
                            </div>
                            <button id="download-receipt" class="btn-alt me-2"><span><i class="fas fa-download"></i> Download Receipt</span></button>
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
