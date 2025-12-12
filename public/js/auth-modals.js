/**
 * Auth Modals Handler
 * Manages authentication modals for login and signup
 */

// CRITICAL: Setup OAuth event delegation FIRST, before anything else
// This ensures it works even if other code fails
(function setupOAuthEarly() {
    console.log('🚀 EARLY OAuth setup - running immediately');
    
    function attachOAuthDelegation() {
        const loginModalEl = document.getElementById('loginModal');
        const signupModalEl = document.getElementById('signupModal');
        
        if (loginModalEl) {
            const loginModalBody = loginModalEl.querySelector('.modal-body');
            if (loginModalBody && !loginModalBody.hasAttribute('data-oauth-attached')) {
                loginModalBody.setAttribute('data-oauth-attached', 'true');
                loginModalBody.addEventListener('click', function(e) {
                    const target = e.target.closest('#google-signin-btn, #apple-signin-btn');
                    if (target) {
                        e.preventDefault();
                        e.stopPropagation();
                        console.log('🔵 OAuth button clicked:', target.id);
                        
                        if (!window.firebaseAuth || typeof firebase === 'undefined') {
                            console.error('❌ Firebase Auth not available');
                            alert('Firebase not initialized. Please refresh.');
                            return;
                        }
                        
                        if (target.id === 'google-signin-btn') {
                            if (typeof handleGoogleSignIn === 'function') {
                                handleGoogleSignIn(false);
                            } else {
                                console.error('handleGoogleSignIn function not found');
                            }
                        } else if (target.id === 'apple-signin-btn') {
                            if (typeof handleAppleSignIn === 'function') {
                                handleAppleSignIn(false);
                            } else {
                                console.error('handleAppleSignIn function not found');
                            }
                        }
                    }
                });
                console.log('✅ Early login modal delegation attached');
            }
        }
        
        if (signupModalEl) {
            const signupModalBody = signupModalEl.querySelector('.modal-body');
            if (signupModalBody && !signupModalBody.hasAttribute('data-oauth-attached')) {
                signupModalBody.setAttribute('data-oauth-attached', 'true');
                signupModalBody.addEventListener('click', function(e) {
                    const target = e.target.closest('#google-signup-btn, #apple-signup-btn');
                    if (target) {
                        e.preventDefault();
                        e.stopPropagation();
                        console.log('🔵 OAuth button clicked:', target.id);
                        
                        if (!window.firebaseAuth || typeof firebase === 'undefined') {
                            console.error('❌ Firebase Auth not available');
                            alert('Firebase not initialized. Please refresh.');
                            return;
                        }
                        
                        if (target.id === 'google-signup-btn') {
                            if (typeof window.handleGoogleSignIn === 'function') {
                                window.handleGoogleSignIn(true);
                            } else {
                                console.error('handleGoogleSignIn function not found, waiting...');
                                setTimeout(function() {
                                    if (typeof window.handleGoogleSignIn === 'function') {
                                        window.handleGoogleSignIn(true);
                                    } else {
                                        alert('Google sign-up not ready. Please try again in a moment.');
                                    }
                                }, 500);
                            }
                        } else if (target.id === 'apple-signup-btn') {
                            if (typeof window.handleAppleSignIn === 'function') {
                                window.handleAppleSignIn(true);
                            } else {
                                console.error('handleAppleSignIn function not found, waiting...');
                                setTimeout(function() {
                                    if (typeof window.handleAppleSignIn === 'function') {
                                        window.handleAppleSignIn(true);
                                    } else {
                                        alert('Apple sign-up not ready. Please try again in a moment.');
                                    }
                                }, 500);
                            }
                        }
                    }
                });
                console.log('✅ Early signup modal delegation attached');
            }
        }
    }
    
    // Try immediately
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', attachOAuthDelegation);
    } else {
        attachOAuthDelegation();
    }
    
    // Also try after a delay
    setTimeout(attachOAuthDelegation, 100);
    setTimeout(attachOAuthDelegation, 500);
    setTimeout(attachOAuthDelegation, 1000);
})();

