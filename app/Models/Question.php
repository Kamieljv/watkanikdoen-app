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

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
