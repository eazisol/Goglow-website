@extends('layouts.mainInnerPages')

@section('title', 'Provider Services')

@section('content')

    <!-- Page Header Start -->
    <div class="page-header bg-section">
        <div class="services-container">
            <div class="services-row">
                <div class="services-col-12">
                    <!-- Page Header Box Start -->
                    
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


<!-- Provider Services Section Start -->
<div class="provider-services" style="margin: 50px 0 50px 0;">
    <div class="services-container">
        <div class="services-row section-row">
            <div class="services-col-12">
                <div class="provider-header services-mb-1">
                    <div class="services-row services-align-center">
                        <div class="services-col-md-10">
                            <h2>{{ $provider['storeName'] ?? $provider['name'] }}</h2>
                            @if(isset($provider['companyName']))
                                <h4>{{ $provider['companyName'] }}</h4>
                            @endif
                            <div class="provider-info">
                                @if(isset($provider['address']))
                                    <p><i class="fas fa-map-marker-alt"></i> {{ $provider['address'] }}</p>
                                @endif
                                @if(isset($provider['avg_ratting']) && $provider['avg_ratting'] > 0)
                                    <p>
                                        <i class="fas fa-star text-warning"></i>
                                        {{ $provider['avg_ratting'] }} ({{ $provider['total_review'] ?? 0 }} reviews)
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="provider-image">
                                <img src="{{ isset($provider['profileImg']) && $provider['profileImg'] ? $provider['profileImg'] : asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}" 
                                     alt="{{ $provider['name'] }}" 
                                     class="services-img-fluid"
                                     onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                            </div>
                </div>
            </div>
        </div>

        
                            {{-- <div class="section-title">
                                <h1 class="text-anime-style-2" >Book online for an appointment at<span> {{$provider['companyName']}}  </span></h1>
                                <h3 class="wow fadeInUp">24/7 - Free - Payment on site - Immediate confirmation</h3>
                            </div> --}}
@php
    // Group services by category and sort by category name
    $groupedServices = collect($services)
        ->groupBy(function ($service) {
            return $service['category']['name'] ?? 'Uncategorized';
        })
        ->sortKeys();
@endphp

    <div class="services-row">
        <div class="services-col-lg-8">
                @if(count($services) > 0)
                @foreach($groupedServices as $categoryName => $servicesInCategory)
                    <div class="section-title" style="display: flex;margin-bottom: 25px;margin-top: 20px;">
                        {{-- Display category name --}}
                        <h3 class="wow" style="font-size:30px; font-weight:600;">{{ $categoryName ?: 'Uncategorized' }}</h3>
                    </div>
                    <div class="custom-service-list">
                        @foreach($servicesInCategory as $service)
                            <div class="service-row services-d-flex services-justify-between services-flex-wrap">
                                
                                <!-- Left -->
                                <div class="service-info services-d-flex services-align-center">
                                    {{-- <div class="section-title" style="margin-bottom:initial;">
                                        <h3 class="wow fadeInUp">{{ $service['category']['name'] }}</h3>
                                    </div> --}}
                                    
                                
                                    <div class="service-image">
                                        <img src="{{ (isset($service['images']) && count($service['images']) > 0) ? $service['images'][0] : asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}" 
                                            alt="{{ $service['service_name'] }}" 
                                            class="services-img-fluid services-rounded-circle"
                                            onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                                    </div>
                                    <div class="service-list-details" style="margin-left: 35px;">
                                        <div class="service-name services-fw-semibold">
                                        {{-- {{ $service['service_name'] }} --}}
                                        {{ \Illuminate\Support\Str::limit($service['service_name'], 50, '...') }}
                                    </div>
                                    @if(!empty($service['service_details']))
                                        <div class="service-desc services-text-muted">
                                            {{ \Illuminate\Support\Str::limit($service['service_details'], 50, '...') }}
                                        </div>
                                    @endif

                                    </div>
                                </div>

                                <!-- Right -->
                                <div class="service-meta services-text-end">
                                    <div class="services-text-muted services-small services-mb-1">
                                        {{ $service['duration_minutes'] ?? 0 }} min 
                                        &bull; 
                                        from €{{ $service['service_price'] ?? '0' }}
                                    </div>
                                    <div class="choose-button">
                                        <a href="{{ url('/book-appointment?serviceId=' . $service['id'] . '&service_provider_id=' . ($provider['id'] ?? '')) }}" 
                                        class="choose-btn">Choose</a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach 
                @else
                    <div class="custom-service-list">
                    <div class="services-text-center services-py-4">
                        <h5>No services available from this provider.</h5>
                    </div>
                    </div>
                @endif

                
        </div>
