<?php

namespace App\Models;

use App\Models\Question;
use App\Models\Dimension;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    protected $table = 'answers';

    protected $fillable = [
        'answer',
        'question_id',
    ];

    protected $with = [
        'dimensions'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function dimensions()
    {
        return $this->belongsToMany(Dimension::class)->withPivot('score');
    }

    public function getScoreVectorAttribute()
    {
        $score_vec = [];
        foreach (Dimension::all() as $d) {
            $matching_dim = $this->dimensions->where('id', $d->id);
            if (count($matching_dim) > 0) {
                array_push($score_vec, $matching_dim[0]->pivot->score);
            } else {
                array_push($score_vec, 0);
            }
        }
        return $score_vec;
    }
}