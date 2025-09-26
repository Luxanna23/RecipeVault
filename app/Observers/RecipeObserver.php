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
        Log::info('RecipeObserver@created', ['recipe_id' => $recipe->id, 'user_id' => $recipe->user_id]);
        $user = $recipe->relationLoaded('user') ? $recipe->user : $recipe->user()->first();

            if ($user) {
                $user->notify(new RecipeNotification($recipe));
            }
    }

    /**
     * Handle the Recipe "updated" event.
     */
    public function updated(Recipe $recipe): void
    {
        //
    }

    /**
     * Handle the Recipe "deleted" event.
     */
    public function deleted(Recipe $recipe): void
    {
        //
    }

    /**
     * Handle the Recipe "restored" event.
     */
    public function restored(Recipe $recipe): void
    {
        //
    }

    /**
     * Handle the Recipe "force deleted" event.
     */
    public function forceDeleted(Recipe $recipe): void
    {
        //
    }
}
