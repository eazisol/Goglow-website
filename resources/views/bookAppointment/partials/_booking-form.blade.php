{{-- Booking Appointment Form --}}
<div class="appointment-form wow fadeInUp" data-wow-delay="0.2s">
    {{-- Form submission handled by JS via fetch() - no traditional POST --}}
    <form id="appointmentForm">
        <div class="row">
            {{-- Service Details Section (hidden inputs) --}}
            @if(!empty($selectedService))
                <input type="hidden" name="service_name" id="service_name" value="{{ $selectedService['service_name'] ?? '' }}">
                <input type="hidden" name="service_price" id="service_price" value="{{ $selectedService['discounted_price'] ?? ($selectedService['service_price'] ?? '0') }}">
            @endif

            {{-- Hidden fields for the selected slot --}}
            <input type="hidden" name="selected_day" id="selected_day" required>
            <input type="hidden" id="selected_date" name="selected_date" required>
            <input type="hidden" id="selected_time" name="selected_time" required>

            {{-- Personal Information from logged-in user (hidden) --}}
            <input type="hidden" name="name" id="name" value="{{ $userData['name'] ?? '' }}">
            <input type="hidden" name="email" id="email" value="{{ $userData['email'] ?? '' }}">
            <input type="hidden" name="phone" id="phone" value="{{ $userData['phone'] ?? '' }}">

            {{-- Payment Options (hidden initially, shown after time slot selection) --}}
            <div id="paymentOptionsSection" class="col-12" style="display: none;">
                {{-- Payment choices - hidden in reschedule mode --}}
                <div id="paymentChoicesSection" class="form-group col-md-12 mb-4">
                    @php
                        // Calculate deposit percentage based on priority: spDeposit > minimum_booking_percentage > commission
                        $depositPercentage = null;
                        $depositLabel = '';
                        $servicePrice = $selectedService['discounted_price'] ?? ($selectedService['service_price'] ?? 0);

                        if (!empty($selectedService)) {
                            $spDeposit = $selectedService['spDeposit'] ?? 0;
                            $commission = $selectedService['commission'] ?? [];
                            $minimumBookingPercentage = $commission['minimum_booking_percentage'] ?? 0;
                            $commissionValue = $commission['commission'] ?? 0;

                            if ($spDeposit > 0) {
                                $depositPercentage = $spDeposit;
                                $depositLabel = __('app.booking.deposit_now', ['percentage' => $spDeposit]);
                            } elseif ($minimumBookingPercentage > 0) {
                                $depositPercentage = $minimumBookingPercentage;
                                $depositLabel = __('app.booking.deposit_now', ['percentage' => $minimumBookingPercentage]);
                            } elseif ($commissionValue > 0) {
                                $depositPercentage = $commissionValue;
                                $depositLabel = __('app.booking.deposit_now', ['percentage' => $commissionValue]);
                            } else {
                                $depositPercentage = 0;
                                $depositLabel = __('app.booking.free_booking');
                            }

                            $depositAmount = ($depositPercentage > 0) ? ($servicePrice * ($depositPercentage / 100)) : 0;
                        } else {
                            $depositPercentage = 0;
                            $depositLabel = __('app.booking.free_booking');
                            $depositAmount = 0;
                        }
                    @endphp

                    @if($depositPercentage == 0)
                        {{-- Free Booking UI: same radio style as paid bookings --}}
                        <label class="form-label">{{ __('app.agent_page.payment_options') }}</label>
                        <div class="payment-options">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="paymentType" id="payDeposit" value="deposit" checked>
                                <label class="form-check-label" for="payDeposit" id="payDepositLabel">
                                    {{ __('app.booking.book_on_site') }}
                                </label>
                                <input type="hidden" id="depositPercentage" value="{{ $depositPercentage }}">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentType" id="payFull" value="full">
                                <label class="form-check-label" for="payFull">
                                    {{ __('app.booking.pay_now') }} ({{ number_format($servicePrice, 2) }}€)
                                </label>
                            </div>
                        </div>
                    @else
                        {{-- Paid Booking UI --}}
                        <label class="form-label">{{ __('app.agent_page.payment_options') }}</label>
                        <div class="payment-options">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="paymentType" id="payDeposit" value="deposit" checked>
                                <label class="form-check-label" for="payDeposit" id="payDepositLabel">
                                    @if($depositPercentage > 0)
                                        {{ $depositLabel }} ({{ number_format($depositAmount, 2) }}€)
                                    @else
                                        {{ $depositLabel }}
                                    @endif
                                </label>
                                <input type="hidden" id="depositPercentage" value="{{ $depositPercentage }}">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentType" id="payFull" value="full">
                                <label class="form-check-label" for="payFull">
                                    {{ __('app.agent_page.pay_full_amount_now') }} ({{ $selectedService['discounted_price'] ?? ($selectedService['service_price'] ?? 0) }}€)
                                </label>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Terms and Conditions Checkbox --}}
                <div class="form-group col-md-12 mb-4">
                    <div class="terms-checkbox-wrapper" style="padding: 15px; background: rgba(255, 244, 248, 0.5); border: 1px solid rgba(213, 190, 198, 0.5); border-radius: 12px;">
                        <div class="terms-checkbox-container" style="display: flex; align-items: flex-start; gap: 12px;">
                            <input type="checkbox" name="terms_conditions" id="termsConditions" class="terms-checkbox-input" required style="width: 20px; height: 20px; margin: 0; cursor: pointer; flex-shrink: 0; margin-top: 2px;"
                                oninvalid="this.setCustomValidity('{{ __('app.booking.please_accept_terms') }}')"
                                oninput="this.setCustomValidity('')">
                            <label class="terms-checkbox-label" for="termsConditions" style="font-size: 14px; line-height: 1.5; color: #2c0d18; cursor: pointer; margin: 0; flex: 1;">
                                {{ __('app.auth.i_agree_to') }} <a href="{{ url('/terms_condition') }}" target="_blank" style="color: rgba(229, 0, 80, 1); text-decoration: underline; font-weight: 500;">{{ __('app.auth.terms') }}</a> {{ __('app.auth.and') }} <a href="{{ url('/privacy_policy') }}" target="_blank" style="color: rgba(229, 0, 80, 1); text-decoration: underline; font-weight: 500;">{{ __('app.auth.privacy_policy') }}</a>
                            </label>
                        </div>
                        <div class="invalid-feedback" id="termsError" style="display: none; color: #dc3545; font-size: 13px; margin-top: 8px; margin-left: 32px;">
                            {{ __('app.auth.please_accept_terms') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn-default" id="bookAppointmentBtn">
                        <span id="bookAppointmentBtnText">{{ __('app.agent_page.book_an_appointment') }}</span>
                        <span id="bookAppointmentBtnLoader" style="display: none;">
                            <i class="fa fa-spinner fa-spin" style="margin-right: 8px;"></i>{{ __('app.common.loading') }}
                        </span>
                    </button>
                    <div id="msgSubmit" class="h3 hidden"></div>
                </div>
            </div>
        </div>
    </form>
</div>
