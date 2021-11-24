<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('events')->delete();
        
        \DB::table('events')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Klimaatdemo',
                'description' => 'Dit is de lange beschrijving van deze hele leuke klimaatdemo',
                'excerpt' => 'Dit is een klimaatdemo.',         
                'created_at' => '2021-11-24 17:19:36',
                'updated_at' => '2021-11-24 17:19:36',
            ),
        ));
        
        
    }
}