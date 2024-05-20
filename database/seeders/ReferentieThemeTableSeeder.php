<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferentieThemeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('referentie_theme')->delete();

        #To match with the random ids in themes table
        $theme_id =  \DB::table('themes')->pluck('id')->first();
        
        \DB::table('referentie_theme')->insert(array (
            0 => 
            array (
                'id' => 1,
                'referentie_id' => 1,
                // 'theme_id' => 1,
                'theme_id' =>$theme_id
            ),
        ));
        
        
    }
}