<?php

namespace Database\Seeders;

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
        

        \DB::table('theme_options')->delete();
        
        \DB::table('theme_options')->insert(array (
            0 => 
            array (
                'id' => 17,
                'theme_id' => 1,
                'key' => 'logo',
                'value' => '',
                'created_at' => '2017-11-22 16:54:46',
                'updated_at' => '2018-02-11 05:02:40',
            ),
            1 => 
            array (
                'id' => 18,
                'theme_id' => 1,
                'key' => 'home_headline',
                'value' => 'Welcome to Wave',
                'created_at' => '2017-11-25 17:31:45',
                'updated_at' => '2018-08-28 00:17:41',
            ),
            2 => 
            array (
                'id' => 19,
                'theme_id' => 1,
                'key' => 'home_subheadline',
                'value' => 'Start crafting your next great idea.',
                'created_at' => '2017-11-25 17:31:45',
                'updated_at' => '2017-11-26 07:11:47',
            ),
            3 => 
            array (
                'id' => 20,
                'theme_id' => 1,
                'key' => 'home_description',
                'value' => 'Wave will help you rapidly build a Software as a Service. Out of the box Authentication, Subscriptions, Invoices, Announcements, User Profiles, API, and so much more!',
                'created_at' => '2017-11-25 17:31:45',
                'updated_at' => '2017-11-26 07:09:50',
            ),
            4 => 
            array (
                'id' => 21,
                'theme_id' => 1,
                'key' => 'home_cta',
                'value' => 'Signup',
                'created_at' => '2017-11-25 20:02:29',
                'updated_at' => '2020-10-23 20:17:25',
            ),
            5 => 
            array (
                'id' => 22,
                'theme_id' => 1,
                'key' => 'home_cta_url',
                'value' => '/register',
                'created_at' => '2017-11-25 20:09:33',
                'updated_at' => '2017-11-26 16:12:41',
            ),
            6 => 
            array (
                'id' => 23,
                'theme_id' => 1,
                'key' => 'home_promo_image',
                'value' => 'themes/February2018/mFajn4fwpGFXzI1UsNH6.png',
                'created_at' => '2017-11-25 21:36:46',
                'updated_at' => '2017-11-29 01:17:00',
            ),
            7 => 
            array (
                'id' => 24,
                'theme_id' => 1,
                'key' => 'footer_logo',
                'value' => 'themes/August2018/TksmVWMqp5JXUQj8C6Ct.png',
                'created_at' => '2018-08-28 23:12:11',
                'updated_at' => '2018-08-28 23:12:11',
            ),
            8 => 
            array (
                'id' => 25,
                'theme_id' => 2,
                'key' => 'home_headline',
                'value' => NULL,
                'created_at' => '2021-12-14 12:23:05',
                'updated_at' => '2021-12-14 12:23:05',
            ),
            9 => 
            array (
                'id' => 26,
                'theme_id' => 2,
                'key' => 'home_subheadline',
                'value' => NULL,
                'created_at' => '2021-12-14 12:23:05',
                'updated_at' => '2021-12-14 12:23:05',
            ),
            10 => 
            array (
                'id' => 27,
                'theme_id' => 2,
                'key' => 'home_description',
                'value' => NULL,
                'created_at' => '2021-12-14 12:23:05',
                'updated_at' => '2021-12-14 12:23:05',
            ),
            11 => 
            array (
                'id' => 28,
                'theme_id' => 2,
                'key' => 'home_cta',
                'value' => NULL,
                'created_at' => '2021-12-14 12:23:05',
                'updated_at' => '2021-12-14 12:23:05',
            ),
            12 => 
            array (
                'id' => 29,
                'theme_id' => 2,
                'key' => 'home_cta_url',
                'value' => NULL,
                'created_at' => '2021-12-14 12:23:05',
                'updated_at' => '2021-12-14 12:23:05',
            ),
            13 => 
            array (
                'id' => 30,
                'theme_id' => 2,
                'key' => 'logo',
                'value' => 'themes/December2021/NyenZgLPF9lVeXFg9uAh.png',
                'created_at' => '2021-12-14 12:23:05',
                'updated_at' => '2021-12-14 12:23:05',
            ),
            14 => 
            array (
                'id' => 31,
                'theme_id' => 2,
                'key' => 'footer_logo',
                'value' => 'themes/December2021/WyyPQIqht2O9BDTBD5YI.png',
                'created_at' => '2021-12-14 12:23:19',
                'updated_at' => '2021-12-14 12:23:19',
            ),
        ));
        
        
    }
}