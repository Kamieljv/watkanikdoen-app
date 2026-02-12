<?php

namespace App\Models;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Book extends Resource
{
    /**
     * Add fillable attributes to the base Resource model
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable(['isbn', 'cover_image']);
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