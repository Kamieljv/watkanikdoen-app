<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActieActieThemeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('actie_actie_theme')->delete();
        
        \DB::table('actie_actie_theme')->insert(array (
            0 => 
            array (
                'id' => 1,
                'actie_id' => 17,
                'actie_theme_id' => 4,
            ),
            1 => 
            array (
                'id' => 2,
                'actie_id' => 16,
                'actie_theme_id' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'actie_id' => 12,
                'actie_theme_id' => 2,
            ),
            3 => 
            array (
                'id' => 4,
                'actie_id' => 11,
                'actie_theme_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'actie_id' => 23,
                'actie_theme_id' => 2,
            ),
            5 => 
            array (
                'id' => 6,
                'actie_id' => 24,
                'actie_theme_id' => 2,
            ),
            6 => 
            array (
                'id' => 7,
                'actie_id' => 19,
                'actie_theme_id' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'actie_id' => 20,
                'actie_theme_id' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'actie_id' => 25,
                'actie_theme_id' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'actie_id' => 25,
                'actie_theme_id' => 3,
            ),
        ));
        
        
    }
}