<?php

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('colors')->delete();

        \DB::table('colors')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'red',
                'weightage' => 0.25,
                'default' => 0.25,
                'created_at' => '2020-07-02 12:25:00',
                'updated_at' => '2020-07-04 14:15:03',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'green',
                'weightage' => 0.25,
                'default' => 0.25,
                'created_at' => '2020-07-02 12:25:48',
                'updated_at' => '2020-07-04 14:15:03',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'violet',
                'weightage' => 0.25,
                'default' => 0.0,
                'created_at' => '2020-07-02 12:25:59',
                'updated_at' => '2020-07-04 14:15:03',
            ),
        ));


    }
}
