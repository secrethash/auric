<?php

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
                'id' => 1,
                'menu_id' => 1,
                'title' => 'Dashboard',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-boat',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 1,
                'created_at' => '2020-06-14 12:59:51',
                'updated_at' => '2020-06-14 12:59:51',
                'route' => 'voyager.dashboard',
                'parameters' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'menu_id' => 1,
                'title' => 'Media',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-images',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 5,
                'created_at' => '2020-06-14 12:59:51',
                'updated_at' => '2020-06-22 13:04:50',
                'route' => 'voyager.media.index',
                'parameters' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'menu_id' => 1,
                'title' => 'Users',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-person',
                'color' => NULL,
                'parent_id' => 36,
                'order' => 1,
                'created_at' => '2020-06-14 12:59:51',
                'updated_at' => '2020-06-22 13:04:50',
                'route' => 'voyager.users.index',
                'parameters' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'menu_id' => 1,
                'title' => 'Roles',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-lock',
                'color' => NULL,
                'parent_id' => 36,
                'order' => 2,
                'created_at' => '2020-06-14 12:59:51',
                'updated_at' => '2020-06-22 13:04:50',
                'route' => 'voyager.roles.index',
                'parameters' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'menu_id' => 1,
                'title' => 'Tools',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-tools',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 6,
                'created_at' => '2020-06-14 12:59:51',
                'updated_at' => '2020-06-24 03:58:27',
                'route' => NULL,
                'parameters' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'menu_id' => 1,
                'title' => 'Menu Builder',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-list',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 1,
                'created_at' => '2020-06-14 12:59:51',
                'updated_at' => '2020-06-14 15:48:23',
                'route' => 'voyager.menus.index',
                'parameters' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'menu_id' => 1,
                'title' => 'Database',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-data',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 2,
                'created_at' => '2020-06-14 12:59:51',
                'updated_at' => '2020-06-14 15:48:23',
                'route' => 'voyager.database.index',
                'parameters' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'menu_id' => 1,
                'title' => 'Compass',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-compass',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 3,
                'created_at' => '2020-06-14 12:59:51',
                'updated_at' => '2020-06-14 15:48:23',
                'route' => 'voyager.compass.index',
                'parameters' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'menu_id' => 1,
                'title' => 'BREAD',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-bread',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 4,
                'created_at' => '2020-06-14 12:59:51',
                'updated_at' => '2020-06-14 15:48:23',
                'route' => 'voyager.bread.index',
                'parameters' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'menu_id' => 1,
                'title' => 'Settings',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-settings',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 7,
                'created_at' => '2020-06-14 12:59:51',
                'updated_at' => '2020-06-24 03:58:27',
                'route' => 'voyager.settings.index',
                'parameters' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'menu_id' => 1,
                'title' => 'Hooks',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-hook',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 5,
                'created_at' => '2020-06-14 12:59:54',
                'updated_at' => '2020-06-14 15:48:23',
                'route' => 'voyager.hooks',
                'parameters' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'menu_id' => 1,
                'title' => 'Products',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-archive',
                'color' => '#000000',
                'parent_id' => 13,
                'order' => 1,
                'created_at' => '2020-06-14 15:43:58',
                'updated_at' => '2020-06-14 15:54:13',
                'route' => 'voyager.products.index',
                'parameters' => 'null',
            ),
            12 => 
            array (
                'id' => 13,
                'menu_id' => 1,
                'title' => 'Shop',
                'url' => '#',
                'target' => '_self',
                'icon_class' => 'voyager-shop',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 2,
                'created_at' => '2020-06-14 15:48:57',
                'updated_at' => '2020-06-14 15:49:19',
                'route' => NULL,
                'parameters' => '',
            ),
            13 => 
            array (
                'id' => 14,
                'menu_id' => 1,
                'title' => 'Tags',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-tag',
                'color' => NULL,
                'parent_id' => 13,
                'order' => 3,
                'created_at' => '2020-06-14 15:50:25',
                'updated_at' => '2020-06-14 15:54:03',
                'route' => 'voyager.tags.index',
                'parameters' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'menu_id' => 1,
                'title' => 'Categories',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-categories',
                'color' => NULL,
                'parent_id' => 13,
                'order' => 2,
                'created_at' => '2020-06-14 15:52:18',
                'updated_at' => '2020-06-14 15:54:03',
                'route' => 'voyager.categories.index',
                'parameters' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'menu_id' => 2,
                'title' => 'Home',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'lni-home',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 8,
                'created_at' => '2020-06-15 11:43:18',
                'updated_at' => '2020-06-15 11:43:18',
                'route' => 'home',
                'parameters' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'menu_id' => 2,
                'title' => 'Cart',
                'url' => '#cart',
                'target' => '_self',
                'icon_class' => 'lni-cart',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 9,
                'created_at' => '2020-06-15 11:44:28',
                'updated_at' => '2020-06-15 11:44:28',
                'route' => NULL,
                'parameters' => '',
            ),
            17 => 
            array (
                'id' => 18,
                'menu_id' => 2,
                'title' => 'Wishlist',
                'url' => '#wishlist',
                'target' => '_self',
                'icon_class' => 'lni-heart',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 10,
                'created_at' => '2020-06-15 11:44:50',
                'updated_at' => '2020-06-15 11:44:50',
                'route' => NULL,
                'parameters' => '',
            ),
            18 => 
            array (
                'id' => 19,
                'menu_id' => 2,
                'title' => 'Account',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'lni-user',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 11,
                'created_at' => '2020-06-15 11:45:34',
                'updated_at' => '2020-06-27 16:32:35',
                'route' => 'login',
                'parameters' => 'null',
            ),
            19 => 
            array (
                'id' => 20,
                'menu_id' => 3,
                'title' => 'My Profile',
                'url' => '#my-profile',
                'target' => '_self',
                'icon_class' => 'lni-user',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 12,
                'created_at' => '2020-06-15 14:01:34',
                'updated_at' => '2020-06-15 14:01:34',
                'route' => NULL,
                'parameters' => '',
            ),
            20 => 
            array (
                'id' => 21,
                'menu_id' => 3,
                'title' => 'Notifications',
                'url' => '#notification',
                'target' => '_self',
                'icon_class' => 'lni-alarm lni-tada-effect',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 13,
                'created_at' => '2020-06-15 14:02:38',
                'updated_at' => '2020-06-15 14:02:38',
                'route' => NULL,
                'parameters' => '',
            ),
            21 => 
            array (
                'id' => 22,
                'menu_id' => 3,
                'title' => 'Pages',
                'url' => '#pages',
                'target' => '_self',
                'icon_class' => 'lni-empty-file',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 14,
                'created_at' => '2020-06-15 14:04:00',
                'updated_at' => '2020-06-15 14:04:00',
                'route' => NULL,
                'parameters' => '',
            ),
            22 => 
            array (
                'id' => 23,
                'menu_id' => 3,
                'title' => 'Wishlist',
                'url' => '#wishlist',
                'target' => '_self',
                'icon_class' => 'lni-heart-filled',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 15,
                'created_at' => '2020-06-15 14:05:37',
                'updated_at' => '2020-06-15 14:05:37',
                'route' => NULL,
                'parameters' => '',
            ),
            23 => 
            array (
                'id' => 24,
                'menu_id' => 3,
                'title' => 'Settings',
                'url' => '#settings',
                'target' => '_self',
                'icon_class' => 'lni-cog',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 16,
                'created_at' => '2020-06-15 14:06:08',
                'updated_at' => '2020-06-15 14:06:08',
                'route' => NULL,
                'parameters' => '',
            ),
            24 => 
            array (
                'id' => 25,
                'menu_id' => 3,
                'title' => 'Sign Out',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'lni-power-switch',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 17,
                'created_at' => '2020-06-15 14:08:09',
                'updated_at' => '2020-06-16 15:05:37',
                'route' => 'user.logout',
                'parameters' => 'null',
            ),
            25 => 
            array (
                'id' => 26,
                'menu_id' => 4,
                'title' => 'Home',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'lni-home',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 18,
                'created_at' => '2020-06-16 14:40:42',
                'updated_at' => '2020-06-16 14:40:42',
                'route' => 'home',
                'parameters' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'menu_id' => 4,
                'title' => 'Login',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'lni-enter',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 19,
                'created_at' => '2020-06-16 14:43:43',
                'updated_at' => '2020-06-16 14:43:43',
                'route' => 'login',
                'parameters' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'menu_id' => 4,
                'title' => 'Signup',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'lni-plus',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 20,
                'created_at' => '2020-06-16 14:47:37',
                'updated_at' => '2020-06-16 14:47:37',
                'route' => 'register',
                'parameters' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'menu_id' => 4,
                'title' => 'Settings',
                'url' => '#',
                'target' => '_self',
                'icon_class' => 'lni-cog',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 21,
                'created_at' => '2020-06-16 14:48:03',
                'updated_at' => '2020-06-16 14:48:03',
                'route' => NULL,
                'parameters' => '',
            ),
            29 => 
            array (
                'id' => 30,
                'menu_id' => 5,
                'title' => 'Home',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'lni-home',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 22,
                'created_at' => '2020-06-20 16:29:46',
                'updated_at' => '2020-06-20 16:29:46',
                'route' => 'home',
                'parameters' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'menu_id' => 5,
                'title' => 'Cart',
                'url' => '#cart',
                'target' => '_self',
                'icon_class' => 'lni-cart',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 23,
                'created_at' => '2020-06-20 16:30:01',
                'updated_at' => '2020-06-20 16:30:01',
                'route' => NULL,
                'parameters' => '',
            ),
            31 => 
            array (
                'id' => 32,
                'menu_id' => 5,
                'title' => 'GetIt',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'lni-investment',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 24,
                'created_at' => '2020-06-20 16:30:33',
                'updated_at' => '2020-06-24 03:17:38',
                'route' => 'invest.index',
                'parameters' => 'null',
            ),
            32 => 
            array (
                'id' => 33,
                'menu_id' => 5,
                'title' => 'Account',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'lni-user',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 25,
                'created_at' => '2020-06-20 16:30:56',
                'updated_at' => '2020-06-20 16:30:56',
                'route' => 'user.account',
                'parameters' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'menu_id' => 1,
                'title' => 'Orders',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-paperclip',
                'color' => '#000000',
                'parent_id' => 35,
                'order' => 1,
                'created_at' => '2020-06-22 12:57:24',
                'updated_at' => '2020-06-22 13:02:22',
                'route' => 'voyager.orders.index',
                'parameters' => 'null',
            ),
            34 => 
            array (
                'id' => 35,
                'menu_id' => 1,
                'title' => 'Management',
                'url' => '#',
                'target' => '_self',
                'icon_class' => 'voyager-wand',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 4,
                'created_at' => '2020-06-22 13:02:04',
                'updated_at' => '2020-06-22 13:04:50',
                'route' => NULL,
                'parameters' => '',
            ),
            35 => 
            array (
                'id' => 36,
                'menu_id' => 1,
                'title' => 'People',
                'url' => '#',
                'target' => '_self',
                'icon_class' => 'voyager-people',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 3,
                'created_at' => '2020-06-22 13:04:32',
                'updated_at' => '2020-06-22 13:04:47',
                'route' => NULL,
                'parameters' => '',
            ),
            36 => 
            array (
                'id' => 37,
                'menu_id' => 1,
                'title' => 'Lobbies',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-company',
                'color' => '#000000',
                'parent_id' => 35,
                'order' => 2,
                'created_at' => '2020-06-24 03:56:21',
                'updated_at' => '2020-06-24 03:58:27',
                'route' => 'voyager.lobbies.index',
                'parameters' => 'null',
            ),
            37 => 
            array (
                'id' => 38,
                'menu_id' => 1,
                'title' => 'Periods',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-alarm-clock',
                'color' => NULL,
                'parent_id' => 35,
                'order' => 26,
                'created_at' => '2020-07-02 11:35:54',
                'updated_at' => '2020-07-02 11:35:54',
                'route' => 'voyager.periods.index',
                'parameters' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'menu_id' => 1,
                'title' => 'Numbers',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-list',
                'color' => NULL,
                'parent_id' => 35,
                'order' => 27,
                'created_at' => '2020-07-02 12:19:18',
                'updated_at' => '2020-07-02 12:19:18',
                'route' => 'voyager.numbers.index',
                'parameters' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'menu_id' => 1,
                'title' => 'Colors',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-paint-bucket',
                'color' => NULL,
                'parent_id' => 35,
                'order' => 28,
                'created_at' => '2020-07-02 12:19:56',
                'updated_at' => '2020-07-02 12:19:56',
                'route' => 'voyager.colors.index',
                'parameters' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'menu_id' => 1,
                'title' => 'Pages',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-browser',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 26,
                'created_at' => '2020-07-11 22:48:05',
                'updated_at' => '2020-07-11 22:48:05',
                'route' => 'voyager.pages.index',
                'parameters' => NULL,
            ),
        ));
        
        
    }
}