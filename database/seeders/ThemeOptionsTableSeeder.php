<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class ThemeOptionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('theme_options')->delete();

        DB::table('theme_options')->insert(array (
            0 =>
            array (
                'created_at' => '2017-11-22 16:54:46',
                'id' => 17,
                'key' => 'logo',
                'theme_id' => 1,
                'updated_at' => '2018-02-11 05:02:40',
                'value' => '',
            ),
            1 =>
            array (
                'created_at' => '2017-11-25 17:31:45',
                'id' => 18,
                'key' => 'home_headline',
                'theme_id' => 1,
                'updated_at' => '2018-08-28 00:17:41',
                'value' => 'Welcome to Wave',
            ),
            2 =>
            array (
                'created_at' => '2017-11-25 17:31:45',
                'id' => 19,
                'key' => 'home_subheadline',
                'theme_id' => 1,
                'updated_at' => '2017-11-26 07:11:47',
                'value' => 'Start crafting your next great idea.',
            ),
            3 =>
            array (
                'created_at' => '2017-11-25 17:31:45',
                'id' => 20,
                'key' => 'home_description',
                'theme_id' => 1,
                'updated_at' => '2017-11-26 07:09:50',
                'value' => 'Wave will help you rapidly build a Software as a Service. Out of the box Authentication, Subscriptions, Invoices, Announcements, User Profiles, API, and so much more!',
            ),
            4 =>
            array (
                'created_at' => '2017-11-25 20:02:29',
                'id' => 21,
                'key' => 'home_cta',
                'theme_id' => 1,
                'updated_at' => '2020-10-23 20:17:25',
                'value' => 'Signup',
            ),
            5 =>
            array (
                'created_at' => '2017-11-25 20:09:33',
                'id' => 22,
                'key' => 'home_cta_url',
                'theme_id' => 1,
                'updated_at' => '2017-11-26 16:12:41',
                'value' => '/register',
            ),
            6 =>
            array (
                'created_at' => '2017-11-25 21:36:46',
                'id' => 23,
                'key' => 'home_promo_image',
                'theme_id' => 1,
                'updated_at' => '2017-11-29 01:17:00',
                'value' => 'themes/February2018/mFajn4fwpGFXzI1UsNH6.png',
            ),
            7 =>
            array (
                'created_at' => '2018-08-28 23:12:11',
                'id' => 24,
                'key' => 'footer_logo',
                'theme_id' => 1,
                'updated_at' => '2018-08-28 23:12:11',
                'value' => 'themes/August2018/TksmVWMqp5JXUQj8C6Ct.png',
            ),
        ));
    }
}
