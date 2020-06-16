<?php

use Illuminate\Database\Seeder;

class ProductTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_tag')->delete();
        
        \DB::table('product_tag')->insert(array (
            0 => 
            array (
                'id' => 1,
                'product_id' => 1,
                'tag_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'product_id' => 1,
                'tag_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}