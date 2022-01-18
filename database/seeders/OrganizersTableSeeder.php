<?php

namespace Database\Seeders;

use DB;
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


        DB::table('organizers')->delete();

        DB::table('organizers')->insert(array (
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
            1 =>
            array (
                'id' => 2,
                'name' => 'Nederland Wordt Beter',
                'description' => '<p>Dit is een beschrijving van Nederland Wordt Beter.</p>',
                'website' => 'https://nederlandwordtbeter.nl/',
                'logo' => 'organizers/nwb_logo.jpg',
                'slug' => 'nederland-wordt-beter',
                'created_at' => '2022-01-03 16:26:11',
                'updated_at' => '2022-01-03 16:26:11',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Kick Out Zwarte Piet',
                'description' => '<p>Dit is een beschrijving van Kick Out Zwarte Piet.</p>',
                'website' => 'https://kozwartepiet.nl/',
                'logo' => 'organizers/kozp_logo.jpg',
                'slug' => 'kick-out-zwarte-piet',
                'created_at' => '2022-01-03 16:41:14',
                'updated_at' => '2022-01-03 16:41:14',
            ),
        ));
    }
}
