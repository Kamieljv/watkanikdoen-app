<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Referentie;
use Illuminate\Support\Facades\Log;

class ReferentieType extends Model
{
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    
    protected $table = 'referentie_types';

    protected $appends = [
        'link'
    ];

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
                $score_vec[$d->id] = $matching_dim->pivot->score;
            }
        }
        return $score_vec;
    }

    public function getLinkAttribute()
    {
        return url('/type/' . strtolower($this->title));

    }

    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED');
    }

}
