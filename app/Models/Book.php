<?php

namespace App\Models;

use App\Models\Resource;

class Book extends Resource
{
    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable(['isbn', 'cover_image']);
    }
}