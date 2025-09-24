<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use Encryptable;

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

}
