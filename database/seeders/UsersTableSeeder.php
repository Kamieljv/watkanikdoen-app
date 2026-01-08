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
                'name' => 'Web Admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$VY8t2wYOJOBxvvf5PhmxtO3MMYSOhPLNj9q9EXLnhD.jgvgL0Abd2',
                'verified' => 1,
                'verification_code' => null,
                'email_verified_at' => null,
                'remember_token' => 'E1accom2Xw9MAjECL0g89GHwyWKDD5MAXXZKtVa99XCCh68ThKKeTFhmnfKa',
                'created_at' => '2017-11-21 16:07:22',
                'updated_at' => '2022-01-27 14:59:38',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => '$2y$10$VY8t2wYOJOBxvvf5PhmxtO3MMYSOhPLNj9q9EXLnhD.jgvgL0Abd2',
                'verified' => 1,
                'verification_code' => null,
                'email_verified_at' => null,
                'remember_token' => 'z6b3X6Y2f6nJ5g3p1qW0JH1eXK3D1g4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u',
                'created_at' => '2017-11-21 16:07:22',
                'updated_at' => '2022-01-27 14:59:38',
            ),
        ));
    }
}
