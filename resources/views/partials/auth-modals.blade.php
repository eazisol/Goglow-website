<!-- Login Options Modal -->
<div class="modal fade" id="loginOptionsModal" tabindex="-1" aria-labelledby="loginOptionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content login-options-modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="login-options-container">
                    <!-- Logo/Icon Area -->
                    <div class="login-options-logo">
                        <div class="logo-circle">
                            <img src="{{ asset('images/loginuplogo.png') }}" alt="Logo">
                        </div>
                    </div>
                    
                    <!-- Title -->
                    <h2 class="login-options-title">{{ __('app.auth.login_to_glaura') ?? 'Login to Glaura' }}</h2>
                    
                    <!-- Description -->
                    <p class="login-options-description">
                        {{ __('app.auth.login_options_desc') ?? 'Manage your account, book salon services, chat, comment, follow and more.' }}
                    </p>
                    
                    <!-- Login Option Buttons -->
                    <div class="login-options-buttons">
                        <!-- Google Button -->
                        <button type="button" class="login-option-btn google-option-btn" id="login-options-google-btn">
                            <span class="option-icon">
                                <svg viewBox="0 0 24 24" width="22" height="22">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                </svg>
                            </span>
                            <span class="option-text">{{ __('app.auth.continue_with_google') ?? 'Continue with Google' }}</span>
                        </button>
                        
                        <!-- Apple Button -->
                        <button type="button" class="login-option-btn apple-option-btn" id="login-options-apple-btn">
                            <span class="option-icon">
                                <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor">
                                    <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                                </svg>
                            </span>
                            <span class="option-text">{{ __('app.auth.continue_with_apple') ?? 'Continue with Apple' }}</span>
                        </button>
                        
                        <!-- Divider -->
                        <div class="login-options-divider">
                            <span>{{ __('app.auth.or') ?? 'or' }}</span>
                        </div>
                        
                        <!-- Email/Password Button -->
                        <button type="button" class="login-option-btn email-option-btn" id="login-options-email-btn">
                            <span class="option-icon">
                                <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </span>
                            <span class="option-text">{{ __('app.auth.use_email_password') ?? 'Use username/email & password' }}</span>
                        </button>
                    </div>
                    
                    <!-- Sign Up Link -->
                    <p class="login-options-signup">
                        {{ __('app.auth.dont_have_account') ?? "Don't have an account?" }} 
                        <a href="#" id="login-options-show-signup">{{ __('app.auth.create_one') ?? 'Create one' }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

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
                                
                                <div class="text-center">
                                    <span style="color: #999;">{{ __('app.auth.or') }}</span>
                                </div>
                                
                                <div class="social-login-buttons">
                                    <button type="button" class="btn-social btn-google" id="google-signin-btn" title="{{ __('app.auth.sign_in_with_google') }}">
                                        <i class="fab fa-google"></i>
                                    </button>
                                    <button type="button" class="btn-social btn-apple" id="apple-signin-btn" title="{{ __('app.auth.sign_in_with_apple') }}">
                                        <i class="fab fa-apple"></i>
                                    </button>
                                </div>
                                
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
                                
                                <div class="text-center my-3">
                                    <span style="color: #999;">{{ __('app.auth.or') }}</span>
                                </div>
                                
                                <div class="social-login-buttons">
                                    <button type="button" class="btn-social btn-google" id="google-signup-btn" title="{{ __('app.auth.sign_up_with_google') }}">
                                        <i class="fab fa-google"></i>
                                    </button>
                                    <button type="button" class="btn-social btn-apple" id="apple-signup-btn" title="{{ __('app.auth.sign_up_with_apple') }}">
                                        <i class="fab fa-apple"></i>
                                    </button>
                                </div>
                                
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

<!-- OAuth Success Loader Overlay -->
<div id="oauth-success-loader" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.8); z-index: 9999; align-items: center; justify-content: center; flex-direction: column;">
    <div style="background: white; padding: 40px; border-radius: 12px; text-align: center; max-width: 400px; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
        <div style="margin-bottom: 20px;">
            <div class="spinner-border text-primary" role="status" style="width: 50px; height: 50px;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <h4 style="color: #333; margin-bottom: 10px; font-weight: 600;">{{ __('app.auth.login_successful') ?: 'Login Successful!' }}</h4>
        <p style="color: #666; margin: 0;">{{ __('app.auth.redirecting') ?: 'Redirecting...' }}</p>
    </div>
