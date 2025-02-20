<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function handbookPages()
    {
        return $this->belongsToMany(HandbookPage::class, 'handbook_page_tag');
    }
}
