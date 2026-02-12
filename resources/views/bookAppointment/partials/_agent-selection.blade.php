{{-- Agent Selection (same radio-button grid on all viewports) --}}
@if(!empty($agents))
<div class="mt-4 agent-scheduled-ui">
    <label class="form-label" style="justify-content: center;display: flex;">{{ __('app.agent_page.choose_with_whom') }}</label>
    <div id="agentList" class="agent-selection-grid" role="radiogroup" aria-label="{{ __('app.agent_page.choose_with_whom') }}">
        {{-- "Sans preference" option - default selected --}}
        <div class="agent-option active" tabindex="0" role="radio" aria-checked="true" data-agent='{"id": "no_preference", "name": "{{ __('app.agent_page.no_preference') }}"}' data-no-preference="true">
            <div class="agent-option-radio"></div>
            <div class="agent-option-label">{{ __('app.agent_page.no_preference') }}</div>
        </div>
        @foreach($agents as $index => $agent)
            <div class="agent-option{{ $index >= 4 ? ' agent-hidden' : '' }}" tabindex="0" role="radio" aria-checked="false" data-agent='@json($agent)'>
                <div class="agent-option-radio"></div>
                <div class="agent-option-label">{{ $agent['name'] ?? 'Agent' }}</div>
            </div>
        @endforeach
        @if(count($agents) > 4)
            <div class="agent-option agent-see-more" id="agentSeeMoreBtn">
                <div class="agent-option-label">+{{ count($agents) - 4 }} {{ __('app.agent_page.more') }}</div>
            </div>
        @endif
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
