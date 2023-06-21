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
        $this->call([
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
        ]);

//        PostFactory::class;

//         \App\Models\Posts::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
