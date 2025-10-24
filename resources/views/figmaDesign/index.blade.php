
@extends('layouts.main2')
{{-- Title --}}
@section('title', 'home')

{{-- Style Files --}}
@section('styles')
{{-- <link rel="stylesheet" href="{{ asset('css/search.css') }}"> --}}

@endsection

{{-- Content --}}
@section('content')
  <main>
    <!-- Hero Section -->
    <section class="hero-section">
      <div class="hero-bg"></div>
      <div class="hero-content">
        <div class="container">
          <!-- Header -->
          <header class="header">
            <nav class="header-nav">
              <!-- Logo Section -->
              <img src="images/images/WhatsApp_Image_2025-09-16_at_23.28.10_3ad6dde7-removebg-preview 1 (1).png" alt="GoGlow Logo" class="logo">
              
              <!-- Navigation Menu -->
              <div class="nav-menu desktop-only">
                <a href="#" class="nav-link active">Home</a>
                <span class="nav-separator">+</span>
                <a href="#" class="nav-link">About Us</a>
                <span class="nav-separator">+</span>
                <a href="#" class="nav-link">Services</a>
                <span class="nav-separator">+</span>
                <a href="#" class="nav-link">Book Appointments</a>
                <span class="nav-separator">+</span>
                <a href="#" class="nav-link">Reviews</a>
              </div>
              
              <!-- Header Actions -->
              <div class="header-actions">
                <a href="#" class="btn-primary desktop-only">
                  BECOME A GLOWER
                  <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16">
                </a>
                
                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" aria-label="Toggle mobile menu">
                  <span></span>
                  <span></span>
                  <span></span>
                </button>
              </div>
            </nav>
            
            <!-- Mobile Menu -->
            <div class="mobile-menu-overlay"></div>
            <div class="mobile-menu">
              <div class="mobile-menu-content">
                <div class="mobile-menu-nav">
                  <ul>
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Book Appointments</a></li>
                    <li><a href="#">Reviews</a></li>
                  </ul>
                </div>
                <div class="mobile-menu-footer">
                  <a href="#" class="btn-primary mobile-only">
                    BECOME A GLOWER
                    <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16">
                  </a>
                </div>
              </div>
            </div>
          </header>

          <!-- Hero Content -->
          <div class="flex-col" style="align-items: center; text-align: center;">
            <div class="badge">
              <span class="badge-text">Glow Smarter with <span class="badge-highlight">GoGlow</span></span>
              <img src="images/images/mdi_stars.svg" alt="" width="24" height="24">
            </div>
            
            <h1 class="hero-title">Discover. Book. <span class="shine-word">shine</span>.</h1>
            
            <p class="hero-subtitle">from trending beauty content to trusted local pros, your next glow-up is just a scroll away.</p>
          </div>
        </div>

        <!-- Hero Visual Elements -->
        <div style="position: relative; margin-top: 15px;">
          <!-- Left side content -->
          <div style="position: absolute; left: 118px; bottom: 0; width: 308px; z-index: 3;" class="desktop-only">
            <div style="line-height: 1;background: rgba(255, 244, 248, 0.8);border-radius: 0 90px 0 0;padding: 28px 26px;margin-bottom: 419px;">
              <p style="font-size: 21px; font-weight: 700; color: #75213e; text-align: center; margin-top: 196px;">
                More than 450 salons <span style="color: rgba(44, 13, 24, 0.5);">have joined Glow</span> already!!
              </p>
            </div>
            <img src="images/images/47abffa77278693eaa65f93217cd9d6a2ea127b5.png" alt="Beauty glove" style="width: 305px; position: absolute; top: -180px; left: 0;">
          </div>

          <!-- Center phone mockup -->
          <div style="display: flex; justify-content: center; position: relative; z-index: 2;">
            <img src="images/images/img_image.png" alt="GoGlow App Interface" style="width: 100%; max-width: 644px; height: auto;">
          </div>

          <!-- Right side phone -->
          <div style="position: absolute; right: 140px; top: 285px; width: 306px; z-index: 3;" class="desktop-only">
            <div class="hero-phone">
              <div class="phone-bg"></div>
              <div class="phone-image">
                <img src="images/images/img_3a3ade2330872de.png" alt="App Screenshot" style="width: 100%; height: 100%; object-fit: cover;">
              </div>
              <div class="phone-stats">
                <div style="position: relative;right: 5px;display: flex;align-items: center;gap: 10px;">
                  <img src="images/images/img_ellipse_230.png" alt="User" width="56" height="56" style="border-radius: 28px;">
                  <img src="images/images/c2ef25d185909c7d661066c1e158f63eb89ccbb9.jpg" alt="User" width="56" height="56" style="border-radius: 28px; margin-left: -35px;">
                  <div style="background-color: #e50050;border-radius: 28px;padding: 16px;margin-left: -33px;">
                    <img src="images/images/Group 33489.svg" alt="" width="18" height="18">
                  </div>
                </div>
                <p style="right: 10px;position: relative;line-height:1;font-size: 17px;font-weight: 700;color: #2c0d18;">
                  2k+ users book<br>salon via <span style="text-transform: uppercase;">g</span>low
                </p>
              </div>
            </div>
          </div>
        </div>

           <!-- App Store Buttons -->
           <div class="hero-buttons">
             <a href="#" class="app-store-btn">
               <div class="app-store-content">
                 <div class="apple-logo">
                   <img src="images/images/apple.svg" alt="Apple" width="36">
                 </div>
                 <div class="app-store-text">
                   <span class="download-text">Download on the</span>
                   <span class="store-text">App Store</span>
                 </div>
               </div>
             </a>
             <a href="#" class="btn-secondary">
               become a glower
               <img src="images/images/Arrow_Right_white_color.svg" alt="" width="16" height="16">
             </a>
           </div>
          {{-- button design --}}
          <div class="hero-button-design">
            <img src="images/images/Rectangle 34.png" alt="Button Design">
          </div>

      </div>
    </section>

    <!-- Search Section -->
    <section class="section">
      <div class="container">
        <div class="search-section">
          <div class="search-row">
            <div class="search-item">
              <div class="search-icon">
                <img src="images/images/Vector.svg" alt="Search" width="32" height="32">
              </div>
              <div class="search-content">
                <h3 class="search-title">What are you looking for ?</h3>
                <p class="search-placeholder">Search by service or provider name</p>
              </div>
            </div>
            
            <div class="divider"></div>
            
            <div class="search-item">
              <div class="search-icon">
                <img src="images/images/mage_map-marker-fill.svg" alt="Location" width="32" height="32">
              </div>
              <div class="search-content">
                <h3 class="search-title">Add</h3>
                <p class="search-placeholder">Locations required for service search</p>
              </div>
            </div>
            
            <div class="divider"></div>
            
            <a href="#" class="btn-primary" style="margin-left: auto;">
              search
              <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16">
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section">
      <div class="benefits-bg"></div>
      <div class="benefits-content">
        <div class="container">
          <div class="flex-col" style="align-items: flex-start; margin-bottom: 40px;">
            <div class="badge">
              <span class="badge-text">our <span class="badge-highlight">benefits</span></span>
              <img src="images/images/mdi_stars.svg" alt="" width="24" height="24">
            </div>
            
            <h2 class="benefits-title">Why Glowees</h2>
            <h2 class="benefits-title2">Love <span style="font-family: Raflesia; font-weight:500;">Glow App</span></h2>
            
            
            <p class="benefits-subtitle">A revolutionary beauty experience that combines social inspiration smart booking</p>
          </div>
        </div>
        <div class="container-fluid benefits-carousel-container">
            <div class="benefits-carousel">
            <div class="benefits-slider">
              <div class="benefit-card">
                <div class="benefit-icon gradient">
                  <img src="images/images/video_icon.svg" alt="" width="23" height="23">
                </div>
                <h3 class="benefit-title">Scroll looks from real Glowers near you</h3>
                <p class="benefit-description">get inspired by real local beauty content</p>
                <a href="#" class="benefit-link">learn more</a>
              </div>

              <div class="benefit-card">
                <div class="benefit-icon white">
                  <img src="images/images/Vector.svg" alt="" width="32" height="32">
                </div>
                <h3 class="benefit-title">Find Glowers near you</h3>
                <p class="benefit-description">location-based: book beauty that's actually close to you</p>
                <a href="#" class="benefit-link">learn more</a>
              </div>

              <div class="benefit-card">
                <div class="benefit-icon white">
                  <img src="images/images/solar_calendar-date-bold.svg" alt="" width="32" height="32">
                </div>
                <h3 class="benefit-title">Make an appointment in seconds</h3>
                <p class="benefit-description">last-minute appointments — no more DM chaos</p>
                <a href="#" class="benefit-link">learn more</a>
              </div>

              <div class="benefit-card">
                <div class="benefit-icon white">
                  <img src="images/images/hair_dryer.svg" alt="" width="32" height="32">
                </div>
                <h3 class="benefit-title">Custom Smart Engine</h3>
                <p class="benefit-description">tailor-make recommendations based on your tastes and preferences</p>
                <a href="#" class="benefit-link">learn more</a>
              </div>

              <div class="benefit-card">
                <div class="benefit-icon white">
                  <img src="images/images/fluent_payment-16-filled.svg" alt="" width="32" height="32">
                </div>
                <h3 class="benefit-title">integrated secure payment</h3>
                <p class="benefit-description">Pay securely in-app</p>
                <a href="#" class="benefit-link">learn more</a>
              </div>

              <div class="benefit-card">
                <div class="benefit-icon white">
                  <img src="images/images/solar_calendar-date-bold.svg" alt="" width="32" height="32">
                </div>
                <h3 class="benefit-title">Ultra-fast experience</h3>
                <p class="benefit-description">follow your favorite Glowers and get notified when they drop availability</p>
                <a href="#" class="benefit-link">learn more</a>
              </div>
            </div>
          </div>
        </div>
                    <!-- Carousel Navigation -->
            <div class="carousel-navigation">
              <button class="carousel-btn prev-btn" onclick="scrollBenefitsCarousel(-1)">
                <img src="images/images/left_arrow.svg" alt="Previous" width="16" height="16">
              </button>
              <div class="carousel-dots">
                <span class="dot active" onclick="currentBenefitsSlide(1)"></span>
                <span class="dot" onclick="currentBenefitsSlide(2)"></span>
                <span class="dot" onclick="currentBenefitsSlide(3)"></span>
              </div>
              <button class="carousel-btn next-btn" onclick="scrollBenefitsCarousel(1)">
                <img src="images/images/right_arrow.svg" alt="Next" width="16" height="16">
              </button>
            </div>
      </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works">
      <div class="container">
        <div class="flex-col" style="align-items: center; text-align: center; margin-bottom: 48px;">
          <div class="badge" style="background-color: rgba(233, 93, 142, 0.2);">
            <span class="badge-text">How it <span class="badge-highlight">works</span></span>
            <img src="images/images/howitwork_star.svg" alt="" width="24" height="24">
          </div>
          
          <h2 class="section-title how-it-work-heading" style="margin-top: 10px; line-height:75px; background: linear-gradient(93deg, #2c0d18 0%, #e50050 50%, #ff8c00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            Glow Smart<br>Feel <span style="font-family: Raflesia; font-weight: 500;">Beautiful</span>
          </h2>
          
          <p class="section-subtitle how-it-work-subtitle">from finding top-rated salons to booking with ease, our platform helps you glow effortlessly in just 4 simple steps</p>
        </div>

        <div class="steps-container">
          <div class="steps-image">
            <div class="how-it-work-mobile-ss" style="position: relative;">
              <img src="images/images/171a4434f8b64fcfb43abd946bcd7150f7258ca0.png" class="right_image" alt="App Screenshot 1" style="z-index: 2;top: -66px;position: absolute;left: 57px;transform: rotate(350deg);width: 264px;height: 574px;border-radius: 24px;">
              <img src="images/images/e5782f964f7141131e481a9ff680608ff974ae50.jpg" class="left_image" alt="App Screenshot 2" style="border: 3px solid #D5BEC6; transform: rotate(8deg);width: 264px;height: 574px;border-radius: 24px;position: absolute;top: -34px;right: 54px;">
            </div>
          </div>

          <div class="steps-list">
            <div class="step-item">
              <div class="step-number">01</div>
              <div class="step-content">
                <h3>Explore looks and services</h3>
                <p>Explore a variety of trusted salons near you offering hair, nails, skin, and more beauty services.</p>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">02</div>
              <div class="step-content">
                <h3>Choose your service</h3>
                <p>Select your preferred time, service, and salon, then book instantly through our platform.</p>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">03</div>
              <div class="step-content">
                <h3>shine</h3>
                <p>Show up at your appointment, enjoy expert care, and walk out glowing with confidence.</p>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">04</div>
              <div class="step-content">
                <h3>Artificial intelligence</h3>
                <p>Our smart technology recommends the best Glowers based on your preferences.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="how-it-work-buttons" style="display: flex; justify-content: center; gap: 14px; margin-top: 110px; flex-wrap: wrap;">
          <a href="#" class="btn-gradient">
            download the app
            <img src="images/images/downlaod.svg" alt="" width="16" height="16">
          </a>
          <a href="#" class="btn-primary">
            book a service
            <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16">
          </a>
        </div>
      </div>
    </section>

    <!-- Reviews Section -->
    <section class="reviews-section">
      <div class="container">
        <div class="reviews-header">
          <div>
            <div class="badge" style="background-color: rgba(255, 244, 248, 0.9); margin-bottom: 8px;">
              <span class="badge-text">our <span class="badge-highlight">reviews</span></span>
              <img src="images/images/howitwork_star.svg" alt="" width="24" height="24">
            </div>
            <h2 class="reviews-title">What Our<br>Glowees <span style="font-family: Raflesia; font-weight: 500;">Say</span></h2>
          </div>

          <div class="reviews-stats">
            <div class="reviews-avatars">
              <img src="images/images/img_ellipse_230.png" alt="User" class="avatar">
              <img src="images/images/img_ellipse_230.png" alt="User" class="avatar">
              <img src="images/images/img_ellipse_232.png" alt="User" class="avatar">
              <div style="background-color: #fff4f8; border-radius: 28px; padding: 16px; margin-left: -24px;">
                <img src="images/images/Plus.svg" alt="" width="24" height="24">
              </div>
            </div>
            <div class="reviews-rating">
              <div class="stars">
                <img src="images/images/star_review.svg" alt="Star" class="star">
                <img src="images/images/star_review.svg" alt="Star" class="star">
                <img src="images/images/star_review.svg" alt="Star" class="star">
                <img src="images/images/star_review.svg" alt="Star" class="star">
                <img src="images/images/star_review.svg" alt="Star" class="star">
              </div>
              <p class="rating-text">4.9 (29k reviews)</p>
            </div>
          </div>
        </div>

        <div class="reviews-slider">
          <div class="review-card">
            <img src="images/images/coms.svg" alt="Quote" class="review-quote">
            <p class="review-text">
              <em>Booking</em> through this platform was so easy and smooth. I found a great salon near me, picked a convenient time, and was impressed by the professionalism from start to finish. The service was top-notch, and I walked out feeling refreshed and confident.
            </p>
            <div class="review-author">
              <div class="author-info">
                <img src="images/images/img_ellipse_232.png" alt="Emma Loy" class="author-avatar">
                <div class="author-details">
                  <p class="author-name">emma loy</p>
                  <p class="author-title">ceo of silo</p>
                </div>
              </div>
              <div class="review-stars">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
              </div>
            </div>
          </div>

          <div class="review-card">
            <img src="images/images/coms.svg" alt="Quote" class="review-quote">
            <p class="review-text">
              <em>Booking</em> through this platform was so easy and smooth. I found a great salon near me, picked a convenient time, and was impressed by the professionalism from start to finish. The service was top-notch, and I walked out feeling refreshed and confident.
            </p>
            <div class="review-author">
              <div class="author-info">
                <img src="images/images/img_ellipse_232.png" alt="Emma Loy" class="author-avatar">
                <div class="author-details">
                  <p class="author-name">emma loy</p>
                  <p class="author-title">ceo of silo</p>
                </div>
              </div>
              <div class="review-stars">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
              </div>
            </div>
          </div>

          <div class="review-card">
            <img src="images/images/coms.svg" alt="Quote" class="review-quote">
            <p class="review-text">
              <em>Booking</em> through this platform was so easy and smooth. I found a great salon near me, picked a convenient time, and was impressed by the professionalism from start to finish. The service was top-notch, and I walked out feeling refreshed and confident.
            </p>
            <div class="review-author">
              <div class="author-info">
                <img src="images/images/img_ellipse_232.png" alt="Emma Loy" class="author-avatar">
                <div class="author-details">
                  <p class="author-name">emma loy</p>
                  <p class="author-title">ceo of silo</p>
                </div>
              </div>
              <div class="review-stars">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
              </div>
            </div>
          </div>
        </div>

        <div class="pagination">
          <button class="pagination-btn">
            <img src="images/images/left_arrow.svg" alt="Previous" width="16" height="16">
          </button>
          <div class="pagination-dots">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
          </div>
          <button class="pagination-btn">
            <img src="images/images/right_arrow.svg" alt="Next" width="16" height="16">
          </button>
        </div>
      </div>
    </section>

    <!-- Partners Section -->
    <section class="section">
      <div class="container">
        <div class="flex-col" style="align-items: center; text-align: center; margin-bottom: 44px; margin-top: 70px;">
          <div class="badge" style="background-color: rgba(233, 93, 142, 0.2);">
            <span class="badge-text">our <span class="badge-highlight">partners</span></span>
            <img src="images/images/howitwork_star.svg" alt="" width="24" height="24">
          </div>
          
          <h2 class="section-title" style="background: linear-gradient(93deg, #2c0d18 0%, #e50050 50%, #ff8c00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            Trusted salon<br><span style="font-family: Raflesia; font-weight: 400;">partners</span>
          </h2>
          
          <p class="section-subtitle partner-section-subtitle">We collaborate with top-tier salons and beauty experts to ensure you receive quality services, professional care, and consistent results—every time you book.</p>
        </div>


      </div>
              <div class="partners-grid">
          <img src="images/images/img_rectangle_35.png" alt="Partner Logo" class="partner-logo">
          <img src="images/images/img_rectangle_36.png" alt="Partner Logo" class="partner-logo">
          <img src="images/images/img_rectangle_39.png" alt="Partner Logo" class="partner-logo">
          <img src="images/images/img_rectangle_41.png" alt="Partner Logo" class="partner-logo">
          <img src="images/images/img_rectangle_42.png" alt="Partner Logo" class="partner-logo">
          <img src="images/images/img_rectangle_43.png" alt="Partner Logo" class="partner-logo">
          <img src="images/images/img_rectangle_44.png" alt="Partner Logo" class="partner-logo">
          <img src="images/images/img_rectangle_38.png" alt="Partner Logo" class="partner-logo">
          <img src="images/images/img_rectangle_45.png" alt="Partner Logo" class="partner-logo">
          <img src="images/images/img_rectangle_40.png" alt="Partner Logo" class="partner-logo">
        </div>

        <div style="text-align: center; margin-top: 52px; margin-bottom: 60px;">
          <a href="#" class="btn-gradient">
            Become a glower
            <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16">
          </a>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section">
      <div style="background-image: url('images/images/img_group_33524.png'); background-size: cover; background-position: center; position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
      <div class="container" style="position: relative; z-index: 2;">
        <div class="flex-col" style="align-items: flex-start; margin-bottom: 40px;">
          <div class="badge">
            <span class="badge-text" style="color: #e50050;">pricing</span>
            <img src="images/images/howitwork_star.svg" alt="" width="24" height="24">
          </div>
          
          <h2 class="section-title" style="color: #fff4f8; text-align: left;">
            want to shine<br>near <span style="font-family: Raflesia;">you?</span>
          </h2>
          
          <p style="font-size: 22px; font-weight: 500; color: #fff4f8; margin-bottom: 40px;">Discover the trends around you</p>
        </div>

        <div class="pricing-cards">
          <div class="pricing-card">
            <div class="pricing-badge">212 reviews : 4.4 starts</div>
            <div class="pricing-header">
              <h3 class="pricing-title">Brushing in 10 minutes away from your position</h3>
              <p class="pricing-price">$32</p>
            </div>
            <div class="pricing-features">
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">Full Body Scrub</p>
              </div>
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">Detoxifying Body Wrap</p>
              </div>
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">Hydrating Body Wrap</p>
              </div>
            </div>
            <div class="pricing-cta">
              <a href="#" class="btn-gradient">
                book now
                <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16">
              </a>
            </div>
          </div>

          <div class="pricing-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
              <div class="pricing-badge">212 reviews : 4.4 starts</div>
              <div class="pricing-badge popular">popular 🔥</div>
            </div>
            <div class="pricing-header">
              <h3 class="pricing-title">Brushing in 10 minutes away from your position</h3>
              <p class="pricing-price">$32</p>
            </div>
            <div class="pricing-features">
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">Full Body Scrub</p>
              </div>
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">Detoxifying Body Wrap</p>
              </div>
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">Hydrating Body Wrap</p>
              </div>
            </div>
            <div class="pricing-cta">
              <a href="#" class="btn-primary">
                book now
                <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16">
              </a>
            </div>
          </div>

          <div class="pricing-card">
            <div class="pricing-badge">212 reviews : 4.4 starts</div>
            <div class="pricing-header">
              <h3 class="pricing-title">Brushing in 10 minutes away from your position</h3>
              <p class="pricing-price">$32</p>
            </div>
            <div class="pricing-features">
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">Full Body Scrub</p>
              </div>
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">Detoxifying Body Wrap</p>
              </div>
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">Hydrating Body Wrap</p>
              </div>
            </div>
            <div class="pricing-cta">
              <a href="#" class="btn-gradient">
                book now
                <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16">
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- App Section -->
    <section class="app-section">
      <div class="container">
        <div class="flex-col" style="align-items: center; text-align: center; margin-bottom: 40px;">
          <div class="badge" style="background-color: rgba(233, 93, 142, 0.2);">
            <span class="badge-text">our <span class="badge-highlight">app</span></span>
            <img src="images/images/howitwork_star.svg" alt="" width="24" height="24">
          </div>
          
          <h2 class="section-title" style="background: linear-gradient(90deg, #2c0d18 0%, #e50050 50%, #ff8c00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            get our app<br><span style="font-family: Raflesia;">Glow</span>
          </h2>
          
          <p class="section-subtitle">Book beauty & wellness services with ease. Explore top-rated salons, schedule appointments, and glow on the go — all from your phone</p>
        </div>

        <div class="app-mockup">
          <img src="images/images/Frame 1618873812.png" alt="App Mockup" class="app-mockup-image">
          {{-- <div style="position: relative; background-color: #fff4f8; border-radius: 74px 74px 0 0; padding: 100px 56px; box-shadow: 0px 4px 100px rgba(136, 136, 136, 1);">
            <div style="position: relative; max-width: 716px; margin: 0 auto;">
              <img src="images/images/img_0d51a4231806639_6890ab39dc7b2.png" alt="Phone Mockup Background" style="width: 100%; height: 528px; object-fit: cover;">
              
              <!-- Phone UI Elements -->
              <div style="position: absolute; top: 60px; left: 50%; transform: translateX(-50%); width: 80%;">
                <!-- Status Bar -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 62px;">
                  <img src="images/images/img_vector_gray_50.svg" alt="Signal" width="50" height="18">
                  <img src="images/images/img_clip_path_group.svg" alt="Battery" width="116" height="22">
                </div>
                
                <!-- App Icons -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                  <div style="background: linear-gradient(180deg, #fff4f8 0%, #e50050 100%); border-radius: 22px; width: 106px; height: 106px; position: relative;">
                    <img src="images/images/img_screenshot_2025_10_15.png" alt="GoGlow App" style="width: 100%; height: 100%; border-radius: 22px; object-fit: cover;">
                    <img src="images/images/img_star_3.svg" alt="Star" width="48" height="48" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                  </div>
                  <div style="background-color: #d5bec6; border-radius: 22px; padding: 22px;">
                    <img src="images/images/img_group.png" alt="App Icon" width="60" height="60">
                  </div>
                  <div style="background-color: #2c0d18; border-radius: 22px; padding: 22px;">
                    <img src="images/images/img_logos_tiktok_icon.svg" alt="TikTok" width="52" height="60">
                  </div>
                  <div style="background-color: #60d669; border-radius: 22px; padding: 22px;">
                    <img src="images/images/img_logos_whatsapp_icon.png" alt="WhatsApp" width="62" height="62">
                  </div>
                </div>
                
                <!-- App Names -->
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 0 30px;">
                  <p style="font-size: 20px; font-weight: 500; color: #ffffff;">glow</p>
                  <p style="font-size: 20px; font-weight: 500; color: #ffffff;">--</p>
                  <p style="font-size: 20px; font-weight: 500; color: #ffffff;">--</p>
                  <p style="font-size: 20px; font-weight: 500; color: #ffffff;">--</p>
                </div>
              </div>
            </div>
          </div> --}}

          {{-- <div class="app-icons">
            <img src="images/images/img_app_button_68x252.png" alt="Download on App Store" class="app-store-btn">
            <img src="images/images/img_app_button_68x252.png" alt="Get it on Google Play" class="google-play-btn">
          </div> --}}
        </div>
      </div>
    </section>


  </main>
