<?php

namespace App\Models;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Voyager;

class Post extends Model
{
    public function link()
    {
        return url('/blog/' . $this->category->slug . '/' . $this->slug);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function image()
    {
        return Voyager::image($this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
