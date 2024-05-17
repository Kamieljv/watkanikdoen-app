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
                'created_at' => '2024-01-26 10:34:07',
                'description' => 'How likely are you to go onto the streets?',
                'id' => 1,
                'name' => 'Streetiness',
                'updated_at' => '2024-01-26 10:34:07',
            ),
            1 => 
            array (
                'created_at' => '2024-01-26 14:27:03',
                'description' => 'In welke mate ben je bereid regels te overtreden om je punt kracht bij te zetten?',
                'id' => 2,
                'name' => 'Disobedience',
                'updated_at' => '2024-01-26 14:27:03',
            ),
            2 => 
            array (
                'created_at' => '2024-01-26 14:27:39',
                'description' => 'Hoeveel tijd heb je om je in te zetten voor wat je belangrijk vindt?',
                'id' => 3,
                'name' => 'Tijd',
                'updated_at' => '2024-01-26 14:27:39',
            ),
            3 => 
            array (
                'created_at' => '2024-01-26 14:28:06',
                'description' => 'Heb je geld om te doneren en ben je bereid dat te doen?',
                'id' => 4,
                'name' => 'Geld',
                'updated_at' => '2024-01-26 14:28:06',
            ),
        ));
        
        
    }
}