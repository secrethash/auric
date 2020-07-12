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
                'phone' => '9988776655',
                'country_code' => '+91',
                'avatar' => 'users/default.png',
                'email_verified_at' => '2020-07-05 00:21:04',
                'phone_verified_at' => '2020-07-05 00:21:04',
                'code_sent_at' => '2020-07-11 19:46:47',
                'password' => '$2y$10$NtHaby9umHezzTtxuIHdKu1heNjxxnyUuQJr4XgWNzHrH71vpsmZm',
                'credits' => 8000000000,
                'referrer_id' => NULL,
                'remember_token' => 'Mb0IbsDYtntSkFzIZ6QylFSl1hA3aZxwpOZpH2Yn6HUE4uyrIPS1o3gdXF53',
                'settings' => NULL,
                'created_at' => '2020-06-14 13:13:14',
                'updated_at' => '2020-07-05 00:21:04',
            ),
            1 =>
            array (
                'id' => 2,
                'role_id' => 2,
                'username' => 'iNutVZ2zZtjcFqyJZFdIeGXMQH6FlfcT',
                'name' => 'Dummy',
                'email' => 'dummy@auricshops.com',
                'phone' => '4433221100',
                'country_code' => '+91',
                'avatar' => 'users/default.png',
                'email_verified_at' => '2020-07-05 00:21:04',
                'phone_verified_at' => '2020-07-05 00:21:04',
                'code_sent_at' => '2020-07-11 19:46:47',
                'password' => '$2y$10$OGLOKn648nUmv0e6afHSeOvp0aStAN.zICW3HFz3z/kAPPu8LxHFW',
                'credits' => 80000000000,
                'referrer_id' => 1,
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2020-07-05 11:08:21',
                'updated_at' => '2020-07-05 11:08:21',
            ),
        ));


    }
}
