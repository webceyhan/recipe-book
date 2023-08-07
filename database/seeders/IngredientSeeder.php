<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // sample ingredients
        $ingredients = ['Tomato', 'Bread', 'Cheese', 'Butter', 'Garlic'];

        // populate ingredients table
        foreach ($ingredients as $ingredient) {
            \App\Models\Ingredient::factory()
                ->create([
                    'name' => $ingredient,
                ]);
        }
    }
}
