<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AnnouncementUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('announcement_user')->delete();
        
        \DB::table('announcement_user')->insert(array (
            0 => 
            array (
                'announcement_id' => 1,
                'user_id' => 1,
            ),
            1 => 
            array (
                'announcement_id' => 2,
                'user_id' => 1,
            ),
            2 => 
            array (
                'announcement_id' => 1,
                'user_id' => 2,
            ),
            3 => 
            array (
                'announcement_id' => 2,
                'user_id' => 2,
            ),
            4 => 
            array (
                'announcement_id' => 3,
                'user_id' => 2,
            ),
            5 => 
            array (
                'announcement_id' => 3,
                'user_id' => 1,
            ),
        ));
        
        
    }
}