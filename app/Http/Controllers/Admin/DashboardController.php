<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\Absensi;
use App\Models\ESertifikat;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        // ============================================
        // STATISTICS CARDS
        // ============================================
        $stats = [
            // Peserta Stats
            'total_peserta' => Peserta::count(),
            'peserta_hari_ini' => Peserta::whereDate('tgl_registrasi', today())->count(),
            'peserta_minggu_ini' => Peserta::whereBetween('tgl_registrasi', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])->count(),
            'peserta_bulan_ini' => Peserta::whereMonth('tgl_registrasi', now()->month)
                                         ->whereYear('tgl_registrasi', now()->year)
                                         ->count(),
            
            // Kehadiran Stats
            'total_hadir' => Absensi::where('status_kehadiran', true)
                                   ->distinct('qr_code_token')
                                   ->count('qr_code_token'),
            'hadir_hari_ini' => Absensi::where('status_kehadiran', true)
                                      ->whereDate('waktu_scan', today())
                                      ->distinct('qr_code_token')
                                      ->count('qr_code_token'),
            'persentase_kehadiran' => $this->getAttendancePercentage(),
            
            // Sertifikat Stats
            'total_sertifikat' => ESertifikat::count(),
            'sertifikat_terkirim' => ESertifikat::where('status_kirim', true)->count(),
            'sertifikat_pending' => ESertifikat::where('status_kirim', false)->count(),
            
            // Event Stats
            'total_events' => Event::count(),
            'events_aktif' => Event::where('status', 'published')->count(),
            'events_upcoming' => Event::upcoming()->count(),
            'events_ongoing' => Event::ongoing()->count(),
            
            // Registration Stats
            'total_registrations' => EventRegistration::count(),
            'registrations_confirmed' => EventRegistration::where('status', 'confirmed')->count(),
            'registrations_pending' => EventRegistration::where('status', 'pending')->count(),
            
            // Feedback Stats
            'total_feedback' => Feedback::count(),
            'average_rating' => round(Feedback::avg('rating'), 1),
            'feedback_published' => Feedback::where('is_published', true)->count(),
        ];

        // ============================================
        // RECENT DATA
        // ============================================
        
        // Recent registrations (10 latest)
        $recent_registrations = Peserta::with(['absensi', 'eSertifikat'])
                                      ->latest('tgl_registrasi')
                                      ->take(10)
                                      ->get();

        // Recent attendance (10 latest)
        $recent_attendance = Absensi::with('peserta')
                                   ->where('status_kehadiran', true)
                                   ->latest('waktu_scan')
                                   ->take(10)
                                   ->get();

        // Recent certificates (10 latest)
        $recent_certificates = ESertifikat::with('peserta')
                                         ->latest('tgl_penerbitan')
                                         ->take(10)
                                         ->get();

        // ============================================
        // CHARTS DATA
        // ============================================
        
        // Registrations per day (last 14 days)
        $registrations_chart = $this->getRegistrationsChart(14);

        // Attendance per day (last 14 days)
        $attendance_chart = $this->getAttendanceChart(14);

        // Certificates per day (last 14 days)
        $certificates_chart = $this->getCertificatesChart(14);

        // ============================================
        // TOP STATISTICS
        // ============================================
        
        // Top institutions (Top 10)
        $top_institutions = Peserta::select('asal_instansi', DB::raw('COUNT(*) as count'))
                                  ->groupBy('asal_instansi')
                                  ->orderByDesc('count')
                                  ->take(10)
                                  ->get();

        // Top events by registrations
        $top_events = Event::withCount(['registrations' => function($query) {
                            $query->where('status', 'confirmed');
                        }])
                          ->orderByDesc('registrations_count')
                          ->take(5)
                          ->get();

        // Event registrations by status
        $registration_status = EventRegistration::select('status', DB::raw('COUNT(*) as count'))
                                                ->groupBy('status')
                                                ->get();

        // Feedback rating distribution
        $rating_distribution = Feedback::select('rating', DB::raw('COUNT(*) as count'))
                                      ->groupBy('rating')
                                      ->orderByDesc('rating')
                                      ->get();

        // ============================================
        // TRENDS & COMPARISONS
        // ============================================
        
        // Growth trends
        $growth_trends = [
            'peserta' => $this->calculateGrowth('peserta', 'tgl_registrasi'),
            'kehadiran' => $this->calculateGrowth('absensi', 'waktu_scan'),
            'sertifikat' => $this->calculateGrowth('e_sertifikat', 'tgl_penerbitan'),
        ];

        // Hourly attendance pattern (today)
        $hourly_attendance = Absensi::select(DB::raw('HOUR(waktu_scan) as hour'), DB::raw('COUNT(*) as count'))
                                   ->whereDate('waktu_scan', today())
                                   ->where('status_kehadiran', true)
                                   ->groupBy('hour')
                                   ->orderBy('hour')
                                   ->get();

        // ============================================
        // UPCOMING EVENTS
        // ============================================
        
        $upcoming_events = Event::where('status', 'published')
                               ->upcoming()
                               ->orderBy('tanggal_mulai')
                               ->take(5)
                               ->get();

        return view('admin.dashboard.index', compact(
            'stats',
            'recent_registrations',
            'recent_attendance',
            'recent_certificates',
            'registrations_chart',
            'attendance_chart',
            'certificates_chart',
            'top_institutions',
            'top_events',
            'registration_status',
            'rating_distribution',
            'growth_trends',
            'hourly_attendance',
            'upcoming_events'
        ));
    }

    /**
     * Calculate attendance percentage
     */
    private function getAttendancePercentage()
    {
        $totalPeserta = Peserta::count();
        if ($totalPeserta == 0) return 0;
        
        $totalHadir = Absensi::where('status_kehadiran', true)
                            ->distinct('qr_code_token')
                            ->count('qr_code_token');
        
        return round(($totalHadir / $totalPeserta) * 100, 1);
    }

    /**
     * Get registrations chart data
     */
    private function getRegistrationsChart($days = 14)
    {
        $startDate = now()->subDays($days - 1)->startOfDay();
        
        $data = Peserta::select(
                    DB::raw('DATE(tgl_registrasi) as date'),
                    DB::raw('COUNT(*) as count')
                )
                ->where('tgl_registrasi', '>=', $startDate)
                ->groupBy('date')
                ->orderBy('date')
                ->get();

        // Fill missing dates with 0
        $chart = [];
        for ($i = 0; $i < $days; $i++) {
            $date = now()->subDays($days - 1 - $i)->format('Y-m-d');
            $chart[] = [
                'date' => $date,
                'label' => Carbon::parse($date)->format('d M'),
                'count' => $data->firstWhere('date', $date)->count ?? 0
            ];
        }

        return $chart;
    }

    /**
     * Get attendance chart data
     */
    private function getAttendanceChart($days = 14)
    {
        $startDate = now()->subDays($days - 1)->startOfDay();
        
        $data = Absensi::select(
                    DB::raw('DATE(waktu_scan) as date'),
                    DB::raw('COUNT(DISTINCT qr_code_token) as count')
                )
                ->where('waktu_scan', '>=', $startDate)
                ->where('status_kehadiran', true)
                ->groupBy('date')
                ->orderBy('date')
                ->get();

        // Fill missing dates with 0
        $chart = [];
        for ($i = 0; $i < $days; $i++) {
            $date = now()->subDays($days - 1 - $i)->format('Y-m-d');
            $chart[] = [
                'date' => $date,
                'label' => Carbon::parse($date)->format('d M'),
                'count' => $data->firstWhere('date', $date)->count ?? 0
            ];
        }

        return $chart;
    }

    /**
     * Get certificates chart data
     */
    private function getCertificatesChart($days = 14)
    {
        $startDate = now()->subDays($days - 1)->startOfDay();
        
        $data = ESertifikat::select(
                    DB::raw('DATE(tgl_penerbitan) as date'),
                    DB::raw('COUNT(*) as count')
                )
                ->where('tgl_penerbitan', '>=', $startDate)
                ->groupBy('date')
                ->orderBy('date')
                ->get();

        // Fill missing dates with 0
        $chart = [];
        for ($i = 0; $i < $days; $i++) {
            $date = now()->subDays($days - 1 - $i)->format('Y-m-d');
            $chart[] = [
                'date' => $date,
                'label' => Carbon::parse($date)->format('d M'),
                'count' => $data->firstWhere('date', $date)->count ?? 0
            ];
        }

        return $chart;
    }

    /**
     * Calculate growth percentage
     */
    private function calculateGrowth($table, $dateColumn)
    {
        // This month
        $thisMonth = DB::table($table)
                      ->whereMonth($dateColumn, now()->month)
                      ->whereYear($dateColumn, now()->year)
                      ->count();

        // Last month
        $lastMonth = DB::table($table)
                      ->whereMonth($dateColumn, now()->subMonth()->month)
                      ->whereYear($dateColumn, now()->subMonth()->year)
                      ->count();

        if ($lastMonth == 0) {
            return $thisMonth > 0 ? 100 : 0;
        }

        $growth = (($thisMonth - $lastMonth) / $lastMonth) * 100;
        
        return [
            'current' => $thisMonth,
            'previous' => $lastMonth,
            'percentage' => round($growth, 1),
            'trend' => $growth >= 0 ? 'up' : 'down'
        ];
    }
}