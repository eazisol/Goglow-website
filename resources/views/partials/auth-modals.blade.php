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
                    <!-- Logo/Icon Area -->
                    <div class="login-options-logo">
                        <div class="logo-circle">
                            <img src="{{ asset('images/loginuplogo.png') }}" alt="Logo">
                        </div>
                    </div>
                    
                    <div class="section-title mb-4">
                        {{-- <h3 class="wow fadeInUp">{{ __('app.auth.welcome_simple') }}</h3> --}}
                        <h2 class="text-anime-style-2" >{{ __('app.auth.sign_in_header') }}</h2>
                    </div>
                    
                    <div class="social-login-buttons mb-4">
                        <button type="button" class="btn-social btn-google" id="google-signin-btn" title="{{ __('app.auth.sign_in_with_google') }}">
                            <i class="fab fa-google"></i>
                        </button>
                        <button type="button" class="btn-social btn-apple" id="apple-signin-btn" title="{{ __('app.auth.sign_in_with_apple') }}">
                            <i class="fab fa-apple"></i>
                        </button>
                    </div>
                    
                    <div class="text-center mb-3">
                        <span style="color: #999;">{{ __('app.auth.or') }}</span>
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
                                <div class="input-group" >
                                    <input type="password" name="password" class="form-control-login" id="login-password" placeholder="{{ __('app.auth.password') }}" required>
                                    <span class="input-group-text password-toggle" onclick="togglePassword('login-password')">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
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
                                <input type="text" name="first_name" class="form-control-login" id="signup-first-name" placeholder="{{ __('app.auth.first_name') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            
                            <div class="form-group col-md-6 mb-4">
                                <input type="text" name="last_name" class="form-control-login" id="signup-last-name" placeholder="{{ __('app.auth.last_name') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            
                            <div class="form-group col-md-6 mb-4">
                                <input type="email" name="email" class="form-control-login" id="signup-email" placeholder="{{ __('app.auth.email') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <div class="phone-input-group">
                                    <select name="country_code" class="form-control-login country-code-select" id="signup-country-code" required data-initialized="false">
                                        <option value="">{{ __('app.auth.select_country') }}</option>
                                    </select>
                                    
                                    <input type="tel" name="phone" class="form-control-login phone-input" id="signup-phone" placeholder="{{ __('app.auth.phone') }}" required minlength="9" maxlength="9" pattern="[0-9]{9}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);">
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                            
                            <script>
                            // Inline country data and initialization - embedded directly to ensure it works
                            (function() {
                                // Function to get flag emoji from country code
                                function getCountryFlag(code) {
                                    const flagMap = {
                                        'US': '🇺🇸', 'GB': '🇬🇧', 'CA': '🇨🇦', 'AU': '🇦🇺', 'DE': '🇩🇪',
                                        'FR': '🇫🇷', 'IT': '🇮🇹', 'ES': '🇪🇸', 'NL': '🇳🇱', 'BE': '🇧🇪',
                                        'CH': '🇨🇭', 'AT': '🇦🇹', 'SE': '🇸🇪', 'NO': '🇳🇴', 'DK': '🇩🇰',
                                        'FI': '🇫🇮', 'PL': '🇵🇱', 'PT': '🇵🇹', 'GR': '🇬🇷', 'IE': '🇮🇪',
                                        'NZ': '🇳🇿', 'JP': '🇯🇵', 'KR': '🇰🇷', 'CN': '🇨🇳', 'IN': '🇮🇳',
                                        'BR': '🇧🇷', 'MX': '🇲🇽', 'AR': '🇦🇷', 'ZA': '🇿🇦', 'AE': '🇦🇪',
                                        'SA': '🇸🇦', 'EG': '🇪🇬', 'NG': '🇳🇬', 'KE': '🇰🇪', 'GH': '🇬🇭',
                                        'MA': '🇲🇦', 'TN': '🇹🇳', 'DZ': '🇩🇿', 'TR': '🇹🇷', 'IL': '🇮🇱',
                                        'RU': '🇷🇺', 'UA': '🇺🇦', 'PK': '🇵🇰', 'BD': '🇧🇩', 'PH': '🇵🇭',
                                        'TH': '🇹🇭', 'VN': '🇻🇳', 'ID': '🇮🇩', 'MY': '🇲🇾', 'SG': '🇸🇬',
                                        'HK': '🇭🇰', 'TW': '🇹🇼'
                                    };
                                    return flagMap[code] || '🏳️';
                                }
                                
                                // Country list embedded directly
                                const countryList = [
                                    {code: 'US', name: 'United States', prefix: '+1'},
                                    {code: 'GB', name: 'United Kingdom', prefix: '+44'},
                                    {code: 'CA', name: 'Canada', prefix: '+1'},
                                    {code: 'AU', name: 'Australia', prefix: '+61'},
                                    {code: 'DE', name: 'Germany', prefix: '+49'},
                                    {code: 'FR', name: 'France', prefix: '+33'},
                                    {code: 'IT', name: 'Italy', prefix: '+39'},
                                    {code: 'ES', name: 'Spain', prefix: '+34'},
                                    {code: 'NL', name: 'Netherlands', prefix: '+31'},
                                    {code: 'BE', name: 'Belgium', prefix: '+32'},
                                    {code: 'CH', name: 'Switzerland', prefix: '+41'},
                                    {code: 'AT', name: 'Austria', prefix: '+43'},
                                    {code: 'SE', name: 'Sweden', prefix: '+46'},
                                    {code: 'NO', name: 'Norway', prefix: '+47'},
                                    {code: 'DK', name: 'Denmark', prefix: '+45'},
                                    {code: 'FI', name: 'Finland', prefix: '+358'},
                                    {code: 'PL', name: 'Poland', prefix: '+48'},
                                    {code: 'PT', name: 'Portugal', prefix: '+351'},
                                    {code: 'GR', name: 'Greece', prefix: '+30'},
                                    {code: 'IE', name: 'Ireland', prefix: '+353'},
                                    {code: 'NZ', name: 'New Zealand', prefix: '+64'},
                                    {code: 'JP', name: 'Japan', prefix: '+81'},
                                    {code: 'KR', name: 'South Korea', prefix: '+82'},
                                    {code: 'CN', name: 'China', prefix: '+86'},
                                    {code: 'IN', name: 'India', prefix: '+91'},
                                    {code: 'BR', name: 'Brazil', prefix: '+55'},
                                    {code: 'MX', name: 'Mexico', prefix: '+52'},
                                    {code: 'AR', name: 'Argentina', prefix: '+54'},
                                    {code: 'ZA', name: 'South Africa', prefix: '+27'},
                                    {code: 'AE', name: 'UAE', prefix: '+971'},
                                    {code: 'SA', name: 'Saudi Arabia', prefix: '+966'},
                                    {code: 'EG', name: 'Egypt', prefix: '+20'},
                                    {code: 'NG', name: 'Nigeria', prefix: '+234'},
                                    {code: 'KE', name: 'Kenya', prefix: '+254'},
                                    {code: 'GH', name: 'Ghana', prefix: '+233'},
                                    {code: 'MA', name: 'Morocco', prefix: '+212'},
                                    {code: 'TN', name: 'Tunisia', prefix: '+216'},
                                    {code: 'DZ', name: 'Algeria', prefix: '+213'},
                                    {code: 'TR', name: 'Turkey', prefix: '+90'},
                                    {code: 'IL', name: 'Israel', prefix: '+972'},
                                    {code: 'RU', name: 'Russia', prefix: '+7'},
                                    {code: 'UA', name: 'Ukraine', prefix: '+380'},
                                    {code: 'PK', name: 'Pakistan', prefix: '+92'},
                                    {code: 'BD', name: 'Bangladesh', prefix: '+880'},
                                    {code: 'PH', name: 'Philippines', prefix: '+63'},
                                    {code: 'TH', name: 'Thailand', prefix: '+66'},
                                    {code: 'VN', name: 'Vietnam', prefix: '+84'},
                                    {code: 'ID', name: 'Indonesia', prefix: '+62'},
                                    {code: 'MY', name: 'Malaysia', prefix: '+60'},
                                    {code: 'SG', name: 'Singapore', prefix: '+65'},
                                    {code: 'HK', name: 'Hong Kong', prefix: '+852'},
                                    {code: 'TW', name: 'Taiwan', prefix: '+886'}
                                ];
                                
                                function populateCountryDropdown() {
                                    const select = document.getElementById('signup-country-code');
                                    if (!select) {
                                        console.log('Signup country select not found');
                                        return false;
                                    }
                                    
                                    if (select.getAttribute('data-initialized') === 'true') {
                                        return true;
                                    }
                                    
                                    // Clear placeholder
                                    while (select.options.length > 1) {
                                        select.remove(1);
                                    }
                                    
                                    // Add countries with flags
                                    // Add countries with flags
                                    /* 
                                    countryList.forEach(function(country) {
                                        const option = document.createElement('option');
                                        option.value = country.code;
                                        option.textContent = getCountryFlag(country.code) + ' ' + country.prefix;
                                        select.appendChild(option);
                                    });
                                    */

                                    // Only France (+33) 
                                    const frCountry = countryList.find(c => c.code === 'FR');
                                    if(frCountry) {
                                         const option = document.createElement('option');
                                         option.value = frCountry.code;
                                         option.textContent = getCountryFlag(frCountry.code) + ' ' + frCountry.prefix;
                                         select.appendChild(option);
                                    }
                                    
                                    // Set default to France
                                    const frOption = select.querySelector('option[value="FR"]');
                                    if (frOption) {
                                        frOption.selected = true;
                                    }
                                    
                                    select.setAttribute('data-initialized', 'true');
                                    console.log('Country dropdown populated with', countryList.length, 'countries');
                                    return true;
                                }
                                
                                // Try immediately if element exists
                                if (document.getElementById('signup-country-code')) {
                                    populateCountryDropdown();
                                }
                                
                                // Also try when modal is shown
                                const modal = document.getElementById('signupModal');
                                if (modal) {
                                    modal.addEventListener('shown.bs.modal', function() {
                                        setTimeout(function() {
                                            populateCountryDropdown();
                                        }, 50);
                                    });
                                }
                                
                                // jQuery fallback
                                if (typeof $ !== 'undefined') {
                                    $(document).on('shown.bs.modal', '#signupModal', function() {
                                        setTimeout(function() {
                                            populateCountryDropdown();
                                        }, 50);
                                    });
                                }
                                
                                // Also try after delays
                                setTimeout(populateCountryDropdown, 200);
                                setTimeout(populateCountryDropdown, 500);
                                setTimeout(populateCountryDropdown, 1000);
                            })();
                            </script>

                            <div class="form-group col-md-6 mb-4">
                                <div class="input-group" >
                                    <input type="password" name="password" id="signup-password" class="form-control-login" placeholder="{{ __('app.auth.password_min_chars') }}" required minlength="6">
                                    <span class="input-group-text password-toggle" onclick="togglePassword('signup-password')">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <div class="input-group" >
                                    <input type="password" name="password_confirmation" id="signup-password-confirmation" class="form-control-login" placeholder="{{ __('app.auth.confirm_password') }}" required minlength="6">
                                    <span class="input-group-text password-toggle" onclick="togglePassword('signup-password-confirmation')">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
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
    // Clear stale redirect URLs when on home page (users are not in a booking flow)
    const currentPath = window.location.pathname;
    const isHomePage = currentPath === '/' || currentPath === '/home' || currentPath === '';
    if (isHomePage) {
      localStorage.removeItem('book_appointment_url');
      localStorage.removeItem('login_redirect_url');
      console.log('Cleared stale redirect URLs (on home page)');
    }

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
                if (loginModalEl) {
                  loginModalEl.classList.remove('show');
                  document.body.classList.remove('modal-open');
                }
                
                window.isAuthenticated = true;
                const bookAppointmentUrl = localStorage.getItem('book_appointment_url');
                const loginRedirectUrl = localStorage.getItem('login_redirect_url');
                localStorage.removeItem('book_appointment_url');
                localStorage.removeItem('login_redirect_url');

                // Determine redirect - stay on current page if on home page with no explicit redirect
                const currentPath = window.location.pathname;
                const isHomePage = currentPath === '/' || currentPath === '/home' || currentPath === '';
                let redirectUrl;
                if (bookAppointmentUrl) {
                  redirectUrl = bookAppointmentUrl;
                } else if (loginRedirectUrl) {
                  redirectUrl = loginRedirectUrl;
                } else if (isHomePage) {
                  redirectUrl = window.location.href;
                } else {
                  redirectUrl = data.redirect || window.location.href;
                }

                // Redirect after a short delay to show the success message
                setTimeout(function() {
                  window.location.href = redirectUrl;
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
                if (loginModalEl) {
                  loginModalEl.classList.remove('show');
                  document.body.classList.remove('modal-open');
                }
                
                window.isAuthenticated = true;
                const bookAppointmentUrl = localStorage.getItem('book_appointment_url');
                const loginRedirectUrl = localStorage.getItem('login_redirect_url');
                localStorage.removeItem('book_appointment_url');
                localStorage.removeItem('login_redirect_url');

                // Determine redirect - stay on current page if on home page with no explicit redirect
                const currentPath = window.location.pathname;
                const isHomePage = currentPath === '/' || currentPath === '/home' || currentPath === '';
                let redirectUrl;
                if (bookAppointmentUrl) {
                  redirectUrl = bookAppointmentUrl;
                } else if (loginRedirectUrl) {
                  redirectUrl = loginRedirectUrl;
                } else if (isHomePage) {
                  redirectUrl = window.location.href;
                } else {
                  redirectUrl = data.redirect || window.location.href;
                }

                // Redirect after a short delay to show the success message
                setTimeout(function() {
                  window.location.href = redirectUrl;
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
                if (loginModalEl) {
                  loginModalEl.classList.remove('show');
                  document.body.classList.remove('modal-open');
                }
                
                window.isAuthenticated = true;
                const bookAppointmentUrl = localStorage.getItem('book_appointment_url');
                const loginRedirectUrl = localStorage.getItem('login_redirect_url');
                localStorage.removeItem('book_appointment_url');
                localStorage.removeItem('login_redirect_url');

                // Determine redirect - stay on current page if on home page with no explicit redirect
                const currentPath = window.location.pathname;
                const isHomePage = currentPath === '/' || currentPath === '/home' || currentPath === '';
                let redirectUrl;
                if (bookAppointmentUrl) {
                  redirectUrl = bookAppointmentUrl;
                } else if (loginRedirectUrl) {
                  redirectUrl = loginRedirectUrl;
                } else if (isHomePage) {
                  redirectUrl = window.location.href;
                } else {
                  redirectUrl = data.redirect || window.location.href;
                }

                // Redirect after a short delay to show the success message
                setTimeout(function() {
                  window.location.href = redirectUrl;
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
                if (loginModalEl) {
                  loginModalEl.classList.remove('show');
                  document.body.classList.remove('modal-open');
                }
                
                window.isAuthenticated = true;
                const bookAppointmentUrl = localStorage.getItem('book_appointment_url');
                const loginRedirectUrl = localStorage.getItem('login_redirect_url');
                localStorage.removeItem('book_appointment_url');
                localStorage.removeItem('login_redirect_url');

                // Determine redirect - stay on current page if on home page with no explicit redirect
                const currentPath = window.location.pathname;
                const isHomePage = currentPath === '/' || currentPath === '/home' || currentPath === '';
                let redirectUrl;
                if (bookAppointmentUrl) {
                  redirectUrl = bookAppointmentUrl;
                } else if (loginRedirectUrl) {
                  redirectUrl = loginRedirectUrl;
                } else if (isHomePage) {
                  redirectUrl = window.location.href;
                } else {
                  redirectUrl = data.redirect || window.location.href;
                }

                // Redirect after a short delay to show the success message
                setTimeout(function() {
                  window.location.href = redirectUrl;
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
 
 <script>
 // Initialize country dropdown when signup modal is shown
 document.addEventListener('DOMContentLoaded', function() {
     function initCountryDropdown() {
         if (typeof window.initializeCountryDropdowns === 'function') {
             window.initializeCountryDropdowns();
         } else if (typeof window.getAllCountries === 'function') {
             // Fallback: populate manually
             const countries = window.getAllCountries();
             const signupSelect = document.getElementById('signup-country-code');
             if (signupSelect && signupSelect.options.length <= 1) {
                 countries.forEach(country => {
                     const option = document.createElement('option');
                     option.value = country.code;
                     option.textContent = country.prefix + ' - ' + country.name;
                     signupSelect.appendChild(option);
                 });
                 const frOption = signupSelect.querySelector('option[value="FR"]');
                 if (frOption) frOption.selected = true;
             }
         }
     }
     
     // Try when modal is shown
     const signupModal = document.getElementById('signupModal');
     if (signupModal) {
         signupModal.addEventListener('shown.bs.modal', function() {
             setTimeout(initCountryDropdown, 100);
         });
     }
     
     // Also try with jQuery
     if (typeof $ !== 'undefined') {
         $(document).on('shown.bs.modal', '#signupModal', function() {
             setTimeout(initCountryDropdown, 100);
         });
     }
 });
 </script>

<!-- Auth Translations for JavaScript -->
<script>
    window.authTranslations = {
        loginSuccessful: @json(__('app.auth.login_successful')),
        redirecting: @json(__('app.auth.redirecting')),
        invalidLoginCredentials: @json(__('app.auth.invalid_login_credentials')),
        alreadyLoggedIn: @json(__('app.auth.already_logged_in') ?: 'You are already logged in'),
        loginFailed: @json(__('app.messages.login_error'))
    };
</script>
