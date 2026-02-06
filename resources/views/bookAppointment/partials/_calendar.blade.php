{{-- Calendar/Schedule Section --}}
<div id="agentSchedule" class="mt-3" style="display:none;">
    <h5 style="margin-bottom: 10px;font-size:18px;font-weight:700;text-align:center;">{{ __('app.agent_page.schedule') }}</h5>

    {{-- Selected slot info --}}
    <div id="selectedSlotInfo" class="alert alert-info mb-3" style="display: none;">
        <i class="fa fa-info-circle"></i>
        {{ __('app.agent_page.selected') }}: <span id="selectedDateTimeDisplay"></span>
    </div>

    <div id="weekDisplay"></div>

    {{-- Desktop: Calendar strip --}}
    <div class="calendar-strip">
        <button type="button" id="prevWeek" class="calendar-arrow">
            <img src="{{ asset('images/images/leftarrow_days.svg') }}" alt="" width="16" height="16">
        </button>
        <div class="days-header"></div>
        <button type="button" id="nextWeek" class="calendar-arrow">
            <img src="{{ asset('images/images/rightarrow_days.svg') }}" alt="" width="16" height="16">
        </button>
    </div>

    {{-- Mobile: Day selector dropdown --}}
    <div class="mobile-day-selector" id="mobileDaySelector">
        <div class="mobile-day-selector-header" id="mobileDaySelectorHeader">
            <span class="mobile-day-selector-text" id="mobileDaySelectorText">{{ __('app.schedule.select_date') ?? 'Select a date' }}</span>
            <svg class="mobile-day-selector-chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>
        <div class="mobile-day-selector-options" id="mobileDaySelectorOptions">
            {{-- Options populated by JavaScript --}}
        </div>
    </div>

    {{-- Period Selector (hidden initially) --}}
    <div id="periodSelector" class="period-selector" style="display: none;">
        <button type="button" class="period-btn" data-period="morning">{{ __('app.agent_page.the_morning') }}</button>
        <button type="button" class="period-btn" data-period="afternoon">{{ __('app.agent_page.in_the_afternoon') }}</button>
        <button type="button" class="period-btn" data-period="evening">{{ __('app.agent_page.in_the_evening') }}</button>
    </div>

    {{-- Desktop: Grouped Time Slots (3-column layout, hidden initially) --}}
    <div id="slotsGroupedContainer" class="slots-grouped-container" style="display: none;"></div>

    {{-- Time Slots with Navigation (hidden initially) --}}
    <div id="timeSlotsStrip" class="time-slots-strip" style="display: none;">
        <button type="button" id="prevTimeSlot" class="time-slot-arrow">
            <img src="{{ asset('images/images/leftarrow_days.svg') }}" alt="" width="16" height="16">
        </button>
        <div id="timeSlotGrid" class="time-slots-container"></div>
        <button type="button" id="nextTimeSlot" class="time-slot-arrow">
            <img src="{{ asset('images/images/rightarrow_days.svg') }}" alt="" width="16" height="16">
        </button>
    </div>

    {{-- Mobile Time Slots Container (vertical layout, hidden initially) --}}
    <div id="mobileTimeSlotsContainer" class="mobile-time-slots-container" style="display: none;"></div>
</div>
