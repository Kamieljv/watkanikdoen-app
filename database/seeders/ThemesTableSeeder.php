<?php

namespace Database\Seeders;

use DB;
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


        DB::table('themes')->delete();

        DB::table('themes')->insert(array (
            0 =>
            array (
                'active' => 0,
                'created_at' => '2020-08-23 08:06:45',
                'folder' => 'tailwind',
                'id' => 1,
                'name' => 'Tailwind Theme',
                'updated_at' => '2021-11-26 17:08:54',
                'version' => '1.0',
            ),
            1 =>
            array (
                'active' => 1,
                'created_at' => '2021-11-26 16:57:37',
                'folder' => 'custom',
                'id' => 2,
                'name' => 'Custom Theme',
                'updated_at' => '2021-11-26 17:08:54',
                'version' => '1.0',
            ),
        ));
    }
}
