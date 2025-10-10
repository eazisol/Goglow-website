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

// home
Route::get('/', function () {return view('home.indexImage');});
// Route::get('/home-image', function () {return view('home.indexImage');});
Route::get('/home-video', function () {return view('home.indexVideo');});

// Search routes
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'search'])->name('search');

// about
Route::get('/about', function () {return view('about.index');});

// services
Route::get('/services', function () {return view('services.index');});
Route::get('/service-detail', function () {return view('services.servicedetail');});
Route::get('/service-provider', function () {return view('services.serviceprovider');});

// blog
Route::get('/blogs', function () {return view('blogs.index');});
Route::get('/blog-single', function () {return view('blogs.singleblog');});

// contact us
Route::get('/contact-us', function () {return view('contactUs.index');});

// case study
Route::get('/saloons', function () {return view('caseStudy.index');});
Route::get('/saloons-single', function () {return view('caseStudy.single');});

// team
Route::get('/team', function () {return view('ourTeam.index');});
Route::get('/team-single', function () {return view('ourTeam.single');});

// pricing
Route::get('/pricing', function () {return view('pricingPlan.index');});

// testimonials
Route::get('/testimonials', function () {return view('testimonials.index');});

// gallery
Route::get('/image-gallery', function () {return view('gallery.image');});
Route::get('/video-gallery', function () {return view('gallery.video');});

// faqs
Route::get('/faqs', function () {return view('FAQs.index');});
// 404
Route::get('/404', function () {return view('errors.404');});

// book appointment
Route::get('/book-appointment', [\App\Http\Controllers\BookAppointmentController::class, 'show'])->middleware('firebase.auth.modal')->name('book-appointment');

// Payment routes
Route::post('/create-checkout-session', [\App\Http\Controllers\PaymentController::class, 'createCheckoutSession'])->name('checkout.session');
Route::get('/payment-success', [\App\Http\Controllers\PaymentController::class, 'handlePaymentSuccess'])->name('payment.success');

// i am a beauty professional
Route::get('/beauty-professional', function () {return view('iamProfessional.index');});

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

// Language switching routes
Route::get('/language/{locale}', [\App\Http\Controllers\LanguageController::class, 'switchLanguage'])->name('language.switch');
Route::get('/api/locale', [\App\Http\Controllers\LanguageController::class, 'getCurrentLocale'])->name('api.locale');

// Test language page
Route::get('/test-language', function () {return view('test.language');});