<?php

namespace Wave;

use Illuminate\Database\Eloquent\Model;

class Actie extends Model
{
    public function link(){
    	return url('/actie/' . $this->slug);
    }

    public function user(){
        return $this->belongsTo('\Wave\User', 'author_id');
    }

    public function image(){
    	return \Voyager::image($this->image);
    }

    public function category(){
    	return $this->belongsTo('Wave\Category');
    }
}