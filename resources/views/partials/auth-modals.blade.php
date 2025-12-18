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
  })();
</script>