@endsection

<script>
let currentBenefitsSlideIndex = 0;
const benefitsSlider = document.querySelector('.benefits-slider');
const benefitCards = document.querySelectorAll('.benefit-card');
const dots = document.querySelectorAll('.carousel-dots .dot');

function scrollBenefitsCarousel(direction) {
  const cardWidth = benefitCards[0].offsetWidth + 30; // card width + gap
  const maxScroll = benefitsSlider.scrollWidth - benefitsSlider.clientWidth;
  
  if (direction === 1) {
    currentBenefitsSlideIndex = Math.min(currentBenefitsSlideIndex + 1, Math.floor(maxScroll / cardWidth));
  } else {
    currentBenefitsSlideIndex = Math.max(currentBenefitsSlideIndex - 1, 0);
  }
  
  benefitsSlider.scrollTo({
    left: currentBenefitsSlideIndex * cardWidth,
    behavior: 'smooth'
  });
  
  updateDots();
}

function currentBenefitsSlide(slideIndex) {
  currentBenefitsSlideIndex = slideIndex - 1;
  const cardWidth = benefitCards[0].offsetWidth + 30;
  
  benefitsSlider.scrollTo({
    left: currentBenefitsSlideIndex * cardWidth,
    behavior: 'smooth'
  });
  
  updateDots();
}

function updateDots() {
  dots.forEach((dot, index) => {
    dot.classList.toggle('active', index === currentBenefitsSlideIndex);
  });
}

// Auto-scroll functionality (optional)
setInterval(() => {
  const maxSlides = Math.floor((benefitsSlider.scrollWidth - benefitsSlider.clientWidth) / (benefitCards[0].offsetWidth + 30));
  if (currentBenefitsSlideIndex >= maxSlides) {
    currentBenefitsSlideIndex = 0;
  } else {
    currentBenefitsSlideIndex++;
  }
  scrollBenefitsCarousel(1);
}, 5000); // Auto-scroll every 5 seconds
</script>


