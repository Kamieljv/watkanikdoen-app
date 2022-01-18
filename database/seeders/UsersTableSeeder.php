<?php

namespace Database\Seeders;

use DB;
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


        DB::table('users')->delete();

        DB::table('users')->insert(array (
            0 =>
            array (
                'avatar' => 'users/default.png',
                'card_brand' => null,
                'card_last_four' => null,
                'created_at' => '2017-11-21 16:07:22',
                'email' => 'admin@admin.com',
                'email_verified_at' => null,
                'id' => 1,
                'name' => 'Web Admin',
                'password' => '$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2',
                'remember_token' => 'sJWx4waSFBg9nePNMBNbRXm6ct04ezt4Xq4f2Uhzk7kMFYa05sgBUvUTqwOt',
                'role_id' => 1,
                'settings' => '{"locale":null}',
                'stripe_id' => null,
                'trial_ends_at' => null,
                'updated_at' => '2021-11-24 19:43:28',
                'username' => 'admin',
                'verification_code' => null,
                'verified' => 1,
            ),
            1 =>
            array (
                'avatar' => 'avatars/kamiel.png',
                'card_brand' => null,
                'card_last_four' => null,
                'created_at' => '2021-11-24 17:25:15',
                'email' => 'kamiel.verhelst@gmail.com',
                'email_verified_at' => '2021-11-24 19:32:43',
                'id' => 2,
                'name' => 'Kamiel',
                'password' => '$2y$10$ZXArXh63T25DBI57k96.2eyojV23cHX06pU8xaVRlDfXjJzH5pnG6',
                'remember_token' => null,
                'role_id' => 3,
                'settings' => null,
                'stripe_id' => null,
                'trial_ends_at' => null,
                'updated_at' => '2021-11-29 09:53:29',
                'username' => 'kamiel',
                'verification_code' => null,
                'verified' => 1,
            ),
        ));
    }
}
