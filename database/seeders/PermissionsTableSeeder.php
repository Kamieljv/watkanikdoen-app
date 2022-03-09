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
                'created_at' => '2018-06-22 20:15:45',
                'id' => 1,
                'key' => 'browse_admin',
                'permission_group_id' => NULL,
                'table_name' => NULL,
                'updated_at' => '2018-06-22 20:15:45',
            ),
            1 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 2,
                'key' => 'browse_bread',
                'permission_group_id' => NULL,
                'table_name' => NULL,
                'updated_at' => '2018-06-22 20:15:45',
            ),
            2 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 3,
                'key' => 'browse_database',
                'permission_group_id' => NULL,
                'table_name' => NULL,
                'updated_at' => '2018-06-22 20:15:45',
            ),
            3 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 4,
                'key' => 'browse_media',
                'permission_group_id' => NULL,
                'table_name' => NULL,
                'updated_at' => '2018-06-22 20:15:45',
            ),
            4 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 5,
                'key' => 'browse_compass',
                'permission_group_id' => NULL,
                'table_name' => NULL,
                'updated_at' => '2018-06-22 20:15:45',
            ),
            5 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 6,
                'key' => 'browse_menus',
                'permission_group_id' => NULL,
                'table_name' => 'menus',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            6 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 7,
                'key' => 'read_menus',
                'permission_group_id' => NULL,
                'table_name' => 'menus',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            7 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 8,
                'key' => 'edit_menus',
                'permission_group_id' => NULL,
                'table_name' => 'menus',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            8 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 9,
                'key' => 'add_menus',
                'permission_group_id' => NULL,
                'table_name' => 'menus',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            9 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 10,
                'key' => 'delete_menus',
                'permission_group_id' => NULL,
                'table_name' => 'menus',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            10 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 11,
                'key' => 'browse_roles',
                'permission_group_id' => NULL,
                'table_name' => 'roles',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            11 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 12,
                'key' => 'read_roles',
                'permission_group_id' => NULL,
                'table_name' => 'roles',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            12 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 13,
                'key' => 'edit_roles',
                'permission_group_id' => NULL,
                'table_name' => 'roles',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            13 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 14,
                'key' => 'add_roles',
                'permission_group_id' => NULL,
                'table_name' => 'roles',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            14 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 15,
                'key' => 'delete_roles',
                'permission_group_id' => NULL,
                'table_name' => 'roles',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            15 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 16,
                'key' => 'browse_users',
                'permission_group_id' => NULL,
                'table_name' => 'users',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            16 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 17,
                'key' => 'read_users',
                'permission_group_id' => NULL,
                'table_name' => 'users',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            17 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 18,
                'key' => 'edit_users',
                'permission_group_id' => NULL,
                'table_name' => 'users',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            18 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 19,
                'key' => 'add_users',
                'permission_group_id' => NULL,
                'table_name' => 'users',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            19 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 20,
                'key' => 'delete_users',
                'permission_group_id' => NULL,
                'table_name' => 'users',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            20 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 21,
                'key' => 'browse_settings',
                'permission_group_id' => NULL,
                'table_name' => 'settings',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            21 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 22,
                'key' => 'read_settings',
                'permission_group_id' => NULL,
                'table_name' => 'settings',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            22 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 23,
                'key' => 'edit_settings',
                'permission_group_id' => NULL,
                'table_name' => 'settings',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            23 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 24,
                'key' => 'add_settings',
                'permission_group_id' => NULL,
                'table_name' => 'settings',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            24 => 
            array (
                'created_at' => '2018-06-22 20:15:45',
                'id' => 25,
                'key' => 'delete_settings',
                'permission_group_id' => NULL,
                'table_name' => 'settings',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            25 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 26,
                'key' => 'browse_categories',
                'permission_group_id' => NULL,
                'table_name' => 'categories',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            26 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 27,
                'key' => 'read_categories',
                'permission_group_id' => NULL,
                'table_name' => 'categories',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            27 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 28,
                'key' => 'edit_categories',
                'permission_group_id' => NULL,
                'table_name' => 'categories',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            28 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 29,
                'key' => 'add_categories',
                'permission_group_id' => NULL,
                'table_name' => 'categories',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            29 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 30,
                'key' => 'delete_categories',
                'permission_group_id' => NULL,
                'table_name' => 'categories',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            30 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 31,
                'key' => 'browse_posts',
                'permission_group_id' => NULL,
                'table_name' => 'posts',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            31 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 32,
                'key' => 'read_posts',
                'permission_group_id' => NULL,
                'table_name' => 'posts',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            32 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 33,
                'key' => 'edit_posts',
                'permission_group_id' => NULL,
                'table_name' => 'posts',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            33 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 34,
                'key' => 'add_posts',
                'permission_group_id' => NULL,
                'table_name' => 'posts',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            34 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 35,
                'key' => 'delete_posts',
                'permission_group_id' => NULL,
                'table_name' => 'posts',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            35 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 36,
                'key' => 'browse_pages',
                'permission_group_id' => NULL,
                'table_name' => 'pages',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            36 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 37,
                'key' => 'read_pages',
                'permission_group_id' => NULL,
                'table_name' => 'pages',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            37 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 38,
                'key' => 'edit_pages',
                'permission_group_id' => NULL,
                'table_name' => 'pages',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            38 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 39,
                'key' => 'add_pages',
                'permission_group_id' => NULL,
                'table_name' => 'pages',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            39 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 40,
                'key' => 'delete_pages',
                'permission_group_id' => NULL,
                'table_name' => 'pages',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            40 => 
            array (
                'created_at' => '2018-06-22 20:15:46',
                'id' => 41,
                'key' => 'browse_hooks',
                'permission_group_id' => NULL,
                'table_name' => NULL,
                'updated_at' => '2018-06-22 20:15:46',
            ),
            41 => 
            array (
                'created_at' => '2018-05-20 21:08:14',
                'id' => 42,
                'key' => 'browse_announcements',
                'permission_group_id' => NULL,
                'table_name' => 'announcements',
                'updated_at' => '2018-05-20 21:08:14',
            ),
            42 => 
            array (
                'created_at' => '2018-05-20 21:08:14',
                'id' => 43,
                'key' => 'read_announcements',
                'permission_group_id' => NULL,
                'table_name' => 'announcements',
                'updated_at' => '2018-05-20 21:08:14',
            ),
            43 => 
            array (
                'created_at' => '2018-05-20 21:08:14',
                'id' => 44,
                'key' => 'edit_announcements',
                'permission_group_id' => NULL,
                'table_name' => 'announcements',
                'updated_at' => '2018-05-20 21:08:14',
            ),
            44 => 
            array (
                'created_at' => '2018-05-20 21:08:14',
                'id' => 45,
                'key' => 'add_announcements',
                'permission_group_id' => NULL,
                'table_name' => 'announcements',
                'updated_at' => '2018-05-20 21:08:14',
            ),
            45 => 
            array (
                'created_at' => '2018-05-20 21:08:14',
                'id' => 46,
                'key' => 'delete_announcements',
                'permission_group_id' => NULL,
                'table_name' => 'announcements',
                'updated_at' => '2018-05-20 21:08:14',
            ),
            46 => 
            array (
                'created_at' => '2017-11-21 16:31:00',
                'id' => 47,
                'key' => 'browse_themes',
                'permission_group_id' => NULL,
                'table_name' => 'admin',
                'updated_at' => '2017-11-21 16:31:00',
            ),
            47 => 
            array (
                'created_at' => '2018-06-22 13:55:03',
                'id' => 48,
                'key' => 'browse_hooks',
                'permission_group_id' => NULL,
                'table_name' => 'hooks',
                'updated_at' => '2018-06-22 13:55:03',
            ),
            48 => 
            array (
                'created_at' => '2018-06-22 13:55:03',
                'id' => 49,
                'key' => 'read_hooks',
                'permission_group_id' => NULL,
                'table_name' => 'hooks',
                'updated_at' => '2018-06-22 13:55:03',
            ),
            49 => 
            array (
                'created_at' => '2018-06-22 13:55:03',
                'id' => 50,
                'key' => 'edit_hooks',
                'permission_group_id' => NULL,
                'table_name' => 'hooks',
                'updated_at' => '2018-06-22 13:55:03',
            ),
            50 => 
            array (
                'created_at' => '2018-06-22 13:55:03',
                'id' => 51,
                'key' => 'add_hooks',
                'permission_group_id' => NULL,
                'table_name' => 'hooks',
                'updated_at' => '2018-06-22 13:55:03',
            ),
            51 => 
            array (
                'created_at' => '2018-06-22 13:55:03',
                'id' => 52,
                'key' => 'delete_hooks',
                'permission_group_id' => NULL,
                'table_name' => 'hooks',
                'updated_at' => '2018-06-22 13:55:03',
            ),
            52 => 
            array (
                'created_at' => '2018-07-03 04:50:28',
                'id' => 53,
                'key' => 'browse_plans',
                'permission_group_id' => NULL,
                'table_name' => 'plans',
                'updated_at' => '2018-07-03 04:50:28',
            ),
            53 => 
            array (
                'created_at' => '2018-07-03 04:50:28',
                'id' => 54,
                'key' => 'read_plans',
                'permission_group_id' => NULL,
                'table_name' => 'plans',
                'updated_at' => '2018-07-03 04:50:28',
            ),
            54 => 
            array (
                'created_at' => '2018-07-03 04:50:28',
                'id' => 55,
                'key' => 'edit_plans',
                'permission_group_id' => NULL,
                'table_name' => 'plans',
                'updated_at' => '2018-07-03 04:50:28',
            ),
            55 => 
            array (
                'created_at' => '2018-07-03 04:50:28',
                'id' => 56,
                'key' => 'add_plans',
                'permission_group_id' => NULL,
                'table_name' => 'plans',
                'updated_at' => '2018-07-03 04:50:28',
            ),
            56 => 
            array (
                'created_at' => '2018-07-03 04:50:28',
                'id' => 57,
                'key' => 'delete_plans',
                'permission_group_id' => NULL,
                'table_name' => 'plans',
                'updated_at' => '2018-07-03 04:50:28',
            ),
            57 => 
            array (
                'created_at' => '2021-11-24 16:23:01',
                'id' => 58,
                'key' => 'browse_acties',
                'permission_group_id' => NULL,
                'table_name' => 'acties',
                'updated_at' => '2021-11-24 16:23:01',
            ),
            58 => 
            array (
                'created_at' => '2021-11-24 16:23:01',
                'id' => 59,
                'key' => 'read_acties',
                'permission_group_id' => NULL,
                'table_name' => 'acties',
                'updated_at' => '2021-11-24 16:23:01',
            ),
            59 => 
            array (
                'created_at' => '2021-11-24 16:23:01',
                'id' => 60,
                'key' => 'edit_acties',
                'permission_group_id' => NULL,
                'table_name' => 'acties',
                'updated_at' => '2021-11-24 16:23:01',
            ),
            60 => 
            array (
                'created_at' => '2021-11-24 16:23:01',
                'id' => 61,
                'key' => 'add_acties',
                'permission_group_id' => NULL,
                'table_name' => 'acties',
                'updated_at' => '2021-11-24 16:23:01',
            ),
            61 => 
            array (
                'created_at' => '2021-11-24 16:23:01',
                'id' => 62,
                'key' => 'delete_acties',
                'permission_group_id' => NULL,
                'table_name' => 'acties',
                'updated_at' => '2021-11-24 16:23:01',
            ),
            62 => 
            array (
                'created_at' => '2021-12-18 16:24:23',
                'id' => 68,
                'key' => 'browse_themes',
                'permission_group_id' => NULL,
                'table_name' => 'themes',
                'updated_at' => '2021-12-18 16:24:23',
            ),
            63 => 
            array (
                'created_at' => '2021-12-18 16:24:23',
                'id' => 69,
                'key' => 'read_themes',
                'permission_group_id' => NULL,
                'table_name' => 'themes',
                'updated_at' => '2021-12-18 16:24:23',
            ),
            64 => 
            array (
                'created_at' => '2021-12-18 16:24:23',
                'id' => 70,
                'key' => 'edit_themes',
                'permission_group_id' => NULL,
                'table_name' => 'themes',
                'updated_at' => '2021-12-18 16:24:23',
            ),
            65 => 
            array (
                'created_at' => '2021-12-18 16:24:23',
                'id' => 71,
                'key' => 'add_themes',
                'permission_group_id' => NULL,
                'table_name' => 'themes',
                'updated_at' => '2021-12-18 16:24:23',
            ),
            66 => 
            array (
                'created_at' => '2021-12-18 16:24:23',
                'id' => 72,
                'key' => 'delete_themes',
                'permission_group_id' => NULL,
                'table_name' => 'themes',
                'updated_at' => '2021-12-18 16:24:23',
            ),
            67 => 
            array (
                'created_at' => '2022-01-03 15:53:00',
                'id' => 73,
                'key' => 'browse_organizers',
                'permission_group_id' => NULL,
                'table_name' => 'organizers',
                'updated_at' => '2022-01-03 15:53:00',
            ),
            68 => 
            array (
                'created_at' => '2022-01-03 15:53:00',
                'id' => 74,
                'key' => 'read_organizers',
                'permission_group_id' => NULL,
                'table_name' => 'organizers',
                'updated_at' => '2022-01-03 15:53:00',
            ),
            69 => 
            array (
                'created_at' => '2022-01-03 15:53:00',
                'id' => 75,
                'key' => 'edit_organizers',
                'permission_group_id' => NULL,
                'table_name' => 'organizers',
                'updated_at' => '2022-01-03 15:53:00',
            ),
            70 => 
            array (
                'created_at' => '2022-01-03 15:53:00',
                'id' => 76,
                'key' => 'add_organizers',
                'permission_group_id' => NULL,
                'table_name' => 'organizers',
                'updated_at' => '2022-01-03 15:53:00',
            ),
            71 => 
            array (
                'created_at' => '2022-01-03 15:53:00',
                'id' => 77,
                'key' => 'delete_organizers',
                'permission_group_id' => NULL,
                'table_name' => 'organizers',
                'updated_at' => '2022-01-03 15:53:00',
            ),
            72 => 
            array (
                'created_at' => '2022-01-19 15:46:35',
                'id' => 98,
                'key' => 'browse_reports',
                'permission_group_id' => NULL,
                'table_name' => 'reports',
                'updated_at' => '2022-01-19 15:46:35',
            ),
            73 => 
            array (
                'created_at' => '2022-01-19 15:46:35',
                'id' => 99,
                'key' => 'read_reports',
                'permission_group_id' => NULL,
                'table_name' => 'reports',
                'updated_at' => '2022-01-19 15:46:35',
            ),
            74 => 
            array (
                'created_at' => '2022-01-19 15:46:35',
                'id' => 100,
                'key' => 'edit_reports',
                'permission_group_id' => NULL,
                'table_name' => 'reports',
                'updated_at' => '2022-01-19 15:46:35',
            ),
            75 => 
            array (
                'created_at' => '2022-01-19 15:46:35',
                'id' => 101,
                'key' => 'add_reports',
                'permission_group_id' => NULL,
                'table_name' => 'reports',
                'updated_at' => '2022-01-19 15:46:35',
            ),
            76 => 
            array (
                'created_at' => '2022-01-19 15:46:35',
                'id' => 102,
                'key' => 'delete_reports',
                'permission_group_id' => NULL,
                'table_name' => 'reports',
                'updated_at' => '2022-01-19 15:46:35',
            ),
            77 => 
            array (
                'created_at' => '2022-03-09 14:06:44',
                'id' => 103,
                'key' => 'browse_images',
                'permission_group_id' => NULL,
                'table_name' => 'images',
                'updated_at' => '2022-03-09 14:06:44',
            ),
            78 => 
            array (
                'created_at' => '2022-03-09 14:06:44',
                'id' => 104,
                'key' => 'read_images',
                'permission_group_id' => NULL,
                'table_name' => 'images',
                'updated_at' => '2022-03-09 14:06:44',
            ),
            79 => 
            array (
                'created_at' => '2022-03-09 14:06:44',
                'id' => 105,
                'key' => 'edit_images',
                'permission_group_id' => NULL,
                'table_name' => 'images',
                'updated_at' => '2022-03-09 14:06:44',
            ),
            80 => 
            array (
                'created_at' => '2022-03-09 14:06:44',
                'id' => 106,
                'key' => 'add_images',
                'permission_group_id' => NULL,
                'table_name' => 'images',
                'updated_at' => '2022-03-09 14:06:44',
            ),
            81 => 
            array (
                'created_at' => '2022-03-09 14:06:44',
                'id' => 107,
                'key' => 'delete_images',
                'permission_group_id' => NULL,
                'table_name' => 'images',
                'updated_at' => '2022-03-09 14:06:44',
            ),
        ));
        
        
    }
}