{{-- Service Summary Card --}}
<div class="service-summary-card">
    <div class="card-body">
        <h4 class="service-summary-title">{{ $selectedService['service_name'] ?? 'Selected Service' }}</h4>
        <p class="service-summary-price">
            {{ $selectedService['discounted_price'] ?? ($selectedService['service_price'] ?? 0) }}€
            @if(isset($selectedService['discounted_price']) && isset($selectedService['service_price']) && $selectedService['discounted_price'] < $selectedService['service_price'])
                <span class="old-price">{{ $selectedService['service_price'] }}€</span>
            @endif
        </p>
        @if(!empty($selectedService['service_details']))
            <div class="service-summary-desc">
                <span class="desc-text desc-clamped">{{ $selectedService['service_details'] }}</span>
                <button type="button" class="see-more-desc-btn" style="display:none; color: rgba(229, 0, 80, 1); background: none; border: none; cursor: pointer; font-size: 14px; padding: 0; margin-left: 5px; text-decoration: underline;">
                    {{ __('app.service.see_more') }}
                </button>
            </div>
        @endif
    </div>
</div>
