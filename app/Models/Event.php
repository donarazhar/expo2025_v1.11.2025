<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'kapasitas',
        'status',
        'kategori',
        'banner_image',
        'is_featured',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'is_featured' => 'boolean',
        'kapasitas' => 'integer',
    ];

    // ============================================
    // ACTIVITY LOG CONFIGURATION
    // ============================================

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['judul', 'status', 'tanggal_mulai', 'tanggal_selesai', 'lokasi', 'kapasitas', 'kategori', 'is_featured'])
            ->logOnlyDirty() // Hanya log perubahan
            ->dontSubmitEmptyLogs()
            ->useLogName('events')
            ->setDescriptionForEvent(fn (string $eventName) => $this->getDescriptionForEvent($eventName));
    }

    protected function getDescriptionForEvent(string $eventName): string
    {
        $userName = auth()->user()->name ?? 'System';

        return match ($eventName) {
            'created' => "{$userName} membuat event: {$this->judul}",
            'updated' => "{$userName} mengupdate event: {$this->judul}",
            'deleted' => "{$userName} menghapus event: {$this->judul}",
            default => "{$userName} {$eventName} event: {$this->judul}",
        };
    }

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->judul);
            }
        });
    }

    // ============================================
    // RELATIONSHIPS
    // ============================================

    public function schedules()
    {
        return $this->hasMany(EventSchedule::class)->orderBy('waktu_mulai');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function registeredPesertas()
    {
        return $this->belongsToMany(Peserta::class, 'event_registrations', 'event_id', 'id_peserta')
            ->withPivot('status', 'keterangan')
            ->withTimestamps();
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function liveStreams()
    {
        return $this->hasMany(LiveStream::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('tanggal_mulai', '>', now());
    }

    public function scopePast($query)
    {
        return $query->where('tanggal_selesai', '<', now());
    }

    public function scopeOngoing($query)
    {
        return $query->where('tanggal_mulai', '<=', now())
            ->where('tanggal_selesai', '>=', now());
    }

    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // ============================================
    // ACCESSORS (Computed Attributes)
    // ============================================

    public function getRegisteredCountAttribute()
    {
        return $this->registrations()->where('status', 'confirmed')->count();
    }

    public function getAvailableSlotsAttribute()
    {
        if ($this->kapasitas == 0) {
            return PHP_INT_MAX; // Unlimited capacity
        }

        return max(0, $this->kapasitas - $this->registered_count);
    }

    public function getIsFullAttribute()
    {
        return $this->kapasitas > 0 && $this->registered_count >= $this->kapasitas;
    }

    public function getAverageRatingAttribute()
    {
        return round($this->feedbacks()->where('is_published', true)->avg('rating') ?? 0, 1);
    }

    public function getTotalFeedbacksAttribute()
    {
        return $this->feedbacks()->where('is_published', true)->count();
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'draft' => '<span class="px-2 py-1 text-xs rounded-full bg-gray-200 text-gray-800">Draft</span>',
            'published' => '<span class="px-2 py-1 text-xs rounded-full bg-green-200 text-green-800">Published</span>',
            'cancelled' => '<span class="px-2 py-1 text-xs rounded-full bg-red-200 text-red-800">Cancelled</span>',
        ];

        return $badges[$this->status] ?? $this->status;
    }

    public function getFormattedDateAttribute()
    {
        if ($this->tanggal_selesai && $this->tanggal_mulai->format('Y-m-d') != $this->tanggal_selesai->format('Y-m-d')) {
            return $this->tanggal_mulai->format('d M Y').' - '.$this->tanggal_selesai->format('d M Y');
        }

        return $this->tanggal_mulai->format('d M Y');
    }

    public function getFormattedTimeAttribute()
    {
        if ($this->tanggal_selesai) {
            return $this->tanggal_mulai->format('H:i').' - '.$this->tanggal_selesai->format('H:i');
        }

        return $this->tanggal_mulai->format('H:i');
    }

    public function getIsUpcomingAttribute()
    {
        return $this->tanggal_mulai > now();
    }

    public function getIsOngoingAttribute()
    {
        return $this->tanggal_mulai <= now() &&
               (! $this->tanggal_selesai || $this->tanggal_selesai >= now());
    }

    public function getIsPastAttribute()
    {
        return $this->tanggal_selesai && $this->tanggal_selesai < now();
    }

    public function getDaysUntilAttribute()
    {
        if ($this->is_past) {
            return 0;
        }

        return $this->tanggal_mulai->diffInDays(now());
    }

    // ============================================
    // HELPER METHODS
    // ============================================

    public function canRegister()
    {
        return $this->status === 'published' &&
               ! $this->is_full &&
               $this->is_upcoming;
    }

    public function hasUserRegistered($idPeserta)
    {
        return $this->registrations()
            ->where('id_peserta', $idPeserta)
            ->where('status', 'confirmed')
            ->exists();
    }

    public function incrementViewCount()
    {
        // Untuk tracking popularity (opsional, bisa ditambah kolom view_count)
        // $this->increment('view_count');
    }

    // ============================================
    // LOTTERY & PRIZES RELATIONSHIPS
    // ============================================

    /**
     * Hadiah yang terkait dengan event ini
     */
    // Di dalam class Event

    public function prizes()
    {
        return $this->hasMany(Prize::class);
    }

    public function lotteryWinners()
    {
        return $this->hasMany(LotteryWinner::class);
    }

    /**
     * Get all available prizes (event-specific + general)
     */
    public function availablePrizes()
    {
        return Prize::where(function ($query) {
            $query->where('event_id', $this->id)
                ->orWhereNull('event_id');
        })->where('sisa', '>', 0)->ordered();
    }
}
