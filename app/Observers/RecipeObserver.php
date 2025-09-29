<?php

namespace App\Observers;

use App\Models\Recipe;
use App\Notifications\RecipeNotification;
use Illuminate\Support\Facades\Log;
class RecipeObserver
{
    /**
     * Handle the Recipe "created" event.
     */
    public function created(Recipe $recipe): void
    {
        $user = $recipe->relationLoaded('user') ? $recipe->user : $recipe->user()->first();

            if ($user) {
                $user->notify(new RecipeNotification($recipe));
            }
    }

}
