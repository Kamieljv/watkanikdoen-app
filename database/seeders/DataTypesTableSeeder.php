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
                'display_name_singular' => 'Pagina',
                'display_name_plural' => 'Pagina\'s',
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
                'display_name_singular' => 'Categorie',
                'display_name_plural' => 'Categorien',
                'icon' => 'voyager-categories',
                'model_name' => 'App\\Models\\Category',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2022-07-30 18:44:01',
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
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2023-11-27 21:17:39',
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
                'details' => '{"order_column":"created_at","order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2023-10-25 21:09:34',
            ),
            8 => 
            array (
                'id' => 12,
                'name' => 'themes',
                'slug' => 'themes',
                'display_name_singular' => 'Thema',
                'display_name_plural' => 'Thema\'s',
                'icon' => NULL,
                'model_name' => 'App\\Models\\Theme',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2022-07-30 18:42:45',
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
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2023-02-20 19:39:46',
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
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
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
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-02-23 10:21:53',
                'updated_at' => '2022-02-23 10:36:07',
            ),
            12 => 
            array (
                'id' => 25,
                'name' => 'questions',
                'slug' => 'questions',
                'display_name_singular' => 'Question',
                'display_name_plural' => 'Questions',
                'icon' => NULL,
                'model_name' => 'App\\Models\\Question',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":"id","order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2023-10-07 16:17:34',
                'updated_at' => '2024-01-26 15:04:01',
            ),
            13 => 
            array (
                'id' => 26,
                'name' => 'answers',
                'slug' => 'answers',
                'display_name_singular' => 'Answer',
                'display_name_plural' => 'Answers',
                'icon' => NULL,
                'model_name' => 'App\\Models\\Answer',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2023-10-07 16:23:13',
                'updated_at' => '2024-01-26 15:03:42',
            ),
            14 => 
            array (
                'id' => 27,
                'name' => 'dimensions',
                'slug' => 'dimensions',
                'display_name_singular' => 'Dimension',
                'display_name_plural' => 'Dimensions',
                'icon' => NULL,
                'model_name' => 'App\\Models\\Dimension',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2023-10-24 18:57:29',
                'updated_at' => '2024-01-26 15:04:32',
            ),
            15 => 
            array (
                'id' => 29,
                'name' => 'referenties',
                'slug' => 'referenties',
                'display_name_singular' => 'Referentie',
                'display_name_plural' => 'Referenties',
                'icon' => NULL,
                'model_name' => 'App\\Models\\Referentie',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2024-04-05 10:26:01',
                'updated_at' => '2024-04-05 10:38:03',
            ),
            16 => 
            array (
                'id' => 30,
                'name' => 'referentie_types',
                'slug' => 'referentie-types',
                'display_name_singular' => 'Referentie Type',
                'display_name_plural' => 'Referentie Types',
                'icon' => NULL,
                'model_name' => 'App\\Models\\ReferentieType',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                'created_at' => '2024-04-05 10:39:16',
                'updated_at' => '2024-04-05 10:39:16',
            ),
        ));
        
        
    }
}