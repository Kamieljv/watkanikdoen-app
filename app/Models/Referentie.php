<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ReferentieType;

class Referentie extends Model
{
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $table = 'referenties';

    protected $fillable = [
        'title',
        'url',
        'description',
        'image',
        'status'
    ];

    protected $with = [
        'themes:id,name,color',
        'linked_image',
    ];

    public function referentie_types()
    {
        return $this->belongsToMany(ReferentieType::class, 'referentie_referentie_type');
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class);
    }

    public function linked_image()
    {
        return $this->hasOne(Image::class)->without('referentie');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED');
    }

}
