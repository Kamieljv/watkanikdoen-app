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
                'id' => 1,
                'role_id' => 1,
                'name' => 'Web Admin',
                'email' => 'admin@admin.com',
                'username' => 'admin',
                'password' => '$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2',
                'verified' => 1,
                'verification_code' => null,
                'email_verified_at' => null,
                'remember_token' => 'E1accom2Xw9MAjECL0g89GHwyWKDD5MAXXZKtVa99XCCh68ThKKeTFhmnfKa',
                'settings' => '[]',
                'created_at' => '2017-11-21 16:07:22',
                'updated_at' => '2022-01-27 14:59:38',
            ),
            1 =>
            array (
                'id' => 2,
                'role_id' => 3,
                'name' => 'Kamiel',
                'email' => 'kamiel.verhelst@gmail.com',
                'username' => 'kamiel',
                'password' => '$2y$10$ZXArXh63T25DBI57k96.2eyojV23cHX06pU8xaVRlDfXjJzH5pnG6',
                'verified' => 1,
                'verification_code' => null,
                'email_verified_at' => null,
                'remember_token' => null,
                'settings' => '[]',
                'created_at' => '2021-11-24 17:25:15',
                'updated_at' => '2022-01-27 11:46:39',
            ),
        ));
    }
}
