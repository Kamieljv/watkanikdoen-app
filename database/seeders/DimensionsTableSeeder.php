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
                'name' => 'Streetiness',
                'description' => 'How likely are you to go onto the streets?',
                'created_at' => '2024-01-26 10:34:07',
                'updated_at' => '2024-01-26 10:34:07',
            ),
        ));
        
        
    }
}