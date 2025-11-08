<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesertaController extends Controller
{
    /**
     * Display a listing of peserta
     */
    public function index(Request $request)
    {
        $query = Peserta::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->search($search);
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->registeredBetween($request->start_date, $request->end_date);
        }

        // Filter by institution
        if ($request->filled('instansi')) {
            $query->where('asal_instansi', 'like', '%' . $request->instansi . '%');
        }

        // Sort
        $sortBy = $request->get('sort_by', 'tgl_registrasi');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginate
        $peserta = $query->paginate(20)->withQueryString();

        return view('admin.peserta.index', compact('peserta'));
    }

    /**
     * Show the form for creating a new peserta
     */
    public function create()
    {
        return view('admin.peserta.create');
    }

    /**
     * Store a newly created peserta
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:peserta,email|max:255',
            'no_hp' => ['required', 'string', 'regex:/^(\+62|62|0)[0-9]{9,12}$/', 'max:20'],
            'asal_instansi' => 'required|string|min:3|max:255',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'no_hp.regex' => 'Format nomor HP tidak valid',
            'asal_instansi.required' => 'Asal instansi wajib diisi',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $peserta = Peserta::create($request->all());

        return redirect()->route('admin.peserta.index')
                       ->with('success', 'Peserta berhasil ditambahkan! ID: ' . $peserta->id_peserta);
    }

    /**
     * Display the specified peserta
     */
    public function show($id_peserta)
    {
        $peserta = Peserta::where('id_peserta', $id_peserta)
                         ->with(['absensi', 'sertifikat'])
                         ->firstOrFail();

        return view('admin.peserta.show', compact('peserta'));
    }

    /**
     * Show the form for editing the specified peserta
     */
    public function edit($id_peserta)
    {
        $peserta = Peserta::where('id_peserta', $id_peserta)->firstOrFail();
        
        return view('admin.peserta.edit', compact('peserta'));
    }

    /**
     * Update the specified peserta
     */
    public function update(Request $request, $id_peserta)
    {
        $peserta = Peserta::where('id_peserta', $id_peserta)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:peserta,email,' . $peserta->id_peserta . ',id_peserta|max:255',
            'no_hp' => ['required', 'string', 'regex:/^(\+62|62|0)[0-9]{9,12}$/', 'max:20'],
            'asal_instansi' => 'required|string|min:3|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $peserta->update($request->all());

        return redirect()->route('admin.peserta.index')
                       ->with('success', 'Data peserta berhasil diupdate');
    }

    /**
     * Remove the specified peserta (soft delete)
     */
    public function destroy($id_peserta)
    {
        $peserta = Peserta::where('id_peserta', $id_peserta)->firstOrFail();
        $peserta->delete();

        return redirect()->route('admin.peserta.index')
                       ->with('success', 'Peserta berhasil dihapus');
    }

    /**
     * Export peserta to Excel
     */
    public function exportExcel(Request $request)
    {
        $query = Peserta::query();

        // Apply same filters as index
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->registeredBetween($request->start_date, $request->end_date);
        }

        $peserta = $query->orderBy('tgl_registrasi', 'desc')->get();

        // Generate CSV
        $filename = 'peserta_' . date('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($peserta) {
            $file = fopen('php://output', 'w');
            
            // Header
            fputcsv($file, ['ID Peserta', 'Nama Lengkap', 'Email', 'No HP', 'Asal Instansi', 'Tanggal Registrasi', 'QR Code Token']);

            // Data
            foreach ($peserta as $p) {
                fputcsv($file, [
                    $p->id_peserta,
                    $p->nama_lengkap,
                    $p->email,
                    $p->no_hp,
                    $p->asal_instansi,
                    $p->tgl_registrasi->format('d-m-Y H:i:s'),
                    $p->qr_code_token,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export peserta to PDF
     */
    public function exportPdf(Request $request)
    {
        $query = Peserta::query();

        // Apply filters
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->registeredBetween($request->start_date, $request->end_date);
        }

        $peserta = $query->orderBy('tgl_registrasi', 'desc')->get();

        // Generate HTML for PDF
        $html = view('admin.peserta.pdf', compact('peserta'))->render();

        // For now, return HTML (you can integrate with DOMPDF or similar)
        return response($html)
               ->header('Content-Type', 'text/html')
               ->header('Content-Disposition', 'inline; filename="peserta_' . date('Y-m-d_His') . '.html"');
    }

    /**
     * Bulk delete peserta
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:peserta,id_peserta',
        ]);

        Peserta::whereIn('id_peserta', $request->ids)->delete();

        return response()->json([
            'success' => true,
            'message' => count($request->ids) . ' peserta berhasil dihapus',
        ]);
    }
}