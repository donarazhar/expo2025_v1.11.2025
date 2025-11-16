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
        // 'thumbnail', // HAPUS ATAU TAMBAHKAN tergantung pilihan
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

    // Helper - Use same image for thumbnail if column doesn't exist
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/'.$this->image_path);
        }

        return asset('assets/img/no-image.jpg');
    }

    public function getThumbnailUrlAttribute()
    {
        // If thumbnail column exists and has value
        if (isset($this->thumbnail) && $this->thumbnail) {
            return asset('storage/'.$this->thumbnail);
        }

        // Fallback to main image
        return $this->image_url;
    }
}
