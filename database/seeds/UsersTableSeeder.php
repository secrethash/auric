<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'n',
                'role_id' => 1,
                'name' => 'Admin',
                'email' => 'admin@auricshops.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$NtHaby9umHezzTtxuIHdKu1heNjxxnyUuQJr4XgWNzHrH71vpsmZm',
                'remember_token' => 'ctW03pUrtBRssLneCS6qZWKVXuB1PWpATlXLE8b8d6dBVoBiE6NQsHTCojqM',
                'settings' => NULL,
                'referrer_id' => NULL,
                'created_at' => '2020-06-14 13:13:14',
                'updated_at' => '2020-06-14 13:15:22',
            ),
        ));
        
        
    }
}