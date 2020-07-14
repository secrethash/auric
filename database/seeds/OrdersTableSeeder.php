<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('orders')->delete();

        \DB::table('orders')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Add to Wallet',
                'type' => 'wallet-plus',
                'description' => 'Add Credits to Wallet',
                'mode' => 'online',
                'method' => 'plus',
                'created_at' => '2020-06-23 15:25:00',
                'updated_at' => '2020-06-24 02:43:31',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Invest',
                'type' => 'invest',
                'description' => 'Investment',
                'mode' => 'online',
                'method' => 'minus',
                'created_at' => '2020-06-23 15:26:00',
                'updated_at' => '2020-06-24 02:41:17',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Shop',
                'type' => 'shop',
                'description' => 'Make a Purchase in our shop',
                'mode' => 'online',
                'method' => 'minus',
                'created_at' => '2020-06-23 15:27:00',
                'updated_at' => '2020-06-24 02:40:19',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Return on Investment',
                'type' => 'roi',
                'description' => 'Return of Money on Investment',
                'mode' => 'online',
                'method' => 'plus',
                'created_at' => '2020-06-24 02:44:17',
                'updated_at' => '2020-06-24 02:44:17',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Pay using Wallet',
                'type' => 'wallet-minus',
                'description' => 'Payment Using Wallet Credits',
                'mode' => 'online',
                'method' => 'minus',
                'created_at' => '2020-06-24 02:45:13',
                'updated_at' => '2020-06-24 02:45:13',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Refund',
                'type' => 'refund',
                'description' => 'Refunds Processed',
                'mode' => 'online',
                'method' => 'plus',
                'created_at' => '2020-06-24 02:46:43',
                'updated_at' => '2020-06-24 02:46:43',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Withdraw Hold',
                'type' => 'withdraw-hold',
                'description' => 'Withdraw Requested! Amount on Hold.',
                'mode' => 'online',
                'method' => 'minus',
                'created_at' => '2020-06-24 02:45:13',
                'updated_at' => '2020-06-24 02:45:13',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Withdraw',
                'type' => 'withdraw-minus',
                'description' => 'Withdraw Request Completed',
                'mode' => 'online',
                'method' => 'minus',
                'created_at' => '2020-06-24 02:45:13',
                'updated_at' => '2020-06-24 02:45:13',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Hold Released',
                'type' => 'hold-release',
                'description' => 'Amount Hold Released',
                'mode' => 'online',
                'method' => 'plus',
                'created_at' => '2020-06-24 02:45:13',
                'updated_at' => '2020-06-24 02:45:13',
            ),
        ));


    }
}
