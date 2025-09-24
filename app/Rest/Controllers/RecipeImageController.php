<?php

namespace App\Rest\Controllers;

use App\Rest\Controllers\Controller;
use App\Rest\Resources\RecipeImageResource;

class RecipeImageController extends Controller
{
    /**
     * The resource the controller corresponds to.
     *
     * @var class-string<\Lomkit\Rest\Http\Resource>
     */
    public static $resource = RecipeImageResource::class;
}
