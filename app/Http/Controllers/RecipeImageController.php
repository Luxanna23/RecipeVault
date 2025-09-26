<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecipeImageRequest;
use App\Models\Recipe;
use App\Services\RecipeImageService;

class RecipeImageController extends Controller
{
    public function __construct(
        private RecipeImageService $recipeService
    ) {}

    public function store(RecipeImageRequest $request, Recipe $recipe)
    {
        $validated = $request->validated();
        $images = $request->file('images', []);

        $recipe = $this->recipeService->store($recipe, $images);

        return response()->json($recipe->load('images')); 
    }

    // Test d'upload d'images avec Spatie Media Library une prochaine fois
   
}
