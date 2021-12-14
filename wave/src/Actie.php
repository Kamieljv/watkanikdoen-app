<?php

namespace Wave;

use Carbon\Carbon;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use TCG\Voyager\Traits\Spatial;

class Actie extends Model
{
    use Spatial;
    
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
        'location_object'
    ];

    protected $hidden = [
        'location',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['user:id,name,avatar', 'categories'];

    public function getLinkAttribute(){
    	return url('/actie/' . $this->slug);
    }

    public function getImagePathAttribute(){
    	return \Voyager::image($this->image);
    }

    public function getStartAttribute() {
        return Date::parse($this->time_start)->format('j M Y, G:i');
    }

    public function getLocationObjectAttribute(){
        $pointArray = explode(' ', Geometry::getWKTArgument($this->location));
        if (count($pointArray) === 2) {
            return new Point($pointArray[0], $pointArray[1]);
        } else {
            return null;
        }
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

    public function user(){
        return $this->belongsTo('\Wave\User', 'author_id');
    }

    public function categories(){
    	return $this->belongsToMany('Wave\Category', 'actie_category');
    }
}