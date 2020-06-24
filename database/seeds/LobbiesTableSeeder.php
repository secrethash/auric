<?php

use Illuminate\Database\Seeder;

class LobbiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lobbies')->delete();
        
        \DB::table('lobbies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'slug' => 'ory',
                'name' => 'ORY',
                'order_by' => 1,
                'created_at' => '2020-06-24 03:58:00',
                'updated_at' => '2020-06-24 04:03:58',
            ),
            1 => 
            array (
                'id' => 2,
                'slug' => 'gilt',
                'name' => 'GILT',
                'order_by' => 2,
                'created_at' => '2020-06-24 03:59:00',
                'updated_at' => '2020-06-24 04:04:09',
            ),
            2 => 
            array (
                'id' => 3,
                'slug' => 'pale',
                'name' => 'PALE',
                'order_by' => 3,
                'created_at' => '2020-06-24 03:59:00',
                'updated_at' => '2020-06-24 04:04:18',
            ),
            3 => 
            array (
                'id' => 4,
                'slug' => 'gem',
                'name' => 'GEM',
                'order_by' => 4,
                'created_at' => '2020-06-24 03:59:00',
                'updated_at' => '2020-06-24 04:04:31',
            ),
        ));
        
        
    }
}