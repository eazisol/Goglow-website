<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// figma
Route::get('/coming-soon', function () {return view('comingSoon.index');})->name('coming-soon');
Route::get('/', function () {return view('figmaDesign.index');});
Route::get('/header', function () {return view('figmaDesign.header');});
Route::get('/slider', function () {return view('figmaDesign.slider');});
Route::get('/pro', function () {return view('figmaDesign.becomeAglower');});
Route::get('/ui-testing', function () {return view('figmaDesign.uiTesting');});

Route::get('/testing', function () {return view('figmaDesign.testing');});

// home
Route::get('/testing', function () {return view('home.indexImage');});

// Search routes
Route::get('/recherche', [\App\Http\Controllers\SearchController::class, 'search'])->name('search');
// Route::get('/sp', [\App\Http\Controllers\RedirectController::class, 'handleRedirection'])->name('sp.redirect');
Route::get('/recherche/videos', [\App\Http\Controllers\SearchController::class, 'searchVideos'])->name('search.videos');
Route::get('/recherche/videos/provider', [\App\Http\Controllers\SearchController::class, 'providerVideos'])->name('search.videos.provider');
Route::get('/recherche/provider-fallback', [\App\Http\Controllers\SearchController::class, 'providerFallback'])->name('search.provider.fallback');

// Blog routes
Route::get('/blogs', function () {return view('blog.index');});
Route::get('/blogs/{id}', function ($id) {return view('blog.show', ['id' => $id]);});

// 404
Route::get('/404', function () {return view('errors.404');});

// book appointment
Route::get('/book-appointment', [\App\Http\Controllers\BookAppointmentController::class, 'show'])->middleware('firebase.auth.modal')->name('book-appointment');

// Payment routes
Route::post('/create-checkout-session', [\App\Http\Controllers\PaymentController::class, 'createCheckoutSession'])->name('checkout.session');
Route::get('/payment-success', [\App\Http\Controllers\PaymentController::class, 'handlePaymentSuccess'])->name('payment.success');
Route::get('/api/stripe-config', [\App\Http\Controllers\PaymentController::class, 'getStripeConfig'])->name('api.stripe.config');

// i am a beauty professional
// Route::get('/beauty-professional', function () {return view('iamProfessional.index');});
Route::get('/contact-us', function () {return view('iamProfessional.index');});

// term & conditions
Route::get('/terms_condition', function () {return view('termsConditions.index');})->name('terms_condition');

// privacy policy
Route::get('/privacy_policy', function () {return view('privacyPolicy.index');})->name('privacy_policy');

// auth - signup
Route::get('/signup', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('signup');
Route::post('/signup', [\App\Http\Controllers\AuthController::class, 'register'])->name('signup.store');

// auth - login/logout
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// My Bookings
Route::get('/my-bookings', [\App\Http\Controllers\BookingsController::class, 'index'])
    ->middleware('firebase.auth.modal')
    ->name('my-bookings');

// AJAX auth routes
Route::post('/ajax/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('ajax.login');
Route::post('/ajax/signup', [\App\Http\Controllers\AuthController::class, 'register'])->name('ajax.signup');
Route::post('/ajax/oauth-login', [\App\Http\Controllers\AuthController::class, 'oauthLogin'])->name('ajax.oauth.login');

// Language switching routes
Route::get('/language/{locale}', [\App\Http\Controllers\LanguageController::class, 'switchLanguage'])->name('language.switch');
Route::get('/api/locale', [\App\Http\Controllers\LanguageController::class, 'getCurrentLocale'])->name('api.locale');

// Test language page
Route::get('/test-language', function () {return view('test.language');});

// Android App Links - Digital Asset Links for deep linking
Route::get('/.well-known/assetlinks.json', function () {
    return response()->json([
        [
            'relation' => [
                'delegate_permission/common.handle_all_urls',
                'delegate_permission/common.get_login_creds'
            ],
            'target' => [
                'namespace' => 'android_app',
                'package_name' => 'com.salif.beautyapp',
                'sha256_cert_fingerprints' => [
                    "1C:06:81:B8:3E:7F:AB:9D:00:09:27:BD:30:F2:D4:AA:CC:7D:88:72:C5:9E:8E:7C:F0:0A:5F:29:02:90:E9:9D",
                    "53:6B:F1:3F:5B:9D:A8:AC:57:26:EA:FC:08:D2:0F:B8:02:D0:C4:E9:53:8C:2F:C0:51:9E:7D:6C:CB:83:77:2D"
                ]
            ]
        ]
    ]);
});

// Apple Universal Links - App Site Association for deep linking
Route::get('/.well-known/apple-app-site-association', function () {
    return response()->json([
        'applinks' => [
            'details' => [
                [
                    'appIDs' => ['53FA863RPS.com.salif.beautyapp'],
                    'components' => [
                        [
                            '/' => '/app/*',
                            'comment' => 'Matches only service provider profile links'
                        ]
                    ]
                ]
            ]
        ]
    ])->header('Content-Type', 'application/json');
});

// Provider by username routes (must be at the end to avoid conflicts with other routes)
// IMPORTANT: Videos route must come BEFORE the slug route to prevent "videos" from being matched as a slug
Route::get('/{companyUserName}/videos', [\App\Http\Controllers\SearchController::class, 'showProviderVideosByUsername'])->name('provider.videos.by.username');
Route::get('/{companyUserName}/{servicesSlug}', [\App\Http\Controllers\BookAppointmentController::class, 'showBySlug'])->middleware('firebase.auth.modal')->name('book-appointment.slug')->where('servicesSlug', '[a-zA-Z0-9\-]+');
Route::get('/{companyUserName}', [\App\Http\Controllers\SearchController::class, 'showProviderByUsername'])->name('provider.by.username');

// Fallback route - catch all unmatched routes and redirect to 404 page
Route::fallback(function () {
    return redirect('/404');
});