<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu_items')->delete();
        
        \DB::table('menu_items')->insert(array (
            0 => 
            array (
                'id' => 2,
                'menu_id' => 1,
                'title' => 'File explorer',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-folder',
                'color' => '#000000',
                'parent_id' => 47,
                'order' => 1,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2022-02-23 10:32:36',
                'route' => 'voyager.media.index',
                'parameters' => 'null',
            ),
            1 => 
            array (
                'id' => 3,
                'menu_id' => 1,
                'title' => 'Posts',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-news',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 5,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2024-01-26 10:54:17',
                'route' => 'voyager.posts.index',
                'parameters' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'menu_id' => 1,
                'title' => 'Users',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-person',
                'color' => NULL,
                'parent_id' => 37,
                'order' => 1,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2021-12-20 12:56:09',
                'route' => 'voyager.users.index',
                'parameters' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'menu_id' => 1,
                'title' => 'Categoriën',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-categories',
                'color' => NULL,
                'parent_id' => 38,
                'order' => 4,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2022-02-02 14:16:09',
                'route' => 'voyager.categories.index',
                'parameters' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'menu_id' => 1,
                'title' => 'Pagina\'s',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-file-text',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 6,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2024-01-26 10:54:17',
                'route' => 'voyager.pages.index',
                'parameters' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'menu_id' => 1,
                'title' => 'Roles',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-lock',
                'color' => NULL,
                'parent_id' => 37,
                'order' => 2,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2021-12-20 12:56:14',
                'route' => 'voyager.roles.index',
                'parameters' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'menu_id' => 1,
                'title' => 'Tools',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-tools',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 8,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2024-01-26 10:54:17',
                'route' => NULL,
                'parameters' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'menu_id' => 1,
                'title' => 'Menu Builder',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-list',
                'color' => NULL,
                'parent_id' => 8,
                'order' => 1,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2018-05-20 21:08:37',
                'route' => 'voyager.menus.index',
                'parameters' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'menu_id' => 1,
                'title' => 'Database',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-data',
                'color' => NULL,
                'parent_id' => 8,
                'order' => 2,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2018-05-20 21:08:37',
                'route' => 'voyager.database.index',
                'parameters' => NULL,
            ),
            9 => 
            array (
                'id' => 11,
                'menu_id' => 1,
                'title' => 'Compass',
                'url' => '/admin/compass',
                'target' => '_self',
                'icon_class' => 'voyager-compass',
                'color' => NULL,
                'parent_id' => 8,
                'order' => 3,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2018-05-20 21:08:37',
                'route' => NULL,
                'parameters' => NULL,
            ),
            10 => 
            array (
                'id' => 12,
                'menu_id' => 1,
                'title' => 'Hooks',
                'url' => '/admin/hooks',
                'target' => '_self',
                'icon_class' => 'voyager-hook',
                'color' => '#000000',
                'parent_id' => 8,
                'order' => 5,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2018-06-22 20:55:55',
                'route' => NULL,
                'parameters' => '',
            ),
            11 => 
            array (
                'id' => 13,
                'menu_id' => 1,
                'title' => 'Settings',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-settings',
                'color' => NULL,
                'parent_id' => 8,
                'order' => 6,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2021-12-20 12:58:31',
                'route' => 'voyager.settings.index',
                'parameters' => NULL,
            ),
            12 => 
            array (
                'id' => 30,
                'menu_id' => 1,
                'title' => 'Announcements',
                'url' => '/admin/announcements',
                'target' => '_self',
                'icon_class' => 'voyager-megaphone',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 7,
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2024-01-26 10:54:17',
                'route' => NULL,
                'parameters' => NULL,
            ),
            13 => 
            array (
                'id' => 31,
                'menu_id' => 1,
                'title' => 'BREAD',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-bread',
                'color' => '#000000',
                'parent_id' => 8,
                'order' => 4,
                'created_at' => '2018-06-22 20:53:25',
                'updated_at' => '2018-06-22 20:54:13',
                'route' => 'voyager.bread.index',
                'parameters' => NULL,
            ),
            14 => 
            array (
                'id' => 34,
                'menu_id' => 1,
                'title' => 'Acties',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-exclamation',
                'color' => '#000000',
                'parent_id' => 38,
                'order' => 2,
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2022-01-19 15:49:14',
                'route' => 'voyager.acties.index',
                'parameters' => 'null',
            ),
            15 => 
            array (
                'id' => 37,
                'menu_id' => 1,
                'title' => 'Accounts',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-people',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 2,
                'created_at' => '2021-12-20 12:55:52',
                'updated_at' => '2022-01-03 15:53:16',
                'route' => NULL,
                'parameters' => '',
            ),
            16 => 
            array (
                'id' => 38,
                'menu_id' => 1,
                'title' => 'Acties & Organisatoren',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-exclamation',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 1,
                'created_at' => '2021-12-20 12:56:41',
                'updated_at' => '2022-01-03 15:53:16',
                'route' => NULL,
                'parameters' => '',
            ),
            17 => 
            array (
                'id' => 39,
                'menu_id' => 1,
                'title' => 'Organisatoren',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-pirate',
                'color' => NULL,
                'parent_id' => 38,
                'order' => 5,
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-19 15:49:14',
                'route' => 'voyager.organizers.index',
                'parameters' => NULL,
            ),
            18 => 
            array (
                'id' => 44,
                'menu_id' => 1,
                'title' => 'Reports',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-question',
                'color' => '#000000',
                'parent_id' => 38,
                'order' => 1,
                'created_at' => '2022-01-19 15:46:35',
                'updated_at' => '2022-02-21 10:47:02',
                'route' => 'voyager.reports.index',
                'parameters' => 'null',
            ),
            19 => 
            array (
                'id' => 45,
                'menu_id' => 1,
                'title' => 'Thema\'s',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-bubble-hear',
                'color' => '#000000',
                'parent_id' => 38,
                'order' => 3,
                'created_at' => '2022-02-02 14:15:54',
                'updated_at' => '2022-02-02 14:16:09',
                'route' => 'voyager.themes.index',
                'parameters' => NULL,
            ),
            20 => 
            array (
                'id' => 46,
                'menu_id' => 1,
                'title' => 'Image manager',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-images',
                'color' => '#000000',
                'parent_id' => 47,
                'order' => 2,
                'created_at' => '2022-02-23 10:21:53',
                'updated_at' => '2022-02-23 10:32:25',
                'route' => 'voyager.images.index',
                'parameters' => 'null',
            ),
            21 => 
            array (
                'id' => 47,
                'menu_id' => 1,
                'title' => 'Media',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-images',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 3,
                'created_at' => '2022-02-23 10:30:17',
                'updated_at' => '2022-02-23 10:31:08',
                'route' => NULL,
                'parameters' => '',
            ),
            22 => 
            array (
                'id' => 48,
                'menu_id' => 1,
                'title' => 'WKID Tool',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-star-two',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 4,
                'created_at' => '2024-01-26 10:54:08',
                'updated_at' => '2024-01-26 10:54:17',
                'route' => NULL,
                'parameters' => '',
            ),
            23 => 
            array (
                'id' => 49,
                'menu_id' => 1,
                'title' => 'Questions',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-question',
                'color' => '#000000',
                'parent_id' => 48,
                'order' => 2,
                'created_at' => '2024-01-26 10:55:42',
                'updated_at' => '2024-01-26 10:56:47',
                'route' => 'voyager.questions.index',
                'parameters' => NULL,
            ),
            24 => 
            array (
                'id' => 50,
                'menu_id' => 1,
                'title' => 'Answers',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-bubble',
                'color' => '#000000',
                'parent_id' => 48,
                'order' => 3,
                'created_at' => '2024-01-26 10:56:12',
                'updated_at' => '2024-01-26 11:00:35',
                'route' => 'voyager.answers.index',
                'parameters' => 'null',
            ),
            25 => 
            array (
                'id' => 51,
                'menu_id' => 1,
                'title' => 'Dimensions',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-pie-chart',
                'color' => '#000000',
                'parent_id' => 48,
                'order' => 1,
                'created_at' => '2024-01-26 10:56:38',
                'updated_at' => '2024-01-26 10:59:55',
                'route' => 'voyager.dimensions.index',
                'parameters' => 'null',
            ),
        ));
        
        
    }
}