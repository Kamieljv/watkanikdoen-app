<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    protected $table = 'answers';

    protected $fillable = [
        'answer',
        'question_id',
        'dimension_scores',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
