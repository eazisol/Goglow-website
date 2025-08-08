@extends('layouts.main')

@section('title', 'Provider Services')

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


<!-- Provider Services Section Start -->
<div class="provider-services" style="margin: 50px 0 50px 0;">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <div class="provider-header mb-1">
                    <div class="row align-items-center">
                        <div class="col-md-10">
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
                                     class="img-fluid"
                                     onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                            </div>
                </div>
            </div>
        </div>

        
                            <div class="section-title">
                                <h1 class="text-anime-style-2" data-cursor="-opaque">Book online for an appointment at<span> {{$provider['companyName']}}  </span></h1>
                                <h3 class="wow fadeInUp">24/7 - Free - Payment on site - Immediate confirmation</h3>
                            </div>
@php
    // Group services by category and sort by category name
    $groupedServices = collect($services)
        ->groupBy(function ($service) {
            return $service['category']['name'] ?? 'Uncategorized';
        })
        ->sortKeys();
@endphp

    <div class="row">
        <div class="col-lg-8">
                @if(count($services) > 0)
                @foreach($groupedServices as $categoryName => $servicesInCategory)
                    <div class="section-title" style="margin-bottom:initial; margin-top: 20px;">
                        {{-- Display category name --}}
                        <h3 class="wow" style="font-size:30px; font-weight:600;">{{ $categoryName ?: 'Uncategorized' }}</h3>
                    </div>
                    <div class="custom-service-list">
                        @foreach($servicesInCategory as $service)
                            <div class="service-row d-flex justify-content-between align-items-start flex-wrap">
                                
                                <!-- Left -->
                                <div class="service-info">
                                    {{-- <div class="section-title" style="margin-bottom:initial;">
                                        <h3 class="wow fadeInUp">{{ $service['category']['name'] }}</h3>
                                    </div> --}}
                                    
                                
                                    <div class="service-image">
                                        <img src="{{ (isset($service['images']) && count($service['images']) > 0) ? $service['images'][0] : asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}" 
                                            alt="{{ $service['service_name'] }}" 
                                            class="img-fluid rounded-circle"
                                            onerror="this.src='{{ asset('/images/adam-winger-FkAZqQJTbXM-unsplash.jpg') }}'">
                                    </div>
                                    <div class="service-list-details">
                                        <div class="service-name fw-semibold">
                                        {{ $service['service_name'] }}
                                    </div>
                                    @if(!empty($service['service_details']))
                                        <div class="service-desc text-muted">
                                            {{ $service['service_details'] }}
                                        </div>
                                    @endif
                                    </div>
                                </div>

                                <!-- Right -->
                                <div class="service-meta text-end">
                                    <div class="text-muted small mb-1">
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
                    <div class="text-center py-4">
                        <h5>No services available from this provider.</h5>
                    </div>
                    </div>
                @endif

                
        </div>
<div class="col-lg-4">
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
                    <div class="d-flex justify-content-between py-4 {{ !$loop->last ? 'border-bottom' : '' }}">
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


        
        <div class="row mt-4">
            <div class="col-12">
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
.choose-button{
    margin-top: 50px;
}
.provider-header {
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    color: #333;
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
    margin-bottom: 10px;
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
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
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
