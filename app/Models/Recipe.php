<?php

namespace App\Models;

use App\Traits\Encryptable;
use App\Traits\RecipeNotifications;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;
use Laravel\Scout\Searchable;

class Recipe extends Model
{
    use Encryptable, HasFactory, RecipeNotifications, Searchable;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    protected $encryptable = [
        'description'
    ];

    public function images()
    {
        return $this->hasMany(RecipeImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoritesUsers()
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
            'description' => $this->decryptIfNeededForSearch($this->description),
            'user_id'     => $this->user_id,
            'created_at'  => $this->created_at->timestamp,
        ];
    }
    
}
