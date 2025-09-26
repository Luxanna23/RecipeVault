<?php

namespace App\Traits;

use App\Models\Recipe;
use App\Notifications\RecipeNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

trait RecipeNotifications
{

    public static function bootRecipeNotifications(): void
    {
        static::created(function (Recipe $recipe) {
            $user = $recipe->relationLoaded('user') ? $recipe->user : $recipe->user()->first();

            if ($user) {
                $user->notify(new RecipeNotification($recipe));
            }
        });
    }


}