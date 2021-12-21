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
        ));
        
        
    }
}