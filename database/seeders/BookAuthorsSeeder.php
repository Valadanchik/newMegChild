<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookAuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookAuthors = [
            [
                'book_id' => 1,
                'author_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_id' => 2,
                'author_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_id' => 3,
                'author_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_id' => 4,
                'author_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_id' => 5,
                'author_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_id' => 6,
                'author_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('book_authors_pivot')->insert($bookAuthors);
    }
}
