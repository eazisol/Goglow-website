/**
 * Auth Modals Handler
 * Manages authentication modals for login and signup
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('Auth modals script loaded');
    console.log('Authentication status:', window.isAuthenticated);
    console.log('Show auth modal:', window.showAuthModal);
    // Modal toggle functions
    const loginModalElement = document.getElementById('loginModal');
    const signupModalElement = document.getElementById('signupModal');
    
    // Initialize Bootstrap modals
    let loginModal = null;
    let signupModal = null;
    
    try {
        // Check if jQuery is available
        if (typeof $ !== 'undefined') {
            console.log('Using jQuery for modal handling');
            
            // Use jQuery modal methods
            loginModal = {
                show: function() { $('#loginModal').modal('show'); },
                hide: function() { $('#loginModal').modal('hide'); }
            };
            
            signupModal = {
                show: function() { $('#signupModal').modal('show'); },
                hide: function() { $('#signupModal').modal('hide'); }
            };
        } else if (typeof bootstrap !== 'undefined') {
            console.log('Using Bootstrap JS for modal handling');
            
            if (loginModalElement) {
                console.log('Login modal element found:', loginModalElement);
                loginModal = new bootstrap.Modal(loginModalElement);
            } else {
                console.warn('Login modal element not found');
            }
            
            if (signupModalElement) {
                console.log('Signup modal element found:', signupModalElement);
                signupModal = new bootstrap.Modal(signupModalElement);
            } else {
                console.warn('Signup modal element not found');
            }
        } else {
            console.error('Neither jQuery nor Bootstrap JS is available');
        }
    } catch (error) {
        console.error('Error initializing modals:', error);
    }
    
    // Toggle between login and signup modals
    const showSignupBtn = document.getElementById('show-signup-modal');
    if (showSignupBtn && loginModal && signupModal) {
        showSignupBtn.addEventListener('click', function(e) {
            e.preventDefault();
            loginModal.hide();
            setTimeout(() => {
                signupModal.show();
            }, 500);
        });
    }
    
    const showLoginBtn = document.getElementById('show-login-modal');
    if (showLoginBtn && loginModal && signupModal) {
        showLoginBtn.addEventListener('click', function(e) {
            e.preventDefault();
            signupModal.hide();
            setTimeout(() => {
                loginModal.show();
            }, 500);
        });
    }
    
    // Password toggle visibility
    window.togglePassword = function(inputId) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    };
    
    // Handle login form submission
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Check if user is already logged in
            if (window.isAuthenticated) {
                const successElement = document.getElementById('login-success');
                successElement.textContent = 'You are already logged in. Redirecting...';
                successElement.classList.remove('d-none');
                
                // Get the stored book appointment URL from localStorage if available
                const storedUrl = localStorage.getItem('book_appointment_url');
                
                // Redirect immediately
                setTimeout(() => {
                    window.location.href = storedUrl || '/';
                    localStorage.removeItem('book_appointment_url');
                }, 500);
                return;
            }
            
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;
            const redirect = document.getElementById('login-redirect').value;
            const errorElement = document.getElementById('login-error');
            const successElement = document.getElementById('login-success');
            const submitBtn = document.getElementById('login-submit-btn');
            const btnText = document.getElementById('login-btn-text');
            const btnLoader = document.getElementById('login-btn-loader');
            
            // Reset messages
            errorElement.classList.add('d-none');
            successElement.classList.add('d-none');
            
            // Show loader and disable button
            if (submitBtn && btnText && btnLoader) {
                btnText.style.display = 'none';
                btnLoader.style.display = 'inline-block';
                submitBtn.disabled = true;
            }
            
            // Submit via AJAX
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            
            fetch('/ajax/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    email: email,
                    password: password,
                    redirect: redirect,
                    _token: csrfToken ? csrfToken.getAttribute('content') : ''
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Keep loader showing "Processing..." during redirect
                    if (submitBtn && btnText && btnLoader) {
                        btnLoader.style.display = 'inline-block';
                        btnText.style.display = 'none';
                        submitBtn.disabled = true;
                    }
                    
                    // Show success message with redirect indicator
                    successElement.textContent = 'Login successful! Redirecting...';
                    successElement.classList.remove('d-none');
                    
                    // Update window.isAuthenticated to prevent duplicate logins
                    window.isAuthenticated = true;
                    
                    // Get the stored book appointment URL from localStorage if available
                    const storedUrl = localStorage.getItem('book_appointment_url');
                    
                    // Redirect immediately
                    setTimeout(() => {
                        // Use stored URL, then data.redirect, then default to home
                        window.location.href = storedUrl || data.redirect || '/';
                        // Clear stored URL after using it
                        localStorage.removeItem('book_appointment_url');
                    }, 300);
                } else {
                    // Hide loader and re-enable button on error
                    if (submitBtn && btnText && btnLoader) {
                        btnText.style.display = 'inline';
                        btnLoader.style.display = 'none';
                        submitBtn.disabled = false;
                    }
                    
                    // Show error message
                    errorElement.textContent = data.message || 'Login failed';
                    errorElement.classList.remove('d-none');
                }
            })
            .catch(error => {
                // Hide loader and re-enable button
                if (submitBtn && btnText && btnLoader) {
                    btnText.style.display = 'inline';
                    btnLoader.style.display = 'none';
                    submitBtn.disabled = false;
                }
                
                errorElement.textContent = 'An error occurred. Please try again.';
                errorElement.classList.remove('d-none');
                console.error('Login error:', error);
            });
        });
    }
    
    // Handle signup form submission
    const signupForm = document.getElementById('signupForm');
    if (signupForm) {
        signupForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Password match validation
            const password = document.getElementById('signup-password').value;
            const confirmPassword = document.getElementById('signup-password-confirmation').value;
            const errorElement = document.getElementById('signup-error');
            const successElement = document.getElementById('signup-success');
            const submitBtn = document.getElementById('signup-submit-btn');
            const btnText = document.getElementById('signup-btn-text');
            const btnLoader = document.getElementById('signup-btn-loader');
            
            // Reset messages
            errorElement.classList.add('d-none');
            successElement.classList.add('d-none');
            
            if (password !== confirmPassword) {
                errorElement.textContent = 'Passwords do not match';
                errorElement.classList.remove('d-none');
                return;
            }
            
            // Show loader and disable button
            if (submitBtn && btnText && btnLoader) {
                btnText.style.display = 'none';
                btnLoader.style.display = 'inline-block';
                submitBtn.disabled = true;
            }
            
            // Form data
            const formData = {
                name: document.getElementById('signup-name').value,
                email: document.getElementById('signup-email').value,
                password: password,
                password_confirmation: confirmPassword,
                terms: document.getElementById('signup-terms').checked ? 1 : 0
            };
            
            // Submit via AJAX
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            
            // Add CSRF token to form data
            formData._token = csrfToken ? csrfToken.getAttribute('content') : '';
            
            fetch('/ajax/signup', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                // Hide loader and re-enable button
                if (submitBtn && btnText && btnLoader) {
                    btnText.style.display = 'inline';
                    btnLoader.style.display = 'none';
                    submitBtn.disabled = false;
                }
                
                if (data.success) {
                    // Show success message
                    successElement.textContent = data.message;
                    successElement.classList.remove('d-none');
                    
                    // Switch to login modal after a short delay
                    setTimeout(() => {
                        signupModal.hide();
                        // Pre-fill login email
                        document.getElementById('login-email').value = formData.email;
                        setTimeout(() => {
                            loginModal.show();
                        }, 500);
                    }, 2000);
                } else {
                    // Show error message
                    errorElement.textContent = data.message || 'Registration failed';
                    errorElement.classList.remove('d-none');
                }
            })
            .catch(error => {
                // Hide loader and re-enable button
                if (submitBtn && btnText && btnLoader) {
                    btnText.style.display = 'inline';
                    btnLoader.style.display = 'none';
                    submitBtn.disabled = false;
                }
                
                errorElement.textContent = 'An error occurred. Please try again.';
                errorElement.classList.remove('d-none');
                console.error('Signup error:', error);
            });
        });
    }
    
    // Handle Google Sign-In
    async function handleGoogleSignIn(isSignup = false) {
        try {
            if (!window.firebaseAuth || typeof firebase === 'undefined') {
                console.error('Firebase Auth not initialized');
                alert('Authentication service not available. Please refresh the page.');
                return;
            }

            const provider = new firebase.auth.GoogleAuthProvider();
            const result = await window.firebaseAuth.signInWithPopup(provider);
            const idToken = await result.user.getIdToken();
            
            // Send ID token to backend for verification
            await handleOAuthCallback(idToken, isSignup);
        } catch (error) {
            console.error('Google sign-in error:', error);
            const errorElement = document.getElementById(isSignup ? 'signup-error' : 'login-error');
            if (errorElement) {
                errorElement.textContent = error.message || 'Google sign-in failed';
                errorElement.classList.remove('d-none');
            }
        }
    }

    // Handle Apple Sign-In
    async function handleAppleSignIn(isSignup = false) {
        try {
            if (!window.firebaseAuth || typeof firebase === 'undefined') {
                console.error('Firebase Auth not initialized');
                alert('Authentication service not available. Please refresh the page.');
                return;
            }

            const provider = new firebase.auth.OAuthProvider('apple.com');
            const result = await window.firebaseAuth.signInWithPopup(provider);
            const idToken = await result.user.getIdToken();
            
            // Send ID token to backend for verification
            await handleOAuthCallback(idToken, isSignup);
        } catch (error) {
            console.error('Apple sign-in error:', error);
            const errorElement = document.getElementById(isSignup ? 'signup-error' : 'login-error');
            if (errorElement) {
                errorElement.textContent = error.message || 'Apple sign-in failed';
                errorElement.classList.remove('d-none');
            }
        }
    }

    // Handle OAuth callback - send ID token to backend
    async function handleOAuthCallback(idToken, isSignup = false) {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            const storedUrl = localStorage.getItem('book_appointment_url');
            
            const response = await fetch('/ajax/oauth-login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    idToken: idToken,
                    isSignup: isSignup
                })
            });

            const data = await response.json();

            if (data.success) {
                // Update authentication status
                window.isAuthenticated = true;
                
                // Close modal
                if (loginModal) loginModal.hide();
                if (signupModal) signupModal.hide();
                
                // Redirect
                const redirectUrl = storedUrl || data.redirect || '/';
                localStorage.removeItem('book_appointment_url');
                window.location.href = redirectUrl;
            } else {
                throw new Error(data.message || 'Authentication failed');
            }
        } catch (error) {
            console.error('OAuth callback error:', error);
            const errorElement = document.getElementById(isSignup ? 'signup-error' : 'login-error');
            if (errorElement) {
                errorElement.textContent = error.message || 'Authentication failed';
                errorElement.classList.remove('d-none');
            }
        }
    }

    // Google Sign-In buttons
    const googleSigninBtn = document.getElementById('google-signin-btn');
    const googleSignupBtn = document.getElementById('google-signup-btn');
    
    if (googleSigninBtn) {
        googleSigninBtn.addEventListener('click', () => handleGoogleSignIn(false));
    }
    if (googleSignupBtn) {
        googleSignupBtn.addEventListener('click', () => handleGoogleSignIn(true));
    }

    // Apple Sign-In buttons
    const appleSigninBtn = document.getElementById('apple-signin-btn');
    const appleSignupBtn = document.getElementById('apple-signup-btn');
    
    if (appleSigninBtn) {
        appleSigninBtn.addEventListener('click', () => handleAppleSignIn(false));
    }
    if (appleSignupBtn) {
        appleSignupBtn.addEventListener('click', () => handleAppleSignIn(true));
    }

    // Handle book appointment button clicks that require authentication
    document.querySelectorAll('.requires-auth').forEach(button => {
        button.addEventListener('click', function(e) {
            console.log('Requires auth button clicked');
            // Check if user is authenticated
            if (!window.isAuthenticated) {
                console.log('User not authenticated, showing login modal');
                e.preventDefault();
                
                // Set redirect URL in login form
                const redirectUrl = this.getAttribute('data-redirect') || this.getAttribute('href') || window.location.href;
                const loginRedirectInput = document.getElementById('login-redirect');
                if (loginRedirectInput) {
                    loginRedirectInput.value = redirectUrl;
                }
                
                // Show login modal using multiple methods
                if (loginModal) {
                    console.log('Showing modal using loginModal object');
                    loginModal.show();
                } else if (typeof $ !== 'undefined') {
                    console.log('Showing modal using jQuery');
                    $('#loginModal').modal('show');
                } else if (typeof bootstrap !== 'undefined' && document.getElementById('loginModal')) {
                    console.log('Showing modal using bootstrap directly');
                    const modalElement = document.getElementById('loginModal');
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                } else {
                    console.error('Could not show login modal - no method available');
                    // Fallback to regular navigation
                    return true;
                }
            } else {
                console.log('User is authenticated, proceeding to destination');
            }
        });
    });
    
    // Auto-show login modal if needed (set by middleware)
    // if (window.showAuthModal) {
    //     console.log('Auto-showing login modal');
        
    //     // Store the redirect URL in localStorage for use after login
    //     if (window.authRedirect && window.authRedirect.includes('/book-appointment')) {
    //         localStorage.setItem('book_appointment_url', window.authRedirect);
    //         console.log('Stored book appointment URL:', window.authRedirect);
    //     }
        
    //     const loginRedirectInput = document.getElementById('login-redirect');
    //     if (loginRedirectInput) {
    //         loginRedirectInput.value = window.authRedirect || '';
    //     }
        
    //     // Add a small delay to ensure DOM is ready
    //     setTimeout(function() {
    //         // Try multiple methods to show the modal
    //         if (loginModal) {
    //             console.log('Showing modal using loginModal object');
    //             loginModal.show();
    //         } else if (typeof $ !== 'undefined') {
    //             console.log('Showing modal using jQuery');
    //             $('#loginModal').modal('show');
    //         } else if (typeof bootstrap !== 'undefined' && loginModalElement) {
    //             console.log('Showing modal using bootstrap directly');
    //             const modal = new bootstrap.Modal(loginModalElement);
    //             modal.show();
    //         } else {
    //             console.error('Could not show login modal - no method available');
    //         }
    //     }, 500);
    // }
});
