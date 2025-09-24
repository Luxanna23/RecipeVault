<?php

namespace App\Services;

use App\Models\Recipe;
use Illuminate\Support\Facades\Storage;
use App\Models\RecipeImage;


class RecipeImageService
{
    public function store(Recipe $recipe, array $images = []): Recipe
    {
        foreach ($images as $image) {
            $path = $image->store("recipes/{$recipe->id}", 'public');

            $recipe->images()->create([
                'image_path' => $path,
            ]);
        }

        return $recipe->load('images');
    }
}
