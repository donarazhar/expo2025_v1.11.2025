<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LiveStreamController;
use App\Http\Controllers\Admin\PesertaController;
use App\Http\Controllers\Admin\SertifikatController;
use Illuminate\Support\Facades\Route;

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

            // Route verifikasi sertifikat (public)
            Route::get('/verify/{nomor_sertifikat}', function ($nomor_sertifikat) {
                $sertifikat = \App\Models\ESertifikat::with('peserta')
                    ->where('nomor_sertifikat', $nomor_sertifikat)
                    ->first();

                if (! $sertifikat) {
                    abort(404, 'Sertifikat tidak ditemukan');
                }

                return view('public.verify', compact('sertifikat'));
            })->name('sertifikat.verify');
        });

        // Events Management
        Route::resource('events', EventController::class);
        Route::post('events/{event}/duplicate', [EventController::class, 'duplicate'])->name('events.duplicate');

        // FAQs Management
        Route::resource('faqs', FaqController::class);
        Route::post('faqs/{faq}/toggle-publish', [FaqController::class, 'togglePublish'])->name('faqs.toggle-publish');
        Route::post('faqs/{faq}/duplicate', [FaqController::class, 'duplicate'])->name('faqs.duplicate');
        Route::post('faqs/reorder', [FaqController::class, 'reorder'])->name('faqs.reorder');

        // Feedbacks Management
        Route::resource('feedbacks', FeedbackController::class);
        Route::post('feedbacks/{feedback}/toggle-publish', [FeedbackController::class, 'togglePublish'])->name('feedbacks.toggle-publish');
        Route::post('feedbacks/{feedback}/toggle-featured', [FeedbackController::class, 'toggleFeatured'])->name('feedbacks.toggle-featured');
        Route::post('feedbacks/bulk-action', [FeedbackController::class, 'bulkAction'])->name('feedbacks.bulk-action');

        // Galleries Management
        Route::resource('galleries', GalleryController::class);
        Route::post('galleries/reorder', [GalleryController::class, 'reorder'])->name('galleries.reorder');
        Route::post('galleries/bulk-delete', [GalleryController::class, 'bulkDelete'])->name('galleries.bulk-delete');

        // Live Streams Management
        Route::resource('live-streams', LiveStreamController::class);
        Route::post('live-streams/{liveStream}/update-status', [LiveStreamController::class, 'updateStatus'])->name('live-streams.update-status');
        Route::post('live-streams/{liveStream}/duplicate', [LiveStreamController::class, 'duplicate'])->name('live-streams.duplicate');
        Route::post('live-streams/generate-embed', [LiveStreamController::class, 'generateEmbed'])->name('live-streams.generate-embed');

        // Activity Log Routes
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])
            ->name('activity-logs.index');

        Route::get('/activity-logs/{activity}', [ActivityLogController::class, 'show'])
            ->name('activity-logs.show');

    });
});
