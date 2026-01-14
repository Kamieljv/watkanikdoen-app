<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'color',
    ];

    public function acties()
    {
        return $this->belongsToMany(Actie::class, 'actie_theme');
    }

    public function organizers()
    {
        return $this->belongsToMany(Organizer::class, 'organizer_theme');
    }
}
