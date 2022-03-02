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

        DB::table('password_resets')->insert(array (
            0 =>
            array (
                'email' => 'kamiel.verhelst@gmail.com',
                'token' => '$2y$10$hg1lo.yO6QTE1XUdlZUZfu74UsX40xYm.Yw4XK7AIgdzOGynPJnjq',
                'created_at' => '2021-11-28 14:59:59',
            ),
        ));
    }
}
