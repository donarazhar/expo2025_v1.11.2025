<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of feedbacks
     */
    public function index(Request $request)
    {
        $query = Feedback::with(['peserta', 'event']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('komentar', 'like', "%{$search}%")
                    ->orWhereHas('peserta', function ($q2) use ($search) {
                        $q2->where('nama_lengkap', 'like', "%{$search}%");
                    })
                    ->orWhereHas('event', function ($q2) use ($search) {
                        $q2->where('judul', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by event
        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        // Filter by rating
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status == 'published') {
                $query->where('is_published', true);
            } elseif ($request->status == 'draft') {
                $query->where('is_published', false);
            } elseif ($request->status == 'featured') {
                $query->where('is_featured', true);
            }
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $feedbacks = $query->paginate(20)->withQueryString();

        // Get events for filter
        $events = Event::orderBy('tanggal_mulai', 'desc')->get();

        // Statistics
        $stats = [
            'total' => Feedback::count(),
            'published' => Feedback::where('is_published', true)->count(),
            'pending' => Feedback::where('is_published', false)->count(),
            'featured' => Feedback::where('is_featured', true)->count(),
            'avg_rating' => round(Feedback::avg('rating'), 1),
        ];

        return view('admin.feedbacks.index', compact('feedbacks', 'events', 'stats'));
    }

    /**
     * Show the form for creating a new feedback
     */
    public function create()
    {
        $events = Event::published()->orderBy('tanggal_mulai', 'desc')->get();
        $pesertas = Peserta::orderBy('nama_lengkap')->get();

        return view('admin.feedbacks.create', compact('events', 'pesertas'));
    }

    /**
     * Store a newly created feedback
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_peserta' => 'required|exists:peserta,id_peserta',
            'event_id' => 'required|exists:events,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|min:10',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ], [
            'id_peserta.required' => 'Pilih peserta terlebih dahulu',
            'id_peserta.exists' => 'Peserta tidak ditemukan',
            'event_id.required' => 'Pilih event terlebih dahulu',
            'event_id.exists' => 'Event tidak ditemukan',
            'rating.required' => 'Rating wajib diisi',
            'rating.min' => 'Rating minimal 1 bintang',
            'rating.max' => 'Rating maksimal 5 bintang',
            'komentar.required' => 'Komentar wajib diisi',
            'komentar.min' => 'Komentar minimal 10 karakter',
        ]);

        // Handle checkboxes
        $validated['is_published'] = $request->has('is_published');
        $validated['is_featured'] = $request->has('is_featured');

        $feedback = Feedback::create($validated);

        // Manual activity log dengan detail lengkap
        activity('feedback')
            ->causedBy(Auth::guard('admin')->user())
            ->performedOn($feedback)
            ->withProperties([
                'peserta_nama' => $feedback->peserta->nama_lengkap ?? 'Unknown',
                'event_judul' => $feedback->event->judul ?? 'Unknown',
                'rating' => $feedback->rating,
                'is_published' => $feedback->is_published,
                'is_featured' => $feedback->is_featured,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ])
            ->log("Admin menambahkan feedback baru: Rating {$feedback->rating}/5 dari {$feedback->peserta->nama_lengkap}");

        return redirect()->route('admin.feedbacks.index')
            ->with('success', 'Feedback berhasil ditambahkan');
    }

    /**
     * Display the specified feedback
     */
    public function show(Feedback $feedback)
    {
        $feedback->load(['peserta', 'event']);

        // Log view activity
        activity('feedback')
            ->causedBy(Auth::guard('admin')->user())
            ->performedOn($feedback)
            ->withProperties([
                'action' => 'view',
                'feedback_id' => $feedback->id,
                'ip_address' => request()->ip(),
            ])
            ->log("Admin melihat detail feedback dari {$feedback->peserta->nama_lengkap}");

        return view('admin.feedbacks.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified feedback
     */
    public function edit(Feedback $feedback)
    {
        $events = Event::orderBy('tanggal_mulai', 'desc')->get();
        $pesertas = Peserta::orderBy('nama_lengkap')->get();

        return view('admin.feedbacks.edit', compact('feedback', 'events', 'pesertas'));
    }

    /**
     * Update the specified feedback
     */
    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'id_peserta' => 'required|exists:peserta,id_peserta',
            'event_id' => 'required|exists:events,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|min:10',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        // Simpan data lama untuk log
        $oldData = [
            'rating' => $feedback->rating,
            'komentar' => $feedback->komentar,
            'is_published' => $feedback->is_published,
            'is_featured' => $feedback->is_featured,
        ];

        // Handle checkboxes
        $validated['is_published'] = $request->has('is_published');
        $validated['is_featured'] = $request->has('is_featured');

        $feedback->update($validated);

        // Manual activity log dengan perubahan detail
        activity('feedback')
            ->causedBy(Auth::guard('admin')->user())
            ->performedOn($feedback)
            ->withProperties([
                'old' => $oldData,
                'attributes' => [
                    'rating' => $feedback->rating,
                    'komentar' => $feedback->komentar,
                    'is_published' => $feedback->is_published,
                    'is_featured' => $feedback->is_featured,
                ],
                'peserta_nama' => $feedback->peserta->nama_lengkap ?? 'Unknown',
                'event_judul' => $feedback->event->judul ?? 'Unknown',
                'ip_address' => $request->ip(),
            ])
            ->log("Admin memperbarui feedback dari {$feedback->peserta->nama_lengkap}");

        return redirect()->route('admin.feedbacks.index')
            ->with('success', 'Feedback berhasil diupdate');
    }

    /**
     * Remove the specified feedback
     */
    public function destroy(Feedback $feedback)
    {
        // Simpan data untuk log
        $feedbackData = [
            'id' => $feedback->id,
            'peserta_nama' => $feedback->peserta->nama_lengkap ?? 'Unknown',
            'event_judul' => $feedback->event->judul ?? 'Unknown',
            'rating' => $feedback->rating,
            'komentar' => $feedback->komentar,
        ];

        $feedback->delete();

        // Log delete activity
        activity('feedback')
            ->causedBy(Auth::guard('admin')->user())
            ->withProperties([
                'feedback_data' => $feedbackData,
                'ip_address' => request()->ip(),
            ])
            ->log("Admin menghapus feedback dari {$feedbackData['peserta_nama']} (Rating: {$feedbackData['rating']}/5)");

        return redirect()->route('admin.feedbacks.index')
            ->with('success', 'Feedback berhasil dihapus');
    }

    /**
     * Toggle publish status
     */
    public function togglePublish(Feedback $feedback)
    {
        $oldStatus = $feedback->is_published;
        $newStatus = ! $feedback->is_published;

        $feedback->update([
            'is_published' => $newStatus,
        ]);

        // Log toggle publish
        activity('feedback')
            ->causedBy(Auth::guard('admin')->user())
            ->performedOn($feedback)
            ->withProperties([
                'action' => 'toggle_publish',
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'peserta_nama' => $feedback->peserta->nama_lengkap ?? 'Unknown',
                'ip_address' => request()->ip(),
            ])
            ->log('Admin '.($newStatus ? 'mempublikasikan' : 'menyembunyikan')." feedback dari {$feedback->peserta->nama_lengkap}");

        return redirect()->route('admin.feedbacks.index')
            ->with('success', 'Status publikasi feedback berhasil diubah');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Feedback $feedback)
    {
        $oldStatus = $feedback->is_featured;
        $newStatus = ! $feedback->is_featured;

        $feedback->update([
            'is_featured' => $newStatus,
        ]);

        // Log toggle featured
        activity('feedback')
            ->causedBy(Auth::guard('admin')->user())
            ->performedOn($feedback)
            ->withProperties([
                'action' => 'toggle_featured',
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'peserta_nama' => $feedback->peserta->nama_lengkap ?? 'Unknown',
                'ip_address' => request()->ip(),
            ])
            ->log('Admin '.($newStatus ? 'menandai sebagai featured' : 'menghapus status featured dari')." feedback dari {$feedback->peserta->nama_lengkap}");

        return redirect()->route('admin.feedbacks.index')
            ->with('success', 'Status featured feedback berhasil diubah');
    }

    /**
     * Bulk action
     */
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:publish,unpublish,feature,unfeature,delete',
            'feedback_ids' => 'required|array',
            'feedback_ids.*' => 'exists:feedbacks,id',
        ]);

        $count = 0;
        $feedbackList = Feedback::with(['peserta', 'event'])
            ->whereIn('id', $validated['feedback_ids'])
            ->get();

        switch ($validated['action']) {
            case 'publish':
                $count = Feedback::whereIn('id', $validated['feedback_ids'])
                    ->update(['is_published' => true]);
                $message = "$count feedback berhasil dipublikasikan";
                $logMessage = "Admin mempublikasikan $count feedback secara bulk";
                break;

            case 'unpublish':
                $count = Feedback::whereIn('id', $validated['feedback_ids'])
                    ->update(['is_published' => false]);
                $message = "$count feedback berhasil di-unpublish";
                $logMessage = "Admin menyembunyikan $count feedback secara bulk";
                break;

            case 'feature':
                $count = Feedback::whereIn('id', $validated['feedback_ids'])
                    ->update(['is_featured' => true]);
                $message = "$count feedback berhasil di-feature";
                $logMessage = "Admin menandai $count feedback sebagai featured secara bulk";
                break;

            case 'unfeature':
                $count = Feedback::whereIn('id', $validated['feedback_ids'])
                    ->update(['is_featured' => false]);
                $message = "$count feedback berhasil di-unfeature";
                $logMessage = "Admin menghapus status featured dari $count feedback secara bulk";
                break;

            case 'delete':
                $count = Feedback::whereIn('id', $validated['feedback_ids'])->delete();
                $message = "$count feedback berhasil dihapus";
                $logMessage = "Admin menghapus $count feedback secara bulk";
                break;
        }

        // Log bulk action
        activity('feedback')
            ->causedBy(Auth::guard('admin')->user())
            ->withProperties([
                'action' => 'bulk_'.$validated['action'],
                'affected_count' => $count,
                'feedback_ids' => $validated['feedback_ids'],
                'feedback_list' => $feedbackList->map(function ($fb) {
                    return [
                        'id' => $fb->id,
                        'peserta' => $fb->peserta->nama_lengkap ?? 'Unknown',
                        'rating' => $fb->rating,
                    ];
                })->toArray(),
                'ip_address' => $request->ip(),
            ])
            ->log($logMessage);

        return redirect()->route('admin.feedbacks.index')
            ->with('success', $message);
    }
}
