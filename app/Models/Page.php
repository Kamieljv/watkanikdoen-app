<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    public $fillable = [
        'author_id',
        'title',
        'excerpt',
        'body',
        'image',
        'slug',
        'meta_description',
        'meta_keywords',
        'status',
    ];

    public function link()
    {
        return url('p/' . $this->slug);
    }

    public function image()
    {
        // TODO: implement image from storage
        return '';
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function isPublished(): bool
    {
        return $this->status === 'PUBLISHED';
    }
}
