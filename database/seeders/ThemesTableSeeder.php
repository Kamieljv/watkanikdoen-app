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
                'color' => '#709e16',
                'created_at' => '2021-12-06 14:10:00',
                'updated_at' => '2025-02-19 09:28:34',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Vrouwenrechten',
                'slug' => 'vrouwenrechten',
                'color' => '#ff00dd',
                'created_at' => '2022-03-09 10:26:30',
                'updated_at' => '2022-03-09 10:26:30',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Migratie',
                'slug' => 'migratie',
                'color' => '#f57900',
                'created_at' => '2022-04-15 10:17:00',
                'updated_at' => '2025-02-18 19:01:17',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'LGBTQIA+ rechten',
                'slug' => 'LGBTQIAplus-rechten',
                'color' => '#9141ac',
                'created_at' => '2022-05-08 09:36:00',
                'updated_at' => '2022-06-29 18:32:55',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Leefomgeving',
                'slug' => 'Leefomgeving',
                'color' => '#046f00',
                'created_at' => '2022-05-17 18:26:00',
                'updated_at' => '2022-05-17 18:28:38',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Bezetting en kolonialisme',
                'slug' => 'bezetting-en-kolonialisme',
                'color' => '#5e5c64',
                'created_at' => '2022-06-22 10:04:00',
                'updated_at' => '2025-02-18 19:36:29',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Zorg en welzijn',
                'slug' => 'zorg-en-welzijn',
                'color' => '#62a0ea',
                'created_at' => '2022-06-30 17:52:00',
                'updated_at' => '2025-02-18 19:00:44',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Democratie',
                'slug' => 'democratie',
                'color' => '#6312de',
                'created_at' => '2022-07-18 07:33:00',
                'updated_at' => '2022-07-18 07:33:36',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Anti-fascisme',
                'slug' => 'anti-fascisme',
                'color' => '#f90606',
                'created_at' => '2022-10-24 08:31:37',
                'updated_at' => '2022-10-24 08:31:37',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Mensenrechten',
                'slug' => 'mensenrechten',
                'color' => '#f5c211',
                'created_at' => '2023-03-15 10:04:32',
                'updated_at' => '2023-03-15 10:04:32',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Inclusiviteit',
                'slug' => 'inclusiviteit',
                'color' => '#dc8add',
                'created_at' => '2023-06-10 19:09:00',
                'updated_at' => '2025-02-18 20:08:32',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Onderwijs',
                'slug' => 'onderwijs',
                'color' => '#ff7800',
                'created_at' => '2024-11-11 21:43:35',
                'updated_at' => '2024-11-11 21:43:35',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Economie en ongelijkheid',
                'slug' => 'economie-en-ongelijkheid',
                'color' => '#ff0000',
                'created_at' => '2024-11-14 23:30:00',
                'updated_at' => '2025-02-18 18:59:40',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Anti-validisme',
                'slug' => 'anti-validisme',
                'color' => '#813d9c',
                'created_at' => '2025-02-18 20:08:20',
                'updated_at' => '2025-02-18 20:08:20',
            ),
        ));
        
        
    }
}