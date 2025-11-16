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
        'qr_code',
        'tgl_penerbitan',
        'status_kirim',
    ];

    protected $casts = [
        'tgl_penerbitan' => 'datetime',
        'status_kirim' => 'boolean',
    ];

    /**
     * Boot method - auto generate nomor sertifikat
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->nomor_sertifikat)) {
                $model->nomor_sertifikat = static::generateNomorSertifikat();
            }
        });

        // Hapus auto-generate QR Code dari boot
        // Kita akan generate QR Code on-the-fly di view atau manual
    }

    /**
     * Generate nomor sertifikat unik
     */
    public static function generateNomorSertifikat()
    {
        $year = date('Y');
        $prefix = 'CERT-'.$year.'-';

        // Cari nomor terakhir di tahun ini
        $lastCert = static::where('nomor_sertifikat', 'like', $prefix.'%')
            ->orderBy('nomor_sertifikat', 'desc')
            ->first();

        if ($lastCert) {
            $lastNumber = (int) substr($lastCert->nomor_sertifikat, -4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return $prefix.str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get verification URL for QR Code
     */
    public function getVerificationUrlAttribute()
    {
        return url('/verify/'.$this->nomor_sertifikat);
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'qr_code_token', 'qr_code_token');
    }
}
