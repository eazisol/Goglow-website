@php
    use App\Helpers\LanguageHelper;
    $currentLocale = LanguageHelper::getCurrentLocale();
    $availableLocales = LanguageHelper::getAvailableLocales();
@endphp

<div class="language-switcher lang-switcher">
    <div class="lang-dropdown">
        <button class="language-btn lang-toggle" type="button" aria-haspopup="true" aria-expanded="false">
            <span class="language-flag">{!! LanguageHelper::getLocaleFlag($currentLocale) !!}</span>
            <span class="language-name">{{ LanguageHelper::getLocaleName($currentLocale) }}</span>
            <i class="fas fa-chevron-down" style="color:black;" aria-hidden="true"></i>
        </button>

        <ul class="lang-dropdown-menu" role="menu">
            @foreach($availableLocales as $locale)
                @if($locale !== $currentLocale)
                    <li role="none">
                        <a role="menuitem" href="{{ route('language.switch', $locale) }}" class="lang-dropdown-item">
                            <span class="language-flag">{!! LanguageHelper::getLocaleFlag($locale) !!}</span>
                            <span class="language-name">{{ LanguageHelper::getLocaleName($locale) }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>

<style>
/* Namespaced so it won't clash with Bootstrap */
.switcher-button{
    display:flex;
}
.lang-switcher { position: relative; display: flex ; align-items: center; }
.lang-dropdown { position: relative; }

.language-btn {
    background: none;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px !important;
    color: inherit;
    font-size: 14px;
    border-radius: 4px;
    transition: background-color 0.2s;
}
.language-btn:hover { background-color: rgba(0,0,0,0.05); }

.language-flag { font-size: 16px;}
.language-name { font-weight: 500; color:black;}


.language-btn i { font-size: 12px; transition: transform 0.18s; }

/* menu */
.lang-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: rgba(244, 239, 239, 0.9);
    /* border: 1px solid #e0e0e0; */
    border-radius: 6px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    list-style: none;
    padding: 8px 0;
    margin: 6px 0 0 0;
    min-width: 150px;
    z-index: 1200;
    display: none;
}
.lang-dropdown-menu.show { display: block !important; }

.lang-dropdown-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    color: #333;
    text-decoration: none;
    transition: background-color 0.15s;
}
.lang-dropdown-item:hover { background-color: rgba(255, 255, 255, 0.29); }

/* Dark header support */
.header--transparent .language-btn,
.header--transparent .lang-dropdown-item { color: #fff; }
.header--transparent .language-btn:hover { background-color: rgba(255,255,255,0.06); }
.header--transparent .lang-dropdown-menu {
    background: rgba(0,0,0,0.9);
    border-color: rgba(255,255,255,0.12);
}
.header--transparent .lang-dropdown-item:hover { background-color: rgba(255,255,255,0.06); }
</style>

<style>
/* Mobile: show only the flag (keep chevron) in the mobile header area */
@media (max-width: 991px) {
    /* hide name in the toggle, keep chevron */
    .mobile-actions .lang-switcher .language-btn .language-name { display: none !important; }

    /* tighten spacing for flag + chevron */
    .mobile-actions .lang-switcher .language-btn { padding: 8px; gap: 6px !important; }

    /* make dropdown as narrow as the flag */
    .mobile-actions .lang-switcher .lang-dropdown-menu {
        min-width: 44px; /* match flag width */
        width: auto;
        padding: 6px 6px;
    }

    /* hide names inside dropdown items */
    .mobile-actions .lang-switcher .lang-dropdown-menu .language-name { display: none !important; }
    .mobile-actions .lang-switcher .lang-dropdown-item { justify-content: center; gap: 0; padding: 8px 10px; }
}
</style>

<script>
(function () {
    // delegate once for entire document so both desktop and mobile instances work
    if (window.__langSwitcherDelegated) return;
    window.__langSwitcherDelegated = true;

    function closeAllExcept(exceptMenu) {
        document.querySelectorAll('.lang-dropdown-menu.show').forEach(function (menu) {
            if (menu === exceptMenu) return;
            menu.classList.remove('show');
            const wrapper = menu.closest('.lang-switcher');
            const toggle = wrapper && wrapper.querySelector('.lang-toggle');
            if (toggle) toggle.setAttribute('aria-expanded', 'false');
            const icon = toggle && toggle.querySelector('i');
            if (icon) icon.style.transform = '';
        });
    }

    document.addEventListener('click', function (ev) {
        const toggle = ev.target.closest('.lang-toggle');
        if (toggle) {
            ev.preventDefault();
            ev.stopPropagation();
            const wrapper = toggle.closest('.lang-switcher');
            const menu = wrapper && wrapper.querySelector('.lang-dropdown-menu');
            if (!menu) return;

            const willOpen = !menu.classList.contains('show');
            closeAllExcept(null);
            if (willOpen) {
                menu.classList.add('show');
                toggle.setAttribute('aria-expanded', 'true');
                const icon = toggle.querySelector('i');
                if (icon) icon.style.transform = 'rotate(180deg)';
            } else {
                menu.classList.remove('show');
                toggle.setAttribute('aria-expanded', 'false');
                const icon = toggle.querySelector('i');
                if (icon) icon.style.transform = '';
            }
            return;
        }

        // click inside an open menu item
        const clickedMenuItem = ev.target.closest('.lang-dropdown-item');
        if (clickedMenuItem) {
            const menu = clickedMenuItem.closest('.lang-dropdown-menu');
            const wrapper = menu && menu.closest('.lang-switcher');
            const t = wrapper && wrapper.querySelector('.lang-toggle');
            if (menu) menu.classList.remove('show');
            if (t) t.setAttribute('aria-expanded', 'false');
            const icon = t && t.querySelector('i');
            if (icon) icon.style.transform = '';
            return; // allow navigation
        }

        // outside click closes any open menus
        if (!ev.target.closest('.lang-switcher')) {
            closeAllExcept(null);
        }
    });
})();
</script>
