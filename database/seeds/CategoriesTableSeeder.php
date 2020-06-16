<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'slug' => 'lifestyle',
                'name' => 'Lifestyle',
                'parent_id' => 0,
                'created_at' => '2020-06-14 15:55:31',
                'updated_at' => '2020-06-14 15:55:31',
            ),
            1 => 
            array (
                'id' => 2,
                'slug' => 'women',
                'name' => 'Women',
                'parent_id' => 0,
                'created_at' => '2020-06-14 15:56:02',
                'updated_at' => '2020-06-14 15:56:02',
            ),
            2 => 
            array (
                'id' => 3,
                'slug' => 'men',
                'name' => 'Men',
                'parent_id' => 0,
                'created_at' => '2020-06-14 15:56:14',
                'updated_at' => '2020-06-14 15:56:14',
            ),
        ));
        
        
    }
}