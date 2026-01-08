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
                'name' => 'browse_admin',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'browse_bread',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'browse_database',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'browse_media',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'browse_compass',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'browse_menus',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'read_menus',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'edit_menus',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'add_menus',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'delete_menus',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'browse_roles',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'read_roles',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'edit_roles',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'add_roles',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'delete_roles',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'browse_users',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'read_users',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'edit_users',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'add_users',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'delete_users',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'browse_settings',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'read_settings',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'edit_settings',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'add_settings',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'delete_settings',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:45',
                'updated_at' => '2018-06-22 20:15:45',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'browse_categories',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'read_categories',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'edit_categories',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'add_categories',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'delete_categories',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'browse_posts',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'read_posts',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'edit_posts',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'add_posts',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'delete_posts',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'browse_pages',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'read_pages',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'edit_pages',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'add_pages',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'delete_pages',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 20:15:46',
                'updated_at' => '2018-06-22 20:15:46',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'browse_hooks',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 13:55:03',
                'updated_at' => '2018-06-22 13:55:03',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'browse_announcements',
                'guard_name' => 'web',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'read_announcements',
                'guard_name' => 'web',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'edit_announcements',
                'guard_name' => 'web',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'add_announcements',
                'guard_name' => 'web',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'delete_announcements',
                'guard_name' => 'web',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'browse_themes',
                'guard_name' => 'web',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'read_hooks',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 13:55:03',
                'updated_at' => '2018-06-22 13:55:03',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'edit_hooks',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 13:55:03',
                'updated_at' => '2018-06-22 13:55:03',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'add_hooks',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 13:55:03',
                'updated_at' => '2018-06-22 13:55:03',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'delete_hooks',
                'guard_name' => 'web',
                'created_at' => '2018-06-22 13:55:03',
                'updated_at' => '2018-06-22 13:55:03',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'browse_plans',
                'guard_name' => 'web',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'read_plans',
                'guard_name' => 'web',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'edit_plans',
                'guard_name' => 'web',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'add_plans',
                'guard_name' => 'web',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'delete_plans',
                'guard_name' => 'web',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'browse_acties',
                'guard_name' => 'web',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-11-24 16:23:01',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'read_acties',
                'guard_name' => 'web',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-11-24 16:23:01',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'edit_acties',
                'guard_name' => 'web',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-11-24 16:23:01',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'add_acties',
                'guard_name' => 'web',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-11-24 16:23:01',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'delete_acties',
                'guard_name' => 'web',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-11-24 16:23:01',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'read_themes',
                'guard_name' => 'web',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'edit_themes',
                'guard_name' => 'web',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'add_themes',
                'guard_name' => 'web',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'delete_themes',
                'guard_name' => 'web',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'browse_organizers',
                'guard_name' => 'web',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'read_organizers',
                'guard_name' => 'web',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'edit_organizers',
                'guard_name' => 'web',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'add_organizers',
                'guard_name' => 'web',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'delete_organizers',
                'guard_name' => 'web',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'browse_reports',
                'guard_name' => 'web',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:46:35',
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'read_reports',
                'guard_name' => 'web',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:46:35',
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'edit_reports',
                'guard_name' => 'web',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:46:35',
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'add_reports',
                'guard_name' => 'web',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:46:35',
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'delete_reports',
                'guard_name' => 'web',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:46:35',
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'browse_images',
                'guard_name' => 'web',
                'created_at' => '2022-03-09 14:06:44',
                'updated_at' => '2022-03-09 14:06:44',
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'read_images',
                'guard_name' => 'web',
                'created_at' => '2022-03-09 14:06:44',
                'updated_at' => '2022-03-09 14:06:44',
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'edit_images',
                'guard_name' => 'web',
                'created_at' => '2022-03-09 14:06:44',
                'updated_at' => '2022-03-09 14:06:44',
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'add_images',
                'guard_name' => 'web',
                'created_at' => '2022-03-09 14:06:44',
                'updated_at' => '2022-03-09 14:06:44',
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'delete_images',
                'guard_name' => 'web',
                'created_at' => '2022-03-09 14:06:44',
                'updated_at' => '2022-03-09 14:06:44',
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'browse_answers',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:32:49',
                'updated_at' => '2024-01-26 10:32:49',
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'read_answers',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:32:49',
                'updated_at' => '2024-01-26 10:32:49',
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'edit_answers',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:32:49',
                'updated_at' => '2024-01-26 10:32:49',
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'add_answers',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:32:49',
                'updated_at' => '2024-01-26 10:32:49',
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'delete_answers',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:32:49',
                'updated_at' => '2024-01-26 10:32:49',
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'browse_questions',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:05',
                'updated_at' => '2024-01-26 10:33:05',
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'read_questions',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:05',
                'updated_at' => '2024-01-26 10:33:05',
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'edit_questions',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:05',
                'updated_at' => '2024-01-26 10:33:05',
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'add_questions',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:05',
                'updated_at' => '2024-01-26 10:33:05',
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'delete_questions',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:05',
                'updated_at' => '2024-01-26 10:33:05',
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'browse_dimensions',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'read_dimensions',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'edit_dimensions',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
            ),
            93 => 
            array (
                'id' => 94,
                'name' => 'add_dimensions',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
            ),
            94 => 
            array (
                'id' => 95,
                'name' => 'delete_dimensions',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
            ),
            95 => 
            array (
                'id' => 96,
                'name' => 'browse_referenties',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
            ),
            96 => 
            array (
                'id' => 97,
                'name' => 'read_referenties',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
            ),
            97 => 
            array (
                'id' => 98,
                'name' => 'edit_referenties',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
            ),
            98 => 
            array (
                'id' => 99,
                'name' => 'add_referenties',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
            ),
            99 => 
            array (
                'id' => 100,
                'name' => 'delete_referenties',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
            ),
            100 => 
            array (
                'id' => 101,
                'name' => 'browse_referentie_types',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
            ),
            101 => 
            array (
                'id' => 102,
                'name' => 'read_referentie_types',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
            ),
            102 => 
            array (
                'id' => 103,
                'name' => 'edit_referentie_types',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
            ),
            103 => 
            array (
                'id' => 104,
                'name' => 'add_referentie_types',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
            ),
            104 => 
            array (
                'id' => 105,
                'name' => 'delete_referentie_types',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 10:33:35',
                'updated_at' => '2024-01-26 10:33:35',
            ),
        ));
        
        
    }
}