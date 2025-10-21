
    // Mobile menu toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
      // Smooth scrolling for anchor links
      const links = document.querySelectorAll('a[href^="#"]');
      links.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute('href'));
          if (target) {
            target.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            });
          }
        });
      });

      // Reviews slider functionality
      const reviewsSlider = document.querySelector('.reviews-slider');
      const prevBtn = document.querySelector('.pagination-btn:first-child');
      const nextBtn = document.querySelector('.pagination-btn:last-child');
      
      if (reviewsSlider && prevBtn && nextBtn) {
        let currentSlide = 0;
        const slides = reviewsSlider.children;
        const totalSlides = slides.length;

        function updateSlider() {
          const slideWidth = slides[0].offsetWidth + 30; // width + gap
          reviewsSlider.scrollTo({
            left: currentSlide * slideWidth,
            behavior: 'smooth'
          });
        }

        prevBtn.addEventListener('click', () => {
          currentSlide = currentSlide > 0 ? currentSlide - 1 : totalSlides - 1;
          updateSlider();
        });

        nextBtn.addEventListener('click', () => {
          currentSlide = currentSlide < totalSlides - 1 ? currentSlide + 1 : 0;
          updateSlider();
        });
      }

      // Button hover effects
      const buttons = document.querySelectorAll('.btn-primary, .btn-secondary, .btn-gradient');
      buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
          this.style.transform = 'translateY(-2px)';
        });
        
        button.addEventListener('mouseleave', function() {
          this.style.transform = 'translateY(0)';
        });
      });

      // Card hover effects
      const cards = document.querySelectorAll('.benefit-card, .review-card, .pricing-card');
      cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
          this.style.transform = 'translateY(-4px)';
        });
        
        card.addEventListener('mouseleave', function() {
          this.style.transform = 'translateY(0)';
        });
      });

      // Partner logo hover effects
      const partnerLogos = document.querySelectorAll('.partner-logo');
      partnerLogos.forEach(logo => {
        logo.addEventListener('mouseenter', function() {
          this.style.transform = 'scale(1.05)';
        });
        
        logo.addEventListener('mouseleave', function() {
          this.style.transform = 'scale(1)';
        });
      });
    });