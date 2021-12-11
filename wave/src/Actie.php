<?php

namespace Wave;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Spatial;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Actie extends Model
{
    use SpatialTrait; 
    use Spatial;
    
    protected $spatial = ['location'];    

    protected $spatialFields = [
        'location',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'link',
        'image_path'
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

    public function user(){
        return $this->belongsTo('\Wave\User', 'author_id');
    }

    public function categories(){
    	return $this->belongsToMany('Wave\Category', 'actie_category');
    }
}