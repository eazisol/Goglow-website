
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
            <div class="badge become-glower-hero-heading">
              <span class="badge-text">{!! __('app.home.bag_hero_badge') !!}</span>
              <img src="images/images/mdi_stars.svg" alt="" width="24" height="24">
            </div>

            <div class='bag-hero-title'>
              <h1>{{ __('app.home.bag_hero_title_first') }}</h1>
              <span class="shine-word">{{ __('app.home.bag_hero_title_second') }}</span>
            </div>
            
            {{-- <h1 class="hero-title">Too Much Talent -Not Enough<span class="shine-word">Appointments ?</span>.</h1> --}}
            
            <p class="hero-subtitle">{{ __('app.home.bag_hero_subtitle') }}</p>
          </div>
        </div>

        {{-- <!-- Hero Visual Elements -->
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
        </div> --}}

        {{-- hero-section-carosal --}}
        <div class='bag-hero-carosal'>
          <img src="images/images/Frame 1618873912 (1).png" class="image-left">
          <img src="images/images/Frame 1618873910.png" class="image-center">
          <img src="images/images/Frame 1618873911 (1).png" class="image-center">
          <img src="images/images/Frame 1618873914.png" class="image-left">
        </div>

           <!-- App Store Buttons -->
           <div class="bag-hero-buttons">
             <a href="https://apps.apple.com/us/app/glaura-beauty-booking/id6743101981" class="app-store-btn">
               <div class="app-store-content">
                 <div class="apple-logo">
                   <img src="images/images/apple.svg" alt="Apple" width="36">
                 </div>
                <div class="app-store-text">
                  <span class="download-text">{{ __('app.home.figma_design_Download') }}</span>
                  <span class="store-text">{{ __('app.home.bag_app_store') }}</span>
                </div>
               </div>
             </a>
             <a href="{{ url('/contact-us') }}" class="btn-secondary">
               {{ __('app.home.become_a_glowee_button') }}
               <img src="images/images/Arrow_Right_white_color.svg" alt="" width="16" height="16">
             </a>
           </div>
      </div>
    </section>

    {{-- Welcome to Future Beauty Booking --}}
        <div class="future-section">
        <div class="future-section__container">
            <!-- Header -->
            <div class="future-section__header">
                <div class="future-section__dark">
                                  <h1>{{ __('app.home.bag_future_welcome') }}</h1>
                <h2 class="future-section-raflesia-text">{{ __('app.home.bag_future_beauty_booking') }}</h2>
                </div>

                <p class="future-section__subtitle">{{ __('app.home.bag_future_subtitle') }}</p>
            </div>

            <!-- Content Sections -->
            <div class="future-section__content">
                <!-- Reality Today -->
                <div class="future-section__section future-section__section--reality">
                    <div class="future-section__section-header">{{ __('app.home.bag_reality_header') }}</div>
                    <div class="future-section__stat-box">
                        <div class="future-section__stat-icon">
                          <img src="images/images/streamline-color_graph-bar-decrease.svg" alt="" width="23" height="23">
                        </div>
                        <span>{{ __('app.home.bag_reality_result') }}</span>
                    </div>

                    <div class="future-section__item">
                        <div class="future-section__item-icon">
                          <img src="images/images/cross.svg" alt="">
                        </div>
                        <div class="future-section__item-content">
                            <h3>{{ __('app.home.bag_reality_item1_title') }}</h3>
                            <p>{{ __('app.home.bag_reality_item1_desc') }}</p>
                        </div>
                    </div>

                    <div class="future-section__item">
                        <div class="future-section__item-icon">
                          <img src="images/images/cross.svg" alt="">
                        </div>
                        <div class="future-section__item-content">
                            <h3>{{ __('app.home.bag_reality_item2_title') }}</h3>
                            <p>{{ __('app.home.bag_reality_item2_desc') }}</p>
                        </div>
                    </div>

                    <div class="future-section__item">
                        <div class="future-section__item-icon">
                          <img src="images/images/cross.svg" alt="">
                        </div>
                        <div class="future-section__item-content">
                            <h3>{{ __('app.home.bag_reality_item3_title') }}</h3>
                            <p>{{ __('app.home.bag_reality_item3_desc') }}</p>
                        </div>
                    </div>

                    <div class="future-section__item">
                        <div class="future-section__item-icon">
                          <img src="images/images/cross.svg" alt="">
                        </div>
                        <div class="future-section__item-content">
                            <h3>{{ __('app.home.bag_reality_item4_title') }}</h3>
                            <p>{{ __('app.home.bag_reality_item4_desc') }}</p>
                        </div>
                    </div>

                    <div class="future-section__item">
                        <div class="future-section__item-icon">
                          <img src="images/images/cross.svg" alt="">
                        </div>
                        <div class="future-section__item-content">
                            <h3>{{ __('app.home.bag_reality_item5_title') }}</h3>
                            <p>{{ __('app.home.bag_reality_item5_desc') }}</p>
                        </div>
                    </div>
                </div>

                <!-- What Could Be -->
                <div class="future-section__section future-section__section--future">
                    <div class="future-section__section-header">{{ __('app.home.bag_future_header') }}</div>
                    <div class="future-section__stat-box">
                        <div class="future-section__stat-icon">
                          <img src="images/images/right-future-svg.svg" alt="" width="23" height="23">
                        </div>
                        <span>{{ __('app.home.bag_future_result') }}</span>
                    </div>

                    <div class="future-section__item">
                        <div class="future-section__item-icon">
                          <img src="images/images/green_tick.svg" alt="">
                        </div>
                        <div class="future-section__item-content">
                            <h3>{{ __('app.home.bag_future_item1_title') }}</h3>
                            <p>{{ __('app.home.bag_future_item1_desc') }}</p>
                        </div>
                    </div>

                    <div class="future-section__item">
                        <div class="future-section__item-icon">
                          <img src="images/images/green_tick.svg" alt="">
                        </div>
                        <div class="future-section__item-content">
                            <h3>{{ __('app.home.bag_future_item2_title') }}</h3>
                            <p>{{ __('app.home.bag_future_item2_desc') }}</p>
                        </div>
                    </div>

                    <div class="future-section__item">
                        <div class="future-section__item-icon">
                          <img src="images/images/green_tick.svg" alt="">
                        </div>
                        <div class="future-section__item-content">
                            <h3>{{ __('app.home.bag_future_item3_title') }}</h3>
                            <p>{{ __('app.home.bag_future_item3_desc') }}</p>
                        </div>
                    </div>

                    <div class="future-section__item">
                        <div class="future-section__item-icon">
                          <img src="images/images/green_tick.svg" alt="">
                        </div>
                        <div class="future-section__item-content">
                            <h3>{{ __('app.home.bag_future_item4_title') }}</h3>
                            <p>{{ __('app.home.bag_future_item4_desc') }}</p>
                        </div>
                    </div>

                    <div class="future-section__item">
                        <div class="future-section__item-icon">
                          <img src="images/images/green_tick.svg" alt="">
                        </div>
                        <div class="future-section__item-content">
                            <h3>{{ __('app.home.bag_future_item5_title') }}</h3>
                            <p>{{ __('app.home.bag_future_item5_desc') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <!-- CTA Buttons -->
            <div class="future-section__cta-section">
                <a href="#" class="future-section__btn future-section__btn--download">
                  {{ __('app.home.hiw_download_app') }}
                  <img src="images/images/downlaod.svg" alt="" width="16" height="16">
                </a>
                <a href="#" class="future-section__btn future-section__btn--glower">
                  {{ __('app.home.hiw_book_a_service') }}
                  <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16">
                </a>
            </div> --}}
                       <!-- App Store Buttons -->
           <div class="future-button-section-app">
             <a href="https://apps.apple.com/us/app/glaura-beauty-booking/id6743101981" class="app-store-btn">
               <div class="app-store-content">
                 <div class="apple-logo">
                   <img src="images/images/apple.svg" alt="Apple" width="36">
                 </div>
                <div class="app-store-text">
                  <span class="download-text">{{ __('app.home.figma_design_Download') }}</span>
                  <span class="store-text">{{ __('app.home.bag_app_store') }}</span>
                </div>
               </div>
             </a>
             <a href="{{ url('/contact-us') }}" class="btn-secondary" style="background-color:white;">
               {{ __('app.home.become_a_glowee_button') }}
               <img src="images/images/Arrow_Right_white_color.svg" alt="" width="16" height="16">
             </a>
           </div>
        </div>
    </div>   
    {{-- Welcome to Future Beauty Booking End --}}


    <!-- Benefits Section -->
    <section class="benefits-section">
      <div class="benefits-bg"></div>
      <div class="benefits-content">
        <div class="container">
          <div class="flex-col" style="align-items: flex-start; margin-bottom: 40px;">
            <div class="badge">
              <span class="badge-text">{!! __('app.home.bag_benefits_badge') !!}</span>
              <img src="images/images/mdi_stars.svg" alt="" width="24" height="24">
            </div>
            
            <h2 class="benefits-title">{{ __('app.home.benefits_title_goglow') }}</h2>
            <h2 class="benefits-title2">{{ __('app.home.benefits_title_love') }} <span style="font-family: Raflesia; font-weight:500;">{{ __('app.home.benefits_title_glowApp') }} </span></h2>
            
            
            <p class="benefits-subtitle">{{ __('app.home.bag_benefits_subtitle') }}</p>
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

        {{-- <div class="how-it-work-buttons" style="display: flex; justify-content: center; gap: 14px; margin-top: 110px; flex-wrap: wrap;">
          <a href="#" class="btn-gradient">
            {{ __('app.home.hiw_download_app') }}
            <img src="images/images/downlaod.svg" alt="" width="16" height="16">
          </a>
          <a href="#" class="btn-primary">
            {{ __('app.home.hiw_book_a_service') }}
            <img src="images/images/Arrow_Right.svg" alt="" width="16" height="16">
          </a>
        </div> --}}
              <div class="how-works-salon-page-button">
                <a href="https://apps.apple.com/us/app/glaura-beauty-booking/id6743101981" class="app-store-btn">
                  <div class="app-store-content">
                    <div class="apple-logo">
                      <img src="images/images/apple.svg" alt="Apple" width="36">
                    </div>
                    <div class="app-store-text">
                      <span class="download-text">{{ __('app.home.figma_design_Download') }}</span>
                      <span class="store-text">{{ __('app.home.bag_app_store') }}</span>
                    </div>
                  </div>
                </a>
                <a href="{{ url('/contact-us') }}" class="btn-secondary" style="background-color:white;">
                  {{ __('app.home.become_a_glowee_button') }}
                  <img src="images/images/Arrow_Right_white_color.svg" alt="" width="16" height="16">
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
            <h2 class="reviews-title">{{ __('app.home.rs_title_first') }}<br>G{{ __('app.home.rs_title_second') }} <span style="font-family: Raflesia; font-weight: 500;">{{ __('app.home.rs_title_third') }}</span></h2>
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
              <p class="rating-text">{{ __('app.home.bag_reviews_rating') }}</p>
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
  });
</script>


