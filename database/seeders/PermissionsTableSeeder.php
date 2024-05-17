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
                'key' => 'browse_reports',
                'table_name' => 'reports',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:46:35',
                'permission_group_id' => NULL,
            ),
            73 => 
            array (
                'id' => 99,
                'key' => 'read_reports',
                'table_name' => 'reports',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:46:35',
                'permission_group_id' => NULL,
            ),
            74 => 
            array (
                'id' => 100,
                'key' => 'edit_reports',
                'table_name' => 'reports',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:46:35',
                'permission_group_id' => NULL,
            ),
            75 => 
            array (
                'id' => 101,
                'key' => 'add_reports',
                'table_name' => 'reports',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:46:35',
                'permission_group_id' => NULL,
            ),
            76 => 
            array (
                'id' => 102,
                'key' => 'delete_reports',
                'table_name' => 'reports',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:46:35',
                'permission_group_id' => NULL,
            ),
            77 => 
            array (
                'id' => 103,
                'key' => 'browse_images',
                'table_name' => 'images',
                'created_at' => '2022-03-09 14:06:44',
                'updated_at' => '2022-03-09 14:06:44',
                'permission_group_id' => NULL,
            ),
            78 => 
            array (
                'id' => 104,
                'key' => 'read_images',
                'table_name' => 'images',
                'created_at' => '2022-03-09 14:06:44',
                'updated_at' => '2022-03-09 14:06:44',
                'permission_group_id' => NULL,
            ),
            79 => 
            array (
                'id' => 105,
                'key' => 'edit_images',
                'table_name' => 'images',
                'created_at' => '2022-03-09 14:06:44',
                'updated_at' => '2022-03-09 14:06:44',
                'permission_group_id' => NULL,
            ),
            80 => 
            array (
                'id' => 106,
                'key' => 'add_images',
                'table_name' => 'images',
                'created_at' => '2022-03-09 14:06:44',
                'updated_at' => '2022-03-09 14:06:44',
                'permission_group_id' => NULL,
            ),
            81 => 
            array (
                'id' => 107,
                'key' => 'delete_images',
                'table_name' => 'images',
                'created_at' => '2022-03-09 14:06:44',
                'updated_at' => '2022-03-09 14:06:44',
                'permission_group_id' => NULL,
            ),
            82 => 
            array (
                'id' => 108,
                'key' => 'browse_answers',
                'table_name' => 'answers',
                'created_at' => '2024-01-26 10:32:49',
                'updated_at' => '2024-01-26 10:32:49',
                'permission_group_id' => NULL,
            ),
            83 => 
            array (
                'id' => 109,
                'key' => 'read_answers',
                'table_name' => 'answers',
                'created_at' => '2024-01-26 10:32:49',
                'updated_at' => '2024-01-26 10:32:49',
                'permission_group_id' => NULL,
            ),
            84 => 
            array (
                'id' => 110,
                'key' => 'edit_answers',
                'table_name' => 'answers',
                'created_at' => '2024-01-26 10:32:49',
                'updated_at' => '2024-01-26 10:32:49',
                'permission_group_id' => NULL,
            ),
            85 => 
            array (
                'id' => 111,
                'key' => 'add_answers',
                'table_name' => 'answers',
                'created_at' => '2024-01-26 10:32:49',
                'updated_at' => '2024-01-26 10:32:49',
                'permission_group_id' => NULL,
            ),
            86 => 
            array (
                'id' => 112,
                'key' => 'delete_answers',
                'table_name' => 'answers',
                'created_at' => '2024-01-26 10:32:49',
                'updated_at' => '2024-01-26 10:32:49',
                'permission_group_id' => NULL,
            ),
            87 => 
            array (
                'id' => 113,
                'key' => 'browse_questions',
                'table_name' => 'questions',
                'created_at' => '2024-01-26 10:33:05',
                'updated_at' => '2024-01-26 10:33:05',
                'permission_group_id' => NULL,
            ),
            88 => 
            array (
                'id' => 114,
                'key' => 'read_questions',
                'table_name' => 'questions',
                'created_at' => '2024-01-26 10:33:05',
                'updated_at' => '2024-01-26 10:33:05',
                'permission_group_id' => NULL,
            ),
            89 => 
            array (
                'id' => 115,
                'key' => 'edit_questions',
                'table_name' => 'questions',
                'created_at' => '2024-01-26 10:33:05',
                'updated_at' => '2024-01-26 10:33:05',
                'permission_group_id' => NULL,
            ),
            90 => 
            array (
                'id' => 116,
                'key' => 'add_questions',
                'table_name' => 'questions',
                'created_at' => '2024-01-26 10:33:05',
                'updated_at' => '2024-01-26 10:33:05',
                'permission_group_id' => NULL,
            ),
            91 => 
            array (
                'id' => 117,
                'key' => 'delete_questions',
                'table_name' => 'questions',
                'created_at' => '2024-01-26 10:33:05',
                'updated_at' => '2024-01-26 10:33:05',
                'permission_group_id' => NULL,
            ),
            92 => 
            array (
                'id' => 118,
                'key' => 'browse_dimensions',
                'table_name' => 'dimensions',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
                'permission_group_id' => NULL,
            ),
            93 => 
            array (
                'id' => 119,
                'key' => 'read_dimensions',
                'table_name' => 'dimensions',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
                'permission_group_id' => NULL,
            ),
            94 => 
            array (
                'id' => 120,
                'key' => 'edit_dimensions',
                'table_name' => 'dimensions',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
                'permission_group_id' => NULL,
            ),
            95 => 
            array (
                'id' => 121,
                'key' => 'add_dimensions',
                'table_name' => 'dimensions',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
                'permission_group_id' => NULL,
            ),
            96 => 
            array (
                'id' => 122,
                'key' => 'delete_dimensions',
                'table_name' => 'dimensions',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
                'permission_group_id' => NULL,
            ),
            97 => 
            array (
                'id' => 123,
                'key' => 'browse_referenties',
                'table_name' => 'referenties',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
                'permission_group_id' => NULL,
            ),
            98 => 
            array (
                'id' => 124,
                'key' => 'read_referenties',
                'table_name' => 'referenties',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
                'permission_group_id' => NULL,
            ),
            99 => 
            array (
                'id' => 125,
                'key' => 'edit_referenties',
                'table_name' => 'referenties',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
                'permission_group_id' => NULL,
            ),
            100 => 
            array (
                'id' => 126,
                'key' => 'add_referenties',
                'table_name' => 'referenties',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
                'permission_group_id' => NULL,
            ),
            101 => 
            array (
                'id' => 127,
                'key' => 'delete_referenties',
                'table_name' => 'referenties',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
                'permission_group_id' => NULL,
            ),
            102 => 
            array (
                'id' => 128,
                'key' => 'browse_referentie_types',
                'table_name' => 'referentie_types',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
                'permission_group_id' => NULL,
            ),
            103 => 
            array (
                'id' => 129,
                'key' => 'read_referentie_types',
                'table_name' => 'referentie_types',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
                'permission_group_id' => NULL,
            ),
            104 => 
            array (
                'id' => 130,
                'key' => 'edit_referentie_types',
                'table_name' => 'referentie_types',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
                'permission_group_id' => NULL,
            ),
            105 => 
            array (
                'id' => 131,
                'key' => 'add_referentie_types',
                'table_name' => 'referentie_types',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
                'permission_group_id' => NULL,
            ),
            106 => 
            array (
                'id' => 132,
                'key' => 'delete_referentie_types',
                'table_name' => 'referentie_types',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
                'permission_group_id' => NULL,
            ),
        ));
        
        
    }
}