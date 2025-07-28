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
Route::get('/', function () {return view('home.index');});
Route::get('/home-image', function () {return view('home.indexImage');});
Route::get('/home-video', function () {return view('home.indexVideo');});

// about
Route::get('/about', function () {return view('about.index');});

// services
Route::get('/services', function () {return view('services.index');});
Route::get('/service-detail', function () {return view('services.servicedetail');});

// blog
Route::get('/blogs', function () {return view('blogs.index');});
Route::get('/blog-single', function () {return view('blogs.singleblog');});

// contact us
Route::get('/contact-us', function () {return view('contactUs.index');});

// case study
Route::get('/case-study', function () {return view('caseStudy.index');});
Route::get('/case-study-single', function () {return view('caseStudy.single');});

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
Route::get('/book-appointment', function () {return view('bookAppointment.index');});

// i am a beauty professional
Route::get('/beauty-professional', function () {return view('iamProfessional.index');});