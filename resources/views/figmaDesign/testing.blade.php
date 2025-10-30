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
      padding: 10px 25px;
      margin: 15px auto;
      max-width: 1000px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 1px 4px rgba(243, 21, 89, 0.1);
    }

    /* ---------- Logo Section ---------- */
    .logo {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .logo img {
      height: 30px;
      width: 30px;
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
      gap: 12px;
    }

    .menu a {
      text-decoration: none;
      color: #2b2b2b;
      font-size: 14px;
      transition: 0.3s;
    }

    .menu a.active {
      font-weight: 600;
    }

    .plus {
      color: #f31559;
      font-weight: bold;
    }

    /* ---------- CTA Button ---------- */
    .cta-btn {
      background: #f31559;
      color: white;
      border: none;
      border-radius: 30px;
      padding: 10px 20px;
      font-size: 13px;
      cursor: pointer;
      transition: 0.3s;
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
      background: linear-gradient(180deg, #f84c78 0%, #f31559 100%);
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 25px;
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
      position: absolute;
      top: 20px;
      right: 20px;
      background: white;
      color: #f31559;
      border: none;
      border-radius: 50%;
      width: 35px;
      height: 35px;
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
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo">
      <img src="https://upload.wikimedia.org/wikipedia/commons/0/09/Star_icon-72a7cf.svg" alt="logo" />
      <span>glow</span>
    </div>

    <div class="menu">
      <a href="#">Home</a>
      <span class="plus">+</span>
      <a href="#">About Us</a>
      <span class="plus">+</span>
      <a href="#">Services</a>
      <span class="plus">+</span>
      <a href="#" class="active">Book Appointments</a>
      <span class="plus">+</span>
      <a href="#">Reviews</a>
    </div>

    <button class="cta-btn">BECOME A GLOWER →</button>
    <button class="menu-icon" id="menu-toggle">⠿</button>
  </nav>

  <!-- Sidebar for Mobile -->
  <div class="sidebar" id="sidebar">
    <button class="close-btn" id="close-btn">✕</button>
    <a href="#">Home</a>
    <a href="#">About Us</a>
    <a href="#">Services</a>
    <a href="#">Book Appointments</a>
    <a href="#">Reviews</a>
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
