<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_peserta',  // Changed from peserta_id
        'event_id',
        'status',
        'keterangan',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id_peserta');  // Specify both keys
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Tambahkan relationship ini
    public function lotteryWinners()
    {
        return $this->hasMany(LotteryWinner::class, 'registration_id');
    }

    public function hasWonPrize($prizeId = null)
    {
        $query = $this->lotteryWinners();

        if ($prizeId) {
            $query->where('prize_id', $prizeId);
        }

        return $query->exists();
    }

    public function totalPrizesWon()
    {
        return $this->lotteryWinners()->count();
    }
}
