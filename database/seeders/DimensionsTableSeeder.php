<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DimensionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dimensions')->delete();
        
        \DB::table('dimensions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Straatactivist',
                'description' => 'Ben je iemand die graag meedoet aan demonstraties op straat?',
                'created_at' => '2024-06-02 09:48:00',
                'updated_at' => '2025-02-18 17:40:58',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Geld',
                'description' => 'Hoeveel geld heb je beschikbaar om te doneren?',
                'created_at' => '2024-06-02 09:48:00',
                'updated_at' => '2025-02-18 17:40:32',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Tijd',
                'description' => 'Hoeveel tijd heb je om je in te zetten voor jouw thema?',
                'created_at' => '2024-06-02 09:48:00',
                'updated_at' => '2025-02-18 17:40:05',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Gezamenlijkheid',
                'description' => 'Wil je liever samen met anderen actievoeren?',
                'created_at' => '2025-02-10 19:36:46',
                'updated_at' => '2025-02-10 19:36:46',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Politiek',
                'description' => 'Wil je iets doen in de politiek?',
                'created_at' => '2025-02-10 19:39:06',
                'updated_at' => '2025-02-10 19:39:06',
            ),
        ));
        
        
    }
}