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
            )
        ));
    }
}
