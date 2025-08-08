@extends('layouts.main')
{{-- Title --}}
@section('title', 'home')

{{-- Style Files --}}
@section('styles')
<style>
    .service-details-box {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
    }

    .service-details-box label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }

    .service-details-box input[readonly] {
        background-color: #fff;
        color: #333;
        font-weight: 500;
    }

    .booking-days-buttons {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 15px;
        margin-top: 15px;
        margin-bottom: 20px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #e9ecef;
    }

    .day-btn {
        position: relative;
        padding: 15px 10px;
        border: 2px solid #e9ecef;
        background: #fff;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .day-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--theme-color);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .day-btn span {
        display: block;
        font-weight: 600;
        font-size: 14px;
        color: #333;
        transition: all 0.3s ease;
    }

    .day-btn:hover {
        border-color: var(--theme-color);
        transform: translateY(-2px);
    }

    .day-btn:hover::before {
        transform: scaleX(1);
    }

    .day-btn:hover span {
        color: var(--theme-color);
    }

    .day-btn.active {
        background: var(--theme-color);
        border-color: var(--theme-color);
        transform: translateY(-2px);
    }

    .day-btn.active::before {
        transform: scaleX(1);
        background: #fff;
    }

    .day-btn.active span {
        color: #fff;
    }

    @media (max-width: 991px) {
        .booking-days-buttons {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 575px) {
        .booking-days-buttons {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .form-label {
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }

    @media (max-width: 768px) {
        .booking-days-buttons {
            grid-template-columns: repeat(2, 1fr);
        }
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
	
	<!-- Book Appointment Section Start -->
    <div class="page-book-appointment">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Appointment image Start -->
                    <div class="appointment-image">
                        <figure class="image-anime reveal">
                            <img src="images/appointment-image.jpg" alt="">
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
                                <!-- Service Details Section -->
                                {{-- <div class="col-md-12 mb-4">
                                    <div class="service-details-box">
                                        <div class="form-group mb-3">
                                            <label for="service_name">Service Name</label>
                                            <input type="text" name="service_name" class="form-control" id="service_name" value="{{ $selectedService['service_name'] ?? '' }}" readonly>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="service_price">Service Price</label>
                                            <input type="text" name="service_price" class="form-control" id="service_price" value="${{ $selectedService['service_price'] ?? '0' }}" readonly>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Personal Information -->                                
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-12 mb-4">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" required>
                                    <div class="help-block with-errors"></div>
                                </div>
    
                                <div class="form-group col-md-12 mb-4">
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <!-- Booking Days Section -->
                                <div class="col-md-12 mb-4">
                                    <label class="form-label">Select Booking Day</label>
                                    <div class="booking-days-buttons">
                                        <button type="button" class="day-btn" data-day="monday">
                                            <span>MON</span>
                                        </button>
                                        <button type="button" class="day-btn" data-day="tuesday">
                                            <span>TUE</span>
                                        </button>
                                        <button type="button" class="day-btn" data-day="wednesday">
                                            <span>WED</span>
                                        </button>
                                        <button type="button" class="day-btn" data-day="thursday">
                                            <span>THU</span>
                                        </button>
                                        <button type="button" class="day-btn" data-day="friday">
                                            <span>FRI</span>
                                        </button>
                                        <button type="button" class="day-btn" data-day="saturday">
                                            <span>SAT</span>
                                        </button>
                                        <button type="button" class="day-btn" data-day="sunday">
                                            <span>SUN</span>
                                        </button>
                                    </div>
                                    <input type="hidden" name="selected_day" id="selected_day" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <!-- Notes Section -->
                                {{-- <div class="form-group col-md-12 mb-4">
                                    <label for="notes">Additional Notes</label>
                                    <textarea name="notes" id="notes" class="form-control" rows="4" placeholder="Any special requests or notes for your appointment"></textarea>
                                </div> --}}
    
                                <div class="col-md-12">
                                    <button type="submit" class="btn-default"><span>Book an appointment</span></button>
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

    <!-- Why Choose Us Section Start -->
<div class="why-choose-us">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- Why Choose Content Start -->
                <div class="why-choose-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Why choose us</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Why our clients trust us for their <span>salon experiences</span></h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">
                            We bring all your beauty and grooming needs under one roof. Our trusted network of professional salons, transparent booking system, and quality-focused service help us deliver consistent satisfaction to every client.
                        </p>
                    </div>
                    <!-- Section Title End -->
                    
                    <!-- Why Choose Item List Start -->
                    <div class="why-choose-item-list">
                        <!-- Why Choose Item Start -->
                        <div class="why-choose-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="why-choose-item-header">
                                <div class="icon-box">
                                    <img src="images/icon-why-choose-1.svg" alt="">
                                </div>
                                <div class="why-choose-item-title">
                                    <h3>All-in-One Salon Platform</h3>
                                </div>
                            </div>
                            <div class="why-choose-item-content">
                                <p>From Hair to Nails, Skin to Waxing—book any service at top-rated salons near you, all in one place.</p>
                            </div>
                        </div>
                        <!-- Why Choose Item End -->
                        
                        <!-- Why Choose Item Start -->
                        <div class="why-choose-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="why-choose-item-header">
                                <div class="icon-box">
                                    <img src="images/icon-why-choose-2.svg" alt="">
                                </div>
                                <div class="why-choose-item-title">
                                    <h3>Trusted Salon Partners</h3>
                                </div>
                            </div>
                            <div class="why-choose-item-content">
                                <p>We partner only with licensed, well-reviewed salons to ensure you get quality care from skilled professionals.</p>
                            </div>
                        </div>
                        <!-- Why Choose Item End -->    
                    </div>
                    <!-- Why Choose Item List End -->
                </div>
                <!-- Why Choose Content End -->
            </div>

            <div class="col-lg-6">
                <!-- Why Choose Images Start -->
                <div class="why-choose-image">
                    <figure class="image-anime">
                        <img src="images/kimia-kazemi-u93nTfWqR9w-unsplash.jpg" alt="">
                    </figure>

                    <!-- Contact Us Circle Start -->
                    <div class="contact-us-circle">
                        <a href="{{ url('/contact-us') }}">
                            <img src="images/contact-us-circle.svg" alt="">
                        </a>
                    </div>
                    <!-- Contact Us Circle End -->
                </div>
                <!-- Why Choose Images End -->
            </div>
        </div>
    </div>
</div>
    <!-- Why Choose Us Section End -->
@endsection


{{-- Scripts --}}
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const dayButtons = document.querySelectorAll('.day-btn');
    const selectedDayInput = document.getElementById('selected_day');
    const form = document.getElementById('appointmentForm');

    // Handle day button selection
    dayButtons.forEach(button => {
        button.addEventListener('click', function () {
            dayButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            selectedDayInput.value = this.dataset.day;
        });
    });

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        if (!selectedDayInput.value) {
            alert('Please select a booking day');
            return;
        }

        // Get form values
        const fname = form.fname.value.trim();
        const lname = form.lname.value.trim();
        const email = form.email.value.trim();
        const phone = form.phone.value.trim();

        // Combine name (just in case you want it)
        const fullName = fname + ' ' + lname;

        // Get params from URL
        const urlParams = new URLSearchParams(window.location.search);
        const serviceId = urlParams.get('serviceId');
        const serviceProviderId = urlParams.get('service_provider_id');

        // Optional: Replace with actual values if needed
        const userId = serviceId; // REPLACE with actual logic if dynamic
        const bookingTime = new Date().toISOString();  // Example: "2025-08-01T15:00:00Z"
        const serviceName = "Full Arms Wax";            // You may want to fetch this dynamically
        const servicePrice = 729;
        const durationMinutes = 30;

        if (!serviceId || !serviceProviderId) {
            alert("Missing 'serviceId' or 'service_provider_id' in URL.");
            return;
        }

        // Construct payload
        const payload = {
            booking_time: bookingTime,
            service_provider_id: serviceProviderId,
            user_id: userId,
            services: [
                {
                    serviceId: serviceId,
                    serviceName: serviceName,
                    durationMinutes: durationMinutes,
                    discountedPrice: servicePrice,
                    servicePrice: servicePrice,
                    isCompleted: false,
                    startTime: bookingTime
                }
            ]
        };

        try {
            const response = await fetch('https://us-central1-beauty-984c8.cloudfunctions.net/bookService', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            if (response.ok) {
                alert('Appointment booked successfully!');
                form.reset();
                selectedDayInput.value = '';
                dayButtons.forEach(btn => btn.classList.remove('active'));
            } else {
                const errorData = await response.json();
                alert('Booking failed: ' + (errorData.message || 'Unknown error'));
            }
        } catch (err) {
            alert('An error occurred: ' + err.message);
        }
    });
});
</script>

@endsection

