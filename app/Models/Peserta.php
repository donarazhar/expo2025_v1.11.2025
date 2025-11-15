<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peserta extends Model
{
    use SoftDeletes;

    protected $table = 'peserta';  // Singular

    protected $primaryKey = 'id_peserta';  // String PK

    public $incrementing = false;  // Not auto-increment

    protected $keyType = 'string';  // String type

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

    // Set default value for tgl_registrasi
    protected $attributes = [
        'tgl_registrasi' => null,
    ];

    // Auto-set values on creation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($peserta) {
            // Set tgl_registrasi if not set
            if (empty($peserta->tgl_registrasi)) {
                $peserta->tgl_registrasi = now();
            }

            // Generate QR code token if not set
            if (empty($peserta->qr_code_token)) {
                $peserta->qr_code_token = Str::random(32);
            }
        });
    }

    // Relationships
    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class, 'id_peserta', 'id_peserta');
    }
    
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'id_peserta', 'id_peserta');
    }

    public function registeredEvents()
    {
        return $this->belongsToMany(Event::class, 'event_registrations', 'id_peserta', 'event_id')
            ->withPivot('status', 'keterangan')
            ->withTimestamps();
    }

    // Helper methods
    public function getQrCodeUrlAttribute()
    {
        return route('check-in.qr', ['token' => $this->qr_code_token]);
    }

    public function hasCheckedIn()
    {
        return !is_null($this->check_in_at);
    }


    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'qr_code_token', 'qr_code_token');
    }

    public function eSertifikat()
    {
        return $this->hasOne(ESertifikat::class, 'qr_code_token', 'qr_code_token');
    }
}
