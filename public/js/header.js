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
