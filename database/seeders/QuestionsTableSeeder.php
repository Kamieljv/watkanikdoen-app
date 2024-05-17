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
                'created_at' => '2024-01-26 12:16:00',
                'description' => 'Er zijn ontzettend veel thema\'s waarvoor je je kunt inzetten!',
                'id' => 1,
                'question' => 'Voor welk thema wil je je inzetten?',
                'status' => 'ACTIVE',
                'subject' => 'Thema',
                'updated_at' => '2024-01-26 11:16:36',
            ),
            1 => 
            array (
                'created_at' => NULL,
                'description' => 'Sommige mensen voeren liever actie vanuit hun leunstoel.',
                'id' => 2,
                'question' => 'Wil je graag de straat op voor een actie, of blijf je liever thuis?',
                'status' => 'ACTIVE',
                'subject' => 'Type',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => '2024-01-26 14:37:27',
                'description' => 'Geef aan hoeveel tijd je hebt',
                'id' => 3,
                'question' => 'Hoeveel tijd heb je te besteden aan actievoeren?',
                'status' => 'ACTIVE',
                'subject' => 'Tijd',
                'updated_at' => '2024-01-26 14:37:27',
            ),
            3 => 
            array (
                'created_at' => '2024-01-26 14:38:08',
                'description' => 'Geef geld',
                'id' => 4,
                'question' => 'Hoeveel geld heb je om te doneren?',
                'status' => 'ACTIVE',
                'subject' => 'Doneren',
                'updated_at' => '2024-01-26 14:38:08',
            ),
        ));
        
        
    }
}