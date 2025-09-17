@php
    use App\Helpers\LanguageHelper;
    $currentLocale = LanguageHelper::getCurrentLocale();
    $availableLocales = LanguageHelper::getAvailableLocales();
@endphp

<div class="language-switcher">
    <div class="dropdown">
        <button class="language-btn" type="button" id="languageDropdown" aria-expanded="false">
            <span class="language-flag">{!! LanguageHelper::getLocaleFlag($currentLocale) !!}</span>
            <span class="language-name">{{ LanguageHelper::getLocaleName($currentLocale) }}</span>
            <i class="fas fa-chevron-down"></i>
        </button>
        
        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
            @foreach($availableLocales as $locale)
                @if($locale !== $currentLocale)
                    <li>
                        <a href="{{ route('language.switch', $locale) }}" class="dropdown-item">
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
.language-switcher {
    position: relative;
    display: inline-block;
}

.language-switcher .dropdown {
    position: relative;
}

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

.language-btn:hover {
    background-color: rgba(0, 0, 0, 0.05);
}

.language-flag {
    font-size: 16px;
}

.language-name {
    font-weight: 500;
}

.language-btn i {
    font-size: 12px;
    transition: transform 0.2s;
}

.language-switcher .dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    list-style: none;
    padding: 8px 0;
    margin: 0;
    min-width: 150px;
    z-index: 1000;
    display: none;
}

.language-switcher .dropdown-menu.show {
    display: block !important;
}

.language-switcher .dropdown-item {
    /* display: flex; */
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    color: #333;
    text-decoration: none;
    transition: background-color 0.2s;
}

.language-switcher .dropdown-item:hover {
    background-color: #f5f5f5;
    color: #333;
    text-decoration: none;
}

/* Dark mode support */
.language-btn,
.header--transparent .language-switcher .dropdown-item {
    color: #fff;
}

.header--transparent .language-btn:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.header--transparent .language-switcher .dropdown-menu {
    background: rgba(0, 0, 0, 0.9);
    border-color: rgba(255, 255, 255, 0.2);
}

.header--transparent .language-switcher .dropdown-item {
    color: #fff;
}

.header--transparent .language-switcher .dropdown-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const languageBtn = document.getElementById('languageDropdown');
    const dropdownMenu = document.querySelector('.language-switcher .dropdown-menu');
    
    if (languageBtn && dropdownMenu) {
        // Toggle dropdown
        languageBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const isOpen = dropdownMenu.classList.contains('show');
            
            // Close all other dropdowns
            document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                if (menu !== dropdownMenu) {
                    menu.classList.remove('show');
                }
            });
            
            // Toggle current dropdown
            dropdownMenu.classList.toggle('show', !isOpen);
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!languageBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
        
        // Close dropdown when selecting a language
        dropdownMenu.addEventListener('click', function(e) {
            if (e.target.closest('.dropdown-item')) {
                dropdownMenu.classList.remove('show');
            }
        });
    }
});
</script>
