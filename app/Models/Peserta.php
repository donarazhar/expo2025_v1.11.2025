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
            // Generate ID Peserta 4 karakter alfanumerik (A7K2)
            if (empty($peserta->id_peserta)) {
                $peserta->id_peserta = self::generateUniqueId();
            }
            
            // QR Code Token tetap sama untuk scan
            if (empty($peserta->qr_code_token)) {
                $peserta->qr_code_token = Str::uuid()->toString();
            }
            
            if (empty($peserta->tgl_registrasi)) {
                $peserta->tgl_registrasi = now();
            }
        });
    }
    
    /**
     * Generate unique 4-character alphanumeric ID
     * Format: A7K2 (huruf + angka + huruf + angka)
     * Capacity: 36^4 = 1,679,616 kombinasi (lebih dari cukup untuk 1000 pengunjung)
     */
    private static function generateUniqueId()
    {
        $maxAttempts = 10;
        $attempt = 0;
        
        do {
            // Generate 4 karakter acak (huruf besar + angka)
            $id = strtoupper(Str::random(4));
            
            // Pastikan ada kombinasi huruf dan angka (tidak semua huruf atau semua angka)
            if (preg_match('/^(?=.*[A-Z])(?=.*[0-9])[A-Z0-9]{4}$/', $id)) {
                // Check uniqueness
                if (!self::where('id_peserta', $id)->exists()) {
                    return $id;
                }
            }
            
            $attempt++;
        } while ($attempt < $maxAttempts);
        
        // Fallback: timestamp-based jika gagal generate unique
        return strtoupper(substr(md5(microtime()), 0, 4));
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