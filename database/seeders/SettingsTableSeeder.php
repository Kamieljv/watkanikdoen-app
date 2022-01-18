<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('settings')->delete();

        DB::table('settings')->insert(array (
            0 =>
            array (
                'details' => '',
                'display_name' => 'Site Title',
                'group' => 'Site',
                'id' => 1,
                'key' => 'site.title',
                'order' => 1,
                'type' => 'text',
                'value' => 'Wat Kan Ik Doen',
            ),
            1 =>
            array (
                'details' => '',
                'display_name' => 'Site Description',
                'group' => 'Site',
                'id' => 2,
                'key' => 'site.description',
                'order' => 2,
                'type' => 'text',
                'value' => 'Het startpunt voor actief burgerschap!',
            ),
            2 =>
            array (
                'details' => '',
                'display_name' => 'Google Analytics Tracking ID',
                'group' => 'Site',
                'id' => 4,
                'key' => 'site.google_analytics_tracking_id',
                'order' => 4,
                'type' => 'text',
                'value' => null,
            ),
            3 =>
            array (
                'details' => '',
                'display_name' => 'Admin Title',
                'group' => 'Admin',
                'id' => 6,
                'key' => 'admin.title',
                'order' => 1,
                'type' => 'text',
                'value' => 'Admin Paneel',
            ),
            4 =>
            array (
                'details' => '',
                'display_name' => 'Admin Description',
                'group' => 'Admin',
                'id' => 7,
                'key' => 'admin.description',
                'order' => 2,
                'type' => 'text',
                'value' => 'I am the Admin.',
            ),
            5 =>
            array (
                'details' => '',
                'display_name' => 'Admin Loader',
                'group' => 'Admin',
                'id' => 8,
                'key' => 'admin.loader',
                'order' => 3,
                'type' => 'image',
                'value' => '',
            ),
            6 =>
            array (
                'details' => '',
                'display_name' => 'Admin Icon Image',
                'group' => 'Admin',
                'id' => 9,
                'key' => 'admin.icon_image',
                'order' => 4,
                'type' => 'image',
                'value' => '',
            ),
            7 =>
            array (
                'details' => '',
            'display_name' => 'Google Analytics Client ID (used for admin dashboard)',
                'group' => 'Admin',
                'id' => 10,
                'key' => 'admin.google_analytics_client_id',
                'order' => 1,
                'type' => 'text',
                'value' => null,
            ),
            8 =>
            array (
                'details' => null,
                'display_name' => 'Favicon',
                'group' => 'Site',
                'id' => 11,
                'key' => 'site.favicon',
                'order' => 6,
                'type' => 'image',
                'value' => 'settings/November2021/v8BpQnBlBpJSKl2mpuB2.png',
            ),
            9 =>
            array (
                'details' => null,
                'display_name' => 'Homepage Redirect to Dashboard if Logged in',
                'group' => 'Auth',
                'id' => 12,
                'key' => 'auth.dashboard_redirect',
                'order' => 7,
                'type' => 'checkbox',
                'value' => '0',
            ),
            10 =>
            array (
                'details' => '{
"default" : "email",
"options" : {
"email": "Email Address",
"username": "Username"
}
}',
                'display_name' => 'Users Login with Email or Username',
                'group' => 'Auth',
                'id' => 13,
                'key' => 'auth.email_or_username',
                'order' => 8,
                'type' => 'select_dropdown',
                'value' => 'email',
            ),
            11 =>
            array (
                'details' => '{
"default" : "yes",
"options" : {
"yes": "Yes, Include the Username Field when Registering",
"no": "No, Have it automatically generated"
}
}',
                'display_name' => 'Username when Registering',
                'group' => 'Auth',
                'id' => 14,
                'key' => 'auth.username_in_registration',
                'order' => 9,
                'type' => 'select_dropdown',
                'value' => 'no',
            ),
            12 =>
            array (
                'details' => null,
                'display_name' => 'Verify Email during Sign Up',
                'group' => 'Auth',
                'id' => 15,
                'key' => 'auth.verify_email',
                'order' => 10,
                'type' => 'checkbox',
                'value' => '1',
            ),
        ));
    }
}
