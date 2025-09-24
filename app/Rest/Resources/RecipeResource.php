<?php

namespace App\Rest\Resources;

use Lomkit\Rest\Http\Resource;  
use App\Models\Recipe;
use Lomkit\Rest\Relations\HasMany;
use Lomkit\Rest\Relations\BelongsTo;
use Lomkit\Rest\Relations\BelongsToMany;
use \Lomkit\Rest\Http\Requests\RestRequest;

class RecipeResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    public static $model = Recipe::class;

    /**
     * The exposed fields that could be provided
     * @param RestRequest $request
     * @return array
     */
    public function fields(\Lomkit\Rest\Http\Requests\RestRequest $request): array
    {
        return [
            'id','name', 'description', 'user_id'
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
            BelongsTo::make('user', UserResource::class),
            HasMany::make('images', RecipeImageResource::class),
            BelongsToMany::make('favoritesUsers', UserResource::class),
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
            'name'        => ['required','string','max:255'],
            'description' => ['string','max:2000'],
            'user_id'     => ['required','exists:users,id'],
        ];
    }

    public function updateRules(RestRequest $request): array
    {
        return [
            'name'        => ['sometimes','string','max:255'],
            'description' => ['string','max:2000'],
        ];
    }

}