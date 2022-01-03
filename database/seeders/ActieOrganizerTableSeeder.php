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
        ));
        
        
    }
}