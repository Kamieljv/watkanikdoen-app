<?php

namespace App\Models;

use App\Models\Actie;
use Illuminate\Database\Eloquent\Model;

class ActieTheme extends Model
{
    public function acties()
    {
        return $this->belongsToMany(Actie::class, 'actie_actie_theme');
    }
}
