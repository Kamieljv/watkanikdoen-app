<?php

namespace App\Models;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Book extends Resource
{
    use HasFactory;
    /**
     * Add fillable attributes to the base Resource model
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->mergeFillable([
            'publisher',
            'isbn',
            'cover_image',
        ]);

        parent::__construct($attributes);
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class );
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}