<?php

namespace App\Models;

use App\Models\Resource;

class Book extends Resource
{
    // Add Book-specific properties and methods here
    protected $fillable = [
        'isbn',
        'cover_image',
    ];
}