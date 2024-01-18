<?php

namespace Database\Seeders;

use DB;
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


        DB::table('answers')->delete();

        DB::table('answers')->insert(array (
            0 =>
            array (
                'id' => 1,
                'answer' => 'Klimaat',
                'question_id' => 1
            ),
            1 =>
            array (
                'id' => 2,
                'answer' => 'Anti-racisme',
                'question_id' => 1
            ),
            2 =>
            array (
                'id' => 3,
                'answer' => 'LHBTQI+ rechten',
                'question_id' => 1
            ),
            3 =>
            array (
                'id' => 4,
                'answer' => 'Lekker thuis',
                'question_id' => 2
            ),
            4 =>
            array (
                'id' => 5,
                'answer' => 'Op straat',
                'question_id' => 2
            ),
        ));
    }
}
