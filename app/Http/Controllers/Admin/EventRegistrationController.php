<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventRegistrationController extends Controller
{
    /**
     * Display a listing of registrations
     */
    public function index(Request $request)
    {
        $query = EventRegistration::with(['peserta', 'event']);

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by event
        if ($request->has('event_id') && $request->event_id != '') {
            $query->where('event_id', $request->event_id);
        }

        // Search by peserta name or ID
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('peserta', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('id_peserta', 'like', "%{$search}%");
            });
        }

        $registrations = $query->latest()->paginate(20);
        $events = Event::orderBy('tanggal_mulai', 'desc')->get();

        return view('admin.eventregistrations.index', compact('registrations', 'events'));
    }

    /**
     * Show the form for creating a new registration
     */
    public function create()
    {
        $events = Event::where('tanggal_mulai', '>=', now())
            ->orderBy('tanggal_mulai')
            ->get();

        $pesertas = Peserta::orderBy('nama_lengkap')->get();

        return view('admin.eventregistrations.create', compact('events', 'pesertas'));
    }

    /**
     * Store a newly created registration
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_peserta' => 'required|exists:peserta,id_peserta',
            'event_id' => 'required|exists:events,id',
            'status' => 'required|in:pending,confirmed,cancelled',
            'keterangan' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            \Log::info('=== START EVENT REGISTRATION ===', [
                'id_peserta' => $request->id_peserta,
                'event_id' => $request->event_id,
            ]);

            // Check if already registered for this event
            $exists = EventRegistration::where('id_peserta', $request->id_peserta)
                ->where('event_id', $request->event_id)
                ->exists();

            if ($exists) {
                \Log::warning('Peserta already registered for this event');

                return back()->withErrors(['error' => 'Peserta sudah terdaftar di event ini!']);
            }

            // Check event capacity
            $event = Event::findOrFail($request->event_id);

            if ($event->kapasitas > 0) {
                $registeredCount = EventRegistration::where('event_id', $event->id)
                    ->whereIn('status', ['confirmed', 'pending'])
                    ->count();

                if ($registeredCount >= $event->kapasitas) {
                    return back()->withErrors(['error' => 'Kapasitas event sudah penuh!']);
                }
            }

            // Create event registration
            $eventRegistration = EventRegistration::create($request->all());
            \Log::info('Event registration created', ['id' => $eventRegistration->id]);

            // Get peserta data
            $peserta = Peserta::where('id_peserta', $request->id_peserta)->first();

            if (! $peserta) {
                \Log::error('Peserta not found', ['id_peserta' => $request->id_peserta]);
                throw new \Exception('Peserta tidak ditemukan!');
            }

            \Log::info('Peserta found', [
                'id_peserta' => $peserta->id_peserta,
                'nama' => $peserta->nama_lengkap,
                'qr_code_token' => $peserta->qr_code_token,
            ]);

            // AUTO CREATE ABSENSI (HANYA SEKALI PER PESERTA)
            // Check if peserta already has absensi record (ever)
            $hasAbsensi = Absensi::where('qr_code_token', $peserta->qr_code_token)->exists();

            \Log::info('Checking absensi status', [
                'qr_code_token' => $peserta->qr_code_token,
                'has_absensi' => $hasAbsensi,
            ]);

            if (! $hasAbsensi) {
                try {
                    // Create first-time absensi record
                    $absensiData = [
                        'qr_code_token' => $peserta->qr_code_token,
                        'waktu_scan' => now(),
                        'petugas_scanner' => auth()->check() ? auth()->user()->name : 'System',
                        'status_kehadiran' => true,
                        'keterangan' => 'Auto-created from event registration: '.$event->judul,
                    ];

                    \Log::info('Creating absensi with data:', $absensiData);

                    $absensi = Absensi::create($absensiData);

                    \Log::info('✓ Absensi created successfully!', [
                        'absensi_id' => $absensi->id,
                        'id_peserta' => $peserta->id_peserta,
                        'nama' => $peserta->nama_lengkap,
                        'event' => $event->judul,
                    ]);

                    $message = 'Registrasi berhasil ditambahkan! Absensi peserta juga telah dibuat.';

                } catch (\Exception $e) {
                    \Log::error('✗ Failed to create absensi', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                        'data' => $absensiData ?? null,
                    ]);

                    // Don't rollback registration if only absensi fails
                    // Just log the error and continue
                    $message = 'Registrasi berhasil ditambahkan, namun gagal membuat absensi: '.$e->getMessage();
                }
            } else {
                \Log::info('Absensi already exists for peserta', [
                    'id_peserta' => $peserta->id_peserta,
                    'nama' => $peserta->nama_lengkap,
                    'existing_count' => Absensi::where('qr_code_token', $peserta->qr_code_token)->count(),
                ]);

                $message = 'Registrasi berhasil ditambahkan!';
            }

            DB::commit();
            \Log::info('=== TRANSACTION COMMITTED ===');

            return redirect()->route('admin.eventregistrations.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('=== ERROR IN EVENT REGISTRATION ===', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified registration
     */
    public function show(EventRegistration $registration)
    {
        $registration->load(['peserta', 'event.schedules', 'lotteryWinners.prize']);

        return view('admin.eventregistrations.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified registration
     */
    public function edit(EventRegistration $registration)
    {
        $events = Event::orderBy('tanggal_mulai', 'desc')->get();
        $pesertas = Peserta::orderBy('nama_lengkap')->get();

        return view('admin.eventregistrations.edit', compact('registration', 'events', 'pesertas'));
    }

    /**
     * Update the specified registration
     */
    public function update(Request $request, EventRegistration $registration)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
            'keterangan' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            // If confirming, check capacity
            if ($request->status === 'confirmed' && $registration->status !== 'confirmed') {
                $event = $registration->event;

                if ($event->kapasitas > 0) {
                    $confirmedCount = EventRegistration::where('event_id', $event->id)
                        ->where('status', 'confirmed')
                        ->where('id', '!=', $registration->id)
                        ->count();

                    if ($confirmedCount >= $event->kapasitas) {
                        return back()->withErrors(['error' => 'Kapasitas event sudah penuh!']);
                    }
                }

                // When confirming registration, also create absensi if not exists
                $peserta = $registration->peserta;
                $hasAbsensi = Absensi::where('qr_code_token', $peserta->qr_code_token)->exists();

                if (! $hasAbsensi) {
                    Absensi::create([
                        'qr_code_token' => $peserta->qr_code_token,
                        'waktu_scan' => now(),
                        'petugas_scanner' => auth()->user()->name ?? 'System',
                        'status_kehadiran' => true,
                        'keterangan' => 'Auto-created from confirmed registration: '.$registration->event->judul,
                    ]);

                    \Log::info('Auto-created absensi on confirmation', [
                        'id_peserta' => $peserta->id_peserta,
                        'event' => $registration->event->judul,
                    ]);
                }
            }

            $registration->update([
                'status' => $request->status,
                'keterangan' => $request->keterangan,
            ]);

            DB::commit();

            return redirect()->route('admin.eventregistrations.index')
                ->with('success', 'Registrasi berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Terjadi kesalahan: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified registration
     */
    public function destroy(EventRegistration $registration)
    {
        try {
            DB::beginTransaction();

            // Check if registration has lottery wins
            if ($registration->lotteryWinners()->exists()) {
                return back()->withErrors(['error' => 'Tidak dapat menghapus registrasi yang memiliki hadiah undian!']);
            }


            $registration->delete();

            DB::commit();

            return redirect()->route('admin.eventregistrations.index')
                ->with('success', 'Registrasi berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Terjadi kesalahan: '.$e->getMessage()]);
        }
    }

    /**
     * Bulk update status
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'registration_ids' => 'required|array',
            'registration_ids.*' => 'exists:event_registrations,id',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        try {
            DB::beginTransaction();

            // If bulk confirming, create absensi for those who don't have it
            if ($request->status === 'confirmed') {
                $registrations = EventRegistration::with('peserta')
                    ->whereIn('id', $request->registration_ids)
                    ->get();

                foreach ($registrations as $registration) {
                    $peserta = $registration->peserta;
                    $hasAbsensi = Absensi::where('qr_code_token', $peserta->qr_code_token)->exists();

                    if (! $hasAbsensi) {
                        Absensi::create([
                            'qr_code_token' => $peserta->qr_code_token,
                            'waktu_scan' => now(),
                            'petugas_scanner' => auth()->user()->name ?? 'System',
                            'status_kehadiran' => true,
                            'keterangan' => 'Auto-created from bulk confirmation',
                        ]);
                    }
                }
            }

            EventRegistration::whereIn('id', $request->registration_ids)
                ->update(['status' => $request->status]);

            DB::commit();

            return back()->with('success', 'Status registrasi berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Terjadi kesalahan: '.$e->getMessage()]);
        }
    }

    /**
     * Export registrations
     */
    public function export(Request $request)
    {
        $query = EventRegistration::with(['peserta', 'event']);

        if ($request->has('event_id') && $request->event_id != '') {
            $query->where('event_id', $request->event_id);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $registrations = $query->get();

        $filename = 'registrations_'.date('YmdHis').'.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');

        $output = fopen('php://output', 'w');

        // Header
        fputcsv($output, [
            'ID Peserta',
            'Nama Peserta',
            'Event',
            'Status',
            'Tanggal Registrasi',
            'Keterangan',
            'Has Absensi',
        ]);

        // Data
        foreach ($registrations as $reg) {
            $hasAbsensi = Absensi::where('qr_code_token', $reg->peserta->qr_code_token ?? '')->exists();

            fputcsv($output, [
                $reg->id_peserta,
                $reg->peserta->nama_lengkap ?? '-',
                $reg->event->judul ?? '-',
                ucfirst($reg->status),
                $reg->created_at->format('d/m/Y H:i'),
                $reg->keterangan ?? '-',
                $hasAbsensi ? 'Yes' : 'No',
            ]);
        }

        fclose($output);
        exit;
    }

    /**
     * Check absensi status for a peserta
     */
    public function checkAbsensiStatus($id_peserta)
    {
        try {
            $peserta = Peserta::where('id_peserta', $id_peserta)->first();

            if (! $peserta) {
                return response()->json([
                    'success' => false,
                    'message' => 'Peserta tidak ditemukan',
                ], 404);
            }

            $hasAbsensi = Absensi::where('qr_code_token', $peserta->qr_code_token)->exists();
            $absensiCount = Absensi::where('qr_code_token', $peserta->qr_code_token)->count();
            $lastAbsensi = Absensi::where('qr_code_token', $peserta->qr_code_token)
                ->latest('waktu_scan')
                ->first();

            return response()->json([
                'success' => true,
                'has_absensi' => $hasAbsensi,
                'absensi_count' => $absensiCount,
                'last_absensi' => $lastAbsensi ? [
                    'waktu_scan' => $lastAbsensi->waktu_scan->format('d M Y H:i'),
                    'keterangan' => $lastAbsensi->keterangan,
                ] : null,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
