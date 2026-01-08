<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public $fillable = [
        'author_id',
        'category_id',
        'title',
        'seo_title',
        'excerpt',
        'body',
        'image',
        'slug',
        'meta_description',
        'meta_keywords',
        'status',
        'featured',
    ];
    public function link()
    {
        return url('/blog/' . $this->category->slug . '/' . $this->slug);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function image()
    {
        // TODO: implement image from storage
        return '';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function isPublished(): bool
    {
        return $this->status === 'PUBLISHED';
    }
}
