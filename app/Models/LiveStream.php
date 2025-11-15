<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveStream extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'judul',
        'platform',
        'stream_url',
        'embed_code',
        'jadwal_tayang',
        'status',
        'viewer_count'
    ];

    protected $casts = [
        'jadwal_tayang' => 'datetime',
        'viewer_count' => 'integer'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function scopeLive($query)
    {
        return $query->where('status', 'live');
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    public function getEmbedHtmlAttribute()
    {
        if ($this->embed_code) {
            return $this->embed_code;
        }

        if ($this->platform === 'youtube' && preg_match('/youtube\.com\/watch\?v=([^&]+)/', $this->stream_url, $matches)) {
            $videoId = $matches[1];
            return "<iframe width='100%' height='500' src='https://www.youtube.com/embed/{$videoId}' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
        }

        return null;
    }
}