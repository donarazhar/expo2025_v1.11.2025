<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PrizeController extends Controller
{
    /**
     * Display a listing of prizes
     */
    public function index(Request $request)
    {
        $query = Prize::with('event');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_hadiah', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Filter by event
        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by stock status
        if ($request->filled('stock_status')) {
            switch ($request->stock_status) {
                case 'available':
                    $query->where('sisa', '>', 0);
                    break;
                case 'low':
                    $query->whereRaw('sisa <= (jumlah * 0.2)')->where('sisa', '>', 0);
                    break;
                case 'empty':
                    $query->where('sisa', 0);
                    break;
            }
        }

        $prizes = $query->ordered()->paginate(20)->withQueryString();
        $events = Event::orderBy('tanggal_mulai', 'desc')->get();

        // Statistics
        $stats = [
            'total' => Prize::count(),
            'total_stock' => Prize::sum('jumlah'),
            'remaining_stock' => Prize::sum('sisa'),
            'used_stock' => Prize::sum('jumlah') - Prize::sum('sisa'),
            'by_kategori' => [
                'utama' => Prize::where('kategori', 'utama')->count(),
                'doorprize' => Prize::where('kategori', 'doorprize')->count(),
                'hiburan' => Prize::where('kategori', 'hiburan')->count(),
            ],
        ];

        return view('admin.prizes.index', compact('prizes', 'events', 'stats'));
    }

    /**
     * Show the form for creating a new prize
     */
    public function create()
    {
        $events = Event::orderBy('tanggal_mulai', 'desc')->get();
        $nextUrutan = Prize::max('urutan') + 1;

        return view('admin.prizes.create', compact('events', 'nextUrutan'));
    }

    /**
     * Store a newly created prize
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'nullable|exists:events,id',
            'nama_hadiah' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'jumlah' => 'required|integer|min:1',
            'urutan' => 'required|integer|min:0',
            'kategori' => 'required|in:utama,doorprize,hiburan',
        ], [
            'nama_hadiah.required' => 'Nama hadiah wajib diisi',
            'jumlah.required' => 'Jumlah stok wajib diisi',
            'jumlah.min' => 'Jumlah stok minimal 1',
            'urutan.required' => 'Urutan tampil wajib diisi',
            'kategori.required' => 'Kategori hadiah wajib dipilih',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Set sisa sama dengan jumlah
        $validated['sisa'] = $validated['jumlah'];

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filename = time().'_'.Str::slug($validated['nama_hadiah']).'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('prizes', $filename, 'public');
            $validated['gambar'] = $path;
        }

        // Create prize (otomatis ter-log karena trait LogsActivity)
        $prize = Prize::create($validated);

        // Custom log jika terkait event
        if ($prize->event_id) {
            activity('prizes')
                ->performedOn($prize)
                ->causedBy(auth()->guard('admin')->user())
                ->withProperties([
                    'action' => 'created_with_event',
                    'event_id' => $prize->event_id,
                    'event_name' => $prize->event->judul ?? 'Unknown',
                ])
                ->log(auth()->guard('admin')->user()->name." membuat hadiah '{$prize->nama_hadiah}' untuk event '{$prize->event->judul}'");
        }

        return redirect()->route('admin.prizes.index')
            ->with('success', 'Hadiah "'.$prize->nama_hadiah.'" berhasil ditambahkan');
    }

    /**
     * Display the specified prize
     */
    public function show(Prize $prize)
    {
        $prize->load(['event', 'winners.peserta']);

        $stats = [
            'total_winners' => $prize->winners()->count(),
            'stock_percentage' => $prize->persentase_stok,
            'stock_status' => $prize->stok_status,
        ];

        return view('admin.prizes.show', compact('prize', 'stats'));
    }

    /**
     * Show the form for editing the specified prize
     */
    public function edit(Prize $prize)
    {
        $events = Event::orderBy('tanggal_mulai', 'desc')->get();

        return view('admin.prizes.edit', compact('prize', 'events'));
    }

    /**
     * Update the specified prize
     */
    public function update(Request $request, Prize $prize)
    {
        $validated = $request->validate([
            'event_id' => 'nullable|exists:events,id',
            'nama_hadiah' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'jumlah' => 'required|integer|min:1',
            'urutan' => 'required|integer|min:0',
            'kategori' => 'required|in:utama,doorprize,hiburan',
        ], [
            'nama_hadiah.required' => 'Nama hadiah wajib diisi',
            'jumlah.required' => 'Jumlah stok wajib diisi',
            'jumlah.min' => 'Jumlah stok minimal 1',
            'urutan.required' => 'Urutan tampil wajib diisi',
            'kategori.required' => 'Kategori hadiah wajib dipilih',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Cek perubahan jumlah untuk custom log
        $oldJumlah = $prize->jumlah;
        $oldSisa = $prize->sisa;

        // Adjust sisa if jumlah changed
        $difference = $validated['jumlah'] - $prize->jumlah;
        $validated['sisa'] = max(0, $prize->sisa + $difference);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($prize->gambar) {
                Storage::disk('public')->delete($prize->gambar);
            }

            $image = $request->file('gambar');
            $filename = time().'_'.Str::slug($validated['nama_hadiah']).'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('prizes', $filename, 'public');
            $validated['gambar'] = $path;
        }

        // Update prize (otomatis ter-log)
        $prize->update($validated);

        // Custom log untuk perubahan jumlah stok
        if ($oldJumlah !== $validated['jumlah']) {
            activity('prizes')
                ->performedOn($prize)
                ->causedBy(auth()->guard('admin')->user())
                ->withProperties([
                    'action' => 'update_stock',
                    'old_jumlah' => $oldJumlah,
                    'new_jumlah' => $validated['jumlah'],
                    'old_sisa' => $oldSisa,
                    'new_sisa' => $validated['sisa'],
                ])
                ->log(auth()->guard('admin')->user()->name." mengubah jumlah stok hadiah '{$prize->nama_hadiah}' dari {$oldJumlah} ke {$validated['jumlah']}");
        }

        return redirect()->route('admin.prizes.index')
            ->with('success', 'Hadiah "'.$prize->nama_hadiah.'" berhasil diupdate');
    }

    /**
     * Remove the specified prize
     */
    public function destroy(Prize $prize)
    {
        // Check if prize has winners
        if ($prize->hasWinners()) {
            return redirect()->route('admin.prizes.index')
                ->with('error', 'Hadiah tidak dapat dihapus karena sudah ada pemenang');
        }

        $namaHadiah = $prize->nama_hadiah;

        // Delete image
        if ($prize->gambar) {
            Storage::disk('public')->delete($prize->gambar);
        }

        // Delete prize (otomatis ter-log)
        $prize->delete();

        return redirect()->route('admin.prizes.index')
            ->with('success', 'Hadiah "'.$namaHadiah.'" berhasil dihapus');
    }

    /**
     * Restore stock to original amount
     */
    public function restoreStock(Prize $prize)
    {
        $prize->restoreStock();

        return redirect()->route('admin.prizes.index')
            ->with('success', 'Stok hadiah "'.$prize->nama_hadiah.'" berhasil direset ke '.$prize->jumlah);
    }

    /**
     * Duplicate a prize
     */
    public function duplicate(Prize $prize)
    {
        $newPrize = $prize->replicate();
        $newPrize->nama_hadiah = $prize->nama_hadiah.' (Copy)';
        $newPrize->urutan = Prize::max('urutan') + 1;
        $newPrize->save();

        // Custom log untuk duplicate
        activity('prizes')
            ->performedOn($newPrize)
            ->causedBy(auth()->guard('admin')->user())
            ->withProperties([
                'action' => 'duplicated',
                'original_prize_id' => $prize->id,
                'original_prize_name' => $prize->nama_hadiah,
            ])
            ->log(auth()->guard('admin')->user()->name." menduplikasi hadiah '{$prize->nama_hadiah}' menjadi '{$newPrize->nama_hadiah}'");

        return redirect()->route('admin.prizes.edit', $newPrize)
            ->with('success', 'Hadiah berhasil diduplikasi. Silakan edit sesuai kebutuhan.');
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,restore_stock,change_kategori,change_event',
            'prize_ids' => 'required|array',
            'prize_ids.*' => 'exists:prizes,id',
        ]);

        $prizes = Prize::whereIn('id', $request->prize_ids)->get();

        switch ($request->action) {
            case 'delete':
                foreach ($prizes as $prize) {
                    if (! $prize->hasWinners()) {
                        if ($prize->gambar) {
                            Storage::disk('public')->delete($prize->gambar);
                        }
                        $prize->delete();
                    }
                }

                return redirect()->back()->with('success', 'Hadiah terpilih berhasil dihapus');

            case 'restore_stock':
                foreach ($prizes as $prize) {
                    $prize->restoreStock();
                }

                return redirect()->back()->with('success', 'Stok hadiah terpilih berhasil direset');

            case 'change_kategori':
                $prizes->each->update(['kategori' => $request->kategori]);

                return redirect()->back()->with('success', 'Kategori hadiah berhasil diubah');

            case 'change_event':
                $prizes->each->update(['event_id' => $request->event_id]);

                return redirect()->back()->with('success', 'Event hadiah berhasil diubah');
        }
    }
}
