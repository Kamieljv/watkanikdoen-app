<?php

namespace Wave;

use Illuminate\Database\Eloquent\Model;
use Voyager;

class Aanmelding extends Model
{
    protected $table = 'aanmeldingen';

    protected $appends = [
        'image_path',
    ];

    public function getLogoPathAttribute()
    {
        return $this->image ? Voyager::image($this->image) : null;
    }

    public function user()
    {
        return $this->hasOne('Wave\User');
    }
}
