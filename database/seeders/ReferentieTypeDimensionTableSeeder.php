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
                'id' => 11,
                'referentie_type_id' => 1,
                'dimension_id' => 4,
                'score' => 10,
            ),
            1 => 
            array (
                'id' => 12,
                'referentie_type_id' => 2,
                'dimension_id' => 2,
                'score' => 10,
            ),
            2 => 
            array (
                'id' => 13,
                'referentie_type_id' => 3,
                'dimension_id' => 1,
                'score' => 1,
            ),
            3 => 
            array (
                'id' => 14,
                'referentie_type_id' => 3,
                'dimension_id' => 3,
                'score' => 3,
            ),
            4 => 
            array (
                'id' => 15,
                'referentie_type_id' => 4,
                'dimension_id' => 1,
                'score' => 10,
            ),
            5 => 
            array (
                'id' => 16,
                'referentie_type_id' => 6,
                'dimension_id' => 3,
                'score' => 7,
            ),
            6 => 
            array (
                'id' => 17,
                'referentie_type_id' => 6,
                'dimension_id' => 1,
                'score' => 1,
            ),
            7 => 
            array (
                'id' => 18,
                'referentie_type_id' => 1,
                'dimension_id' => 2,
                'score' => 5,
            ),
            8 => 
            array (
                'id' => 19,
                'referentie_type_id' => 1,
                'dimension_id' => 1,
                'score' => 5,
            ),
            9 => 
            array (
                'id' => 23,
                'referentie_type_id' => 2,
                'dimension_id' => 3,
                'score' => 1,
            ),
            10 => 
            array (
                'id' => 24,
                'referentie_type_id' => 5,
                'dimension_id' => 5,
                'score' => 10,
            ),
        ));
        
        
    }
}