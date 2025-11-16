<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Event;
use App\Models\Absensi;
use App\Models\Peserta;
use App\Models\Feedback;
use App\Models\Gallery;
use App\Models\LiveStream;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // Validate input
        try {
            $request->validate([
                'id_peserta' => 'required|exists:peserta,id_peserta',
            ]);
        } catch (\Exception $e) {
            \Log::error('Validation failed', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'ID Peserta tidak valid!',
            ], 422);
        }

        try {
            DB::beginTransaction();

            \Log::info('=== START PORTAL EVENT REGISTRATION ===', [
                'id_peserta' => $request->id_peserta,
                'event_id' => $id,
                'ip' => request()->ip(),
            ]);

            // Get event
            $event = Event::findOrFail($id);
            \Log::info('Event found', ['event_id' => $event->id, 'title' => $event->judul]);

            // Get peserta
            $peserta = Peserta::where('id_peserta', $request->id_peserta)->first();

            if (! $peserta) {
                \Log::error('Peserta not found', ['id_peserta' => $request->id_peserta]);

                return response()->json([
                    'success' => false,
                    'message' => 'Data peserta tidak ditemukan!',
                ], 404);
            }

            \Log::info('Peserta found', [
                'id_peserta' => $peserta->id_peserta,
                'nama' => $peserta->nama_lengkap,
                'qr_token' => $peserta->qr_code_token ?? 'NULL',
            ]);

            // Check if peserta has qr_code_token
            if (empty($peserta->qr_code_token)) {
                \Log::error('Peserta does not have qr_code_token', [
                    'id_peserta' => $peserta->id_peserta,
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Data QR Code peserta tidak valid. Silakan hubungi panitia.',
                ], 422);
            }

            // ========================================
            // 1. CHECK EVENT REGISTRATION (Per Event)
            // ========================================
            $existingRegistration = EventRegistration::where('id_peserta', $request->id_peserta)
                ->where('event_id', $id)
                ->first();

            if ($existingRegistration) {
                \Log::warning('Already registered for this event');

                try {
                    activity('portal')
                        ->performedOn($event)
                        ->withProperties([
                            'action' => 'register_event_failed',
                            'reason' => 'already_registered',
                            'peserta_id' => $request->id_peserta,
                            'peserta_nama' => $peserta->nama_lengkap,
                            'event_id' => $event->id,
                            'event_title' => $event->judul,
                            'ip_address' => request()->ip(),
                        ])
                        ->log("Pendaftaran event gagal (sudah terdaftar): {$peserta->nama_lengkap} - {$event->judul}");
                } catch (\Exception $e) {
                    \Log::error('Activity log failed', ['error' => $e->getMessage()]);
                }

                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah terdaftar untuk event ini!',
                    'data' => [
                        'registered_at' => $existingRegistration->created_at->format('d M Y H:i'),
                    ],
                ], 422);
            }

            // Check if event is full
            if ($event->is_full) {
                \Log::warning('Event is full');

                try {
                    activity('portal')
                        ->performedOn($event)
                        ->withProperties([
                            'action' => 'register_event_failed',
                            'reason' => 'event_full',
                            'peserta_id' => $request->id_peserta,
                            'peserta_nama' => $peserta->nama_lengkap,
                            'event_id' => $event->id,
                            'event_title' => $event->judul,
                            'ip_address' => request()->ip(),
                        ])
                        ->log("Pendaftaran event gagal (penuh): {$peserta->nama_lengkap} - {$event->judul}");
                } catch (\Exception $e) {
                    \Log::error('Activity log failed', ['error' => $e->getMessage()]);
                }

                return response()->json([
                    'success' => false,
                    'message' => 'Maaf, event sudah penuh!',
                ], 422);
            }

            // ========================================
            // 2. CREATE EVENT REGISTRATION (Can be multiple per peserta)
            // ========================================
            \Log::info('Creating event registration...');

            $registration = EventRegistration::create([
                'id_peserta' => $request->id_peserta,
                'event_id' => $id,
                'status' => 'confirmed',
            ]);

            \Log::info('✓ Event registration created', [
                'registration_id' => $registration->id,
                'status' => $registration->status,
            ]);

            // ========================================
            // 3. CREATE ABSENSI (Only once per peserta)
            // ========================================
            $absensiCreated = false;
            $absensi = null;

            \Log::info('Checking if absensi exists...');
            $existingAbsensi = Absensi::where('qr_code_token', $peserta->qr_code_token)->first();

            if ($existingAbsensi) {
                \Log::info('Absensi already exists, skipping creation', [
                    'absensi_id' => $existingAbsensi->id,
                    'created_at' => $existingAbsensi->created_at,
                ]);
                $absensi = $existingAbsensi;
            } else {
                try {
                    \Log::info('Creating first-time absensi record...');

                    $absensiData = [
                        'qr_code_token' => $peserta->qr_code_token,
                        'waktu_scan' => now(),
                        'petugas_scanner' => 'Portal Registration',
                        'status_kehadiran' => true,
                        'keterangan' => 'First registration via portal for event: '.$event->judul,
                    ];

                    \Log::info('Absensi data prepared:', $absensiData);

                    $absensi = Absensi::create($absensiData);
                    $absensiCreated = true;

                    \Log::info('✓ Absensi created successfully!', [
                        'absensi_id' => $absensi->id,
                        'id_peserta' => $peserta->id_peserta,
                        'nama' => $peserta->nama_lengkap,
                    ]);

                } catch (\Exception $e) {
                    \Log::error('✗ Failed to create absensi', [
                        'error' => $e->getMessage(),
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                    ]);
                    // Don't fail the whole registration if only absensi fails
                }
            }

            // ========================================
            // 4. LOG ACTIVITY
            // ========================================
            try {
                activity('portal')
                    ->performedOn($event)
                    ->withProperties([
                        'action' => 'register_event_success',
                        'registration_id' => $registration->id,
                        'absensi_id' => $absensi->id ?? null,
                        'absensi_created' => $absensiCreated,
                        'peserta_id' => $request->id_peserta,
                        'peserta_nama' => $peserta->nama_lengkap,
                        'peserta_email' => $peserta->email ?? null,
                        'peserta_instansi' => $peserta->asal_instansi ?? null,
                        'event_id' => $event->id,
                        'event_title' => $event->judul,
                        'event_tanggal' => $event->tanggal_mulai->format('Y-m-d'),
                        'ip_address' => request()->ip(),
                        'user_agent' => request()->userAgent(),
                    ])
                    ->log("Peserta berhasil mendaftar event: {$peserta->nama_lengkap} - {$event->judul}");
            } catch (\Exception $e) {
                \Log::error('Activity log failed', ['error' => $e->getMessage()]);
            }

            DB::commit();

            \Log::info('=== PORTAL REGISTRATION SUCCESS ===', [
                'registration_id' => $registration->id,
                'absensi_id' => $absensi->id ?? null,
                'absensi_created' => $absensiCreated,
            ]);

            // ========================================
            // 5. RETURN RESPONSE
            // ========================================
            $message = 'Pendaftaran berhasil!';
            if ($absensiCreated) {
                $message .= ' Absensi Anda juga telah tercatat.';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => [
                    'registration_id' => $registration->id,
                    'absensi_id' => $absensi->id ?? null,
                    'absensi_created' => $absensiCreated,
                    'peserta_nama' => $peserta->nama_lengkap,
                    'peserta_id' => $peserta->id_peserta,
                    'event_title' => $event->judul,
                    'event_date' => $event->tanggal_mulai->format('d M Y'),
                    'event_time' => $event->tanggal_mulai->format('H:i').' - '.$event->tanggal_selesai->format('H:i'),
                    'event_location' => $event->lokasi ?? null,
                    'registered_at' => $registration->created_at->format('d M Y H:i:s'),
                ],
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('=== ERROR IN PORTAL EVENT REGISTRATION ===', [
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'error_trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            // Log failed registration
            try {
                activity('portal')
                    ->withProperties([
                        'action' => 'register_event_error',
                        'error' => $e->getMessage(),
                        'peserta_id' => $request->id_peserta ?? null,
                        'event_id' => $id,
                        'ip_address' => request()->ip(),
                    ])
                    ->log('Error saat pendaftaran event: '.$e->getMessage());
            } catch (\Exception $logError) {
                \Log::error('Activity log also failed', ['error' => $logError->getMessage()]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.',
                'debug' => config('app.debug') ? [
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ] : null,
            ], 500);
        }
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
