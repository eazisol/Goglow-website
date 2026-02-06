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
            @php
                $description = $selectedService['service_details'];
                $wordLimit = 8;
                $words = preg_split('/\s+/', trim($description), -1, PREG_SPLIT_NO_EMPTY);
                $needsTruncation = count($words) > $wordLimit;
                $truncatedDescription = implode(' ', array_slice($words, 0, $wordLimit)) . '...';
                $descId = 'desc-' . uniqid();
            @endphp

            <div class="service-summary-desc">
                @if($needsTruncation)
                    <span class="desc-text" data-desc-id="{{ $descId }}">{{ $truncatedDescription }}</span>
                    <span class="desc-full" data-desc-id="{{ $descId }}" style="display: none;">{{ $description }}</span>
                    <button type="button" class="see-more-desc-btn" data-desc-id="{{ $descId }}" style="color: rgba(229, 0, 80, 1); background: none; border: none; cursor: pointer; font-size: 14px; padding: 0; margin-left: 5px; text-decoration: underline;">
                        {{ __('app.service.see_more') }}
                    </button>
                @else
                    {{ $description }}
                @endif
            </div>
        @endif
    </div>
</div>
