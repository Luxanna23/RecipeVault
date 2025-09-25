<?php

namespace Database\Factories;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Recipe::class;

    public function definition(): array
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($this->faker));
        $this->faker->addProvider(new \Xvladqt\Faker\LoremFlickrProvider($this->faker));

        return [
            'name'        => $this->faker->foodName(),
            'description' => $this->faker->realText(200), 
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Recipe $recipe) {
            
            $sourceImage = storage_path('app/public/recipes/1/tarte.jpg'); //c une image que j'ai en local ça

            for ($i = 0; $i < 2; $i++) {
                $tmpPath = null;

                try {
                    $tmpPath = $this->faker->image(sys_get_temp_dir(), 320, 240, ['dish'], true);
                } catch (\Throwable $e) {
                    $tmpPath = null;
                }

                $destinationFile  = "recipes/{$recipe->id}";
                $filename = Str::uuid().'.jpg';
                $destinationPath = "{$destinationFile}/{$filename}";

                if ($tmpPath && is_file($tmpPath)) {
                    Storage::disk('public')->putFileAs($destinationFile, new File($tmpPath), $filename);
                } else {
                    if (!is_file($sourceImage)) {
                        throw new \RuntimeException("Image fallback introuvable: {$sourceImage}");
                    }
                    Storage::disk('public')->putFileAs($destinationFile, new File($sourceImage), $filename);
                }

                $recipe->images()->create([
                    'image_path' => $destinationPath, 
                ]);
            }

        });
    }
}
