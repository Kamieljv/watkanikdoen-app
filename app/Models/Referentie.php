<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ReferentieType;

class Referentie extends Model
{

    protected $table = 'referenties';

    protected $fillable = [
        'title',
        'url',
        'description',
        'image',
        'status'
    ];

    public function referentie_type()
    {
        return $this->belongsTo(ReferentieType::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED');
    }

}
