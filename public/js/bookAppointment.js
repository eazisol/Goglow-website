/**
 * BookAppointment JavaScript Module
 * Handles all booking page functionality including:
 * - Agent selection (desktop grid + mobile dropdown)
 * - Calendar navigation and day selection
 * - Time slot fetching from API and rendering
 * - Booking form submission (Stripe + free bookings)
 * - Reschedule mode
 * - State restoration after login
 */
(function() {
    'use strict';

    // ============================================================
    // DEBUG LOGGING - Set to false for production
    // Enable via: localStorage.setItem('bookingDebug', '1')
    // ============================================================
    var DEBUG = localStorage.getItem('bookingDebug') === '1';
    var log = DEBUG ? console.log.bind(console, '[Booking]') : function() {};
    var warn = DEBUG ? console.warn.bind(console, '[Booking]') : function() {};

    // ============================================================
    // CONFIGURATION - Read from data attributes on #booking-app
    // ============================================================
    const bookingApp = document.getElementById('booking-app');
    if (!bookingApp) {
        console.error('BookAppointment: #booking-app element not found');
        return;
    }

    // Safe JSON parser with fallback
    function safeJsonParse(str, fallback) {
        try {
            return JSON.parse(str);
        } catch (e) {
            console.error('BookAppointment: Failed to parse JSON data attribute:', e.message);
            return fallback;
        }
    }

    // Parse configuration from data attributes
    const config = {
        service: safeJsonParse(bookingApp.dataset.service || 'null', null),
        category: safeJsonParse(bookingApp.dataset.category || 'null', null),
        agents: safeJsonParse(bookingApp.dataset.agents || '[]', []),
        serviceId: bookingApp.dataset.serviceId || null,
        serviceProviderId: bookingApp.dataset.serviceProviderId || null,
        companyUserName: bookingApp.dataset.companyUsername || null,
        servicesSlug: bookingApp.dataset.servicesSlug || null,
        userId: bookingApp.dataset.userId || null,
        userData: safeJsonParse(bookingApp.dataset.userData || 'null', null),
        rescheduleBookingId: bookingApp.dataset.rescheduleBookingId || null,
        csrfToken: bookingApp.dataset.csrfToken || '',
        checkoutUrl: bookingApp.dataset.checkoutUrl || '',
        myBookingsUrl: bookingApp.dataset.myBookingsUrl || '',
        firebaseUrl: bookingApp.dataset.firebaseUrl || '',
        backendUrl: bookingApp.dataset.backendUrl || 'https://backend.glaura.ai',
        locale: bookingApp.dataset.locale || 'en',
        stripeConfig: null // Will be fetched from API
    };

    // Parse translations
    const translations = safeJsonParse(bookingApp.dataset.translations || '{}', {});

    // Helper function to get translation with fallback
    function t(key, fallback) {
        const keys = key.split('.');
        let value = translations;
        for (const k of keys) {
            if (value && typeof value === 'object' && k in value) {
                value = value[k];
            } else {
                return fallback || key;
            }
        }
        return value || fallback || key;
    }

    // ============================================================
    // DESCRIPTION TOGGLE (CSS line-clamp based)
    // ============================================================
    // Show "see more" button only if text is actually clamped
    const descText = bookingApp.querySelector('.desc-text.desc-clamped');
    const seeMoreBtn = bookingApp.querySelector('.see-more-desc-btn');
    if (descText && seeMoreBtn) {
        requestAnimationFrame(() => {
            if (descText.scrollHeight > descText.clientHeight) {
                seeMoreBtn.style.display = 'inline';
            }
        });
    }

    bookingApp.addEventListener('click', function(e) {
        const btn = e.target.closest('.see-more-desc-btn');
        if (!btn) return;
        e.preventDefault();
        e.stopPropagation();

        const desc = bookingApp.querySelector('.desc-text');
        if (!desc) return;

        if (desc.classList.contains('desc-clamped')) {
            desc.classList.remove('desc-clamped');
            btn.textContent = t('service.see_less', 'See less');
        } else {
            desc.classList.add('desc-clamped');
            btn.textContent = t('service.see_more', 'See more');
        }
    });

    // ============================================================
    // INITIALIZATION
    // ============================================================
    document.addEventListener('DOMContentLoaded', function () {

        // Extract companyUserName and servicesSlug from URL path if available
        const pathParts = window.location.pathname.split('/').filter(part => part);
        let companyUserNameFromPath = null;
        let servicesSlugFromPath = null;

        if (pathParts.length >= 2) {
            servicesSlugFromPath = pathParts[pathParts.length - 1];
            companyUserNameFromPath = pathParts[pathParts.length - 2];
        }

        // Override config with URL path values if not set
        if (!config.companyUserName) config.companyUserName = companyUserNameFromPath;
        if (!config.servicesSlug) config.servicesSlug = servicesSlugFromPath;

        // Check if we're in reschedule mode
        const rescheduleId = config.rescheduleBookingId;
        const isRescheduleMode = !!(rescheduleId && rescheduleId !== 'undefined' && rescheduleId !== 'null');
        log('Reschedule mode:', isRescheduleMode, 'Booking ID:', rescheduleId);

        // Fetch Stripe configuration
        fetch('/api/stripe-config')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    config.stripeConfig = {
                        isLive: data.isLive,
                        publishableKey: data.publishableKey
                    };
                    log('Stripe config loaded:', config.stripeConfig.isLive ? 'LIVE MODE' : 'TEST MODE');
                } else {
                    warn('Failed to load Stripe config, using fallback');
                }
            })
            .catch(err => {
                console.error('Error fetching Stripe config:', err);
            });

        // Log logged-in user data at page load
        log('Logged-in user ID:', config.userId);
        log('Logged-in user data:', config.userData);
        log('firebase-status', typeof firebase !== 'undefined' ? firebase.auth().currentUser : 'Firebase not loaded');

        // Clean up old user_profile_synced keys from previous sessions
        if (config.userData && config.userData.id) {
            try {
                const currentUserId = config.userData.id;
                const keysToRemove = [];
                for (let i = 0; i < sessionStorage.length; i++) {
                    const key = sessionStorage.key(i);
                    if (key && key.startsWith('user_profile_synced_') && !key.endsWith(currentUserId)) {
                        keysToRemove.push(key);
                    }
                }
                keysToRemove.forEach(key => {
                    sessionStorage.removeItem(key);
                    log('Cleaned up old sessionStorage key:', key);
                });
            } catch (error) {
                console.error('Error cleaning up sessionStorage:', error);
            }
        }

        // Sync User Profile to External API
        if (config.userData && config.userData.id) {
            const SYNC_KEY = 'user_profile_synced_' + config.userData.id;

            if (!sessionStorage.getItem(SYNC_KEY)) {
                log('User data found, syncing profile to external API...', config.userData);

                const userProfilePayload = {
                    id: config.userData.id,
                    email: config.userData.email,
                    name: config.userData.name,
                    profileImg: config.userData.photo || config.userData.photoURL || "",
                    countryCode: "+33",
                    phone: config.userData.phone || "",
                    platform: "web",
                    userRole: 0,
                    initialUserRole: 0
                };

                fetch(config.firebaseUrl + '/createUserProfile', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(userProfilePayload)
                })
                .then(response => {
                    if (response.ok) {
                        log('User profile synced successfully');
                        sessionStorage.setItem(SYNC_KEY, 'true');
                        return response.json();
                    } else {
                        warn('User profile sync returned status:', response.status);
                    }
                })
                .then(data => {
                    if (data) log('Sync response:', data);
                })
                .catch(err => {
                    console.error('Error syncing user profile:', err);
                });
            } else {
                log('User profile already synced this session.');
            }
        }

        // Debug: Log service data
        if (config.service) {
            log('=== SERVICE DATA DEBUG (Page Load) ===');
            log('Full service object:', config.service);
            log('ownerMail:', config.service.ownerMail);
            log('ownerProfile:', config.service.ownerProfile);
            log('ownerName:', config.service.ownerName);
            log('ownerId:', config.service.ownerId);
            log('=====================================');
        }

        // ============================================================
        // DOM ELEMENT REFERENCES
        // ============================================================
        const dayButtons = document.querySelectorAll('.day-btn');
        const selectedDayInput = document.getElementById('selected_day');
        const selectedDateInput = document.getElementById('selected_date');
        const selectedTimeInput = document.getElementById('selected_time');
        const form = document.getElementById('appointmentForm');
        const termsCheckbox = document.getElementById('termsConditions');
        const termsError = document.getElementById('termsError');
        const agentList = document.getElementById('agentList');
        const agentSchedule = document.getElementById('agentSchedule');
        const timeSlotGrid = document.getElementById('timeSlotGrid');
        const daysHeader = document.querySelector('.days-header');
        const weekDisplay = document.getElementById('weekDisplay');
        const prevWeekBtn = document.getElementById('prevWeek');
        const nextWeekBtn = document.getElementById('nextWeek');
        const selectedSlotInfo = document.getElementById('selectedSlotInfo');
        const selectedDateTimeDisplay = document.getElementById('selectedDateTimeDisplay');
        const periodSelector = document.getElementById('periodSelector');
        const slotsGroupedContainer = document.getElementById('slotsGroupedContainer');
        const timeSlotsStrip = document.getElementById('timeSlotsStrip');
        const prevTimeSlotBtn = document.getElementById('prevTimeSlot');
        const nextTimeSlotBtn = document.getElementById('nextTimeSlot');
        const paymentOptionsSection = document.getElementById('paymentOptionsSection');
        const mobileTimeSlotsContainer = document.getElementById('mobileTimeSlotsContainer');
        const bookAppointmentBtnText = document.getElementById('bookAppointmentBtnText');
        const paymentChoicesSection = document.getElementById('paymentChoicesSection');

        // ============================================================
        // STATE VARIABLES
        // ============================================================
        let chosenAgent = null;
        // Note: chosenAgentSlots was unused. Use cachedAvailableSlots for slot data.
        let selectedPeriod = null;
        let cachedAvailableSlots = null;
        let cachedSlotsDate = null;
        let cachedWeekSlots = {}; // { "2024-02-06": [...slots with agents], ... }
        let cachedWeekTimestamp = 0; // when the cache was fetched
        const WEEK_CACHE_TTL = 5 * 60 * 1000; // 5 minutes
        let isNoPreferenceMode = true;
        let allAgents = config.agents || [];

        // Date references
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        let currentWeekStart = new Date(today);
        const todayDate = today.getDate();
        const todayMonth = today.getMonth();
        const todayYear = today.getFullYear();

        // Day/month names from translations
        const shortDayNames = [
            t('schedule.short_sunday', 'Sun'),
            t('schedule.short_monday', 'Mon'),
            t('schedule.short_tuesday', 'Tue'),
            t('schedule.short_wednesday', 'Wed'),
            t('schedule.short_thursday', 'Thu'),
            t('schedule.short_friday', 'Fri'),
            t('schedule.short_saturday', 'Sat')
        ];
        const monthNames = [
            t('schedule.month_january', 'January'),
            t('schedule.month_february', 'February'),
            t('schedule.month_march', 'March'),
            t('schedule.month_april', 'April'),
            t('schedule.month_may', 'May'),
            t('schedule.month_june', 'June'),
            t('schedule.month_july', 'July'),
            t('schedule.month_august', 'August'),
            t('schedule.month_september', 'September'),
            t('schedule.month_october', 'October'),
            t('schedule.month_november', 'November'),
            t('schedule.month_december', 'December')
        ];
        const dayKeys = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        const dateTimeAt = t('schedule.at', 'at');
        const currentLocale = config.locale;

        // ============================================================
        // RESCHEDULE MODE SETUP
        // ============================================================
        if (isRescheduleMode) {
            if (paymentChoicesSection) {
                paymentChoicesSection.classList.add('reschedule-hidden');
            }
            if (bookAppointmentBtnText) {
                bookAppointmentBtnText.textContent = t('bookings.confirm_reschedule', 'Confirm Reschedule');
            }
            log('Reschedule mode activated - payment choices hidden, button text changed');
        }

        // ============================================================
        // TERMS CHECKBOX HANDLER
        // ============================================================
        if (termsCheckbox && termsError) {
            termsCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    termsError.style.display = 'none';
                    this.classList.remove('is-invalid');
                } else {
                    termsError.style.display = 'none';
                }
            });
        }

        // Handle day button selection (legacy)
        dayButtons.forEach(button => {
            button.addEventListener('click', function () {
                dayButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                selectedDayInput.value = this.dataset.day;
            });
        });

        // ============================================================
        // API FUNCTIONS
        // ============================================================

        /**
         * Get visible dates (from currentWeekStart, 3 days, skipping past).
         */
        function getVisibleDates() {
            const dates = [];
            for (let i = 0; i < 3; i++) {
                const date = new Date(currentWeekStart);
                date.setDate(date.getDate() + i);
                if (date < today) continue;
                dates.push(formatDateValue(date));
            }
            return dates;
        }

        /**
         * Get all dates to fetch from API (7 days from currentWeekStart, skipping past).
         * Fetches more than displayed so next/prev navigation can use cache.
         */
        function getFullWeekDates() {
            const dates = [];
            for (let i = 0; i < 7; i++) {
                const date = new Date(currentWeekStart);
                date.setDate(date.getDate() + i);
                if (date < today) continue;
                dates.push(formatDateValue(date));
            }
            return dates;
        }

        /**
         * Fetch slots for dates (ALL agents) and merge into cache.
         * Only fetches dates not already cached (within TTL).
         * Client-side filtering handles agent selection.
         * Cache has a 5-minute TTL.
         */
        async function fetchWeekSlots(serviceId, weekDates) {
            const now = Date.now();
            const cacheStillFresh = (now - cachedWeekTimestamp) < WEEK_CACHE_TTL;

            // Find which dates we still need to fetch
            const datesToFetch = cacheStillFresh
                ? weekDates.filter(d => !(d in cachedWeekSlots))
                : weekDates;

            if (datesToFetch.length === 0) {
                log('All dates already cached (TTL ok)');
                return cachedWeekSlots;
            }

            try {
                log('Fetching slots (all agents) for:', { serviceId, dates: datesToFetch });

                // Always fetch without agentId — get ALL agents' slots
                const params = new URLSearchParams({
                    serviceId: serviceId,
                    dates: JSON.stringify(datesToFetch)
                });

                const apiUrl = `${config.firebaseUrl}/getAvailableSlotsForService?${params.toString()}`;
                const response = await fetch(apiUrl);

                if (!response.ok) {
                    warn('Week API call failed');
                    return null;
                }

                const data = await response.json();
                const slotsData = data.dates || data;
                log('Week API response (all agents):', slotsData);

                // If cache expired, reset it; otherwise merge into existing
                if (!cacheStillFresh) {
                    cachedWeekSlots = {};
                }
                for (const dateKey of datesToFetch) {
                    const dateSlots = slotsData[dateKey] || [];
                    cachedWeekSlots[dateKey] = dateSlots.map(slot => ({
                        time: slot.time,
                        available: true,
                        agents: slot.agents || []
                    }));
                }
                cachedWeekTimestamp = now;

                return cachedWeekSlots;
            } catch (error) {
                console.error('Error fetching week slots:', error);
                return null;
            }
        }

        /**
         * Filter cached slots for a specific agent.
         * If agentId is 'no_preference', returns all slots.
         * Otherwise, returns only slots where the agent is available.
         */
        function filterSlotsForAgent(slots, agentId) {
            if (!slots) return [];
            if (!agentId || agentId === 'no_preference') return slots;
            return slots.filter(slot => slot.agents && slot.agents.includes(agentId));
        }

        /**
         * Get slots for a single date + agent. Uses week cache with client-side filtering.
         */
        async function fetchAvailableSlots(serviceId, agentId, date) {
            const now = Date.now();
            const cacheValid = cachedWeekSlots[date] &&
                (now - cachedWeekTimestamp) < WEEK_CACHE_TTL;

            if (cacheValid) {
                log('Returning cached + filtered slots for date:', date, 'agent:', agentId);
                return filterSlotsForAgent(cachedWeekSlots[date], agentId);
            }

            // Fallback: fetch single date (all agents)
            try {
                log('Fetching single date slots for:', { serviceId, date });

                const params = new URLSearchParams({
                    serviceId: serviceId,
                    dates: JSON.stringify([date])
                });

                const apiUrl = `${config.firebaseUrl}/getAvailableSlotsForService?${params.toString()}`;
                const response = await fetch(apiUrl);

                if (!response.ok) {
                    warn('New API failed, falling back to getAvailableTimeSlots');
                    return await fetchAvailableSlotsLegacy(serviceId, agentId, date);
                }

                const data = await response.json();
                const slotsData = data.dates || data;
                log('Aggregated API response:', slotsData);

                const dateSlots = slotsData[date] || [];
                const allSlots = dateSlots.map(slot => ({
                    time: slot.time,
                    available: true,
                    agents: slot.agents || []
                }));

                return filterSlotsForAgent(allSlots, agentId);
            } catch (error) {
                console.error('Error fetching time slots:', error);
                return await fetchAvailableSlotsLegacy(serviceId, agentId, date);
            }
        }

        async function fetchAvailableSlotsLegacy(serviceId, agentId, date) {
            try {
                const fallbackAgentId = agentId === 'no_preference' && allAgents.length > 0
                    ? allAgents[0].id
                    : agentId;

                const apiUrl = `${config.firebaseUrl}/getAvailableTimeSlots?serviceId=${encodeURIComponent(serviceId)}&agentId=${encodeURIComponent(fallbackAgentId)}&date=${encodeURIComponent(date)}`;
                const response = await fetch(apiUrl);

                if (!response.ok) {
                    throw new Error(`API returned ${response.status}`);
                }

                const data = await response.json();
                log('Legacy API response:', data);

                const availableSlots = (data.slots || []).filter(slot => slot.available === true);
                log('Available slots (legacy):', availableSlots);
                return availableSlots;
            } catch (error) {
                console.error('Error fetching time slots (legacy):', error);
                throw error;
            }
        }

        /**
         * Pre-fetch all dates for the current week. Auto-selects first day on desktop.
         * Uses full week dates (not agent-filtered) so cache stays valid across agent switches.
         */
        function prefetchVisibleWeek() {
            if (!chosenAgent) return;

            const visibleDates = getVisibleDates();
            if (visibleDates.length === 0) return;

            const urlParams = new URLSearchParams(window.location.search);
            const serviceId = config.service?.id || config.serviceId || urlParams.get('serviceId');
            if (!serviceId) return;

            // Render helper: hide empty days + auto-select first day with slots
            const renderFromCache = () => {
                const agentId = chosenAgent?.id;
                const hasSlots = (dateStr) => {
                    const slots = cachedWeekSlots[dateStr];
                    return slots && filterSlotsForAgent(slots, agentId).length > 0;
                };

                document.querySelectorAll('.day-column').forEach(col => {
                    col.style.display = hasSlots(col.dataset.date) ? '' : 'none';
                });

                const dayColumns = document.querySelectorAll('.day-column');
                let target = null;
                for (const col of dayColumns) {
                    if (hasSlots(col.dataset.date)) { target = col; break; }
                }
                if (!target) {
                    target = document.querySelector('.day-column.today') ||
                             document.querySelector('.day-column');
                }
                if (target) target.click();
            };

            // Check if all visible dates are already in cache
            const now = Date.now();
            const cacheStillFresh = (now - cachedWeekTimestamp) < WEEK_CACHE_TTL;
            const allVisibleCached = cacheStillFresh && visibleDates.every(d => d in cachedWeekSlots);

            if (allVisibleCached) {
                // All visible dates cached — render instantly, no API call
                log('All visible dates cached, rendering from cache');
                renderFromCache();
                return;
            }

            // Need to fetch — grab 7 days to pre-fill cache for next navigations
            const weekDates = getFullWeekDates();
            showSlotsLoading();

            fetchWeekSlots(serviceId, weekDates).then(() => {
                log('Week slots fetched for dates:', weekDates);
                renderFromCache();
            });
        }

        async function fetchUserDataFromAPI(userId) {
            try {
                const response = await fetch(`${config.firebaseUrl}/getCurrentUserData?UserId=${encodeURIComponent(userId)}`);
                if (response.ok) {
                    const data = await response.json();
                    return {
                        name: data.name || null,
                        phone: data.phone || null,
                        countryCode: data.countryCode || null
                    };
                }
            } catch (error) {
                console.error('Error fetching user data from API:', error);
            }
            return { name: null, phone: null, countryCode: null };
        }

        // ============================================================
        // UI HELPER FUNCTIONS
        // ============================================================
        function showSlotsLoading() {
            if (isMobileView()) {
                if (mobileTimeSlotsContainer) {
                    mobileTimeSlotsContainer.innerHTML = `<div class="slots-loading" style="text-align: center; padding: 40px; color: #666;"><i class="fas fa-spinner fa-spin" style="font-size: 24px; margin-bottom: 10px;"></i><br>${t('booking.loading_available_slots', 'Loading available slots...')}</div>`;
                    mobileTimeSlotsContainer.style.display = '';
                }
            } else {
                timeSlotGrid.innerHTML = `<div class="col-12 text-center py-3" style="padding: 20px; color: #666;"><i class="fas fa-spinner fa-spin" style="font-size: 24px; margin-bottom: 10px;"></i><br>${t('booking.loading_available_slots', 'Loading available slots...')}</div>`;
                if (timeSlotsStrip) {
                    timeSlotsStrip.style.display = '';
                    if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = 'none';
                    if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = 'none';
                }
            }
        }

        function showSlotsError(message) {
            const errorMsg = message || t('booking.failed_to_load_slots', 'Failed to load time slots. Please try again.');
            if (isMobileView()) {
                if (mobileTimeSlotsContainer) {
                    mobileTimeSlotsContainer.innerHTML = `<div class="slots-error" style="text-align: center; padding: 40px; color: #d9534f;"><i class="fas fa-exclamation-circle" style="font-size: 24px; margin-bottom: 10px;"></i><br>${errorMsg}</div>`;
                }
            } else {
                timeSlotGrid.innerHTML = `<div class="col-12 text-center py-3" style="padding: 20px; color: #d9534f;"><i class="fas fa-exclamation-circle" style="font-size: 24px; margin-bottom: 10px;"></i><br>${errorMsg}</div>`;
                if (timeSlotsStrip) {
                    timeSlotsStrip.style.display = '';
                    if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = 'none';
                    if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = 'none';
                }
            }
        }

        function formatTimeDisplay(timeStr) {
            const [hours, minutes] = timeStr.split(':').map(Number);
            return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
        }

        function formatDate(date) {
            const locale = currentLocale === 'fr' ? 'fr-FR' : 'en-US';
            return date.toLocaleDateString(locale, {
                month: 'long',
                day: 'numeric',
                year: 'numeric'
            });
        }

        function formatDateValue(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        function isMobileView() {
            return window.innerWidth <= 768;
        }

        function getDaysToNavigate() {
            return 3;
        }

        function isDateInPast(date) {
            return date < today;
        }

        function setButtonLoading(isLoading) {
            const submitBtn = document.getElementById('bookAppointmentBtn');
            const btnText = document.getElementById('bookAppointmentBtnText');
            const btnLoader = document.getElementById('bookAppointmentBtnLoader');

            if (submitBtn && btnText && btnLoader) {
                if (isLoading) {
                    submitBtn.disabled = true;
                    btnText.style.display = 'none';
                    btnLoader.style.display = 'inline';
                } else {
                    submitBtn.disabled = false;
                    btnText.style.display = 'inline';
                    btnLoader.style.display = 'none';
                }
            }
        }

        function waitForElement(selector, maxWait, interval) {
            maxWait = maxWait || 500;
            interval = interval || 20;
            return new Promise((resolve) => {
                const element = document.querySelector(selector);
                if (element) {
                    resolve(element);
                    return;
                }

                const startTime = Date.now();
                const checkInterval = setInterval(() => {
                    const el = document.querySelector(selector);
                    if (el) {
                        clearInterval(checkInterval);
                        resolve(el);
                    } else if (Date.now() - startTime >= maxWait) {
                        clearInterval(checkInterval);
                        resolve(null);
                    }
                }, interval);
            });
        }

        // ============================================================
        // TIME SLOT SELECTION HANDLER
        // ============================================================
        function handleSlotSelection(slotElement) {
            document.querySelectorAll('.mobile-time-slot, .time-slot').forEach(s => s.classList.remove('selected'));
            slotElement.classList.add('selected');

            selectedDateInput.value = slotElement.dataset.date;
            selectedTimeInput.value = slotElement.dataset.time;
            selectedDayInput.value = slotElement.dataset.day;

            const [yy, mm, dd] = slotElement.dataset.date.split('-').map(Number);
            const selectedDateObj = new Date(yy, mm - 1, dd);
            const formattedDate = formatDate(selectedDateObj);
            const formattedTime = formatTimeDisplay(slotElement.dataset.time);
            selectedDateTimeDisplay.textContent = `${formattedDate} ${dateTimeAt} ${formattedTime}`;

            if (paymentOptionsSection) {
                paymentOptionsSection.style.display = '';
            }
        }

        // ============================================================
        // CALENDAR FUNCTIONS
        // ============================================================
        function updateWeekDisplay() {
            const daysToShow = 3;
            const endDate = new Date(currentWeekStart);
            endDate.setDate(endDate.getDate() + (daysToShow - 1));

            const startMonth = monthNames[currentWeekStart.getMonth()];
            const endMonth = monthNames[endDate.getMonth()];

            if (startMonth === endMonth) {
                weekDisplay.textContent = `${startMonth} ${currentWeekStart.getDate()} - ${endDate.getDate()}`;
            } else {
                weekDisplay.textContent = `${startMonth} ${currentWeekStart.getDate()} - ${endMonth} ${endDate.getDate()}`;
            }
        }

        // Extract numeric seconds from timing value (handles plain number, Firestore Timestamp object, etc.)
        function getTimingSeconds(val) {
            if (typeof val === 'number') return val;
            if (val && typeof val === 'object') {
                if (typeof val.seconds === 'number') return val.seconds;
                if (typeof val._seconds === 'number') return val._seconds;
            }
            return 0;
        }

        function isDayOpen(date) {
            const dayKey = dayKeys[date.getDay()];

            if (isNoPreferenceMode || !chosenAgent || chosenAgent.id === 'no_preference') {
                if (allAgents.length === 0) return true;

                return allAgents.some(agent => {
                    if (!agent.timing) return true;
                    const timing = agent.timing;
                    if (timing[dayKey] && Array.isArray(timing[dayKey]) && timing[dayKey].length === 2) {
                        const openTime = getTimingSeconds(timing[dayKey][0]);
                        const closeTime = getTimingSeconds(timing[dayKey][1]);
                        return openTime > 0 && closeTime > 0 && closeTime > openTime;
                    }
                    return false;
                });
            }

            if (!chosenAgent.timing) {
                return true;
            }

            const timing = chosenAgent.timing;
            if (timing[dayKey] && Array.isArray(timing[dayKey]) && timing[dayKey].length === 2) {
                const openTime = getTimingSeconds(timing[dayKey][0]);
                const closeTime = getTimingSeconds(timing[dayKey][1]);
                return openTime > 0 && closeTime > 0 && closeTime > openTime;
            }

            return false;
        }

        function renderDaysHeader() {
            daysHeader.innerHTML = '';
            const daysToShow = 3;

            for (let i = 0; i < daysToShow; i++) {
                const date = new Date(currentWeekStart);
                date.setDate(date.getDate() + i);

                if (date < today) continue;
                if (!isDayOpen(date)) continue;

                const dayCol = document.createElement('div');
                dayCol.className = 'day-column';
                dayCol.dataset.date = formatDateValue(date);
                dayCol.dataset.dayIndex = i;

                // Preserve active state across re-renders (e.g. resize)
                if (selectedDateInput && selectedDateInput.value === formatDateValue(date)) {
                    dayCol.classList.add('active');
                }

                const isToday = date.getDate() === todayDate &&
                               date.getMonth() === todayMonth &&
                               date.getFullYear() === todayYear;

                if (isToday) {
                    dayCol.classList.add('today');
                }

                const dayName = document.createElement('span');
                dayName.className = 'day-name';
                dayName.textContent = shortDayNames[(date.getDay() + 7) % 7] + ' ';

                const dayDate = document.createElement('span');
                dayDate.className = 'day-date';
                dayDate.textContent = date.getDate();

                dayCol.appendChild(dayName);
                dayCol.appendChild(dayDate);
                daysHeader.appendChild(dayCol);

                // Day click handler
                dayCol.addEventListener('click', function() {
                    document.querySelectorAll('.day-column').forEach(col => col.classList.remove('active'));
                    this.classList.add('active');
                    const dayKey = dayKeys[date.getDay()];
                    selectedDayInput.value = dayKey;
                    selectedDateInput.value = formatDateValue(date);

                    selectedPeriod = null;
                    periodSelector.querySelectorAll('.period-btn').forEach(btn => btn.classList.remove('active'));

                    if (isMobileView()) {
                        periodSelector.style.display = 'none';
                        renderTimeSlotsMobile(dayKey, formatDateValue(date));
                        if (mobileTimeSlotsContainer) {
                            mobileTimeSlotsContainer.style.display = '';
                        }
                        if (timeSlotsStrip) {
                            timeSlotsStrip.style.display = 'none';
                        }
                        if (slotsGroupedContainer) {
                            slotsGroupedContainer.style.display = 'none';
                        }
                    } else {
                        const selectedDate = formatDateValue(date);
                        cachedAvailableSlots = null;
                        cachedSlotsDate = selectedDate;
                        timeSlotGrid.innerHTML = '';
                        if (timeSlotsStrip) {
                            timeSlotsStrip.style.display = 'none';
                        }
                        // Hide period selector on desktop — grouped view replaces it
                        if (periodSelector) {
                            periodSelector.style.display = 'none';
                        }

                        (async () => {
                            try {
                                const urlParams = new URLSearchParams(window.location.search);
                                const serviceId = config.service?.id || config.serviceId || urlParams.get('serviceId');

                                if (!serviceId) {
                                    throw new Error('Service ID not found');
                                }

                                cachedAvailableSlots = await fetchAvailableSlots(serviceId, chosenAgent.id, selectedDate);
                                log('Cached slots for desktop:', cachedAvailableSlots);

                                // Check for saved time from pending state
                                let savedTime = selectedTimeInput?.value;
                                if (!savedTime) {
                                    try {
                                        const pendingStateStr = localStorage.getItem('pendingBookingState');
                                        if (pendingStateStr) {
                                            const state = JSON.parse(pendingStateStr);
                                            if (state && state.selectedTime && state.selectedDate === selectedDate) {
                                                log('Found pending state in localStorage:', state);
                                                savedTime = state.selectedTime;
                                                selectedTimeInput.value = savedTime;
                                            }
                                        }
                                    } catch (e) {
                                        console.error('Error reading pending state:', e);
                                    }
                                }

                                // Render grouped 3-column layout directly
                                renderTimeSlotsGrouped();
                            } catch (error) {
                                console.error('Error fetching slots on date selection:', error);
                                if (slotsGroupedContainer) {
                                    slotsGroupedContainer.innerHTML = `<div style="width: 100%; text-align: center; padding: 20px; color: #d9534f;"><i class="fas fa-exclamation-circle" style="font-size: 24px; margin-bottom: 10px;"></i><br>${t('booking.failed_to_load_slots', 'Failed to load time slots. Please try again.')}</div>`;
                                    slotsGroupedContainer.style.display = 'flex';
                                }
                            }
                        })();

                        if (mobileTimeSlotsContainer) {
                            mobileTimeSlotsContainer.style.display = 'none';
                        }
                    }

                    selectedSlotInfo.style.display = 'none';
                    selectedTimeInput.value = '';

                    if (paymentOptionsSection) {
                        paymentOptionsSection.style.display = 'none';
                    }
                });
            }
        }

        function updatePrevWeekButtonState() {
            const daysToNavigate = getDaysToNavigate();
            const prevWeekDate = new Date(currentWeekStart);
            prevWeekDate.setDate(prevWeekDate.getDate() - daysToNavigate);

            if (isDateInPast(prevWeekDate)) {
                prevWeekBtn.classList.add('disabled');
                prevWeekBtn.setAttribute('disabled', 'disabled');
            } else {
                prevWeekBtn.classList.remove('disabled');
                prevWeekBtn.removeAttribute('disabled');
            }
        }

        function updateTimeSlotArrows() {
            if (!timeSlotGrid || !prevTimeSlotBtn || !nextTimeSlotBtn) return;

            const isAtStart = timeSlotGrid.scrollLeft <= 0;
            const isAtEnd = timeSlotGrid.scrollLeft >= (timeSlotGrid.scrollWidth - timeSlotGrid.clientWidth - 1);

            prevTimeSlotBtn.disabled = isAtStart;
            if (isAtStart) {
                prevTimeSlotBtn.classList.add('disabled');
            } else {
                prevTimeSlotBtn.classList.remove('disabled');
            }

            nextTimeSlotBtn.disabled = isAtEnd;
            if (isAtEnd) {
                nextTimeSlotBtn.classList.add('disabled');
            } else {
                nextTimeSlotBtn.classList.remove('disabled');
            }
        }

        // ============================================================
        // TIME SLOT RENDERING
        // ============================================================
        function renderTimeSlots(selectedDay, selectedPeriodValue, selectedDate) {
            log('Rendering time slots:', { selectedDay, selectedPeriod: selectedPeriodValue, selectedDate });
            timeSlotGrid.innerHTML = '';

            if (timeSlotsStrip) {
                timeSlotsStrip.style.display = 'none';
            }

            if (mobileTimeSlotsContainer) {
                mobileTimeSlotsContainer.style.display = 'none';
            }

            if (!selectedDay || !selectedDate || !chosenAgent) {
                timeSlotGrid.innerHTML = `<div class="col-12 text-center py-3" style="padding: 20px; color: #666;">${t('schedule.no_slot_available', 'No slots available')}</div>`;
                if (timeSlotsStrip) {
                    timeSlotsStrip.style.display = '';
                    if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = 'none';
                    if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = 'none';
                }
                return;
            }

            const availableSlots = cachedAvailableSlots;

            if (!availableSlots || availableSlots.length === 0) {
                timeSlotGrid.innerHTML = `<div class="col-12 text-center py-3" style="padding: 20px; color: #666;">${t('schedule.no_slot_available', 'No slots available')}</div>`;
                if (timeSlotsStrip) {
                    timeSlotsStrip.style.display = '';
                    if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = 'none';
                    if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = 'none';
                }
                return;
            }

            const periodRanges = {
                morning: { start: 6, end: 12 },
                afternoon: { start: 12, end: 17 },
                evening: { start: 17, end: 21 }
            };

            const period = periodRanges[selectedPeriodValue];
            if (!period) {
                timeSlotGrid.innerHTML = `<div class="col-12 text-center py-3" style="padding: 20px; color: #666;">${t('schedule.no_slot_available', 'No slots available')}</div>`;
                if (timeSlotsStrip) {
                    timeSlotsStrip.style.display = '';
                    if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = 'none';
                    if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = 'none';
                }
                return;
            }

            const filteredSlots = availableSlots.filter(slot => {
                const [hours] = slot.time.split(':').map(Number);
                return hours >= period.start && hours < period.end;
            });

            if (filteredSlots.length === 0) {
                timeSlotGrid.innerHTML = `<div class="col-12 text-center py-3" style="padding: 20px; color: #666;">${t('schedule.no_slot_available', 'No slots available')}</div>`;
                if (timeSlotsStrip) {
                    timeSlotsStrip.style.display = '';
                    if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = 'none';
                    if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = 'none';
                }
                return;
            }

            if (timeSlotsStrip) {
                timeSlotsStrip.style.display = '';
                if (prevTimeSlotBtn) prevTimeSlotBtn.style.display = '';
                if (nextTimeSlotBtn) nextTimeSlotBtn.style.display = '';
            }

            filteredSlots.forEach(slot => {
                const timeSlot = document.createElement('div');
                timeSlot.className = 'time-slot';
                timeSlot.dataset.day = selectedDay;
                timeSlot.dataset.time = slot.time;
                timeSlot.dataset.date = selectedDate;
                timeSlot.textContent = formatTimeDisplay(slot.time);

                timeSlot.addEventListener('click', function() {
                    handleSlotSelection(this);
                });

                timeSlotGrid.appendChild(timeSlot);
            });

            setTimeout(() => {
                updateTimeSlotArrows();

                const preSelectedTime = selectedTimeInput?.value;
                let slotAutoSelected = false;

                if (preSelectedTime) {
                    const matchingSlot = timeSlotGrid.querySelector(`[data-time="${preSelectedTime}"]`);
                    if (matchingSlot) {
                        log('Auto-selecting restored time slot:', preSelectedTime);
                        matchingSlot.click();
                        slotAutoSelected = true;

                        setTimeout(() => {
                            matchingSlot.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                        }, 50);

                        updateTimeSlotArrows();
                    }
                }

                if (!slotAutoSelected && timeSlotGrid && filteredSlots.length > 6) {
                    const scrollWidth = timeSlotGrid.scrollWidth;
                    const clientWidth = timeSlotGrid.clientWidth;
                    timeSlotGrid.scrollLeft = (scrollWidth - clientWidth) / 2;
                    updateTimeSlotArrows();
                }
            }, 100);
        }

        // ============================================================
        // GROUPED TIME SLOTS RENDERING (Desktop 3-column layout)
        // ============================================================
        function renderTimeSlotsGrouped() {
            log('Rendering grouped time slots (desktop 3-column)');

            if (!slotsGroupedContainer) return;
            slotsGroupedContainer.innerHTML = '';

            // Hide period selector and old time-slots-strip on desktop
            if (periodSelector) periodSelector.style.display = 'none';
            if (timeSlotsStrip) timeSlotsStrip.style.display = 'none';

            const selectedDate = selectedDateInput?.value;
            const selectedDay = selectedDayInput?.value;

            if (!selectedDay || !selectedDate || !chosenAgent) {
                slotsGroupedContainer.innerHTML = `<div style="width: 100%; text-align: center; padding: 20px; color: #666;">${t('schedule.no_slot_available', 'No slots available')}</div>`;
                slotsGroupedContainer.style.display = 'flex';
                return;
            }

            const availableSlots = cachedAvailableSlots;

            if (!availableSlots || availableSlots.length === 0) {
                slotsGroupedContainer.innerHTML = `<div style="width: 100%; text-align: center; padding: 20px; color: #666;">${t('schedule.no_slot_available', 'No slots available')}</div>`;
                slotsGroupedContainer.style.display = 'flex';
                return;
            }

            const periodRanges = {
                morning: { start: 6, end: 12, label: t('agent_page.the_morning', 'Morning') },
                afternoon: { start: 12, end: 17, label: t('agent_page.in_the_afternoon', 'Afternoon') },
                evening: { start: 17, end: 21, label: t('agent_page.in_the_evening', 'Evening') }
            };

            const sortedSlots = [...availableSlots].sort((a, b) => {
                const [aH, aM] = a.time.split(':').map(Number);
                const [bH, bM] = b.time.split(':').map(Number);
                return (aH * 60 + aM) - (bH * 60 + bM);
            });

            let hasAnySlots = false;

            for (const [periodKey, periodDef] of Object.entries(periodRanges)) {
                const periodSlots = sortedSlots.filter(slot => {
                    const [hours] = slot.time.split(':').map(Number);
                    return hours >= periodDef.start && hours < periodDef.end;
                });

                if (periodSlots.length === 0) continue;

                hasAnySlots = true;

                const column = document.createElement('div');
                column.className = 'slots-period-column';

                // Period header removed — slots are self-explanatory by time

                periodSlots.forEach(slot => {
                    const timeSlot = document.createElement('div');
                    timeSlot.className = 'time-slot';
                    timeSlot.dataset.day = selectedDay;
                    timeSlot.dataset.time = slot.time;
                    timeSlot.dataset.date = selectedDate;
                    if (slot.agents) {
                        timeSlot.dataset.agents = JSON.stringify(slot.agents);
                    }
                    timeSlot.textContent = formatTimeDisplay(slot.time);

                    timeSlot.addEventListener('click', function() {
                        handleSlotSelection(this);
                    });

                    column.appendChild(timeSlot);
                });

                slotsGroupedContainer.appendChild(column);
            }

            if (!hasAnySlots) {
                slotsGroupedContainer.innerHTML = `<div style="width: 100%; text-align: center; padding: 20px; color: #666;">${t('schedule.no_slot_available', 'No slots available')}</div>`;
            }

            slotsGroupedContainer.style.display = 'flex';

            // Auto-select previously selected time if restoring state
            setTimeout(() => {
                const preSelectedTime = selectedTimeInput?.value;
                if (preSelectedTime) {
                    const matchingSlot = slotsGroupedContainer.querySelector(`[data-time="${preSelectedTime}"]`);
                    if (matchingSlot) {
                        log('Auto-selecting restored time slot in grouped view:', preSelectedTime);
                        matchingSlot.click();
                        setTimeout(() => {
                            matchingSlot.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                        }, 50);
                    }
                }
            }, 100);
        }

        async function renderTimeSlotsMobile(selectedDay, selectedDate) {
            log('Rendering mobile time slots:', { selectedDay, selectedDate });

            if (!mobileTimeSlotsContainer) return;
            mobileTimeSlotsContainer.innerHTML = '';

            if (!selectedDay || !selectedDate || !chosenAgent) {
                mobileTimeSlotsContainer.innerHTML = `<div class="mobile-no-slots">${t('schedule.no_slot_available', 'No slots available')}</div>`;
                return;
            }

            // Only show loading if data is not cached
            const now = Date.now();
            const hasCached = cachedWeekSlots[selectedDate] && (now - cachedWeekTimestamp) < WEEK_CACHE_TTL;
            if (!hasCached) {
                showSlotsLoading();
            }

            try {
                const urlParams = new URLSearchParams(window.location.search);
                const serviceId = config.service?.id || config.serviceId || urlParams.get('serviceId');

                if (!serviceId) {
                    throw new Error('Service ID not found');
                }

                const availableSlots = await fetchAvailableSlots(serviceId, chosenAgent.id, selectedDate);
                cachedAvailableSlots = availableSlots;
                cachedSlotsDate = selectedDate;

                if (!availableSlots || availableSlots.length === 0) {
                    mobileTimeSlotsContainer.innerHTML = `<div class="mobile-no-slots">${t('schedule.no_slot_available', 'No slots available')}</div>`;
                    mobileTimeSlotsContainer.style.display = '';
                    return;
                }

                const sortedSlots = [...availableSlots].sort((a, b) => {
                    const [aH, aM] = a.time.split(':').map(Number);
                    const [bH, bM] = b.time.split(':').map(Number);
                    return (aH * 60 + aM) - (bH * 60 + bM);
                });

                const slotsGrid = document.createElement('div');
                slotsGrid.className = 'mobile-slots-grid';

                const initialCount = 9;
                const initialSlots = sortedSlots.slice(0, initialCount);
                const remainingSlots = sortedSlots.slice(initialCount);

                initialSlots.forEach(slot => {
                    const timeSlot = document.createElement('div');
                    timeSlot.className = 'mobile-time-slot';
                    timeSlot.dataset.day = selectedDay;
                    timeSlot.dataset.time = slot.time;
                    timeSlot.dataset.date = selectedDate;
                    if (slot.agents) {
                        timeSlot.dataset.agents = JSON.stringify(slot.agents);
                    }
                    timeSlot.textContent = formatTimeDisplay(slot.time);

                    timeSlot.addEventListener('click', function() {
                        handleSlotSelection(this);
                    });

                    slotsGrid.appendChild(timeSlot);
                });

                slotsGrid.dataset.remainingSlots = JSON.stringify(remainingSlots);

                mobileTimeSlotsContainer.innerHTML = '';
                mobileTimeSlotsContainer.appendChild(slotsGrid);
                mobileTimeSlotsContainer.style.display = '';

                if (remainingSlots.length > 0) {
                    const seeMoreBtn = document.createElement('button');
                    seeMoreBtn.className = 'mobile-see-more-btn';
                    seeMoreBtn.textContent = t('agent_page.see_more', 'See more');
                    seeMoreBtn.type = 'button';

                    seeMoreBtn.addEventListener('click', function() {
                        const moreSlots = JSON.parse(slotsGrid.dataset.remainingSlots);

                        moreSlots.forEach(slot => {
                            const timeSlot = document.createElement('div');
                            timeSlot.className = 'mobile-time-slot';
                            timeSlot.dataset.day = selectedDay;
                            timeSlot.dataset.time = slot.time;
                            timeSlot.dataset.date = selectedDate;
                            if (slot.agents) {
                                timeSlot.dataset.agents = JSON.stringify(slot.agents);
                            }
                            timeSlot.textContent = formatTimeDisplay(slot.time);

                            timeSlot.addEventListener('click', function() {
                                handleSlotSelection(this);
                            });

                            slotsGrid.appendChild(timeSlot);
                        });

                        this.style.display = 'none';
                    });

                    slotsGrid.appendChild(seeMoreBtn);
                }

                setTimeout(() => {
                    const preSelectedTime = selectedTimeInput?.value;
                    if (preSelectedTime) {
                        const matchingSlot = mobileTimeSlotsContainer.querySelector(`.mobile-time-slot[data-time="${preSelectedTime}"]`);
                        if (matchingSlot) {
                            log('Auto-selecting restored time slot (mobile):', preSelectedTime);
                            matchingSlot.click();
                        }
                    }
                }, 150);
            } catch (error) {
                console.error('Error rendering mobile time slots:', error);
                showSlotsError();
            }
        }

        // (Mobile day selector removed — calendar strip now shown on all viewports)

        // ============================================================
        // WEEK NAVIGATION
        // ============================================================
        if (prevWeekBtn) {
            prevWeekBtn.addEventListener('click', function() {
                const daysToNavigate = getDaysToNavigate();
                const newWeekStart = new Date(currentWeekStart);
                newWeekStart.setDate(newWeekStart.getDate() - daysToNavigate);

                if (!isDateInPast(newWeekStart)) {
                    currentWeekStart = newWeekStart;
                    updateWeekDisplay();
                    renderDaysHeader();

                    selectedPeriod = null;
                    periodSelector.querySelectorAll('.period-btn').forEach(btn => btn.classList.remove('active'));
                    periodSelector.style.display = 'none';
                    timeSlotGrid.innerHTML = '';
                    if (timeSlotsStrip) {
                        timeSlotsStrip.style.display = 'none';
                    }
                    if (slotsGroupedContainer) {
                        slotsGroupedContainer.innerHTML = '';
                        slotsGroupedContainer.style.display = 'none';
                    }
                    if (mobileTimeSlotsContainer) {
                        mobileTimeSlotsContainer.style.display = 'none';
                        mobileTimeSlotsContainer.innerHTML = '';
                    }
                    selectedSlotInfo.style.display = 'none';
                    selectedTimeInput.value = '';

                    if (paymentOptionsSection) {
                        paymentOptionsSection.style.display = 'none';
                    }

                    document.querySelectorAll('.day-column').forEach(col => col.classList.remove('active'));
                    selectedDayInput.value = '';
                    selectedDateInput.value = '';

                    // Pre-fetch slots for new week
                    prefetchVisibleWeek();
                }

                updatePrevWeekButtonState();
            });
        }

        if (nextWeekBtn) {
            nextWeekBtn.addEventListener('click', function() {
                const daysToNavigate = getDaysToNavigate();
                currentWeekStart.setDate(currentWeekStart.getDate() + daysToNavigate);
                updateWeekDisplay();
                renderDaysHeader();

                selectedPeriod = null;
                periodSelector.querySelectorAll('.period-btn').forEach(btn => btn.classList.remove('active'));
                periodSelector.style.display = 'none';
                timeSlotGrid.innerHTML = '';
                if (timeSlotsStrip) {
                    timeSlotsStrip.style.display = 'none';
                }
                if (slotsGroupedContainer) {
                    slotsGroupedContainer.innerHTML = '';
                    slotsGroupedContainer.style.display = 'none';
                }
                if (mobileTimeSlotsContainer) {
                    mobileTimeSlotsContainer.style.display = 'none';
                    mobileTimeSlotsContainer.innerHTML = '';
                }
                selectedSlotInfo.style.display = 'none';
                selectedTimeInput.value = '';

                if (paymentOptionsSection) {
                    paymentOptionsSection.style.display = 'none';
                }

                document.querySelectorAll('.day-column').forEach(col => col.classList.remove('active'));
                selectedDayInput.value = '';
                selectedDateInput.value = '';

                updatePrevWeekButtonState();

                // Pre-fetch slots for new week
                prefetchVisibleWeek();
            });
        }

        // ============================================================
        // AGENT SELECTION (DESKTOP)
        // ============================================================
        const agentSeeMoreBtn = document.getElementById('agentSeeMoreBtn');
        if (agentSeeMoreBtn) {
            agentSeeMoreBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                document.querySelectorAll('.agent-option.agent-hidden').forEach(el => {
                    el.classList.remove('agent-hidden');
                });
                this.style.display = 'none';
            });
        }

        if (agentList) {
            agentList.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    const agentOption = e.target.closest('.agent-option');
                    if (agentOption) {
                        e.preventDefault();
                        agentOption.click();
                    }
                }
            });

            agentList.addEventListener('click', (e) => {
                const agentOption = e.target.closest('.agent-option');
                if (!agentOption) return;
                if (agentOption.classList.contains('agent-see-more')) return;

                [...agentList.querySelectorAll('.agent-option')].forEach(el => {
                    el.classList.remove('active');
                    el.setAttribute('aria-checked', 'false');
                });
                agentOption.classList.add('active');
                agentOption.setAttribute('aria-checked', 'true');

                const agent = JSON.parse(agentOption.dataset.agent);
                isNoPreferenceMode = agentOption.dataset.noPreference === 'true';

                if (isNoPreferenceMode) {
                    chosenAgent = allAgents.length > 0 ? { ...allAgents[0], id: 'no_preference', name: agent.name } : agent;
                    log('No preference mode activated - will show all agents\' availability');
                } else {
                    chosenAgent = agent;
                }

                log('Agent data:', agent);
                log('Is no preference mode:', isNoPreferenceMode);
                log('Chosen agent for calendar:', chosenAgent);
                log('Logged-in user data:', config.userData);

                agentSchedule.style.display = '';

                // Save previously selected date before resetting
                const previousSelectedDate = selectedDateInput.value;

                selectedDayInput.value = '';
                selectedDateInput.value = '';
                selectedTimeInput.value = '';
                selectedSlotInfo.style.display = 'none';
                selectedPeriod = null;

                periodSelector.style.display = 'none';
                timeSlotGrid.innerHTML = '';
                if (timeSlotsStrip) {
                    timeSlotsStrip.style.display = 'none';
                }
                if (slotsGroupedContainer) {
                    slotsGroupedContainer.innerHTML = '';
                    slotsGroupedContainer.style.display = 'none';
                }
                if (mobileTimeSlotsContainer) {
                    mobileTimeSlotsContainer.style.display = 'none';
                    mobileTimeSlotsContainer.innerHTML = '';
                }

                if (paymentOptionsSection) {
                    paymentOptionsSection.style.display = 'none';
                }

                periodSelector.querySelectorAll('.period-btn').forEach(btn => btn.classList.remove('active'));

                updateWeekDisplay();
                renderDaysHeader();
                updatePrevWeekButtonState();

                // Helper: check if a date has available slots for the chosen agent
                const dateHasSlots = (dateStr) => {
                    const slots = cachedWeekSlots[dateStr];
                    if (!slots || slots.length === 0) return false;
                    const agentId = chosenAgent?.id;
                    return filterSlotsForAgent(slots, agentId).length > 0;
                };

                // Helper: hide days with no available slots
                const hideEmptyDays = () => {
                    document.querySelectorAll('.day-column').forEach(col => {
                        col.style.display = dateHasSlots(col.dataset.date) ? '' : 'none';
                    });
                };

                // Helper: auto-select the first day with available slots
                const autoSelectDay = () => {
                    const dayColumns = document.querySelectorAll('.day-column');
                    let target = null;

                    // 1. Try previous date if it still has slots
                    if (previousSelectedDate) {
                        const prevCol = document.querySelector(`.day-column[data-date="${previousSelectedDate}"]`);
                        if (prevCol && dateHasSlots(previousSelectedDate)) {
                            target = prevCol;
                        }
                    }

                    // 2. Find first day column with available slots
                    if (!target) {
                        for (const col of dayColumns) {
                            if (dateHasSlots(col.dataset.date)) {
                                target = col;
                                break;
                            }
                        }
                    }

                    // 3. Fallback: today or first column
                    if (!target) {
                        target = document.querySelector('.day-column.today') ||
                                 document.querySelector('.day-column');
                    }

                    if (target) target.click();
                };

                // Pre-fetch week slots using full week dates (stable cache key across agents)
                const weekDates = getFullWeekDates();
                if (weekDates.length > 0 && chosenAgent) {
                    const urlParams = new URLSearchParams(window.location.search);
                    const serviceId = config.service?.id || config.serviceId || urlParams.get('serviceId');
                    if (serviceId) {
                        const now = Date.now();
                        const cacheStillFresh = (now - cachedWeekTimestamp) < WEEK_CACHE_TTL;
                        const allCached = cacheStillFresh && weekDates.every(d => d in cachedWeekSlots);

                        if (allCached) {
                            // Cache valid — just re-render with new agent filter (instant)
                            log('Agent changed, re-rendering from cache');
                            hideEmptyDays();
                            autoSelectDay();
                        } else {
                            showSlotsLoading();
                            fetchWeekSlots(serviceId, weekDates).then(() => {
                                log('Week slots pre-fetched for dates:', weekDates);
                                hideEmptyDays();
                                autoSelectDay();
                            });
                        }
                    }
                }
            });

            // Auto-trigger "Sans preference" selection on page load
            const noPreferenceOption = agentList.querySelector('[data-no-preference="true"]');
            if (noPreferenceOption) {
                setTimeout(() => {
                    log('Auto-triggering Sans preference selection');
                    noPreferenceOption.click();
                }, 300);
            }
        }

        // ============================================================
        // PERIOD SELECTOR
        // ============================================================
        if (periodSelector) {
            periodSelector.addEventListener('click', (e) => {
                const periodBtn = e.target.closest('.period-btn');
                if (!periodBtn) return;

                const activeDay = document.querySelector('.day-column.active');
                if (!activeDay) {
                    alert(t('agent_page.please_select_day', 'Please select a day first'));
                    return;
                }

                const dayKey = selectedDayInput.value;
                if (!dayKey) {
                    alert(t('agent_page.please_select_day', 'Please select a day first'));
                    return;
                }

                const period = periodBtn.dataset.period;
                selectedPeriod = period;

                periodSelector.querySelectorAll('.period-btn').forEach(btn => btn.classList.remove('active'));
                periodBtn.classList.add('active');

                if (isMobileView()) {
                    const periodSection = document.getElementById(`mobile-period-${period}`);
                    if (periodSection) {
                        periodSection.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                        periodSection.style.transition = 'background-color 0.3s ease';
                        periodSection.style.backgroundColor = 'rgba(229, 0, 80, 0.1)';
                        setTimeout(() => {
                            periodSection.style.backgroundColor = '';
                        }, 1000);
                    }
                } else {
                    const selectedDate = selectedDateInput.value;
                    renderTimeSlots(dayKey, period, selectedDate);
                }
            });
        }

        // ============================================================
        // TIME SLOT NAVIGATION ARROWS
        // ============================================================
        if (prevTimeSlotBtn && nextTimeSlotBtn) {
            prevTimeSlotBtn.addEventListener('click', function() {
                if (timeSlotGrid) {
                    timeSlotGrid.scrollBy({ left: -150, behavior: 'smooth' });
                }
            });

            nextTimeSlotBtn.addEventListener('click', function() {
                if (timeSlotGrid) {
                    timeSlotGrid.scrollBy({ left: 150, behavior: 'smooth' });
                }
            });

            if (timeSlotGrid) {
                timeSlotGrid.addEventListener('scroll', updateTimeSlotArrows);
            }
        }

        // ============================================================
        // BOOKING STATE RESTORATION
        // ============================================================
        function restoreTimeSlotAndPayment(state) {
            requestAnimationFrame(() => {
                if (state.selectedDate && state.selectedTime && selectedDateInput && selectedTimeInput) {
                    const isMobile = isMobileView();
                    const slotSelector = isMobile
                        ? `.mobile-time-slot[data-date="${state.selectedDate}"][data-time="${state.selectedTime}"]`
                        : `.time-slot[data-date="${state.selectedDate}"][data-time="${state.selectedTime}"]`;

                    let timeSlot = document.querySelector(slotSelector);

                    if (!timeSlot && isMobile && state.selectedPeriod) {
                        const periodContainer = document.querySelector(`.mobile-period-slots[data-period="${state.selectedPeriod}"]`);
                        if (periodContainer && periodContainer.dataset.hasMore === 'true') {
                            try {
                                const remainingSlots = JSON.parse(periodContainer.dataset.remainingSlots || '[]');
                                const slotExists = remainingSlots.some(slot => slot.time === state.selectedTime);

                                if (slotExists) {
                                    const seeMoreBtn = document.querySelector('.mobile-see-more-btn');
                                    if (seeMoreBtn) {
                                        seeMoreBtn.click();
                                        (async () => {
                                            const expandedSlot = await waitForElement(slotSelector, 300, 20);
                                            if (expandedSlot) {
                                                expandedSlot.click();
                                                log('Restored mobile time slot selection (after expand):', state.selectedDate, state.selectedTime);
                                            }
                                        })();
                                    }
                                }
                            } catch (e) {
                                warn('Error checking remaining slots:', e);
                            }
                        }
                    }

                    if (timeSlot && !timeSlot.classList.contains('unavailable')) {
                        timeSlot.click();
                        log('Restored time slot selection:', state.selectedDate, state.selectedTime, isMobile ? '(mobile)' : '(desktop)');
                    } else {
                        selectedDateInput.value = state.selectedDate;
                        selectedTimeInput.value = state.selectedTime;
                        if (state.selectedDay) {
                            selectedDayInput.value = state.selectedDay;
                        }
                        if (paymentOptionsSection) {
                            paymentOptionsSection.style.display = '';
                        }
                        if (selectedDateTimeDisplay) {
                            const [yy, mm, dd] = state.selectedDate.split('-').map(Number);
                            const selectedDateObj = new Date(yy, mm - 1, dd);
                            const formattedDate = formatDate(selectedDateObj);
                            const formattedTime = formatTimeDisplay(state.selectedTime);
                            selectedDateTimeDisplay.textContent = `${formattedDate} ${dateTimeAt} ${formattedTime}`;
                        }
                        if (!timeSlot) {
                            warn('Time slot not found, restored values directly.', isMobile ? '(mobile)' : '(desktop)');
                        } else {
                            warn('Time slot is unavailable, restored values directly.');
                        }
                    }
                }

                if (state.paymentType) {
                    const paymentRadio = document.querySelector(`input[name="paymentType"][value="${state.paymentType}"]`);
                    if (paymentRadio) {
                        paymentRadio.checked = true;
                        log('Restored payment type:', state.paymentType);
                    }
                }

                if (state.termsChecked && termsCheckbox) {
                    termsCheckbox.checked = true;
                    log('Restored terms checkbox');
                }

                localStorage.removeItem('pendingBookingState');
                log('Booking state restored successfully');
            });
        }

        function restorePendingBookingState() {
            try {
                const savedState = localStorage.getItem('pendingBookingState');
                if (!savedState) return;

                const state = JSON.parse(savedState);
                log('Restoring pending booking state:', state);

                if (!config.userId) {
                    log('User not logged in yet, skipping state restoration');
                    return;
                }

                if (state.currentWeekStartDate) {
                    const [yy, mm, dd] = state.currentWeekStartDate.split('-').map(Number);
                    const savedWeekStart = new Date(yy, mm - 1, dd);
                    savedWeekStart.setHours(0, 0, 0, 0);

                    if (!isNaN(savedWeekStart.getTime()) && savedWeekStart >= today) {
                        currentWeekStart = savedWeekStart;
                        log('Restored week start to:', currentWeekStart);
                    } else if (state.selectedDate) {
                        const [sy, sm, sd] = state.selectedDate.split('-').map(Number);
                        const selectedDateObj = new Date(sy, sm - 1, sd);
                        selectedDateObj.setHours(0, 0, 0, 0);

                        if (!isNaN(selectedDateObj.getTime()) && selectedDateObj >= today) {
                            const daysToNav = getDaysToNavigate();
                            const daysDiff = Math.floor((selectedDateObj - today) / (1000 * 60 * 60 * 24));
                            const periodsToAdvance = Math.floor(daysDiff / daysToNav);

                            currentWeekStart = new Date(today);
                            currentWeekStart.setDate(today.getDate() + (periodsToAdvance * daysToNav));
                            log('Calculated week start from selected date:', currentWeekStart);
                        }
                    }
                }

                let agentFound = false;
                if (state.agentId && agentList) {
                    const agentOptions = agentList.querySelectorAll('.agent-option');
                    for (const option of agentOptions) {
                        try {
                            const agent = JSON.parse(option.dataset.agent);
                            if (agent.id === state.agentId) {
                                agentFound = true;
                                option.click();
                                log('Restored agent selection:', agent.name);
                                break;
                            }
                        } catch (e) {
                            warn('Error parsing agent data:', e);
                        }
                    }
                }

                if (!agentFound && state.agentId) {
                    warn('Agent not found in list, cannot restore booking state');
                    localStorage.removeItem('pendingBookingState');
                    return;
                }

                setTimeout(() => {
                    if (state.selectedDate && selectedDateInput) {
                        let dayColumn = document.querySelector(`.day-column[data-date="${state.selectedDate}"]`);

                        if (!dayColumn) {
                            log('Day column not found in current view, attempting to navigate to correct week...');

                            const [sy, sm, sd] = state.selectedDate.split('-').map(Number);
                            const targetDate = new Date(sy, sm - 1, sd);
                            targetDate.setHours(0, 0, 0, 0);

                            const daysToNav2 = getDaysToNavigate();
                            let attempts = 0;
                            const maxAttempts = 120;

                            while (!dayColumn && attempts < maxAttempts) {
                                const periodEnd = new Date(currentWeekStart);
                                periodEnd.setDate(periodEnd.getDate() + (daysToNav2 - 1));

                                if (targetDate >= currentWeekStart && targetDate <= periodEnd) {
                                    updateWeekDisplay();
                                    renderDaysHeader();
                                    updatePrevWeekButtonState();
                                    dayColumn = document.querySelector(`.day-column[data-date="${state.selectedDate}"]`);
                                    break;
                                }

                                currentWeekStart.setDate(currentWeekStart.getDate() + daysToNav2);
                                updateWeekDisplay();
                                renderDaysHeader();
                                updatePrevWeekButtonState();

                                dayColumn = document.querySelector(`.day-column[data-date="${state.selectedDate}"]`);
                                attempts++;
                            }

                            if (dayColumn) {
                                log('Found day column after navigating', attempts, 'periods');
                            }
                        }

                        if (dayColumn) {
                            dayColumn.click();
                            log('Restored day selection:', state.selectedDate);

                            const isMobile = isMobileView();

                            (async () => {
                                if (isMobile) {
                                    await new Promise(r => requestAnimationFrame(r));

                                    if (state.selectedPeriod && periodSelector) {
                                        selectedPeriod = state.selectedPeriod;
                                        const periodBtn = periodSelector.querySelector(`[data-period="${state.selectedPeriod}"]`);
                                        if (periodBtn) {
                                            periodBtn.classList.add('active');
                                            log('Restored period selection (mobile):', state.selectedPeriod);
                                        }
                                    }
                                    restoreTimeSlotAndPayment(state, false);
                                } else {
                                    // Desktop: grouped view is rendered by day click handler
                                    // Just set the period internally and wait for grouped slots to render
                                    if (state.selectedPeriod) {
                                        selectedPeriod = state.selectedPeriod;
                                        log('Restored period internally (desktop grouped):', state.selectedPeriod);
                                    }

                                    // Wait for the grouped container to have time slots rendered
                                    const slotSelector = `.slots-grouped-container .time-slot[data-date="${state.selectedDate}"][data-time="${state.selectedTime}"]`;
                                    await waitForElement(slotSelector, 800, 30);

                                    restoreTimeSlotAndPayment(state);
                                }
                            })();
                        } else {
                            warn('Day column not found for date:', state.selectedDate);
                            if (state.selectedDay) {
                                selectedDayInput.value = state.selectedDay;
                            }
                            if (state.selectedDate) {
                                selectedDateInput.value = state.selectedDate;
                            }
                            restoreTimeSlotAndPayment(state, true);
                        }
                    } else {
                        warn('No selected date in saved state');
                        restoreTimeSlotAndPayment(state, true);
                    }
                }, 100);
            } catch (error) {
                console.error('Error restoring pending booking state:', error);
                localStorage.removeItem('pendingBookingState');
            }
        }

        restorePendingBookingState();

        // ============================================================
        // EMAIL HELPER FUNCTIONS
        // ============================================================
        function parseBookingDate(bookingTimeString) {
            if (!bookingTimeString) return null;
            try {
                const datePart = bookingTimeString.split(' at ')[0];
                if (!datePart) return null;
                const date = new Date(datePart);
                if (isNaN(date.getTime())) return null;
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            } catch (error) {
                console.error('Error parsing booking date:', error);
                return null;
            }
        }

        function parseBookingTime(bookingTimeString, bookTimeField) {
            if (bookTimeField) return bookTimeField;
            if (!bookingTimeString) return null;
            try {
                const timePart = bookingTimeString.split(' at ')[1];
                if (!timePart) return null;
                const timeMatch = timePart.match(/(\d+):(\d+):\d+\s+(AM|PM)/i);
                if (timeMatch) {
                    let hour = parseInt(timeMatch[1]);
                    const minute = timeMatch[2];
                    const ampm = timeMatch[3].toUpperCase();
                    if (ampm === 'PM' && hour !== 12) hour += 12;
                    else if (ampm === 'AM' && hour === 12) hour = 0;
                    return `${hour}:${minute}`;
                }
                const fallbackMatch = timePart.match(/(\d+):(\d+):/);
                if (fallbackMatch) {
                    return `${parseInt(fallbackMatch[1])}:${fallbackMatch[2]}`;
                }
                return null;
            } catch (error) {
                console.error('Error parsing booking time:', error);
                return null;
            }
        }

        function getMapLink(lat, lng, address) {
            if (lat != null && lng != null) {
                return `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}&travelmode=transit`;
            } else if (address != null && address !== '') {
                return `https://www.google.com/maps/dir/?api=1&destination=${encodeURIComponent(address)}&travelmode=transit`;
            }
            return "";
        }

        async function sendBookingEmails(payload) {
            try {
                const userInfo = payload.userInfo || {};
                const serviceInfo = payload.services?.[0] || {};
                const serviceProviderInfo = payload.serviceProviderInfo || {};
                const serviceData = payload.serviceData || {};

                const clientName = userInfo.name || 'Customer';
                const clientEmail = userInfo.email;
                const serviceName = serviceInfo.serviceName || '';
                const salonName = serviceData.companyName || '';
                const ownerName = serviceProviderInfo.name || serviceData.ownerName || '';
                const ownerEmail = serviceProviderInfo.email || serviceData.ownerMail || null;
                const address = payload.address || serviceData.companyAddress || '';
                const bookingAmount = serviceInfo.servicePrice || payload.amount || 0;

                const spLocation = serviceData.spLocation || {};
                const geometry = spLocation.geometry || {};
                const location = geometry.location || {};
                const lat = location.lat;
                const lng = location.lng;
                const mapLink = getMapLink(lat, lng, address);

                const bookingDate = parseBookingDate(payload.booking_time);
                const bookingTime = parseBookingTime(payload.booking_time, payload.bookTime);

                if (clientEmail && bookingDate && bookingTime) {
                    try {
                        await fetch(config.backendUrl + '/api/send-email', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                to: clientEmail,
                                type: 'bookingCreated',
                                lang: currentLocale,
                                data: {
                                    clientName: clientName,
                                    serviceName: serviceName,
                                    salonName: salonName,
                                    date: bookingDate,
                                    time: bookingTime,
                                    address: address,
                                    mapLink: mapLink
                                }
                            })
                        });
                    } catch (e) { console.error('Error sending customer email:', e); }
                }

                if (ownerEmail && bookingDate && bookingTime) {
                    try {
                        const formattedAmount = `${parseFloat(bookingAmount).toFixed(2)}`;
                        await fetch(config.backendUrl + '/api/send-email', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                to: ownerEmail,
                                type: 'providerNewBookingReceived',
                                lang: currentLocale,
                                data: {
                                    proName: ownerName,
                                    clientName: clientName,
                                    serviceName: serviceName,
                                    date: bookingDate,
                                    time: bookingTime,
                                    bookingAmount: formattedAmount
                                }
                            })
                        });
                    } catch (e) { console.error('Error sending provider email:', e); }
                }
            } catch (error) {
                console.error('Error in sendBookingEmails:', error);
            }
        }

        // ============================================================
        // FORM SUBMISSION
        // ============================================================
        if (form) {
            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                if (!chosenAgent) {
                    alert(t('agent_page.please_select_agent', 'Please select an agent'));
                    return;
                }
                if (!selectedDateInput?.value || !selectedTimeInput?.value) {
                    alert(t('agent_page.please_select_time_slot', 'Please select a time slot'));
                    return;
                }

                let bookingAgent = chosenAgent;
                if (isNoPreferenceMode || chosenAgent.id === 'no_preference') {
                    const selectedTime = selectedTimeInput.value;
                    const slotWithAgents = cachedAvailableSlots?.find(slot => slot.time === selectedTime);

                    if (slotWithAgents && slotWithAgents.agents && slotWithAgents.agents.length > 0) {
                        const firstAgentId = slotWithAgents.agents[0];
                        const matchingAgent = allAgents.find(a => a.id === firstAgentId);
                        if (matchingAgent) {
                            bookingAgent = matchingAgent;
                            log('No preference mode - assigned agent:', bookingAgent.name);
                        } else {
                            bookingAgent = allAgents[0] || chosenAgent;
                            log('No preference mode - fallback to first agent:', bookingAgent.name);
                        }
                    } else if (allAgents.length > 0) {
                        bookingAgent = allAgents[0];
                        log('No preference mode - using first available agent:', bookingAgent.name);
                    }
                }

                const termsCheckboxEl = document.getElementById('termsConditions');
                const termsErrorEl = document.getElementById('termsError');
                if (!termsCheckboxEl || !termsCheckboxEl.checked) {
                    if (termsErrorEl) {
                        termsErrorEl.style.display = 'block';
                    }
                    if (termsCheckboxEl) {
                        termsCheckboxEl.focus();
                        termsCheckboxEl.classList.add('is-invalid');
                        termsCheckboxEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    return;
                } else {
                    if (termsErrorEl) {
                        termsErrorEl.style.display = 'none';
                    }
                    if (termsCheckboxEl) {
                        termsCheckboxEl.classList.remove('is-invalid');
                    }
                }

                setButtonLoading(true);

                const userData = config.userData || {};
                const userId = config.userId || userData.id || null;

                let apiUserData = { phone: null, countryCode: null };
                if (userId) {
                    apiUserData = await fetchUserDataFromAPI(userId);
                    log('API user data fetched:', apiUserData);
                }

                const name = (userData.name && userData.name.trim()) ? userData.name.trim() : (apiUserData.name || null);
                const email = (userData.email && userData.email.trim()) ? userData.email.trim() : null;
                const phone = apiUserData.phone || ((userData.phone && userData.phone.trim()) ? userData.phone.trim() : null);

                log('User data for booking:', {
                    id: userId,
                    name: name,
                    email: email,
                    phone: phone,
                    apiUserData: apiUserData,
                    userData: userData,
                    config: config
                });

                const paymentType = document.querySelector('input[name="paymentType"]:checked').value;

                const urlParams = new URLSearchParams(window.location.search);
                const serviceId = config.service?.id || config.serviceId || urlParams.get('serviceId');
                const serviceProviderId = config.service?.ownerId || config.serviceProviderId || urlParams.get('service_provider_id');

                const [year, month, day] = selectedDateInput.value.split('-').map(Number);
                const [hour, minute] = selectedTimeInput.value.split(':').map(Number);
                const localDate = new Date(year, (month - 1), day, hour, minute, 0, 0);

                function formatForApi(d) {
                    const monthNamesApi = [
                        'January', 'February', 'March', 'April', 'May', 'June',
                        'July', 'August', 'September', 'October', 'November', 'December'
                    ];
                    const months = monthNamesApi[d.getMonth()];
                    const dayNum = d.getDate();
                    const yearNum = d.getFullYear();
                    const hours = String(d.getHours()).padStart(2, '0');
                    const minutes = String(d.getMinutes()).padStart(2, '0');
                    const seconds = '00';

                    const tzOffsetMin = -d.getTimezoneOffset();
                    const sign = tzOffsetMin >= 0 ? '+' : '-';
                    const absMin = Math.abs(tzOffsetMin);
                    const tzHours = Math.floor(absMin / 60);
                    const tzStr = `UTC${sign}${tzHours}`;

                    return `${months} ${dayNum}, ${yearNum} at ${hours}:${minutes}:${seconds} ${tzStr}`;
                }

                const bookingTime = formatForApi(localDate);
                const bookTimeMatch = bookingTime.match(/at (\d+):(\d+):/);
                const bookTime = bookTimeMatch ? `${bookTimeMatch[1]}:${bookTimeMatch[2]}` : null;

                const serviceName = config.service?.service_name || 'Selected Service';
                const servicePrice = parseFloat(config.service?.discounted_price ?? config.service?.service_price ?? 0) || 0;
                const durationMinutes = (config.service?.duration_minutes ?? 0);

                if (!userId) {
                    setButtonLoading(false);
                    localStorage.setItem('book_appointment_url', window.location.href);

                    const pendingBookingState = {
                        agentId: chosenAgent?.id || null,
                        agent: chosenAgent || null,
                        selectedDate: selectedDateInput?.value || '',
                        selectedTime: selectedTimeInput?.value || '',
                        selectedDay: selectedDayInput?.value || '',
                        selectedPeriod: selectedPeriod || null,
                        paymentType: document.querySelector('input[name="paymentType"]:checked')?.value || null,
                        termsChecked: termsCheckboxEl?.checked || false,
                        currentWeekStartDate: formatDateValue(currentWeekStart)
                    };
                    localStorage.setItem('pendingBookingState', JSON.stringify(pendingBookingState));
                    log('Saved pending booking state:', pendingBookingState);

                    const loginModalElement = document.getElementById('loginModal');
                    if (loginModalElement) {
                        loginModalElement.classList.add('show');
                        document.body.classList.add('modal-open');
                    }
                    return;
                }

                // RESCHEDULE MODE
                if (isRescheduleMode) {
                    try {
                        log('Reschedule mode - calling reschedule API');

                        let idToken = null;
                        try {
                            const auth = window.firebaseAuth || (typeof firebase !== 'undefined' && firebase.auth());
                            if (auth && auth.currentUser) {
                                idToken = await auth.currentUser.getIdToken(true);
                                log('Got Firebase ID token for reschedule');
                            }
                        } catch (tokenError) {
                            log('Could not get Firebase token, will use session auth:', tokenError.message);
                        }

                        const headers = {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': config.csrfToken,
                        };
                        if (idToken) {
                            headers['Authorization'] = `Bearer ${idToken}`;
                        }

                        const rescheduleResponse = await fetch(`/api/bookings/${rescheduleId}/reschedule`, {
                            method: 'PUT',
                            headers: headers,
                            credentials: 'same-origin',
                            body: JSON.stringify({
                                booking_time: bookingTime,
                                bookTime: bookTime,
                                agentId: bookingAgent?.id || null,
                                agentName: bookingAgent?.name || null,
                            })
                        });

                        const rescheduleData = await rescheduleResponse.json();
                        log('Reschedule API response:', rescheduleData);

                        if (!rescheduleResponse.ok || !rescheduleData.success) {
                            throw new Error(rescheduleData.message || t('bookings.reschedule_error', 'Failed to reschedule booking'));
                        }

                        setButtonLoading(false);
                        window.location.href = config.myBookingsUrl + '?rescheduled=1';
                        return;
                    } catch (rescheduleError) {
                        console.error('Error rescheduling booking:', rescheduleError);
                        setButtonLoading(false);
                        alert(rescheduleError.message || t('bookings.reschedule_error', 'An error occurred while rescheduling'));
                        return;
                    }
                }

                if (!serviceId || !serviceProviderId) {
                    setButtonLoading(false);
                    alert("Missing 'serviceId' or 'service_provider_id' in URL.");
                    return;
                }

                // Get deposit percentage
                const depositLabelElement = document.getElementById('payDepositLabel');
                let depositPercentage = null;
                if (depositLabelElement) {
                    const labelText = depositLabelElement.textContent || depositLabelElement.innerText;
                    const percentageMatch = labelText.match(/(\d+)%/);
                    if (percentageMatch) {
                        depositPercentage = parseFloat(percentageMatch[1]);
                    }
                }

                if (depositPercentage === null) {
                    const depositPercentageInput = document.getElementById('depositPercentage');
                    depositPercentage = depositPercentageInput ? parseFloat(depositPercentageInput.value) : null;

                    if (depositPercentage === null || isNaN(depositPercentage)) {
                        const service = config.service || {};
                        const spDeposit = service.spDeposit || 0;
                        const commission = service.commission || {};
                        const minimumBookingPercentage = commission.minimum_booking_percentage || 0;
                        const commissionValue = commission.commission || 0;

                        if (spDeposit > 0) {
                            depositPercentage = spDeposit;
                        } else if (minimumBookingPercentage > 0) {
                            depositPercentage = minimumBookingPercentage;
                        } else if (commissionValue > 0) {
                            depositPercentage = commissionValue;
                        } else {
                            depositPercentage = 0;
                        }
                    }
                }

                // Get service provider info
                log('=== SERVICE PROVIDER INFO DEBUG ===');
                log('Full service object:', config.service);
                log('ownerMail:', config.service?.ownerMail);
                log('ownerProfile:', config.service?.ownerProfile);
                log('ownerName:', config.service?.ownerName);
                log('ownerId:', config.service?.ownerId);

                let ownerMail = config.service?.ownerMail ||
                               config.service?.owner_mail ||
                               config.service?.ownerEmail ||
                               null;
                let ownerProfile = config.service?.ownerProfile ||
                                  config.service?.owner_profile ||
                                  config.service?.ownerPhoto ||
                                  null;

                // Fallback API fetch for owner info
                if ((!ownerMail || !ownerProfile) && (config.servicesSlug || config.serviceId)) {
                    warn('ownerMail or ownerProfile missing, attempting API fallback...');
                    try {
                        const apiUrl = config.servicesSlug
                            ? `${config.firebaseUrl}/getServiceById?services_slug=${encodeURIComponent(config.servicesSlug)}`
                            : `${config.firebaseUrl}/getServiceById?service_id=${encodeURIComponent(config.serviceId)}`;

                        const apiResponse = await fetch(apiUrl);
                        if (apiResponse.ok) {
                            const apiData = await apiResponse.json();
                            const apiService = apiData?.service || {};

                            log('API fallback response:', apiService);

                            if (!ownerMail && apiService.ownerMail) {
                                ownerMail = apiService.ownerMail;
                                log('Retrieved ownerMail from API:', ownerMail);
                            }
                            if (!ownerProfile && apiService.ownerProfile) {
                                ownerProfile = apiService.ownerProfile;
                                log('Retrieved ownerProfile from API:', ownerProfile);
                            }

                            if (config.service) {
                                config.service.ownerMail = ownerMail || config.service.ownerMail;
                                config.service.ownerProfile = ownerProfile || config.service.ownerProfile;
                                if (!config.service.companyAddress && apiService.companyAddress) {
                                    config.service.companyAddress = apiService.companyAddress;
                                }
                                if (!config.service.address && apiService.address) {
                                    config.service.address = apiService.address;
                                }
                            }
                        }
                    } catch (apiError) {
                        console.error('Error fetching service data from API fallback:', apiError);
                    }
                }

                log('Resolved ownerMail:', ownerMail);
                log('Resolved ownerProfile:', ownerProfile);
                log('===================================');

                const serviceProviderInfo = {
                    email: ownerMail,
                    id: serviceProviderId || null,
                    name: config.service?.companyName || config.service?.ownerName || null,
                    photo: ownerProfile
                };

                log('Constructed serviceProviderInfo:', serviceProviderInfo);

                const address = config.service?.address ||
                               config.service?.companyAddress ||
                               config.service?.serviceProviderAddress ||
                               config.service?.location ||
                               config.service?.serviceLocation ||
                               null;

                log('Resolved address:', address);

                const amount = Math.round(servicePrice * 100) / 100;

                let countryCode = apiUserData.countryCode || null;
                if (!countryCode && phone) {
                    const phoneMatch = phone.match(/^\+(\d{1,3})/);
                    if (phoneMatch) {
                        countryCode = '+' + phoneMatch[1];
                    }
                }

                const userPhoto = config.userData?.photoURL || config.userData?.photo || null;

                const bookingPayload = {
                    booking_time: bookingTime,
                    bookTime: bookTime,
                    service_provider_id: serviceProviderId,
                    serviceProviderInfo: serviceProviderInfo,
                    userId: userId,
                    depositPercentage: depositPercentage,
                    address: address,
                    amount: amount,
                    bookingOrigin: 'website',
                    services: [
                        {
                            serviceId: serviceId,
                            serviceName: serviceName,
                            durationMinutes: durationMinutes,
                            discountedPrice: servicePrice,
                            servicePrice: servicePrice,
                            isCompleted: false,
                            startTime: bookingTime,
                            agentId: bookingAgent?.id || null,
                            agentName: bookingAgent?.name || 'Selected Agent'
                        }
                    ],
                    userInfo: {
                        id: userId,
                        name: name,
                        email: email || null,
                        phone: phone,
                        countryCode: countryCode,
                        photo: userPhoto
                    },
                    serviceData: config.service || null
                };

                const formDataToStore = {
                    name,
                    email,
                    phone,
                    selectedDate: selectedDateInput.value,
                    selectedTime: selectedTimeInput.value,
                    agentId: bookingAgent?.id || null,
                    agentName: bookingAgent?.name || 'Selected Agent'
                };

                try {
                    localStorage.setItem('bookingFormData', JSON.stringify(formDataToStore));
                    localStorage.setItem('bookingPayload', JSON.stringify(bookingPayload));

                    log('Preparing to send checkout request with data:', {
                        serviceId,
                        serviceProviderId,
                        serviceName,
                        servicePrice,
                        paymentType,
                        depositPercentage,
                        formData: formDataToStore
                    });

                    const isFreeBooking = (depositPercentage === 0 && paymentType === 'deposit');

                    if (isFreeBooking) {
                        log('Free booking detected, calling bookService Cloud Function');

                        try {
                            const freeTransactionId = 'FREE_' + Date.now();

                            const freeBookingPayload = {
                                ...bookingPayload,
                                payment_id: freeTransactionId,
                                payment_type: paymentType,
                                payed: false
                            };

                            const bookingResponse = await fetch(config.firebaseUrl + '/bookService', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify(freeBookingPayload)
                            });

                            const bookingResponseData = await bookingResponse.json();
                            log('Free booking Cloud Function response:', bookingResponseData);

                            if (bookingResponse.ok && bookingResponseData.booking_id) {
                                log('Free booking created successfully:', bookingResponseData.booking_id);

                                localStorage.removeItem('pendingBookingState');
                                localStorage.removeItem('bookingFormData');
                                localStorage.removeItem('bookingPayload');

                                window.location.href = config.myBookingsUrl;
                            } else {
                                setButtonLoading(false);
                                alert('Error submitting booking: ' + (bookingResponseData.message || bookingResponseData.error || 'Unknown error'));
                                console.error('Error submitting booking:', bookingResponseData);
                            }
                        } catch (bookingError) {
                            setButtonLoading(false);
                            console.error('Error submitting free booking:', bookingError);
                            alert('An error occurred while submitting your booking: ' + bookingError.message);
                        }
                        return;
                    }

                    // Paid bookings - Stripe checkout
                    const checkoutUrl = config.checkoutUrl;

                    // Deterministic idempotency key to prevent duplicate payments on retry/double-click
                    const depositPct = Number(depositPercentage) || 0;
                    const amountToCharge = paymentType === 'deposit'
                        ? (depositPct > 0 ? (servicePrice * (depositPct / 100)) : 0)
                        : servicePrice;
                    const amountCents = Math.round(amountToCharge * 100);
                    const idempotencyKey = 'web_' + serviceProviderId + '_' + (config.userId || '') + '_' + serviceId
                        + '_' + paymentType + '_' + selectedDateInput.value + '_' + selectedTimeInput.value + '_' + amountCents;

                    const response = await (window.authFetch || fetch)(checkoutUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': config.csrfToken,
                        },
                        body: JSON.stringify({
                            serviceId,
                            serviceProviderId,
                            serviceName,
                            servicePrice,
                            paymentType,
                            depositPercentage,
                            idempotencyKey,
                            serviceData: config.service || null,
                            formData: formDataToStore,
                            bookingData: bookingPayload
                        })
                    });

                    if (!response.ok) {
                        setButtonLoading(false);
                        const errorText = await response.text();
                        console.error('Error response:', response.status, errorText);

                        if (response.status === 401) {
                            const loginModalEl = document.getElementById('loginModal');
                            if (loginModalEl) {
                                loginModalEl.classList.add('show');
                                document.body.classList.add('modal-open');
                                return;
                            }
                        }
                        throw new Error(`Server responded with ${response.status}: ${errorText}`);
                    }

                    const session = await response.json();
                    log('Received session:', session);

                    if (session.error) {
                        setButtonLoading(false);
                        alert('Error: ' + session.error);
                        return;
                    }

                    localStorage.removeItem('pendingBookingState');

                    const stripePublishableKey = config.stripeConfig?.publishableKey;
                    if (!stripePublishableKey) {
                        setButtonLoading(false);
                        alert('Stripe configuration not loaded. Please refresh the page and try again.');
                        console.error('Stripe publishable key not available');
                        return;
                    }
                    const stripe = Stripe(stripePublishableKey);

                    const isStripeConnect = session.useStripeConnect || false;
                    log('Redirecting to Stripe checkout with session ID:', session.id, '| Mode:', config.stripeConfig?.isLive ? 'LIVE' : 'TEST', '| Connect:', isStripeConnect);

                    const result = await stripe.redirectToCheckout({
                        sessionId: session.id
                    });

                    if (result.error) {
                        setButtonLoading(false);
                        alert('Error: ' + result.error.message);
                    }
                } catch (err) {
                    console.error('Error in form submission:', err);
                    setButtonLoading(false);
                    alert('An error occurred: ' + err.message);
                }
            });
        }

        // ============================================================
        // TEST STRIPE BUTTON (DEBUG)
        // ============================================================
        const testStripeBtn = document.getElementById('testStripeBtn');
        if (testStripeBtn) {
            testStripeBtn.addEventListener('click', async function() {
                try {
                    const stripePublishableKey = config.stripeConfig?.publishableKey;
                    if (!stripePublishableKey) {
                        alert('Stripe configuration not loaded. Please refresh the page and try again.');
                        console.error('Stripe publishable key not available');
                        return;
                    }
                    const stripe = Stripe(stripePublishableKey);
                    log('Test button clicked, Stripe initialized | Mode:', config.stripeConfig?.isLive ? 'LIVE' : 'TEST');

                    const response = await (window.authFetch || fetch)(config.checkoutUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': config.csrfToken,
                        },
                        body: JSON.stringify({
                            serviceId: '1',
                            serviceProviderId: '1',
                            serviceName: 'Test Service',
                            servicePrice: 1.00,
                            paymentType: 'full',
                            formData: {
                                name: 'Test User',
                                email: 'test@example.com',
                                phone: '1234567890'
                            },
                            bookingData: {
                                booking_time: 'Test Time',
                                service_provider_id: '1',
                                user_id: '1',
                                services: [
                                    {
                                        serviceId: '1',
                                        serviceName: 'Test Service',
                                        durationMinutes: 30,
                                        discountedPrice: 1.00,
                                        servicePrice: 1.00,
                                        isCompleted: false,
                                        startTime: 'Test Time',
                                        agentId: '1',
                                    }
                                ]
                            }
                        })
                    });

                    if (!response.ok) {
                        const errorText = await response.text();
                        console.error('Error response:', response.status, errorText);
                        throw new Error(`Server responded with ${response.status}: ${errorText}`);
                    }

                    const session = await response.json();
                    log('Test session created:', session);

                    if (session.error) {
                        alert('Error creating test session: ' + session.error);
                        return;
                    }

                    log('Redirecting to Stripe checkout with test session ID:', session.id);
                    const result = await stripe.redirectToCheckout({
                        sessionId: session.id
                    });

                    if (result.error) {
                        alert('Error in test redirect: ' + result.error.message);
                    }
                } catch (err) {
                    console.error('Test button error:', err);
                    alert('Test failed: ' + err.message);
                }
            });
        }

        // ============================================================
        // WINDOW RESIZE HANDLER
        // ============================================================
        let resizeTimeout;
        let lastMobileState = isMobileView();
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                if (chosenAgent && agentSchedule && agentSchedule.style.display !== 'none') {
                    const currentMobileState = isMobileView();

                    if (currentMobileState !== lastMobileState) {
                        const activeDay = document.querySelector('.day-column.active');
                        if (activeDay && cachedAvailableSlots) {
                            const dayKey = selectedDayInput.value;
                            const selectedDate = selectedDateInput.value;

                            if (currentMobileState) {
                                // Switching to mobile: show mobile time slots, hide grouped container
                                if (dayKey && selectedDate) {
                                    renderTimeSlotsMobile(dayKey, selectedDate);
                                    if (mobileTimeSlotsContainer) {
                                        mobileTimeSlotsContainer.style.display = '';
                                    }
                                    if (timeSlotsStrip) {
                                        timeSlotsStrip.style.display = 'none';
                                    }
                                    if (slotsGroupedContainer) {
                                        slotsGroupedContainer.style.display = 'none';
                                    }
                                    if (periodSelector) {
                                        periodSelector.style.display = 'none';
                                    }
                                }
                            } else {
                                // Switching to desktop: show grouped 3-column layout
                                if (dayKey && selectedDate) {
                                    renderTimeSlotsGrouped();
                                }
                                if (mobileTimeSlotsContainer) {
                                    mobileTimeSlotsContainer.style.display = 'none';
                                }
                            }
                        }
                        lastMobileState = currentMobileState;
                    }

                    updateWeekDisplay();
                    renderDaysHeader();
                    updatePrevWeekButtonState();
                }
            }, 250);
        });
    });
})();
