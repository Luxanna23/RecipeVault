<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \Lomkit\Rest\Facades\Rest;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeImageController;
use App\Rest\Controllers\RecipeController;
use App\Rest\Controllers\UsersController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//les upload d'images sont pas en restapi 
Route::post('/recipes/{recipe}/images', [RecipeImageController::class, 'store'])
    ->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Rest::resource('users', UsersController::class)->middleware('auth:sanctum');
Rest::resource('recipes', RecipeController::class)->middleware('auth:sanctum');
Rest::resource('recipe-images', RecipeImageController::class)->middleware('auth:sanctum');
