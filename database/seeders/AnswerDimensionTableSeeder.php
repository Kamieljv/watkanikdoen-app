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
                'answer_id' => 4,
                'dimension_id' => 1,
                'score' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'answer_id' => 5,
                'dimension_id' => 1,
                'score' => 10,
            ),
        ));
        
        
    }
}