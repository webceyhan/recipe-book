<?php

namespace Database\Seeders;

use App\Enums\Cuisine;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // populate the database with 1-3 recipes for each cuisine
        foreach (Cuisine::cases() as $cuisine) {
            Recipe::factory()
                ->count(rand(1, 3))
                ->create([
                    'cuisine' => $cuisine->value,
                ]);
        }


        // populate recipe_ingredient table with random ingredients 
        // and random quantities per each ingredient
        foreach (Recipe::all() as $recipe) {
            // take random 3 ingredients
            $ingredients = Ingredient::all()->random(3);

            foreach ($ingredients as $ingredient) {
                $recipe->ingredients()->attach($ingredient, [
                    'quantity' => rand(1, 5),
                ]);
            }
        }
    }
}
