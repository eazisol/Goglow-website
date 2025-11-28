@extends('layouts.mainInnerPages')

@section('title', 'Salon Videos')

@section('content')

    <!-- Page Header Start -->
    <div class="page-header bg-section" style="margin-bottom: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>

    {{-- search bar start (inner search preserved) --}}

        <div class="container">
                            <div class="search-section" style="margin: 30px 0!important;padding: 15px!important;box-shadow: 0 8px 24px rgba(16, 24, 40, 0.08);">
                                <form action="{{ route('search') }}" method="GET">
                                    <div class="search-row">
                                        <div class="search-item">
                                            <div class="search-icon">
                                                <img src="{{ asset('images/images/Vector.svg') }}" alt="Search" width="32" height="32" aria-hidden="true">
                                            </div>
                                            <div class="search-content">
                                                <h3 class="search-title">{{ __('app.home.search_input_text') }}</h3>
                                                <div class="search-suggestions-container">
                                                    <input type="search" class="searchInput" id="searchInput" name="search" placeholder="{{ __('app.home.search_service_placeholder') }}" value="{{ $search ?? '' }}" required>
                                                    <div class="search-suggestions-dropdown" id="searchSuggestionsDropdown"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="divider"></div>

                                        <div class="search-item">
                                            <div class="search-icon">
                                                <img src="{{ asset('images/images/mage_map-marker-fill.svg') }}" alt="Location" width="32" height="32" aria-hidden="true">
                                            </div>
                                            <div class="search-content">
                                                <h3 class="search-title">{{ __('app.home.search_or_text') ?? 'Location' }}</h3>
                                                <input type="text" class="searchInput" id="locationInput" name="location" placeholder="{{ __('app.home.search_location_placeholder') }}" value="{{ $location ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="divider"></div>

                                        <button type="submit" class="btn-primary" style="margin-left: auto;">
                                            {{ __('app.home.search_button') }}
                                            <img src="{{ asset('images/images/Arrow_Right.svg') }}" alt="" width="16" height="16">
                                        </button>
                                    </div>
                                </form>
                            </div>
        </div>

    {{-- search bar end --}}
    <!-- Page Header End -->
     <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>

<!-- Videos Section Start -->
<div class="search-results" style="margin: 0 0 50px 0;">
    <div class="container">
                            <div class="service-filter-pills" role="tablist" aria-label="Service categories" id="categoryFilterPills">
                                <button type="button" class="filter-pill active" data-category="all" aria-current="true">All</button>
                                {{-- Categories will be loaded via JavaScript from API --}}
                            </div>

    <!-- View Type Tabs Section Start -->
    <div class="view-type-tabs-container" style="margin-top: 20px;">
        <div class="view-type-tabs">
            <a href="{{ route('search') }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}" class="view-tab" data-view="list">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 5H17.5M2.5 10H17.5M2.5 15H17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M2.5 2.5H5.83333V5H2.5V2.5Z" fill="currentColor"/>
                </svg>
                <span>Salon List</span>
            </a>
            <a href="{{ route('search.videos') }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}" class="view-tab active" data-view="videos">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2.5" y="4.16667" width="15" height="11.6667" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M8.33333 7.5L13.3333 10L8.33333 12.5V7.5Z" fill="currentColor"/>
                </svg>
                <span>Salon Videos</span>
            </a>
        </div>
    </div>
    <!-- View Type Tabs Section End -->

        <div class="videos-container">
            <p>Videos content will be displayed here</p>
        </div>
    </div>
