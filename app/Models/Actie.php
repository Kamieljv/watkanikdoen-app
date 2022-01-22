<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Laravel\Scout\Searchable;
use TCG\Voyager\Traits\Spatial;
use Voyager;

class Actie extends Model
{
    use Spatial;
    use Searchable;

    protected $spatial = ['location'];

    /**
     * Select geometrical attributes as text from database.
     *
     * @var bool
     */
    protected $geometryAsText = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'externe_link',
        'time_start',
        'time_end',
        'location',
        'location_human',
        'slug',
        'image',
        'status',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'link',
        'image_path',
        'start',
        'start_unix',
        '_geoloc',
    ];

    protected $hidden = [
        'location',
        'id',
        'author_id',
        'status',
        'image',
        'slug',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['organizers:id,name,logo,slug', 'categories:id,name', 'themes:id,name,color'];

    public function getLinkAttribute()
    {
        return url('/actie/' . $this->slug);
    }

    public function getImagePathAttribute()
    {
        return $this->image ? Voyager::image($this->image) : null;
    }

    public function getStartAttribute()
    {
        return Date::parse($this->time_start)->format('j M Y, G:i');
    }

    public function getStartUnixAttribute()
    {
        return Date::parse($this->time_start)->timestamp;
    }

    public function getgeolocAttribute()
    {
        $coords = $this->getCoordinates();
        return (count($coords) === 0) ? null : $coords[0];
    }

    /**
     * Get a new query builder for the model's table.
     * Manipulate in case we need to convert geometrical fields to text.
     *
     * @param  bool $excludeDeleted
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery($excludeDeleted = true)
    {
        if (!empty($this->spatial) && $this->geometryAsText === true) {
            $raw = '';
            foreach ($this->spatial as $column) {
                $raw .= 'ST_AsText(`' . $this->table . '`.`' . $column . '`) as `' . $column . '`, ';
            }
            $raw = substr($raw, 0, -2);

            return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($raw));
        }

        return parent::newQuery($excludeDeleted);
    }

    public function organizers()
    {
        return $this->belongsToMany(Organizer::class, 'actie_organizer');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'actie_category');
    }

    public function themes()
    {
        return $this->belongsToMany(ActieTheme::class, 'actie_actie_theme');
    }
}
