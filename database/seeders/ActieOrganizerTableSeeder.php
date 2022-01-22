<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActieOrganizerTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('actie_organizer')->delete();
        
        \DB::table('actie_organizer')->insert(array (
            0 => 
            array (
                'id' => 1,
                'actie_id' => 17,
                'organizer_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'actie_id' => 12,
                'organizer_id' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'actie_id' => 16,
                'organizer_id' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'actie_id' => 23,
                'organizer_id' => 2,
            ),
            4 => 
            array (
                'id' => 5,
                'actie_id' => 24,
                'organizer_id' => 2,
            ),
            5 => 
            array (
                'id' => 6,
                'actie_id' => 11,
                'organizer_id' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'actie_id' => 19,
                'organizer_id' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'actie_id' => 20,
                'organizer_id' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'actie_id' => 25,
                'organizer_id' => 1,
            ),
            9 => 
            array (
                'id' => 11,
                'actie_id' => 25,
                'organizer_id' => 3,
            ),
        ));
        
        
    }
}