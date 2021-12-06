<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'created_at' => '2017-11-21 16:23:22',
                'display_name' => 'Admin User',
                'id' => 1,
                'name' => 'admin',
                'updated_at' => '2017-11-21 16:23:22',
            ),
            1 => 
            array (
                'created_at' => '2018-07-03 05:03:21',
                'display_name' => 'Basic Plan',
                'id' => 3,
                'name' => 'basic',
                'updated_at' => '2018-07-03 17:28:44',
            ),
            2 => 
            array (
                'created_at' => '2018-07-03 16:28:42',
                'display_name' => 'Cancelled User',
                'id' => 6,
                'name' => 'cancelled',
                'updated_at' => '2018-07-03 17:28:32',
            ),
        ));
        
        
    }
}