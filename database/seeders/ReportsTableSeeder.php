<?php

namespace Database\Seeders;

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
        

        \DB::table('reports')->delete();
        
        \DB::table('reports')->insert(array (
            0 => 
            array (
                'actie_id' => NULL,
                'body' => '<p>Dit is een test</p>',
                'created_at' => '2022-01-19 16:22:36',
                'end_date' => '2022-01-19',
                'end_time' => '17:22:00',
                'externe_link' => '#',
                'id' => 1,
                'image' => NULL,
                'location' => NULL,
                'location_human' => 'Loc',
                'organizer_ids' => '1',
                'reporter_notified' => NULL,
                'start_date' => '2022-01-19',
                'start_time' => '17:22:00',
                'status' => 'PENDING',
                'title' => 'Test report',
                'updated_at' => '2022-01-21 10:35:43',
                'user_id' => 1,
            ),
            1 => 
            array (
                'actie_id' => NULL,
                'body' => '<p>Dit is een test</p>',
                'created_at' => '2022-01-19 16:22:36',
                'end_date' => '2022-01-19',
                'end_time' => '17:22:00',
                'externe_link' => '#',
                'id' => 2,
                'image' => NULL,
                'location' => NULL,
                'location_human' => 'Loc',
                'organizer_ids' => '1',
                'reporter_notified' => NULL,
                'start_date' => '2022-01-19',
                'start_time' => '17:22:00',
                'status' => 'APPROVED',
                'title' => 'Test report 2',
                'updated_at' => '2022-01-21 10:35:43',
                'user_id' => 1,
            ),
            2 => 
            array (
                'actie_id' => NULL,
                'body' => '<p>Dit is een test</p>',
                'created_at' => '2022-01-23 15:42:24',
                'end_date' => '2022-01-19',
                'end_time' => '17:22:00',
                'externe_link' => '#',
                'id' => 3,
                'image' => NULL,
                'location' => NULL,
                'location_human' => 'Loc',
                'organizer_ids' => '1',
                'reporter_notified' => NULL,
                'start_date' => '2022-01-19',
                'start_time' => '17:22:00',
                'status' => 'REJECTED',
                'title' => 'Test report 3',
                'updated_at' => '2022-01-21 10:35:43',
                'user_id' => 1,
            ),
        ));
        
        
    }
}