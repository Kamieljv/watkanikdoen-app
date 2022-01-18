<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('permissions')->delete();

        DB::table('permissions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'key' => 'browse_admin',
                'table_name' => null,
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            1 =>
            array (
                'id' => 2,
                'key' => 'browse_bread',
                'table_name' => null,
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            2 =>
            array (
                'id' => 3,
                'key' => 'browse_database',
                'table_name' => null,
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            3 =>
            array (
                'id' => 4,
                'key' => 'browse_media',
                'table_name' => null,
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            4 =>
            array (
                'id' => 5,
                'key' => 'browse_compass',
                'table_name' => null,
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            5 =>
            array (
                'id' => 6,
                'key' => 'browse_menus',
                'table_name' => 'menus',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            6 =>
            array (
                'id' => 7,
                'key' => 'read_menus',
                'table_name' => 'menus',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            7 =>
            array (
                'id' => 8,
                'key' => 'edit_menus',
                'table_name' => 'menus',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            8 =>
            array (
                'id' => 9,
                'key' => 'add_menus',
                'table_name' => 'menus',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            9 =>
            array (
                'id' => 10,
                'key' => 'delete_menus',
                'table_name' => 'menus',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            10 =>
            array (
                'id' => 11,
                'key' => 'browse_roles',
                'table_name' => 'roles',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            11 =>
            array (
                'id' => 12,
                'key' => 'read_roles',
                'table_name' => 'roles',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            12 =>
            array (
                'id' => 13,
                'key' => 'edit_roles',
                'table_name' => 'roles',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            13 =>
            array (
                'id' => 14,
                'key' => 'add_roles',
                'table_name' => 'roles',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            14 =>
            array (
                'id' => 15,
                'key' => 'delete_roles',
                'table_name' => 'roles',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            15 =>
            array (
                'id' => 16,
                'key' => 'browse_users',
                'table_name' => 'users',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            16 =>
            array (
                'id' => 17,
                'key' => 'read_users',
                'table_name' => 'users',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            17 =>
            array (
                'id' => 18,
                'key' => 'edit_users',
                'table_name' => 'users',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            18 =>
            array (
                'id' => 19,
                'key' => 'add_users',
                'table_name' => 'users',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            19 =>
            array (
                'id' => 20,
                'key' => 'delete_users',
                'table_name' => 'users',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            20 =>
            array (
                'id' => 21,
                'key' => 'browse_settings',
                'table_name' => 'settings',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            21 =>
            array (
                'id' => 22,
                'key' => 'read_settings',
                'table_name' => 'settings',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            22 =>
            array (
                'id' => 23,
                'key' => 'edit_settings',
                'table_name' => 'settings',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            23 =>
            array (
                'id' => 24,
                'key' => 'add_settings',
                'table_name' => 'settings',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            24 =>
            array (
                'id' => 25,
                'key' => 'delete_settings',
                'table_name' => 'settings',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => null,
            ),
            25 =>
            array (
                'id' => 26,
                'key' => 'browse_categories',
                'table_name' => 'categories',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            26 =>
            array (
                'id' => 27,
                'key' => 'read_categories',
                'table_name' => 'categories',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            27 =>
            array (
                'id' => 28,
                'key' => 'edit_categories',
                'table_name' => 'categories',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            28 =>
            array (
                'id' => 29,
                'key' => 'add_categories',
                'table_name' => 'categories',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            29 =>
            array (
                'id' => 30,
                'key' => 'delete_categories',
                'table_name' => 'categories',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            30 =>
            array (
                'id' => 31,
                'key' => 'browse_posts',
                'table_name' => 'posts',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            31 =>
            array (
                'id' => 32,
                'key' => 'read_posts',
                'table_name' => 'posts',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            32 =>
            array (
                'id' => 33,
                'key' => 'edit_posts',
                'table_name' => 'posts',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            33 =>
            array (
                'id' => 34,
                'key' => 'add_posts',
                'table_name' => 'posts',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            34 =>
            array (
                'id' => 35,
                'key' => 'delete_posts',
                'table_name' => 'posts',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            35 =>
            array (
                'id' => 36,
                'key' => 'browse_pages',
                'table_name' => 'pages',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            36 =>
            array (
                'id' => 37,
                'key' => 'read_pages',
                'table_name' => 'pages',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            37 =>
            array (
                'id' => 38,
                'key' => 'edit_pages',
                'table_name' => 'pages',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            38 =>
            array (
                'id' => 39,
                'key' => 'add_pages',
                'table_name' => 'pages',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            39 =>
            array (
                'id' => 40,
                'key' => 'delete_pages',
                'table_name' => 'pages',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            40 =>
            array (
                'id' => 41,
                'key' => 'browse_hooks',
                'table_name' => null,
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => null,
            ),
            41 =>
            array (
                'id' => 42,
                'key' => 'browse_announcements',
                'table_name' => 'announcements',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
                'permission_group_id' => null,
            ),
            42 =>
            array (
                'id' => 43,
                'key' => 'read_announcements',
                'table_name' => 'announcements',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
                'permission_group_id' => null,
            ),
            43 =>
            array (
                'id' => 44,
                'key' => 'edit_announcements',
                'table_name' => 'announcements',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
                'permission_group_id' => null,
            ),
            44 =>
            array (
                'id' => 45,
                'key' => 'add_announcements',
                'table_name' => 'announcements',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
                'permission_group_id' => null,
            ),
            45 =>
            array (
                'id' => 46,
                'key' => 'delete_announcements',
                'table_name' => 'announcements',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
                'permission_group_id' => null,
            ),
            46 =>
            array (
                'id' => 47,
                'key' => 'browse_themes',
                'table_name' => 'admin',
                'created_at' => '2017-11-21 16:31:00',
                'updated_at' => '2017-11-21 16:31:00',
                'permission_group_id' => null,
            ),
            47 =>
            array (
                'id' => 48,
                'key' => 'browse_hooks',
                'table_name' => 'hooks',
                'created_at' => '2018-06-22 13:55:03',
                'updated_at' => '2018-06-22 13:55:03',
                'permission_group_id' => null,
            ),
            48 =>
            array (
                'id' => 49,
                'key' => 'read_hooks',
                'table_name' => 'hooks',
                'created_at' => '2018-06-22 13:55:03',
                'updated_at' => '2018-06-22 13:55:03',
                'permission_group_id' => null,
            ),
            49 =>
            array (
                'id' => 50,
                'key' => 'edit_hooks',
                'table_name' => 'hooks',
                'created_at' => '2018-06-22 13:55:03',
                'updated_at' => '2018-06-22 13:55:03',
                'permission_group_id' => null,
            ),
            50 =>
            array (
                'id' => 51,
                'key' => 'add_hooks',
                'table_name' => 'hooks',
                'created_at' => '2018-06-22 13:55:03',
                'updated_at' => '2018-06-22 13:55:03',
                'permission_group_id' => null,
            ),
            51 =>
            array (
                'id' => 52,
                'key' => 'delete_hooks',
                'table_name' => 'hooks',
                'created_at' => '2018-06-22 13:55:03',
                'updated_at' => '2018-06-22 13:55:03',
                'permission_group_id' => null,
            ),
            52 =>
            array (
                'id' => 53,
                'key' => 'browse_plans',
                'table_name' => 'plans',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
                'permission_group_id' => null,
            ),
            53 =>
            array (
                'id' => 54,
                'key' => 'read_plans',
                'table_name' => 'plans',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
                'permission_group_id' => null,
            ),
            54 =>
            array (
                'id' => 55,
                'key' => 'edit_plans',
                'table_name' => 'plans',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
                'permission_group_id' => null,
            ),
            55 =>
            array (
                'id' => 56,
                'key' => 'add_plans',
                'table_name' => 'plans',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
                'permission_group_id' => null,
            ),
            56 =>
            array (
                'id' => 57,
                'key' => 'delete_plans',
                'table_name' => 'plans',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
                'permission_group_id' => null,
            ),
            57 =>
            array (
                'id' => 58,
                'key' => 'browse_acties',
                'table_name' => 'acties',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-11-24 16:23:01',
                'permission_group_id' => null,
            ),
            58 =>
            array (
                'id' => 59,
                'key' => 'read_acties',
                'table_name' => 'acties',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-11-24 16:23:01',
                'permission_group_id' => null,
            ),
            59 =>
            array (
                'id' => 60,
                'key' => 'edit_acties',
                'table_name' => 'acties',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-11-24 16:23:01',
                'permission_group_id' => null,
            ),
            60 =>
            array (
                'id' => 61,
                'key' => 'add_acties',
                'table_name' => 'acties',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-11-24 16:23:01',
                'permission_group_id' => null,
            ),
            61 =>
            array (
                'id' => 62,
                'key' => 'delete_acties',
                'table_name' => 'acties',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-11-24 16:23:01',
                'permission_group_id' => null,
            ),
            62 =>
            array (
                'id' => 68,
                'key' => 'browse_actie_themes',
                'table_name' => 'actie_themes',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
                'permission_group_id' => null,
            ),
            63 =>
            array (
                'id' => 69,
                'key' => 'read_actie_themes',
                'table_name' => 'actie_themes',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
                'permission_group_id' => null,
            ),
            64 =>
            array (
                'id' => 70,
                'key' => 'edit_actie_themes',
                'table_name' => 'actie_themes',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
                'permission_group_id' => null,
            ),
            65 =>
            array (
                'id' => 71,
                'key' => 'add_actie_themes',
                'table_name' => 'actie_themes',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
                'permission_group_id' => null,
            ),
            66 =>
            array (
                'id' => 72,
                'key' => 'delete_actie_themes',
                'table_name' => 'actie_themes',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
                'permission_group_id' => null,
            ),
            67 =>
            array (
                'id' => 73,
                'key' => 'browse_organizers',
                'table_name' => 'organizers',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
                'permission_group_id' => null,
            ),
            68 =>
            array (
                'id' => 74,
                'key' => 'read_organizers',
                'table_name' => 'organizers',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
                'permission_group_id' => null,
            ),
            69 =>
            array (
                'id' => 75,
                'key' => 'edit_organizers',
                'table_name' => 'organizers',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
                'permission_group_id' => null,
            ),
            70 =>
            array (
                'id' => 76,
                'key' => 'add_organizers',
                'table_name' => 'organizers',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
                'permission_group_id' => null,
            ),
            71 =>
            array (
                'id' => 77,
                'key' => 'delete_organizers',
                'table_name' => 'organizers',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
                'permission_group_id' => null,
            ),
        ));
    }
}
