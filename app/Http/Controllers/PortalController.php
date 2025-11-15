<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Faq;
use App\Models\Feedback;
use App\Models\Gallery;
use App\Models\LiveStream;
use App\Models\Peserta;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    // Portal Homepage
    public function index()
    {
        $featuredEvents = Event::published()
            ->featured()
            ->orderBy('tanggal_mulai')
            ->take(3)
            ->get();

        $upcomingEvents = Event::published()
            ->upcoming()
            ->orderBy('tanggal_mulai')
            ->take(6)
            ->get();

        $featuredTestimonials = Feedback::published()
            ->featured()
            ->with('peserta', 'event')
            ->latest()
            ->take(3)
            ->get();

        $liveStream = LiveStream::live()->first();

        $stats = [
            'total_peserta' => Peserta::count(),
            'total_events' => Event::published()->count(),
            'total_feedback' => Feedback::published()->count(),
        ];

        return view('portal.index', compact(
            'featuredEvents',
            'upcomingEvents',
            'featuredTestimonials',
            'liveStream',
            'stats'
        ));
    }

    // Events Listing
    public function events(Request $request)
    {
        $query = Event::published()->with('schedules');

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%'.$request->search.'%')
                    ->orWhere('deskripsi', 'like', '%'.$request->search.'%');
            });
        }

        $events = $query->orderBy('tanggal_mulai')->paginate(12);

        $kategoris = Event::published()
            ->select('kategori')
            ->distinct()
            ->pluck('kategori');

        return view('portal.events.index', compact('events', 'kategoris'));
    }

    // Event Detail
    public function eventDetail($slug)
    {
        $event = Event::where('slug', $slug)
            ->where('status', 'published')
            ->with(['schedules', 'feedbacks' => function ($q) {
                $q->published()->latest()->take(5);
            }])
            ->firstOrFail();

        $relatedEvents = Event::published()
            ->where('kategori', $event->kategori)
            ->where('id', '!=', $event->id)
            ->take(3)
            ->get();

        return view('portal.events.detail', compact('event', 'relatedEvents'));
    }

    // Register for Event
    public function registerEvent(Request $request, $id)
    {
        $request->validate([
            'id_peserta' => 'required|exists:peserta,id_peserta',
        ]);

        $event = Event::findOrFail($id);

        $exists = EventRegistration::where('id_peserta', $request->id_peserta)
            ->where('event_id', $id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah terdaftar untuk event ini!',
            ], 422);
        }

        if ($event->is_full) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, event sudah penuh!',
            ], 422);
        }

        EventRegistration::create([
            'id_peserta' => $request->id_peserta,
            'event_id' => $id,
            'status' => 'confirmed',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran berhasil!',
        ]);
    }

    // Live Streaming
    public function liveStreaming()
    {
        $liveStreams = LiveStream::with('event')
            ->whereIn('status', ['live', 'scheduled'])
            ->orderByRaw("FIELD(status, 'live', 'scheduled')")
            ->orderBy('jadwal_tayang')
            ->get();

        return view('portal.live', compact('liveStreams'));
    }

    // Gallery
    public function gallery(Request $request)
    {
        $query = Gallery::with('event')->ordered();

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $galleries = $query->paginate(12);

        $kategoris = Gallery::select('kategori')
            ->distinct()
            ->whereNotNull('kategori')
            ->pluck('kategori');

        return view('portal.gallery', compact('galleries', 'kategoris'));
    }

    // Feedback Form
    public function feedbackForm()
    {
        $events = Event::published()
            ->orderBy('tanggal_mulai', 'desc')
            ->get();

        return view('portal.feedback', compact('events'));
    }

    // Submit Feedback
    public function submitFeedback(Request $request)
    {
        $request->validate([
            'id_peserta' => 'required|exists:peserta,id_peserta',
            'event_id' => 'nullable|exists:events,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|min:10',
        ]);

        Feedback::create([
            'id_peserta' => $request->id_peserta,
            'event_id' => $request->event_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
            'is_published' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih atas feedback Anda!',
        ]);
    }

    // FAQ Page
    public function faq(Request $request)
    {
        $query = Faq::published()->ordered();

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('pertanyaan', 'like', '%'.$request->search.'%')
                    ->orWhere('jawaban', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $faqs = $query->get()->groupBy('kategori');

        $kategoris = Faq::published()
            ->select('kategori')
            ->distinct()
            ->whereNotNull('kategori')
            ->pluck('kategori');

        return view('portal.faq', compact('faqs', 'kategoris'));
    }
}
