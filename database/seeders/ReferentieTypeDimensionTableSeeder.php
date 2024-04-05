<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferentieTypeDimensionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('referentie_type_dimension')->delete();
        
        \DB::table('referentie_type_dimension')->insert(array (
            0 => 
            array (
                'id' => 1,
                'referentie_type_id' => 1,
                'dimension_id' => 3,
                'score' => 10,
            ),
            1 => 
            array (
                'id' => 2,
                'referentie_type_id' => 2,
                'dimension_id' => 4,
                'score' => 10,
            ),
        ));
        
        
    }
}