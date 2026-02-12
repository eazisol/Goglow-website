@extends('layouts.main')
{{-- Title --}}
@section('title', __('app.auth.login'))

{{-- Style Files --}}
@section('styles')
<style>
    .form-label { font-weight: 500; color: #333; margin-bottom: 8px; display: block; }
    .input-group-text { background: #fff; }
    .password-toggle { cursor: pointer; }
</style>
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
	
	<!-- Login Section Start -->
    <div class="page-book-appointment">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Login image Start -->
                    <div class="appointment-image">
                        <figure class="image-anime reveal">
                            <img src="{{ asset('images/hayley-kim-studios-sRSRuxkOuzI-unsplash.jpg') }}" alt="{{ __('app.auth.login') }}">
                        </figure>
                    </div>
                    <!-- Login image End -->
                </div>

                <div class="col-lg-6">
                    <!-- Login Form Start -->
                    <div class="appointment-form wow fadeInUp" data-wow-delay="0.2s">
                        <div class="section-title mb-4">
                            <h3 class="wow fadeInUp">{{ __('app.auth.welcome_back') }}</h3>
                            <h2 class="text-anime-style-2" >{{ __('app.auth.sign_in_to') }} <span>Glaura</span></h2>
                        </div>
                        
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('login.store') }}" data-toggle="validator">
                            @csrf
                            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
                            <div class="row">
                                <div class="form-group col-md-12 mb-4">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="{{ __('app.auth.email') }}" value="{{ old('email') }}" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-12 mb-4">
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" id="password" placeholder="{{ __('app.auth.password') }}" required>
                                        <span class="input-group-text password-toggle" onclick="togglePassword('password')">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn-default"><span>{{ __('app.auth.sign_in') }}</span></button>
                                    <div id="msgSubmit" class="h3 hidden"></div>

                                    <div class="text-center my-3">
                                        <span style="color: #999;">{{ __('app.auth.or') }}</span>
                                    </div>

                                    <div class="social-login-buttons" style="justify-content: center;">
                                        <button type="button" class="btn-social btn-phone" id="standalone-phone-signin-btn" title="{{ __('app.auth.sign_in_with_phone') }}">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                    </div>

                                    <p class="mt-3 mb-0">{{ __('app.auth.dont_have_account') }} <a href="{{ route('signup') }}">{{ __('app.auth.create_one') }}</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Login Form End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Login Section End -->
@endsection

@section('scripts')
<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const toggleSpan = input.parentElement.querySelector('.password-toggle');
    const icon = toggleSpan ? toggleSpan.querySelector('i') : null;

    if (input.type === 'password') {
        input.type = 'text';
        if (icon) {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    } else {
        input.type = 'password';
        if (icon) {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
}
</script>
@endsection


