<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ThemesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('themes')->delete();
        
        \DB::table('themes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Klimaat',
                'slug' => 'klimaat',
                'color' => '#61BB0C',
                'created_at' => '2017-11-21 16:23:00',
                'updated_at' => '2022-01-22 15:42:39',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Anti-racisme',
                'slug' => 'anti-racisme',
                'color' => '#F30060',
                'created_at' => '2021-12-06 14:10:00',
                'updated_at' => '2022-01-22 15:43:45',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Dierenrechten',
                'slug' => 'dierenrechten',
                'color' => '#F27A12',
                'created_at' => '2021-12-06 14:10:00',
                'updated_at' => '2022-01-22 15:43:03',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Wonen',
                'slug' => 'wonen',
                'color' => '#3B82F6',
                'created_at' => '2021-12-06 14:10:00',
                'updated_at' => '2022-01-22 15:43:21',
            ),
        ));
        
        
    }
}