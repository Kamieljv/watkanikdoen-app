<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferentieTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('referentie_types')->delete();
        
        \DB::table('referentie_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Vrijwilligerswerk',
                'description' => 'Ik wil vrijwilligerswerk doen',
                'style' => '{}',
                'status' => 'PUBLISHED',
                'created_at' => '2024-04-05 14:22:16',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Doneren',
                'description' => 'Ik wil doneren',
                'style' => '{}',
                'status' => 'PUBLISHED',
                'created_at' => '2024-04-05 14:22:16',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}