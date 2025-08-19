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
                        <h3 class="wow fadeInUp">welcome</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Sign in</h2>
                    </div>
                    
                    <div class="alert alert-danger d-none" id="login-error"></div>
                    <div class="alert alert-success d-none" id="login-success"></div>
                    
                    <form id="loginForm" method="POST" data-toggle="validator">
                        @csrf
                        <input type="hidden" name="redirect" id="login-redirect" value="">
                        <div class="row">
                            <div class="form-group col-md-12 mb-4">
                                <input type="email" name="email" class="form-control" id="login-email" placeholder="Email Address" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            
                            <div class="form-group col-md-12 mb-4">
                                <input type="password" name="password" class="form-control" id="login-password" placeholder="Password" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn-default"><span>Sign in</span></button>
                                <div id="msgSubmit" class="h3 hidden"></div>
                                <p class="mt-3 mb-0" style="text-align: center;">No account? <a href="#" id="show-signup-modal">Create one</a></p>
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
                        <h3 class="wow fadeInUp">Create Account</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Join</h2>
                        <p class="small-text">Sign up to book beauty services, track appointments, and enjoy member perks.</p>
                    </div>
                    
                    <div class="alert alert-danger d-none" id="signup-error"></div>
                    <div class="alert alert-success d-none" id="signup-success"></div>
                    
                    <form id="signupForm" method="POST" data-toggle="validator">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 mb-4">
                                <input type="text" name="name" class="form-control" id="signup-name" placeholder="Full Name" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            
                            <div class="form-group col-md-6 mb-4">
                                <input type="email" name="email" class="form-control" id="signup-email" placeholder="Email Address" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <input type="text" name="phone" class="form-control" id="signup-phone" placeholder="Phone Number (with country code)" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <input type="text" name="location" class="form-control" id="signup-location" placeholder="Location (City, Country)" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <div class="input-group">
                                    <input type="password" name="password" id="signup-password" class="form-control" placeholder="Password (at least 6 characters)" required minlength="6">
                                    <span class="input-group-text password-toggle" onclick="togglePassword('signup-password')">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <input type="password" name="password_confirmation" id="signup-password-confirmation" class="form-control" placeholder="Confirm Password" required minlength="6">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-md-12 mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="signup-terms" name="terms" required>
                                    <label class="form-check-label" for="signup-terms">
                                        I agree to the <a href="{{ url('/terms_condition') }}" target="_blank" class="policy-link">Terms</a> and <a href="{{ url('/privacy_policy') }}" target="_blank" class="policy-link">Privacy Policy</a>
                                    </label>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn-default"><span>Create account</span></button>
                                <div id="msgSubmit" class="h3 hidden"></div>
                                <p class="mt-3 mb-0" style="text-align: center;">Already have an account? <a href="#" id="show-login-modal">Login</a></p>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Signup Form End -->
            </div>
        </div>
    </div>
</div>
