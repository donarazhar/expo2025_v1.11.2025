<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('home');

// Registration
// Registration
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');
Route::get('/register/success/{id_peserta}', [RegistrationController::class, 'success'])->name('register.success');

// Check Email Availability (AJAX)
Route::post('/check-email', [RegistrationController::class, 'checkEmail'])->name('check.email');

// QR Code
Route::get('/qr/download/{id_peserta}', [RegistrationController::class, 'downloadQr'])->name('qr.download');

// Check-in
Route::get('/check-in', [RegistrationController::class, 'checkInForm'])->name('check-in.form');
Route::post('/check-in/verify', [RegistrationController::class, 'verifyId'])->name('check-in.verify');

// Include Admin Routes
require __DIR__.'/admin.php';

// Check-in Routes untuk Pengunjung
// Route::get('/check-in', [RegistrationController::class, 'checkInForm'])->name('check-in.form');
Route::get('/check-in', function () {
    return view('checkin-simple');
})->name('check-in.form');

Route::post('/check-in/verify', [RegistrationController::class, 'verifyId'])->name('check-in.verify');

// Absensi Scan Routes untuk Tablet (Public - No Auth Required)
Route::get('/scan', [AbsensiController::class, 'scanPage'])->name('scan.page');
Route::post('/scan/process', [AbsensiController::class, 'processAbsensi'])->name('scan.process');

// Portal Jamaah Routes
Route::prefix('portal')->name('portal.')->group(function () {

    // Portal Homepage
    Route::get('/', [App\Http\Controllers\PortalController::class, 'index'])->name('index');

    // Events
    Route::get('/events', [App\Http\Controllers\PortalController::class, 'events'])->name('events');
    Route::get('/events/{slug}', [App\Http\Controllers\PortalController::class, 'eventDetail'])->name('event.detail');
    Route::post('/events/{id}/register', [App\Http\Controllers\PortalController::class, 'registerEvent'])->name('event.register');

    // Live Streaming
    Route::get('/live', [App\Http\Controllers\PortalController::class, 'liveStreaming'])->name('live');

    // Gallery
    Route::get('/gallery', [App\Http\Controllers\PortalController::class, 'gallery'])->name('gallery');

    // Feedback
    Route::get('/feedback', [App\Http\Controllers\PortalController::class, 'feedbackForm'])->name('feedback');
    Route::post('/feedback', [App\Http\Controllers\PortalController::class, 'submitFeedback'])->name('feedback.submit');

    // FAQ
    Route::get('/faq', [App\Http\Controllers\PortalController::class, 'faq'])->name('faq');
});
