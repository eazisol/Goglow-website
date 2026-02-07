/**
 * Phone Auth Manager
 * Handles Firebase Phone Authentication on the website.
 * Uses window.firebaseAuth (initialized in layout templates).
 */
(function () {
  'use strict';

  var PhoneAuthManager = {
    auth: null,
    recaptchaVerifier: null,
    confirmationResult: null,

    init: function () {
      this.auth = window.firebaseAuth;
      if (!this.auth) {
        console.error('PhoneAuthManager: window.firebaseAuth not available');
      }
    },

    initRecaptcha: function (buttonId) {
      if (this.recaptchaVerifier) {
        return;
      }
      if (typeof firebase === 'undefined') {
        console.error('PhoneAuthManager: Firebase SDK not loaded');
        return;
      }
      this.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(buttonId, {
        size: 'invisible',
      });
    },

    sendOtp: function (phoneNumber) {
      var self = this;
      if (!this.auth) {
        this.init();
      }
      if (!this.auth) {
        return Promise.reject(new Error('Firebase Auth not available'));
      }
      if (!this.recaptchaVerifier) {
        return Promise.reject(new Error('reCAPTCHA not initialized'));
      }
      return this.auth.signInWithPhoneNumber(phoneNumber, this.recaptchaVerifier)
        .then(function (confirmationResult) {
          self.confirmationResult = confirmationResult;
          return { success: true };
        });
    },

    verifyOtp: function (code) {
      if (!this.confirmationResult) {
        return Promise.reject(new Error('No confirmation result. Send OTP first.'));
      }
      return this.confirmationResult.confirm(code)
        .then(function (result) {
          return result.user.getIdToken().then(function (idToken) {
            return {
              success: true,
              idToken: idToken,
              uid: result.user.uid,
              phoneNumber: result.user.phoneNumber
            };
          });
        });
    },

    resetRecaptcha: function () {
      if (this.recaptchaVerifier) {
        try {
          this.recaptchaVerifier.clear();
        } catch (e) {
          // ignore clear errors
        }
        this.recaptchaVerifier = null;
      }
      this.confirmationResult = null;
    }
  };

  // Expose globally
  window.PhoneAuthManager = PhoneAuthManager;

  // --- Phone Auth UI Logic ---
  function setupPhoneAuthUI() {
    var csrfMeta = document.querySelector('meta[name="csrf-token"]');
    var csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

    // --- Modal phone auth flow ---
    var phoneSigninBtn = document.getElementById('phone-signin-btn');
    var phoneSignupBtn = document.getElementById('phone-signup-btn');
    var phoneStep = document.getElementById('phone-entry-step');
    var otpStep = document.getElementById('phone-otp-step');
    var profileStep = document.getElementById('phone-profile-step');
    var loginFormContent = document.getElementById('login-form-content');
    var signupFormContent = document.getElementById('signup-form-content');

    // Phone entry elements
    var phoneInput = document.getElementById('phone-auth-number');
    var sendOtpBtn = document.getElementById('phone-send-otp-btn');
    var phoneError = document.getElementById('phone-entry-error');
    var phoneBackBtn = document.getElementById('phone-back-btn');

    // OTP elements
    var otpInput = document.getElementById('phone-otp-code');
    var verifyOtpBtn = document.getElementById('phone-verify-otp-btn');
    var otpError = document.getElementById('phone-otp-error');
    var otpBackBtn = document.getElementById('phone-otp-back-btn');
    var otpPhoneDisplay = document.getElementById('phone-otp-display');
    var resendOtpBtn = document.getElementById('phone-resend-otp-btn');
    var otpCountdown = document.getElementById('phone-otp-countdown');

    // Profile completion elements
    var profileNameInput = document.getElementById('phone-profile-name');
    var profileSubmitBtn = document.getElementById('phone-profile-submit-btn');
    var profileError = document.getElementById('phone-profile-error');

    var currentPhoneNumber = '';
    var countdownTimer = null;
    var activeContext = 'login'; // 'login' or 'signup'

    function showStep(step) {
      // Hide all steps
      if (phoneStep) phoneStep.style.display = 'none';
      if (otpStep) otpStep.style.display = 'none';
      if (profileStep) profileStep.style.display = 'none';
      if (loginFormContent) loginFormContent.style.display = 'none';
      if (signupFormContent) signupFormContent.style.display = 'none';

      // Show requested step
      if (step === 'phone') {
        if (phoneStep) phoneStep.style.display = 'block';
        clearError(phoneError);
      } else if (step === 'otp') {
        if (otpStep) otpStep.style.display = 'block';
        clearError(otpError);
        startCountdown();
      } else if (step === 'profile') {
        if (profileStep) profileStep.style.display = 'block';
        clearError(profileError);
      } else if (step === 'login') {
        if (loginFormContent) loginFormContent.style.display = 'block';
      } else if (step === 'signup') {
        if (signupFormContent) signupFormContent.style.display = 'block';
      }
    }

    function showError(el, msg) {
      if (el) {
        el.textContent = msg;
        el.classList.remove('d-none');
      }
    }

    function clearError(el) {
      if (el) {
        el.textContent = '';
        el.classList.add('d-none');
      }
    }

    function setLoading(btn, loading) {
      if (!btn) return;
      btn.disabled = loading;
      var text = btn.querySelector('.btn-text');
      var loader = btn.querySelector('.btn-loader');
      if (text) text.style.display = loading ? 'none' : 'inline';
      if (loader) loader.style.display = loading ? 'inline-block' : 'none';
    }

    function startCountdown() {
      var seconds = 60;
      if (resendOtpBtn) resendOtpBtn.style.display = 'none';
      if (otpCountdown) {
        otpCountdown.style.display = 'inline';
        otpCountdown.textContent = '(' + seconds + 's)';
      }
      if (countdownTimer) clearInterval(countdownTimer);
      countdownTimer = setInterval(function () {
        seconds--;
        if (otpCountdown) otpCountdown.textContent = '(' + seconds + 's)';
        if (seconds <= 0) {
          clearInterval(countdownTimer);
          if (otpCountdown) otpCountdown.style.display = 'none';
          if (resendOtpBtn) resendOtpBtn.style.display = 'inline';
        }
      }, 1000);
    }

    function getRedirectUrl(data) {
      var bookAppointmentUrl = localStorage.getItem('book_appointment_url');
      var loginRedirectUrl = localStorage.getItem('login_redirect_url');
      var currentPath = window.location.pathname;
      var isHomePage = currentPath === '/' || currentPath === '/home' || currentPath === '';

      var redirectUrl;
      if (bookAppointmentUrl) {
        redirectUrl = bookAppointmentUrl;
      } else if (loginRedirectUrl) {
        redirectUrl = loginRedirectUrl;
      } else if (data && data.redirect) {
        redirectUrl = data.redirect;
      } else if (isHomePage) {
        redirectUrl = window.location.href;
      } else {
        redirectUrl = window.location.href;
      }

      localStorage.removeItem('book_appointment_url');
      localStorage.removeItem('login_redirect_url');
      return redirectUrl;
    }

    function handleSuccess(data) {
      window.isAuthenticated = true;

      // Show success loader overlay
      var loader = document.getElementById('oauth-success-loader');
      if (loader) {
        loader.style.display = 'flex';
      }

      // Close modals
      var loginModalEl = document.getElementById('loginModal');
      var signupModalEl = document.getElementById('signupModal');
      if (loginModalEl) {
        loginModalEl.classList.remove('show');
      }
      if (signupModalEl) {
        signupModalEl.classList.remove('show');
      }
      document.body.classList.remove('modal-open');

      var redirectUrl = getRedirectUrl(data);
      setTimeout(function () {
        window.location.href = redirectUrl;
      }, 1500);
    }

    // Phone button clicks (login modal)
    if (phoneSigninBtn) {
      phoneSigninBtn.addEventListener('click', function (e) {
        e.preventDefault();
        activeContext = 'login';
        PhoneAuthManager.init();
        PhoneAuthManager.resetRecaptcha();
        PhoneAuthManager.initRecaptcha('phone-send-otp-btn');
        showStep('phone');
      });
    }

    // Phone button clicks (signup modal)
    if (phoneSignupBtn) {
      phoneSignupBtn.addEventListener('click', function (e) {
        e.preventDefault();
        activeContext = 'signup';
        PhoneAuthManager.init();
        PhoneAuthManager.resetRecaptcha();
        PhoneAuthManager.initRecaptcha('phone-send-otp-btn');
        showStep('phone');
      });
    }

    // Back from phone entry
    if (phoneBackBtn) {
      phoneBackBtn.addEventListener('click', function (e) {
        e.preventDefault();
        PhoneAuthManager.resetRecaptcha();
        showStep(activeContext);
      });
    }

    // Back from OTP entry
    if (otpBackBtn) {
      otpBackBtn.addEventListener('click', function (e) {
        e.preventDefault();
        if (countdownTimer) clearInterval(countdownTimer);
        showStep('phone');
      });
    }

    // Send OTP
    if (sendOtpBtn) {
      sendOtpBtn.addEventListener('click', function (e) {
        e.preventDefault();
        clearError(phoneError);

        var rawPhone = phoneInput ? phoneInput.value.replace(/\D/g, '') : '';
        // Strip leading zero (French numbers: 0612... -> 612...)
        rawPhone = rawPhone.replace(/^0/, '');
        if (!rawPhone || rawPhone.length < 6) {
          showError(phoneError, window.phoneAuthTranslations ? window.phoneAuthTranslations.invalidPhone : 'Please enter a valid phone number');
          return;
        }

        currentPhoneNumber = '+33' + rawPhone;
        if (otpPhoneDisplay) otpPhoneDisplay.textContent = currentPhoneNumber;

        setLoading(sendOtpBtn, true);

        PhoneAuthManager.sendOtp(currentPhoneNumber)
          .then(function () {
            setLoading(sendOtpBtn, false);
            showStep('otp');
            if (otpInput) otpInput.value = '';
            if (otpInput) otpInput.focus();
          })
          .catch(function (error) {
            setLoading(sendOtpBtn, false);
            console.error('Send OTP error:', error);

            var t = window.phoneAuthTranslations || {};
            var msg = t.sendFailed || 'Failed to send verification code.';
            if (error.code === 'auth/invalid-phone-number') {
              msg = t.invalidPhone || 'Invalid phone number. Please check and try again.';
            } else if (error.code === 'auth/too-many-requests') {
              msg = t.tooManyAttempts || 'Too many attempts. Please try again later.';
            } else if (error.code === 'auth/quota-exceeded') {
              msg = t.serviceUnavailable || 'Service temporarily unavailable. Please try again later.';
            } else if (error.message) {
              msg = error.message;
            }
            showError(phoneError, msg);

            // Reset reCAPTCHA on error so user can retry
            PhoneAuthManager.resetRecaptcha();
            PhoneAuthManager.initRecaptcha('phone-send-otp-btn');
          });
      });
    }

    // Resend OTP
    if (resendOtpBtn) {
      resendOtpBtn.addEventListener('click', function (e) {
        e.preventDefault();
        if (!currentPhoneNumber) return;

        PhoneAuthManager.resetRecaptcha();
        PhoneAuthManager.initRecaptcha('phone-send-otp-btn');

        PhoneAuthManager.sendOtp(currentPhoneNumber)
          .then(function () {
            startCountdown();
            clearError(otpError);
          })
          .catch(function (error) {
            console.error('Resend OTP error:', error);
            showError(otpError, (window.phoneAuthTranslations || {}).resendFailed || 'Failed to resend code. Please try again.');
            PhoneAuthManager.resetRecaptcha();
            PhoneAuthManager.initRecaptcha('phone-send-otp-btn');
          });
      });
    }

    // Verify OTP
    if (verifyOtpBtn) {
      verifyOtpBtn.addEventListener('click', function (e) {
        e.preventDefault();
        clearError(otpError);

        var code = otpInput ? otpInput.value.replace(/\D/g, '') : '';
        if (!code || code.length !== 6) {
          showError(otpError, (window.phoneAuthTranslations || {}).enterCode || 'Please enter the 6-digit verification code');
          return;
        }

        setLoading(verifyOtpBtn, true);

        PhoneAuthManager.verifyOtp(code)
          .then(function (result) {
            // Send ID token to server for verification
            return fetch('/ajax/phone-auth-verify', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
              },
              body: JSON.stringify({ idToken: result.idToken })
            })
              .then(function (response) { return response.json(); })
              .then(function (data) {
                setLoading(verifyOtpBtn, false);
                if (data.success) {
                  if (data.isNewUser) {
                    // Show profile completion step
                    showStep('profile');
                    if (profileNameInput) profileNameInput.focus();
                  } else {
                    // Existing user -- redirect
                    handleSuccess(data);
                  }
                } else {
                  showError(otpError, data.message || 'Verification failed');
                }
              });
          })
          .catch(function (error) {
            setLoading(verifyOtpBtn, false);
            console.error('Verify OTP error:', error);

            var t = window.phoneAuthTranslations || {};
            var msg = t.invalidCode || 'Invalid verification code.';
            if (error.code === 'auth/invalid-verification-code') {
              msg = t.invalidCode || 'Invalid code. Please check and try again.';
            } else if (error.code === 'auth/code-expired') {
              msg = t.codeExpired || 'Code has expired. Please request a new one.';
            } else if (error.message) {
              msg = error.message;
            }
            showError(otpError, msg);
          });
      });
    }

    // Profile completion submit
    if (profileSubmitBtn) {
      profileSubmitBtn.addEventListener('click', function (e) {
        e.preventDefault();
        clearError(profileError);

        var name = profileNameInput ? profileNameInput.value.trim() : '';
        if (!name) {
          showError(profileError, (window.phoneAuthTranslations || {}).enterName || 'Please enter your name');
          return;
        }

        setLoading(profileSubmitBtn, true);

        fetch('/ajax/phone-auth-complete-profile', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify({ name: name })
        })
          .then(function (response) { return response.json(); })
          .then(function (data) {
            setLoading(profileSubmitBtn, false);
            if (data.success) {
              handleSuccess(data);
            } else {
              showError(profileError, data.message || 'Profile creation failed');
            }
          })
          .catch(function (error) {
            setLoading(profileSubmitBtn, false);
            console.error('Profile completion error:', error);
            showError(profileError, (window.phoneAuthTranslations || {}).genericError || 'An error occurred. Please try again.');
          });
      });
    }

    // Allow Enter key in OTP input
    if (otpInput) {
      otpInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          if (verifyOtpBtn) verifyOtpBtn.click();
        }
      });
    }

    // Allow Enter key in phone input
    if (phoneInput) {
      phoneInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          if (sendOtpBtn) sendOtpBtn.click();
        }
      });
    }

    // Allow Enter key in profile name input
    if (profileNameInput) {
      profileNameInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          if (profileSubmitBtn) profileSubmitBtn.click();
        }
      });
    }

    // --- Standalone page phone auth ---
    var standalonePhoneBtn = document.getElementById('standalone-phone-signin-btn');
    var standalonePhoneSignupBtn = document.getElementById('standalone-phone-signup-btn');

    function initStandalonePhoneAuth(btn) {
      if (!btn) return;
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        // Open the login modal with phone flow
        var loginModalEl = document.getElementById('loginModal');
        if (loginModalEl) {
          loginModalEl.classList.add('show');
          document.body.classList.add('modal-open');
          // Trigger phone flow after modal is visible
          setTimeout(function () {
            var phoneBtn = document.getElementById('phone-signin-btn');
            if (phoneBtn) phoneBtn.click();
          }, 200);
        }
      });
    }

    initStandalonePhoneAuth(standalonePhoneBtn);
    initStandalonePhoneAuth(standalonePhoneSignupBtn);

    // Reset phone auth steps when modals are closed
    function resetPhoneSteps() {
      if (phoneStep) phoneStep.style.display = 'none';
      if (otpStep) otpStep.style.display = 'none';
      if (profileStep) profileStep.style.display = 'none';
      if (loginFormContent) loginFormContent.style.display = 'block';
      if (signupFormContent) signupFormContent.style.display = 'block';
      if (countdownTimer) clearInterval(countdownTimer);
      PhoneAuthManager.resetRecaptcha();
    }

    var loginModalEl = document.getElementById('loginModal');
    var signupModalEl = document.getElementById('signupModal');

    // Reset phone steps when modals lose .show class (works with vanilla CSS modals).
    // Also handle close button clicks and backdrop clicks.
    function onModalClose() {
      setTimeout(resetPhoneSteps, 300);
    }

    document.querySelectorAll('.btn-close').forEach(function (btn) {
      btn.addEventListener('click', onModalClose);
    });

    // Backdrop click: clicking the modal overlay (not the dialog content) closes it
    [loginModalEl, signupModalEl].forEach(function (modal) {
      if (!modal) return;
      modal.addEventListener('click', function (e) {
        if (e.target === modal) {
          onModalClose();
        }
      });
    });
  }

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupPhoneAuthUI);
  } else {
    setupPhoneAuthUI();
  }
})();
