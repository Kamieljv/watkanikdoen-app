<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('questions')->delete();
        
        \DB::table('questions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'question' => 'Voor welk thema wil je je inzetten?',
                'description' => 'Er zijn ontzettend veel thema\'s waarvoor je je kunt inzetten!',
                'subject' => 'Thema',
                'status' => 'ACTIVE',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'question' => 'Wil je graag de straat op voor een actie, of blijf je liever thuis?',
                'description' => 'Sommige mensen voeren liever actie vanuit hun leunstoel.',
                'subject' => 'Type',
                'status' => 'ACTIVE',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}