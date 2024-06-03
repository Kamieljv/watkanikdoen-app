<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Referentie;
use Illuminate\Support\Facades\Log;

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
        'dimensions'
    ];

    public function referenties()
    {
        return $this->belongsToMany(Referentie::class, 'referentie_referentie_type');
    }

    public function dimensions()
    {
        return $this->belongsToMany(Dimension::class, 'referentie_type_dimension')->withPivot('score');
    }

    public function getScoreVectorAttribute()
    {
        $score_vec = [];
        foreach (Dimension::all() as $d) {
            $matching_dim = $this->dimensions->where('id', $d->id)->first();
            if ($matching_dim) {
                array_push($score_vec, $matching_dim->pivot->score);
            } else {
                array_push($score_vec, 0);
            }
        }
        return $score_vec;
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED');
    }

}
