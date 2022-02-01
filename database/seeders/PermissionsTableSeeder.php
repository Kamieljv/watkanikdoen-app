<?php

namespace Database\Seeders;

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
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'browse_admin',
                'table_name' => NULL,
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'browse_bread',
                'table_name' => NULL,
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'browse_database',
                'table_name' => NULL,
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'browse_media',
                'table_name' => NULL,
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'browse_compass',
                'table_name' => NULL,
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'browse_menus',
                'table_name' => 'menus',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'read_menus',
                'table_name' => 'menus',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'edit_menus',
                'table_name' => 'menus',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'add_menus',
                'table_name' => 'menus',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'delete_menus',
                'table_name' => 'menus',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'browse_roles',
                'table_name' => 'roles',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'read_roles',
                'table_name' => 'roles',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'edit_roles',
                'table_name' => 'roles',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'add_roles',
                'table_name' => 'roles',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'delete_roles',
                'table_name' => 'roles',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'browse_users',
                'table_name' => 'users',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'read_users',
                'table_name' => 'users',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'edit_users',
                'table_name' => 'users',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'key' => 'add_users',
                'table_name' => 'users',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'key' => 'delete_users',
                'table_name' => 'users',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'key' => 'browse_settings',
                'table_name' => 'settings',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'key' => 'read_settings',
                'table_name' => 'settings',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'key' => 'edit_settings',
                'table_name' => 'settings',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'key' => 'add_settings',
                'table_name' => 'settings',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'key' => 'delete_settings',
                'table_name' => 'settings',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
                'permission_group_id' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'key' => 'browse_categories',
                'table_name' => 'categories',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'key' => 'read_categories',
                'table_name' => 'categories',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'key' => 'edit_categories',
                'table_name' => 'categories',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'key' => 'add_categories',
                'table_name' => 'categories',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'key' => 'delete_categories',
                'table_name' => 'categories',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'key' => 'browse_posts',
                'table_name' => 'posts',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'key' => 'read_posts',
                'table_name' => 'posts',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'key' => 'edit_posts',
                'table_name' => 'posts',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'key' => 'add_posts',
                'table_name' => 'posts',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'key' => 'delete_posts',
                'table_name' => 'posts',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'key' => 'browse_pages',
                'table_name' => 'pages',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'key' => 'read_pages',
                'table_name' => 'pages',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'key' => 'edit_pages',
                'table_name' => 'pages',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'key' => 'add_pages',
                'table_name' => 'pages',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'key' => 'delete_pages',
                'table_name' => 'pages',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'key' => 'browse_hooks',
                'table_name' => NULL,
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
                'permission_group_id' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'key' => 'browse_announcements',
                'table_name' => 'announcements',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
                'permission_group_id' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'key' => 'read_announcements',
                'table_name' => 'announcements',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
                'permission_group_id' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'key' => 'edit_announcements',
                'table_name' => 'announcements',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
                'permission_group_id' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'key' => 'add_announcements',
                'table_name' => 'announcements',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
                'permission_group_id' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'key' => 'delete_announcements',
                'table_name' => 'announcements',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
                'permission_group_id' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'key' => 'browse_themes',
                'table_name' => 'admin',
                'created_at' => '2017-11-21 16:31:00',
                'updated_at' => '2017-11-21 16:31:00',
                'permission_group_id' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'key' => 'browse_hooks',
                'table_name' => 'hooks',
                'created_at' => '2018-06-22 13:55:03',
                'updated_at' => '2018-06-22 13:55:03',
                'permission_group_id' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'key' => 'read_hooks',
                'table_name' => 'hooks',
                'created_at' => '2018-06-22 13:55:03',
                'updated_at' => '2018-06-22 13:55:03',
                'permission_group_id' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'key' => 'edit_hooks',
                'table_name' => 'hooks',
                'created_at' => '2018-06-22 13:55:03',
                'updated_at' => '2018-06-22 13:55:03',
                'permission_group_id' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'key' => 'add_hooks',
                'table_name' => 'hooks',
                'created_at' => '2018-06-22 13:55:03',
                'updated_at' => '2018-06-22 13:55:03',
                'permission_group_id' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'key' => 'delete_hooks',
                'table_name' => 'hooks',
                'created_at' => '2018-06-22 13:55:03',
                'updated_at' => '2018-06-22 13:55:03',
                'permission_group_id' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'key' => 'browse_plans',
                'table_name' => 'plans',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
                'permission_group_id' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'key' => 'read_plans',
                'table_name' => 'plans',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
                'permission_group_id' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'key' => 'edit_plans',
                'table_name' => 'plans',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
                'permission_group_id' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'key' => 'add_plans',
                'table_name' => 'plans',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
                'permission_group_id' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'key' => 'delete_plans',
                'table_name' => 'plans',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
                'permission_group_id' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'key' => 'browse_acties',
                'table_name' => 'acties',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-11-24 16:23:01',
                'permission_group_id' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'key' => 'read_acties',
                'table_name' => 'acties',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-11-24 16:23:01',
                'permission_group_id' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'key' => 'edit_acties',
                'table_name' => 'acties',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-11-24 16:23:01',
                'permission_group_id' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'key' => 'add_acties',
                'table_name' => 'acties',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-11-24 16:23:01',
                'permission_group_id' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'key' => 'delete_acties',
                'table_name' => 'acties',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-11-24 16:23:01',
                'permission_group_id' => NULL,
            ),
            62 => 
            array (
                'id' => 68,
                'key' => 'browse_themes',
                'table_name' => 'themes',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
                'permission_group_id' => NULL,
            ),
            63 => 
            array (
                'id' => 69,
                'key' => 'read_themes',
                'table_name' => 'themes',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
                'permission_group_id' => NULL,
            ),
            64 => 
            array (
                'id' => 70,
                'key' => 'edit_themes',
                'table_name' => 'themes',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
                'permission_group_id' => NULL,
            ),
            65 => 
            array (
                'id' => 71,
                'key' => 'add_themes',
                'table_name' => 'themes',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
                'permission_group_id' => NULL,
            ),
            66 => 
            array (
                'id' => 72,
                'key' => 'delete_themes',
                'table_name' => 'themes',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
                'permission_group_id' => NULL,
            ),
            67 => 
            array (
                'id' => 73,
                'key' => 'browse_organizers',
                'table_name' => 'organizers',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
                'permission_group_id' => NULL,
            ),
            68 => 
            array (
                'id' => 74,
                'key' => 'read_organizers',
                'table_name' => 'organizers',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
                'permission_group_id' => NULL,
            ),
            69 => 
            array (
                'id' => 75,
                'key' => 'edit_organizers',
                'table_name' => 'organizers',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
                'permission_group_id' => NULL,
            ),
            70 => 
            array (
                'id' => 76,
                'key' => 'add_organizers',
                'table_name' => 'organizers',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
                'permission_group_id' => NULL,
            ),
            71 => 
            array (
                'id' => 77,
                'key' => 'delete_organizers',
                'table_name' => 'organizers',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
                'permission_group_id' => NULL,
            ),
            72 => 
            array (
                'id' => 98,
                'key' => 'browse_aanmeldingen',
                'table_name' => 'aanmeldingen',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:46:35',
                'permission_group_id' => NULL,
            ),
            73 => 
            array (
                'id' => 99,
                'key' => 'read_aanmeldingen',
                'table_name' => 'aanmeldingen',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:46:35',
                'permission_group_id' => NULL,
            ),
            74 => 
            array (
                'id' => 100,
                'key' => 'edit_aanmeldingen',
                'table_name' => 'aanmeldingen',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:46:35',
                'permission_group_id' => NULL,
            ),
            75 => 
            array (
                'id' => 101,
                'key' => 'add_aanmeldingen',
                'table_name' => 'aanmeldingen',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:46:35',
                'permission_group_id' => NULL,
            ),
            76 => 
            array (
                'id' => 102,
                'key' => 'delete_aanmeldingen',
                'table_name' => 'aanmeldingen',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:46:35',
                'permission_group_id' => NULL,
            ),
        ));
        
        
    }
}