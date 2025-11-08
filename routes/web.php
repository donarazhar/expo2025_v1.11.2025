<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RegistrationController;

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