<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HandbookPage extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'parent_id', 'order'];

    public function parent()
    {
        return $this->belongsTo(HandbookPage::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(HandbookPage::class, 'parent_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'handbook_page_tag');
    }
}
