<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Voyager;

class Image extends Model
{
    protected $primaryKey = 'key';

    protected $fillable = [
        'path',
        'user_id',
        'actie_id',
        'organizer_id',
        'report_id'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->key = md5($model->path);
        });
    }

    protected $appends = [
        'url',
    ];

    public function getUrlAttribute()
    {
        return Voyager::image($this->path);
    }
}
