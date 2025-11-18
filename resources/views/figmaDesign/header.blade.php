    <!-- Navbar -->
  <nav class="navbar">
    <div class="logo">
              <!-- Logo Section -->
              <img src="images/images/LOGO-glaura-horizontal-couleur.png" alt="GoGlow Logo" class="logo">
    </div>

    <div class="menu">
      <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}" @if(request()->is('/')) aria-current="page" @endif>{{ __('app.nav.home') }}</a>
      <span class="plus">+</span>
      {{-- <a href="#">{{ __('app.nav.about_us') }}</a>
      <span class="plus">+</span>
      <a href="#">{{ __('app.nav.services') }}</a>
      <span class="plus">+</span> --}}
      <a href="{{ url('/search') }}" class="{{ request()->is('search*') ? 'active' : '' }}" @if(request()->is('search*')) aria-current="page" @endif>{{ __('app.nav.book_service') }}</a>
      <span class="plus">+</span>
      <a href="#">{{ __('app.nav.reviews') }}</a>
    </div>
    <div class="switcher-button">
          @include('partials.language-switcher')
          <a href="{{ url('/become-glower') }}" class="cta-btn">{{ __('app.nav.hero_section_button') }}<img src="images/images/Arrow_Right.svg" alt="" width="16" height="16"></a>
          {{-- <button class="cta-btn">BECOME A GLOWER <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16"></button> --}}
          <button class="menu-icon" id="menu-toggle">
            <img src="images/images/Frame 1618873824.svg" alt="Menu" class="menu-icon">
          </button>
          @if(session('firebase_uid'))
              <div class="profile-dropdown-container">
                  <button class="profile-icon-btn" id="profile-dropdown-toggle" aria-label="Profile menu" aria-expanded="false">
                      <img src="images/images/flowbite_user-solid.svg" alt="Profile" style="width:33px; margin-left: 5px; cursor: pointer;">
                  </button>
                  <div class="profile-dropdown-menu" id="profile-dropdown-menu">
                      <a href="#" class="dropdown-item logout-item" onclick="event.preventDefault(); document.getElementById('logout-form-figma').submit();">
                          <span>{{ __('app.nav.logout') }}</span>
                      </a>
                  </div>
              </div>
              <form id="logout-form-figma" action="{{ route('logout') }}" method="POST" style="display:none;">
                  @csrf
              </form>
          @endif
    </div>
  </nav>


  <!-- Sidebar for Mobile -->
  <div class="sidebar" id="sidebar">
    <button class="close-btn" id="close-btn">
      <img src="images/images/Close.svg" alt="close" style="width: 30px;">
    </button>
    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">{{ __('app.nav.home') }}</a>
    {{-- <a href="#">About Us</a>
    <a href="#">Services</a> --}}
    <a href="{{ url('/search') }}" class="{{ request()->is('search*') ? 'active' : '' }}">{{ __('app.nav.book_service') }}</a>
    <a href="#">{{ __('app.nav.reviews') }}</a>
        <a href="{{ url('/beauty-professional') }}" class="mobile-sidebar-button">{{ __('app.nav.hero_section_button') }} <img src="images/images/Arrow_Right_white_color.svg" alt="" width="16" height="16"></a>
    {{-- <button class="mobile-sidebar-button">BECOME A GLOWER <img src="images/images/Arrow_Right_white_color.svg" alt="" width="16" height="16"></button> --}}
    <button class="cta-btn">BECOME A GLOWER →</button>
  </div>


  <script>
    // Toggle Sidebar
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const closeBtn = document.getElementById('close-btn');

    menuToggle.addEventListener('click', () => {
      sidebar.classList.add('active');
    });

    closeBtn.addEventListener('click', () => {
      sidebar.classList.remove('active');
    });

    // Profile Dropdown Toggle
    const profileDropdownContainer = document.querySelector('.profile-dropdown-container');
    const profileDropdownToggle = document.getElementById('profile-dropdown-toggle');
    const profileDropdownMenu = document.getElementById('profile-dropdown-menu');

    if (profileDropdownToggle && profileDropdownMenu && profileDropdownContainer) {
      profileDropdownToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        const isOpen = profileDropdownMenu.classList.contains('show');
        
        // Close all dropdowns first
        document.querySelectorAll('.profile-dropdown-menu').forEach(menu => {
          menu.classList.remove('show');
        });
        
        // Toggle this dropdown
        if (!isOpen) {
          profileDropdownMenu.classList.add('show');
          profileDropdownToggle.setAttribute('aria-expanded', 'true');
        } else {
          profileDropdownToggle.setAttribute('aria-expanded', 'false');
        }
      });

      // Close dropdown when clicking outside
      document.addEventListener('click', function(e) {
        if (!profileDropdownContainer.contains(e.target)) {
          profileDropdownMenu.classList.remove('show');
          profileDropdownToggle.setAttribute('aria-expanded', 'false');
        }
      });

      // Close dropdown on Escape key
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && profileDropdownMenu.classList.contains('show')) {
          profileDropdownMenu.classList.remove('show');
          profileDropdownToggle.setAttribute('aria-expanded', 'false');
        }
      });
    }
  </script>