document.addEventListener('DOMContentLoaded', function() {
    try {
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
        console.log('🔍 Checking for jQuery/Bootstrap...');
        console.log('jQuery available:', typeof $ !== 'undefined');
        console.log('Bootstrap available:', typeof bootstrap !== 'undefined');
        
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
            console.log('✅ jQuery modals initialized');
        } else if (typeof bootstrap !== 'undefined') {
            console.log('Using Bootstrap JS for modal handling');
            console.log('Bootstrap version/type:', typeof bootstrap.Modal);
            
            if (loginModalElement) {
                console.log('Login modal element found:', loginModalElement);
                try {
                    console.log('🔨 Attempting to create Login Bootstrap Modal instance...');
                    loginModal = new bootstrap.Modal(loginModalElement);
                    console.log('✅ Login modal Bootstrap instance created:', loginModal);
                    console.log('✅✅✅ SUCCESS - Login modal created, execution continuing');
                } catch (modalError) {
                    console.error('❌ ERROR creating login modal:', modalError);
                    console.error('Modal error details:', modalError.message, modalError.stack);
                    // Don't throw - set to null and continue
                    loginModal = null;
                }
            } else {
                console.warn('Login modal element not found');
            }
            
            if (signupModalElement) {
                console.log('Signup modal element found:', signupModalElement);
                console.log('🔨 About to create signup modal...');
                
                // Use setTimeout to ensure this executes
                setTimeout(function() {
                    try {
                        console.log('🔨 Attempting to create Bootstrap Modal instance...');
                        signupModal = new bootstrap.Modal(signupModalElement);
                        console.log('✅ Signup modal Bootstrap instance created:', signupModal);
                        console.log('✅✅✅ SUCCESS - Signup modal created');
                    } catch (modalError) {
                        console.error('❌ ERROR creating signup modal:', modalError);
                        console.error('Modal error details:', modalError.message, modalError.stack);
                        signupModal = null;
                    }
                }, 0);
                
                console.log('✅✅✅ Signup modal creation initiated (async)');
            } else {
                console.warn('Signup modal element not found');
            }
            console.log('✅✅✅ About to log "Bootstrap modals initialization complete"');
            console.log('✅ Bootstrap modals initialization complete');
            console.log('✅✅✅ Past Bootstrap modals initialization complete');
        } else {
            console.error('Neither jQuery nor Bootstrap JS is available');
        }
    } catch (error) {
        console.error('❌ CRITICAL ERROR initializing modals:', error);
        console.error('Error name:', error.name);
        console.error('Error message:', error.message);
        console.error('Error stack:', error.stack);
        // Don't throw - continue execution
    }
    
    // Force log with multiple methods to ensure it shows
    console.log('✅✅✅ Modal initialization complete, continuing with form handlers...');
    console.error('🔴 FORCE LOG - Modal init complete (using console.error to ensure visibility)');
    console.log('Login modal object:', loginModal);
    console.log('Signup modal object:', signupModal);
    console.log('📍 About to set up toggle buttons...');
    console.log('Login modal object:', loginModal);
    console.log('Signup modal object:', signupModal);
    console.log('📍 About to set up toggle buttons...');
    
    // Toggle between login and signup modals
    const showSignupBtn = document.getElementById('show-signup-modal');
    if (showSignupBtn) {
        showSignupBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get modal instances - create if they don't exist
            let loginModalInstance = loginModal;
            let signupModalInstance = signupModal;
            
            const loginModalEl = document.getElementById('loginModal');
            const signupModalEl = document.getElementById('signupModal');
            
            if (!loginModalInstance && loginModalEl) {
                if (typeof bootstrap !== 'undefined') {
                    loginModalInstance = new bootstrap.Modal(loginModalEl);
                }
            }
            
            if (!signupModalInstance && signupModalEl) {
                if (typeof bootstrap !== 'undefined') {
                    signupModalInstance = new bootstrap.Modal(signupModalEl);
                }
            }
            
            // Hide login modal
            if (loginModalInstance) {
                loginModalInstance.hide();
            } else if (loginModalEl && typeof bootstrap !== 'undefined') {
                const tempModal = new bootstrap.Modal(loginModalEl);
                tempModal.hide();
            }
            
            // Show signup modal after delay
            setTimeout(() => {
                if (signupModalInstance) {
                    signupModalInstance.show();
                } else if (signupModalEl && typeof bootstrap !== 'undefined') {
                    const tempModal = new bootstrap.Modal(signupModalEl);
                    tempModal.show();
                }
            }, 300);
        });
    }
    
    const showLoginBtn = document.getElementById('show-login-modal');
    if (showLoginBtn) {
        showLoginBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get modal instances - create if they don't exist
            let loginModalInstance = loginModal;
            let signupModalInstance = signupModal;
            
            const loginModalEl = document.getElementById('loginModal');
            const signupModalEl = document.getElementById('signupModal');
            
            if (!loginModalInstance && loginModalEl) {
                if (typeof bootstrap !== 'undefined') {
                    loginModalInstance = new bootstrap.Modal(loginModalEl);
                }
            }
            
            if (!signupModalInstance && signupModalEl) {
                if (typeof bootstrap !== 'undefined') {
                    signupModalInstance = new bootstrap.Modal(signupModalEl);
                }
            }
            
            // Hide signup modal
            if (signupModalInstance) {
                signupModalInstance.hide();
            } else if (signupModalEl && typeof bootstrap !== 'undefined') {
                const tempModal = new bootstrap.Modal(signupModalEl);
                tempModal.hide();
            }
            
            // Show login modal after delay
            setTimeout(() => {
                if (loginModalInstance) {
                    loginModalInstance.show();
                } else if (loginModalEl && typeof bootstrap !== 'undefined') {
                    const tempModal = new bootstrap.Modal(loginModalEl);
                    tempModal.show();
                }
            }, 300);
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
    
    console.log('📋 Form handlers setup complete, setting up OAuth handlers...');
    console.log('📍 About to define OAuth handler functions...');
    
    // Handle Google Sign-In - Make it globally available
    window.handleGoogleSignIn = async function(isSignup = false) {
        try {
            console.log('🚀 Starting Google sign-in process...');
            
            if (!window.firebaseAuth || typeof firebase === 'undefined') {
                console.error('❌ Firebase Auth not initialized');
                alert('Authentication service not available. Please refresh the page.');
                return;
            }

            console.log('📦 Creating Google provider...');
            const provider = new firebase.auth.GoogleAuthProvider();
            
            console.log('🔓 Opening sign-in popup...');
            const result = await window.firebaseAuth.signInWithPopup(provider);
            console.log('✅ Sign-in successful, user:', result.user.email);
            
            console.log('🎫 Getting ID token...');
            const idToken = await result.user.getIdToken();
            console.log('✅ ID token received');
            
            // Send ID token to backend for verification
            await handleOAuthCallback(idToken, isSignup);
        } catch (error) {
            console.error('❌ Google sign-in error:', error);
            console.error('Error code:', error.code);
            console.error('Error message:', error.message);
            
            const errorElement = document.getElementById(isSignup ? 'signup-error' : 'login-error');
            if (errorElement) {
                errorElement.textContent = error.message || 'Google sign-in failed';
                errorElement.classList.remove('d-none');
            } else {
                alert('Google sign-in failed: ' + (error.message || 'Unknown error'));
            }
        }
    }

    // Handle Apple Sign-In - Make it globally available
    window.handleAppleSignIn = async function(isSignup = false) {
        try {
            console.log('🚀 Starting Apple sign-in process...');
            
            if (!window.firebaseAuth || typeof firebase === 'undefined') {
                console.error('❌ Firebase Auth not initialized');
                alert('Authentication service not available. Please refresh the page.');
                return;
            }

            console.log('📦 Creating Apple provider...');
            const provider = new firebase.auth.OAuthProvider('apple.com');
            
            console.log('🔓 Opening sign-in popup...');
            const result = await window.firebaseAuth.signInWithPopup(provider);
            console.log('✅ Sign-in successful, user:', result.user.email || 'Apple user');
            
            console.log('🎫 Getting ID token...');
            const idToken = await result.user.getIdToken();
            console.log('✅ ID token received');
            
            // Send ID token to backend for verification
            await handleOAuthCallback(idToken, isSignup);
        } catch (error) {
            console.error('❌ Apple sign-in error:', error);
            console.error('Error code:', error.code);
            console.error('Error message:', error.message);
            
            const errorElement = document.getElementById(isSignup ? 'signup-error' : 'login-error');
            if (errorElement) {
                errorElement.textContent = error.message || 'Apple sign-in failed';
                errorElement.classList.remove('d-none');
            } else {
                alert('Apple sign-in failed: ' + (error.message || 'Unknown error'));
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

    // Use EVENT DELEGATION - more robust, works even if buttons load later
    // Attach handlers to modals instead of individual buttons
    function setupOAuthEventDelegation() {
        console.log('=== SETTING UP OAUTH EVENT DELEGATION ===');
        
        const loginModalEl = document.getElementById('loginModal');
        const signupModalEl = document.getElementById('signupModal');
        
        console.log('Login modal element:', loginModalEl ? 'Found' : 'NOT FOUND');
        console.log('Signup modal element:', signupModalEl ? 'Found' : 'NOT FOUND');
        
        // Use event delegation on the modal body - this works even if buttons don't exist yet
        if (loginModalEl) {
            const loginModalBody = loginModalEl.querySelector('.modal-body');
            if (loginModalBody) {
                loginModalBody.addEventListener('click', function(e) {
                    const target = e.target.closest('#google-signin-btn, #apple-signin-btn');
                    if (target) {
                        e.preventDefault();
                        e.stopPropagation();
                        console.log('🔵 OAuth button clicked in login modal:', target.id);
                        
                        if (!window.firebaseAuth || typeof firebase === 'undefined') {
                            console.error('❌ Firebase Auth not available');
                            alert('Firebase not initialized. Please refresh the page.');
                            return;
                        }
                        
                        if (target.id === 'google-signin-btn') {
                            console.log('🚀 Starting Google sign-in...');
                            handleGoogleSignIn(false);
                        } else if (target.id === 'apple-signin-btn') {
                            console.log('🚀 Starting Apple sign-in...');
                            handleAppleSignIn(false);
                        }
                    }
                });
                console.log('✅ Login modal event delegation attached');
            } else {
                console.warn('⚠️ Login modal body not found');
            }
        }
        
        if (signupModalEl) {
            const signupModalBody = signupModalEl.querySelector('.modal-body');
            if (signupModalBody) {
                signupModalBody.addEventListener('click', function(e) {
                    const target = e.target.closest('#google-signup-btn, #apple-signup-btn');
                    if (target) {
                        e.preventDefault();
                        e.stopPropagation();
                        console.log('🔵 OAuth button clicked in signup modal:', target.id);
                        
                        if (!window.firebaseAuth || typeof firebase === 'undefined') {
                            console.error('❌ Firebase Auth not available');
                            alert('Firebase not initialized. Please refresh the page.');
                            return;
                        }
                        
                        if (target.id === 'google-signup-btn') {
                            console.log('🚀 Starting Google sign-up...');
                            handleGoogleSignIn(true);
                        } else if (target.id === 'apple-signup-btn') {
                            console.log('🚀 Starting Apple sign-up...');
                            handleAppleSignIn(true);
                        }
                    }
                });
                console.log('✅ Signup modal event delegation attached');
            } else {
                console.warn('⚠️ Signup modal body not found');
            }
        }
        
        console.log('=== EVENT DELEGATION SETUP COMPLETE ===');
    }
    
    // Legacy function for backward compatibility (but use delegation instead)
    function attachOAuthButtonHandlers() {
        console.log('⚠️ Using legacy button attachment (event delegation is preferred)');
        setupOAuthEventDelegation();
    }

    // Initial attachment - wait a bit to ensure DOM is fully ready
    // Try multiple times in case modals load slowly
    let attempts = 0;
    const maxAttempts = 5;
    
    function tryAttachHandlers() {
        attempts++;
        console.log(`🔄 Attempting to attach OAuth handlers (attempt ${attempts}/${maxAttempts})...`);
        
        try {
            attachOAuthButtonHandlers();
            
            // Check if at least one button was found
            const hasButtons = document.getElementById('google-signin-btn') || 
                             document.getElementById('google-signup-btn') || 
                             document.getElementById('apple-signin-btn') || 
                             document.getElementById('apple-signup-btn');
            
            if (!hasButtons && attempts < maxAttempts) {
                console.log(`⏳ No buttons found yet, retrying in 300ms...`);
                setTimeout(tryAttachHandlers, 300);
            } else if (hasButtons) {
                console.log('✅ OAuth handlers attached successfully');
            } else {
                console.warn('⚠️ OAuth buttons not found after all attempts');
            }
        } catch (error) {
            console.error('❌ Error attaching OAuth handlers:', error);
            console.error('Error stack:', error.stack);
            if (attempts < maxAttempts) {
                setTimeout(tryAttachHandlers, 300);
            }
        }
    }
    
    // Setup OAuth handlers using event delegation - THIS IS THE MAIN METHOD
    // Event delegation works even if buttons don't exist yet or are added dynamically
    console.log('🔧🔧🔧 Setting up OAuth handlers using EVENT DELEGATION');
    console.log('This method works even if buttons load later or are dynamically added');
    
    try {
        // Setup immediately - event delegation doesn't need buttons to exist
        setupOAuthEventDelegation();
        console.log('✅ Event delegation setup completed');
    } catch (error) {
        console.error('❌ Event delegation setup failed:', error);
        console.error('Error stack:', error.stack);
    }
    
    // Also try after a short delay as backup (in case modals aren't in DOM yet)
    setTimeout(function() {
        console.log('🔄 Backup event delegation setup (200ms delay)...');
        try {
            setupOAuthEventDelegation();
        } catch (error) {
            console.error('❌ Backup setup failed:', error);
        }
    }, 200);
    
    // Also setup when modals are shown (backup - event delegation should already work)
    if (loginModalElement) {
        loginModalElement.addEventListener('shown.bs.modal', function() {
            console.log('🔵 Login modal shown - ensuring event delegation is active');
            try {
                setupOAuthEventDelegation();
            } catch (error) {
                console.error('Error setting up event delegation:', error);
            }
        });
    }
    
    if (signupModalElement) {
        signupModalElement.addEventListener('shown.bs.modal', function() {
            console.log('🔵 Signup modal shown - ensuring event delegation is active');
            try {
                setupOAuthEventDelegation();
            } catch (error) {
                console.error('Error setting up event delegation:', error);
            }
        });
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
    
    console.log('✅ DOMContentLoaded handler completed - all setup done!');
    } catch (error) {
        console.error('❌ CRITICAL ERROR in auth-modals.js DOMContentLoaded handler:', error);
        console.error('Error message:', error.message);
        console.error('Error stack:', error.stack);
    }
});
