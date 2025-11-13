@extends('layouts.mainInnerPages')
{{-- Title --}}
@section('title', __('app.success.page_title'))

{{-- Content --}}
@section('styles')
<style>
    :root {
        --success-bg: #fff4f8;
        --success-card: #ffffff;
        --success-border: #f1d6e2;
        --success-primary: #e50050;
        --success-primary-dark: #c00040;
        --success-text: #4d263f;
        --success-muted: #8d5f78;
    }

    .success-page {
        background: var(--success-bg);
        padding: 60px 0 90px;
        display: flex;
        justify-content: center;
    }

    .success-wrapper {
        max-width: 880px;
        width: 100%;
        margin: 0 auto;
        padding: 0 24px;
    }

    .success-card {
        background: var(--success-card);
        border: 1px solid var(--success-border);
        border-radius: 28px;
        box-shadow: 0 28px 60px rgba(229, 0, 80, 0.08);
        padding: 50px 48px;
        text-align: center;
    }

    .success-icon {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: rgba(229, 0, 80, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 28px;
        color: var(--success-primary);
        font-size: 42px;
    }

    .success-title {
        font-size: 32px;
        font-weight: 700;
        color: var(--success-text);
        margin-bottom: 12px;
    }

    .success-subtitle {
        font-size: 16px;
        color: var(--success-muted);
        margin-bottom: 40px;
    }

    .details-card {
        background: var(--success-card);
        border: 1px solid rgba(229, 0, 80, 0.12);
        border-radius: 22px;
        padding: 32px 36px;
        text-align: left;
    }

    .loading-card {
        background: rgba(229, 0, 80, 0.05);
        border: 1px solid rgba(229, 0, 80, 0.1);
        border-radius: 18px;
        padding: 28px;
        text-align: center;
        color: var(--success-muted);
        margin-bottom: 28px;
    }

    .info-section + .info-section {
        margin-top: 30px;
        padding-top: 24px;
        border-top: 1px dashed rgba(229, 0, 80, 0.2);
    }

    .info-section h5 {
        font-size: 18px;
        font-weight: 700;
        color: var(--success-text);
        margin-bottom: 18px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 18px 24px;
    }

    .info-item .label {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--success-muted);
        margin-bottom: 6px;
    }

    .info-item .value {
        font-size: 16px;
        font-weight: 600;
        color: var(--success-text);
        word-break: break-word;
    }

    .info-item code {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 12px;
        background: rgba(229, 0, 80, 0.08);
        color: var(--success-primary);
        font-size: 13px;
        word-break: break-all;
    }

    .status-banner {
        background: rgba(229, 0, 80, 0.08);
        border: 1px solid rgba(229, 0, 80, 0.2);
        border-radius: 16px;
        padding: 18px 22px;
        /* display: flex; */
        align-items: flex-start;
        gap: 14px;
        margin-top: 28px;
        color: var(--success-text);
    }

    .status-banner .icon {
        font-size: 20px;
        color: var(--success-primary);
        margin-top: 2px;
    }

    .status-banner strong {
        display: block;
        margin-bottom: 6px;
    }

    .status-banner small {
        display: block;
        color: var(--success-muted);
        margin-top: 4px;
    }

    .success-actions {
        margin-top: 32px;
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .success-btn-primary {
        background: var(--success-primary);
        color: #fff;
        border: none;
        border-radius: 28px;
        padding: 12px 28px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.2s ease;
    }

    .success-btn-primary:hover {
        background: var(--success-primary-dark);
        transform: translateY(-1px);
    }

    .success-btn-secondary {
        border-radius: 28px;
        padding: 12px 28px;
        border: 1px solid var(--success-primary);
        color: var(--success-primary);
        font-weight: 600;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .success-btn-secondary:hover {
        background: rgba(229, 0, 80, 0.08);
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .success-card {
            padding: 36px 26px;
        }

        .details-card {
            padding: 26px 24px;
        }

        .success-title {
            font-size: 26px;
        }

        .success-actions {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('scripts')
<script>
// Pass translations to JavaScript
const successTranslations = {
    not_available: @json(__('app.success.not_available')),
    minutes: @json(__('app.success.minutes')),
    sending_booking: @json(__('app.success.sending_booking')),
    booking_confirmed_server: @json(__('app.success.booking_confirmed_server')),
    error_submitting_booking: @json(__('app.success.error_submitting_booking')),
    error_loading_details: @json(__('app.success.error_loading_details')),
    label_name: @json(__('app.success.label_name')),
    label_email: @json(__('app.success.label_email')),
    label_phone: @json(__('app.success.label_phone')),
    label_date: @json(__('app.success.label_date')),
    label_time: @json(__('app.success.label_time')),
    label_payment_type: @json(__('app.success.label_payment_type')),
    label_transaction_id: @json(__('app.success.label_transaction_id')),
    receipt_title: @json(__('app.success.receipt_title')),
    receipt_for: @json(__('app.success.receipt_for')),
    receipt_date: @json(__('app.success.receipt_date')),
    receipt_customer_info: @json(__('app.success.receipt_customer_info')),
    receipt_appointment_details: @json(__('app.success.receipt_appointment_details')),
    receipt_service: @json(__('app.success.receipt_service')),
    receipt_agent: @json(__('app.success.receipt_agent')),
    receipt_description: @json(__('app.success.receipt_description')),
    receipt_amount: @json(__('app.success.receipt_amount')),
    receipt_total: @json(__('app.success.receipt_total')),
    receipt_amount_paid: @json(__('app.success.receipt_amount_paid')),
    receipt_remaining_balance: @json(__('app.success.receipt_remaining_balance')),
    receipt_payment_info: @json(__('app.success.receipt_payment_info')),
    receipt_payment_status: @json(__('app.success.receipt_payment_status')),
    receipt_completed: @json(__('app.success.receipt_completed')),
    receipt_thank_you: @json(__('app.success.receipt_thank_you')),
    receipt_contact: @json(__('app.success.receipt_contact')),
    error_generating_receipt: @json(__('app.success.error_generating_receipt')),
    payment_type_deposit: @json(__('app.success.payment_type_deposit')),
    payment_type_full: @json(__('app.success.payment_type_full')),
};

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
        if (!dateString) return successTranslations.not_available;
        
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
        if (!dateString) return successTranslations.not_available;
        
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
        if (amount === undefined || amount === null) return successTranslations.not_available;
        return '$' + parseFloat(amount).toFixed(2);
    }
    
    // Function to populate booking details
    function populateBookingDetails(formData, bookingPayload) {
        try {
            // Service Information
            document.getElementById('service-name').textContent = 
                bookingPayload.services?.[0]?.serviceName || '{{ $serviceName }}';
            
            document.getElementById('service-provider').textContent = 
                bookingPayload.service_provider_id || successTranslations.not_available;
                
            document.getElementById('agent-name').textContent = 
                bookingPayload.agent_name || formData.agentName || successTranslations.not_available;
                
            const duration = bookingPayload.services?.[0]?.durationMinutes || 0;
            document.getElementById('service-duration').textContent = 
                duration ? `${duration} ${successTranslations.minutes}` : successTranslations.not_available;
            
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
            document.getElementById('customer-name').textContent = userInfo.name || successTranslations.not_available;
            document.getElementById('customer-email').textContent = userInfo.email || successTranslations.not_available;
            document.getElementById('customer-phone').textContent = userInfo.phone || successTranslations.not_available;
            
            // Hide loading and show details
            document.getElementById('booking-details-loading').style.display = 'none';
            document.getElementById('booking-details').style.display = 'block';
            
        } catch (error) {
            console.error('Error populating booking details:', error);
            document.getElementById('booking-details-loading').innerHTML = 
                '<div class="alert alert-danger">' + successTranslations.error_loading_details + '</div>';
        }
    }
    
    // Function to submit the booking
    async function submitBooking(payload) {
        try {
            document.getElementById('apiResponseStatus').innerHTML = 
                '<span class="text-warning">' + successTranslations.sending_booking + '</span>';
            
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
                    '<strong class="text-success">' + successTranslations.booking_confirmed_server + '</strong>';
                
                // Don't clear stored data until we've displayed all the information
                // localStorage.removeItem('bookingFormData');
                // localStorage.removeItem('bookingPayload');
            } else {
                document.getElementById('apiResponseStatus').innerHTML = 
                    '<span class="text-danger">' + successTranslations.error_submitting_booking + '</span>';
                console.error('Error submitting booking:', responseData);
            }
        } catch (error) {
            console.error('Error submitting booking:', error);
            document.getElementById('apiResponseStatus').innerHTML = 
                '<span class="text-danger">' + successTranslations.error_submitting_booking + '</span>';
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
                            <h1>${successTranslations.receipt_title}</h1>
                            <p>${successTranslations.receipt_for} ${serviceName}</p>
                            <p>${successTranslations.receipt_date} ${receiptDate}</p>
                        </div>
                        
                        <div class="receipt-details">
                            <h2>${successTranslations.receipt_customer_info}</h2>
                            <p><span class="label">${successTranslations.label_name}:</span> ${customerName}</p>
                            <p><span class="label">${successTranslations.label_email}:</span> ${customerEmail}</p>
                            <p><span class="label">${successTranslations.label_phone}:</span> ${customerPhone}</p>
                        </div>
                        
                        <div class="receipt-details">
                            <h2>${successTranslations.receipt_appointment_details}</h2>
                            <p><span class="label">${successTranslations.receipt_service}</span> ${serviceName}</p>
                            <p><span class="label">${successTranslations.label_date}:</span> ${bookingDate}</p>
                            <p><span class="label">${successTranslations.label_time}:</span> ${bookingTime}</p>
                            <p><span class="label">${successTranslations.receipt_agent}</span> ${agentName}</p>
                        </div>
                        
                        <table class="receipt-table">
                            <thead>
                                <tr>
                                    <th>${successTranslations.receipt_description}</th>
                                    <th style="text-align: right;">${successTranslations.receipt_amount}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>${serviceName} ${paymentType === 'deposit' ? '(' + successTranslations.payment_type_deposit + ')' : ''}</td>
                                    <td style="text-align: right;">${formatCurrency(amountPaid)}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="receipt-total">
                            <div class="total-row">
                                <span class="total-label">${successTranslations.receipt_total}</span>
                                <span class="total-value">${formatCurrency(servicePrice)}</span>
                            </div>
                            <div class="total-row">
                                <span class="total-label">${successTranslations.receipt_amount_paid}</span>
                                <span class="total-value">${formatCurrency(amountPaid)}</span>
                            </div>
                            ${paymentType === 'deposit' ? `
                            <div class="total-row">
                                <span class="total-label">${successTranslations.receipt_remaining_balance}</span>
                                <span class="total-value">${formatCurrency(remainingAmount)}</span>
                            </div>
                            ` : ''}
                        </div>
                        
                        <div class="receipt-details">
                            <h2>${successTranslations.receipt_payment_info}</h2>
                            <p><span class="label">${successTranslations.label_payment_type}:</span> ${paymentType === 'deposit' ? successTranslations.payment_type_deposit : successTranslations.payment_type_full}</p>
                            <p><span class="label">${successTranslations.label_transaction_id}:</span> ${transactionId}</p>
                            <p><span class="label">${successTranslations.receipt_payment_status}</span> ${successTranslations.receipt_completed}</p>
                        </div>
                        
                        <div class="receipt-footer">
                            <p>${successTranslations.receipt_thank_you}</p>
                            <p>${successTranslations.receipt_contact}</p>
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
            alert(successTranslations.error_generating_receipt);
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
    <div class="success-page">
        <div class="success-wrapper">
            <div class="success-card">
                <div class="success-icon"><i class="fas fa-check"></i></div>
                <h2 class="success-title">{{ __('app.success.title') }}</h2>
                <p class="success-subtitle">{{ __('app.success.subtitle') }}</p>

                <div id="booking-details-loading" class="loading-card">
                    <div class="spinner-border text-danger" role="status">
                        <span class="visually-hidden">{{ __('app.success.loading') }}</span>
                    </div>
                    <p class="mt-3">{{ __('app.success.loading_booking_details') }}</p>
                </div>

                <div id="booking-details" class="details-card" style="display:none;">
                    <div class="info-section">
                        <h5>{{ __('app.success.service_information') }}</h5>
                        <div class="info-grid">
                            <div class="info-item">
                                <p class="label">{{ __('app.success.label_service_name') }}</p>
                                <p class="value" id="service-name">{{ $serviceName }}</p>
                            </div>
                            <div class="info-item">
                                <p class="label">{{ __('app.success.label_service_provider') }}</p>
                                <p class="value" id="service-provider">{{ __('app.success.loading') }}</p>
                            </div>
                            <div class="info-item">
                                <p class="label">{{ __('app.success.label_agent_name') }}</p>
                                <p class="value" id="agent-name">{{ __('app.success.loading') }}</p>
                            </div>
                            <div class="info-item">
                                <p class="label">{{ __('app.success.label_duration') }}</p>
                                <p class="value" id="service-duration">{{ __('app.success.loading') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h5>{{ __('app.success.appointment_information') }}</h5>
                        <div class="info-grid">
                            <div class="info-item">
                                <p class="label">{{ __('app.success.label_date') }}</p>
                                <p class="value" id="appointment-date">{{ __('app.success.loading') }}</p>
                            </div>
                            <div class="info-item">
                                <p class="label">{{ __('app.success.label_time') }}</p>
                                <p class="value" id="appointment-time">{{ __('app.success.loading') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h5>{{ __('app.success.payment_information') }}</h5>
                        <div class="info-grid">
                            <div class="info-item">
                                <p class="label">{{ __('app.success.label_payment_type') }}</p>
                                <p class="value">{{ $paymentType === 'deposit' ? __('app.success.payment_type_deposit') : __('app.success.payment_type_full') }}</p>
                            </div>
                            <div class="info-item">
                                <p class="label">{{ __('app.success.label_transaction_id') }}</p>
                                <p><code id="transactionId">{{ $transactionId }}</code></p>
                            </div>
                            <div class="info-item">
                                <p class="label">{{ __('app.success.label_amount_paid') }}</p>
                                <p class="value" id="amount-paid">{{ __('app.success.loading') }}</p>
                            </div>
                            <div class="info-item" id="remaining-amount-container" style="display:none;">
                                <p class="label">{{ __('app.success.label_remaining_amount') }}</p>
                                <p class="value" id="remaining-amount">{{ __('app.success.loading') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h5>{{ __('app.success.customer_information') }}</h5>
                        <div class="info-grid">
                            <div class="info-item">
                                <p class="label">{{ __('app.success.label_name') }}</p>
                                <p class="value" id="customer-name">{{ __('app.success.loading') }}</p>
                            </div>
                            <div class="info-item">
                                <p class="label">{{ __('app.success.label_email') }}</p>
                                <p class="value" id="customer-email">{{ __('app.success.loading') }}</p>
                            </div>
                            <div class="info-item">
                                <p class="label">{{ __('app.success.label_phone') }}</p>
                                <p class="value" id="customer-phone">{{ __('app.success.loading') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="bookingConfirmation" class="status-banner">
                    <div class="icon"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <strong>{{ __('app.success.booking_confirmed') }}</strong>
                        <span>{{ __('app.success.booking_confirmed_description') }}</span>
                        <small>{{ __('app.success.server_response') }}<span id="apiResponseStatus">{{ __('app.success.booking_sent_to_server') }}</span></small>
                    </div>
                </div>

                <div class="success-actions">
                    <button id="download-receipt" class="success-btn-primary">
                        <i class="fas fa-download"></i>{{ __('app.success.button_download_receipt') }}
                    </button>
                    <a href="/" class="success-btn-secondary">
                        <i class="fas fa-home"></i>{{ __('app.success.button_return_home') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Success Section End -->
@endsection
