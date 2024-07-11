<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferentieReferentieTypeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('referentie_referentie_type')->delete();
        
        \DB::table('referentie_referentie_type')->insert(array (
            0 => 
            array (
                'id' => 4,
                'referentie_id' => 5,
                'referentie_type_id' => 2,
            ),
            1 => 
            array (
                'id' => 5,
                'referentie_id' => 4,
                'referentie_type_id' => 2,
            ),
            2 => 
            array (
                'id' => 6,
                'referentie_id' => 3,
                'referentie_type_id' => 2,
            ),
            3 => 
            array (
                'id' => 7,
                'referentie_id' => 1,
                'referentie_type_id' => 1,
            ),
            4 => 
            array (
                'id' => 8,
                'referentie_id' => 2,
                'referentie_type_id' => 2,
            ),
        ));
        
        
    }
}