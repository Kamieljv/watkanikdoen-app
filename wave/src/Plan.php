<?php

namespace Wave;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;

class Plan extends Model
{
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->slug = Str::lower(Str::slug($model->name));
        });
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
