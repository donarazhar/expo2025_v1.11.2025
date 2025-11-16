<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class GalleryController extends Controller
{
    protected $imageManager;

    public function __construct()
    {
        // Initialize ImageManager with GD driver
        $this->imageManager = new ImageManager(new Driver);
    }

    /**
     * Display a listing of galleries
     */
    public function index(Request $request)
    {
        $query = Gallery::with('event');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhereHas('event', function ($q2) use ($search) {
                        $q2->where('judul', 'like', "%{$search}%");
                    });
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

        // Sort
        $sortBy = $request->get('sort_by', 'urutan');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $galleries = $query->paginate(20)->withQueryString();

        // Get events and categories for filter
        $events = Event::orderBy('tanggal_mulai', 'desc')->get();
        $categories = Gallery::select('kategori')
            ->distinct()
            ->pluck('kategori')
            ->filter()
            ->sort()
            ->values();

        // Statistics
        $stats = [
            'total' => Gallery::count(),
            'events_with_gallery' => Gallery::distinct('event_id')->count('event_id'),
        ];

        return view('admin.galleries.index', compact('galleries', 'events', 'categories', 'stats'));
    }

    /**
     * Show the form for creating a new gallery
     */
    public function create()
    {
        $events = Event::orderBy('tanggal_mulai', 'desc')->get();

        // Get existing categories
        $categories = Gallery::select('kategori')
            ->distinct()
            ->pluck('kategori')
            ->filter()
            ->sort()
            ->values();

        // Get next urutan number
        $nextUrutan = Gallery::max('urutan') + 1;

        return view('admin.galleries.create', compact('events', 'categories', 'nextUrutan'));
    }

    /**
     * Store a newly created gallery
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'nullable|exists:events,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
            'urutan' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:5120', // 5MB
        ], [
            'judul.required' => 'Judul wajib diisi',
            'kategori.required' => 'Kategori wajib diisi',
            'urutan.required' => 'Urutan wajib diisi',
            'urutan.min' => 'Urutan minimal 0',
            'image.required' => 'Gambar wajib diupload',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus: jpeg, jpg, png, atau webp',
            'image.max' => 'Ukuran gambar maksimal 5MB',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'_'.Str::slug($validated['judul']).'.'.$image->getClientOriginalExtension();

            // Store original image
            $path = $image->storeAs('galleries', $filename, 'public');
            $validated['image_path'] = $path;
        }

        Gallery::create($validated);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto gallery berhasil ditambahkan');
    }

    /**
     * Display the specified gallery
     */
    public function show(Gallery $gallery)
    {
        $gallery->load('event');

        return view('admin.galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified gallery
     */
    public function edit(Gallery $gallery)
    {
        $events = Event::orderBy('tanggal_mulai', 'desc')->get();

        // Get existing categories
        $categories = Gallery::select('kategori')
            ->distinct()
            ->pluck('kategori')
            ->filter()
            ->sort()
            ->values();

        return view('admin.galleries.edit', compact('gallery', 'events', 'categories'));
    }

    /**
     * Update the specified gallery
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'event_id' => 'nullable|exists:events,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
            'urutan' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }

            $image = $request->file('image');
            $filename = time().'_'.Str::slug($validated['judul']).'.'.$image->getClientOriginalExtension();

            // Store original image
            $path = $image->storeAs('galleries', $filename, 'public');
            $validated['image_path'] = $path;
        }

        $gallery->update($validated);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto gallery berhasil diupdate');
    }

    /**
     * Remove the specified gallery
     */
    public function destroy(Gallery $gallery)
    {
        // Delete image
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto gallery berhasil dihapus');
    }

    /**
     * Reorder galleries
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:galleries,id',
            'items.*.urutan' => 'required|integer|min:0',
        ]);

        foreach ($validated['items'] as $item) {
            Gallery::where('id', $item['id'])->update(['urutan' => $item['urutan']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Urutan gallery berhasil diupdate',
        ]);
    }

    /**
     * Bulk delete
     */
    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'gallery_ids' => 'required|array',
            'gallery_ids.*' => 'exists:galleries,id',
        ]);

        $galleries = Gallery::whereIn('id', $validated['gallery_ids'])->get();

        foreach ($galleries as $gallery) {
            // Delete image
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $gallery->delete();
        }

        $count = count($validated['gallery_ids']);

        return redirect()->route('admin.galleries.index')
            ->with('success', "$count foto gallery berhasil dihapus");
    }
}
