document.addEventListener('DOMContentLoaded', function () {
  // // Cache configuration - 15 minutes (900 seconds) to match backend cache
  // const CACHE_DURATION = 15 * 60 * 1000; // 15 minutes in milliseconds
  // Cache configuration - 24 hours
  const CACHE_DURATION = 24 * 60 * 60 * 1000; // 24 hours in milliseconds

  // Pagination state variables
  let lastDocId = null;
  let hasMore = true;
  let isLoadingMore = false;
  let isInitialLoad = true;
  let currentCategoryId = null;

  // Fetch categories from API and display them
  fetchAndDisplayCategories();

  // Fetch providers from API
  const searchParam = new URLSearchParams(window.location.search).get('search');
  const locationParam = new URLSearchParams(window.location.search).get('location');

  // Only fetch if we're not viewing a specific provider (no provider_id in URL)
  const providerIdParam = new URLSearchParams(window.location.search).get('provider_id');
  if (!providerIdParam) {
    fetchProviders(searchParam, locationParam);
  }

  // Setup infinite scroll listener
  setupInfiniteScroll();

  // Helper function to display categories
  function displayCategories(categories) {
    const filterPillsContainer = document.getElementById('categoryFilterPills');
    if (!filterPillsContainer) return;

    // Handle "All" button click (it's hardcoded in Blade)
    const allButton = filterPillsContainer.querySelector('[data-category="all"]');
    if (allButton) {
      // Clone to remove old listeners if any, or just ensure we don't double bind if function re-runs
      // But since fetchAndDisplayCategories runs once, simple addEventListener is fine? 
      // Safest to remove old listener or just add it here only if not added. 
      // Actually, let's just add it here.
      allButton.addEventListener('click', function () {
        // Visuals
        const pills = filterPillsContainer.querySelectorAll('.filter-pill');
        pills.forEach(p => {
          p.classList.remove('active');
          p.setAttribute('aria-current', 'false');
        });
        this.classList.add('active');
        this.setAttribute('aria-current', 'true');

        // Reset to default search
        fetchProviders();
      });
    }

    // Filter only active categories and sort by sortOrder
    const activeCategories = categories
      .filter(cat => cat.isActive === true)
      .sort((a, b) => (a.sortOrder || 0) - (b.sortOrder || 0));

    // Add category buttons to the filter pills container
    activeCategories.forEach(category => {
      const button = document.createElement('button');
      button.type = 'button';
      button.className = 'filter-pill';
      button.setAttribute('data-category', category.name);
      button.setAttribute('data-id', category.id);
      button.setAttribute('aria-current', 'false');

      // Add click listener for filtering
      button.addEventListener('click', function () {
        const categoryId = this.getAttribute('data-id');

        // Update active state
        const pills = filterPillsContainer.querySelectorAll('.filter-pill');
        pills.forEach(p => {
          p.classList.remove('active');
          p.setAttribute('aria-current', 'false');
        });
        this.classList.add('active');
        this.setAttribute('aria-current', 'true');

        // Fetch providers for this category
        fetchProvidersByCategory(categoryId);
      });

      // Create icon image if imageUrl exists
      if (category.imageUrl) {
        const icon = document.createElement('img');
        icon.src = category.imageUrl;
        icon.alt = category.name;
        icon.className = 'category-icon';
        button.appendChild(icon);
      }

      // Add category name
      const textNode = document.createTextNode(category.name);
      button.appendChild(textNode);

      filterPillsContainer.appendChild(button);
    });
  }

  // Function to fetch categories from API and display them
  async function fetchAndDisplayCategories() {
    const filterPillsContainer = document.getElementById('categoryFilterPills');
    if (!filterPillsContainer) return;

    try {
      // Check cache for categories first
      const categoriesCacheKey = 'categories_cache';
      try {
        const cached = localStorage.getItem(categoriesCacheKey);
        if (cached) {
          const cacheData = JSON.parse(cached);
          const now = Date.now();
          // Cache categories for 24 hours
          if (now - cacheData.timestamp < CACHE_DURATION) {
            displayCategories(cacheData.categories);
            return;
          } else {
            localStorage.removeItem(categoriesCacheKey);
          }
        }
      } catch (cacheError) {
        console.warn('Error reading categories cache:', cacheError);
      }

      const response = await fetch('https://us-central1-beauty-984c8.cloudfunctions.net/getSortedCategories');

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const categories = await response.json();

      if (!Array.isArray(categories)) {
        console.error('Categories API did not return an array');
        return;
      }

      // Cache the categories
      try {
        const cacheData = {
          categories: categories,
          timestamp: Date.now()
        };
        localStorage.setItem(categoriesCacheKey, JSON.stringify(cacheData));
      } catch (cacheError) {
        console.warn('Error caching categories:', cacheError);
      }

      // Display categories
      displayCategories(categories);

    } catch (error) {
      console.error('Error fetching categories:', error);
    }
  }

  // Helper function to get cache key for providers (first page only)
  function getProvidersCacheKey(search, location) {
    return `salons_cache_${search || 'all'}_${location || 'all'}`;
  }

  // Helper function to get cached providers (first page only)
  function getCachedProviders(search, location) {
    try {
      const cacheKey = getProvidersCacheKey(search, location);
      const cached = localStorage.getItem(cacheKey);
      if (!cached) return null;

      const cacheData = JSON.parse(cached);
      const now = Date.now();

      // Check if cache is still valid
      if (now - cacheData.timestamp < CACHE_DURATION) {
        return cacheData;
      } else {
        // Cache expired, remove it
        localStorage.removeItem(cacheKey);
        return null;
      }
    } catch (error) {
      console.warn('Error reading cache:', error);
      return null;
    }
  }

  // Helper function to cache providers (first page only with pagination info)
  function cacheProviders(search, location, providers, pagination) {
    try {
      const cacheKey = getProvidersCacheKey(search, location);
      const cacheData = {
        providers: providers,
        pagination: pagination,
        timestamp: Date.now()
      };
      localStorage.setItem(cacheKey, JSON.stringify(cacheData));
    } catch (error) {
      console.warn('Error caching providers:', error);
      // If storage quota exceeded, try to clear old cache entries
      try {
        const keys = Object.keys(localStorage);
        keys.forEach(key => {
          if (key.startsWith('salons_cache_')) {
            localStorage.removeItem(key);
          }
        });
        // Retry caching
        const cacheKey = getProvidersCacheKey(search, location);
        const cacheData = {
          providers: providers,
          pagination: pagination,
          timestamp: Date.now()
        };
        localStorage.setItem(cacheKey, JSON.stringify(cacheData));
      } catch (retryError) {
        console.warn('Failed to cache providers after cleanup:', retryError);
      }
    }
  }

  // Function to setup infinite scroll
  function setupInfiniteScroll() {
    // console.log('Infinite scroll listener setup');

    // Throttle scroll event to improve performance
    let tick = false;

    window.addEventListener('scroll', function () {
      if (!tick) {
        window.requestAnimationFrame(function () {
          handleScroll();
          tick = false;
        });
        tick = true;
      }
    });
  }

  function handleScroll() {
    // Don't trigger if already loading or no more data
    if (isLoadingMore || !hasMore) return;

    // Check if user is near the bottom of the page (within 300px)
    const scrollPosition = window.scrollY + window.innerHeight;

    // Robust height calculation
    const body = document.body;
    const html = document.documentElement;
    const pageHeight = Math.max(
      body.scrollHeight, body.offsetHeight,
      html.clientHeight, html.scrollHeight, html.offsetHeight
    );
    // const pageHeight = document.documentElement.scrollHeight;

    const distanceToBottom = pageHeight - scrollPosition;

    // Debug log only if close to bottom to avoid spamming
    if (distanceToBottom < 1000) {
      // console.log(`Scroll: pos=${Math.round(scrollPosition)}, height=${pageHeight}, diff=${Math.round(distanceToBottom)}, hasMore=${hasMore}, lastDocId=${lastDocId}`);
    }

    if (distanceToBottom < 700) {
      // Trigger load more
      console.log('Triggering load more...');
      loadMoreProviders();
    }
  }

  // Function to load more providers (for infinite scroll)
  async function loadMoreProviders() {
    // Debug why it might return early
    if (isLoadingMore) { console.log('Skipping: already loading'); return; }
    if (!hasMore) { console.log('Skipping: no more data'); return; }
    if (!lastDocId) { console.log('Skipping: no lastDocId'); return; }

    isLoadingMore = true;
    console.log(`Loading more... lastDocId: ${lastDocId}`);

    const loadMoreEl = document.getElementById('providers-load-more');
    if (loadMoreEl) loadMoreEl.style.display = 'flex';

    try {
      // Build API URL with lastDocId for pagination
      let apiUrl;
      if (currentCategoryId) {
        apiUrl = `https://us-central1-beauty-984c8.cloudfunctions.net/getSalonsByCategory?categoryId=${currentCategoryId}&lastDocId=${encodeURIComponent(lastDocId)}`;
      } else {
        apiUrl = 'https://us-central1-beauty-984c8.cloudfunctions.net/getAllProviders?status=active';
        apiUrl += '&lastDocId=' + encodeURIComponent(lastDocId);
      }

      const response = await fetch(apiUrl);

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();
      const providers = data.providers || [];
      const pagination = data.pagination || {};

      console.log(`Loaded ${providers.length} more providers`);

      // Update pagination state
      lastDocId = pagination.lastDocId || null;
      hasMore = pagination.hasMore === true;

      console.log(`New state: lastDocId=${lastDocId}, hasMore=${hasMore}`);

      // Hide load more spinner
      if (loadMoreEl) loadMoreEl.style.display = 'none';

      if (providers.length > 0) {
        // Append providers to the grid (don't clear existing)
        appendProviders(providers);
      }

    } catch (error) {
      console.error('Error loading more providers:', error);
      if (loadMoreEl) loadMoreEl.style.display = 'none';
    } finally {
      isLoadingMore = false;
    }
  }

  // Function to fetch providers from API (initial load)
  async function fetchProviders(search = null, location = null) {
    const loadingEl = document.getElementById('providers-loading');
    const errorEl = document.getElementById('providers-error');
    const emptyEl = document.getElementById('providers-empty');
    const gridEl = document.getElementById('providers-grid');

    // Reset pagination state for fresh search
    lastDocId = null;
    hasMore = true;
    isInitialLoad = true;
    currentCategoryId = null;

    // Show loading, hide others
    if (loadingEl) loadingEl.style.display = 'flex';
    if (errorEl) errorEl.style.display = 'none';
    if (emptyEl) emptyEl.style.display = 'none';
    if (gridEl) gridEl.style.display = 'none';

    // Determine if this is a search with parameters or just listing all providers
    const hasSearchParams = search || location;

    // Check cache first (only for initial load without search params)
    if (!hasSearchParams) {
      const cachedData = getCachedProviders(search, location);
      if (cachedData && cachedData.providers) {
        // Use cached data
        if (loadingEl) loadingEl.style.display = 'none';

        if (!Array.isArray(cachedData.providers) || cachedData.providers.length === 0) {
          if (emptyEl) emptyEl.style.display = 'flex';
          return;
        }

        // Restore pagination state from cache
        if (cachedData.pagination) {
          lastDocId = cachedData.pagination.lastDocId || null;
          hasMore = cachedData.pagination.hasMore === true;
        }

        // Render cached providers
        renderProviders(cachedData.providers);
        isInitialLoad = false;
        return;
      }
    }

    try {
      let apiUrl;
      let providers;
      let pagination = null;

      if (hasSearchParams) {
        // USE OLD searchProviders API for search with parameters (no pagination changes)
        apiUrl = 'https://us-central1-beauty-984c8.cloudfunctions.net/searchProviders';
        const params = new URLSearchParams();
        if (search) params.append('name', search);
        if (location) params.append('location', location);
        if (params.toString()) {
          apiUrl += '?' + params.toString();
        }

        const response = await fetch(apiUrl);

        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }

        // searchProviders returns array directly
        providers = await response.json();

        // Disable infinite scroll for search results (no pagination)
        hasMore = false;
        lastDocId = null;

      } else {
        // USE NEW getAllProviders API for listing all providers (with pagination)
        apiUrl = 'https://us-central1-beauty-984c8.cloudfunctions.net/getAllProviders?status=active';

        const response = await fetch(apiUrl);

        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        providers = data.providers || [];
        pagination = data.pagination || {};

        // Update pagination state
        lastDocId = pagination.lastDocId || null;
        hasMore = pagination.hasMore === true;

        // Cache the first page of providers (only when no search params)
        if (Array.isArray(providers)) {
          cacheProviders(search, location, providers, pagination);
        }
      }

      // Hide loading
      if (loadingEl) loadingEl.style.display = 'none';

      if (!Array.isArray(providers) || providers.length === 0) {
        if (emptyEl) emptyEl.style.display = 'flex';
        return;
      }

      // Render providers
      renderProviders(providers);
      isInitialLoad = false;

    } catch (error) {
      console.error('Error fetching providers:', error);
      if (loadingEl) loadingEl.style.display = 'none';
      if (errorEl) {
        errorEl.style.display = 'flex';
        const errorMsg = document.getElementById('providers-error-message');
        if (errorMsg) {
          errorMsg.textContent = 'Failed to load providers. Please check your connection and try again.';
        }
      }
    }
  }

  // Function to fetch providers by category
  async function fetchProvidersByCategory(categoryId) {
    if (!categoryId) return;

    const loadingEl = document.getElementById('providers-loading');
    const errorEl = document.getElementById('providers-error');
    const emptyEl = document.getElementById('providers-empty');
    const gridEl = document.getElementById('providers-grid');
    const loadMoreEl = document.getElementById('providers-load-more');

    // Reset pagination state (enable infinite scroll for category view)
    currentCategoryId = categoryId;
    hasMore = true;
    lastDocId = null;
    isLoadingMore = false;

    // Show loading state
    if (loadingEl) loadingEl.style.display = 'flex';
    if (errorEl) errorEl.style.display = 'none';
    if (emptyEl) emptyEl.style.display = 'none';
    if (gridEl) {
      gridEl.innerHTML = '';
      gridEl.style.display = 'none';
    }
    if (loadMoreEl) loadMoreEl.style.display = 'none';

    try {
      const response = await fetch(`https://us-central1-beauty-984c8.cloudfunctions.net/getSalonsByCategory?categoryId=${categoryId}`);

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();
      const providers = data.providers || data;
      const pagination = data.pagination || {};

      // Update pagination state
      lastDocId = pagination.lastDocId || null;
      hasMore = pagination.hasMore === true;

      if (loadingEl) loadingEl.style.display = 'none';

      if (Array.isArray(providers) && providers.length > 0) {
        if (gridEl) {
          // Use appendProviders logic but we need to clear grid first which we did above
          // Reuse createProviderCard logic inside appendProviders/renderProviders
          providers.forEach(provider => {
            const providerCard = createProviderCard(provider);
            gridEl.appendChild(providerCard);
          });
          gridEl.style.display = 'grid';
          initializeProviderTooltips();
        }
      } else {
        if (emptyEl) emptyEl.style.display = 'block';
      }

    } catch (error) {
      console.error('Error fetching category providers:', error);
      if (loadingEl) loadingEl.style.display = 'none';
      if (errorEl) {
        errorEl.style.display = 'block';
        const errorMsg = errorEl.querySelector('p');
        if (errorMsg) errorMsg.textContent = 'Failed to load providers. Please try again.';
      }
    }
  }

  // Make fetchProviders available globally for retry button
  window.fetchProviders = function () {
    const searchParam = new URLSearchParams(window.location.search).get('search');
    const locationParam = new URLSearchParams(window.location.search).get('location');
    fetchProviders(searchParam, locationParam);
  };

  // Function to render providers in the grid (clears existing)
  function renderProviders(providers) {
    const gridEl = document.getElementById('providers-grid');
    if (!gridEl) return;

    gridEl.innerHTML = '';

    providers.forEach(provider => {
      const providerCard = createProviderCard(provider);
      gridEl.appendChild(providerCard);
    });

    // Show grid
    gridEl.style.display = 'grid';

    // Initialize tooltips for the new cards
    initializeProviderTooltips();


  }

  // Function to append providers to the grid (for infinite scroll, doesn't clear)
  function appendProviders(providers) {
    const gridEl = document.getElementById('providers-grid');
    if (!gridEl) return;

    providers.forEach(provider => {
      const providerCard = createProviderCard(provider);
      gridEl.appendChild(providerCard);
    });

    // Initialize tooltips for the new cards
    initializeProviderTooltips();
  }

  // Function to create a provider card element
  function createProviderCard(provider) {
    // Use global variable for default image, with fallback
    const defaultImage = window.defaultProviderImage || '/images/default.jpeg';
    const providerImage = provider.profileImg || defaultImage;
    const companyName = provider.companyName || provider.name || 'No Name';
    const avgRating = provider.avg_ratting || 0;
    const totalReviews = provider.total_review || 0;
    const address = provider.address || '';
    const providerId = provider.id || '';
    const username = provider.companyUserName || provider.username || '';
    const timing = provider.timing || {};

    // Create provider URL - use username if available, fallback to provider_id
    const providerUrl = username ? `/${encodeURIComponent(username)}` : `/recherche?provider_id=${encodeURIComponent(providerId)}`;

    // Create timing status
    const timingStatus = calculateTimingStatus(timing);

    // Create the card
    const item = document.createElement('div');
    item.className = 'results-item';
    item.setAttribute('data-categories', ''); // Empty for now

    item.innerHTML = `
      <div class="provider-card">
        <a href="${providerUrl}" class="provider-link">
          <div class="provider-image">
            <div class="provider-image-inner">
              <img src="${escapeHtml(providerImage)}" 
                   alt="${escapeHtml(companyName)}" 
                   class="img-fluid"
                   loading="lazy"
                   onerror="this.src='${defaultImage}'">
              <div class="image-overlay">
                <div class="overlay-left">
                  ${provider.companyName ? `<span class="overlay-meta">${escapeHtml(provider.companyName)}</span>` : ''}
                </div>
              </div>
            </div>
          </div>
          <div class="provider-details p-4">
            <div class="provider-card-heading-section">
              <h3 class="card-title">${escapeHtml(companyName)}</h3>
              <div class="rating-row">
                <img src="images/images/star_cards.svg" alt="Location" width="15" height="15">
                <span class="rating-value">${avgRating.toFixed(1)}</span>
                <span class="rating-count">(${totalReviews})</span>
              </div>
            </div>
            <div class="provider-meta">
              ${address ? `
                <div class="address">
                  <span class="search-icon search-icon-sm" aria-hidden="true">
                    <img src="images/images/mage_map-marker-fill.svg" alt="Location" width="20" height="20">
                  </span>
                  <span style="color: #666666;">${escapeHtml(address)}</span>
                </div>
              ` : ''}
            </div>
            ${timingStatus.html || ''}
            ${timingStatus.availabilityHtml || ''}
          </div>
        </a>
      </div>
    `;

    // Add tooltip if needed
    if (timingStatus.tooltipHtml) {
      const tooltipContainer = document.createElement('div');
      tooltipContainer.innerHTML = timingStatus.tooltipHtml;
      document.body.appendChild(tooltipContainer.firstElementChild);
    }

    // Add click handler to store provider data in sessionStorage before navigation
    const providerLink = item.querySelector('.provider-link');
    if (providerLink) {
      providerLink.addEventListener('click', function (e) {
        // Store provider data in sessionStorage for fast loading on provider page
        const cacheKey = username ? `provider_data_${username}` : `provider_data_${providerId}`;
        const cacheData = {
          provider: provider,
          timestamp: Date.now(),
          username: username,
          providerId: providerId
        };
        try {
          sessionStorage.setItem(cacheKey, JSON.stringify(cacheData));
        } catch (error) {
          console.warn('Failed to store provider data in sessionStorage:', error);
        }
      });
    }

    return item;
  }

  // Function to calculate timing status and availability
  function calculateTimingStatus(timing) {
    if (!timing || typeof timing !== 'object') {
      return { html: '', tooltipHtml: '', availabilityHtml: '', cardId: '' };
    }

    // Get translations from global variable (fallback to English if not available)
    const translations = window.providerTranslations || {};
    const t = {
      open: translations.open || 'Open',
      closed: translations.closed || 'Closed',
      hours_unavailable: translations.hours_unavailable || 'Hours unavailable',
      next_availability: translations.next_availability || 'Next Availability',
      morning: translations.morning || 'Morning',
      evening: translations.evening || 'Evening',
      no_time_availability: translations.no_time_availability || 'No time availability',
      monday: translations.monday || 'Monday',
      tuesday: translations.tuesday || 'Tuesday',
      wednesday: translations.wednesday || 'Wednesday',
      thursday: translations.thursday || 'Thursday',
      friday: translations.friday || 'Friday',
      saturday: translations.saturday || 'Saturday',
      sunday: translations.sunday || 'Sunday',
    };

    const daysOrder = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    const dayNamesMap = {
      'Mon': t.monday.substring(0, 3), // Short day names
      'Tue': t.tuesday.substring(0, 3),
      'Wed': t.wednesday.substring(0, 3),
      'Thu': t.thursday.substring(0, 3),
      'Fri': t.friday.substring(0, 3),
      'Sat': t.saturday.substring(0, 3),
      'Sun': t.sunday.substring(0, 3)
    };
    const fullDayNamesMap = {
      'Mon': t.monday,
      'Tue': t.tuesday,
      'Wed': t.wednesday,
      'Thu': t.thursday,
      'Fri': t.friday,
      'Sat': t.saturday,
      'Sun': t.sunday
    };

    const now = new Date();
    const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    const todayKey = dayNames[now.getDay()];
    const cardId = 'prov_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);

    // Format time range helper
    function formatRange(range) {
      if (!Array.isArray(range) || range.length < 2 || !range[0] || !range[1]) {
        return null;
      }
      try {
        const open = new Date(range[0] * 1000);
        const close = new Date(range[1] * 1000);
        const openTime = open.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
        const closeTime = close.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
        return openTime + ' – ' + closeTime;
      } catch (e) {
        return null;
      }
    }

    const todayRange = timing[todayKey] || [];
    const todayRangeText = formatRange(todayRange);
    const isOpenToday = todayRangeText !== null;

    // Build status HTML
    const statusHtml = `
      <div class="timing-status" data-tooltip-id="timing-tooltip-${cardId}">
        <span class="search-icon search-icon-sm" aria-hidden="true">
          <span class="status-dot ${isOpenToday ? 'open' : 'closed'}"></span>
        </span>
        <span class="status-text" style="color: #666666;">
          ${isOpenToday
        ? t.open + ' · ' + todayRangeText
        : t.closed + ' · ' + t.hours_unavailable}
        </span>
      </div>
    `;

    // Build tooltip HTML
    const tooltipHtml = `
      <div class="timing-tooltip" id="timing-tooltip-${cardId}" aria-hidden="true">
        <div class="timing-tooltip-inner">
          ${daysOrder.map(day => {
      const rangeText = formatRange(timing[day] || []);
      const isToday = todayKey === day;
      return `
              <div class="timing-row ${isToday ? 'today' : ''}">
                <span class="timing-day">${fullDayNamesMap[day] || day}</span>
                <span class="timing-hours">${rangeText || t.closed}</span>
              </div>
            `;
    }).join('')}
        </div>
      </div>
    `;

    // Build availability section (next 3 days with morning/evening slots)
    const chipDays = [];
    for (let i = 0; i < 3; i++) {
      const d = new Date(now);
      d.setDate(now.getDate() + i);
      const dayKey = dayNames[d.getDay()];
      const dayLabel = dayNamesMap[dayKey] || dayKey;
      const dayNumber = d.getDate().toString().padStart(2, '0');

      const dayTiming = timing[dayKey] || [];
      const hasTimeSlot = Array.isArray(dayTiming) && dayTiming.length >= 2 && dayTiming[0] && dayTiming[1];
      const timeSlotText = hasTimeSlot ? formatRange(dayTiming) : t.no_time_availability;

      chipDays.push({
        label: dayLabel,
        day: dayNumber,
        dayKey: dayKey,
        hasTimeSlot: hasTimeSlot,
        timeSlotText: timeSlotText
      });
    }

    const availabilityHtml = `
      <div class="availability-section">
        <div class="availability-title">${t.next_availability}</div>
        <div class="availability-row">
          <span class="time-of-day">${t.morning}</span>
          <div class="chip-group">
            ${chipDays.map(cd => `
              <span class="date-chip ${cd.hasTimeSlot ? 'has-slot' : 'no-slot'}" 
                    data-tooltip="${escapeHtml(cd.timeSlotText)}">
                ${cd.label} <b>${cd.day}</b>
                <span class="date-chip-tooltip">${escapeHtml(cd.timeSlotText)}</span>
              </span>
            `).join('')}
          </div>
        </div>
        <div class="availability-row">
          <span class="time-of-day">${t.evening}</span>
          <div class="chip-group">
            ${chipDays.map(cd => `
              <span class="date-chip ${cd.hasTimeSlot ? 'has-slot' : 'no-slot'}" 
                    data-tooltip="${escapeHtml(cd.timeSlotText)}">
                ${cd.label} <b>${cd.day}</b>
                <span class="date-chip-tooltip">${escapeHtml(cd.timeSlotText)}</span>
              </span>
            `).join('')}
          </div>
        </div>
      </div>
    `;

    return {
      html: statusHtml,
      tooltipHtml: tooltipHtml,
      availabilityHtml: availabilityHtml,
      cardId: cardId
    };
  }

  // Helper function to escape HTML
  function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  // Function to initialize tooltips for provider cards
  function initializeProviderTooltips() {
    const containers = document.querySelectorAll('.provider-card');
    containers.forEach(function (card) {
      const status = card.querySelector('.timing-status');
      if (!status) return;
      const tooltipId = status.getAttribute('data-tooltip-id');
      const tooltip = tooltipId ? document.getElementById(tooltipId) : null;
      if (!tooltip) return;

      // Ensure tooltip is in body
      if (tooltip.parentElement !== document.body) {
        document.body.appendChild(tooltip);
      }

      function positionTooltip() {
        const rect = status.getBoundingClientRect();
        const top = rect.top + rect.height + 8;
        let left = rect.left;
        const maxLeft = window.innerWidth - tooltip.offsetWidth - 8;
        if (left > maxLeft) left = Math.max(8, maxLeft);
        tooltip.style.top = top + 'px';
        tooltip.style.left = left + 'px';
      }

      function show() {
        tooltip.style.display = 'block';
        positionTooltip();
      }

      function hide() {
        tooltip.style.display = 'none';
      }

      status.addEventListener('mouseenter', show);
      status.addEventListener('mouseleave', function () {
        setTimeout(function () {
          if (!tooltip.matches(':hover')) hide();
        }, 100);
      });
      tooltip.addEventListener('mouseleave', hide);
      tooltip.addEventListener('mouseenter', function () {
        tooltip.style.display = 'block';
      });

      status.addEventListener('click', function (e) {
        e.preventDefault();
        if (tooltip.style.display === 'block') {
          hide();
        } else {
          show();
        }
      });

      window.addEventListener('scroll', function () {
        if (tooltip.style.display === 'block') positionTooltip();
      });
      window.addEventListener('resize', function () {
        if (tooltip.style.display === 'block') positionTooltip();
      });
    });
  }

  // Function to initialize category filters (placeholder for now)
  function initializeCategoryFilters() {
    // Categories will be empty for now since we removed service fetching
    // This can be enhanced later if needed
  }

  // Delegate hover/click for timing tooltips
  const containers = document.querySelectorAll('.provider-card');
  containers.forEach(function (card) {
    const status = card.querySelector('.timing-status');
    if (!status) return;
    const tooltipId = status.getAttribute('data-tooltip-id');
    const tooltip = tooltipId ? document.getElementById(tooltipId) : null;
    if (!tooltip) return;

    // Ensure tooltip is appended to body to avoid overflow clipping
    if (tooltip.parentElement !== document.body) {
      document.body.appendChild(tooltip);
    }

    // Position tooltip near status
    function positionTooltip() {
      const rect = status.getBoundingClientRect();
      const top = rect.top + rect.height + 8; // pixels from viewport top
      let left = rect.left; // pixels from viewport left
      // Keep inside viewport horizontally
      const maxLeft = window.innerWidth - tooltip.offsetWidth - 8;
      if (left > maxLeft) left = Math.max(8, maxLeft);
      tooltip.style.top = top + 'px';
      tooltip.style.left = left + 'px';
    }

    function show() { tooltip.style.display = 'block'; positionTooltip(); }
    function hide() { tooltip.style.display = 'none'; }

    // Hover behavior
    status.addEventListener('mouseenter', show);
    status.addEventListener('mouseleave', function () {
      setTimeout(function () {
        // Only hide if not hovered over tooltip
        if (!tooltip.matches(':hover')) hide();
      }, 100);
    });
    tooltip.addEventListener('mouseleave', hide);
    // Also keep visible when moving from status to tooltip
    tooltip.addEventListener('mouseenter', function () { tooltip.style.display = 'block'; });
    tooltip.addEventListener('mouseenter', function () { /* keep visible */ });

    // Click toggle for mobile
    status.addEventListener('click', function (e) {
      e.preventDefault();
      if (tooltip.style.display === 'block') { hide(); } else { show(); }
    });

    window.addEventListener('scroll', function () { if (tooltip.style.display === 'block') positionTooltip(); });
    window.addEventListener('resize', function () { if (tooltip.style.display === 'block') positionTooltip(); });
  });



  // Search autocomplete functionality
  const searchInput = document.getElementById('searchInput');
  const suggestionsDropdown = document.getElementById('searchSuggestionsDropdown');
  let debounceTimer = null;
  let currentSuggestions = { providers: [], services: [] };
  let selectedIndex = -1;
  let allSuggestions = []; // Flat array of all suggestion items for keyboard navigation

  if (searchInput && suggestionsDropdown) {
    // Debounce function to limit API calls
    function debounce(func, wait) {
      return function (...args) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => func.apply(this, args), wait);
      };
    }

    // Store original input value for hover functionality
    let originalInputValue = '';

    // Fetch suggestions from API
    async function fetchSuggestions(query) {
      if (!query || query.trim().length === 0) {
        hideSuggestions();
        return;
      }

      try {
        const response = await fetch(
          `https://us-central1-beauty-984c8.cloudfunctions.net/searchServiceSuggestions?query=${encodeURIComponent(query)}`
        );

        if (response.ok) {
          const data = await response.json();
          // Extract both providers and services from the response
          const providers = data.providers || [];
          const services = data.services || [];

          if ((Array.isArray(providers) && providers.length > 0) || (Array.isArray(services) && services.length > 0)) {
            displaySuggestions(providers, services);
          } else {
            hideSuggestions();
          }
        } else {
          hideSuggestions();
        }
      } catch (error) {
        // Silently handle errors - don't show dropdown on error
        hideSuggestions();
      }
    }

    // Display suggestions in dropdown with section headings
    function displaySuggestions(providers, services) {
      currentSuggestions = { providers: providers || [], services: services || [] };
      suggestionsDropdown.innerHTML = '';
      allSuggestions = [];
      selectedIndex = -1;

      let hasContent = false;

      // Display Providers section
      if (providers && providers.length > 0) {
        hasContent = true;

        // Create section heading
        const providerHeading = document.createElement('div');
        providerHeading.className = 'search-suggestion-heading';
        providerHeading.textContent = 'Salon';
        suggestionsDropdown.appendChild(providerHeading);

        // Create provider items
        providers.forEach((provider) => {
          const item = createSuggestionItem(provider.name, 'provider', provider.id);
          suggestionsDropdown.appendChild(item);
          allSuggestions.push({ element: item, name: provider.name, type: 'provider', id: provider.id });
        });
      }

      // Display Services section
      if (services && services.length > 0) {
        hasContent = true;

        // Create section heading (only if providers section exists)
        if (providers && providers.length > 0) {
          const divider = document.createElement('div');
          divider.className = 'search-suggestion-divider';
          suggestionsDropdown.appendChild(divider);
        }

        const serviceHeading = document.createElement('div');
        serviceHeading.className = 'search-suggestion-heading';
        serviceHeading.textContent = 'Services';
        suggestionsDropdown.appendChild(serviceHeading);

        // Create service items
        services.forEach((service) => {
          const item = createSuggestionItem(service.name, 'service', service.id, service.provider_id);
          suggestionsDropdown.appendChild(item);
          allSuggestions.push({ element: item, name: service.name, type: 'service', id: service.id, providerId: service.provider_id });
        });
      }

      if (hasContent) {
        suggestionsDropdown.classList.add('show');
      } else {
        hideSuggestions();
      }
    }

    // Create a suggestion item with hover functionality
    function createSuggestionItem(name, type, id, providerId = null) {
      const item = document.createElement('div');
      item.className = 'search-suggestion-item';
      item.setAttribute('data-type', type);
      item.setAttribute('data-id', id);
      if (providerId) {
        item.setAttribute('data-provider-id', providerId);
      }
      item.textContent = name;

      // Store original input value on first hover (only once)
      let isFirstHover = true;

      // Fill input on hover (like Google search)
      item.addEventListener('mouseenter', () => {
        if (isFirstHover) {
          originalInputValue = searchInput.value;
          isFirstHover = false;
        }
        searchInput.value = name;
        // Update selected index when hovering
        const index = allSuggestions.findIndex(s => s.element === item);
        if (index !== -1) {
          setSelectedIndex(index);
        }
      });

      // Click handler - keep the value filled
      item.addEventListener('click', () => {
        searchInput.value = name;
        originalInputValue = name; // Update original so blur doesn't restore
        hideSuggestions();
        // Optionally navigate or submit form
        searchInput.focus();
      });

      return item;
    }

    // Set selected index and update highlighting
    function setSelectedIndex(index) {
      // Remove previous selection
      if (selectedIndex >= 0 && allSuggestions[selectedIndex]) {
        allSuggestions[selectedIndex].element.classList.remove('selected');
      }

      // Set new selection
      selectedIndex = index;
      if (selectedIndex >= 0 && selectedIndex < allSuggestions.length) {
        allSuggestions[selectedIndex].element.classList.add('selected');
        searchInput.value = allSuggestions[selectedIndex].name;

        // Scroll into view if needed
        allSuggestions[selectedIndex].element.scrollIntoView({
          block: 'nearest',
          behavior: 'smooth'
        });
      }
    }

    // Handle keyboard navigation
    function handleKeyboardNavigation(e) {
      if (!suggestionsDropdown.classList.contains('show') || allSuggestions.length === 0) {
        return;
      }

      switch (e.key) {
        case 'ArrowDown':
          e.preventDefault();
          if (selectedIndex < allSuggestions.length - 1) {
            setSelectedIndex(selectedIndex + 1);
          } else {
            setSelectedIndex(0); // Loop to first
          }
          break;

        case 'ArrowUp':
          e.preventDefault();
          if (selectedIndex > 0) {
            setSelectedIndex(selectedIndex - 1);
          } else {
            setSelectedIndex(allSuggestions.length - 1); // Loop to last
          }
          break;

        case 'Enter':
          e.preventDefault();
          if (selectedIndex >= 0 && selectedIndex < allSuggestions.length) {
            const selected = allSuggestions[selectedIndex];
            searchInput.value = selected.name;
            originalInputValue = selected.name;
            hideSuggestions();
            // Optionally submit form or navigate
            searchInput.focus();
          }
          break;

        case 'Escape':
          e.preventDefault();
          hideSuggestions();
          searchInput.focus();
          break;
      }
    }

    // Hide suggestions dropdown
    function hideSuggestions() {
      suggestionsDropdown.classList.remove('show');
      suggestionsDropdown.innerHTML = '';
      currentSuggestions = { providers: [], services: [] };
      allSuggestions = [];
      selectedIndex = -1;
      // Restore original input value if it was changed by hover
      if (originalInputValue && searchInput.value !== originalInputValue) {
        searchInput.value = originalInputValue;
        originalInputValue = '';
      }
    }

    // Debounced search function
    const debouncedSearch = debounce((query) => {
      fetchSuggestions(query);
    }, 300);

    // Get the search-title element
    const searchTitle = searchInput.closest('.search-content')?.querySelector('.search-title');

    // Function to toggle search-title visibility
    function toggleSearchTitle() {
      if (searchTitle) {
        if (searchInput.value.trim().length > 0 || document.activeElement === searchInput) {
          searchTitle.style.display = 'none';
        } else {
          searchTitle.style.display = '';
        }
      }
    }

    // Listen for input events
    searchInput.addEventListener('input', (e) => {
      const query = e.target.value.trim();
      debouncedSearch(query);
      toggleSearchTitle();
      // Reset selection on new input
      selectedIndex = -1;
    });

    // Keyboard navigation
    searchInput.addEventListener('keydown', handleKeyboardNavigation);

    // Show/hide title on focus
    searchInput.addEventListener('focus', () => {
      if (searchTitle) {
        searchTitle.style.display = 'none';
      }
      if (searchInput.value.trim().length > 0 &&
        ((currentSuggestions.providers && currentSuggestions.providers.length > 0) ||
          (currentSuggestions.services && currentSuggestions.services.length > 0))) {
        displaySuggestions(currentSuggestions.providers || [], currentSuggestions.services || []);
      }
    });

    // Hide suggestions when input loses focus (with small delay to allow click on suggestion)
    searchInput.addEventListener('blur', () => {
      setTimeout(() => {
        hideSuggestions();
        toggleSearchTitle();
      }, 200);
    });

    // Initial check for existing value
    toggleSearchTitle();
  }

  // Location input field - same functionality
  const locationInput = document.getElementById('locationInput');
  if (locationInput) {
    const locationTitle = locationInput.closest('.search-content')?.querySelector('.search-title');

    // Function to toggle location title visibility
    function toggleLocationTitle() {
      if (locationTitle) {
        if (locationInput.value.trim().length > 0 || document.activeElement === locationInput) {
          locationTitle.style.display = 'none';
        } else {
          locationTitle.style.display = '';
        }
      }
    }

    // Listen for input events
    locationInput.addEventListener('input', () => {
      toggleLocationTitle();
    });

    // Show/hide title on focus
    locationInput.addEventListener('focus', () => {
      if (locationTitle) {
        locationTitle.style.display = 'none';
      }
    });

    // Show/hide title on blur
    locationInput.addEventListener('blur', () => {
      toggleLocationTitle();
    });

    // Initial check for existing value
    toggleLocationTitle();

    // Hide suggestions on form submit
    const searchForm = searchInput.closest('form');
    if (searchForm) {
      searchForm.addEventListener('submit', () => {
        hideSuggestions();
      });
    }

    // Hide suggestions when clicking outside
    document.addEventListener('click', (e) => {
      if (!searchInput.contains(e.target) && !suggestionsDropdown.contains(e.target)) {
        hideSuggestions();
      }
    });
  }
});
