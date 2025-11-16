<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ESertifikat;
use App\Models\Peserta;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    /**
     * Display a listing of sertifikat
     */
    public function index(Request $request)
    {
        $query = ESertifikat::with('peserta');

        // Search by peserta name or certificate number
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_sertifikat', 'like', "%{$search}%")
                    ->orWhereHas('peserta', function ($q2) use ($search) {
                        $q2->where('nama_lengkap', 'like', "%{$search}%")
                            ->orWhere('id_peserta', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by status kirim
        if ($request->filled('status')) {
            $query->where('status_kirim', $request->status);
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->penerbitanBetween($request->start_date, $request->end_date);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'tgl_penerbitan');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $sertifikat = $query->paginate(20)->withQueryString();

        return view('admin.sertifikat.index', compact('sertifikat'));
    }

    /**
     * Show the form for creating a new sertifikat
     */
    public function create()
    {
        // Get peserta yang belum punya sertifikat
        $peserta = Peserta::doesntHave('eSertifikat')->get();

        return view('admin.sertifikat.create', compact('peserta'));
    }

    /**
     * Store a newly created sertifikat
     */
    public function store(Request $request)
    {
        $request->validate([
            'qr_code_token' => 'required|exists:peserta,qr_code_token|unique:e_sertifikat,qr_code_token',
            'tgl_penerbitan' => 'nullable|date',
        ], [
            'qr_code_token.required' => 'Peserta wajib dipilih',
            'qr_code_token.unique' => 'Peserta sudah memiliki sertifikat',
        ]);

        $data = $request->all();
        if (! isset($data['tgl_penerbitan'])) {
            $data['tgl_penerbitan'] = now();
        }

        $sertifikat = ESertifikat::create($data);

        return redirect()->route('admin.sertifikat.index')
            ->with('success', 'Sertifikat berhasil diterbitkan! Nomor: '.$sertifikat->nomor_sertifikat);
    }

    /**
     * Display the specified sertifikat
     */
    public function show($id_sertifikat)
    {
        $sertifikat = ESertifikat::with('peserta')->findOrFail($id_sertifikat);

        return view('admin.sertifikat.show', compact('sertifikat'));
    }

    /**
     * Show the form for editing the specified sertifikat
     */
    public function edit($id)
    {
        $sertifikat = ESertifikat::with('peserta')->findOrFail($id);

        return view('admin.sertifikat.edit', compact('sertifikat'));
    }

    /**
     * Update the specified sertifikat
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_penerbitan' => 'required|date',
            'status_kirim' => 'boolean',
        ]);

        $sertifikat = ESertifikat::findOrFail($id);
        $sertifikat->update($request->all());

        return redirect()->route('admin.sertifikat.index')
            ->with('success', 'Data sertifikat berhasil diupdate');
    }

    /**
     * Remove the specified sertifikat
     */
    public function destroy($id_sertifikat)
    {
        $sertifikat = ESertifikat::findOrFail($id_sertifikat);
        $sertifikat->delete();

        return redirect()->route('admin.sertifikat.index')
            ->with('success', 'Sertifikat berhasil dihapus');
    }

    public function bulkGenerate(Request $request)
    {
        // Get peserta yang sudah absen tapi belum punya sertifikat
        $peserta = Peserta::has('absensi')
            ->doesntHave('eSertifikat')
            ->get();

        if ($peserta->isEmpty()) {
            return redirect()->route('admin.sertifikat.index')
                ->with('info', 'Tidak ada peserta yang memenuhi syarat untuk generate sertifikat');
        }

        $count = 0;
        $errors = [];

        foreach ($peserta as $p) {
            try {
                // Buat sertifikat tanpa generate QR Code
                // QR Code akan di-generate on-the-fly saat download PDF
                ESertifikat::create([
                    'qr_code_token' => $p->qr_code_token,
                    'tgl_penerbitan' => now(),
                    'status_kirim' => false,
                ]);

                $count++;
            } catch (\Exception $e) {
                \Log::error("Failed to generate certificate for {$p->nama_lengkap}", [
                    'error' => $e->getMessage(),
                    'peserta_id' => $p->id_peserta,
                ]);
                $errors[] = $p->nama_lengkap;
            }
        }

        if ($count > 0) {
            $message = $count.' sertifikat berhasil digenerate';
            if (! empty($errors)) {
                $message .= '. Gagal: '.implode(', ', $errors);
            }

            return redirect()->route('admin.sertifikat.index')
                ->with('success', $message);
        } else {
            return redirect()->route('admin.sertifikat.index')
                ->with('error', 'Gagal generate sertifikat untuk semua peserta');
        }
    }

    /**
     * Mark sertifikat as sent
     */
    public function markAsSent($id)
    {
        $sertifikat = ESertifikat::findOrFail($id);
        $sertifikat->update(['status_kirim' => true]);

        return back()->with('success', 'Sertifikat ditandai sebagai terkirim');
    }

    /**
     * Bulk send sertifikat
     */
    public function bulkSend(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:e_sertifikat,id_sertifikat',
        ]);

        ESertifikat::whereIn('id_sertifikat', $request->ids)
            ->update(['status_kirim' => true]);

        // TODO: Send actual emails here

        return response()->json([
            'success' => true,
            'message' => count($request->ids).' sertifikat berhasil dikirim',
        ]);
    }

    /**
     * Export sertifikat to Excel
     */
    public function exportExcel(Request $request)
    {
        $query = ESertifikat::with('peserta');

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status_kirim', $request->status);
        }

        $sertifikat = $query->orderBy('tgl_penerbitan', 'desc')->get();

        // Generate CSV
        $filename = 'sertifikat_'.date('Y-m-d_His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        $callback = function () use ($sertifikat) {
            $file = fopen('php://output', 'w');

            // Header
            fputcsv($file, ['Nomor Sertifikat', 'Nama Peserta', 'Email', 'Tanggal Penerbitan', 'Status Kirim']);

            // Data
            foreach ($sertifikat as $s) {
                fputcsv($file, [
                    $s->nomor_sertifikat,
                    $s->peserta->nama_lengkap ?? '-',
                    $s->peserta->email ?? '-',
                    $s->tgl_penerbitan->format('d-m-Y H:i:s'),
                    $s->status_kirim ? 'Terkirim' : 'Belum Terkirim',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function downloadPdf($id_sertifikat)
    {
        $sertifikat = ESertifikat::with('peserta')->findOrFail($id_sertifikat);

        // Generate HTML view
        $html = view('admin.sertifikat.pdf', compact('sertifikat'))->render();

        return response($html)
            ->header('Content-Type', 'text/html; charset=utf-8')
            ->header('Content-Disposition', 'inline; filename="sertifikat_'.$sertifikat->nomor_sertifikat.'.html"');
    }

    public function verify($nomor_sertifikat)
    {
        $sertifikat = ESertifikat::with('peserta')
            ->where('nomor_sertifikat', $nomor_sertifikat)
            ->first();

        if (! $sertifikat) {
            abort(404, 'Sertifikat tidak ditemukan');
        }

        return view('public.sertifikat.verify', compact('sertifikat'));
    }
}
