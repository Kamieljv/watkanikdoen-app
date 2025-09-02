<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function acties(): MorphToMany
    {
        return $this->morphedByMany(Actie::class, 'taggable');
    }

    public function organizers(): MorphToMany
    {
        return $this->morphedByMany(Organizer::class, 'taggable');
    }

    public function referenties(): MorphToMany
    {
        return $this->morphedByMany(Referentie::class, 'taggable');
    }
}