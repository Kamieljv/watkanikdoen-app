<?php

namespace Wave;

use Illuminate\Database\Eloquent\Model;

class ActieTheme extends Model
{
    public function acties(){
    	return $this->belongsToMany('Wave\Actie', 'actie_actie_theme');
    }
}
