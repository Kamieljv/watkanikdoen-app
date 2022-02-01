<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Voyager;

class Organizer extends Model
{
    protected $appends = [
        'logo_path',
        'link',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['themes:id,name,color,slug'];


    public function getLogoPathAttribute()
    {
        return $this->logo ? Voyager::image($this->logo) : null;
    }

    public function getLinkAttribute()
    {
        return url('/organizer/' . $this->slug);
    }

    public function acties()
    {
        return $this->hasMany(Actie::class, 'actie_organizer');
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class, 'organizer_theme');
    }
}
