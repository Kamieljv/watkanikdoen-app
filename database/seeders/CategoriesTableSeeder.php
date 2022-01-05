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
                'id' => 6,
                'order' => 1,
                'name' => 'Demonstratie',
                'slug' => 'demonstratie',
                'created_at' => '2021-12-20 12:48:31',
                'updated_at' => '2021-12-20 12:48:31',
            ),
        ));
        
        
    }
}