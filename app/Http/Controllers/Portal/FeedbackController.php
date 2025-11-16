<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    /**
     * Show feedback form page
     */
    public function index()
    {

        try {
            // Try different queries to find which works

            // Method 1: Check if is_published column exists
            if (\Schema::hasColumn('events', 'is_published')) {
                $events = Event::where('is_published', true)
                    ->orderBy('tanggal_mulai', 'desc')
                    ->get();
            } else {
                // Method 2: Get all events if no is_published column
                $events = Event::orderBy('tanggal_mulai', 'desc')->get();
            }

            // Log untuk debugging
            Log::info('Events loaded for feedback form', [
                'count' => $events->count(),
                'events' => $events->pluck('id', 'judul'),
            ]);

            return view('portal.feedback', compact('events'));

        } catch (\Exception $e) {
            Log::error('Error loading feedback form', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Fallback: return empty collection
            $events = collect([]);

            return view('portal.feedback', compact('events'));
        }
    }

    /**
     * Submit feedback from public (AJAX)
     */
    public function submit(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
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

            // Convert ID to uppercase
            $idPeserta = strtoupper($request->id_peserta);

            // Check if participant already gave feedback for this event
            if ($request->event_id) {
                $existingFeedback = Feedback::where('id_peserta', $idPeserta)
                    ->where('event_id', $request->event_id)
                    ->exists();

                if ($existingFeedback) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Anda sudah memberikan feedback untuk event ini sebelumnya.',
                    ], 422);
                }
            }

            // Sanitize comment (prevent XSS)
            $komentar = strip_tags($request->komentar);
            $komentar = htmlspecialchars($komentar, ENT_QUOTES, 'UTF-8');

            // Create feedback
            $feedback = Feedback::create([
                'id_peserta' => $idPeserta,
                'event_id' => $request->event_id ?: null,
                'rating' => $request->rating,
                'komentar' => $komentar,
                'is_published' => false, // Pending moderation
                'is_featured' => false,
            ]);

            Log::info('Feedback submitted successfully', [
                'feedback_id' => $feedback->id,
                'peserta' => $idPeserta,
                'event_id' => $request->event_id,
                'rating' => $request->rating,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih atas feedback Anda! Feedback akan ditampilkan setelah dimoderasi.',
                'data' => [
                    'feedback_id' => $feedback->id,
                    'rating' => $feedback->rating,
                ],
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            Log::error('Feedback submission error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim feedback. Silakan coba lagi.',
            ], 500);
        }
    }

    /**
     * Get published feedbacks for display
     */
    public function getPublished(Request $request)
    {
        $eventId = $request->query('event_id');

        $feedbacks = Feedback::published()
            ->with(['peserta:id_peserta,nama_lengkap', 'event:id,judul'])
            ->when($eventId, function ($query, $eventId) {
                return $query->where('event_id', $eventId);
            })
            ->latest()
            ->paginate(12);

        return response()->json([
            'success' => true,
            'data' => $feedbacks,
            'stats' => [
                'average_rating' => Feedback::getAverageRating($eventId),
                'total_feedbacks' => Feedback::getTotalFeedbacks($eventId),
                'rating_distribution' => Feedback::getRatingDistribution($eventId),
            ],
        ]);
    }

    /**
     * Get featured feedbacks (for homepage)
     */
    public function getFeatured()
    {
        $feedbacks = Feedback::published()
            ->featured()
            ->with(['peserta:id_peserta,nama_lengkap', 'event:id,judul'])
            ->latest()
            ->limit(6)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $feedbacks,
        ]);
    }
}
