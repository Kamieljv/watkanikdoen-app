<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Voyager;

class Aanmelding extends Model
{
    protected $table = 'aanmeldingen';

    protected $appends = [
        'image_path',
    ];

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'externe_link',
        'time_start',
        'time_end',
        'location',
        'location_human',
        'image',
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
        return $this->belongsTo(User::class)->without('aanmeldingen');
    }
}
