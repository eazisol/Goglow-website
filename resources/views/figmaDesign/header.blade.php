<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Glow Navbar</title>
  <style>
    /* ---------- Base Styles ---------- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #fff6f8;
      color: #2b2b2b;
    }

    /* ---------- Navbar Container ---------- */
    .navbar {
      background: #fff6f8;
      border: 1px solid #f3d9e2;
      border-radius: 40px;
      padding:12px;
      margin: 15px auto;
      /* max-width: 1000px; */
      display: flex;
      align-items: center;
      justify-content: space-between;
      /* box-shadow: 0 1px 4px rgba(243, 21, 89, 0.1); */
    }

    /* ---------- Logo Section ---------- */
    .logo {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .logo img {
      height: 57px;
      width: 94px;
    }

    .logo span {
      font-size: 18px;
      font-weight: 500;
      color: #f31559;
    }

    /* ---------- Desktop Menu ---------- */
    .menu {
      display: flex;
      align-items: center;
      gap: 18px;
    }

    .menu a {
      text-decoration: none;
      font-size: 17px;
    font-weight: 500;
    color: #75213e;
    }

    .menu a.active {
      font-weight: 600;
    }

    .plus {
      color: #e50050;
      font-size: 22px;
      font-weight: 400;
      margin: 0 4px;
    }

    /* ---------- CTA Button ---------- */
    .cta-btn {
      background: #e50050;
      color: white;
      border: none;
      border-radius: 30px;
      padding: 19px 25px;
      font-size: 13px;
      cursor: pointer;
      transition: 0.3s;
      display: flex;
      gap: 8px;
      letter-spacing: 0.5px;
    }

    .cta-btn:hover {
      background: #d8144f;
    }

    /* ---------- Mobile Menu Icon ---------- */
    .menu-icon {
      display: none;
      background: #f31559;
      border: none;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      color: white;
      font-size: 20px;
      cursor: pointer;
      align-items: center;
      justify-content: center;
    }

    /* ---------- Sidebar (Mobile Menu) ---------- */
    .sidebar {
      position: fixed;
      top: 0;
      right: -100%;
      width: 70%;
      height: 100vh;
      background: rgba(229, 0, 80, 0.958);
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 50px;
      transition: 0.4s ease-in-out;
      z-index: 99;
      padding: 30px;
    }

    .sidebar.active {
      right: 0;
    }

    .sidebar a {
      color: white;
      font-size: 18px;
      font-weight: 500;
      text-decoration: none;
      transition: 0.3s;
    }

    .sidebar a:hover {
      text-decoration: underline;
    }

    .sidebar .cta-btn {
      background: white;
      color: #f31559;
      margin-top: 20px;
    }

    .close-btn {
      display: flex;
      justify-content: center;
      position: absolute;
      top: 20px;
      right: 20px;
      background: white;
      color: #f31559;
      border: none;
      border-radius: 50%;
      width: 45px;
      height: 45px;
      font-size: 18px;
      cursor: pointer;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 768px) {
      .menu, .cta-btn {
        display: none;
      }

      .menu-icon {
        display: flex;
      }
      .logo img {
        height: 36px;
        width: 60px;
      }
      .mobile-sidebar-button{
        background-color: white;
        padding: 15px 20px;
        border-radius: 56px;
        color: #e50050;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: 0.3s;
        border: none;
        display: flex;
        gap: 7px;
      }

    }
  </style>
</head>
<body>

<div class="container">
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

    <button class="cta-btn">BECOME A GLOWER <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16"></button>
    <button class="menu-icon" id="menu-toggle">
      <img src="images/images/Frame 1618873824.svg" alt="Menu" class="menu-icon">
    </button>
  </nav>

</div>
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
    <button class="mobile-sidebar-button">BECOME A GLOWER <img src="images/images/Arrow_Right_white_color.svg" alt="" width="16" height="16"></button>
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

</body>
</html>
