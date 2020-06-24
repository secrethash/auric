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
                'role_id' => 1,
                'username' => '7dbd395b-cde5-4dcc-99e1-cd4e012ca28e',
                'name' => 'Admin',
                'email' => 'admin@auricshops.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$NtHaby9umHezzTtxuIHdKu1heNjxxnyUuQJr4XgWNzHrH71vpsmZm',
                'credits' => 1000,
                'referrer_id' => NULL,
                'remember_token' => '5pk9C7Zdz1bWSWpc18kE8fgZGACt2ZdP1dOfJS4vrTLy1dOmgMmmQV6jMxg2',
                'settings' => NULL,
                'created_at' => '2020-06-14 13:13:14',
                'updated_at' => '2020-06-14 13:15:22',
            ),
        ));
        
        
    }
}