</div>
<!-- Videos Section End -->
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
<style>
    /* View Type Tabs Styling */
    .view-type-tabs {
        display: flex;
        gap: 0;
        border: none;
        background: transparent;
        margin: 30px 0;
        width: fit-content;
    }

    .view-tab {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        text-decoration: none;
        color: #6b7280;
        font-weight: 500;
        font-size: 16px;
        transition: all 0.3s ease;
        position: relative;
        background: transparent;
        border: none;
    }

    .view-tab:hover {
        color: rgba(229, 0, 80, 1);
    }

    .view-tab.active {
        color: rgba(229, 0, 80, 1);
        background: transparent;
    }

    .view-tab.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: rgba(229, 0, 80, 1);
    }

    .view-tab svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    .view-tab span {
        white-space: nowrap;
    }

    @media (max-width: 640px) {
        .view-type-tabs {
            width: 100%;
            justify-content: flex-start;
        }
        
        .view-tab {
            padding: 10px 16px;
            font-size: 14px;
        }
        
        .view-tab svg {
            width: 18px;
            height: 18px;
        }
    }

    /* Category filter pills with icons */
    .service-filter-pills .filter-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .service-filter-pills .filter-pill .category-icon {
        width: 20px;
        height: 20px;
        margin-right: 8px;
        vertical-align: middle;
        object-fit: contain;
        flex-shrink: 0;
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Fetch categories from API and display them
  fetchAndDisplayCategories();
  
  // Search autocomplete functionality (same as provider-results)
  const searchInput = document.getElementById('searchInput');
  const suggestionsDropdown = document.getElementById('searchSuggestionsDropdown');

  // Function to fetch categories from API and display them
  async function fetchAndDisplayCategories() {
    const filterPillsContainer = document.getElementById('categoryFilterPills');
    if (!filterPillsContainer) return;
    
    try {
      const response = await fetch('https://us-central1-beauty-984c8.cloudfunctions.net/getSortedCategories');
      
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      
      const categories = await response.json();
      
      if (!Array.isArray(categories)) {
        console.error('Categories API did not return an array');
        return;
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
        button.setAttribute('aria-current', 'false');
        
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
      
    } catch (error) {
      console.error('Error fetching categories:', error);
    }
  }
  let debounceTimer = null;
  let currentSuggestions = { providers: [], services: [] };
  let selectedIndex = -1;
  let allSuggestions = [];

  if (searchInput && suggestionsDropdown) {
    // Debounce function to limit API calls
    function debounce(func, wait) {
      return function(...args) {
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
        const providerHeading = document.createElement('div');
        providerHeading.className = 'search-suggestion-heading';
        providerHeading.textContent = 'Salon';
        suggestionsDropdown.appendChild(providerHeading);
        
        providers.forEach((provider) => {
          const item = createSuggestionItem(provider.name, 'provider', provider.id);
          suggestionsDropdown.appendChild(item);
          allSuggestions.push({ element: item, name: provider.name, type: 'provider', id: provider.id });
        });
      }

      // Display Services section
      if (services && services.length > 0) {
        hasContent = true;
        if (providers && providers.length > 0) {
          const divider = document.createElement('div');
          divider.className = 'search-suggestion-divider';
          suggestionsDropdown.appendChild(divider);
        }
        
        const serviceHeading = document.createElement('div');
        serviceHeading.className = 'search-suggestion-heading';
        serviceHeading.textContent = 'Services';
        suggestionsDropdown.appendChild(serviceHeading);
        
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
      
      let isFirstHover = true;
      
      item.addEventListener('mouseenter', () => {
        if (isFirstHover) {
          originalInputValue = searchInput.value;
          isFirstHover = false;
        }
        searchInput.value = name;
        const index = allSuggestions.findIndex(s => s.element === item);
        if (index !== -1) {
          setSelectedIndex(index);
        }
      });
      
      item.addEventListener('click', () => {
        searchInput.value = name;
        originalInputValue = name;
        hideSuggestions();
        searchInput.focus();
      });
      
      return item;
    }

    // Set selected index and update highlighting
    function setSelectedIndex(index) {
      if (selectedIndex >= 0 && allSuggestions[selectedIndex]) {
        allSuggestions[selectedIndex].element.classList.remove('selected');
      }
      
      selectedIndex = index;
      if (selectedIndex >= 0 && selectedIndex < allSuggestions.length) {
        allSuggestions[selectedIndex].element.classList.add('selected');
        searchInput.value = allSuggestions[selectedIndex].name;
        
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

      switch(e.key) {
        case 'ArrowDown':
          e.preventDefault();
          if (selectedIndex < allSuggestions.length - 1) {
            setSelectedIndex(selectedIndex + 1);
          } else {
            setSelectedIndex(0);
          }
          break;
          
        case 'ArrowUp':
          e.preventDefault();
          if (selectedIndex > 0) {
            setSelectedIndex(selectedIndex - 1);
          } else {
            setSelectedIndex(allSuggestions.length - 1);
          }
          break;
          
        case 'Enter':
          e.preventDefault();
          if (selectedIndex >= 0 && selectedIndex < allSuggestions.length) {
            const selected = allSuggestions[selectedIndex];
            searchInput.value = selected.name;
            originalInputValue = selected.name;
            hideSuggestions();
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

    // Hide suggestions when input loses focus
    searchInput.addEventListener('blur', () => {
      setTimeout(() => {
        hideSuggestions();
        toggleSearchTitle();
      }, 200);
    });
    
    // Initial check for existing value
    toggleSearchTitle();
  }

  // Location input field
  const locationInput = document.getElementById('locationInput');
  if (locationInput) {
    const locationTitle = locationInput.closest('.search-content')?.querySelector('.search-title');
    
    function toggleLocationTitle() {
      if (locationTitle) {
        if (locationInput.value.trim().length > 0 || document.activeElement === locationInput) {
          locationTitle.style.display = 'none';
        } else {
          locationTitle.style.display = '';
        }
      }
    }

    locationInput.addEventListener('input', () => {
      toggleLocationTitle();
    });

    locationInput.addEventListener('focus', () => {
      if (locationTitle) {
        locationTitle.style.display = 'none';
      }
    });

    locationInput.addEventListener('blur', () => {
      toggleLocationTitle();
    });
    
    toggleLocationTitle();

    // Hide suggestions on form submit
    const searchForm = searchInput.closest('form');
    if (searchForm) {
      searchForm.addEventListener('submit', () => {
        if (suggestionsDropdown) {
          suggestionsDropdown.classList.remove('show');
        }
      });
    }

    // Hide suggestions when clicking outside
    document.addEventListener('click', (e) => {
      if (searchInput && suggestionsDropdown && !searchInput.contains(e.target) && !suggestionsDropdown.contains(e.target)) {
        if (suggestionsDropdown) {
          suggestionsDropdown.classList.remove('show');
        }
      }
    });
  }
});
</script>
@endsection

