<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferentiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('referenties')->delete();
        
        \DB::table('referenties')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Vrijwilligersfuncties Greenpeace',
                'url' => 'http://ns.nl/word-vrijwilliger',
                'description' => '<p>lorem ipsum</p>',
                'image' => NULL,
                'status' => 'PUBLISHED',
                'created_at' => '2024-04-05 14:22:00',
                'updated_at' => '2024-07-11 16:09:57',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Effectief Doneren',
                'url' => 'https://doneren.nl',
                'description' => '<p>lorem ipsum</p>',
                'image' => NULL,
                'status' => 'PUBLISHED',
                'created_at' => '2024-04-05 14:22:00',
                'updated_at' => '2024-07-11 16:10:08',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Doneren aan iets anders',
                'url' => 'https://doneren.nl',
                'description' => '<p>Test</p>',
                'image' => NULL,
                'status' => 'PUBLISHED',
                'created_at' => '2024-07-11 16:04:00',
                'updated_at' => '2024-07-11 16:09:42',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Nog een keer doneren',
                'url' => 'https://doneren.nl',
                'description' => '<p>Test 123</p>',
                'image' => NULL,
                'status' => 'PUBLISHED',
                'created_at' => '2024-07-11 16:05:00',
                'updated_at' => '2024-07-11 16:09:33',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'En nog een keer doneren',
                'url' => 'https://doneren.nl',
                'description' => '<p>sdfs</p>',
                'image' => NULL,
                'status' => 'PUBLISHED',
                'created_at' => '2024-07-11 16:05:00',
                'updated_at' => '2024-07-11 16:09:24',
            ),
        ));
        
        
    }
}