<?php

namespace App\Models;

use App\Enums\Cuisine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cuisine',
        'instructions',
        'image_url',
    ];

    protected $casts = [
        'cuisine' => Cuisine::class,
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')
            ->withPivot('quantity');
    }
}
