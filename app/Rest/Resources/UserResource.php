<?php

namespace App\Rest\Resources;

use App\Rest\Resources\Resource;
use App\Models\User;
use Lomkit\Rest\Http\Requests\RestRequest;

class UserResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    public static $model = User::class;

    /**
     * The exposed fields that could be provided
     * @param RestRequest $request
     * @return array
     */
    public function fields(RestRequest $request): array
    {
        return [
            'id', 'name', 'email'
        ];
    }

    /**
     * The exposed relations that could be provided
     * @param RestRequest $request
     * @return array
     */
    public function relations(\Lomkit\Rest\Http\Requests\RestRequest $request): array
    {
        return [
            HasMany::make('recipes', RecipeResource::class),
            BelongsToMany::make('favoritesRecipes', RecipeResource::class),
        ];
    }

    /**
     * The exposed scopes that could be provided
     * @param RestRequest $request
     * @return array
     */
    public function scopes(\Lomkit\Rest\Http\Requests\RestRequest $request): array
    {
        return [];
    }

    /**
     * The exposed limits that could be provided
     * @param RestRequest $request
     * @return array
     */
    public function limits(\Lomkit\Rest\Http\Requests\RestRequest $request): array
    {
        return [
            10,
            25,
            50
        ];
    }

    /**
     * The actions that should be linked
     * @param RestRequest $request
     * @return array
     */
    public function actions(\Lomkit\Rest\Http\Requests\RestRequest $request): array {
        return [];
    }

    /**
     * The instructions that should be linked
     * @param RestRequest $request
     * @return array
     */
    public function instructions(\Lomkit\Rest\Http\Requests\RestRequest $request): array {
        return [];
    }

    public function createRules(RestRequest $request): array
    {
        return [
            'name'  => ['required','string','max:255'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','string'],
        ];
    }

    public function updateRules(RestRequest $request): array
    {
        return [
            'name'  => ['sometimes','string','max:255'],
            'email' => ['sometimes','email','unique:users,email,{{resource.id}}'],
        ];
    }
}
