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
                'answer' => 'Lekker thuis',
                'created_at' => NULL,
                'id' => 1,
                'question_id' => 2,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'answer' => 'Op straat',
                'created_at' => NULL,
                'id' => 2,
                'question_id' => 2,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'answer' => 'Heel veel tijd',
                'created_at' => '2024-01-26 14:48:31',
                'id' => 3,
                'question_id' => 3,
                'updated_at' => '2024-01-26 14:48:31',
            ),
            3 => 
            array (
                'answer' => 'Veel tijd',
                'created_at' => NULL,
                'id' => 4,
                'question_id' => 3,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'answer' => 'Weinig tijd',
                'created_at' => NULL,
                'id' => 5,
                'question_id' => 3,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'answer' => 'Heel weinig tijd',
                'created_at' => NULL,
                'id' => 6,
                'question_id' => 3,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'answer' => 'Heel veel geld',
                'created_at' => '2024-01-26 14:48:31',
                'id' => 7,
                'question_id' => 4,
                'updated_at' => '2024-01-26 14:48:31',
            ),
            7 => 
            array (
                'answer' => 'Veel geld',
                'created_at' => NULL,
                'id' => 8,
                'question_id' => 4,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'answer' => 'Weinig geld',
                'created_at' => NULL,
                'id' => 9,
                'question_id' => 4,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'answer' => 'Heel weinig geld',
                'created_at' => NULL,
                'id' => 10,
                'question_id' => 4,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}