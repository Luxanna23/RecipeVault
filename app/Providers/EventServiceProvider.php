<?php

namespace App\Providers;

use App\Models\Recipe;
use App\Observers\RecipeObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
 
    public function boot(): void
    {
        Recipe::observe(RecipeObserver::class);
    }
}
