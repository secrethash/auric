<?php

use Illuminate\Database\Seeder;

class PeriodUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('period_user')->delete();

        // \DB::table('period_user')->insert(array (
        //     0 =>
        //     array (
        //         'id' => 1,
        //         'user_id' => 1,
        //         'period_id' => 1,
        //         'amount' => 300,
        //         'transaction_id' => 1,
        //         'number' => '3',
        //         'invest_color' => NULL,
        //         'result' => 1,
        //         'created_at' => NULL,
        //         'updated_at' => NULL,
        //     ),
        // ));


    }
}
