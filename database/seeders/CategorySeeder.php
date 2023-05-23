<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(Categories::NAMES as $key => $name) {
            DB::table('categories')->insert([
                'name_hy' => $name['hy'],
                'name_en' => $name['en'],
                'age' => Categories::AGES[$key],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
