/**
 * Country Codes and Phone Validation
 * Provides country list and phone number validation rules
 */

// Make sure functions are available globally
window.getAllCountries = window.getAllCountries || null;
window.getPhoneValidationRules = window.getPhoneValidationRules || null;
window.getCountryByCode = window.getCountryByCode || null;
window.getCountryByPrefix = window.getCountryByPrefix || null;

// Country list with code, name, and prefix
const countries = [
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
    {code: 'TW', name: 'Taiwan', prefix: '+886'},
];

// Phone number length limits by country code (not prefix)
// Format: 'countryCode': {'min': minLength, 'max': maxLength}
const phoneLengthLimits = {
    'US': {min: 10, max: 10}, // United States
    'CA': {min: 10, max: 10}, // Canada (same as US)
    'GB': {min: 10, max: 10}, // United Kingdom
    'FR': {min: 9, max: 9}, // France
    'DE': {min: 10, max: 11}, // Germany
    'IT': {min: 9, max: 10}, // Italy
    'ES': {min: 9, max: 9}, // Spain
    'NL': {min: 9, max: 9}, // Netherlands
    'BE': {min: 9, max: 9}, // Belgium
    'CH': {min: 9, max: 9}, // Switzerland
    'AT': {min: 10, max: 13}, // Austria
    'SE': {min: 9, max: 9}, // Sweden
    'NO': {min: 8, max: 8}, // Norway
    'DK': {min: 8, max: 8}, // Denmark
    'FI': {min: 9, max: 10}, // Finland
    'PL': {min: 9, max: 9}, // Poland
    'PT': {min: 9, max: 9}, // Portugal
    'GR': {min: 10, max: 10}, // Greece
    'IE': {min: 9, max: 9}, // Ireland
    'AU': {min: 9, max: 9}, // Australia
    'NZ': {min: 8, max: 10}, // New Zealand
    'JP': {min: 10, max: 11}, // Japan
    'KR': {min: 9, max: 10}, // South Korea
    'CN': {min: 11, max: 11}, // China
    'IN': {min: 10, max: 10}, // India
    'BR': {min: 10, max: 11}, // Brazil
    'MX': {min: 10, max: 10}, // Mexico
    'AR': {min: 10, max: 10}, // Argentina
    'ZA': {min: 9, max: 9}, // South Africa
    'AE': {min: 9, max: 9}, // UAE
    'SA': {min: 9, max: 9}, // Saudi Arabia
    'EG': {min: 10, max: 10}, // Egypt
    'NG': {min: 10, max: 10}, // Nigeria
    'KE': {min: 9, max: 9}, // Kenya
    'GH': {min: 9, max: 9}, // Ghana
    'MA': {min: 9, max: 9}, // Morocco
    'TN': {min: 8, max: 8}, // Tunisia
    'DZ': {min: 9, max: 9}, // Algeria
    'TR': {min: 10, max: 10}, // Turkey
    'IL': {min: 9, max: 9}, // Israel
    'RU': {min: 10, max: 10}, // Russia
    'UA': {min: 9, max: 9}, // Ukraine
    'PK': {min: 10, max: 10}, // Pakistan
    'BD': {min: 10, max: 10}, // Bangladesh
    'PH': {min: 10, max: 10}, // Philippines
    'TH': {min: 9, max: 9}, // Thailand
    'VN': {min: 9, max: 10}, // Vietnam
    'ID': {min: 9, max: 11}, // Indonesia
    'MY': {min: 9, max: 10}, // Malaysia
    'SG': {min: 8, max: 8}, // Singapore
    'HK': {min: 8, max: 8}, // Hong Kong
    'TW': {min: 9, max: 9}, // Taiwan
};

/**
 * Get all countries list
 * @returns {Array} Array of country objects
 */
function getAllCountries() {
    return countries;
}

/**
 * Get phone validation rules for a country code
 * @param {string} countryCode - Two-letter country code (e.g., 'US', 'SG')
 * @returns {Object|null} Object with min and max properties, or null if not found
 */
function getPhoneValidationRules(countryCode) {
    if (!countryCode || !phoneLengthLimits[countryCode]) {
        return null;
    }
    return phoneLengthLimits[countryCode];
}

/**
 * Get country by code
 * @param {string} countryCode - Two-letter country code
 * @returns {Object|null} Country object or null if not found
 */
function getCountryByCode(countryCode) {
    return countries.find(country => country.code === countryCode) || null;
}

/**
 * Get country by prefix
 * @param {string} prefix - Phone prefix (e.g., '+65', '+1')
 * @returns {Object|null} Country object or null if not found
 */
function getCountryByPrefix(prefix) {
    return countries.find(country => country.prefix === prefix) || null;
}

