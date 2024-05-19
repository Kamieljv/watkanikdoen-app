<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!isset($model->slug)) {
                $model->slug = preg_replace('/[^A-Za-z0-9\-]/', '_', $model->name);
            }
        });
    }
}
