<?php

use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('transactions')->delete();
        
        \DB::table('transactions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sign' => '5353rrw5553536',
                'note' => 'Invested',
                'amount' => 300,
                'status' => 'success',
                'payment_id' => 'pay_uteydfs726525',
                'request_id' => 'req_yetrsg62834362',
                'user_id' => 1,
                'order_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}