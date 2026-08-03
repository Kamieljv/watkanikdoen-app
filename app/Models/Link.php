<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Link extends Model
{

    public $fillable = [
        'title',
        'subtitle',
        'url',
        'thumbnail',
        'sort_order',
        'status',
    ];

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ? Storage::disk('public')->url($this->thumbnail) : null;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'ACTIVE');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
