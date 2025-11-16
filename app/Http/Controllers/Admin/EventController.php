<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of events
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'tanggal_mulai');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $events = $query->paginate(15)->withQueryString();

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created event
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:0',
            'status' => 'required|in:draft,published,cancelled',
            'kategori' => 'required|string|max:100',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_featured' => 'boolean',
        ], [
            'judul.required' => 'Judul event wajib diisi',
            'deskripsi.required' => 'Deskripsi event wajib diisi',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai',
            'lokasi.required' => 'Lokasi wajib diisi',
            'kapasitas.required' => 'Kapasitas wajib diisi',
            'kapasitas.min' => 'Kapasitas minimal 0 (untuk unlimited)',
            'banner_image.image' => 'File harus berupa gambar',
            'banner_image.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Auto-generate slug
        $validated['slug'] = Str::slug($validated['judul']);

        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Event::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug.'-'.$counter;
            $counter++;
        }

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')
                ->store('events/banners', 'public');
        }

        // Handle is_featured checkbox
        $validated['is_featured'] = $request->has('is_featured');

        // Create event (otomatis ter-log karena trait LogsActivity)
        $event = Event::create($validated);

        // Custom log jika status published langsung
        if ($event->status === 'published') {
            activity('events')
                ->performedOn($event)
                ->causedBy(auth()->user())
                ->withProperties(['action' => 'published_directly'])
                ->log(auth()->user()->name." mempublikasikan event: {$event->judul}");
        }

        return redirect()->route('admin.events.show', $event)
            ->with('success', 'Event "'.$event->judul.'" berhasil dibuat');
    }

    /**
     * Display the specified event
     */
    public function show(Event $event)
    {
        $event->load(['schedules', 'registrations.peserta']);

        $stats = [
            'total_registrations' => $event->registrations()->count(),
            'confirmed' => $event->registrations()->where('status', 'confirmed')->count(),
            'pending' => $event->registrations()->where('status', 'pending')->count(),
            'cancelled' => $event->registrations()->where('status', 'cancelled')->count(),
            'available_slots' => $event->available_slots,
        ];

        return view('admin.events.show', compact('event', 'stats'));
    }

    /**
     * Show the form for editing the specified event
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified event
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:0',
            'status' => 'required|in:draft,published,cancelled',
            'kategori' => 'required|string|max:100',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_featured' => 'boolean',
        ]);

        // Cek perubahan status untuk custom log
        $oldStatus = $event->status;
        $newStatus = $validated['status'];

        // Update slug if judul changed
        if ($validated['judul'] !== $event->judul) {
            $validated['slug'] = Str::slug($validated['judul']);

            // Ensure unique slug
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (Event::where('slug', $validated['slug'])->where('id', '!=', $event->id)->exists()) {
                $validated['slug'] = $originalSlug.'-'.$counter;
                $counter++;
            }
        }

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            // Delete old image
            if ($event->banner_image) {
                Storage::disk('public')->delete($event->banner_image);
            }

            $validated['banner_image'] = $request->file('banner_image')
                ->store('events/banners', 'public');
        }

        // Handle is_featured checkbox
        $validated['is_featured'] = $request->has('is_featured');

        // Update event (otomatis ter-log)
        $event->update($validated);

        // Custom log untuk perubahan status penting
        if ($oldStatus !== $newStatus) {
            activity('events')
                ->performedOn($event)
                ->causedBy(auth()->user())
                ->withProperties([
                    'old_status' => $oldStatus,
                    'new_status' => $newStatus,
                ])
                ->log(auth()->user()->name." mengubah status event '{$event->judul}' dari {$oldStatus} ke {$newStatus}");
        }

        return redirect()->route('admin.events.show', $event)
            ->with('success', 'Event "'.$event->judul.'" berhasil diupdate');
    }

    /**
     * Remove the specified event
     */
    public function destroy(Event $event)
    {
        $judul = $event->judul;

        // Delete banner image
        if ($event->banner_image) {
            Storage::disk('public')->delete($event->banner_image);
        }

        // Delete event (otomatis ter-log)
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event "'.$judul.'" berhasil dihapus');
    }

    /**
     * Duplicate an event
     */
    public function duplicate(Event $event)
    {
        $newEvent = $event->replicate();
        $newEvent->judul = $event->judul.' (Copy)';
        $newEvent->slug = Str::slug($newEvent->judul.'-'.time());
        $newEvent->status = 'draft';
        $newEvent->save();

        // Duplicate schedules
        foreach ($event->schedules as $schedule) {
            $newSchedule = $schedule->replicate();
            $newSchedule->event_id = $newEvent->id;
            $newSchedule->save();
        }

        // Custom log untuk duplicate
        activity('events')
            ->performedOn($newEvent)
            ->causedBy(auth()->user())
            ->withProperties([
                'original_event_id' => $event->id,
                'original_event_judul' => $event->judul,
            ])
            ->log(auth()->user()->name." menduplikasi event '{$event->judul}' menjadi '{$newEvent->judul}'");

        return redirect()->route('admin.events.edit', $newEvent)
            ->with('success', 'Event berhasil diduplikasi. Silakan edit sesuai kebutuhan.');
    }
}
