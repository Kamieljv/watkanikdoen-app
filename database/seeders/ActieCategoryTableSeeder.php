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
                'actie_id' => 16,
                'category_id' => 1,
                'id' => 1,
            ),
            1 => 
            array (
                'actie_id' => 16,
                'category_id' => 3,
                'id' => 3,
            ),
            2 => 
            array (
                'actie_id' => 12,
                'category_id' => 1,
                'id' => 4,
            ),
            3 => 
            array (
                'actie_id' => 12,
                'category_id' => 3,
                'id' => 5,
            ),
            4 => 
            array (
                'actie_id' => 11,
                'category_id' => 1,
                'id' => 6,
            ),
            5 => 
            array (
                'actie_id' => 11,
                'category_id' => 2,
                'id' => 7,
            ),
        ));
        
        
    }
}