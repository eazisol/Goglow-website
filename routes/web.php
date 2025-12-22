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
Route::get('/', function () {return view('figmaDesign.index');});
Route::get('/header', function () {return view('figmaDesign.header');});
Route::get('/slider', function () {return view('figmaDesign.slider');});
Route::get('/become-glower', function () {return view('figmaDesign.becomeAglower');});
Route::get('/ui-testing', function () {return view('figmaDesign.uiTesting');});

Route::get('/testing', function () {return view('figmaDesign.testing');});

// home
Route::get('/testing', function () {return view('home.indexImage');});

// Search routes
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'search'])->name('search');
Route::get('/search/videos', [\App\Http\Controllers\SearchController::class, 'searchVideos'])->name('search.videos');
Route::get('/search/videos/provider', [\App\Http\Controllers\SearchController::class, 'providerVideos'])->name('search.videos.provider');
Route::get('/search/provider-fallback', [\App\Http\Controllers\SearchController::class, 'providerFallback'])->name('search.provider.fallback');

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

// AJAX auth routes
Route::post('/ajax/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('ajax.login');
Route::post('/ajax/signup', [\App\Http\Controllers\AuthController::class, 'register'])->name('ajax.signup');
Route::post('/ajax/oauth-login', [\App\Http\Controllers\AuthController::class, 'oauthLogin'])->name('ajax.oauth.login');

// Language switching routes
Route::get('/language/{locale}', [\App\Http\Controllers\LanguageController::class, 'switchLanguage'])->name('language.switch');
Route::get('/api/locale', [\App\Http\Controllers\LanguageController::class, 'getCurrentLocale'])->name('api.locale');

// Test language page
Route::get('/test-language', function () {return view('test.language');});

// Provider by username routes (must be at the end to avoid conflicts with other routes)
// IMPORTANT: Videos route must come BEFORE the slug route to prevent "videos" from being matched as a slug
Route::get('/{companyUserName}/videos', [\App\Http\Controllers\SearchController::class, 'showProviderVideosByUsername'])->name('provider.videos.by.username');
Route::get('/{companyUserName}/{servicesSlug}', [\App\Http\Controllers\BookAppointmentController::class, 'showBySlug'])->middleware('firebase.auth.modal')->name('book-appointment.slug')->where('servicesSlug', '[a-zA-Z0-9\-]+');
Route::get('/{companyUserName}', [\App\Http\Controllers\SearchController::class, 'showProviderByUsername'])->name('provider.by.username');