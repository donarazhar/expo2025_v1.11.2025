<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\Absensi;
use App\Models\ESertifikat;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        // Get statistics
        $stats = [
            'total_peserta' => Peserta::count(),
            'peserta_hari_ini' => Peserta::whereDate('tgl_registrasi', today())->count(),
            'total_hadir' => Absensi::where('status_kehadiran', true)->distinct('qr_code_token')->count(),
            'total_sertifikat' => ESertifikat::count(),
            'sertifikat_terkirim' => ESertifikat::where('status_kirim', true)->count(),
        ];

        // Get recent registrations (5 latest)
        $recent_registrations = Peserta::latest('tgl_registrasi')
                                      ->take(5)
                                      ->get();

        // Get registrations per day (last 7 days)
        $registrations_chart = Peserta::select(
                                    DB::raw('DATE(tgl_registrasi) as date'),
                                    DB::raw('COUNT(*) as count')
                                )
                                ->where('tgl_registrasi', '>=', now()->subDays(7))
                                ->groupBy('date')
                                ->orderBy('date')
                                ->get();

        // Get attendance per day
        $attendance_chart = Absensi::select(
                                DB::raw('DATE(waktu_scan) as date'),
                                DB::raw('COUNT(DISTINCT qr_code_token) as count')
                            )
                            ->where('waktu_scan', '>=', now()->subDays(7))
                            ->where('status_kehadiran', true)
                            ->groupBy('date')
                            ->orderBy('date')
                            ->get();

        // Get top institutions
        $top_institutions = Peserta::select('asal_instansi', DB::raw('COUNT(*) as count'))
                                  ->groupBy('asal_instansi')
                                  ->orderByDesc('count')
                                  ->take(5)
                                  ->get();

        return view('admin.dashboard.index', compact(
            'stats',
            'recent_registrations',
            'registrations_chart',
            'attendance_chart',
            'top_institutions'
        ));
    }
}