<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'name' => 'Wave Admin',
                'email' => 'admin@admin.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2',
                'remember_token' => '4dVky594gnv7bhHB9eUTyrxm7aYLDvblM3iGhBbUuZbItY4drfeApv5jf4mD',
                'settings' => NULL,
                'created_at' => '2017-11-21 16:07:22',
                'updated_at' => '2018-09-22 23:34:02',
                'username' => 'admin',
                'stripe_id' => NULL,
                'card_brand' => NULL,
                'card_last_four' => NULL,
                'trial_ends_at' => NULL,
                'verification_code' => NULL,
                'verified' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'role_id' => 3,
                'name' => 'Kamiel',
                'email' => 'kamiel.verhelst@gmail.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => '2021-11-24 19:32:43',
                'password' => '$2y$10$ZXArXh63T25DBI57k96.2eyojV23cHX06pU8xaVRlDfXjJzH5pnG6',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2021-11-24 17:25:15',
                'updated_at' => '2021-11-24 19:32:43',
                'username' => 'kamiel',
                'stripe_id' => NULL,
                'card_brand' => NULL,
                'card_last_four' => NULL,
                'trial_ends_at' => NULL,
                'verification_code' => NULL,
                'verified' => 1,
            ),
        ));
        
        
    }
}