<?php

namespace App\Models;

use App\Traits\Encryptable;
use App\Traits\RecipeNotifications;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Recipe extends Model
{
    use Encryptable, HasFactory, Searchable, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    protected $encryptable = [
        'description'
    ];

    public function images() : HasMany
    {
        return $this->hasMany(RecipeImage::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function favoritesUsers() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorite_recipes');
    }


    public function searchableAs(): string
    {
        return 'recipes';
    }

    public function toSearchableArray(): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'user_id'     => $this->user_id,
            'created_at'  => $this->created_at->timestamp,
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')        
            ->useDisk('public')                     
            ->acceptsMimeTypes(['image/jpeg','image/jpg','image/png','image/webp']);
    }
    
}
