<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function acties()
    {
        return $this->belongsToMany(Actie::class, 'actie_category');
    }
}
