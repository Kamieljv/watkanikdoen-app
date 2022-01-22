<?php

namespace Database\Seeders;

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
        

        \DB::table('data_types')->delete();
        
        \DB::table('data_types')->insert(array (
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
                'controller' => NULL,
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
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
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
                'controller' => NULL,
                'description' => NULL,
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
                'model_name' => 'App\\Models\\Category',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
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
                'policy_name' => NULL,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
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
                'policy_name' => NULL,
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
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
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
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
                'policy_name' => NULL,
                'controller' => 'App\\Http\\Controllers\\ActieController',
                'description' => 'This is the database table for events',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2022-01-03 16:38:36',
            ),
            8 => 
            array (
                'id' => 12,
                'name' => 'actie_themes',
                'slug' => 'actie-themes',
                'display_name_singular' => 'Actie Theme',
                'display_name_plural' => 'Actie Themes',
                'icon' => NULL,
                'model_name' => 'App\\Models\\ActieTheme',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
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
                'display_name_singular' => 'Organizer',
                'display_name_plural' => 'Organizers',
                'icon' => 'voyager-pirate',
                'model_name' => 'App\\Models\\Organizer',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:00',
            ),
            10 => 
            array (
                'id' => 21,
                'name' => 'aanmeldingen',
                'slug' => 'aanmeldingen',
                'display_name_singular' => 'Aanmelding',
                'display_name_plural' => 'Aanmeldingen',
                'icon' => 'voyager-question',
                'model_name' => 'App\\Models\\Aanmelding',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-01-19 15:51:49',
            ),
        ));
        
        
    }
}