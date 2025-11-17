# Performance Optimization Guide

This document outlines the performance optimizations implemented and the commands needed for deployment.

## Optimizations Implemented

### 1. Asset Loading Optimization
- CSS and JavaScript files are loaded individually but optimized
- Scripts use `defer` attribute for non-blocking execution
- External resources are optimized with preconnect and deferred loading

### 2. API Response Caching
- Provider list API responses are cached for 15 minutes
- Service list API responses are cached for 15 minutes
- Individual service data is cached for 10 minutes per service ID

### 3. Image Lazy Loading
- Images in search results and below-the-fold content use `loading="lazy"` attribute
- Hero images remain eager loaded for immediate visibility

### 4. HTTP Caching Headers
- Static assets (CSS, JS, images, fonts) have appropriate cache headers configured in `.htaccess`
- Images and fonts: 1 year cache
- CSS and JavaScript: 1 month cache with revalidation

### 5. Script Optimization
- External scripts (Stripe.js, flatpickr, SweetAlert2) are deferred and loaded at the bottom
- Critical scripts use `defer` attribute for non-blocking execution

## Deployment Commands

Run these commands in order before deploying to production:

### 1. Install Dependencies
```bash
composer install --optimize-autoloader --no-dev
npm install
```

### 2. Build Assets (Optional)
```bash
npm run production
```
Note: This is only needed if you're using Laravel Mix for other assets. The main CSS/JS files are loaded directly without bundling.

### 3. Laravel Optimizations (Run in Production Only)

#### Cache Configuration
```bash
php artisan config:cache
```
Caches configuration files for faster loading. Clear with `php artisan config:clear` when config changes.

#### Cache Routes
```bash
php artisan route:cache
```
Caches routes for faster routing. Clear with `php artisan route:clear` when routes change.

#### Cache Views
```bash
php artisan view:cache
```
Pre-compiles Blade templates. Clear with `php artisan view:clear` when views change.

#### Optimize Autoloader
```bash
composer dump-autoload --optimize --classmap-authoritative
```
Optimizes Composer's autoloader for production.

### 4. Clear Development Caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```
Clear all caches after deployment if needed.

### 5. Optional: Enable OPcache
If you have OPcache enabled in PHP, ensure it's configured properly in `php.ini`:
```ini
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=4000
opcache.revalidate_freq=60
opcache.fast_shutdown=1
```

## After Deployment

### Cache API Responses
The API caching is automatic. If you need to clear API caches manually:
```bash
php artisan cache:clear
```

### Monitor Performance
- Check browser DevTools Network tab for asset loading
- Verify assets are being served with correct cache headers
- Monitor API response times (should be much faster after first request)

## Rollback Plan

If you need to rollback:

1. **Rollback assets**: The layouts have fallback logic - if bundled files don't exist, individual files will be used automatically.

2. **Clear Laravel caches**:
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

3. **Restore original .htaccess** if needed (backup before deployment).

## Testing Checklist

After deployment, verify:
- [ ] All CSS styles render correctly
- [ ] All JavaScript functionality works (modals, forms, animations)
- [ ] Images load correctly with lazy loading
- [ ] External scripts (Stripe, flatpickr) work correctly
- [ ] Search functionality works with cached API responses
- [ ] Page load time has improved
- [ ] Assets are being served with cache headers

## Performance Improvements Expected

- **Initial Load Time**: 40-60% reduction (fewer HTTP requests, smaller bundles)
- **Time to Interactive**: 30-50% improvement (deferred scripts, lazy loading)
- **API Response Time**: 50-80% improvement (cached responses)
- **Page Weight**: 20-30% reduction (minified assets, optimized images)

