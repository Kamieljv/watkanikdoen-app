<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('answers')->delete();
        
        \DB::table('answers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'answer' => 'Klimaat',
                'question_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'answer' => 'Anti-racisme',
                'question_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'answer' => 'LHBTQI+ rechten',
                'question_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'answer' => 'Lekker thuis',
                'question_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'answer' => 'Op straat',
                'question_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}