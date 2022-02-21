<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Voyager;

class Image extends Model
{
    protected $fillable = [
        'path',
        'user_id'
    ];

    protected $appends = [
        'url',
    ];

    public function getUrlAttribute()
    {
        return Voyager::image($this->path);
    }
}
