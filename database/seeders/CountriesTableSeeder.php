<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    public function run(): void
    {
        $data = [
            [
                'name_en' => 'Armenia',
                'name_hy' => 'Հայաստան',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en' => 'Russia',
                'name_hy' => 'Ռուսաստան',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en' => 'USA',
                'name_hy' => 'ԱՄՆ',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Country::insert($data);
    }
}
