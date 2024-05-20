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
                'url' => 'url',
                'description' => 'lorem ipsum',
                'image' => 'image',
                'status' => 'PUBLISHED',
                'created_at' => '2024-04-05 14:22:17',
                'updated_at' => NULL,
                'referentie_type_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Effectief Doneren',
                'url' => 'url',
                'description' => 'lorem ipsum',
                'image' => 'image',
                'status' => 'PUBLISHED',
                'created_at' => '2024-04-05 14:22:16',
                'updated_at' => NULL,
                'referentie_type_id' => 2,
            ),
        ));
        
        
    }
}