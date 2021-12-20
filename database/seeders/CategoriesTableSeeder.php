<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'created_at' => '2021-12-20 12:48:31',
                'id' => 6,
                'name' => 'Demonstratie',
                'order' => 1,
                'parent_id' => NULL,
                'slug' => 'demonstratie',
                'updated_at' => '2021-12-20 12:48:31',
            ),
        ));
        
        
    }
}