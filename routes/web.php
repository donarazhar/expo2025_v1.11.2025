<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Portal\FeedbackController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('home');

// DEBUG ROUTE - Remove this after testing
Route::post('/test-register', function (Request $request) {
    \Log::info('Test Register Hit!', $request->all());

    return response()->json([
        'success' => true,
        'message' => 'Test route works!',
        'data' => $request->all(),
    ]);
});

// Registration Routes
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');
Route::get('/register/success/{id_peserta}', [RegistrationController::class, 'success'])->name('register.success');

// Check Email Availability (AJAX)
Route::post('/check-email', [RegistrationController::class, 'checkEmail'])->name('check.email');

// QR Code
Route::get('/qr/download/{id_peserta}', [RegistrationController::class, 'downloadQr'])->name('qr.download');

// Check-in Routes
Route::get('/check-in', function () {
    return view('checkin-simple');
})->name('check-in.form');
Route::post('/check-in/verify', [RegistrationController::class, 'verifyId'])->name('check-in.verify');

// Absensi Scan Routes
Route::get('/scan', [AbsensiController::class, 'scanPage'])->name('scan.page');
Route::post('/scan/process', [AbsensiController::class, 'processAbsensi'])->name('scan.process');

// Portal Routes
Route::prefix('portal')->name('portal.')->group(function () {
    Route::get('/', [App\Http\Controllers\PortalController::class, 'index'])->name('index');
    Route::get('/events', [App\Http\Controllers\PortalController::class, 'events'])->name('events');
    Route::get('/events/{slug}', [App\Http\Controllers\PortalController::class, 'eventDetail'])->name('event.detail');
    Route::post('/events/{id}/register', [App\Http\Controllers\PortalController::class, 'registerEvent'])->name('event.register');
    Route::get('/live', [App\Http\Controllers\PortalController::class, 'liveStreaming'])->name('live');
    Route::get('/gallery', [App\Http\Controllers\PortalController::class, 'gallery'])->name('gallery');
    // Feedback routes
    Route::get('/feedback', [FeedbackController::class, 'index'])
        ->name('feedback');

    Route::post('/feedback/submit', [FeedbackController::class, 'submit'])
        ->name('feedback.submit');

    Route::get('/feedback/published', [FeedbackController::class, 'getPublished'])
        ->name('feedback.published');

    Route::get('/feedback/featured', [FeedbackController::class, 'getFeatured'])
        ->name('feedback.featured');

    Route::get('/faq', [App\Http\Controllers\PortalController::class, 'faq'])->name('faq');
});

// Include Admin Routes
require __DIR__.'/admin.php';
