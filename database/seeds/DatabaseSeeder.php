<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(ProductCategoryTableSeeder::class);
        $this->call(DataRowsTableSeeder::class);
        $this->call(DataTypesTableSeeder::class);
        $this->call(ProductTagTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(TranslationsTableSeeder::class);
    }
}
