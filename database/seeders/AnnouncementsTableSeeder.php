<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class AnnouncementsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('announcements')->delete();

        DB::table('announcements')->insert(array (
            0 =>
            array (
                'id' => 1,
                'title' => 'Announcement',
                'description' => 'This is a test announcement!',
                'color' => '#ffc376',
                'url' => 'https://watkanikdoen.nl',
                'status' => 'INACTIVE',
                'created_at' => '2018-05-20 23:19:00',
                'updated_at' => '2018-05-21 00:38:02',
            )
        ));
    }
}
