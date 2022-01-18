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
                'display_name_singular' => 'Page',
                'display_name_plural' => 'Pages',
                'icon' => 'voyager-file-text',
                'model_name' => 'TCG\\Voyager\\Models\\Page',
                'policy_name' => null,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => null,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2017-11-21 16:23:22',
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
                'display_name_singular' => 'Category',
                'display_name_plural' => 'Categories',
                'icon' => 'voyager-categories',
                'model_name' => 'Wave\\Category',
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
                'display_name_plural' => 'Menus',
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
                'model_name' => 'Wave\\Announcement',
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
                'id' => 8,
                'name' => 'plans',
                'slug' => 'plans',
                'display_name_singular' => 'Plan',
                'display_name_plural' => 'Plans',
                'icon' => 'voyager-logbook',
                'model_name' => 'Wave\\Plan',
                'policy_name' => null,
                'controller' => null,
                'description' => null,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null}',
                'created_at' => '2018-07-03 04:50:28',
                'updated_at' => '2018-07-03 04:50:28',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'acties',
                'slug' => 'acties',
                'display_name_singular' => 'Actie',
                'display_name_plural' => 'Acties',
                'icon' => 'voyager-exclamation',
                'model_name' => 'Wave\\Actie',
                'policy_name' => null,
                'controller' => 'Wave\\Http\\Controllers\\ActieController',
                'description' => 'This is the database table for events',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2022-01-03 16:38:36',
            ),
            9 =>
            array (
                'id' => 12,
                'name' => 'actie_themes',
                'slug' => 'actie-themes',
                'display_name_singular' => 'Actie Theme',
                'display_name_plural' => 'Actie Themes',
                'icon' => null,
                'model_name' => 'Wave\\ActieTheme',
                'policy_name' => null,
                'controller' => null,
                'description' => null,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-18 16:24:23',
            ),
            10 =>
            array (
                'id' => 14,
                'name' => 'organizers',
                'slug' => 'organizers',
                'display_name_singular' => 'Organizer',
                'display_name_plural' => 'Organizers',
                'icon' => 'voyager-pirate',
                'model_name' => 'Wave\\Organizer',
                'policy_name' => null,
                'controller' => null,
                'description' => null,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
            ),
        ));
    }
}