</div>

<script>
  // OAuth button handlers - embedded directly in template to ensure they work
  (function() {
    function setupOAuthHandlers() {
      
      // Google Sign-In button (Login)
      const googleSigninBtn = document.getElementById('google-signin-btn');
      if (googleSigninBtn) {
        // Remove any existing listeners by cloning
        const newBtn = googleSigninBtn.cloneNode(true);
        googleSigninBtn.parentNode.replaceChild(newBtn, googleSigninBtn);
        
        newBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          
          if (!window.firebaseAuth || typeof firebase === 'undefined') {
            console.error('Firebase not available');
            alert('Firebase not initialized. Please refresh.');
            return;
          }
          
          const provider = new firebase.auth.GoogleAuthProvider();
          window.firebaseAuth.signInWithPopup(provider)
            .then(function(result) {
              return result.user.getIdToken();
            })
            .then(function(idToken) {
              const csrfToken = document.querySelector('meta[name="csrf-token"]');
              return fetch('/ajax/oauth-login', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({ idToken: idToken, isSignup: false })
              });
            })
            .then(function(response) {
              return response.json();
            })
            .then(function(data) {
              if (data.success) {
                // Show success loader
                const loader = document.getElementById('oauth-success-loader');
                if (loader) {
                  loader.style.display = 'flex';
                }
                
                // Close modals
                const loginModalEl = document.getElementById('loginModal');
                if (loginModalEl && typeof bootstrap !== 'undefined') {
                  const bsModal = bootstrap.Modal.getInstance(loginModalEl);
                  if (bsModal) bsModal.hide();
                }
                
                window.isAuthenticated = true;
                const storedUrl = localStorage.getItem('book_appointment_url');
                localStorage.removeItem('book_appointment_url');
                
                // Redirect after a short delay to show the success message
                setTimeout(function() {
                  window.location.href = storedUrl || data.redirect || '/';
                }, 1500);
              } else {
                throw new Error(data.message || 'Authentication failed');
              }
            })
            .catch(function(error) {
              console.error('Google sign-in error:', error);
              const errorEl = document.getElementById('login-error');
              if (errorEl) {
                errorEl.textContent = error.message || 'Google sign-in failed';
                errorEl.classList.remove('d-none');
              } else {
                alert('Google sign-in failed: ' + (error.message || 'Unknown error'));
              }
            });
        });
      }
      
      // Apple Sign-In button (Login)
      const appleSigninBtn = document.getElementById('apple-signin-btn');
      if (appleSigninBtn) {
        const newBtn = appleSigninBtn.cloneNode(true);
        appleSigninBtn.parentNode.replaceChild(newBtn, appleSigninBtn);
        
        newBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          
          if (!window.firebaseAuth || typeof firebase === 'undefined') {
            console.error('Firebase not available');
            alert('Firebase not initialized. Please refresh.');
            return;
          }
          
          const provider = new firebase.auth.OAuthProvider('apple.com');
          window.firebaseAuth.signInWithPopup(provider)
            .then(function(result) {
              return result.user.getIdToken();
            })
            .then(function(idToken) {
              const csrfToken = document.querySelector('meta[name="csrf-token"]');
              return fetch('/ajax/oauth-login', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({ idToken: idToken, isSignup: false })
              });
            })
            .then(function(response) {
              return response.json();
            })
            .then(function(data) {
              if (data.success) {
                // Show success loader
                const loader = document.getElementById('oauth-success-loader');
                if (loader) {
                  loader.style.display = 'flex';
                }
                
                // Close modals
                const loginModalEl = document.getElementById('loginModal');
                if (loginModalEl && typeof bootstrap !== 'undefined') {
                  const bsModal = bootstrap.Modal.getInstance(loginModalEl);
                  if (bsModal) bsModal.hide();
                }
                
                window.isAuthenticated = true;
                const storedUrl = localStorage.getItem('book_appointment_url');
                localStorage.removeItem('book_appointment_url');
                
                // Redirect after a short delay to show the success message
                setTimeout(function() {
                  window.location.href = storedUrl || data.redirect || '/';
                }, 1500);
              } else {
                throw new Error(data.message || 'Authentication failed');
              }
            })
            .catch(function(error) {
              console.error('Apple sign-in error:', error);
              const errorEl = document.getElementById('login-error');
              if (errorEl) {
                errorEl.textContent = error.message || 'Apple sign-in failed';
                errorEl.classList.remove('d-none');
              } else {
                alert('Apple sign-in failed: ' + (error.message || 'Unknown error'));
              }
            });
        });
      }
      
      // Google Sign-Up button
      const googleSignupBtn = document.getElementById('google-signup-btn');
      if (googleSignupBtn) {
        const newBtn = googleSignupBtn.cloneNode(true);
        googleSignupBtn.parentNode.replaceChild(newBtn, googleSignupBtn);
        
        newBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          
          if (!window.firebaseAuth || typeof firebase === 'undefined') {
            console.error('Firebase not available');
            alert('Firebase not initialized. Please refresh.');
            return;
          }
          
          const provider = new firebase.auth.GoogleAuthProvider();
          window.firebaseAuth.signInWithPopup(provider)
            .then(function(result) {
              return result.user.getIdToken();
            })
            .then(function(idToken) {
              const csrfToken = document.querySelector('meta[name="csrf-token"]');
              return fetch('/ajax/oauth-login', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({ idToken: idToken, isSignup: true })
              });
            })
            .then(function(response) {
              return response.json();
            })
            .then(function(data) {
              if (data.success) {
                // Show success loader
                const loader = document.getElementById('oauth-success-loader');
                if (loader) {
                  loader.style.display = 'flex';
                }
                
                // Close modals
                const loginModalEl = document.getElementById('loginModal');
                if (loginModalEl && typeof bootstrap !== 'undefined') {
                  const bsModal = bootstrap.Modal.getInstance(loginModalEl);
                  if (bsModal) bsModal.hide();
                }
                
                window.isAuthenticated = true;
                const storedUrl = localStorage.getItem('book_appointment_url');
                localStorage.removeItem('book_appointment_url');
                
                // Redirect after a short delay to show the success message
                setTimeout(function() {
                  window.location.href = storedUrl || data.redirect || '/';
                }, 1500);
              } else {
                throw new Error(data.message || 'Authentication failed');
              }
            })
            .catch(function(error) {
              console.error('Google sign-up error:', error);
              const errorEl = document.getElementById('signup-error');
              if (errorEl) {
                errorEl.textContent = error.message || 'Google sign-up failed';
                errorEl.classList.remove('d-none');
              } else {
                alert('Google sign-up failed: ' + (error.message || 'Unknown error'));
              }
            });
        });
      }
      
      // Apple Sign-Up button
      const appleSignupBtn = document.getElementById('apple-signup-btn');
      if (appleSignupBtn) {
        const newBtn = appleSignupBtn.cloneNode(true);
        appleSignupBtn.parentNode.replaceChild(newBtn, appleSignupBtn);
        
        newBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          
          if (!window.firebaseAuth || typeof firebase === 'undefined') {
            console.error('Firebase not available');
            alert('Firebase not initialized. Please refresh.');
            return;
          }
          
          const provider = new firebase.auth.OAuthProvider('apple.com');
          window.firebaseAuth.signInWithPopup(provider)
            .then(function(result) {
              return result.user.getIdToken();
            })
            .then(function(idToken) {
              const csrfToken = document.querySelector('meta[name="csrf-token"]');
              return fetch('/ajax/oauth-login', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({ idToken: idToken, isSignup: true })
              });
            })
            .then(function(response) {
              return response.json();
            })
            .then(function(data) {
              if (data.success) {
                // Show success loader
                const loader = document.getElementById('oauth-success-loader');
                if (loader) {
                  loader.style.display = 'flex';
                }
                
                // Close modals
                const loginModalEl = document.getElementById('loginModal');
                if (loginModalEl && typeof bootstrap !== 'undefined') {
                  const bsModal = bootstrap.Modal.getInstance(loginModalEl);
                  if (bsModal) bsModal.hide();
                }
                
                window.isAuthenticated = true;
                const storedUrl = localStorage.getItem('book_appointment_url');
                localStorage.removeItem('book_appointment_url');
                
                // Redirect after a short delay to show the success message
                setTimeout(function() {
                  window.location.href = storedUrl || data.redirect || '/';
                }, 1500);
              } else {
                throw new Error(data.message || 'Authentication failed');
              }
            })
            .catch(function(error) {
              console.error('Apple sign-up error:', error);
              const errorEl = document.getElementById('signup-error');
              if (errorEl) {
                errorEl.textContent = error.message || 'Apple sign-up failed';
                errorEl.classList.remove('d-none');
              } else {
                alert('Apple sign-up failed: ' + (error.message || 'Unknown error'));
              }
            });
        });
      }
    }
    
    // Try immediately if DOM is ready
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', setupOAuthHandlers);
    } else {
      setupOAuthHandlers();
    }
    
    // Also try after delays as backup
    setTimeout(setupOAuthHandlers, 100);
    setTimeout(setupOAuthHandlers, 500);
    setTimeout(setupOAuthHandlers, 1000);
    
    // ========================================
    // Login Options Modal Handlers
    // ========================================
    function setupLoginOptionsHandlers() {
      // Google button in Login Options Modal
      const googleOptionsBtn = document.getElementById('login-options-google-btn');
      if (googleOptionsBtn) {
        const newBtn = googleOptionsBtn.cloneNode(true);
        googleOptionsBtn.parentNode.replaceChild(newBtn, googleOptionsBtn);
        
        newBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          
          if (!window.firebaseAuth || typeof firebase === 'undefined') {
            console.error('Firebase not available');
            alert('Firebase not initialized. Please refresh.');
            return;
          }
          
          // Close the login options modal
          const loginOptionsModal = document.getElementById('loginOptionsModal');
          if (loginOptionsModal && typeof bootstrap !== 'undefined') {
            const bsModal = bootstrap.Modal.getInstance(loginOptionsModal);
            if (bsModal) bsModal.hide();
          }
          
          const provider = new firebase.auth.GoogleAuthProvider();
          window.firebaseAuth.signInWithPopup(provider)
            .then(function(result) {
              return result.user.getIdToken();
            })
            .then(function(idToken) {
              const csrfToken = document.querySelector('meta[name="csrf-token"]');
              return fetch('/ajax/oauth-login', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({ idToken: idToken, isSignup: false })
              });
            })
            .then(function(response) {
              return response.json();
            })
            .then(function(data) {
              if (data.success) {
                // Show success loader
                const loader = document.getElementById('oauth-success-loader');
                if (loader) {
                  loader.style.display = 'flex';
                }
                
                window.isAuthenticated = true;
                const storedUrl = localStorage.getItem('book_appointment_url');
                localStorage.removeItem('book_appointment_url');
                
                setTimeout(function() {
                  window.location.href = storedUrl || data.redirect || '/';
                }, 1500);
              } else {
                throw new Error(data.message || 'Authentication failed');
              }
            })
            .catch(function(error) {
              console.error('Google sign-in error:', error);
              alert('Google sign-in failed: ' + (error.message || 'Unknown error'));
            });
        });
      }
      
      // Apple button in Login Options Modal
      const appleOptionsBtn = document.getElementById('login-options-apple-btn');
      if (appleOptionsBtn) {
        const newBtn = appleOptionsBtn.cloneNode(true);
        appleOptionsBtn.parentNode.replaceChild(newBtn, appleOptionsBtn);
        
        newBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          
          if (!window.firebaseAuth || typeof firebase === 'undefined') {
            console.error('Firebase not available');
            alert('Firebase not initialized. Please refresh.');
            return;
          }
          
          // Close the login options modal
          const loginOptionsModal = document.getElementById('loginOptionsModal');
          if (loginOptionsModal && typeof bootstrap !== 'undefined') {
            const bsModal = bootstrap.Modal.getInstance(loginOptionsModal);
            if (bsModal) bsModal.hide();
          }
          
          const provider = new firebase.auth.OAuthProvider('apple.com');
          window.firebaseAuth.signInWithPopup(provider)
            .then(function(result) {
              return result.user.getIdToken();
            })
            .then(function(idToken) {
              const csrfToken = document.querySelector('meta[name="csrf-token"]');
              return fetch('/ajax/oauth-login', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({ idToken: idToken, isSignup: false })
              });
            })
            .then(function(response) {
              return response.json();
            })
            .then(function(data) {
              if (data.success) {
                // Show success loader
                const loader = document.getElementById('oauth-success-loader');
                if (loader) {
                  loader.style.display = 'flex';
                }
                
                window.isAuthenticated = true;
                const storedUrl = localStorage.getItem('book_appointment_url');
                localStorage.removeItem('book_appointment_url');
                
                setTimeout(function() {
                  window.location.href = storedUrl || data.redirect || '/';
                }, 1500);
              } else {
                throw new Error(data.message || 'Authentication failed');
              }
            })
            .catch(function(error) {
              console.error('Apple sign-in error:', error);
              alert('Apple sign-in failed: ' + (error.message || 'Unknown error'));
            });
        });
      }
      
      // Email/Password button - opens the traditional login modal
      const emailOptionsBtn = document.getElementById('login-options-email-btn');
      if (emailOptionsBtn) {
        const newBtn = emailOptionsBtn.cloneNode(true);
        emailOptionsBtn.parentNode.replaceChild(newBtn, emailOptionsBtn);
        
        newBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          
          // Close the login options modal
          const loginOptionsModal = document.getElementById('loginOptionsModal');
          if (loginOptionsModal && typeof bootstrap !== 'undefined') {
            const bsModal = bootstrap.Modal.getInstance(loginOptionsModal);
            if (bsModal) {
              bsModal.hide();
            }
          }
          
          // Wait for modal to close, then show login modal
          setTimeout(function() {
            const loginModal = document.getElementById('loginModal');
            if (loginModal && typeof bootstrap !== 'undefined') {
              const modal = new bootstrap.Modal(loginModal);
              modal.show();
            }
          }, 300);
        });
      }
      
      // Create One (signup) link in Login Options Modal
      const signupOptionsLink = document.getElementById('login-options-show-signup');
      if (signupOptionsLink) {
        const newLink = signupOptionsLink.cloneNode(true);
        signupOptionsLink.parentNode.replaceChild(newLink, signupOptionsLink);
        
        newLink.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          
          // Close the login options modal
          const loginOptionsModal = document.getElementById('loginOptionsModal');
          if (loginOptionsModal && typeof bootstrap !== 'undefined') {
            const bsModal = bootstrap.Modal.getInstance(loginOptionsModal);
            if (bsModal) {
              bsModal.hide();
            }
          }
          
          // Wait for modal to close, then show signup modal
          setTimeout(function() {
            const signupModal = document.getElementById('signupModal');
            if (signupModal && typeof bootstrap !== 'undefined') {
              const modal = new bootstrap.Modal(signupModal);
              modal.show();
            }
          }, 300);
        });
      }
    }
    
    // Set up Login Options handlers
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', setupLoginOptionsHandlers);
    } else {
      setupLoginOptionsHandlers();
    }
    
    // Also try after delays as backup
    setTimeout(setupLoginOptionsHandlers, 100);
    setTimeout(setupLoginOptionsHandlers, 500);
    setTimeout(setupLoginOptionsHandlers, 1000);
  })();
</script>
