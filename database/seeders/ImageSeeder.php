<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images= [
            [
                'book_id' => 1,
                'image' => 'images/books/Ella.png',
            ],
            [
                'book_id' => 1,
                'image' => 'images/books/parent.png',
            ],
            [
                'book_id' => 2,
                'image' => 'images/books/Ella.png',
            ],
            [
                'book_id' => 2,
                'image' => 'images/books/Ella.png',
            ],
            [
                'book_id' => 2,
                'image' => 'images/books/Ella.png',
            ],

        ];
        foreach ($images as $image) {
            DB::table('images')->insert([
                'book_id' => $image['book_id'],
                'image' => $image['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
