<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!isset($model->slug)) {
                $model->slug = $model->name;
            }
        });
    }
}
