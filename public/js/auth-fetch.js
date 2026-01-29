/**
 * Authenticated Fetch Utility
 * Provides a fetch wrapper that automatically refreshes Firebase tokens on 401 errors
 */

(function() {
    'use strict';

    // Track if we're currently refreshing the token to avoid multiple refresh attempts
    let isRefreshing = false;
    let refreshPromise = null;

    /**
     * Get a fresh Firebase ID token
     * @returns {Promise<string|null>} The new ID token or null if refresh failed
     */
    async function getRefreshedToken() {
        if (!window.firebaseAuth) {
            console.warn('Firebase Auth not available for token refresh');
            return null;
        }

        const currentUser = window.firebaseAuth.currentUser;
        if (!currentUser) {
            console.warn('No current Firebase user for token refresh');
            return null;
        }

        try {
            // Force refresh the token
            const newToken = await currentUser.getIdToken(true);
            console.log('Firebase token refreshed successfully');
            return newToken;
        } catch (error) {
            console.error('Failed to refresh Firebase token:', error);
            return null;
        }
    }

    /**
     * Send the refreshed token to the backend to update the session
     * @param {string} newToken - The new Firebase ID token
     * @returns {Promise<boolean>} Whether the token was successfully sent to backend
     */
    async function updateBackendToken(newToken) {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]');

            const response = await fetch('/ajax/refresh-token', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ idToken: newToken })
            });

            const data = await response.json();

            if (data.success) {
                console.log('Backend session token updated successfully');
                return true;
            } else {
                console.error('Backend token update failed:', data.message);
                return false;
            }
        } catch (error) {
            console.error('Error updating backend token:', error);
            return false;
        }
    }

    /**
     * Refresh the Firebase token and update the backend session
     * Uses a single promise to avoid multiple concurrent refresh attempts
     * @returns {Promise<string|null>} The new token or null if refresh failed
     */
    async function refreshToken() {
        // If already refreshing, wait for that to complete
        if (isRefreshing && refreshPromise) {
            return refreshPromise;
        }

        isRefreshing = true;
        refreshPromise = (async () => {
            try {
                const newToken = await getRefreshedToken();
                if (!newToken) {
                    return null;
                }

                const updated = await updateBackendToken(newToken);
                if (!updated) {
                    return null;
                }

                return newToken;
            } finally {
                isRefreshing = false;
                refreshPromise = null;
            }
        })();

        return refreshPromise;
    }

    /**
     * Authenticated fetch wrapper that handles 401 errors with automatic token refresh
     * @param {string} url - The URL to fetch
     * @param {Object} options - Fetch options
     * @param {Object} authFetchOptions - Additional options for authFetch
     * @param {boolean} authFetchOptions.skipRefresh - Skip token refresh on 401 (default: false)
     * @param {number} authFetchOptions.maxRetries - Maximum retry attempts (default: 1)
     * @returns {Promise<Response>} The fetch response
     */
    async function authFetch(url, options = {}, authFetchOptions = {}) {
        const { skipRefresh = false, maxRetries = 1 } = authFetchOptions;

        // Add CSRF token to headers if not present
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        const headers = {
            'Accept': 'application/json',
            ...options.headers
        };

        if (csrfToken && !headers['X-CSRF-TOKEN']) {
            headers['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
        }

        const fetchOptions = {
            ...options,
            headers
        };

        let response = await fetch(url, fetchOptions);

        // If 401 and refresh is enabled, try to refresh token and retry
        if (response.status === 401 && !skipRefresh) {
            console.log('Received 401 response, attempting token refresh...');

            const newToken = await refreshToken();

            if (newToken) {
                console.log('Token refreshed, retrying request...');
                // Retry the original request
                response = await fetch(url, fetchOptions);

                if (response.status === 401) {
                    console.warn('Still receiving 401 after token refresh');
                    // Could redirect to login here if needed
                    handleAuthFailure();
                }
            } else {
                console.warn('Token refresh failed, redirecting to login...');
                handleAuthFailure();
            }
        }

        return response;
    }

    /**
     * Handle authentication failure - show login modal or redirect
     */
    function handleAuthFailure() {
        // Store current URL for redirect after login
        localStorage.setItem('book_appointment_url', window.location.href);

        // Try to show login modal (vanilla JS)
        const loginModalEl = document.getElementById('loginModal');
        if (loginModalEl) {
            loginModalEl.classList.add('show');
            document.body.classList.add('modal-open');
        } else {
            // Redirect to login page if no modal
            window.location.href = '/login?redirect=' + encodeURIComponent(window.location.href);
        }
    }

    /**
     * JSON-specific authenticated fetch that parses response as JSON
     * @param {string} url - The URL to fetch
     * @param {Object} options - Fetch options
     * @param {Object} authFetchOptions - Additional options for authFetch
     * @returns {Promise<Object>} The parsed JSON response
     */
    async function authFetchJson(url, options = {}, authFetchOptions = {}) {
        const headers = {
            'Content-Type': 'application/json',
            ...options.headers
        };

        const response = await authFetch(url, { ...options, headers }, authFetchOptions);
        return response.json();
    }

    /**
     * POST request helper with authentication
     * @param {string} url - The URL to post to
     * @param {Object} data - The data to send
     * @param {Object} options - Additional fetch options
     * @returns {Promise<Object>} The parsed JSON response
     */
    async function authPost(url, data = {}, options = {}) {
        return authFetchJson(url, {
            method: 'POST',
            body: JSON.stringify(data),
            ...options
        });
    }

    /**
     * GET request helper with authentication
     * @param {string} url - The URL to fetch
     * @param {Object} options - Additional fetch options
     * @returns {Promise<Object>} The parsed JSON response
     */
    async function authGet(url, options = {}) {
        return authFetchJson(url, {
            method: 'GET',
            ...options
        });
    }

    // Expose functions globally
    window.authFetch = authFetch;
    window.authFetchJson = authFetchJson;
    window.authPost = authPost;
    window.authGet = authGet;
    window.refreshFirebaseToken = refreshToken;

    console.log('Auth fetch utilities loaded');
})();
