<?php

namespace App\Http\Controllers;

use App\Enums\Cuisine;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $name = request('name');
        $cuisine = request('cuisine');

        $recipes = Recipe::query()
            ->when($name, fn ($query) => $query->where('name', 'like', "%{$name}%"))
            ->when($cuisine, fn ($query) => $query->where('cuisine', $cuisine))
            ->get();

        return inertia('Recipes/Index', [
            'recipes' => $recipes,
            'cuisine' => $cuisine,
            'cuisineOptions' => Cuisine::values()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->edit(new Recipe());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecipeRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('picture')) {
            // store picture and get url
            $img_path = $request->file('picture')->storePublicly('public/images');
            $data['image_url'] = url('/storage/images/' . basename($img_path));
        }

        $recipe = Recipe::create($data);

        $recipe->ingredients()->sync(
            collect($data['ingredients'])->mapWithKeys(function ($ingredient) {
                return [
                    $ingredient['id'] => [
                        'quantity' => $ingredient['quantity'],
                    ],
                ];
            })
        );

        return redirect()
            ->route('recipes.index')
            ->with('status', 'Recipe created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        return inertia('Recipes/Show', [
            'recipe' => $recipe->load('ingredients')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        return inertia('Recipes/Edit', [
            'recipe' => $recipe,
            'ingredients' => $recipe->ingredients->map(function ($ingredient) {
                return [
                    'id' => $ingredient->id,
                    'name' => $ingredient->name,
                    'quantity' => $ingredient->pivot->quantity,
                ];
            }),
            'cuisineOptions' => Cuisine::values(),
            'ingredientOptions' => Ingredient::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $data = $request->validated();

        if ($request->hasFile('picture')) {
            // delete old image
            $old_img_path = str_replace(url('/storage'), 'public', $recipe->image_url);
            Storage::delete($old_img_path);

            // store new image and get url
            $img_path = $request->file('picture')->storePublicly('public/images');
            $data['image_url'] = url('/storage/images/' . basename($img_path));
        }

        // sync ingredients
        $recipe->ingredients()->sync(
            collect($data['ingredients'])->mapWithKeys(function ($ingredient) {
                return [
                    $ingredient['id'] => [
                        'quantity' => $ingredient['quantity'],
                    ],
                ];
            })
        );


        $recipe->update($data);

        return redirect()
            ->route('recipes.show', $recipe)
            ->with('status', 'Recipe updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()
            ->route('recipes.index')
            ->with('status', 'Recipe deleted.');
    }
}
