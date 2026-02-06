{{-- Agent Selection (Desktop Grid + Mobile Dropdown) --}}
@if(!empty($agents))
<div class="mt-4 agent-scheduled-ui">
    {{-- Desktop: Grid layout --}}
    <label class="form-label desktop-only" style="justify-content: center;display: flex;">{{ __('app.agent_page.choose_with_whom') }}</label>
    <div id="agentList" class="agent-selection-grid desktop-only" role="radiogroup" aria-label="{{ __('app.agent_page.choose_with_whom') }}">
        {{-- "Sans preference" option - default selected --}}
        <div class="agent-option active" tabindex="0" role="radio" aria-checked="true" data-agent='{"id": "no_preference", "name": "{{ __('app.agent_page.no_preference') }}"}' data-no-preference="true">
            <div class="agent-option-radio"></div>
            <div class="agent-option-label">{{ __('app.agent_page.no_preference') }}</div>
        </div>
        @foreach($agents as $index => $agent)
            <div class="agent-option{{ $index >= 7 ? ' agent-hidden' : '' }}" tabindex="0" role="radio" aria-checked="false" data-agent='@json($agent)'>
                <div class="agent-option-radio"></div>
                <div class="agent-option-label">{{ $agent['name'] ?? 'Agent' }}</div>
            </div>
        @endforeach
        @if(count($agents) > 7)
            <div class="agent-option agent-see-more" id="agentSeeMoreBtn">
                <div class="agent-option-label">+{{ count($agents) - 7 }} {{ __('app.agent_page.more') }}</div>
            </div>
        @endif
    </div>

    {{-- Mobile: Dropdown layout --}}
    <div class="agent-dropdown-wrapper mobile-only">
        <div class="agent-dropdown" id="agentDropdown">
            <div class="agent-dropdown-selected" id="agentDropdownSelected">
                <span class="agent-dropdown-text">{{ __('app.agent_page.choose_with_whom') }}</span>
                <svg class="agent-dropdown-chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </div>
            <div class="agent-dropdown-options" id="agentDropdownOptions">
                <div class="agent-dropdown-option active" data-agent='{"id": "no_preference", "name": "{{ __('app.agent_page.no_preference') }}"}' data-no-preference="true">
                    {{ __('app.agent_page.no_preference') }}
                </div>
                @foreach($agents as $agent)
                    <div class="agent-dropdown-option" data-agent='@json($agent)'>
                        {{ $agent['name'] ?? 'Agent' }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Include calendar section --}}
    @include('bookAppointment.partials._calendar')
</div>
@else
<div class="mt-4 text-center">
    <div class="alert alert-info">
        {{ __('app.agent_page.no_agent_assigned') }}
    </div>
</div>
@endif
