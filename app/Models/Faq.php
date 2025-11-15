<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori',
        'pertanyaan',
        'jawaban',
        'urutan',
        'is_published',
        'view_count'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'urutan' => 'integer',
        'view_count' => 'integer'
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('created_at');
    }

    public function incrementViewCount()
    {
        $this->increment('view_count');
    }
}