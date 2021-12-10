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

    public function link(){
    	return url('/actie/' . $this->slug);
    }

    public function user(){
        return $this->belongsTo('\Wave\User', 'author_id');
    }

    public function image(){
    	return \Voyager::image($this->image);
    }

    public function categories(){
    	return $this->belongsToMany('Wave\Category', 'actie_category');
    }
}