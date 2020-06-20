<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'created_at' => '2020-06-14 12:59:51',
                'updated_at' => '2020-06-14 12:59:51',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'foot_nav',
                'created_at' => '2020-06-15 11:41:56',
                'updated_at' => '2020-06-15 11:41:56',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'side_nav_auth',
                'created_at' => '2020-06-15 11:42:29',
                'updated_at' => '2020-06-16 14:37:55',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'side_nav',
                'created_at' => '2020-06-16 14:38:06',
                'updated_at' => '2020-06-16 14:38:06',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'foot_nav_auth',
                'created_at' => '2020-06-20 16:29:19',
                'updated_at' => '2020-06-20 16:29:19',
            ),
        ));
        
        
    }
}