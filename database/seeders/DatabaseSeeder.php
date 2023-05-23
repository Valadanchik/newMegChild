<?php

namespace Database\Seeders;

use Database\Factories\PostFactory;
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
            PostSeeder::class,
//            PostFactory::class
        ]);

//        PostFactory::class;

//         \App\Models\Posts::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
