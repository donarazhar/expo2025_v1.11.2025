<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ESertifikat extends Model
{
    protected $table = 'e_sertifikat';

    protected $primaryKey = 'id_sertifikat';

    protected $fillable = [
        'qr_code_token',
        'nomor_sertifikat',
        'tgl_penerbitan',
        'status_kirim',
    ];

    protected $casts = [
        'tgl_penerbitan' => 'datetime',
        'status_kirim' => 'boolean',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'qr_code_token', 'qr_code_token');
    }
}
