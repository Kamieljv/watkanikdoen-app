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
                'id' => 1,
                'answer_id' => 1,
                'dimension_id' => 1,
                'score' => 10,
            ),
            1 => 
            array (
                'id' => 2,
                'answer_id' => 4,
                'dimension_id' => 3,
                'score' => 10,
            ),
            2 => 
            array (
                'id' => 3,
                'answer_id' => 3,
                'dimension_id' => 1,
                'score' => 5,
            ),
            3 => 
            array (
                'id' => 4,
                'answer_id' => 5,
                'dimension_id' => 3,
                'score' => 7,
            ),
            4 => 
            array (
                'id' => 5,
                'answer_id' => 6,
                'dimension_id' => 3,
                'score' => 3,
            ),
            5 => 
            array (
                'id' => 6,
                'answer_id' => 7,
                'dimension_id' => 3,
                'score' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'answer_id' => 8,
                'dimension_id' => 2,
                'score' => 10,
            ),
            7 => 
            array (
                'id' => 8,
                'answer_id' => 9,
                'dimension_id' => 2,
                'score' => 5,
            ),
            8 => 
            array (
                'id' => 9,
                'answer_id' => 10,
                'dimension_id' => 2,
                'score' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'answer_id' => 2,
                'dimension_id' => 1,
                'score' => 1,
            ),
            10 => 
            array (
                'id' => 35,
                'answer_id' => 17,
                'dimension_id' => 4,
                'score' => 1,
            ),
            11 => 
            array (
                'id' => 36,
                'answer_id' => 18,
                'dimension_id' => 4,
                'score' => 5,
            ),
            12 => 
            array (
                'id' => 37,
                'answer_id' => 19,
                'dimension_id' => 4,
                'score' => 10,
            ),
            13 => 
            array (
                'id' => 38,
                'answer_id' => 20,
                'dimension_id' => 5,
                'score' => 10,
            ),
            14 => 
            array (
                'id' => 39,
                'answer_id' => 21,
                'dimension_id' => 5,
                'score' => 1,
            ),
            15 => 
            array (
                'id' => 40,
                'answer_id' => 22,
                'dimension_id' => 5,
                'score' => 5,
            ),
        ));
        
        
    }
}