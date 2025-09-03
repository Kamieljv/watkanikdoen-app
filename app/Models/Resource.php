<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

abstract class Resource extends Model
{
    protected $fillable = [
        'title',
        'description',
        'author',
        'published_at',
        'type',
    ];

    public function themes()
    {
        return $this->belongsToMany(Theme::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}