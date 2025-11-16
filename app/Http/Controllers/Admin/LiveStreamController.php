<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\LiveStream;
use Illuminate\Http\Request;

class LiveStreamController extends Controller
{
    /**
     * Display a listing of live streams
     */
    public function index(Request $request)
    {
        $query = LiveStream::with('event');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('stream_url', 'like', "%{$search}%")
                    ->orWhereHas('event', function ($q2) use ($search) {
                        $q2->where('judul', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by event
        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        // Filter by platform
        if ($request->filled('platform')) {
            $query->where('platform', $request->platform);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'jadwal_tayang');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $streams = $query->paginate(20)->withQueryString();

        // Get events for filter
        $events = Event::orderBy('tanggal_mulai', 'desc')->get();

        // Statistics
        $stats = [
            'total' => LiveStream::count(),
            'live' => LiveStream::where('status', 'live')->count(),
            'scheduled' => LiveStream::where('status', 'scheduled')->count(),
            'ended' => LiveStream::where('status', 'ended')->count(),
            'total_viewers' => LiveStream::sum('viewer_count'),
        ];

        return view('admin.live-streams.index', compact('streams', 'events', 'stats'));
    }

    /**
     * Show the form for creating a new live stream
     */
    public function create()
    {
        $events = Event::orderBy('tanggal_mulai', 'desc')->get();

        return view('admin.live-streams.create', compact('events'));
    }

    /**
     * Store a newly created live stream
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'nullable|exists:events,id',
            'judul' => 'required|string|max:255',
            'platform' => 'required|in:youtube,facebook,instagram,zoom,other',
            'stream_url' => 'required|url',
            'embed_code' => 'nullable|string',
            'jadwal_tayang' => 'required|date',
            'status' => 'required|in:scheduled,live,ended',
            'viewer_count' => 'nullable|integer|min:0',
        ], [
            'judul.required' => 'Judul live stream wajib diisi',
            'platform.required' => 'Platform wajib dipilih',
            'platform.in' => 'Platform tidak valid',
            'stream_url.required' => 'URL stream wajib diisi',
            'stream_url.url' => 'URL stream tidak valid',
            'jadwal_tayang.required' => 'Jadwal tayang wajib diisi',
            'jadwal_tayang.date' => 'Format jadwal tayang tidak valid',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid',
            'viewer_count.integer' => 'Jumlah viewer harus berupa angka',
            'viewer_count.min' => 'Jumlah viewer minimal 0',
        ]);

        // Default viewer count
        $validated['viewer_count'] = $validated['viewer_count'] ?? 0;

        LiveStream::create($validated);

        return redirect()->route('admin.live-streams.index')
            ->with('success', 'Live stream berhasil ditambahkan');
    }

    /**
     * Display the specified live stream
     */
    public function show(LiveStream $liveStream)
    {
        $liveStream->load('event');

        return view('admin.live-streams.show', compact('liveStream'));
    }

    /**
     * Show the form for editing the specified live stream
     */
    public function edit(LiveStream $liveStream)
    {
        $events = Event::orderBy('tanggal_mulai', 'desc')->get();

        return view('admin.live-streams.edit', compact('liveStream', 'events'));
    }

    /**
     * Update the specified live stream
     */
    public function update(Request $request, LiveStream $liveStream)
    {
        $validated = $request->validate([
            'event_id' => 'nullable|exists:events,id',
            'judul' => 'required|string|max:255',
            'platform' => 'required|in:youtube,facebook,instagram,zoom,other',
            'stream_url' => 'required|url',
            'embed_code' => 'nullable|string',
            'jadwal_tayang' => 'required|date',
            'status' => 'required|in:scheduled,live,ended',
            'viewer_count' => 'nullable|integer|min:0',
        ]);

        $liveStream->update($validated);

        return redirect()->route('admin.live-streams.index')
            ->with('success', 'Live stream berhasil diupdate');
    }

    /**
     * Remove the specified live stream
     */
    public function destroy(LiveStream $liveStream)
    {
        $liveStream->delete();

        return redirect()->route('admin.live-streams.index')
            ->with('success', 'Live stream berhasil dihapus');
    }

    /**
     * Update status
     */
    public function updateStatus(LiveStream $liveStream, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:scheduled,live,ended',
        ]);

        $liveStream->update($validated);

        return redirect()->route('admin.live-streams.index')
            ->with('success', 'Status live stream berhasil diupdate');
    }

    /**
     * Generate embed code from URL
     */
    public function generateEmbed(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string',
            'url' => 'required|url',
        ]);

        $embedCode = null;
        $platform = $validated['platform'];
        $url = $validated['url'];

        // YouTube
        if ($platform === 'youtube' && preg_match('/youtube\.com\/watch\?v=([^&]+)/', $url, $matches)) {
            $videoId = $matches[1];
            $embedCode = "<iframe width='100%' height='500' src='https://www.youtube.com/embed/{$videoId}' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
        }
        // YouTube Short URL
        elseif ($platform === 'youtube' && preg_match('/youtu\.be\/([^?]+)/', $url, $matches)) {
            $videoId = $matches[1];
            $embedCode = "<iframe width='100%' height='500' src='https://www.youtube.com/embed/{$videoId}' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
        }
        // Facebook
        elseif ($platform === 'facebook') {
            $embedCode = "<iframe src='https://www.facebook.com/plugins/video.php?href=".urlencode($url)."&width=500&show_text=false&height=500&appId' width='100%' height='500' style='border:none;overflow:hidden' scrolling='no' frameborder='0' allowfullscreen='true' allow='autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share'></iframe>";
        }
        // Instagram
        elseif ($platform === 'instagram') {
            $embedCode = "<iframe src='{$url}/embed' width='100%' height='500' frameborder='0' scrolling='no' allowtransparency='true'></iframe>";
        }

        return response()->json([
            'success' => $embedCode !== null,
            'embed_code' => $embedCode,
            'message' => $embedCode ? 'Embed code berhasil di-generate' : 'Gagal generate embed code. Gunakan custom embed code.',
        ]);
    }

    /**
     * Duplicate live stream
     */
    public function duplicate(LiveStream $liveStream)
    {
        $newStream = $liveStream->replicate();
        $newStream->judul = $liveStream->judul.' (Copy)';
        $newStream->status = 'scheduled';
        $newStream->viewer_count = 0;
        $newStream->save();

        return redirect()->route('admin.live-streams.edit', $newStream)
            ->with('success', 'Live stream berhasil diduplikasi');
    }
}
