<?php

namespace App\Providers;

use App\Models\Recipe;
use App\Models\RecipeImage;
use App\Models\User;
use App\Policies\RecipeImagePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\UserPolicy;
use App\Policies\RecipePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }
    
    protected $policies = [
        User::class   => UserPolicy::class,
        Recipe::class => RecipePolicy::class,
        RecipeImage::class => RecipeImagePolicy::class,
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
