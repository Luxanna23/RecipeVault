<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id'
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
