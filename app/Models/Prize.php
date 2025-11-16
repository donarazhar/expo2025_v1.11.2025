<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'nama_hadiah',
        'deskripsi',
        'gambar',
        'jumlah',
        'sisa',
        'urutan',
        'kategori',
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'sisa' => 'integer',
        'urutan' => 'integer',
    ];

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function winners()
    {
        return $this->hasMany(LotteryWinner::class);
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('sisa', '>', 0);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }

    // Accessors & Mutators
    public function getImageUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/'.$this->gambar);
        }

        return asset('assets/img/prize-default.png');
    }

    public function getTerpakaiAttribute()
    {
        return $this->jumlah - $this->sisa;
    }

    public function getIsAvailableAttribute()
    {
        return $this->sisa > 0;
    }

    public function getPersentaseStokAttribute()
    {
        if ($this->jumlah == 0) {
            return 0;
        }

        return round(($this->sisa / $this->jumlah) * 100, 1);
    }

    // Helper Methods
    public function canBeDrawn()
    {
        return $this->sisa > 0;
    }

    public function decreaseStock($amount = 1)
    {
        if ($this->sisa >= $amount) {
            $this->decrement('sisa', $amount);

            return true;
        }

        return false;
    }

    public function increaseStock($amount = 1)
    {
        $this->increment('sisa', $amount);

        return true;
    }
}
