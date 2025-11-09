<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PesertaController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\SertifikatController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Guest routes (not authenticated)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    });

    // Authenticated admin routes
    Route::middleware('auth:admin')->group(function () {
        
        // Logout
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Peserta Management
        Route::prefix('peserta')->name('peserta.')->group(function () {
            Route::get('/', [PesertaController::class, 'index'])->name('index');
            Route::get('/create', [PesertaController::class, 'create'])->name('create');
            Route::post('/', [PesertaController::class, 'store'])->name('store');
            Route::get('/{id_peserta}', [PesertaController::class, 'show'])->name('show');
            Route::get('/{id_peserta}/edit', [PesertaController::class, 'edit'])->name('edit');
            Route::put('/{id_peserta}', [PesertaController::class, 'update'])->name('update');
            Route::delete('/{id_peserta}', [PesertaController::class, 'destroy'])->name('destroy');
            
            // Export
            Route::get('/export/excel', [PesertaController::class, 'exportExcel'])->name('export.excel');
            Route::get('/export/pdf', [PesertaController::class, 'exportPdf'])->name('export.pdf');
            
            // Bulk actions
            Route::post('/bulk-delete', [PesertaController::class, 'bulkDelete'])->name('bulk-delete');
        });

        // Absensi Management
        Route::prefix('absensi')->name('absensi.')->group(function () {
            Route::get('/', [AbsensiController::class, 'index'])->name('index');
            Route::get('/create', [AbsensiController::class, 'create'])->name('create');
            Route::post('/', [AbsensiController::class, 'store'])->name('store');
            Route::get('/{id}', [AbsensiController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [AbsensiController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AbsensiController::class, 'update'])->name('update');
            Route::delete('/{id}', [AbsensiController::class, 'destroy'])->name('destroy');
            
            // QR Scanner
            Route::post('/scan', [AbsensiController::class, 'scan'])->name('scan');
            
            // Export
            Route::get('/export/excel', [AbsensiController::class, 'exportExcel'])->name('export.excel');
            
            // Statistics
            Route::get('/statistics', [AbsensiController::class, 'statistics'])->name('statistics');
            
        });

        // Sertifikat Management
        Route::prefix('sertifikat')->name('sertifikat.')->group(function () {
            Route::get('/', [SertifikatController::class, 'index'])->name('index');
            Route::get('/create', [SertifikatController::class, 'create'])->name('create');
            Route::post('/', [SertifikatController::class, 'store'])->name('store');
            Route::get('/{id}', [SertifikatController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [SertifikatController::class, 'edit'])->name('edit');
            Route::put('/{id}', [SertifikatController::class, 'update'])->name('update');
            Route::delete('/{id}', [SertifikatController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/pdf', [SertifikatController::class, 'downloadPdf'])->name('pdf');
            
            // Bulk actions
            Route::post('/bulk-generate', [SertifikatController::class, 'bulkGenerate'])->name('bulk-generate');
            Route::post('/bulk-send', [SertifikatController::class, 'bulkSend'])->name('bulk-send');
            Route::post('/{id}/mark-as-sent', [SertifikatController::class, 'markAsSent'])->name('mark-as-sent');
            
            // Export
            Route::get('/export/excel', [SertifikatController::class, 'exportExcel'])->name('export.excel');
            Route::get('/{id}/download-pdf', [SertifikatController::class, 'downloadPdf'])->name('download-pdf');
        });
    });
});