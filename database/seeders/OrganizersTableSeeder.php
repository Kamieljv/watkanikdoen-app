<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrganizersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('organizers')->delete();
        
        \DB::table('organizers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Greenpeace',
                'description' => '<p>This is a description for Greenpeace.</p>',
                'website' => 'https://greenpeace.com',
                'logo' => 'organizers/greenpeace_logo.jpg',
                'slug' => 'greenpeace',
                'created_at' => '2022-01-03 15:57:37',
                'updated_at' => '2022-01-03 15:57:37',
            ),
        ));
        
        
    }
}