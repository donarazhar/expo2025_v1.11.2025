<?php

namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\LotteryWinner;
use App\Models\Peserta;
use App\Models\Prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LotteryController extends Controller
{
    /**
     * Display lottery dashboard
     */
    public function index(Request $request)
    {
        $query = Event::with(['prizes', 'lotteryWinners']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->where('tanggal_mulai', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('tanggal_selesai', '<=', $request->date_to);
        }

        $events = $query->orderBy('tanggal_mulai', 'desc')
            ->paginate(15)
            ->withQueryString();

        // General prizes (tidak terikat event)
        $generalPrizes = Prize::whereNull('event_id')
            ->ordered()
            ->get();

        // ========================================
        // PESERTA YANG HADIR (UNTUK UNDIAN UMUM)
        // ========================================

        // Ambil semua QR code token dari absensi yang hadir
        $attendedTokens = Absensi::where('status_kehadiran', true)
            ->pluck('qr_code_token')
            ->unique();

        // Ambil peserta berdasarkan token yang hadir
        $allAttendedParticipants = Peserta::whereIn('qr_code_token', $attendedTokens)
            ->with(['absensi' => function ($q) {
                $q->where('status_kehadiran', true)->latest('waktu_scan');
            }])
            ->get()
            ->map(function ($peserta) {
                $latestAbsensi = $peserta->absensi->first();

                return [
                    'id' => null, // Tidak ada registration_id untuk peserta umum
                    'id_peserta' => $peserta->id_peserta,
                    'qr_code_token' => $peserta->qr_code_token,
                    'nama_lengkap' => $peserta->nama_lengkap,
                    'email' => $peserta->email,
                    'no_hp' => $peserta->no_hp,
                    'instansi' => $peserta->asal_instansi,
                    'waktu_hadir' => $latestAbsensi ? $latestAbsensi->waktu_scan->format('d M Y H:i') : '-',
                    'type' => 'general', // Tanda ini peserta umum
                ];
            });

        // Statistics
        $stats = [
            'total_events' => Event::count(),
            'total_prizes' => Prize::sum('jumlah'),
            'remaining_prizes' => Prize::sum('sisa'),
            'distributed_prizes' => Prize::sum('jumlah') - Prize::sum('sisa'),
            'total_winners' => LotteryWinner::count(),
            'unclaimed_prizes' => LotteryWinner::unclaimed()->count(),
            'claimed_prizes' => LotteryWinner::claimed()->count(),
            'claim_rate' => LotteryWinner::count() > 0
                ? round((LotteryWinner::claimed()->count() / LotteryWinner::count()) * 100, 1)
                : 0,
            'total_registered_participants' => EventRegistration::where('status', 'confirmed')->count(),
            'total_attended_participants' => $allAttendedParticipants->count(),
            'general_prizes' => $generalPrizes->count(),
            'general_prizes_stock' => $generalPrizes->sum('sisa'),
        ];

        return view('admin.lottery.index', compact('events', 'stats', 'generalPrizes', 'allAttendedParticipants'));
    }

    /**
     * Show lottery page for specific event
     */
    public function show(Event $event)
    {
        // Load relationships
        $event->load(['prizes', 'registrations']);

        // Get available prizes for this event (specific + general)
        $availablePrizes = Prize::where(function ($query) use ($event) {
            $query->where('event_id', $event->id)
                ->orWhereNull('event_id');
        })
            ->ordered()
            ->get()
            ->map(function ($prize) {
                return [
                    'id' => $prize->id,
                    'nama_hadiah' => $prize->nama_hadiah,
                    'kategori' => $prize->kategori,
                    'jumlah' => $prize->jumlah,
                    'sisa' => $prize->sisa,
                    'terpakai' => $prize->terpakai,
                    'is_available' => $prize->is_available,
                    'persentase_stok' => $prize->persentase_stok,
                    'event_name' => $prize->event ? $prize->event->judul : 'Umum',
                ];
            });

        // ========================================
        // ELIGIBLE PARTICIPANTS (GABUNGAN)
        // ========================================

        // 1. Peserta terdaftar event ini yang hadir
        $registeredParticipants = EventRegistration::where('event_id', $event->id)
            ->where('status', 'confirmed')
            ->whereHas('peserta.absensi', function ($q) {
                $q->where('status_kehadiran', true);
            })
            ->with(['peserta.absensi' => function ($q) {
                $q->where('status_kehadiran', true)->latest('waktu_scan');
            }])
            ->get()
            ->map(function ($registration) {
                $latestAbsensi = $registration->peserta->absensi->first();

                return [
                    'id' => $registration->id,
                    'id_peserta' => $registration->id_peserta,
                    'qr_code_token' => $registration->peserta->qr_code_token,
                    'nama_lengkap' => $registration->nama_lengkap,
                    'email' => $registration->email,
                    'no_hp' => $registration->no_hp,
                    'instansi' => $registration->peserta->asal_instansi ?? '-',
                    'waktu_hadir' => $latestAbsensi ? $latestAbsensi->waktu_scan->format('d M Y H:i') : '-',
                    'type' => 'registered', // Tanda ini peserta terdaftar event
                ];
            });

        // 2. Peserta umum yang hadir (tidak terdaftar di event ini)
        $registeredTokens = $registeredParticipants->pluck('qr_code_token')->toArray();

        $attendedTokens = Absensi::where('status_kehadiran', true)
            ->pluck('qr_code_token')
            ->unique()
            ->toArray();

        // Token yang hadir tapi tidak terdaftar di event ini
        $generalTokens = array_diff($attendedTokens, $registeredTokens);

        $generalParticipants = Peserta::whereIn('qr_code_token', $generalTokens)
            ->with(['absensi' => function ($q) {
                $q->where('status_kehadiran', true)->latest('waktu_scan');
            }])
            ->get()
            ->map(function ($peserta) {
                $latestAbsensi = $peserta->absensi->first();

                return [
                    'id' => null, // Tidak ada registration_id
                    'id_peserta' => $peserta->id_peserta,
                    'qr_code_token' => $peserta->qr_code_token,
                    'nama_lengkap' => $peserta->nama_lengkap,
                    'email' => $peserta->email,
                    'no_hp' => $peserta->no_hp,
                    'instansi' => $peserta->asal_instansi,
                    'waktu_hadir' => $latestAbsensi ? $latestAbsensi->waktu_scan->format('d M Y H:i') : '-',
                    'type' => 'general', // Tanda ini peserta umum
                ];
            });

        // Gabungkan kedua tipe peserta
        $eligibleParticipants = $registeredParticipants->concat($generalParticipants);

        // Recent winners for this event
        $recentWinners = LotteryWinner::where('event_id', $event->id)
            ->with(['prize', 'registration.peserta'])
            ->latest('waktu_undi')
            ->paginate(20);

        // Statistics
        $stats = [
            'total_registrations' => EventRegistration::where('event_id', $event->id)
                ->where('status', 'confirmed')
                ->count(),
            'total_registered_attendees' => $registeredParticipants->count(),
            'total_general_attendees' => $generalParticipants->count(),
            'total_eligible_participants' => $eligibleParticipants->count(),
            'attendance_rate' => EventRegistration::where('event_id', $event->id)->where('status', 'confirmed')->count() > 0
                ? round(($registeredParticipants->count() / EventRegistration::where('event_id', $event->id)->where('status', 'confirmed')->count()) * 100, 1)
                : 0,
            'total_prizes' => Prize::where('event_id', $event->id)->orWhereNull('event_id')->sum('jumlah'),
            'remaining_prizes' => Prize::where('event_id', $event->id)->orWhereNull('event_id')->sum('sisa'),
            'distributed_prizes' => LotteryWinner::where('event_id', $event->id)->count(),
            'total_winners' => LotteryWinner::where('event_id', $event->id)->count(),
            'claimed_winners' => LotteryWinner::where('event_id', $event->id)->claimed()->count(),
            'unclaimed_winners' => LotteryWinner::where('event_id', $event->id)->unclaimed()->count(),
            'unique_winners' => LotteryWinner::where('event_id', $event->id)
                ->distinct('qr_code_token')
                ->count('qr_code_token'),
        ];

        return view('admin.lottery.show', compact('event', 'availablePrizes', 'eligibleParticipants', 'recentWinners', 'stats'));
    }

    /**
     * Get eligible participants for a specific prize
     */
    public function getEligibleParticipants(Event $event, Prize $prize)
    {
        // ========================================
        // GABUNGAN: REGISTERED + GENERAL
        // ========================================

        // 1. Peserta terdaftar event ini yang hadir
        $registeredParticipants = EventRegistration::where('event_id', $event->id)
            ->where('status', 'confirmed')
            ->whereHas('peserta.absensi', function ($q) {
                $q->where('status_kehadiran', true);
            })
            ->with(['peserta.absensi' => function ($q) {
                $q->where('status_kehadiran', true)->latest('waktu_scan');
            }])
            ->get()
            ->map(function ($registration) {
                $latestAbsensi = $registration->peserta->absensi->first();

                return [
                    'id' => $registration->id,
                    'id_peserta' => $registration->id_peserta,
                    'qr_code_token' => $registration->peserta->qr_code_token,
                    'nama' => $registration->nama_lengkap,
                    'email' => $registration->email,
                    'no_hp' => $registration->no_hp,
                    'instansi' => $registration->peserta->asal_instansi ?? '-',
                    'waktu_hadir' => $latestAbsensi ? $latestAbsensi->waktu_scan->format('d M Y H:i') : '-',
                    'type' => 'registered',
                ];
            });

        // 2. Peserta umum yang hadir
        $registeredTokens = $registeredParticipants->pluck('qr_code_token')->toArray();

        $attendedTokens = Absensi::where('status_kehadiran', true)
            ->pluck('qr_code_token')
            ->unique()
            ->toArray();

        $generalTokens = array_diff($attendedTokens, $registeredTokens);

        $generalParticipants = Peserta::whereIn('qr_code_token', $generalTokens)
            ->with(['absensi' => function ($q) {
                $q->where('status_kehadiran', true)->latest('waktu_scan');
            }])
            ->get()
            ->map(function ($peserta) {
                $latestAbsensi = $peserta->absensi->first();

                return [
                    'id' => null,
                    'id_peserta' => $peserta->id_peserta,
                    'qr_code_token' => $peserta->qr_code_token,
                    'nama' => $peserta->nama_lengkap,
                    'email' => $peserta->email,
                    'no_hp' => $peserta->no_hp,
                    'instansi' => $peserta->asal_instansi,
                    'waktu_hadir' => $latestAbsensi ? $latestAbsensi->waktu_scan->format('d M Y H:i') : '-',
                    'type' => 'general',
                ];
            });

        // Gabungkan
        $allParticipants = $registeredParticipants->concat($generalParticipants);

        // Filter yang sudah menang hadiah ini berdasarkan QR code token
        $alreadyWonTokens = LotteryWinner::where('event_id', $event->id)
            ->where('prize_id', $prize->id)
            ->pluck('qr_code_token')
            ->toArray();

        $eligibleParticipants = $allParticipants->filter(function ($participant) use ($alreadyWonTokens) {
            return ! in_array($participant['qr_code_token'], $alreadyWonTokens);
        })->values();

        return response()->json([
            'success' => true,
            'participants' => $eligibleParticipants,
            'total' => $eligibleParticipants->count(),
            'breakdown' => [
                'registered' => $eligibleParticipants->where('type', 'registered')->count(),
                'general' => $eligibleParticipants->where('type', 'general')->count(),
            ],
            'prize' => [
                'id' => $prize->id,
                'nama' => $prize->nama_hadiah,
                'kategori' => $prize->kategori,
                'sisa' => $prize->sisa,
                'is_available' => $prize->is_available,
            ],
        ]);
    }

    /**
     * Perform the lottery draw
     */
    public function draw(Request $request, Event $event, Prize $prize)
    {
        $validated = $request->validate([
            'qr_code_token' => 'required|exists:peserta,qr_code_token',
            'registration_id' => 'nullable|exists:event_registrations,id',
            'type' => 'required|in:registered,general',
        ], [
            'qr_code_token.required' => 'Peserta harus dipilih',
            'qr_code_token.exists' => 'Peserta tidak ditemukan',
        ]);

        // Check if prize is still available
        if (! $prize->canBeDrawn()) {
            return response()->json([
                'success' => false,
                'message' => 'Hadiah sudah habis atau tidak tersedia!',
            ], 400);
        }

        // Get peserta
        $peserta = Peserta::where('qr_code_token', $validated['qr_code_token'])->first();

        if (! $peserta) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta tidak ditemukan!',
            ], 400);
        }

        // Check if participant attended (has absensi)
        $hasAttended = Absensi::where('qr_code_token', $peserta->qr_code_token)
            ->where('status_kehadiran', true)
            ->exists();

        if (! $hasAttended) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta belum hadir/melakukan check-in!',
            ], 400);
        }

        // Check if participant already won this specific prize
        $alreadyWon = LotteryWinner::where('event_id', $event->id)
            ->where('prize_id', $prize->id)
            ->where('qr_code_token', $peserta->qr_code_token)
            ->exists();

        if ($alreadyWon) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta sudah memenangkan hadiah ini!',
            ], 400);
        }

        DB::beginTransaction();
        try {
            // Prepare winner data
            $winnerData = [
                'event_id' => $event->id,
                'prize_id' => $prize->id,
                'qr_code_token' => $peserta->qr_code_token,
                'id_peserta' => $peserta->id_peserta,
                'registration_id' => $validated['registration_id'], // Bisa null untuk peserta umum
                'nama_pemenang' => $peserta->nama_lengkap,
                'email_pemenang' => $peserta->email,
                'no_hp_pemenang' => $peserta->no_hp,
                'nama_hadiah' => $prize->nama_hadiah,
                'waktu_undi' => now(),
                'sudah_diambil' => false,
                'participant_type' => $validated['type'], // registered atau general
            ];

            // Create winner record
            $winner = LotteryWinner::create($winnerData);

            // Decrease prize stock
            $prize->decreaseStock(1);

            // Custom log for drawing
            activity('lottery')
                ->performedOn($winner)
                ->causedBy(auth()->guard('admin')->user())
                ->withProperties([
                    'action' => 'draw',
                    'event_id' => $event->id,
                    'event_name' => $event->judul,
                    'prize_id' => $prize->id,
                    'prize_name' => $prize->nama_hadiah,
                    'winner_name' => $peserta->nama_lengkap,
                    'participant_type' => $validated['type'],
                ])
                ->log(auth()->guard('admin')->user()->name." mengundi '{$peserta->nama_lengkap}' ({$validated['type']}) sebagai pemenang '{$prize->nama_hadiah}' di event '{$event->judul}'");

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => '🎉 Selamat! Pemenang berhasil diundi!',
                'winner' => [
                    'id' => $winner->id,
                    'nama' => $winner->nama_pemenang,
                    'email' => $winner->email_pemenang,
                    'no_hp' => $winner->no_hp_pemenang,
                    'hadiah' => $winner->nama_hadiah,
                    'waktu' => $winner->formatted_waktu_undi,
                    'instansi' => $peserta->asal_instansi ?? '-',
                    'type' => $validated['type'],
                ],
                'prize' => [
                    'id' => $prize->id,
                    'sisa' => $prize->fresh()->sisa,
                    'is_available' => $prize->fresh()->is_available,
                ],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            // Log error
            activity('lottery')
                ->causedBy(auth()->guard('admin')->user())
                ->withProperties([
                    'error' => $e->getMessage(),
                    'event_id' => $event->id,
                    'prize_id' => $prize->id,
                    'qr_code_token' => $validated['qr_code_token'],
                ])
                ->log('Error saat mengundi: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Mark prize as claimed
     */
    public function claim(Request $request, LotteryWinner $winner)
    {
        $validated = $request->validate([
            'diambil_oleh' => 'required|string|max:255',
            'catatan' => 'nullable|string|max:500',
        ], [
            'diambil_oleh.required' => 'Nama pengambil/petugas wajib diisi',
            'diambil_oleh.max' => 'Nama pengambil maksimal 255 karakter',
        ]);

        if ($winner->sudah_diambil) {
            return response()->json([
                'success' => false,
                'message' => 'Hadiah sudah ditandai sebagai diambil sebelumnya',
            ], 400);
        }

        $winner->markAsClaimed($validated['diambil_oleh'], $validated['catatan'] ?? null);

        return response()->json([
            'success' => true,
            'message' => 'Hadiah berhasil ditandai sebagai sudah diambil',
            'winner' => [
                'id' => $winner->id,
                'sudah_diambil' => $winner->sudah_diambil,
                'waktu_ambil' => $winner->formatted_waktu_ambil,
                'diambil_oleh' => $winner->diambil_oleh,
                'catatan' => $winner->catatan,
            ],
        ]);
    }

    /**
     * Mark prize as unclaimed (cancel claim)
     */
    public function unclaim(LotteryWinner $winner)
    {
        if (! $winner->sudah_diambil) {
            return response()->json([
                'success' => false,
                'message' => 'Hadiah belum ditandai sebagai diambil',
            ], 400);
        }

        $winner->markAsUnclaimed();

        return response()->json([
            'success' => true,
            'message' => 'Status pengambilan hadiah berhasil dibatalkan',
            'winner' => [
                'id' => $winner->id,
                'sudah_diambil' => $winner->sudah_diambil,
            ],
        ]);
    }

    /**
     * Delete winner (cancel draw)
     */
    public function destroy(LotteryWinner $winner)
    {
        DB::beginTransaction();
        try {
            $prize = $winner->prize;
            $event = $winner->event;
            $namaWinner = $winner->nama_pemenang;
            $namaHadiah = $winner->nama_hadiah;

            // Restore prize stock
            $prize->increaseStock(1);

            // Custom log before delete
            activity('lottery')
                ->causedBy(auth()->guard('admin')->user())
                ->withProperties([
                    'action' => 'cancelled',
                    'winner_name' => $namaWinner,
                    'prize_name' => $namaHadiah,
                    'event_name' => $event->judul,
                ])
                ->log(auth()->guard('admin')->user()->name." membatalkan undian untuk {$namaWinner} - {$namaHadiah}");

            // Delete winner
            $winner->delete();

            DB::commit();

            return redirect()->back()
                ->with('success', "Undian untuk {$namaWinner} - {$namaHadiah} berhasil dibatalkan dan stok dikembalikan");
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    /**
     * Export winners for specific event
     */
    public function export(Event $event, Request $request)
    {
        $query = LotteryWinner::where('event_id', $event->id)
            ->with(['prize', 'registration.peserta']);

        // Filter by claim status
        if ($request->filled('claim_status')) {
            if ($request->claim_status === 'claimed') {
                $query->claimed();
            } elseif ($request->claim_status === 'unclaimed') {
                $query->unclaimed();
            }
        }

        // Filter by prize
        if ($request->filled('prize_id')) {
            $query->where('prize_id', $request->prize_id);
        }

        // Filter by prize category
        if ($request->filled('kategori')) {
            $query->whereHas('prize', function ($q) use ($request) {
                $q->where('kategori', $request->kategori);
            });
        }

        $winners = $query->orderBy('waktu_undi', 'desc')->get();

        $data = $winners->map(function ($winner) {
            return [
                'id' => $winner->id,
                'nama_pemenang' => $winner->nama_pemenang,
                'email_pemenang' => $winner->email_pemenang,
                'no_hp_pemenang' => $winner->no_hp_pemenang,
                'instansi' => $winner->registration?->peserta?->instansi ?? '-',
                'nama_hadiah' => $winner->nama_hadiah,
                'kategori_hadiah' => $winner->prize->kategori ?? '-',
                'waktu_undi' => $winner->formatted_waktu_undi,
                'sudah_diambil' => $winner->sudah_diambil ? 'Ya' : 'Belum',
                'waktu_ambil' => $winner->formatted_waktu_ambil,
                'diambil_oleh' => $winner->diambil_oleh ?? '-',
                'catatan' => $winner->catatan ?? '-',
            ];
        });

        // Log export activity
        activity('lottery')
            ->causedBy(auth()->guard('admin')->user())
            ->withProperties([
                'action' => 'export',
                'event_id' => $event->id,
                'event_name' => $event->judul,
                'total_winners' => $winners->count(),
                'filters' => $request->only(['claim_status', 'prize_id', 'kategori']),
            ])
            ->log(auth()->guard('admin')->user()->name." mengekspor data pemenang undian event '{$event->judul}'");

        return response()->json([
            'success' => true,
            'event' => [
                'id' => $event->id,
                'judul' => $event->judul,
                'tanggal' => $event->formatted_date,
                'lokasi' => $event->lokasi,
            ],
            'total' => $data->count(),
            'data' => $data,
            'exported_at' => now()->format('Y-m-d H:i:s'),
            'exported_by' => auth()->guard('admin')->user()->name,
        ]);
    }

    /**
     * Get lottery statistics for dashboard
     */
    public function statistics(Event $event)
    {
        $totalWinners = LotteryWinner::where('event_id', $event->id)->count();
        $claimedWinners = LotteryWinner::where('event_id', $event->id)->claimed()->count();
        $unclaimedWinners = LotteryWinner::where('event_id', $event->id)->unclaimed()->count();

        $winnersByPrize = LotteryWinner::where('event_id', $event->id)
            ->join('prizes', 'lottery_winners.prize_id', '=', 'prizes.id')
            ->select(
                'prizes.id',
                'prizes.nama_hadiah',
                'prizes.kategori',
                DB::raw('count(*) as total_winners'),
                DB::raw('sum(case when lottery_winners.sudah_diambil = 1 then 1 else 0 end) as claimed'),
                DB::raw('sum(case when lottery_winners.sudah_diambil = 0 then 1 else 0 end) as unclaimed')
            )
            ->groupBy('prizes.id', 'prizes.nama_hadiah', 'prizes.kategori')
            ->orderBy('total_winners', 'desc')
            ->get();

        $winnersByCategory = LotteryWinner::where('event_id', $event->id)
            ->join('prizes', 'lottery_winners.prize_id', '=', 'prizes.id')
            ->select('prizes.kategori', DB::raw('count(*) as total'))
            ->groupBy('prizes.kategori')
            ->get();

        return response()->json([
            'success' => true,
            'statistics' => [
                'total_winners' => $totalWinners,
                'claimed' => $claimedWinners,
                'unclaimed' => $unclaimedWinners,
                'claim_percentage' => $totalWinners > 0 ? round(($claimedWinners / $totalWinners) * 100, 1) : 0,
            ],
            'winners_by_prize' => $winnersByPrize,
            'winners_by_category' => $winnersByCategory,
        ]);
    }

    /**
     * Show general lottery page (untuk hadiah umum)
     */
    public function general()
    {
        // Hadiah umum (tidak terikat event)
        $generalPrizes = Prize::whereNull('event_id')
            ->available()
            ->ordered()
            ->get()
            ->map(function ($prize) {
                return [
                    'id' => $prize->id,
                    'nama_hadiah' => $prize->nama_hadiah,
                    'kategori' => $prize->kategori,
                    'jumlah' => $prize->jumlah,
                    'sisa' => $prize->sisa,
                    'terpakai' => $prize->terpakai,
                    'is_available' => $prize->is_available,
                    'persentase_stok' => $prize->persentase_stok,
                ];
            });

        // Semua peserta yang hadir (dari absensi)
        $attendedTokens = Absensi::where('status_kehadiran', true)
            ->pluck('qr_code_token')
            ->unique();

        $allAttendedParticipants = Peserta::whereIn('qr_code_token', $attendedTokens)
            ->with(['absensi' => function ($q) {
                $q->where('status_kehadiran', true)->latest('waktu_scan');
            }])
            ->get()
            ->map(function ($peserta) {
                $latestAbsensi = $peserta->absensi->first();

                return [
                    'id' => null,
                    'id_peserta' => $peserta->id_peserta,
                    'qr_code_token' => $peserta->qr_code_token,
                    'nama_lengkap' => $peserta->nama_lengkap,
                    'email' => $peserta->email,
                    'no_hp' => $peserta->no_hp,
                    'instansi' => $peserta->asal_instansi,
                    'waktu_hadir' => $latestAbsensi ? $latestAbsensi->waktu_scan->format('d M Y H:i') : '-',
                    'type' => 'general',
                ];
            });

        // Recent winners untuk undian umum (event_id = null)
        $recentWinners = LotteryWinner::whereNull('event_id')
            ->with(['prize', 'peserta'])
            ->latest('waktu_undi')
            ->paginate(20);

        // Statistics
        $stats = [
            'total_prizes' => Prize::whereNull('event_id')->sum('jumlah'),
            'remaining_prizes' => Prize::whereNull('event_id')->sum('sisa'),
            'total_participants' => $allAttendedParticipants->count(),
            'total_winners' => LotteryWinner::whereNull('event_id')->count(),
            'claimed_winners' => LotteryWinner::whereNull('event_id')->claimed()->count(),
            'unclaimed_winners' => LotteryWinner::whereNull('event_id')->unclaimed()->count(),
        ];

        return view('admin.lottery.general', compact('generalPrizes', 'allAttendedParticipants', 'recentWinners', 'stats'));
    }

    /**
     * Get participants for general lottery
     */
    public function getGeneralParticipants(Prize $prize)
    {
        // Semua peserta yang hadir
        $attendedTokens = Absensi::where('status_kehadiran', true)
            ->pluck('qr_code_token')
            ->unique()
            ->toArray();

        $allParticipants = Peserta::whereIn('qr_code_token', $attendedTokens)
            ->with(['absensi' => function ($q) {
                $q->where('status_kehadiran', true)->latest('waktu_scan');
            }])
            ->get()
            ->map(function ($peserta) {
                $latestAbsensi = $peserta->absensi->first();

                return [
                    'id' => null,
                    'id_peserta' => $peserta->id_peserta,
                    'qr_code_token' => $peserta->qr_code_token,
                    'nama' => $peserta->nama_lengkap,
                    'email' => $peserta->email,
                    'no_hp' => $peserta->no_hp,
                    'instansi' => $peserta->asal_instansi,
                    'waktu_hadir' => $latestAbsensi ? $latestAbsensi->waktu_scan->format('d M Y H:i') : '-',
                    'type' => 'general',
                ];
            });

        // Filter yang sudah menang hadiah ini
        $alreadyWonTokens = LotteryWinner::whereNull('event_id')
            ->where('prize_id', $prize->id)
            ->pluck('qr_code_token')
            ->toArray();

        $eligibleParticipants = $allParticipants->filter(function ($participant) use ($alreadyWonTokens) {
            return ! in_array($participant['qr_code_token'], $alreadyWonTokens);
        })->values();

        return response()->json([
            'success' => true,
            'participants' => $eligibleParticipants,
            'total' => $eligibleParticipants->count(),
            'prize' => [
                'id' => $prize->id,
                'nama' => $prize->nama_hadiah,
                'kategori' => $prize->kategori,
                'sisa' => $prize->sisa,
                'is_available' => $prize->is_available,
            ],
        ]);
    }

    /**
     * Perform general lottery draw
     */
    public function drawGeneral(Request $request, Prize $prize)
    {
        $validated = $request->validate([
            'qr_code_token' => 'required|exists:peserta,qr_code_token',
        ]);

        // Check prize availability
        if (! $prize->canBeDrawn()) {
            return response()->json([
                'success' => false,
                'message' => 'Hadiah sudah habis atau tidak tersedia!',
            ], 400);
        }

        // Get peserta
        $peserta = Peserta::where('qr_code_token', $validated['qr_code_token'])->first();

        if (! $peserta) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta tidak ditemukan!',
            ], 400);
        }

        // Check attendance
        $hasAttended = Absensi::where('qr_code_token', $peserta->qr_code_token)
            ->where('status_kehadiran', true)
            ->exists();

        if (! $hasAttended) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta belum hadir/melakukan check-in!',
            ], 400);
        }

        // Check if already won this prize
        $alreadyWon = LotteryWinner::whereNull('event_id')
            ->where('prize_id', $prize->id)
            ->where('qr_code_token', $peserta->qr_code_token)
            ->exists();

        if ($alreadyWon) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta sudah memenangkan hadiah ini!',
            ], 400);
        }

        DB::beginTransaction();
        try {
            // Create winner
            $winner = LotteryWinner::create([
                'event_id' => null, // Undian umum
                'prize_id' => $prize->id,
                'qr_code_token' => $peserta->qr_code_token,
                'id_peserta' => $peserta->id_peserta,
                'registration_id' => null,
                'nama_pemenang' => $peserta->nama_lengkap,
                'email_pemenang' => $peserta->email,
                'no_hp_pemenang' => $peserta->no_hp,
                'nama_hadiah' => $prize->nama_hadiah,
                'waktu_undi' => now(),
                'sudah_diambil' => false,
                'participant_type' => 'general',
            ]);

            // Decrease stock
            $prize->decreaseStock(1);

            // Log activity
            activity('lottery')
                ->performedOn($winner)
                ->causedBy(auth()->guard('admin')->user())
                ->withProperties([
                    'action' => 'draw_general',
                    'prize_id' => $prize->id,
                    'prize_name' => $prize->nama_hadiah,
                    'winner_name' => $peserta->nama_lengkap,
                ])
                ->log(auth()->guard('admin')->user()->name." mengundi '{$peserta->nama_lengkap}' sebagai pemenang undian umum '{$prize->nama_hadiah}'");

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => '🎉 Selamat! Pemenang berhasil diundi!',
                'winner' => [
                    'id' => $winner->id,
                    'nama' => $winner->nama_pemenang,
                    'email' => $winner->email_pemenang,
                    'no_hp' => $winner->no_hp_pemenang,
                    'hadiah' => $winner->nama_hadiah,
                    'waktu' => $winner->formatted_waktu_undi,
                    'instansi' => $peserta->asal_instansi ?? '-',
                    'type' => 'general',
                ],
                'prize' => [
                    'id' => $prize->id,
                    'sisa' => $prize->fresh()->sisa,
                    'is_available' => $prize->fresh()->is_available,
                ],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            activity('lottery')
                ->causedBy(auth()->guard('admin')->user())
                ->withProperties([
                    'error' => $e->getMessage(),
                    'prize_id' => $prize->id,
                    'qr_code_token' => $validated['qr_code_token'],
                ])
                ->log('Error saat mengundi umum: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: '.$e->getMessage(),
            ], 500);
        }
    }
}
