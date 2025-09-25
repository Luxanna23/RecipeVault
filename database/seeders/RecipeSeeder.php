<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\RecipeImage;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(5)->create();

        Recipe::factory()
            ->count(10)
            ->state(fn () => ['user_id' => User::query()->inRandomOrder()->value('id')])
            ->create();
    }
}
