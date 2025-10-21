
    // Mobile menu toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
      // Mobile menu functionality
      const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
      const mobileMenu = document.querySelector('.mobile-menu');
      const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
      const mobileMenuLinks = document.querySelectorAll('.mobile-menu-nav a');
      
      if (mobileMenuToggle && mobileMenu && mobileMenuOverlay) {
        // Toggle mobile menu
        mobileMenuToggle.addEventListener('click', function() {
          this.classList.toggle('active');
          mobileMenu.classList.toggle('active');
          mobileMenuOverlay.classList.toggle('active');
          document.body.classList.toggle('menu-open');
        });
        
        // Close mobile menu when clicking overlay
        mobileMenuOverlay.addEventListener('click', function() {
          closeMobileMenu();
        });
        
        // Close mobile menu when clicking on links
        mobileMenuLinks.forEach(link => {
          link.addEventListener('click', function() {
            closeMobileMenu();
          });
        });
        
        // Close mobile menu function
        function closeMobileMenu() {
          mobileMenuToggle.classList.remove('active');
          mobileMenu.classList.remove('active');
          mobileMenuOverlay.classList.remove('active');
          document.body.classList.remove('menu-open');
        }
        
        // Close mobile menu on escape key
        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
          }
        });
        
        // Prevent body scroll when menu is open
        const originalStyle = document.body.style.overflow;
        const observer = new MutationObserver(function(mutations) {
          mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
              if (document.body.classList.contains('menu-open')) {
                document.body.style.overflow = 'hidden';
              } else {
                document.body.style.overflow = originalStyle;
              }
            }
          });
        });
        observer.observe(document.body, { attributes: true });
      }

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