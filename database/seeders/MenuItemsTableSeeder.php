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
                'title' => 'Media',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-images',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 3,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2022-01-03 15:53:16',
                'route' => 'voyager.media.index',
                'parameters' => NULL,
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
                'order' => 4,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2022-01-03 15:53:16',
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
                'title' => 'Categories',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-categories',
                'color' => NULL,
                'parent_id' => 38,
                'order' => 2,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2021-12-20 12:57:06',
                'route' => 'voyager.categories.index',
                'parameters' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'menu_id' => 1,
                'title' => 'Pages',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-file-text',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 5,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2022-01-03 15:53:16',
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
                'order' => 7,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2022-01-03 15:53:16',
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
                'id' => 14,
                'menu_id' => 1,
                'title' => 'Themes',
                'url' => '/admin/themes',
                'target' => '_self',
                'icon_class' => 'voyager-paint-bucket',
                'color' => NULL,
                'parent_id' => 8,
                'order' => 7,
                'created_at' => '2017-11-21 16:31:00',
                'updated_at' => '2021-12-20 12:58:32',
                'route' => NULL,
                'parameters' => NULL,
            ),
            13 => 
            array (
                'id' => 15,
                'menu_id' => 2,
                'title' => 'Dashboard',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'home',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 1,
                'created_at' => '2017-11-28 14:48:21',
                'updated_at' => '2018-03-23 16:25:44',
                'route' => 'wave.dashboard',
                'parameters' => 'null',
            ),
            14 => 
            array (
                'id' => 16,
                'menu_id' => 2,
                'title' => 'Resources',
                'url' => '#_',
                'target' => '_self',
                'icon_class' => 'info',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 2,
                'created_at' => '2017-11-28 14:49:36',
                'updated_at' => '2017-11-28 15:11:13',
                'route' => NULL,
                'parameters' => '',
            ),
            15 => 
            array (
                'id' => 19,
                'menu_id' => 2,
                'title' => 'Next Child',
                'url' => '/next',
                'target' => '_self',
                'icon_class' => NULL,
                'color' => '#000000',
                'parent_id' => 18,
                'order' => 1,
                'created_at' => '2017-11-28 14:56:58',
                'updated_at' => '2017-11-28 14:57:10',
                'route' => NULL,
                'parameters' => '',
            ),
            16 => 
            array (
                'id' => 20,
                'menu_id' => 2,
                'title' => 'Next Child 2',
                'url' => '/next',
                'target' => '_self',
                'icon_class' => NULL,
                'color' => '#000000',
                'parent_id' => 18,
                'order' => 2,
                'created_at' => '2017-11-28 14:57:07',
                'updated_at' => '2017-11-28 14:57:12',
                'route' => NULL,
                'parameters' => '',
            ),
            17 => 
            array (
                'id' => 21,
                'menu_id' => 2,
                'title' => 'Documentation',
                'url' => '/docs',
                'target' => '_self',
                'icon_class' => NULL,
                'color' => '#000000',
                'parent_id' => 16,
                'order' => 1,
                'created_at' => '2017-11-28 15:08:56',
                'updated_at' => '2017-11-28 15:09:14',
                'route' => NULL,
                'parameters' => '',
            ),
            18 => 
            array (
                'id' => 22,
                'menu_id' => 2,
                'title' => 'Videos',
                'url' => 'https://devdojo.com/series/wave',
                'target' => '_blank',
                'icon_class' => NULL,
                'color' => '#000000',
                'parent_id' => 16,
                'order' => 2,
                'created_at' => '2017-11-28 15:09:22',
                'updated_at' => '2017-11-28 15:09:25',
                'route' => NULL,
                'parameters' => '',
            ),
            19 => 
            array (
                'id' => 23,
                'menu_id' => 2,
                'title' => 'Support',
                'url' => 'https://devdojo.com/forums/category/wave',
                'target' => '_blank',
                'icon_class' => 'lifesaver',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 3,
                'created_at' => '2017-11-28 15:09:56',
                'updated_at' => '2018-03-31 18:22:05',
                'route' => NULL,
                'parameters' => '',
            ),
            20 => 
            array (
                'id' => 25,
                'menu_id' => 2,
                'title' => 'Blog',
                'url' => '/blog',
                'target' => '_self',
                'icon_class' => NULL,
                'color' => '#000000',
                'parent_id' => 16,
                'order' => 3,
                'created_at' => '2018-03-31 18:22:02',
                'updated_at' => '2018-03-31 18:22:08',
                'route' => NULL,
                'parameters' => '',
            ),
            21 => 
            array (
                'id' => 26,
                'menu_id' => 3,
                'title' => 'Home',
                'url' => '/#',
                'target' => '_self',
                'icon_class' => NULL,
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 99,
                'created_at' => '2018-04-13 22:29:33',
                'updated_at' => '2018-08-28 18:39:05',
                'route' => NULL,
                'parameters' => '',
            ),
            22 => 
            array (
                'id' => 27,
                'menu_id' => 3,
                'title' => 'Features',
                'url' => '/#features',
                'target' => '_self',
                'icon_class' => NULL,
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 100,
                'created_at' => '2018-04-13 22:30:26',
                'updated_at' => '2018-08-28 00:24:49',
                'route' => NULL,
                'parameters' => '',
            ),
            23 => 
            array (
                'id' => 28,
                'menu_id' => 3,
                'title' => 'Testimonials',
                'url' => '/#testimonials',
                'target' => '_self',
                'icon_class' => NULL,
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 101,
                'created_at' => '2018-04-13 22:31:03',
                'updated_at' => '2018-08-28 00:24:57',
                'route' => NULL,
                'parameters' => '',
            ),
            24 => 
            array (
                'id' => 29,
                'menu_id' => 3,
                'title' => 'Pricing',
                'url' => '/#pricing',
                'target' => '_self',
                'icon_class' => NULL,
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 102,
                'created_at' => '2018-04-13 22:31:52',
                'updated_at' => '2018-08-28 00:25:04',
                'route' => NULL,
                'parameters' => '',
            ),
            25 => 
            array (
                'id' => 30,
                'menu_id' => 1,
                'title' => 'Announcements',
                'url' => '/admin/announcements',
                'target' => '_self',
                'icon_class' => 'voyager-megaphone',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 6,
                'created_at' => '2018-05-20 21:08:14',
                'updated_at' => '2022-01-03 15:53:16',
                'route' => NULL,
                'parameters' => NULL,
            ),
            26 => 
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
            27 => 
            array (
                'id' => 33,
                'menu_id' => 3,
                'title' => 'Blog',
                'url' => '',
                'target' => '_self',
                'icon_class' => NULL,
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 103,
                'created_at' => '2018-08-24 19:41:14',
                'updated_at' => '2018-08-24 19:41:14',
                'route' => 'wave.blog',
                'parameters' => NULL,
            ),
            28 => 
            array (
                'id' => 34,
                'menu_id' => 1,
                'title' => 'Acties',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-exclamation',
                'color' => '#000000',
                'parent_id' => 38,
                'order' => 1,
                'created_at' => '2021-11-24 16:23:01',
                'updated_at' => '2021-12-20 12:57:04',
                'route' => 'voyager.acties.index',
                'parameters' => 'null',
            ),
            29 => 
            array (
                'id' => 36,
                'menu_id' => 1,
                'title' => 'Actie Themes',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-bubble-hear',
                'color' => '#000000',
                'parent_id' => 38,
                'order' => 3,
                'created_at' => '2021-12-18 16:24:23',
                'updated_at' => '2021-12-21 15:17:48',
                'route' => 'voyager.actie-themes.index',
                'parameters' => 'null',
            ),
            30 => 
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
            31 => 
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
            32 => 
            array (
                'id' => 39,
                'menu_id' => 1,
                'title' => 'Organizers',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-pirate',
                'color' => NULL,
                'parent_id' => 38,
                'order' => 4,
                'created_at' => '2022-01-03 15:53:00',
                'updated_at' => '2022-01-03 15:53:16',
                'route' => 'voyager.organizers.index',
                'parameters' => NULL,
            ),
        ));
        
        
    }
}