
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
          @include('figmaDesign.header')

          <!-- Hero Content -->
          <div class="flex-col hero-content-top" style="align-items: center; text-align: center;">
            <div class="badge">
              <span class="badge-text">{{ __('app.home.go_smart') }}<span class="badge-highlight">{{ __('app.home.go_glow') }}</span></span>
              <img src="images/images/mdi_stars.svg" alt="" width="24" height="24">
            </div>
            
            <h1 class="hero-title">{{ __('app.home.figma_design_hero_heading') }}<span class="shine-word">{{ __('app.home.figma_design_hero_shine') }}</span>.</h1>
            
            <p class="hero-subtitle">{{ __('app.home.hero_section_trending_paragraph') }}</p>
          </div>
        </div>

        <!-- Hero Visual Elements -->
        <div class="hero-visual-wrapper">
          <!-- Left side content -->
          <div class="hero-left-card desktop-only">
            <div class="hero-left-card-inner">
              <p class="hero-left-card-text">
                {{ __('app.home.figma_design_hero_450_salons') }}<br><span>{{ __('app.home.have joined Glow') }}<br></span>{{ __('app.home.figma_design_already') }}
              </p>
            </div>
            <img src="images/images/47abffa77278693eaa65f93217cd9d6a2ea127b5.png" alt="Beauty glove" class="hero-left-card-image">
          </div>

          <!-- Center phone mockup -->
          <div class="hero-center-mockup">
            <img src="images/images/img_image.png" alt="GoGlow App Interface" class="hero-center-image">
          </div>

          <!-- Right side phone -->
          <div class="hero-right-card desktop-only">
            <div class="hero-phone">
              <div class="phone-bg"></div>
              <div class="phone-image">
                <img src="images/images/img_3a3ade2330872de.png" alt="App Screenshot" style="width: 100%; height: 100%; object-fit: cover;">
              </div>
              <div class="phone-stats">
                <div style="display: flex;align-items: center;gap: 10px;">
                  <img src="images/images/img_ellipse_230.png" alt="User" width="56" height="56" style="border-radius: 28px;">
                  <img src="images/images/c2ef25d185909c7d661066c1e158f63eb89ccbb9.jpg" alt="User" width="56" height="56" style="border-radius: 28px; margin-left: -35px;">
                  <div class="phone-states-plus-icon">
                    <img src="images/images/Group 33489.svg" alt="" width="18" height="18">
                  </div>
                  <p style="line-height:1;font-size: 17px;font-weight: 700;color: #2c0d18;">
                    {{ __('app.home.figma_design_2k') }}<br>{{ __('app.home.figma_design_salon_via') }}<span style="text-transform: uppercase;">{{ __('app.home.figma_design_g') }}</span>{{ __('app.home.figma_design_laura') }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

           <!-- App Store Buttons -->
           <div class="hero-buttons">
             <a href="https://apps.apple.com/us/app/glaura-beauty-booking/id6743101981" class="app-store-btn">
               <div class="app-store-content">
                 <div class="apple-logo">
                   <img src="images/images/apple.svg" alt="Apple" width="36">
                 </div>
                 <div class="app-store-text">
                   <span class="download-text">{{ __('app.home.figma_design_Download') }}</span>
                   <span class="store-text">App Store</span>
                 </div>
               </div>
             </a>
             <a href="{{ url('/contact-us') }}" class="btn-secondary-hero-section">
               {{ __('app.home.become_a_glowee_button') }}
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
        {{-- <div class="search-section">
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
        </div> --}}
        <div class="search-section">
              <form action="{{ route('search') }}" method="GET">
                  <div class="search-row">
                      <div class="search-item">
                          <div class="search-icon">
                              <img src="images/images/Vector.svg" alt="Search" width="24" height="24" aria-hidden="true">
                          </div>
                          <div class="search-content">
                              <h3 class="search-title">{{ __('app.home.search_input_text') }}</h3>
                              <div class="search-suggestions-container">
                                  <input type="search" class="searchInput" id="searchInput" name="search" placeholder="{{ __('app.home.search_service_placeholder') }}" required>
                                  <div class="search-suggestions-dropdown" id="searchSuggestionsDropdown"></div>
                              </div>
                          </div>
                      </div>

                      <div class="divider"></div>

                      <div class="search-item">
                          <div class="search-icon">
                              <img src="images/images/mage_map-marker-fill.svg" alt="Location" width="32" height="32" aria-hidden="true">
                          </div>
                          <div class="search-content">
                              <h3 class="search-title">{{ __('app.home.search_or_text') ?? 'Location' }}</h3>
                              <input type="text" class="searchInput" id="locationInput" name="location" placeholder="{{ __('app.home.search_location_placeholder') }}">
                          </div>
                      </div>

                      <div class="divider"></div>

                      <button type="submit" class="btn-primary" style="margin-left: auto;">
                          {{ __('app.home.search_button') }}
                          <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16">
                      </button>
                  </div>
              </form>
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
              <span class="badge-text">{{ __('app.home.benefits_badge_our') }} <span class="badge-highlight">{{ __('app.home.benefits_badge_benefits') }}</span></span>
              <img src="images/images/mdi_stars.svg" alt="" width="24" height="24">
            </div>
            
            <h2 class="benefits-title">{{ __('app.home.benefits_title_goglow') }}</h2>
            <h2 class="benefits-title2">{{ __('app.home.benefits_title_love') }} <span style="font-family: Raflesia; font-weight:500;">{{ __('app.home.benefits_title_glowApp') }} </span></h2>
            
            
            <p class="benefits-subtitle">{{ __('app.home.benefits_subtitle_text') }} </p>
          </div>
        </div>
        <div class="container-fluid benefits-carousel-container">
            <div class="benefits-carousel">
            <div class="benefits-slider">
              <div class="benefit-card">
                <div class="benefit-icon gradient">
                  <img src="images/images/video_icon.svg" alt="" width="23" height="23">
                </div>
                <h3 class="benefit-title">{{ __('app.home.benefit_1_title') }}</h3>
                <p class="benefit-description">{{ __('app.home.benefit_1_desc') }}</p>
                {{-- <a href="#" class="benefit-link">{{ __('app.home.benefit_learn_more') }}</a> --}}
              </div>

              <div class="benefit-card">
                <div class="benefit-icon white">
                  <img src="images/images/Vector.svg" alt="" width="32" height="32">
                </div>
                <h3 class="benefit-title">{{ __('app.home.benefit_2_title') }}</h3>
                <p class="benefit-description">{{ __('app.home.benefit_2_desc') }}</p>
                {{-- <a href="#" class="benefit-link">{{ __('app.home.benefit_learn_more') }}</a> --}}
              </div>

              <div class="benefit-card">
                <div class="benefit-icon white">
                  <img src="images/images/solar_calendar-date-bold.svg" alt="" width="32" height="32">
                </div>
                <h3 class="benefit-title">{{ __('app.home.benefit_3_title') }}</h3>
                <p class="benefit-description">{{ __('app.home.benefit_3_desc') }}</p>
                {{-- <a href="#" class="benefit-link">{{ __('app.home.benefit_learn_more') }}</a> --}}
              </div>

              <div class="benefit-card">
                <div class="benefit-icon white">
                  <img src="images/images/hair_dryer.svg" alt="" width="32" height="32">
                </div>
                <h3 class="benefit-title">{{ __('app.home.benefit_4_title') }}</h3>
                <p class="benefit-description">{{ __('app.home.benefit_4_desc') }}</p>
                {{-- <a href="#" class="benefit-link">{{ __('app.home.benefit_learn_more') }}</a> --}}
              </div>

              <div class="benefit-card">
                <div class="benefit-icon white">
                  <img src="images/images/fluent_payment-16-filled.svg" alt="" width="32" height="32">
                </div>
                <h3 class="benefit-title">{{ __('app.home.benefit_5_title') }}</h3>
                <p class="benefit-description">{{ __('app.home.benefit_5_desc') }}</p>
                {{-- <a href="#" class="benefit-link">{{ __('app.home.benefit_learn_more') }}</a> --}}
              </div>

              <div class="benefit-card">
                <div class="benefit-icon white">
                  <img src="images/images/solar_calendar-date-bold.svg" alt="" width="32" height="32">
                </div>
                <h3 class="benefit-title">{{ __('app.home.benefit_6_title') }}</h3>
                <p class="benefit-description">{{ __('app.home.benefit_6_desc') }}</p>
                {{-- <a href="#" class="benefit-link">{{ __('app.home.benefit_learn_more') }}</a> --}}
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
            <span class="badge-text">{{ __('app.home.hiw_badge_first') }} <span class="badge-highlight">{{ __('app.home.hiw_badge_second') }}</span></span>
            {{-- <img src="images/images/howitwork_star.svg" alt="" width="24" height="24"> --}}
          </div>
          
          <h2 class="section-title how-it-work-heading" style="margin-top: 10px; line-height:75px; background: linear-gradient(93deg, #2c0d18 0%, #e50050 50%, #ff8c00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            {{ __('app.home.hiw_heading_first') }}<br>{{ __('app.home.hiw_heading_second') }} <span style="font-family: Raflesia; font-weight: 500;">{{ __('app.home.hiw_heading_third') }}</span>
          </h2>
          
          <p class="section-subtitle how-it-work-subtitle">{{ __('app.home.hiw_paragraph') }}</p>
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
                <h3>{{ __('app.home.hiw_step1_title') }}</h3>
                <p>{{ __('app.home.hiw_step1_desc') }}</p>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">02</div>
              <div class="step-content">
                <h3>{{ __('app.home.hiw_step2_title') }}</h3>
                <p>{{ __('app.home.hiw_step2_desc') }}</p>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">03</div>
              <div class="step-content">
                <h3>{{ __('app.home.hiw_step3_title') }}</h3>
                <p>{{ __('app.home.hiw_step3_desc') }}</p>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">04</div>
              <div class="step-content">
                <h3>{{ __('app.home.hiw_step4_title') }}</h3>
                <p>{{ __('app.home.hiw_step4_desc') }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="how-it-work-buttons" style="display: flex; justify-content: center; gap: 14px; margin-top: 110px; flex-wrap: wrap;">
            <a href="https://apps.apple.com/us/app/glaura-beauty-booking/id6743101981" class="app-store-btn">
               <div class="app-store-content">
                 <div class="apple-logo">
                   <img src="images/images/apple.svg" alt="Apple" width="36">
                 </div>
                 <div class="app-store-text">
                   <span class="download-text">{{ __('app.home.figma_design_Download') }}</span>
                   <span class="store-text">App Store</span>
                 </div>
               </div>
            </a>
          <a href="{{ url('/search') }}" class="btn-primary">
            {{ __('app.home.hiw_book_a_service') }}
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
              <span class="badge-text">{{ __('app.home.rs_badge_our') }} <span class="badge-highlight">{{ __('app.home.rs_badge_reviews') }}</span></span>
              <img src="images/images/howitwork_star.svg" alt="" width="24" height="24">
            </div>
            <h2 class="reviews-title">{{ __('app.home.rs_title_first') }}<br>{{ __('app.home.rs_title_second') }} <span style="font-family: Raflesia; font-weight: 500;">{{ __('app.home.rs_title_third') }}</span></h2>
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
              <p class="rating-text">4.9 (29k {{ __('app.home.rs_reviews') }})</p>
            </div>
          </div>
        </div>
      </div>
      @include('figmaDesign.slider')
        {{-- <div class="reviews-slider">
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
        </div> --}}

    </section>

    <!-- Partners Section -->
    <section class="section">
      <div class="container">
        <div class="flex-col partner-section-header" style="align-items: center; text-align: center; margin-top: 70px;">
          <div class="badge" style="background-color: rgba(233, 93, 142, 0.2);">
            <span class="badge-text">{{ __('app.home.partners_badge_our') }} <span class="badge-highlight">{{ __('app.home.partners_badge_partners') }}</span></span>
            <img src="images/images/howitwork_star.svg" alt="" width="24" height="24">
          </div>
          
          <h2 class="section-title partner-section-title" style="line-height: 80px; background: linear-gradient(93deg, #2c0d18 0%, #e50050 50%, #ff8c00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            {{ __('app.home.partners_title_trusted') }}<br><span style="font-family: Raflesia; font-weight: 400;">{{ __('app.home.partners_title_partners') }}</span>
          </h2>
          
          <p class="section-subtitle partner-section-subtitle">{{ __('app.home.partners_subtitle_text') }}</p>
        </div>


      </div>
              <div class="partners-grid">
                <div class="partners-marquee">
                  <img src="images/images/img_rectangle_35.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_36.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_39.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_41.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_42.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_43.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_44.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_38.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_45.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/velvety-paris.jpeg" alt="Partner Logo" class="partner-logo">
                  <!-- Duplicate logos for seamless looping -->
                  <img src="images/images/img_rectangle_35.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_36.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_39.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_41.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_42.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_43.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_44.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_38.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/img_rectangle_45.png" alt="Partner Logo" class="partner-logo">
                  <img src="images/images/velvety-paris.jpeg" alt="Partner Logo" class="partner-logo">
                </div>
              </div>

        <div class="partner-section-button" style="text-align: center; margin-top: 35px; margin-bottom: 60px;">
          <a href="{{ url('/contact-us') }}" class="btn-gradient">
            {{ __('app.home.become_a_glowee_button') }}
            <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16">
          </a>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section">
      <div style="background-image: url('images/images/img_group_33524.png'); background-size: cover; background-position: center; position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
      <div class="container" style="position: relative; z-index: 2;">
        <div class="flex-col" style="align-items: flex-start;">
          <div class="badge">
            <span class="badge-text" style="color: #e50050;">{{ __('app.home.pricing_title') }}</span>
            <img src="images/images/howitwork_star.svg" alt="" width="24" height="24">
          </div>
          
          <h2 class="section-title pricing-section-header" style="color: #fff4f8; text-align: left;">
            {{ __('app.home.want_to_shine_title_first') }}<br>{{ __('app.home.want_to_shine_title_second') }}<span style="font-family: Raflesia; font-weight: 400;">{{ __('app.home.want_to_shine_title_third') }}</span>
          </h2>
          
          <p style="font-size: 22px; font-weight: 500; color: #fff4f8; margin-bottom: 40px;">{{ __('app.home.discover_trends_subtitle') }}</p>
        </div>

        <div class="pricing-cards">
          <div class="pricing-card">
            <div class="pricing-badge">{{ __('app.home.pricing_reviews') }}</div>
            <div class="pricing-header">
              <h3 class="pricing-title">{{ __('app.home.pricing_card_title') }}</h3>
              <p class="pricing-price">€32</p>
            </div>
            <div class="pricing-features">
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">{{ __('app.home.pricing_feature_full_body_scrub') }}</p>
              </div>
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">{{ __('app.home.pricing_feature_detox_body_wrap') }}</p>
              </div>
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">{{ __('app.home.pricing_feature_hydrating_body_wrap') }}</p>
              </div>
            </div>
            <div class="pricing-cta">
              <a href="#" class="btn-gradient">
                {{ __('app.home.pricing_book_now') }}
                <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16">
              </a>
            </div>
          </div>

          <div class="pricing-card2">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <div class="pricing-badge">{{ __('app.home.pricing_reviews') }}</div>
              <div class="pricing-badge popular">popular 🔥</div>
            </div>
            <div class="pricing-header">
              <h3 class="pricing-title">{{ __('app.home.pricing_card_title') }}</h3>
              <p class="pricing-price">€32</p>
            </div>
            <div class="pricing-features">
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">{{ __('app.home.pricing_feature_full_body_scrub') }}</p>
              </div>
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">{{ __('app.home.pricing_feature_detox_body_wrap') }}</p>
              </div>
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">{{ __('app.home.pricing_feature_hydrating_body_wrap') }}</p>
              </div>
            </div>
            <div class="pricing-cta">
              <a href="#" class="btn-primary">
                {{ __('app.home.pricing_book_now') }}
                <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16">
              </a>
            </div>
          </div>

          <div class="pricing-card">
            <div class="pricing-badge">{{ __('app.home.pricing_reviews') }}</div>
            <div class="pricing-header">
              <h3 class="pricing-title">{{ __('app.home.pricing_card_title') }}</h3>
              <p class="pricing-price">€32</p>
            </div>
            <div class="pricing-features">
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">{{ __('app.home.pricing_feature_full_body_scrub') }}</p>
              </div>
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">{{ __('app.home.pricing_feature_detox_body_wrap') }}</p>
              </div>
              <div class="pricing-feature">
                <div class="feature-dot"></div>
                <p class="feature-text">{{ __('app.home.pricing_feature_hydrating_body_wrap') }}</p>
              </div>
            </div>
            <div class="pricing-cta">
              <a href="#" class="btn-gradient">
                {{ __('app.home.pricing_book_now') }}
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
            <span class="badge-text">{{ __('app.home.as_section_our') }} <span class="badge-highlight">{{ __('app.home.as_section_app') }}</span></span>
            <img src="images/images/howitwork_star.svg" alt="" width="24" height="24">
          </div>
          
          <h2 class="section-title app-section-title" style="background: linear-gradient(90deg, #2c0d18 0%, #e50050 50%, #ff8c00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            {{ __('app.home.as_title_first') }}<br><span style="font-family: Raflesia;">{{ __('app.home.as_title_second') }}</span>
          </h2>
          
          <p class="section-subtitle app-section-subtitle">{{ __('app.home.as_section_paragraph') }}</p>
        </div>

        <div class="app-mockup">
          <img src="images/images/Group 36125.png" alt="App Mockup" class="app-mockup-image">
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
        <div class="app-section-background-image">
                      <div class="app-buttons">
             <a href="https://apps.apple.com/us/app/glaura-beauty-booking/id6743101981" class="app-store-btn">
               <div class="app-store-content">
                 <div class="apple-logo">
                   <img src="images/images/apple.svg" alt="Apple" width="36">
                 </div>
                 <div class="app-store-text">
                   <span class="download-text">{{ __('app.home.figma_design_Download') }}</span>
                   <span class="store-text">App Store</span>
                 </div>
               </div>
             </a>
              <a href="#" class="app-store-btn">
               <div class="app-store-content">
                 <div class="apple-logo">
                   <img src="images/images/googleplay.svg" alt="Apple" width="36">
                 </div>
                 <div class="app-store-text">
                   <span class="download-text">{{ __('app.home.figma_design_git_it_on') }}</span>
                   <span class="store-text">Google Play</span>
                 </div>
               </div>
             </a>
           </div>
        </div>
      </div>
    </section>


  </main>
@endsection

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Reviews slider controls (scoped to reviews section only)
    const reviewSlider = document.querySelector('.reviews-slider');
    const reviewNextBtn = document.querySelector('.reviews-section .next-btn');
    const reviewPrevBtn = document.querySelector('.reviews-section .prev-btn');
    if (reviewSlider && reviewNextBtn && reviewPrevBtn) {
      reviewNextBtn.addEventListener('click', function(e) {
        e.preventDefault();
        reviewSlider.scrollBy({ left: 400, behavior: 'smooth' });
      });
      reviewPrevBtn.addEventListener('click', function(e) {
        e.preventDefault();
        reviewSlider.scrollBy({ left: -400, behavior: 'smooth' });
      });
    }
let currentBenefitsSlideIndex = 0;
const benefitsSlider = document.querySelector('.benefits-slider');
const benefitCards = document.querySelectorAll('.benefit-card');
const dots = document.querySelectorAll('.carousel-dots .dot');
const benefitsNextBtn = document.querySelector('.benefits-section .next-btn');
const benefitsPrevBtn = document.querySelector('.benefits-section .prev-btn');
if (benefitsNextBtn && benefitsPrevBtn) {
  benefitsNextBtn.addEventListener('click', function(e) {
    e.preventDefault();
    scrollBenefitsCarousel(1);
  });
  benefitsPrevBtn.addEventListener('click', function(e) {
    e.preventDefault();
    scrollBenefitsCarousel(-1);
  });
}

function scrollBenefitsCarousel(direction) {
  if (!benefitsSlider || benefitCards.length === 0) return;
  const computed = window.getComputedStyle(benefitsSlider);
  const gapPx = parseInt(computed.gap || computed.columnGap || '0', 10) || 0;
  const step = benefitCards[0].getBoundingClientRect().width + gapPx;
  const maxLeft = benefitsSlider.scrollWidth - benefitsSlider.clientWidth;
  const targetLeft = Math.max(0, Math.min(maxLeft, benefitsSlider.scrollLeft + (direction * step)));
  benefitsSlider.scrollTo({ left: targetLeft, behavior: 'smooth' });
  currentBenefitsSlideIndex = Math.round(targetLeft / step);
  updateDots();
}

function currentBenefitsSlide(slideIndex) {
  if (!benefitsSlider || benefitCards.length === 0) return;
  currentBenefitsSlideIndex = slideIndex - 1;
  const computed = window.getComputedStyle(benefitsSlider);
  const gapPx = parseInt(computed.gap || computed.columnGap || '0', 10) || 0;
  const step = benefitCards[0].getBoundingClientRect().width + gapPx;
  const maxLeft = benefitsSlider.scrollWidth - benefitsSlider.clientWidth;
  const targetLeft = Math.max(0, Math.min(maxLeft, currentBenefitsSlideIndex * step));
  benefitsSlider.scrollTo({ left: targetLeft, behavior: 'smooth' });
  updateDots();
}

function updateDots() {
  if (dots.length === 0) return;
  dots.forEach((dot, index) => {
    dot.classList.toggle('active', index === currentBenefitsSlideIndex);
  });
}

// Auto-scroll functionality (optional)
// setInterval(() => {
//   if (!benefitsSlider || benefitCards.length === 0) return;
//   const computed = window.getComputedStyle(benefitsSlider);
//   const gapPx = parseInt(computed.gap || computed.columnGap || '0', 10) || 0;
//   const singleWidth = benefitCards[0].getBoundingClientRect().width + gapPx;
//   const maxSlides = Math.floor((benefitsSlider.scrollWidth - benefitsSlider.clientWidth) / singleWidth);
//   if (currentBenefitsSlideIndex >= maxSlides) {
//     currentBenefitsSlideIndex = 0;
//   } else {
//     currentBenefitsSlideIndex++;
//   }
//   scrollBenefitsCarousel(1);
// }, 5000); // Auto-scroll every 5 seconds

    // Search autocomplete functionality
    const searchInput = document.getElementById('searchInput');
    const suggestionsDropdown = document.getElementById('searchSuggestionsDropdown');
    let debounceTimer = null;
    let currentSuggestions = [];

    if (searchInput && suggestionsDropdown) {
      // Debounce function to limit API calls
      function debounce(func, wait) {
        return function(...args) {
          clearTimeout(debounceTimer);
          debounceTimer = setTimeout(() => func.apply(this, args), wait);
        };
      }

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
            // Extract providers array from the response
            const providers = data.providers || [];
            if (Array.isArray(providers) && providers.length > 0) {
              displaySuggestions(providers);
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

      // Display suggestions in dropdown
      function displaySuggestions(suggestions) {
        currentSuggestions = suggestions;
        suggestionsDropdown.innerHTML = '';
        
        suggestions.forEach((suggestion) => {
          const item = document.createElement('div');
          item.className = 'search-suggestion-item';
          item.textContent = suggestion.name;
          item.addEventListener('click', () => {
            searchInput.value = suggestion.name;
            hideSuggestions();
            searchInput.focus();
          });
          suggestionsDropdown.appendChild(item);
        });

        suggestionsDropdown.classList.add('show');
      }

      // Hide suggestions dropdown
      function hideSuggestions() {
        suggestionsDropdown.classList.remove('show');
        suggestionsDropdown.innerHTML = '';
        currentSuggestions = [];
      }

      // Debounced search function
      const debouncedSearch = debounce((query) => {
        fetchSuggestions(query);
      }, 300);

      // Listen for input events
      searchInput.addEventListener('input', (e) => {
        const query = e.target.value.trim();
        debouncedSearch(query);
      });

      // Hide suggestions when input loses focus (with small delay to allow click on suggestion)
      searchInput.addEventListener('blur', () => {
        setTimeout(() => {
          hideSuggestions();
        }, 200);
      });

      // Show suggestions when input gains focus (if there's a value)
      searchInput.addEventListener('focus', () => {
        if (searchInput.value.trim().length > 0 && currentSuggestions.length > 0) {
          displaySuggestions(currentSuggestions);
        }
      });

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
</script>


