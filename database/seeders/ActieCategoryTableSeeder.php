<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActieCategoryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('actie_category')->delete();
        
        \DB::table('actie_category')->insert(array (
            0 => 
            array (
                'id' => 1,
                'actie_id' => 16,
                'category_id' => 1,
            ),
            1 => 
            array (
                'id' => 3,
                'actie_id' => 16,
                'category_id' => 3,
            ),
            2 => 
            array (
                'id' => 4,
                'actie_id' => 12,
                'category_id' => 1,
            ),
            3 => 
            array (
                'id' => 5,
                'actie_id' => 12,
                'category_id' => 3,
            ),
            4 => 
            array (
                'id' => 6,
                'actie_id' => 11,
                'category_id' => 1,
            ),
            5 => 
            array (
                'id' => 7,
                'actie_id' => 11,
                'category_id' => 2,
            ),
            6 => 
            array (
                'id' => 8,
                'actie_id' => 17,
                'category_id' => 5,
            ),
        ));
        
        
    }
}