<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActieThemesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('actie_themes')->delete();
        
        \DB::table('actie_themes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'order' => 1,
                'name' => 'Klimaat',
                'slug' => 'klimaat',
                'color' => NULL,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2021-12-06 14:10:08',
            ),
            1 => 
            array (
                'id' => 2,
                'order' => 1,
                'name' => 'Anti-racisme',
                'slug' => 'anti-racisme',
                'color' => NULL,
                'created_at' => '2021-12-06 14:10:20',
                'updated_at' => '2021-12-06 14:10:20',
            ),
            2 => 
            array (
                'id' => 3,
                'order' => 1,
                'name' => 'Dierenrechten',
                'slug' => 'dierenrechten',
                'color' => NULL,
                'created_at' => '2021-12-06 14:10:31',
                'updated_at' => '2021-12-06 14:10:31',
            ),
            3 => 
            array (
                'id' => 4,
                'order' => 1,
                'name' => 'Wonen',
                'slug' => 'wonen',
                'color' => NULL,
                'created_at' => '2021-12-06 14:10:46',
                'updated_at' => '2021-12-06 14:10:46',
            ),
        ));
        
        
    }
}