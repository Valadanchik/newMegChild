<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookTranslatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookTranslators = [
            [
                'book_id' => 1,
                'translator_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_id' => 2,
                'translator_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('book_translators_pivot')->insert($bookTranslators);
    }
}
