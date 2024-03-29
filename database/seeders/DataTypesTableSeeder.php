<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('data_types')->delete();

        DB::table('data_types')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'posts',
                'slug' => 'posts',
                'display_name_singular' => 'Post',
                'display_name_plural' => 'Posts',
                'icon' => 'voyager-news',
                'model_name' => 'TCG\\Voyager\\Models\\Post',
                'policy_name' => 'TCG\\Voyager\\Policies\\PostPolicy',
                'controller' => null,
                'description' => 'This database contains posts.',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2021-11-24 15:57:47',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'pages',
                'slug' => 'pages',
                'display_name_singular' => 'Pagina',
                'display_name_plural' => 'Pagina\'s',
                'icon' => 'voyager-file-text',
                'model_name' => 'TCG\\Voyager\\Models\\Page',
                'policy_name' => null,
                'controller' => null,
                'description' => null,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2022-01-18 21:13:45',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'users',
                'slug' => 'users',
                'display_name_singular' => 'User',
                'display_name_plural' => 'Users',
                'icon' => 'voyager-person',
                'model_name' => 'TCG\\Voyager\\Models\\User',
                'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller' => null,
                'description' => null,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null}',
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2018-06-22 20:29:47',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'categories',
                'slug' => 'categories',
                'display_name_singular' => 'Categorie',
                'display_name_plural' => 'Categoriën',
                'icon' => 'voyager-categories',
                'model_name' => 'App\\Models\\Category',
                'policy_name' => null,
                'controller' => null,
                'description' => null,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2021-12-06 11:11:11',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'menus',
                'slug' => 'menus',
                'display_name_singular' => 'Menu',
                'display_name_plural' => 'Menu\'s',
                'icon' => 'voyager-list',
                'model_name' => 'TCG\\Voyager\\Models\\Menu',
                'policy_name' => null,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => null,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2017-11-21 16:23:22',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'roles',
                'slug' => 'roles',
                'display_name_singular' => 'Role',
                'display_name_plural' => 'Roles',
                'icon' => 'voyager-lock',
                'model_name' => 'TCG\\Voyager\\Models\\Role',
                'policy_name' => null,
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => null,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2017-11-21 16:23:22',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'announcements',
                'slug' => 'announcements',
                'display_name_singular' => 'Announcement',
                'display_name_plural' => 'Announcements',
                'icon' => 'voyager-megaphone',
                'model_name' => 'App\\Models\\Announcement',
                'policy_name' => null,
                'controller' => null,
                'description' => null,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => null,
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2018-05-20 21:08:14',
            ),
            7 =>
            array (
                'id' => 9,
                'name' => 'acties',
                'slug' => 'acties',
                'display_name_singular' => 'Actie',
                'display_name_plural' => 'Acties',
                'icon' => 'voyager-exclamation',
                'model_name' => 'App\\Models\\Actie',
                'policy_name' => null,
                'controller' => 'App\\Http\\Controllers\\ActieController',
                'description' => 'This is the database table for events',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2022-02-22 14:37:04',
            ),
            8 =>
            array (
                'id' => 12,
                'name' => 'themes',
                'slug' => 'themes',
                'display_name_singular' => 'Thema',
                'display_name_plural' => 'Thema\'s',
                'icon' => null,
                'model_name' => 'App\\Models\\Theme',
                'policy_name' => null,
                'controller' => null,
                'description' => null,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
            ),
            9 =>
            array (
                'id' => 14,
                'name' => 'organizers',
                'slug' => 'organizers',
                'display_name_singular' => 'Organisator',
                'display_name_plural' => 'Organisatoren',
                'icon' => 'voyager-pirate',
                'model_name' => 'App\\Models\\Organizer',
                'policy_name' => null,
                'controller' => null,
                'description' => null,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-02-22 10:23:14',
            ),
            10 =>
            array (
                'id' => 21,
                'name' => 'reports',
                'slug' => 'reports',
                'display_name_singular' => 'Report',
                'display_name_plural' => 'Reports',
                'icon' => 'voyager-question',
                'model_name' => 'App\\Models\\Report',
                'policy_name' => null,
                'controller' => null,
                'description' => null,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:51:49',
            ),
            11 =>
            array (
                'id' => 22,
                'name' => 'images',
                'slug' => 'images',
                'display_name_singular' => 'Image',
                'display_name_plural' => 'Images',
                'icon' => 'voyager-images',
                'model_name' => 'App\\Models\\Image',
                'policy_name' => null,
                'controller' => null,
                'description' => null,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-02-23 10:21:53',
                'updated_at' => '2022-02-23 10:36:07',
            ),
        ));
    }
}
