<?php

namespace Wave;

use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    public function acties(){
    	return $this->belongsToMany('Wave\Actie', 'actie_organizer');
    }
}
