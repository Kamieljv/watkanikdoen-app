<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Referentie;

class ReferentieType extends Model
{

    protected $table = 'referentie_types';

    protected $fillable = [
        'title',
        'description',
        'style'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'referenties',
    ];

    public function referenties()
    {
        return $this->hasMany(Referentie::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED');
    }

}
