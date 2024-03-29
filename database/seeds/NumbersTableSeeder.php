<?php

use Illuminate\Database\Seeder;

class NumbersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('numbers')->delete();

        \DB::table('numbers')->insert(array (
            0 =>
            array (
                'id' => 1,
                'number' => 0,
                'weightage' => 0.0,
                'default' => 0.0,
                'created_at' => '2020-07-02 12:26:27',
                'updated_at' => '2020-07-04 14:09:03',
            ),
            1 =>
            array (
                'id' => 2,
                'number' => 1,
                'weightage' => 0.50,
                'default' => 0.50,
                'created_at' => '2020-07-02 12:26:43',
                'updated_at' => '2020-07-04 14:12:02',
            ),
            2 =>
            array (
                'id' => 3,
                'number' => 2,
                'weightage' => 0.50,
                'default' => 0.50,
                'created_at' => '2020-07-02 12:26:00',
                'updated_at' => '2020-07-04 14:09:02',
            ),
            3 =>
            array (
                'id' => 4,
                'number' => 3,
                'weightage' => 0.50,
                'default' => 0.50,
                'created_at' => '2020-07-02 12:27:34',
                'updated_at' => '2020-07-04 14:09:02',
            ),
            4 =>
            array (
                'id' => 5,
                'number' => 4,
                'weightage' => 0.50,
                'default' => 0.50,
                'created_at' => '2020-07-02 12:27:47',
                'updated_at' => '2020-07-04 14:12:02',
            ),
            5 =>
            array (
                'id' => 6,
                'number' => 5,
                'weightage' => 0.0,
                'default' => 0.0,
                'created_at' => '2020-07-02 12:28:04',
                'updated_at' => '2020-07-04 14:15:03',
            ),
            6 =>
            array (
                'id' => 7,
                'number' => 6,
                'weightage' => 0.50,
                'default' => 0.50,
                'created_at' => '2020-07-02 12:28:21',
                'updated_at' => '2020-07-04 14:12:01',
            ),
            7 =>
            array (
                'id' => 8,
                'number' => 7,
                'weightage' => 0.5,
                'default' => 0.50,
                'created_at' => '2020-07-02 12:28:53',
                'updated_at' => '2020-07-04 14:15:03',
            ),
            8 =>
            array (
                'id' => 9,
                'number' => 8,
                'weightage' => 0.50,
                'default' => 0.50,
                'created_at' => '2020-07-02 12:29:09',
                'updated_at' => '2020-07-04 14:15:03',
            ),
            9 =>
            array (
                'id' => 10,
                'number' => 9,
                'weightage' => 0.50,
                'default' => 0.50,
                'created_at' => '2020-07-02 12:29:25',
                'updated_at' => '2020-07-04 14:15:02',
            ),
        ));


    }
}
