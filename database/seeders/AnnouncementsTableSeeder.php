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
                'description' => 'We have just released the first official version of Wave. Click here to learn more!',
                'color' => '#ffc376',
                'url' => '',
                'status' => 'INACTIVE',
                'created_at' => '2018-05-20 23:19:00',
                'updated_at' => '2018-05-21 00:38:02',
            )
        ));
    }
}
