<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
           'title_hy' => fake()->unique()->name(),
           'title_en' => fake()->unique()->name(),
           'text_hy' => fake()->text(),
           'text_en' => fake()->text(),
           'image' => 'images/posts/article-img-1.png',
       ];
    }
}
