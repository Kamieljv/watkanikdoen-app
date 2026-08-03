<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('links')->delete();

        DB::table('links')->insert(array (
            0 =>
            array (
                'id' => 2,
                'title' => 'Naar de ActieAgenda',
                'subtitle' => 'voor een actueel overzicht',
                'url' => 'https://watkanikdoen.nl/acties',
                'thumbnail' => null,
                'sort_order' => 0,
                'status' => 'ACTIVE',
                'created_at' => '2026-08-03 09:44:31',
                'updated_at' => '2026-08-03 09:45:49',
            ),
            1 =>
            array (
                'id' => 3,
                'title' => 'Vul de ActieWijzer in',
                'subtitle' => 'Ontdek waar jij iets kan bijdragen',
                'url' => 'https://watkanikdoen.nl/actiewijzer',
                'thumbnail' => null,
                'sort_order' => 1,
                'status' => 'ACTIVE',
                'created_at' => '2026-08-03 09:44:58',
                'updated_at' => '2026-08-03 09:45:21',
            ),
            2 =>
            array (
                'id' => 4,
                'title' => 'Doneren',
                'subtitle' => null,
                'url' => 'https://watkanikdoen.backme.org/',
                'thumbnail' => null,
                'sort_order' => 2,
                'status' => 'ACTIVE',
                'created_at' => '2026-08-03 09:47:10',
                'updated_at' => '2026-08-03 09:47:10',
            ),
            3 =>
            array (
                'id' => 5,
                'title' => 'Word vrijwilliger!',
                'subtitle' => null,
                'url' => 'https://watkanikdoen.nl/word-vrijwilliger',
                'thumbnail' => null,
                'sort_order' => 3,
                'status' => 'ACTIVE',
                'created_at' => '2026-08-03 09:48:18',
                'updated_at' => '2026-08-03 09:48:18',
            ),
            4 =>
            array (
                'id' => 6,
                'title' => 'Watkanikdoen.nl bij FNV Bondcast',
                'subtitle' => null,
                'url' => 'https://open.spotify.com/episode/5XA5IEDwwTiERm1y799pm0?si=3f19508dd0414497&utm_medium=share&utm_source=linktree',
                'thumbnail' => 'links/01KZ3GDTKTSC8HXCHC8HK54DH1.jpg',
                'sort_order' => 4,
                'status' => 'ACTIVE',
                'created_at' => '2026-08-03 09:49:07',
                'updated_at' => '2026-08-03 09:49:07',
            ),
        ));
    }
}
