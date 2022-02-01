<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrganizerThemeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('organizer_theme')->delete();
        
        \DB::table('organizer_theme')->insert(array (
            0 => 
            array (
                'id' => 1,
                'organizer_id' => 3,
                'theme_id' => 2,
            ),
            1 => 
            array (
                'id' => 2,
                'organizer_id' => 2,
                'theme_id' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'organizer_id' => 1,
                'theme_id' => 1,
            ),
        ));
        
        
    }
}