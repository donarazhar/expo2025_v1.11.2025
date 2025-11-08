<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

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

    /**
     * Boot function untuk set waktu scan otomatis
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($absensi) {
            if (empty($absensi->waktu_scan)) {
                $absensi->waktu_scan = now();
            }
        });
    }

    /**
     * Relasi Many to One dengan Peserta
     */
    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'qr_code_token', 'qr_code_token');
    }

    /**
     * Scope untuk filter berdasarkan tanggal
     */
    public function scopeScannedBetween($query, $startDate, $endDate)
    {
        return $query->whereBetween('waktu_scan', [$startDate, $endDate]);
    }

    /**
     * Scope untuk filter berdasarkan petugas
     */
    public function scopeByPetugas($query, $petugas)
    {
        return $query->where('petugas_scanner', $petugas);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeHadir($query)
    {
        return $query->where('status_kehadiran', true);
   }
}