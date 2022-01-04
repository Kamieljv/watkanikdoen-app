<?php

namespace Wave;

use Carbon\Carbon;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Log;

use Laravel\Scout\Searchable;
use TCG\Voyager\Traits\Spatial;

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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'link',
        'image_path',
        'start',
        'start_unix',
        '_geoloc'
    ];

    protected $hidden = [
        'location',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['organizers:id,name,logo', 'categories', 'themes'];

    public function getLinkAttribute(){
    	return url('/actie/' . $this->slug);
    }

    public function getImagePathAttribute(){
    	return $this->image ? \Voyager::image($this->image) : null;
    }

    public function getStartAttribute() {
        return Date::parse($this->time_start)->format('j M Y, G:i');
    }

    public function getStartUnixAttribute() {
        return Date::parse($this->time_start)->timestamp;
    }

    public function getgeolocAttribute(){
        $coords = $this->getCoordinates();
        return (count($coords) === 0)? null : $coords[0];
    }

    /**
     * Get a new query builder for the model's table.
     * Manipulate in case we need to convert geometrical fields to text.
     *
     * @param  bool $excludeDeleted
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery($excludeDeleted = true)
    {
        if (!empty($this->spatial) && $this->geometryAsText === true)
        {
            $raw = '';
            foreach ($this->spatial as $column)
            {
                $raw .= 'ST_AsText(`' . $this->table . '`.`' . $column . '`) as `' . $column . '`, ';
            }
            $raw = substr($raw, 0, -2);

            return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($raw));
        }

        return parent::newQuery($excludeDeleted);
    }

    public function organizers(){
        return $this->belongsToMany('Wave\Organizer', 'actie_organizer');
    }

    public function categories(){
    	return $this->belongsToMany('Wave\Category', 'actie_category');
    }

    public function themes(){
    	return $this->belongsToMany('Wave\ActieTheme', 'actie_actie_theme');
    }
}