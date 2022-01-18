<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('notifications')->delete();

        DB::table('notifications')->insert(array (
            0 =>
            array (
                'created_at' => '2021-11-24 19:51:26',
                'data' => '{"title":"My Title Here","icon":"\\/storage\\/users\\/default.png","body":"This is the body content of the notification... Yada yada yada","link":"https:\\/\\/google.com"}',
                'id' => '79464b41-6384-4430-859d-eaff154c227d',
                'notifiable_id' => 1,
                'notifiable_type' => 'users',
                'read_at' => null,
                'type' => 'App\\Notifications\\TestNotification',
                'updated_at' => '2021-11-24 19:51:26',
            ),
        ));
    }
}
