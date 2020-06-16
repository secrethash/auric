<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tags')->delete();
        
        \DB::table('tags')->insert(array (
            0 => 
            array (
                'id' => 1,
                'slug' => 'flower-pots',
                'created_at' => '2020-06-14 15:58:41',
                'updated_at' => '2020-06-14 15:58:41',
            ),
            1 => 
            array (
                'id' => 2,
                'slug' => 'ceramic',
                'created_at' => '2020-06-14 15:58:49',
                'updated_at' => '2020-06-14 15:58:49',
            ),
        ));
        
        
    }
}