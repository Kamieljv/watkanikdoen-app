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
                'id' => 1,
                'name' => 'Demonstratie',
                'slug' => 'demonstratie',
                'updated_at' => '2021-12-20 12:48:31',
            ),
            1 => 
            array (
                'created_at' => '2022-04-24 15:36:45',
                'id' => 2,
                'name' => 'Petitie',
                'slug' => 'petitie',
                'updated_at' => '2022-04-24 15:36:45',
            ),
        ));
        
        
    }
}