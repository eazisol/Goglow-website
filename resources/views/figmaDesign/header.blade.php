    <!-- Navbar -->
  <nav class="navbar">
    <div class="logo">
              <!-- Logo Section -->
              <img src="images/images/WhatsApp_Image_2025-09-16_at_23.28.10_3ad6dde7-removebg-preview 1 (1).png" alt="GoGlow Logo" class="logo">
    </div>

    <div class="menu">
      <a href="#" class="active">Home</a>
      <span class="plus">+</span>
      <a href="#">About Us</a>
      <span class="plus">+</span>
      <a href="#">Services</a>
      <span class="plus">+</span>
      <a href="#">Book Appointments</a>
      <span class="plus">+</span>
      <a href="#">Reviews</a>
    </div>
    @include('partials.language-switcher')
    <a href="{{ url('/beauty-professional') }}" class="cta-btn">BECOME A GLOWER <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16"></a>
    {{-- <button class="cta-btn">BECOME A GLOWER <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16"></button> --}}
    <button class="menu-icon" id="menu-toggle">
      <img src="images/images/Frame 1618873824.svg" alt="Menu" class="menu-icon">
    </button>
  </nav>


  <!-- Sidebar for Mobile -->
  <div class="sidebar" id="sidebar">
    <button class="close-btn" id="close-btn">
      <img src="images/images/Close.svg" alt="close" style="width: 30px;">
    </button>
    <a href="#">Home</a>
    <a href="#">About Us</a>
    <a href="#">Services</a>
    <a href="#">Book Appointments</a>
    <a href="#">Reviews</a>
        <a href="{{ url('/beauty-professional') }}" class="mobile-sidebar-button">BECOME A GLOWER <img src="images/images/Arrow_Right_white_color.svg" alt="" width="16" height="16"></a>
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
  </script>