<div class="services-col-lg-4">
    <div class="section-title" style="margin-bottom:initial; margin-top: 20px;">
        <h3 class="wow" style="font-size:30px; font-weight:600;">Hours of operation</h3>
    </div>
    <div class="custom-service-list" style="padding: 30px;">
        <div class="provider-details" style="color: #00000085;font-style: normal;font-size: 20px;">
            @if(isset($provider['timing']))
                @php
                    $dayNames = [
                        'Mon' => 'Monday',
                        'Tue' => 'Tuesday',
                        'Wed' => 'Wednesday',
                        'Thu' => 'Thursday',
                        'Fri' => 'Friday',
                        'Sat' => 'Saturday',
                        'Sun' => 'Sunday',
                    ];
                @endphp

                @foreach($dayNames as $shortDay => $fullDay)
                    <div class="services-d-flex services-justify-between services-py-4 {{ !$loop->last ? 'services-border-bottom' : '' }}">
                        <span>{{ $fullDay }}</span>

                        @if(isset($provider['timing'][$shortDay]) && count($provider['timing'][$shortDay]) === 2)
                        @php
                            $openTime  = \Carbon\Carbon::createFromTimestamp($provider['timing'][$shortDay][0], 'Europe/Paris')->format('H:i');
                            $closeTime = \Carbon\Carbon::createFromTimestamp($provider['timing'][$shortDay][1], 'Europe/Paris')->format('H:i');
                        @endphp

                            @if($openTime === $closeTime || $openTime > $closeTime)
                                <span>Farm</span>
                            @else
                                <span>{{ $openTime }} - {{ $closeTime }}</span>
                            @endif
                        @else
                            <span>Farm</span>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

    </div>


        
        <div class="services-row services-mt-4">
            <div class="services-col-12">
                <a href="{{ url()->previous() }}" class="btn-default">
                    <i></i> Back to Search Results
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Provider Services Section End -->
@endsection

@section('styles')
<style>
/* Bootstrap-free grid system scoped to provider-services */
.provider-services .services-container,
.page-header .services-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.page-header .services-row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

.page-header .services-col-12 {
    padding: 0 15px;
    flex: 0 0 100%;
    width: 100%;
}

.provider-services .services-row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

.provider-services .services-col-12,
.provider-services .services-col-md-10,
.provider-services .services-col-lg-8,
.provider-services .services-col-lg-4 {
    padding: 0 15px;
    flex: 0 0 100%;
    width: 100%;
}

@media (min-width: 768px) {
    .provider-services .services-col-md-10 {
        flex: 0 0 83.333333%;
        max-width: 83.333333%;
    }
}

@media (min-width: 992px) {
    .provider-services .services-col-lg-8 {
        flex: 0 0 66.666667%;
        max-width: 66.666667%;
    }
    .provider-services .services-col-lg-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
}

/* Utility classes scoped to provider-services */
.provider-services .services-d-flex { display: flex; }
.provider-services .services-align-center { align-items: center; }
.provider-services .services-justify-between { justify-content: space-between; }
.provider-services .services-flex-wrap { flex-wrap: wrap; }
.provider-services .services-text-center { text-align: center; }
.provider-services .services-text-end { text-align: right; }
.provider-services .services-text-muted { color: #6c757d; }
.provider-services .services-small { font-size: 0.875rem; }
.provider-services .services-fw-semibold { font-weight: 600; }
.provider-services .services-img-fluid { max-width: 100%; display: block; }
.provider-services .services-rounded-circle { border-radius: 50%; }
.provider-services .services-mb-1 { margin-bottom: 0.25rem; }
.provider-services .services-mt-4 { margin-top: 1.5rem; }
.provider-services .services-py-4 { padding-top: 1.5rem; padding-bottom: 1.5rem; }
.provider-services .services-border-bottom { border-bottom: 1px solid #dee2e6; }

.choose-button{
    margin-top: 20px;
}
.provider-header {
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    color: #333;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.provider-image img {
    width: 100%;
    height: 300px;
    object-fit: cover;
}

.provider-info {
    margin-top: 10px;
}

.provider-info p {
    margin-bottom: 3px;
}

.provider-info i {
    margin-right: 8px;
}

.service-card {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease;
    height: 100%;
}

.service-card:hover {
    transform: translateY(-5px);
}

.service-image img {
    width: 60px;
    height: 60px;
    object-fit: cover;
}
.service-image{
    /* margin-bottom: 10px; */
}

.service-details {
    color: #333;
}

.discounted {
    color: #ff4444;
    text-decoration: line-through;
    margin-left: 5px;
}

.service-meta {
    margin: 15px 0;
}

.service-meta > div {
    margin-bottom: 8px;
}
/* SCOPED to .custom-service-list */
.custom-service-list {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.custom-service-list .service-row {
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}

.custom-service-list .service-row:last-child {
    border-bottom: none;
}

.custom-service-list .service-info {
    max-width: 70%;
}

.custom-service-list .service-name {
    font-size: 16px;
    margin-bottom: 4px;
}

.custom-service-list .service-desc {
    font-size: 14px;
    color: #666;
}

.custom-service-list .service-meta {
    min-width: 120px;
}

.custom-service-list .choose-btn {
    background-color: #1c1c1c;
    color: white;
    border: none;
    border-radius: 10px;
    padding: 6px 14px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.custom-service-list .choose-btn:hover {
    background-color: #333;
}

</style>
@endsection
