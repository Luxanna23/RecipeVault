<?php

namespace App\Services;

use App\Models\Recipe;
use Illuminate\Support\Facades\Storage;
use App\Models\RecipeImage;


class RecipeImageService
{
    public function store(array $data, array $images = []): Recipe
    {
        $recipe = Recipe::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ]);

        foreach ($images as $image) {
            $path = $image->store('recipes/{$recipe->id}', 'public');

            $recipe->images()->create([
                'image_path' => $path,
            ]);
        }

        return $recipe->load('images');
    }
}
