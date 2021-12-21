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
                'id' => 11,
                'actie_id' => 16,
                'category_id' => 6,
            ),
            1 => 
            array (
                'id' => 12,
                'actie_id' => 17,
                'category_id' => 6,
            ),
            2 => 
            array (
                'id' => 13,
                'actie_id' => 12,
                'category_id' => 6,
            ),
            3 => 
            array (
                'id' => 14,
                'actie_id' => 11,
                'category_id' => 6,
            ),
        ));
        
        
    }
}