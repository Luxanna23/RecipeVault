<?php

namespace App\Policies;

use App\Models\RecipeImage;
use App\Models\User;

class RecipeImagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RecipeImage $recipeImage): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('update dishes');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RecipeImage $recipeImage): bool
    {
        return $user->can('update', $recipeImage->recipe);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RecipeImage $recipeImage): bool
    {
        return $user->can('delete', $recipeImage->recipe);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RecipeImage $recipeImage): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RecipeImage $recipeImage): bool
    {
        return false;
    }
}
