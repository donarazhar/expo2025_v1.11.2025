<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('no_hp', 'like', '%'.$search.'%')
                    ->orWhere('id_peserta', 'like', '%'.$search.'%')
                    ->orWhere('asal_instansi', 'like', '%'.$search.'%');
            });
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('tgl_registrasi', '>=', $request->start_date)
                ->whereDate('tgl_registrasi', '<=', $request->end_date);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('tgl_registrasi', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->whereDate('tgl_registrasi', '<=', $request->end_date);
        }

        // Filter by institution
        if ($request->filled('instansi')) {
            $query->where('asal_instansi', 'like', '%'.$request->instansi.'%');
        }

        // Sort
        $sortBy = $request->get('sort_by', 'tgl_registrasi');
        $sortOrder = $request->get('sort_order', 'desc');

        // Validasi sort column untuk keamanan
        $allowedSortColumns = ['nama_lengkap', 'email', 'asal_instansi', 'tgl_registrasi'];
        if (! in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'tgl_registrasi';
        }

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

        // Activity log sudah otomatis tercatat dari model
        // Tapi kita bisa tambahkan log manual dengan info tambahan
        activity('peserta')
            ->causedBy(Auth::guard('admin')->user())
            ->performedOn($peserta)
            ->withProperties([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'attributes' => $peserta->only(['nama_lengkap', 'email', 'no_hp', 'asal_instansi']),
            ])
            ->log("Admin menambahkan peserta baru: {$peserta->nama_lengkap} (ID: {$peserta->id_peserta})");

        return redirect()->route('admin.peserta.index')
            ->with('success', 'Peserta berhasil ditambahkan! ID: '.$peserta->id_peserta);
    }

    /**
     * Display the specified peserta
     */
    public function show($id_peserta)
    {
        $peserta = Peserta::where('id_peserta', $id_peserta)
            ->with(['absensi', 'eSertifikat'])
            ->firstOrFail();

        // Log view activity
        activity('peserta')
            ->causedBy(Auth::guard('admin')->user())
            ->performedOn($peserta)
            ->withProperties([
                'ip_address' => request()->ip(),
                'action' => 'view',
            ])
            ->log("Admin melihat detail peserta: {$peserta->nama_lengkap}");

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
            'email' => 'required|email|unique:peserta,email,'.$peserta->id_peserta.',id_peserta|max:255',
            'no_hp' => ['required', 'string', 'regex:/^(\+62|62|0)[0-9]{9,12}$/', 'max:20'],
            'asal_instansi' => 'required|string|min:3|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Simpan data lama untuk log
        $oldData = $peserta->only(['nama_lengkap', 'email', 'no_hp', 'asal_instansi']);

        $peserta->update($request->all());

        // Log manual dengan detail perubahan
        activity('peserta')
            ->causedBy(Auth::guard('admin')->user())
            ->performedOn($peserta)
            ->withProperties([
                'old' => $oldData,
                'attributes' => $peserta->only(['nama_lengkap', 'email', 'no_hp', 'asal_instansi']),
                'ip_address' => $request->ip(),
            ])
            ->log("Admin memperbarui data peserta: {$peserta->nama_lengkap}");

        return redirect()->route('admin.peserta.index')
            ->with('success', 'Data peserta berhasil diupdate');
    }

    /**
     * Remove the specified peserta (soft delete)
     */
    public function destroy($id_peserta)
    {
        $peserta = Peserta::where('id_peserta', $id_peserta)->firstOrFail();

        // Simpan data untuk log
        $pesertaData = $peserta->only(['id_peserta', 'nama_lengkap', 'email']);

        $peserta->delete();

        // Log manual untuk soft delete
        activity('peserta')
            ->causedBy(Auth::guard('admin')->user())
            ->withProperties([
                'peserta_data' => $pesertaData,
                'ip_address' => request()->ip(),
            ])
            ->log("Admin menghapus peserta: {$pesertaData['nama_lengkap']} (ID: {$pesertaData['id_peserta']})");

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
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('tgl_registrasi', '>=', $request->start_date)
                ->whereDate('tgl_registrasi', '<=', $request->end_date);
        }

        $peserta = $query->orderBy('tgl_registrasi', 'desc')->get();

        // Log export activity
        activity('peserta')
            ->causedBy(Auth::guard('admin')->user())
            ->withProperties([
                'total_exported' => $peserta->count(),
                'filters' => $request->only(['search', 'start_date', 'end_date']),
                'ip_address' => $request->ip(),
            ])
            ->log("Admin mengekspor data peserta ke Excel ({$peserta->count()} data)");

        // Generate CSV
        $filename = 'peserta_'.date('Y-m-d_His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        $callback = function () use ($peserta) {
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
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('tgl_registrasi', '>=', $request->start_date)
                ->whereDate('tgl_registrasi', '<=', $request->end_date);
        }

        $peserta = $query->orderBy('tgl_registrasi', 'desc')->get();

        // Log export activity
        activity('peserta')
            ->causedBy(Auth::guard('admin')->user())
            ->withProperties([
                'total_exported' => $peserta->count(),
                'filters' => $request->only(['search', 'start_date', 'end_date']),
                'ip_address' => $request->ip(),
            ])
            ->log("Admin mengekspor data peserta ke PDF ({$peserta->count()} data)");

        // Generate HTML for PDF
        $html = view('admin.peserta.pdf', compact('peserta'))->render();

        // For now, return HTML (you can integrate with DOMPDF or similar)
        return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'inline; filename="peserta_'.date('Y-m-d_His').'.html"');
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

        // Ambil data peserta yang akan dihapus untuk log
        $pesertaList = Peserta::whereIn('id_peserta', $request->ids)
            ->get(['id_peserta', 'nama_lengkap', 'email']);

        $count = $pesertaList->count();

        Peserta::whereIn('id_peserta', $request->ids)->delete();

        // Log bulk delete
        activity('peserta')
            ->causedBy(Auth::guard('admin')->user())
            ->withProperties([
                'deleted_count' => $count,
                'deleted_peserta' => $pesertaList->toArray(),
                'ip_address' => $request->ip(),
            ])
            ->log("Admin menghapus {$count} peserta secara bulk");

        return response()->json([
            'success' => true,
            'message' => $count.' peserta berhasil dihapus',
        ]);
    }
}
