<?php

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
                'name' => 'users',
                'slug' => 'users',
                'display_name_singular' => 'User',
                'display_name_plural' => 'Users',
                'icon' => 'voyager-person',
                'model_name' => 'TCG\\Voyager\\Models\\User',
                'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController',
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                'created_at' => '2020-06-14 12:59:50',
                'updated_at' => '2020-06-22 11:41:03',
            ),
            1 => 
            array (
                'id' => 2,
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
                'created_at' => '2020-06-14 12:59:50',
                'updated_at' => '2020-06-14 12:59:50',
            ),
            2 => 
            array (
                'id' => 3,
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
                'created_at' => '2020-06-14 12:59:50',
                'updated_at' => '2020-06-14 12:59:50',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'products',
                'slug' => 'products',
                'display_name_singular' => 'Product',
                'display_name_plural' => 'Products',
                'icon' => 'voyager-shop',
                'model_name' => 'App\\Product',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2020-06-14 15:43:57',
                'updated_at' => '2020-06-14 15:47:15',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'tags',
                'slug' => 'tags',
                'display_name_singular' => 'Tag',
                'display_name_plural' => 'Tags',
                'icon' => 'voyager-tag',
                'model_name' => 'App\\Tag',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                'created_at' => '2020-06-14 15:50:25',
                'updated_at' => '2020-06-14 15:50:25',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'categories',
                'slug' => 'categories',
                'display_name_singular' => 'Category',
                'display_name_plural' => 'Categories',
                'icon' => 'voyager-categories',
                'model_name' => 'App\\Category',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2020-06-14 15:52:18',
                'updated_at' => '2020-06-14 15:53:25',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'orders',
                'slug' => 'orders',
                'display_name_singular' => 'Order',
                'display_name_plural' => 'Orders',
                'icon' => 'voyager-paperclip',
                'model_name' => 'App\\Order',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2020-06-22 12:57:23',
                'updated_at' => '2020-06-24 02:40:45',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'lobbies',
                'slug' => 'lobbies',
                'display_name_singular' => 'Lobby',
                'display_name_plural' => 'Lobbies',
                'icon' => 'voyager-company',
                'model_name' => 'App\\Lobby',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":"order_by","order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2020-06-24 03:56:21',
                'updated_at' => '2020-06-24 04:03:27',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'periods',
                'slug' => 'periods',
                'display_name_singular' => 'Period',
                'display_name_plural' => 'Periods',
                'icon' => 'voyager-alarm-clock',
                'model_name' => 'App\\Period',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2020-07-02 11:35:54',
                'updated_at' => '2020-07-02 11:49:36',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'numbers',
                'slug' => 'numbers',
                'display_name_singular' => 'Number',
                'display_name_plural' => 'Numbers',
                'icon' => 'voyager-list',
                'model_name' => 'App\\Number',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2020-07-02 12:19:18',
                'updated_at' => '2020-07-02 12:21:11',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'colors',
                'slug' => 'colors',
                'display_name_singular' => 'Color',
                'display_name_plural' => 'Colors',
                'icon' => 'voyager-paint-bucket',
                'model_name' => 'App\\Color',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2020-07-02 12:19:56',
                'updated_at' => '2020-07-04 10:50:41',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'pages',
                'slug' => 'pages',
                'display_name_singular' => 'Page',
                'display_name_plural' => 'Pages',
                'icon' => 'voyager-browser',
                'model_name' => 'App\\Page',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                'created_at' => '2020-07-11 22:48:04',
                'updated_at' => '2020-07-11 22:48:04',
            ),
        ));
        
        
    }
}