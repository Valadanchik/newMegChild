<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (config('app.env') === 'local') {
            $seedData = [
                AuthorSeeder::class,
                TranslatorSeeder::class,
                CategorySeeder::class,
                BookSeeder::class,
                ImageSeeder::class,
                BookAuthorsSeeder::class,
                BookTranslatorsSeeder::class,
                PostCategoriesSeeder::class,
                PostSeeder::class,
                RegionsTableSeeder::class,
                CountriesTableSeeder::class,
                UserRoleSeeder::class,
                UserSeeder::class,
                SettingsSeeder::class,
            ];
        } else if (config('app.env') === 'production') {
            $seedData = [
                CategorySeeder::class,
                RegionsTableSeeder::class,
                CountriesTableSeeder::class,
                UserRoleSeeder::class,
                UserSeeder::class,
                SettingsSeeder::class,
            ];
        }

        if (!empty($seedData))
            $this->call($seedData);
    }
}
