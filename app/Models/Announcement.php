<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{

    public $fillable = [
        'title',
        'description',
        'url',
        'color',
        'status',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'ACTIVE');
    }
}
