<?php

namespace Database\Seeders;

use App\Enums\Cuisine;
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
            \App\Models\Recipe::factory()
                ->count(rand(1, 3))
                ->create([
                    'cuisine' => $cuisine->value,
                ]);
        }
    }
}
