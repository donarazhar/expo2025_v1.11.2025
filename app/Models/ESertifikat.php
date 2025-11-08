<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ESertifikat extends Model
{
    use HasFactory;

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

    /**
     * Boot function untuk generate nomor sertifikat otomatis
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($sertifikat) {
            if (empty($sertifikat->nomor_sertifikat)) {
                $sertifikat->nomor_sertifikat = 'CERT-AZE-' . date('Y') . '-' . str_pad(static::count() + 1, 5, '0', STR_PAD_LEFT);
            }
            
            if (empty($sertifikat->tgl_penerbitan)) {
                $sertifikat->tgl_penerbitan = now();
            }
        });
    }

    /**
     * Relasi One to One dengan Peserta
     */
    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'qr_code_token', 'qr_code_token');
    }

    /**
     * Scope untuk filter sertifikat yang sudah dikirim
     */
    public function scopeTerkirim($query)
    {
        return $query->where('status_kirim', true);
    }

    /**
     * Scope untuk filter sertifikat yang belum dikirim
     */
    public function scopeBelumTerkirim($query)
    {
        return $query->where('status_kirim', false);
    }

    /**
     * Scope untuk filter berdasarkan tanggal penerbitan
     */
    public function scopePenerbitanBetween($query, $startDate, $endDate)
    {
        return $query->whereBetween('tgl_penerbitan', [$startDate, $endDate]);
    }
}