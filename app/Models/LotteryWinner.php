<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryWinner extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'prize_id',
        'qr_code_token',
        'id_peserta',
        'registration_id',
        'nama_pemenang',
        'email_pemenang',
        'no_hp_pemenang',
        'nama_hadiah',
        'waktu_undi',
        'sudah_diambil',
        'waktu_ambil',
        'diambil_oleh',
        'catatan',
        'participant_type', // 'registered' atau 'general'
    ];

    protected $casts = [
        'waktu_undi' => 'datetime',
        'waktu_ambil' => 'datetime',
        'sudah_diambil' => 'boolean',
    ];

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function prize()
    {
        return $this->belongsTo(Prize::class);
    }

    public function registration()
    {
        return $this->belongsTo(EventRegistration::class, 'registration_id');
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id_peserta');
    }

    // Scopes
    public function scopeClaimed($query)
    {
        return $query->where('sudah_diambil', true);
    }

    public function scopeUnclaimed($query)
    {
        return $query->where('sudah_diambil', false);
    }

    public function scopeRegistered($query)
    {
        return $query->where('participant_type', 'registered');
    }

    public function scopeGeneral($query)
    {
        return $query->where('participant_type', 'general');
    }

    // Accessors
    public function getFormattedWaktuUndiAttribute()
    {
        return $this->waktu_undi ? $this->waktu_undi->format('d M Y, H:i').' WIB' : '-';
    }

    public function getFormattedWaktuAmbilAttribute()
    {
        return $this->waktu_ambil ? $this->waktu_ambil->format('d M Y, H:i').' WIB' : '-';
    }

    public function getStatusBadgeAttribute()
    {
        if ($this->sudah_diambil) {
            return '<span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">✓ Sudah Diambil</span>';
        }

        return '<span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">⏳ Belum Diambil</span>';
    }

    public function getParticipantTypeBadgeAttribute()
    {
        if ($this->participant_type === 'registered') {
            return '<span class="px-2 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">👤 Terdaftar</span>';
        }

        return '<span class="px-2 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">🌟 Umum</span>';
    }

    // Helper Methods
    public function markAsClaimed($diambilOleh, $catatan = null)
    {
        $this->update([
            'sudah_diambil' => true,
            'waktu_ambil' => now(),
            'diambil_oleh' => $diambilOleh,
            'catatan' => $catatan,
        ]);
    }

    public function markAsUnclaimed()
    {
        $this->update([
            'sudah_diambil' => false,
            'waktu_ambil' => null,
            'diambil_oleh' => null,
        ]);
    }
}
