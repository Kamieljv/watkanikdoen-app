<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class PasswordResetsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('password_resets')->delete();
    }
}
