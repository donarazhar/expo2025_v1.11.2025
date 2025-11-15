<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $primaryKey = 'id_absensi';

    protected $fillable = [
        'qr_code_token',
        'waktu_scan',
        'petugas_scanner',
        'status_kehadiran',
    ];

    protected $casts = [
        'waktu_scan' => 'datetime',
        'status_kehadiran' => 'boolean',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'qr_code_token', 'qr_code_token');
    }
}
