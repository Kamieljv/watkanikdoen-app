<?php

namespace Wave;

use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{

    protected $appends = [
        'logo_path',
        'link',
    ];

    public function getLogoPathAttribute(){
    	return $this->logo ? \Voyager::image($this->logo) : null;
    }

    public function getLinkAttribute(){
        return url('/organizer/' . $this->slug);
    }

    public function acties(){
    	return $this->hasMany('Wave\Actie', 'actie_organizer');
    }
}
