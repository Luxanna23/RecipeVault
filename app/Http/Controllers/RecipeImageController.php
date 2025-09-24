<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecipeRequest;
use App\Services\RecipeImageService;

class RecipeImageController extends Controller
{
    public function __construct(
        private RecipeImageService $recipeService
    ) {}

    public function storeImages(RecipeRequest $request)
    {
        $validated = $request->validated();
        $images = $request->file('images', []);

        $recipe = $this->recipeService->create($validated, $images);

        return response()->json($recipe, 201); 
    }

}
