<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Peserta extends Model
{
    use LogsActivity, SoftDeletes;

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
     * Configure activity logging
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'nama_lengkap',
                'email',
                'no_hp',
                'asal_instansi',
            ])
            ->logOnlyDirty() // Hanya log field yang berubah
            ->dontSubmitEmptyLogs() // Jangan submit log kosong
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => "Peserta baru ditambahkan: {$this->nama_lengkap}",
                'updated' => "Data peserta diperbarui: {$this->nama_lengkap}",
                'deleted' => "Peserta dihapus: {$this->nama_lengkap}",
                default => "Peserta {$eventName}: {$this->nama_lengkap}"
            })
            ->useLogName('peserta'); // Nama log category
    }

    /**
     * Boot method - Auto-generate ID and QR token
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($peserta) {
            // Generate unique 4-character ID_PESERTA
            if (empty($peserta->id_peserta)) {
                do {
                    // Generate 4 random uppercase alphanumeric characters
                    $id = strtoupper(Str::random(4));
                } while (self::where('id_peserta', $id)->exists());

                $peserta->id_peserta = $id;
            }

            // Set tgl_registrasi if not set
            if (empty($peserta->tgl_registrasi)) {
                $peserta->tgl_registrasi = now();
            }

            // Generate QR code token if not set (use UUID for better uniqueness)
            if (empty($peserta->qr_code_token)) {
                $peserta->qr_code_token = (string) Str::uuid();
            }
        });
    }

    /**
     * Relationships
     */
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

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'qr_code_token', 'qr_code_token');
    }

    public function eSertifikat()
    {
        return $this->hasOne(ESertifikat::class, 'qr_code_token', 'qr_code_token');
    }

    /**
     * Helper methods
     */
    public function getQrCodeUrlAttribute()
    {
        return route('check-in.form').'?token='.$this->qr_code_token;
    }

    public function hasCheckedIn()
    {
        return $this->absensi()->exists();
    }
}
