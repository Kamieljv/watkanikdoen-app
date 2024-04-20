<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('reports')->delete();

        DB::table('reports')->insert(array (
            0 =>
            array (
                'id' => 1,
                'user_id' => 1,
                'organizer_ids' => '1',
                'title' => 'Test report',
                'body' => '<p>Dit is een test</p>',
                'externe_link' => '#',
                'start_date' => '2022-01-19',
                'start_time' => '17:22:00',
                'end_date' => '2022-01-19',
                'end_time' => '17:22:00',
                'location' => null,
                'location_human' => 'Loc',
                'image' => null,
                'status' => 'PENDING',
                'created_at' => '2022-01-19 16:22:36',
                'updated_at' => '2022-01-21 10:35:43',
            ),
            1 =>
            array (
                'id' => 2,
                'user_id' => 1,
                'organizer_ids' => '1',
                'title' => 'Test report 2',
                'body' => '<p>Dit is een test</p>',
                'externe_link' => '#',
                'start_date' => '2022-01-19',
                'start_time' => '17:22:00',
                'end_date' => '2022-01-19',
                'end_time' => '17:22:00',
                'location' => null,
                'location_human' => 'Loc',
                'image' => null,
                'status' => 'APPROVED',
                'created_at' => '2022-01-19 16:22:36',
                'updated_at' => '2022-01-21 10:35:43',
            ),
            2 =>
            array (
                'id' => 3,
                'user_id' => 1,
                'organizer_ids' => '1',
                'title' => 'Test report 3',
                'body' => '<p>Dit is een test</p>',
                'externe_link' => '#',
                'start_date' => '2022-01-19',
                'start_time' => '17:22:00',
                'end_date' => '2022-01-19',
                'end_time' => '17:22:00',
                'location' => null,
                'location_human' => 'Loc',
                'image' => null,
                'status' => 'REJECTED',
                'created_at' => '2022-01-23 15:42:24',
                'updated_at' => '2022-01-21 10:35:43',
            ),
        ));
    }
}
