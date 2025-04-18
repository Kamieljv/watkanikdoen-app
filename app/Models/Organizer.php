<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    use HasFactory;
    
    protected $appends = [
        'link',
        'website_human',
    ];

    protected $fillable = [
        'name',
        'description',
        'website',
        'slug',
        'user_id',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'themes:id,name,color,slug',
        'linked_image',
    ];

    public function voyagerRoute($action)
    {
        return route('voyager.organizers.' . $action, $this->id);
    }

    public function getLinkAttribute()
    {
        return url('/organisator/' . $this->slug);
    }

    public function getWebsiteHumanAttribute()
    {
        if ($this->website) {
            if (substr($this->website, 0, 4) != 'http') {
                $this->website = '//' . $this->website;
            }
            return str_replace('www.', '', parse_url($this->website)['host']);
        }
        return null;
    }

    public function approve()
    {
        $this->status = 'APPROVED';
        $this->save();
    }

    public function publish()
    {
        $this->status = 'PUBLISHED';
        $this->save();
    }

    public function acties()
    {
        return $this->hasMany(Actie::class);
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class);
    }

    public function linked_image()
    {
        return $this->hasOne(Image::class)->without('organizer');
    }
    
    public function getPublishedAttribute()
    {
        return $this->status === "PUBLISHED";
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED');
    }
}
