<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Peserta extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'peserta';
    protected $primaryKey = 'id_peserta';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_peserta',
        'nama_lengkap',
        'email',
        'no_hp',
        'asal_instansi',
        'tgl_registrasi',
        'qr_code_token',
    ];

    protected $casts = [
        'tgl_registrasi' => 'datetime',
    ];

    /**
     * Boot function untuk generate ID dan QR Code Token otomatis
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($peserta) {
            if (empty($peserta->id_peserta)) {
                $peserta->id_peserta = 'AZE-' . date('Ymd') . '-' . strtoupper(Str::random(6));
            }
            
            if (empty($peserta->qr_code_token)) {
                $peserta->qr_code_token = Str::uuid()->toString();
            }
            
            if (empty($peserta->tgl_registrasi)) {
                $peserta->tgl_registrasi = now();
            }
        });
    }

    /**
     * Relasi One to Many dengan Absensi
     */
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'qr_code_token', 'qr_code_token');
    }

    /**
     * Relasi One to One dengan E-Sertifikat
     */
    public function sertifikat()
    {
        return $this->hasOne(ESertifikat::class, 'qr_code_token', 'qr_code_token');
    }

    /**
     * Scope untuk filter berdasarkan tanggal registrasi
     */
    public function scopeRegisteredBetween($query, $startDate, $endDate)
    {
        return $query->whereBetween('tgl_registrasi', [$startDate, $endDate]);
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nama_lengkap', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('no_hp', 'like', "%{$search}%")
              ->orWhere('asal_instansi', 'like', "%{$search}%")
              ->orWhere('id_peserta', 'like', "%{$search}%");
        });
    }
}