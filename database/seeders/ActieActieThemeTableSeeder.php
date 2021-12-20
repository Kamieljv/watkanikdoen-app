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
                'actie_id' => 17,
                'actie_theme_id' => 4,
                'id' => 1,
            ),
        ));
        
        
    }
}