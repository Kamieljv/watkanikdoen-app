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
                'created_at' => '2017-11-21 16:23:22',
                'id' => 1,
                'name' => 'Demonstratie',
                'order' => 1,
                'parent_id' => NULL,
                'slug' => 'demonstratie',
                'updated_at' => '2021-12-06 14:09:54',
            ),
            1 => 
            array (
                'created_at' => '2017-11-21 16:23:22',
                'id' => 2,
                'name' => 'Klimaat',
                'order' => 1,
                'parent_id' => NULL,
                'slug' => 'klimaat',
                'updated_at' => '2021-12-06 14:10:08',
            ),
            2 => 
            array (
                'created_at' => '2021-12-06 14:10:20',
                'id' => 3,
                'name' => 'Racisme',
                'order' => 1,
                'parent_id' => NULL,
                'slug' => 'racisme',
                'updated_at' => '2021-12-06 14:10:20',
            ),
            3 => 
            array (
                'created_at' => '2021-12-06 14:10:31',
                'id' => 4,
                'name' => 'Dierenrechten',
                'order' => 1,
                'parent_id' => NULL,
                'slug' => 'dierenrechten',
                'updated_at' => '2021-12-06 14:10:31',
            ),
            4 => 
            array (
                'created_at' => '2021-12-06 14:10:46',
                'id' => 5,
                'name' => 'Wonen',
                'order' => 1,
                'parent_id' => NULL,
                'slug' => 'wonen',
                'updated_at' => '2021-12-06 14:10:46',
            ),
        ));
        
        
    }
}