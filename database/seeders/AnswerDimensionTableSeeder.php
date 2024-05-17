<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AnswerDimensionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('answer_dimension')->delete();
        
        \DB::table('answer_dimension')->insert(array (
            0 => 
            array (
                'answer_id' => 1,
                'dimension_id' => 1,
                'id' => 3,
                'score' => 0,
            ),
            1 => 
            array (
                'answer_id' => 2,
                'dimension_id' => 1,
                'id' => 4,
                'score' => 10,
            ),
            2 => 
            array (
                'answer_id' => 3,
                'dimension_id' => 3,
                'id' => 5,
                'score' => 10,
            ),
            3 => 
            array (
                'answer_id' => 4,
                'dimension_id' => 3,
                'id' => 6,
                'score' => 7,
            ),
            4 => 
            array (
                'answer_id' => 5,
                'dimension_id' => 3,
                'id' => 7,
                'score' => 3,
            ),
            5 => 
            array (
                'answer_id' => 6,
                'dimension_id' => 3,
                'id' => 8,
                'score' => 0,
            ),
            6 => 
            array (
                'answer_id' => 7,
                'dimension_id' => 4,
                'id' => 9,
                'score' => 10,
            ),
            7 => 
            array (
                'answer_id' => 8,
                'dimension_id' => 4,
                'id' => 10,
                'score' => 7,
            ),
            8 => 
            array (
                'answer_id' => 9,
                'dimension_id' => 4,
                'id' => 11,
                'score' => 3,
            ),
            9 => 
            array (
                'answer_id' => 10,
                'dimension_id' => 4,
                'id' => 12,
                'score' => 0,
            ),
        ));       
    }
}