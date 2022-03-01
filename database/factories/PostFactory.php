<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition():array
    {
        return [
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'slug' => $this->faker->slug(),
            'title' => $this->faker->sentence(),
            'excerpt' => '<p>' . implode( '</p><p>', $this->faker->paragraphs(2)) . '</p>',
            'body' => '<p>' . implode( '</p><p>', $this->faker->paragraphs(6)) . '</p>',
            'published_at' => now()
        ];
    }
}
