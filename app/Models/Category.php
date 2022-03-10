<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
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

    public function acties()
    {
        return $this->belongsToMany(Actie::class, 'actie_category');
    }
}
