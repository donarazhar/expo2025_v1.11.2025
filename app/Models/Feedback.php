<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Feedback extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'feedbacks';

    protected $fillable = [
        'id_peserta',
        'event_id',
        'rating',
        'komentar',
        'is_published',
        'is_featured',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['stars_html', 'rating_percentage'];

    /**
     * Configure activity logging
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'id_peserta',
                'event_id',
                'rating',
                'komentar',
                'is_published',
                'is_featured',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => "Feedback baru ditambahkan: Rating {$this->rating}/5 dari {$this->peserta_nama}",
                'updated' => "Feedback diperbarui: {$this->peserta_nama} - Rating {$this->rating}/5",
                'deleted' => "Feedback dihapus: {$this->peserta_nama} - Rating {$this->rating}/5",
                default => "Feedback {$eventName}: {$this->peserta_nama}"
            })
            ->useLogName('feedback');
    }

    // Relationships
    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id_peserta');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    public function scopeForEvent($query, $eventId)
    {
        return $query->where('event_id', $eventId);
    }

    // Accessors
    public function getStarsHtmlAttribute()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            $stars .= $i <= $this->rating ? '⭐' : '☆';
        }

        return $stars;
    }

    public function getRatingPercentageAttribute()
    {
        return ($this->rating / 5) * 100;
    }

    public function getPesertaNamaAttribute()
    {
        return $this->peserta ? $this->peserta->nama_lengkap : 'Anonymous';
    }

    public function getEventJudulAttribute()
    {
        return $this->event ? $this->event->judul : 'Feedback Umum';
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y');
    }

    public function getFormattedTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    // Methods
    public function publish()
    {
        $this->update(['is_published' => true]);
    }

    public function unpublish()
    {
        $this->update(['is_published' => false]);
    }

    public function toggleFeatured()
    {
        $this->update(['is_featured' => ! $this->is_featured]);
    }

    public function isPublished()
    {
        return $this->is_published === true;
    }

    public function isFeatured()
    {
        return $this->is_featured === true;
    }

    // Static methods for statistics
    public static function getAverageRating($eventId = null)
    {
        $query = self::published();

        if ($eventId) {
            $query->where('event_id', $eventId);
        }

        return round($query->avg('rating'), 1) ?: 0;
    }

    public static function getTotalFeedbacks($eventId = null)
    {
        $query = self::published();

        if ($eventId) {
            $query->where('event_id', $eventId);
        }

        return $query->count();
    }

    public static function getRatingDistribution($eventId = null)
    {
        $query = self::published();

        if ($eventId) {
            $query->where('event_id', $eventId);
        }

        $distribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $distribution[$i] = $query->where('rating', $i)->count();
        }

        return $distribution;
    }
}
