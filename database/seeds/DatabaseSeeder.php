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

        // No Foregin Contraints
        $this->call(CategoriesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(DataTypesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(TranslationsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(LobbiesTableSeeder::class);
        $this->call(NumbersTableSeeder::class);
        $this->call(ColorsTableSeeder::class);

        // Foregin Contraint Table (LEVEL 1)
        $this->call(PeriodsTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);
        $this->call(DataRowsTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
        $this->call(ProductCategoryTableSeeder::class);
        $this->call(ProductTagTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(RateTypesTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(NumberColorTableSeeder::class);

        // Foregin Contraint Table (LEVEL 2)
        $this->call(PeriodUserTableSeeder::class);

        // IGNORED
        // $this->call(PasswordResetsTableSeeder::class);
        // $this->call(MigrationsTableSeeder::class);
        // $this->call(FailedJobsTableSeeder::class);
    }
}
