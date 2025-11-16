<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    /**
     * Display a listing of absensi
     */
    public function index(Request $request)
    {
        $query = Absensi::with('peserta');

        // Search by peserta name or ID
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('peserta', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('id_peserta', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('waktu_scan', $request->date);
        }

        // Filter by petugas
        if ($request->filled('petugas')) {
            $query->where('petugas_scanner', 'like', '%'.$request->petugas.'%');
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status_kehadiran', $request->status);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'waktu_scan');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $absensi = $query->paginate(20)->withQueryString();

        return view('admin.absensi.index', compact('absensi'));
    }

    /**
     * Show the form for creating a new absensi
     */
    public function create()
    {
        // Get all registered peserta for selection
        $pesertas = Peserta::orderBy('nama_lengkap')->get();

        return view('admin.absensi.create', compact('pesertas'));
    }

    /**
     * Store a newly created absensi (Manual Input from Admin)
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_peserta' => 'required|exists:peserta,id_peserta',
            'petugas_scanner' => 'required|string|max:100',
            'waktu_scan' => 'nullable|date',
            'status_kehadiran' => 'nullable|boolean',
        ], [
            'id_peserta.required' => 'Pilih peserta terlebih dahulu',
            'id_peserta.exists' => 'Peserta tidak ditemukan',
            'petugas_scanner.required' => 'Nama petugas wajib diisi',
        ]);

        // Get peserta to get QR token
        $peserta = Peserta::where('id_peserta', $request->id_peserta)->first();

        if (! $peserta) {
            return back()->withErrors(['id_peserta' => 'Peserta tidak ditemukan'])->withInput();
        }

        // Check if already checked in today
        $alreadyChecked = Absensi::where('qr_code_token', $peserta->qr_code_token)
            ->whereDate('waktu_scan', $request->waktu_scan ? date('Y-m-d', strtotime($request->waktu_scan)) : today())
            ->exists();

        if ($alreadyChecked) {
            return back()->withErrors(['id_peserta' => 'Peserta sudah melakukan absensi pada tanggal tersebut'])->withInput();
        }

        $data = [
            'qr_code_token' => $peserta->qr_code_token,
            'petugas_scanner' => $request->petugas_scanner,
            'waktu_scan' => $request->waktu_scan ?? now(),
            'status_kehadiran' => $request->status_kehadiran ?? true,
            'keterangan' => 'Manual input by '.$request->petugas_scanner,
        ];

        Absensi::create($data);

        return redirect()->route('admin.absensi.index')
            ->with('success', 'Absensi '.$peserta->nama_lengkap.' berhasil ditambahkan');
    }

    /**
     * Display the specified absensi
     */
    public function show($id)
    {
        $absensi = Absensi::with('peserta')->findOrFail($id);

        return view('admin.absensi.show', compact('absensi'));
    }

    /**
     * Show the form for editing the specified absensi
     */
    public function edit($id)
    {
        $absensi = Absensi::with('peserta')->findOrFail($id);

        return view('admin.absensi.edit', compact('absensi'));
    }

    /**
     * Update the specified absensi
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'petugas_scanner' => 'required|string|max:100',
            'waktu_scan' => 'required|date',
            'status_kehadiran' => 'nullable|boolean',
        ]);

        $absensi = Absensi::findOrFail($id);

        $data = $request->all();
        if (! isset($data['status_kehadiran'])) {
            $data['status_kehadiran'] = true;
        }

        $absensi->update($data);

        return redirect()->route('admin.absensi.index')
            ->with('success', 'Data absensi berhasil diupdate');
    }

    /**
     * Remove the specified absensi
     */
    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return redirect()->route('admin.absensi.index')
            ->with('success', 'Absensi berhasil dihapus');
    }

    /**
     * Export absensi to Excel
     */
    public function exportExcel(Request $request)
    {
        $query = Absensi::with('peserta');

        // Apply filters
        if ($request->filled('date')) {
            $query->whereDate('waktu_scan', $request->date);
        }

        $absensi = $query->orderBy('waktu_scan', 'desc')->get();

        // Generate CSV
        $filename = 'absensi_'.date('Y-m-d_His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        $callback = function () use ($absensi) {
            $file = fopen('php://output', 'w');

            // Header
            fputcsv($file, ['ID Peserta', 'Nama Peserta', 'Email', 'Waktu Scan', 'Petugas', 'Status']);

            // Data
            foreach ($absensi as $a) {
                fputcsv($file, [
                    $a->peserta->id_peserta ?? '-',
                    $a->peserta->nama_lengkap ?? '-',
                    $a->peserta->email ?? '-',
                    $a->waktu_scan->format('d-m-Y H:i:s'),
                    $a->petugas_scanner,
                    $a->status_kehadiran ? 'Hadir' : 'Tidak Hadir',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get attendance statistics
     */
    public function statistics(Request $request)
    {
        $date = $request->get('date', today());

        $stats = [
            'total_hari_ini' => Absensi::whereDate('waktu_scan', $date)
                ->where('status_kehadiran', true)
                ->distinct('qr_code_token')
                ->count(),
            'total_keseluruhan' => Absensi::where('status_kehadiran', true)
                ->distinct('qr_code_token')
                ->count(),
            'per_jam' => Absensi::whereDate('waktu_scan', $date)
                ->selectRaw('HOUR(waktu_scan) as jam, COUNT(*) as jumlah')
                ->groupBy('jam')
                ->orderBy('jam')
                ->get(),
        ];

        return response()->json($stats);
    }

    /**
     * Show QR Scanner Page (untuk tablet/kiosk absensi - PUBLIC ACCESS)
     */
    public function scanPage()
    {
        return view('admin.absensi.scan');
    }

    /**
     * Process Absensi dari QR Code Scanner atau Manual Input (PUBLIC API)
     */
    public function processAbsensi(Request $request)
    {
        \Log::info('=== ABSENSI SCAN REQUEST ===', $request->all());

        $validator = Validator::make($request->all(), [
            'qr_code_token' => 'required|string',
        ], [
            'qr_code_token.required' => 'QR Code token tidak valid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code token tidak valid',
            ], 422);
        }

        // Cari peserta berdasarkan QR Code token
        $peserta = Peserta::where('qr_code_token', $request->qr_code_token)->first();

        if (! $peserta) {
            \Log::warning('QR Code not found:', ['token' => $request->qr_code_token]);

            return response()->json([
                'success' => false,
                'message' => 'QR Code tidak ditemukan. Pastikan sudah terdaftar.',
            ], 404);
        }

        \Log::info('Peserta found:', ['id' => $peserta->id_peserta, 'nama' => $peserta->nama_lengkap]);

        // Check apakah sudah absen hari ini
        $sudahAbsen = Absensi::where('qr_code_token', $request->qr_code_token)
            ->whereDate('waktu_scan', today())
            ->first();

        if ($sudahAbsen) {
            \Log::info('Already checked in today:', ['id' => $peserta->id_peserta]);

            return response()->json([
                'success' => false,
                'message' => 'Sudah melakukan absensi hari ini!',
                'already_checked_in' => true,
                'peserta' => [
                    'nama_lengkap' => $peserta->nama_lengkap,
                    'id_peserta' => $peserta->id_peserta,
                    'asal_instansi' => $peserta->asal_instansi,
                ],
                'absensi' => [
                    'waktu_scan' => $sudahAbsen->waktu_scan->format('d F Y, H:i:s'),
                ],
            ], 200);
        }

        // Create absensi record
        try {
            $absensi = Absensi::create([
                'qr_code_token' => $peserta->qr_code_token,
                'waktu_scan' => now(),
                'petugas_scanner' => $request->get('petugas', 'Kiosk Self-Service'),
                'status_kehadiran' => true,
                'keterangan' => 'Check-in via '.$request->get('source', 'QR Scanner'),
            ]);

            \Log::info('Absensi created successfully:', ['id' => $absensi->id]);

            return response()->json([
                'success' => true,
                'message' => 'Absensi Berhasil! Selamat Datang.',
                'peserta' => [
                    'nama_lengkap' => $peserta->nama_lengkap,
                    'id_peserta' => $peserta->id_peserta,
                    'asal_instansi' => $peserta->asal_instansi,
                    'email' => $peserta->email,
                ],
                'absensi' => [
                    'waktu_scan' => $absensi->waktu_scan->format('d F Y, H:i:s'),
                    'id' => $absensi->id,
                ],
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Absensi creation error:', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan absensi: '.$e->getMessage(),
            ], 500);
        }
    }
}
