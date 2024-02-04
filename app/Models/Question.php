<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;

class Question extends Model
{

    protected $table = 'questions';

    protected $fillable = [
        'question',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'answers',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'ACTIVE');
    }

}
