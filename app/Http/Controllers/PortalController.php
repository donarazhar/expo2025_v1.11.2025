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
use Illuminate\Support\Facades\Validator;

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

        // Log homepage visit
        activity('portal')
            ->withProperties([
                'action' => 'view_homepage',
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'stats' => $stats,
            ])
            ->log('Pengunjung mengakses homepage portal');

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

        $filters = [];

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
            $filters['kategori'] = $request->kategori;
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%'.$request->search.'%')
                    ->orWhere('deskripsi', 'like', '%'.$request->search.'%');
            });
            $filters['search'] = $request->search;
        }

        $events = $query->orderBy('tanggal_mulai')->paginate(12);

        $kategoris = Event::published()
            ->select('kategori')
            ->distinct()
            ->pluck('kategori');

        // Log events page view
        activity('portal')
            ->withProperties([
                'action' => 'view_events_list',
                'total_results' => $events->total(),
                'filters' => $filters,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ])
            ->log('Pengunjung melihat daftar events'.(! empty($filters) ? ' dengan filter' : ''));

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

        // Log event detail view
        activity('portal')
            ->performedOn($event)
            ->withProperties([
                'action' => 'view_event_detail',
                'event_slug' => $slug,
                'event_title' => $event->judul,
                'event_kategori' => $event->kategori,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'referer' => request()->header('referer'),
            ])
            ->log("Pengunjung melihat detail event: {$event->judul}");

        return view('portal.events.detail', compact('event', 'relatedEvents'));
    }

    // Register for Event
    public function registerEvent(Request $request, $id)
    {
        $request->validate([
            'id_peserta' => 'required|exists:peserta,id_peserta',
        ]);

        $event = Event::findOrFail($id);
        $peserta = Peserta::where('id_peserta', $request->id_peserta)->first();

        $exists = EventRegistration::where('id_peserta', $request->id_peserta)
            ->where('event_id', $id)
            ->exists();

        if ($exists) {
            // Log failed registration (already registered)
            activity('portal')
                ->performedOn($event)
                ->withProperties([
                    'action' => 'register_event_failed',
                    'reason' => 'already_registered',
                    'peserta_id' => $request->id_peserta,
                    'peserta_nama' => $peserta->nama_lengkap ?? 'Unknown',
                    'event_id' => $event->id,
                    'event_title' => $event->judul,
                    'ip_address' => request()->ip(),
                ])
                ->log("Pendaftaran event gagal (sudah terdaftar): {$peserta->nama_lengkap} - {$event->judul}");

            return response()->json([
                'success' => false,
                'message' => 'Anda sudah terdaftar untuk event ini!',
            ], 422);
        }

        if ($event->is_full) {
            // Log failed registration (event full)
            activity('portal')
                ->performedOn($event)
                ->withProperties([
                    'action' => 'register_event_failed',
                    'reason' => 'event_full',
                    'peserta_id' => $request->id_peserta,
                    'peserta_nama' => $peserta->nama_lengkap ?? 'Unknown',
                    'event_id' => $event->id,
                    'event_title' => $event->judul,
                    'ip_address' => request()->ip(),
                ])
                ->log("Pendaftaran event gagal (penuh): {$peserta->nama_lengkap} - {$event->judul}");

            return response()->json([
                'success' => false,
                'message' => 'Maaf, event sudah penuh!',
            ], 422);
        }

        $registration = EventRegistration::create([
            'id_peserta' => $request->id_peserta,
            'event_id' => $id,
            'status' => 'confirmed',
        ]);

        // Log successful registration
        activity('portal')
            ->performedOn($event)
            ->withProperties([
                'action' => 'register_event_success',
                'registration_id' => $registration->id,
                'peserta_id' => $request->id_peserta,
                'peserta_nama' => $peserta->nama_lengkap ?? 'Unknown',
                'peserta_email' => $peserta->email ?? null,
                'event_id' => $event->id,
                'event_title' => $event->judul,
                'event_tanggal' => $event->tanggal_mulai->format('Y-m-d'),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ])
            ->log("Peserta berhasil mendaftar event: {$peserta->nama_lengkap} - {$event->judul}");

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

        // Log live streaming page view
        activity('portal')
            ->withProperties([
                'action' => 'view_live_streaming',
                'total_streams' => $liveStreams->count(),
                'live_streams' => $liveStreams->where('status', 'live')->count(),
                'scheduled_streams' => $liveStreams->where('status', 'scheduled')->count(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ])
            ->log('Pengunjung mengakses halaman live streaming');

        return view('portal.live', compact('liveStreams'));
    }

    // Gallery
    public function gallery(Request $request)
    {
        $query = Gallery::with('event')->ordered();

        $filters = [];

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
            $filters['kategori'] = $request->kategori;
        }

        $galleries = $query->paginate(12);

        $kategoris = Gallery::select('kategori')
            ->distinct()
            ->whereNotNull('kategori')
            ->pluck('kategori');

        // Log gallery page view
        activity('portal')
            ->withProperties([
                'action' => 'view_gallery',
                'total_items' => $galleries->total(),
                'filters' => $filters,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ])
            ->log('Pengunjung melihat gallery'.(! empty($filters) ? ' dengan filter' : ''));

        return view('portal.gallery', compact('galleries', 'kategoris'));
    }

    // Feedback Form
    public function feedbackForm()
    {
        $events = Event::published()
            ->orderBy('tanggal_mulai', 'desc')
            ->get();

        // Log feedback form view
        activity('portal')
            ->withProperties([
                'action' => 'view_feedback_form',
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ])
            ->log('Pengunjung mengakses form feedback');

        return view('portal.feedback', compact('events'));
    }

    // Submit Feedback
    public function submitFeedback(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_peserta' => [
                    'required',
                    'string',
                    'size:4',
                    'exists:peserta,id_peserta',
                ],
                'event_id' => 'nullable|exists:events,id',
                'rating' => 'required|integer|min:1|max:5',
                'komentar' => 'required|string|min:10|max:1000',
            ], [
                'id_peserta.required' => 'ID Peserta wajib diisi',
                'id_peserta.size' => 'ID Peserta harus 4 karakter',
                'id_peserta.exists' => 'ID Peserta tidak ditemukan. Pastikan Anda sudah terdaftar.',
                'event_id.exists' => 'Event tidak ditemukan',
                'rating.required' => 'Rating wajib diisi',
                'rating.min' => 'Rating minimal 1',
                'rating.max' => 'Rating maksimal 5',
                'komentar.required' => 'Komentar wajib diisi',
                'komentar.min' => 'Komentar minimal 10 karakter',
                'komentar.max' => 'Komentar maksimal 1000 karakter',
            ]);

            if ($validator->fails()) {
                // Log validation failed
                activity('portal')
                    ->withProperties([
                        'action' => 'submit_feedback_failed',
                        'reason' => 'validation_error',
                        'errors' => $validator->errors()->toArray(),
                        'ip_address' => request()->ip(),
                    ])
                    ->log('Pengunjung gagal submit feedback (validasi gagal)');

                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $peserta = Peserta::where('id_peserta', $request->id_peserta)->first();
            $event = $request->event_id ? Event::find($request->event_id) : null;

            // Cek apakah peserta sudah memberikan feedback untuk event yang sama
            if ($request->event_id) {
                $existingFeedback = Feedback::where('id_peserta', $request->id_peserta)
                    ->where('event_id', $request->event_id)
                    ->exists();

                if ($existingFeedback) {
                    // Log duplicate feedback attempt
                    activity('portal')
                        ->withProperties([
                            'action' => 'submit_feedback_failed',
                            'reason' => 'duplicate_feedback',
                            'peserta_id' => $request->id_peserta,
                            'peserta_nama' => $peserta->nama_lengkap ?? 'Unknown',
                            'event_id' => $request->event_id,
                            'event_title' => $event->judul ?? 'Unknown',
                            'ip_address' => request()->ip(),
                        ])
                        ->log("Peserta mencoba submit feedback duplikat: {$peserta->nama_lengkap}");

                    return response()->json([
                        'success' => false,
                        'message' => 'Anda sudah memberikan feedback untuk event ini sebelumnya.',
                    ], 422);
                }
            }

            // Sanitize komentar
            $komentar = strip_tags($request->komentar);
            $komentar = htmlspecialchars($komentar, ENT_QUOTES, 'UTF-8');

            // Create feedback
            $feedback = Feedback::create([
                'id_peserta' => strtoupper($request->id_peserta),
                'event_id' => $request->event_id ?: null,
                'rating' => $request->rating,
                'komentar' => $komentar,
                'is_published' => false, // Default pending moderation
                'is_featured' => false,
            ]);

            // Log successful feedback submission
            activity('portal')
                ->performedOn($feedback)
                ->withProperties([
                    'action' => 'submit_feedback_success',
                    'feedback_id' => $feedback->id,
                    'peserta_id' => $request->id_peserta,
                    'peserta_nama' => $peserta->nama_lengkap ?? 'Unknown',
                    'peserta_email' => $peserta->email ?? null,
                    'event_id' => $request->event_id,
                    'event_title' => $event->judul ?? null,
                    'rating' => $request->rating,
                    'komentar_length' => strlen($komentar),
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ])
                ->log("Peserta berhasil submit feedback: {$peserta->nama_lengkap} - Rating {$request->rating}/5");

            // Optional: Send notification to admin
            // event(new FeedbackSubmitted($feedback));

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih atas feedback Anda! Feedback akan ditampilkan setelah dimoderasi.',
                'data' => [
                    'feedback_id' => $feedback->id,
                    'rating' => $feedback->rating,
                ],
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Feedback submission error: '.$e->getMessage());

            // Log exception
            activity('portal')
                ->withProperties([
                    'action' => 'submit_feedback_error',
                    'error_message' => $e->getMessage(),
                    'error_trace' => $e->getTraceAsString(),
                    'request_data' => $request->except(['_token']),
                    'ip_address' => request()->ip(),
                ])
                ->log('Error saat submit feedback: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim feedback. Silakan coba lagi.',
            ], 500);
        }
    }

    // FAQ Page
    public function faq(Request $request)
    {
        $query = Faq::published()->ordered();

        $filters = [];

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('pertanyaan', 'like', '%'.$request->search.'%')
                    ->orWhere('jawaban', 'like', '%'.$request->search.'%');
            });
            $filters['search'] = $request->search;
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
            $filters['kategori'] = $request->kategori;
        }

        $faqs = $query->get()->groupBy('kategori');

        $kategoris = Faq::published()
            ->select('kategori')
            ->distinct()
            ->whereNotNull('kategori')
            ->pluck('kategori');

        // Log FAQ page view
        activity('portal')
            ->withProperties([
                'action' => 'view_faq',
                'total_faqs' => $faqs->flatten()->count(),
                'total_categories' => $faqs->count(),
                'filters' => $filters,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ])
            ->log('Pengunjung mengakses halaman FAQ'.(! empty($filters) ? ' dengan filter' : ''));

        return view('portal.faq', compact('faqs', 'kategoris'));
    }
}
