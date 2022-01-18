<?php

namespace Wave;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function acties()
    {
        return $this->belongsToMany('Wave\Actie', 'actie_category');
    }
}
