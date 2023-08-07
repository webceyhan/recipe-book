<?php

namespace Database\Factories;

use App\Enums\Cuisine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'cuisine' => fake()->randomElement(Cuisine::values()),
            'instructions' => fake()->paragraphs(3, true),
            'image_url' => fake()->imageUrl(),
        ];
    }
}
