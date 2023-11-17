<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(5),
            'description' => fake()->sentence(20),
            'image' => fake()->uuid() . fake()->randomElement(['.jpg', '.png' ,'.gif']),
            'user_id' => fake()->randomElement([1, 2 ,3])
        ];
    }
}
