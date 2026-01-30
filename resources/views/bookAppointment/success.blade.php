@extends('layouts.mainInnerPages')
{{-- Title --}}
@section('title', __('app.success.page_title'))

{{-- Content --}}
@section('styles')
<link rel="stylesheet" href="{{ asset('css/bookAppointment-success.css') }}">
@endsection

@section('scripts')
<script>
// Get current locale
const currentLocale = '{{ app()->getLocale() }}';

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
    const transactionId = '{{ $transactionId }}';
    const paymentType = '{{ $paymentType }}';
    const isFreeBooking = transactionId && transactionId.startsWith('free-booking');
    
    bookingPayload.payment_id = transactionId;
    bookingPayload.payment_type = paymentType;
    bookingPayload.payment_status = 'completed';
    if (bookingPayload.payment_type === 'full') {
        bookingPayload.payed = true;
    } else {
        bookingPayload.payed = false;
    }
    
    // Ensure all required fields are present
    // Extract bookTime from booking_time if not already present
    if (!bookingPayload.bookTime && bookingPayload.booking_time) {
        const bookTimeMatch = bookingPayload.booking_time.match(/at (\d+):(\d+):/);
        bookingPayload.bookTime = bookTimeMatch ? `${bookTimeMatch[1]}:${bookTimeMatch[2]}` : null;
    }
    
    // Ensure depositPercentage is set
    if (bookingPayload.depositPercentage === undefined || bookingPayload.depositPercentage === null) {
        const serviceData = bookingPayload.serviceData || bookingPayload.service || null;
        const depositPercentage = calculateDepositPercentage(serviceData);
        bookingPayload.depositPercentage = depositPercentage;
    }
    
    // Ensure serviceProviderInfo is present
    if (!bookingPayload.serviceProviderInfo) {
        // Debug: Log serviceData to see what fields are available
        console.log('=== SERVICE PROVIDER INFO DEBUG (Success Page) ===');
        console.log('serviceData:', bookingPayload.serviceData);
        console.log('ownerMail:', bookingPayload.serviceData?.ownerMail);
        console.log('ownerProfile:', bookingPayload.serviceData?.ownerProfile);
        console.log('All serviceData keys:', bookingPayload.serviceData ? Object.keys(bookingPayload.serviceData) : 'No serviceData');
        console.log('==================================================');
        
        bookingPayload.serviceProviderInfo = {
            email: bookingPayload.serviceData?.ownerMail || 
                  bookingPayload.serviceData?.owner_mail || 
                  bookingPayload.serviceData?.ownerEmail || 
                  null,
            id: bookingPayload.service_provider_id || null,
            // Prefer companyName; fallback to ownerName for backward compatibility
            name: bookingPayload.serviceData?.companyName || bookingPayload.serviceData?.ownerName || null,
            photo: bookingPayload.serviceData?.ownerProfile || 
                  bookingPayload.serviceData?.owner_profile || 
                  bookingPayload.serviceData?.ownerPhoto || 
                  null
        };
        
        console.log('Constructed serviceProviderInfo:', bookingPayload.serviceProviderInfo);
    } else {
        // If serviceProviderInfo exists but email/photo are null, try to update from serviceData
        if ((!bookingPayload.serviceProviderInfo.email || !bookingPayload.serviceProviderInfo.photo) && bookingPayload.serviceData) {
            console.log('Updating serviceProviderInfo from serviceData...');
            if (!bookingPayload.serviceProviderInfo.email && bookingPayload.serviceData.ownerMail) {
                bookingPayload.serviceProviderInfo.email = bookingPayload.serviceData.ownerMail;
            }
            if (!bookingPayload.serviceProviderInfo.photo && bookingPayload.serviceData.ownerProfile) {
                bookingPayload.serviceProviderInfo.photo = bookingPayload.serviceData.ownerProfile;
            }
            console.log('Updated serviceProviderInfo:', bookingPayload.serviceProviderInfo);
        }
    }
    
    // Ensure address is set
    if (!bookingPayload.address) {
        // Debug: Log address fields to see what's available
        console.log('=== ADDRESS DEBUG (Success Page) ===');
        console.log('address:', bookingPayload.serviceData?.address);
        console.log('companyAddress:', bookingPayload.serviceData?.companyAddress);
        console.log('serviceProviderAddress:', bookingPayload.serviceData?.serviceProviderAddress);
        console.log('location:', bookingPayload.serviceData?.location);
        console.log('serviceLocation:', bookingPayload.serviceData?.serviceLocation);
        console.log('=====================================');
        
        bookingPayload.address = bookingPayload.serviceData?.address || 
                                 bookingPayload.serviceData?.companyAddress ||
                                 bookingPayload.serviceData?.serviceProviderAddress || 
                                 bookingPayload.serviceData?.location || 
                                 bookingPayload.serviceData?.serviceLocation || 
                                 null;
        
        console.log('Resolved address:', bookingPayload.address);
    }
    
    // Always save the full service amount regardless of payment type
    const servicePrice = parseFloat(bookingPayload.services?.[0]?.servicePrice || 0) || 0;
    bookingPayload.amount = Math.round(servicePrice * 100) / 100;
    
    // Ensure address and amount are set to null if not present
    if (bookingPayload.address === undefined) {
        bookingPayload.address = null;
    }
    if (bookingPayload.amount === undefined) {
        bookingPayload.amount = null;
    }
    
    // Ensure userInfo has countryCode and photo, and validate values
    if (bookingPayload.userInfo) {
        const userInfo = bookingPayload.userInfo;
        
        // Clean up empty strings and ensure proper values
        if (userInfo.name === '' || (userInfo.name && !userInfo.name.trim())) {
            userInfo.name = null;
        } else if (userInfo.name) {
            userInfo.name = userInfo.name.trim();
        }
        
        if (userInfo.email === '' || (userInfo.email && !userInfo.email.trim())) {
            userInfo.email = null;
        } else if (userInfo.email) {
            userInfo.email = userInfo.email.trim();
        }
        
        if (userInfo.phone === '' || (userInfo.phone && !userInfo.phone.trim())) {
            userInfo.phone = null;
        } else if (userInfo.phone) {
            userInfo.phone = userInfo.phone.trim();
        }
        
        // Extract country code from phone if available
        if (userInfo.countryCode === undefined) {
            let countryCode = null;
            if (userInfo.phone) {
                const phoneMatch = userInfo.phone.match(/^\+(\d{1,3})/);
                if (phoneMatch) {
                    countryCode = '+' + phoneMatch[1];
                }
            }
            userInfo.countryCode = countryCode;
        }
        
        if (userInfo.photo === undefined) {
            userInfo.photo = null;
        }
        
        // Ensure user ID is present
        if (!userInfo.id && bookingPayload.userId) {
            userInfo.id = bookingPayload.userId;
        }
        
        // Log userInfo for debugging
        console.log('Final userInfo before API call:', userInfo);
    } else {
        // If userInfo is missing, try to reconstruct it
        console.warn('userInfo is missing, attempting to reconstruct from payload');
        bookingPayload.userInfo = {
            id: bookingPayload.userId || null,
            name: null,
            email: null,
            phone: null,
            countryCode: null,
            photo: null
        };
    }
    
    console.log('After conditions booking payload:', bookingPayload);
    console.log('Is free booking:', isFreeBooking);
    
    // Populate booking details in the UI
    populateBookingDetails(formData, bookingPayload);
    
    // Submit the booking to the API
    // For free bookings that were already submitted, skip to avoid double submission
    if (isFreeBooking && bookingPayload.alreadySubmitted) {
        console.log('Free booking already submitted, skipping duplicate submission');
        // Still update the UI status to show booking was successful
        document.getElementById('apiResponseStatus').innerHTML = 
            '<strong class="text-success">' + successTranslations.booking_confirmed_server + '</strong>';
        
        // Send booking emails even for already submitted free bookings
        sendBookingEmails(bookingPayload).catch(error => {
            console.error('Error sending emails for free booking:', error);
        });
    } else {
        submitBooking(bookingPayload);
    }
    
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
        return '€' + parseFloat(amount).toFixed(2);
    }
    
    // Function to calculate deposit percentage from service data
    function calculateDepositPercentage(serviceData) {
        if (!serviceData) return 0;
        
        const spDeposit = serviceData.spDeposit || 0;
        const commission = serviceData.commission || {};
        const minimumBookingPercentage = commission.minimum_booking_percentage || 0;
        const commissionValue = commission.commission || 0;
        
        if (spDeposit > 0) {
            return spDeposit;
        } else if (minimumBookingPercentage > 0) {
            return minimumBookingPercentage;
        } else if (commissionValue > 0) {
            return commissionValue;
        } else {
            return 0;
        }
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
            
            // Get service data from bookingPayload or try to get from stored data
            const serviceData = bookingPayload.serviceData || bookingPayload.service || null;
            const depositPercentage = calculateDepositPercentage(serviceData);
            
            let amountPaid = servicePrice;
            let remainingAmount = 0;
            
            if (paymentType === 'deposit') {
                if (depositPercentage > 0) {
                    amountPaid = servicePrice * (depositPercentage / 100);
                } else {
                    amountPaid = 0; // Free booking
                }
                remainingAmount = servicePrice - amountPaid;
                
                // Show remaining amount section
                document.getElementById('remaining-amount-container').style.display = '';
                document.getElementById('remaining-amount').textContent = formatCurrency(remainingAmount);
            }
            
            document.getElementById('amount-paid').textContent = formatCurrency(amountPaid);
            
            // Customer Information
            const userInfo = bookingPayload.userInfo || {};
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
    
    // Helper function to parse date from booking_time string
    function parseBookingDate(bookingTimeString) {
        if (!bookingTimeString) return null;
        
        try {
            // Format: "December 18, 2025 at 9:00:00 AM UTC+5"
            // Extract date part (before " at ")
            const datePart = bookingTimeString.split(' at ')[0];
            if (!datePart) return null;
            
            // Parse the date string (e.g., "December 18, 2025")
            const date = new Date(datePart);
            if (isNaN(date.getTime())) return null;
            
            // Format as YYYY-MM-DD
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            
            return `${year}-${month}-${day}`;
        } catch (error) {
            console.error('Error parsing booking date:', error);
            return null;
        }
    }
    
    // Helper function to parse time from booking_time string
    function parseBookingTime(bookingTimeString, bookTimeField) {
        // First try to use bookTime field if available (e.g., "9:24")
        if (bookTimeField) {
            return bookTimeField;
        }
        
        if (!bookingTimeString) return null;
        
        try {
            // Format: "December 18, 2025 at 9:00:00 AM UTC+5"
            // Extract time part (after " at ")
            const timePart = bookingTimeString.split(' at ')[1];
            if (!timePart) return null;
            
            // Extract hour, minute, and AM/PM (e.g., "9:00:00 AM" -> hour=9, minute=00, ampm=AM)
            const timeMatch = timePart.match(/(\d+):(\d+):\d+\s+(AM|PM)/i);
            if (timeMatch) {
                let hour = parseInt(timeMatch[1]);
                const minute = timeMatch[2];
                const ampm = timeMatch[3].toUpperCase();
                
                // Convert 12-hour to 24-hour format
                if (ampm === 'PM' && hour !== 12) {
                    hour += 12;
                } else if (ampm === 'AM' && hour === 12) {
                    hour = 0;
                }
                
                return `${hour}:${minute}`;
            }
            
            // Fallback: try to extract without AM/PM (assume 24-hour format)
            const fallbackMatch = timePart.match(/(\d+):(\d+):/);
            if (fallbackMatch) {
                const hour = parseInt(fallbackMatch[1]);
                const minute = fallbackMatch[2];
                return `${hour}:${minute}`;
            }
            
            return null;
        } catch (error) {
            console.error('Error parsing booking time:', error);
            return null;
        }
    }
    
    // Function to generate Google Maps directions link
    function getMapLink(lat, lng, address) {
        if (lat != null && lng != null) {
            return `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}&travelmode=transit`;
        } else if (address != null && address !== '') {
            return `https://www.google.com/maps/dir/?api=1&destination=${encodeURIComponent(address)}&travelmode=transit`;
        }
        return "";
    }
    
    // Function to send booking emails
    async function sendBookingEmails(payload) {
        try {
            // Extract required data from payload
            const userInfo = payload.userInfo || {};
            const serviceInfo = payload.services?.[0] || {};
            const serviceProviderInfo = payload.serviceProviderInfo || {};
            const serviceData = payload.serviceData || {};
            
            const clientName = userInfo.name || 'Customer';
            const clientEmail = userInfo.email;
            const serviceName = serviceInfo.serviceName || '';
            const salonName = serviceData.companyName || '';
            const ownerName = serviceProviderInfo.name || serviceData.ownerName || '';
            const ownerEmail = serviceProviderInfo.email || serviceData.ownerMail || null;
            const address = payload.address || serviceData.companyAddress || '';
            const bookingAmount = serviceInfo.servicePrice || payload.amount || 0;
            
            // Extract location data from spLocation
            const spLocation = serviceData.spLocation || {};
            const geometry = spLocation.geometry || {};
            const location = geometry.location || {};
            const lat = location.lat;
            const lng = location.lng;
            
            // Generate map link using coordinates or address
            const mapLink = getMapLink(lat, lng, address);
            
            // Parse date and time from booking_time
            const bookingDate = parseBookingDate(payload.booking_time);
            const bookingTime = parseBookingTime(payload.booking_time, payload.bookTime);
            
            // Send customer email (bookingCreated)
            if (clientEmail && bookingDate && bookingTime) {
                try {
                    const customerEmailPayload = {
                        to: clientEmail,
                        type: 'bookingCreated',
                        lang: currentLocale,
                        data: {
                            clientName: clientName,
                            serviceName: serviceName,
                            salonName: salonName,
                            date: bookingDate,
                            time: bookingTime,
                            address: address,
                            mapLink: mapLink
                        }
                    };
                    
                    const customerEmailResponse = await fetch('https://backend.glaura.ai/api/send-email', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(customerEmailPayload)
                    });
                    
                    const customerEmailResult = await customerEmailResponse.json();
                    if (!customerEmailResponse.ok) {
                        console.error('Error sending customer email:', customerEmailResult);
                    }
                } catch (customerEmailError) {
                    console.error('Error sending customer email:', customerEmailError);
                }
            }
            
            // Send provider email (providerNewBookingReceived)
            if (ownerEmail && bookingDate && bookingTime) {
                try {
                    // Format booking amount with € symbol
                    const formattedAmount = `€${parseFloat(bookingAmount).toFixed(2)}`;
                    
                    const providerEmailPayload = {
                        to: ownerEmail,
                        type: 'providerNewBookingReceived',
                        lang: currentLocale,
                        data: {
                            proName: ownerName,
                            clientName: clientName,
                            serviceName: serviceName,
                            date: bookingDate,
                            time: bookingTime,
                            bookingAmount: formattedAmount
                        }
                    };
                    
                    const providerEmailResponse = await fetch('https://backend.glaura.ai/api/send-email', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(providerEmailPayload)
                    });
                    
                    const providerEmailResult = await providerEmailResponse.json();
                    if (!providerEmailResponse.ok) {
                        console.error('Error sending provider email:', providerEmailResult);
                    }
                } catch (providerEmailError) {
                    console.error('Error sending provider email:', providerEmailError);
                }
            }
        } catch (error) {
            console.error('Error in sendBookingEmails:', error);
        }
    }
    
    // Function to submit the booking
    async function submitBooking(payload) {
        try {
            document.getElementById('apiResponseStatus').innerHTML = 
                '<span class="text-warning">' + successTranslations.sending_booking + '</span>';
            
            const response = await fetch('https://us-central1-beauty-984c8.cloudfunctions.net/bookService', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload)
            });
            
            const responseData = await response.json();
            
            if (response.ok) {
                document.getElementById('apiResponseStatus').innerHTML = 
                    '<strong class="text-success">' + successTranslations.booking_confirmed_server + '</strong>';
                
                // Send booking emails after successful booking
                await sendBookingEmails(payload);
                
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
            
            // Get service data from bookingPayload or try to get from stored data
            const serviceData = bookingPayload.serviceData || bookingPayload.service || null;
            const depositPercentage = calculateDepositPercentage(serviceData);
            
            let amountPaid = servicePrice;
            let remainingAmount = 0;
            
            if (paymentType === 'deposit') {
                if (depositPercentage > 0) {
                    amountPaid = servicePrice * (depositPercentage / 100);
                } else {
                    amountPaid = 0; // Free booking
                }
                remainingAmount = servicePrice - amountPaid;
            }
            
            // Customer info
            const userInfo = bookingPayload.userInfo || {};
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
