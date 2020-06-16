<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'slug' => 'flower-ceramic-pots',
                'name' => 'Flower Ceramic Pots',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi, eum? Id, culpa? At officia quisquam laudantium nisi mollitia nesciunt, qui porro asperiores cum voluptates placeat similique recusandae in facere quos vitae?',
                'price' => 3000,
                'created_at' => '2020-06-14 15:58:00',
                'updated_at' => '2020-06-14 15:59:05',
            ),
        ));
        
        
    }
}