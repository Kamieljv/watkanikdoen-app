<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AanmeldingenTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('aanmeldingen')->delete();
        
        \DB::table('aanmeldingen')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'title' => 'Test aanmelding',
                'body' => '<p>Dit is een test</p>',
                'externe_link' => '#',
                'time_start' => '2022-01-19 17:22:00',
                'time_end' => '2022-01-19 17:22:00',
                'location' => NULL,
                'location_human' => 'Loc',
                'image' => NULL,
                'status' => 'PENDING',
                'created_at' => '2022-01-19 16:22:36',
                'updated_at' => '2022-01-19 16:22:36',
            ),
        ));
        
        
    }
}