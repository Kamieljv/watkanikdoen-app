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
                'description' => 'Kies minimaal 1 thema waarvoor je je zou willen inzetten.',
                'subject' => 'Thema',
                'status' => 'ACTIVE',
                'created_at' => '2024-06-02 09:40:00',
                'updated_at' => '2025-02-18 17:41:46',
            ),
            1 => 
            array (
                'id' => 2,
                'question' => 'Wil je graag de straat op, of blijf je liever thuis?',
                'description' => 'Demonstreren gebeurt veel in de openbare ruimte, maar er zijn ook allerlei vormen van digitaal activisme mogelijk',
                'subject' => 'Soort actie',
                'status' => 'ACTIVE',
                'created_at' => '2024-06-02 09:43:00',
                'updated_at' => '2025-01-13 14:09:32',
            ),
            2 => 
            array (
                'id' => 3,
                'question' => 'Heb je geld om te doneren en ben je bereid dat te doen?',
                'description' => 'Geld is belangrijk om mensen en middelen te kunnen bekostigen. Doneren aan een organisatie kan een goede manier zijn om bij te dragen.',
                'subject' => 'Geld',
                'status' => 'ACTIVE',
                'created_at' => '2024-06-02 09:55:00',
                'updated_at' => '2025-04-15 06:08:41',
            ),
            3 => 
            array (
                'id' => 4,
                'question' => 'Hoeveel tijd heb je te besteden aan actievoeren?',
                'description' => 'Hoeveel tijd heb je om je in te zetten voor wat je belangrijk vindt?',
                'subject' => 'Tijd',
                'status' => 'ACTIVE',
                'created_at' => '2024-06-02 09:56:00',
                'updated_at' => '2025-01-13 14:09:04',
            ),
            4 => 
            array (
                'id' => 5,
                'question' => 'Wil je je graag samen met anderen inzetten, of liever alleen?',
                'description' => 'Sommige mensen komen het liefst samen met anderen in actie. Anderen doen dat liever alleen.',
                'subject' => 'Gemeenschappelijkheid',
                'status' => 'ACTIVE',
                'created_at' => '2025-02-10 19:28:00',
                'updated_at' => '2025-02-18 17:44:07',
            ),
            5 => 
            array (
                'id' => 6,
                'question' => 'Wil je je inzetten in de politiek?',
                'description' => 'In de politiek kun je grote veranderingen teweegbrengen, bijvoorbeeld als raadslid of lid van een lobbyorganisatie.',
                'subject' => 'Politiek',
                'status' => 'ACTIVE',
                'created_at' => '2025-02-10 19:40:00',
                'updated_at' => '2025-02-18 17:44:52',
            ),
        ));
        
        
    }
}