/**
 * Get flag emoji from country code
 * @param {string} code - Two-letter country code (e.g., 'US')
 * @returns {string} Flag emoji
 */
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

// Make functions globally available
window.getAllCountries = getAllCountries;
window.getPhoneValidationRules = getPhoneValidationRules;
window.getCountryByCode = getCountryByCode;
window.getCountryByPrefix = getCountryByPrefix;
window.getCountryFlag = getCountryFlag;

// Debug log
console.log('Country codes script loaded. Countries available:', countries.length);
console.log('Functions exposed:', {
    getAllCountries: typeof window.getAllCountries,
    getPhoneValidationRules: typeof window.getPhoneValidationRules,
    getCountryByCode: typeof window.getCountryByCode
});

// Immediate initialization function that can be called when modals are shown
window.initializeCountryDropdowns = function() {
    console.log('initializeCountryDropdowns called');
    console.log('countries array available:', typeof countries !== 'undefined', countries ? countries.length : 0);
    
    // Use the countries array directly (it's in the same scope)
    if (typeof countries === 'undefined' || !Array.isArray(countries) || countries.length === 0) {
        console.error('Country codes data not available in initializeCountryDropdowns');
        return false;
    }
    
    const countryList = countries;
    let initialized = false;
    
    // Initialize signup modal dropdown
    const signupSelect = document.getElementById('signup-country-code');
    if (signupSelect) {
        console.log('Found signup select, current options:', signupSelect.options.length);
        
        // Only populate if not already populated (has only placeholder)
        if (signupSelect.options.length <= 1) {
            // Clear placeholder
            while (signupSelect.options.length > 1) {
                signupSelect.remove(1);
            }
            
            countryList.forEach(country => {
                const option = document.createElement('option');
                option.value = country.code;
                option.textContent = `${getCountryFlag(country.code)} ${country.prefix}`;
                signupSelect.appendChild(option);
            });
            
            // Set default to US
            const usOption = signupSelect.querySelector('option[value="US"]');
            if (usOption) {
                usOption.selected = true;
            }
            
            console.log('Signup modal dropdown populated with', countryList.length, 'countries. Total options:', signupSelect.options.length);
            initialized = true;
        } else {
            console.log('Signup modal dropdown already populated');
        }
    } else {
        console.log('Signup select not found in DOM');
    }
    
    // Initialize signup page dropdown
    const pageSelect = document.getElementById('country-code');
    if (pageSelect) {
        console.log('Found page select, current options:', pageSelect.options.length);
        
        if (pageSelect.options.length <= 1) {
            const oldValue = pageSelect.dataset.oldValue || '';
            
            // Clear placeholder
            while (pageSelect.options.length > 1) {
                pageSelect.remove(1);
            }
            
            countryList.forEach(country => {
                const option = document.createElement('option');
                option.value = country.code;
                option.textContent = `${getCountryFlag(country.code)} ${country.prefix}`;
                if (oldValue === country.code) {
                    option.selected = true;
                }
                pageSelect.appendChild(option);
            });
            
            // Set default to US if no old value
            if (!oldValue) {
                const usOption = pageSelect.querySelector('option[value="US"]');
                if (usOption) {
                    usOption.selected = true;
                }
            }
            
            console.log('Signup page dropdown populated with', countryList.length, 'countries');
            initialized = true;
        } else {
            console.log('Page dropdown already populated');
        }
    } else {
        console.log('Page select not found in DOM');
    }
    
    return initialized;
};

// Try to initialize immediately if DOM is ready
(function() {
    function tryInit() {
        const signupSelect = document.getElementById('signup-country-code');
        const pageSelect = document.getElementById('country-code');
        
        if (signupSelect || pageSelect) {
            console.log('Found dropdown elements, initializing...');
            window.initializeCountryDropdowns();
        }
    }
    
    // Try immediately
    tryInit();
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', tryInit);
    }
    
    // Also try after delays
    setTimeout(tryInit, 100);
    setTimeout(tryInit, 500);
    setTimeout(tryInit, 1000);
    
    // Listen for modal show events
    document.addEventListener('DOMContentLoaded', function() {
        // Bootstrap 5
        const signupModal = document.getElementById('signupModal');
        if (signupModal) {
            signupModal.addEventListener('shown.bs.modal', function() {
                console.log('Modal shown event - initializing country codes');
                setTimeout(tryInit, 50);
            });
        }
        
        // jQuery fallback
        if (typeof $ !== 'undefined') {
            $(document).on('shown.bs.modal', '#signupModal', function() {
                console.log('Modal shown (jQuery) - initializing country codes');
                setTimeout(tryInit, 50);
            });
        }
    });
})();

