<?php

use Illuminate\Database\Seeder;

class BankTypeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bank_type')->delete();
        
        \DB::table('bank_type')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Bank',
                'slug' => 'bank',
                'icon' => 'lni-restaurant',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Paytm',
                'slug' => 'paytm',
                'icon' => 'lni-wallet',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'UPI',
                'slug' => 'upi',
                'icon' => 'lni-rupee',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}