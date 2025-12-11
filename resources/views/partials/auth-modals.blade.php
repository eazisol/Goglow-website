<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Login Form Start -->
                <div class="appointment-form">
                    <div class="section-title mb-4">
                        <h3 class="wow fadeInUp">{{ __('app.auth.welcome_simple') }}</h3>
                        <h2 class="text-anime-style-2" >{{ __('app.auth.sign_in_header') }}</h2>
                    </div>
                    
                    <div class="alert alert-danger d-none" id="login-error"></div>
                    <div class="alert alert-success d-none" id="login-success"></div>
                    
                    <form id="loginForm" method="POST" data-toggle="validator">
                        @csrf
                        <input type="hidden" name="redirect" id="login-redirect" value="">
                        <div class="row">
                            <div class="form-group col-md-12 mb-4">
                                <input type="email" name="email" class="form-control-login" id="login-email" placeholder="{{ __('app.auth.email') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            
                            <div class="form-group col-md-12 mb-4">
                                <input type="password" name="password" class="form-control-login" id="login-password" placeholder="{{ __('app.auth.password') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn-default" id="login-submit-btn">
                                    <span id="login-btn-text">{{ __('app.auth.sign_in') }}</span>
                                    <span id="login-btn-loader" class="login-loader" style="display: none;">
                                        <i class="fa fa-spinner fa-spin"></i> {{ __('app.auth.processing') }}
                                    </span>
                                </button>
                                <div id="msgSubmit" class="h3 hidden"></div>
                                <p class="mt-3 mb-0" style="text-align: center;">{{ __('app.auth.dont_have_account') }} <a href="#" id="show-signup-modal">{{ __('app.auth.create_one') }}</a></p>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Login Form End -->
            </div>
        </div>
    </div>
</div>

<!-- Signup Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Signup Form Start -->
                <div class="appointment-form">
                    <div class="section-title mb-4">
                        <h3 class="wow fadeInUp">{{ __('app.auth.create_account') }}</h3>
                        <h2 class="text-anime-style-2" >{{ __('app.auth.join') }}</h2>
                        <p class="small-text">{{ __('app.auth.signup_description') }}</p>
                    </div>
                    
                    <div class="alert alert-danger d-none" id="signup-error"></div>
                    <div class="alert alert-success d-none" id="signup-success"></div>
                    
                    <form id="signupForm" method="POST" data-toggle="validator">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 mb-4">
                                <input type="text" name="name" class="form-control-login" id="signup-name" placeholder="{{ __('app.auth.full_name') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            
                            <div class="form-group col-md-6 mb-4">
                                <input type="email" name="email" class="form-control-login" id="signup-email" placeholder="{{ __('app.auth.email') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <div class="input-group">
                                    <input type="password" name="password" id="signup-password" class="form-control-login" placeholder="{{ __('app.auth.password_min_chars') }}" required minlength="6">
                                    <span class="input-group-text password-toggle" onclick="togglePassword('signup-password')">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <input type="password" name="password_confirmation" id="signup-password-confirmation" class="form-control-login" placeholder="{{ __('app.auth.confirm_password') }}" required minlength="6">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-md-12 mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="signup-terms" name="terms" required>
                                    <label class="form-check-label" for="signup-terms">
                                        {{ __('app.auth.i_agree_to') }} <a href="{{ url('/terms_condition') }}" target="_blank" class="policy-link">{{ __('app.auth.terms') }}</a> {{ __('app.auth.and') }} <a href="{{ url('/privacy_policy') }}" target="_blank" class="policy-link">{{ __('app.auth.privacy_policy') }}</a>
                                    </label>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn-default" id="signup-submit-btn">
                                    <span id="signup-btn-text">{{ __('app.auth.create_account') }}</span>
                                    <span id="signup-btn-loader" class="signup-loader" style="display: none;">
                                        <i class="fa fa-spinner fa-spin"></i> {{ __('app.auth.processing') }}
                                    </span>
                                </button>
                                <div id="msgSubmit" class="h3 hidden"></div>
                                <p class="mt-3 mb-0" style="text-align: center;">{{ __('app.auth.already_have_account') }} <a href="#" id="show-login-modal">{{ __('app.auth.login') }}</a></p>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Signup Form End -->
            </div>
        </div>
    </div>
</div>
