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
                'color' => NULL,
                'created_at' => '2017-11-21 16:23:22',
                'id' => 1,
                'name' => 'Klimaat',
                'order' => 1,
                'slug' => 'klimaat',
                'updated_at' => '2021-12-06 14:10:08',
            ),
            1 => 
            array (
                'color' => NULL,
                'created_at' => '2021-12-06 14:10:20',
                'id' => 2,
                'name' => 'Anti-racisme',
                'order' => 1,
                'slug' => 'anti-racisme',
                'updated_at' => '2021-12-06 14:10:20',
            ),
            2 => 
            array (
                'color' => NULL,
                'created_at' => '2021-12-06 14:10:31',
                'id' => 3,
                'name' => 'Dierenrechten',
                'order' => 1,
                'slug' => 'dierenrechten',
                'updated_at' => '2021-12-06 14:10:31',
            ),
            3 => 
            array (
                'color' => NULL,
                'created_at' => '2021-12-06 14:10:46',
                'id' => 4,
                'name' => 'Wonen',
                'order' => 1,
                'slug' => 'wonen',
                'updated_at' => '2021-12-06 14:10:46',
            ),
        ));
        
        
    }
}