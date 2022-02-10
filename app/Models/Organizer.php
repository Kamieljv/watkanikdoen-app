<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Voyager;

class Organizer extends Model
{
    protected $appends = [
        'logo_path',
        'link',
        'website_human',
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

    public function getWebsiteHumanAttribute()
    {
        if ($this->website) {
            return str_replace('www.', '', parse_url($this->website)['host']);
        }
        return null;
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
