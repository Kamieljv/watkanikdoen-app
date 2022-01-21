<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Voyager;

class Aanmelding extends Model
{
    protected $table = 'aanmeldingen';

    protected $appends = [
        'image_path',
    ];

    public function getImagePathAttribute()
    {
        return $this->image ? Voyager::image($this->image) : null;
    }

    public function approve()
    {
        $this->status = 'APPROVED';
        $this->save();
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
