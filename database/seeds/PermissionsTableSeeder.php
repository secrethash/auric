<?php

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
                'key' => 'browse_admin',
                'table_name' => NULL,
                'created_at' => '2020-06-14 12:59:51',
                'updated_at' => '2020-06-14 12:59:51',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'browse_bread',
                'table_name' => NULL,
                'created_at' => '2020-06-14 12:59:51',
                'updated_at' => '2020-06-14 12:59:51',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'browse_database',
                'table_name' => NULL,
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'browse_media',
                'table_name' => NULL,
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'browse_compass',
                'table_name' => NULL,
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'browse_menus',
                'table_name' => 'menus',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'read_menus',
                'table_name' => 'menus',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'edit_menus',
                'table_name' => 'menus',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'add_menus',
                'table_name' => 'menus',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'delete_menus',
                'table_name' => 'menus',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'browse_roles',
                'table_name' => 'roles',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'read_roles',
                'table_name' => 'roles',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'edit_roles',
                'table_name' => 'roles',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'add_roles',
                'table_name' => 'roles',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'delete_roles',
                'table_name' => 'roles',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'browse_users',
                'table_name' => 'users',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'read_users',
                'table_name' => 'users',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'edit_users',
                'table_name' => 'users',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            18 => 
            array (
                'id' => 19,
                'key' => 'add_users',
                'table_name' => 'users',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            19 => 
            array (
                'id' => 20,
                'key' => 'delete_users',
                'table_name' => 'users',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            20 => 
            array (
                'id' => 21,
                'key' => 'browse_settings',
                'table_name' => 'settings',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            21 => 
            array (
                'id' => 22,
                'key' => 'read_settings',
                'table_name' => 'settings',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            22 => 
            array (
                'id' => 23,
                'key' => 'edit_settings',
                'table_name' => 'settings',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            23 => 
            array (
                'id' => 24,
                'key' => 'add_settings',
                'table_name' => 'settings',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            24 => 
            array (
                'id' => 25,
                'key' => 'delete_settings',
                'table_name' => 'settings',
                'created_at' => '2020-06-14 12:59:52',
                'updated_at' => '2020-06-14 12:59:52',
            ),
            25 => 
            array (
                'id' => 26,
                'key' => 'browse_hooks',
                'table_name' => NULL,
                'created_at' => '2020-06-14 12:59:54',
                'updated_at' => '2020-06-14 12:59:54',
            ),
            26 => 
            array (
                'id' => 27,
                'key' => 'browse_products',
                'table_name' => 'products',
                'created_at' => '2020-06-14 15:43:58',
                'updated_at' => '2020-06-14 15:43:58',
            ),
            27 => 
            array (
                'id' => 28,
                'key' => 'read_products',
                'table_name' => 'products',
                'created_at' => '2020-06-14 15:43:58',
                'updated_at' => '2020-06-14 15:43:58',
            ),
            28 => 
            array (
                'id' => 29,
                'key' => 'edit_products',
                'table_name' => 'products',
                'created_at' => '2020-06-14 15:43:58',
                'updated_at' => '2020-06-14 15:43:58',
            ),
            29 => 
            array (
                'id' => 30,
                'key' => 'add_products',
                'table_name' => 'products',
                'created_at' => '2020-06-14 15:43:58',
                'updated_at' => '2020-06-14 15:43:58',
            ),
            30 => 
            array (
                'id' => 31,
                'key' => 'delete_products',
                'table_name' => 'products',
                'created_at' => '2020-06-14 15:43:58',
                'updated_at' => '2020-06-14 15:43:58',
            ),
            31 => 
            array (
                'id' => 32,
                'key' => 'browse_tags',
                'table_name' => 'tags',
                'created_at' => '2020-06-14 15:50:25',
                'updated_at' => '2020-06-14 15:50:25',
            ),
            32 => 
            array (
                'id' => 33,
                'key' => 'read_tags',
                'table_name' => 'tags',
                'created_at' => '2020-06-14 15:50:25',
                'updated_at' => '2020-06-14 15:50:25',
            ),
            33 => 
            array (
                'id' => 34,
                'key' => 'edit_tags',
                'table_name' => 'tags',
                'created_at' => '2020-06-14 15:50:25',
                'updated_at' => '2020-06-14 15:50:25',
            ),
            34 => 
            array (
                'id' => 35,
                'key' => 'add_tags',
                'table_name' => 'tags',
                'created_at' => '2020-06-14 15:50:25',
                'updated_at' => '2020-06-14 15:50:25',
            ),
            35 => 
            array (
                'id' => 36,
                'key' => 'delete_tags',
                'table_name' => 'tags',
                'created_at' => '2020-06-14 15:50:25',
                'updated_at' => '2020-06-14 15:50:25',
            ),
            36 => 
            array (
                'id' => 37,
                'key' => 'browse_categories',
                'table_name' => 'categories',
                'created_at' => '2020-06-14 15:52:18',
                'updated_at' => '2020-06-14 15:52:18',
            ),
            37 => 
            array (
                'id' => 38,
                'key' => 'read_categories',
                'table_name' => 'categories',
                'created_at' => '2020-06-14 15:52:18',
                'updated_at' => '2020-06-14 15:52:18',
            ),
            38 => 
            array (
                'id' => 39,
                'key' => 'edit_categories',
                'table_name' => 'categories',
                'created_at' => '2020-06-14 15:52:18',
                'updated_at' => '2020-06-14 15:52:18',
            ),
            39 => 
            array (
                'id' => 40,
                'key' => 'add_categories',
                'table_name' => 'categories',
                'created_at' => '2020-06-14 15:52:18',
                'updated_at' => '2020-06-14 15:52:18',
            ),
            40 => 
            array (
                'id' => 41,
                'key' => 'delete_categories',
                'table_name' => 'categories',
                'created_at' => '2020-06-14 15:52:18',
                'updated_at' => '2020-06-14 15:52:18',
            ),
            41 => 
            array (
                'id' => 42,
                'key' => 'browse_orders',
                'table_name' => 'orders',
                'created_at' => '2020-06-22 12:57:23',
                'updated_at' => '2020-06-22 12:57:23',
            ),
            42 => 
            array (
                'id' => 43,
                'key' => 'read_orders',
                'table_name' => 'orders',
                'created_at' => '2020-06-22 12:57:23',
                'updated_at' => '2020-06-22 12:57:23',
            ),
            43 => 
            array (
                'id' => 44,
                'key' => 'edit_orders',
                'table_name' => 'orders',
                'created_at' => '2020-06-22 12:57:23',
                'updated_at' => '2020-06-22 12:57:23',
            ),
            44 => 
            array (
                'id' => 45,
                'key' => 'add_orders',
                'table_name' => 'orders',
                'created_at' => '2020-06-22 12:57:23',
                'updated_at' => '2020-06-22 12:57:23',
            ),
            45 => 
            array (
                'id' => 46,
                'key' => 'delete_orders',
                'table_name' => 'orders',
                'created_at' => '2020-06-22 12:57:23',
                'updated_at' => '2020-06-22 12:57:23',
            ),
            46 => 
            array (
                'id' => 47,
                'key' => 'browse_lobbies',
                'table_name' => 'lobbies',
                'created_at' => '2020-06-24 03:56:21',
                'updated_at' => '2020-06-24 03:56:21',
            ),
            47 => 
            array (
                'id' => 48,
                'key' => 'read_lobbies',
                'table_name' => 'lobbies',
                'created_at' => '2020-06-24 03:56:21',
                'updated_at' => '2020-06-24 03:56:21',
            ),
            48 => 
            array (
                'id' => 49,
                'key' => 'edit_lobbies',
                'table_name' => 'lobbies',
                'created_at' => '2020-06-24 03:56:21',
                'updated_at' => '2020-06-24 03:56:21',
            ),
            49 => 
            array (
                'id' => 50,
                'key' => 'add_lobbies',
                'table_name' => 'lobbies',
                'created_at' => '2020-06-24 03:56:21',
                'updated_at' => '2020-06-24 03:56:21',
            ),
            50 => 
            array (
                'id' => 51,
                'key' => 'delete_lobbies',
                'table_name' => 'lobbies',
                'created_at' => '2020-06-24 03:56:21',
                'updated_at' => '2020-06-24 03:56:21',
            ),
            51 => 
            array (
                'id' => 52,
                'key' => 'browse_periods',
                'table_name' => 'periods',
                'created_at' => '2020-07-02 11:35:54',
                'updated_at' => '2020-07-02 11:35:54',
            ),
            52 => 
            array (
                'id' => 53,
                'key' => 'read_periods',
                'table_name' => 'periods',
                'created_at' => '2020-07-02 11:35:54',
                'updated_at' => '2020-07-02 11:35:54',
            ),
            53 => 
            array (
                'id' => 54,
                'key' => 'edit_periods',
                'table_name' => 'periods',
                'created_at' => '2020-07-02 11:35:54',
                'updated_at' => '2020-07-02 11:35:54',
            ),
            54 => 
            array (
                'id' => 55,
                'key' => 'add_periods',
                'table_name' => 'periods',
                'created_at' => '2020-07-02 11:35:54',
                'updated_at' => '2020-07-02 11:35:54',
            ),
            55 => 
            array (
                'id' => 56,
                'key' => 'delete_periods',
                'table_name' => 'periods',
                'created_at' => '2020-07-02 11:35:54',
                'updated_at' => '2020-07-02 11:35:54',
            ),
            56 => 
            array (
                'id' => 57,
                'key' => 'browse_numbers',
                'table_name' => 'numbers',
                'created_at' => '2020-07-02 12:19:18',
                'updated_at' => '2020-07-02 12:19:18',
            ),
            57 => 
            array (
                'id' => 58,
                'key' => 'read_numbers',
                'table_name' => 'numbers',
                'created_at' => '2020-07-02 12:19:18',
                'updated_at' => '2020-07-02 12:19:18',
            ),
            58 => 
            array (
                'id' => 59,
                'key' => 'edit_numbers',
                'table_name' => 'numbers',
                'created_at' => '2020-07-02 12:19:18',
                'updated_at' => '2020-07-02 12:19:18',
            ),
            59 => 
            array (
                'id' => 60,
                'key' => 'add_numbers',
                'table_name' => 'numbers',
                'created_at' => '2020-07-02 12:19:18',
                'updated_at' => '2020-07-02 12:19:18',
            ),
            60 => 
            array (
                'id' => 61,
                'key' => 'delete_numbers',
                'table_name' => 'numbers',
                'created_at' => '2020-07-02 12:19:18',
                'updated_at' => '2020-07-02 12:19:18',
            ),
            61 => 
            array (
                'id' => 62,
                'key' => 'browse_colors',
                'table_name' => 'colors',
                'created_at' => '2020-07-02 12:19:56',
                'updated_at' => '2020-07-02 12:19:56',
            ),
            62 => 
            array (
                'id' => 63,
                'key' => 'read_colors',
                'table_name' => 'colors',
                'created_at' => '2020-07-02 12:19:56',
                'updated_at' => '2020-07-02 12:19:56',
            ),
            63 => 
            array (
                'id' => 64,
                'key' => 'edit_colors',
                'table_name' => 'colors',
                'created_at' => '2020-07-02 12:19:56',
                'updated_at' => '2020-07-02 12:19:56',
            ),
            64 => 
            array (
                'id' => 65,
                'key' => 'add_colors',
                'table_name' => 'colors',
                'created_at' => '2020-07-02 12:19:56',
                'updated_at' => '2020-07-02 12:19:56',
            ),
            65 => 
            array (
                'id' => 66,
                'key' => 'delete_colors',
                'table_name' => 'colors',
                'created_at' => '2020-07-02 12:19:56',
                'updated_at' => '2020-07-02 12:19:56',
            ),
            66 => 
            array (
                'id' => 67,
                'key' => 'browse_pages',
                'table_name' => 'pages',
                'created_at' => '2020-07-11 22:48:05',
                'updated_at' => '2020-07-11 22:48:05',
            ),
            67 => 
            array (
                'id' => 68,
                'key' => 'read_pages',
                'table_name' => 'pages',
                'created_at' => '2020-07-11 22:48:05',
                'updated_at' => '2020-07-11 22:48:05',
            ),
            68 => 
            array (
                'id' => 69,
                'key' => 'edit_pages',
                'table_name' => 'pages',
                'created_at' => '2020-07-11 22:48:05',
                'updated_at' => '2020-07-11 22:48:05',
            ),
            69 => 
            array (
                'id' => 70,
                'key' => 'add_pages',
                'table_name' => 'pages',
                'created_at' => '2020-07-11 22:48:05',
                'updated_at' => '2020-07-11 22:48:05',
            ),
            70 => 
            array (
                'id' => 71,
                'key' => 'delete_pages',
                'table_name' => 'pages',
                'created_at' => '2020-07-11 22:48:05',
                'updated_at' => '2020-07-11 22:48:05',
            ),
        ));
        
        
    }
}