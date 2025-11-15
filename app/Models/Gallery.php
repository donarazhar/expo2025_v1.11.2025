<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'judul',
        'deskripsi',
        'image_path',
        'thumbnail',
        'kategori',
        'urutan',
    ];

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }

    // Helper
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return asset('assets/img/no-image.jpg');
    }
}