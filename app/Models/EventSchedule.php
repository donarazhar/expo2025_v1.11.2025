<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'judul',
        'deskripsi',
        'pembicara',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi_detail',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
