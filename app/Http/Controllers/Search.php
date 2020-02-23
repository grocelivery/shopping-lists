<?php

declare(strict_types=1);

namespace Grocelivery\AdsCatalog\Http\Controllers;

use Grocelivery\AdsCatalog\Http\Requests\NearbyShoppingLists;
use Grocelivery\AdsCatalog\Http\Resources\NearbyShoppingListResource;
use Grocelivery\AdsCatalog\Http\Resources\ShoppingListResource;
use Grocelivery\AdsCatalog\Models\ShoppingList;
use Grocelivery\Utils\Interfaces\JsonResponseInterface;
use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class Search
 * @package Grocelivery\AdsCatalog\Http\Controllers
 */
class Search extends RepositoryController
{
    /**
     * @param NearbyShoppingLists $request
     * @return JsonResponseInterface
     */
    public function nearby(NearbyShoppingLists $request): JsonResponseInterface
    {
        $lists = $this->repository
            ->searchNearby($request->input('location'), $request->input('range'));

        return $this->response
            ->withResource('shoppingLists', new NearbyShoppingListResource($lists));
    }
}