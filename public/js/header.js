// Smart Sticky Header - adds visual feedback when scrolled
(function() {
    const navSection = document.querySelector('.nav-header-section');
    if (!navSection) return;

    const scrollThreshold = 50;
    let isScrolled = false;

    function handleScroll() {
        const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        if (currentScroll > scrollThreshold && !isScrolled) {
            navSection.classList.add('scrolled');
            isScrolled = true;
        } else if (currentScroll <= scrollThreshold && isScrolled) {
            navSection.classList.remove('scrolled');
            isScrolled = false;
        }
    }

    // Throttle scroll event for performance
    let ticking = false;
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                handleScroll();
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });

    // Check initial scroll position
    handleScroll();
})();

// Toggle Sidebar (only in non-white-label mode)
(function() {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const closeBtn = document.getElementById('close-btn');

    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.add('active');
        });
    }

    if (closeBtn && sidebar) {
        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('active');
        });
    }

    // Remove focus highlight from menu links after click
    const menuLinks = document.querySelectorAll('.menu a');
    menuLinks.forEach(function(link) {
        link.addEventListener('mouseup', function() {
            this.blur();
        });
        link.addEventListener('click', function() {
            this.blur();
        });
    });

    // Header Login Button - open modal using Bootstrap
    const headerLoginBtns = document.querySelectorAll('#header-login-btn, #header-login-btn-wl');
    headerLoginBtns.forEach(function(btn) {
        if (btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                // Store current page URL so we can redirect back after login
                localStorage.setItem('login_redirect_url', window.location.href);

                const loginModal = document.getElementById('loginModal');
                if (loginModal) {
                    loginModal.classList.add('show');
                    document.body.classList.add('modal-open');
                }
            });
        }
    });
})();
