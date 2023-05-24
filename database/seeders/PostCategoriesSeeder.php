<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class PostCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postCategories = [
            [
                'slug' => '1in-am',
                'title_hy' => '1in.am',
                'title_en' => '1in.am',
                'image' => 'images/1-aliq.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => '1-tv-am',
                'title_hy' => '1-aliq-2.am',
                'title_en' => '1-aliq-2.am',
                'image' => 'images/1aliq-2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => '168-am',
                'title_hy' => '168.am',
                'title_en' => '168.am',
                'image' => 'images/168-img.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => '4-news-am',
                'title_hy' => '4news.am',
                'title_en' => '4news.am',
                'image' => 'images/4news.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => '24-news-am',
                'title_hy' => '24news.am',
                'title_en' => '24news.am',
                'image' => 'images/24news.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        PostCategory::insert($postCategories);
    }
}
