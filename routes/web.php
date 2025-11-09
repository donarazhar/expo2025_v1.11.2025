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
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');

// Success Page (optional)
Route::get('/success/{id_peserta}', [RegistrationController::class, 'success'])->name('register.success');

// Download QR Code
Route::get('/download-qr/{id_peserta}', [RegistrationController::class, 'downloadQr'])->name('download.qr');

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
