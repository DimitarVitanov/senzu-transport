<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuoteRequestController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\QuoteRequestController as AdminQuoteRequestController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;

// Public routes — single-page site
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/quote', [QuoteRequestController::class, 'store'])->name('quote.store');

// Legacy multi-page URLs now 301-redirect to the single page (kept for old links/SEO)
Route::permanentRedirect('/services', '/');
Route::permanentRedirect('/about', '/');
Route::permanentRedirect('/gallery', '/');
Route::permanentRedirect('/contact', '/');

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

    Route::get('/features', [FeatureController::class, 'index'])->name('features');
    Route::post('/features', [FeatureController::class, 'store'])->name('features.store');
    Route::put('/features/{feature}', [FeatureController::class, 'update'])->name('features.update');
    Route::delete('/features/{feature}', [FeatureController::class, 'destroy'])->name('features.destroy');

    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials');
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
    Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    Route::get('/quotes', [AdminQuoteRequestController::class, 'index'])->name('quotes');
    Route::put('/quotes/{quoteRequest}', [AdminQuoteRequestController::class, 'update'])->name('quotes.update');
    Route::delete('/quotes/{quoteRequest}', [AdminQuoteRequestController::class, 'destroy'])->name('quotes.destroy');

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::put('/gallery/{galleryImage}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{galleryImage}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('/password', [PasswordController::class, 'edit'])->name('password');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});
