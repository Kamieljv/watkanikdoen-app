<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ReferentieType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Referentie extends Model
{
    use HasFactory;

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

    public function voyagerRoute($action)
    {
        return route('voyager.referenties.' . $action, $this->id);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED');
    }

}
