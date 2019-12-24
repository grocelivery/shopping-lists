<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Http\Controllers;

use Grocelivery\ShoppingLists\Http\Requests\NearbyShoppingLists;
use Grocelivery\ShoppingLists\Http\Resources\NearbyShoppingListResource;
use Grocelivery\ShoppingLists\Http\Resources\ShoppingListResource;
use Grocelivery\ShoppingLists\Models\ShoppingList;
use Grocelivery\Utils\Interfaces\JsonResponseInterface;
use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class Search
 * @package Grocelivery\ShoppingLists\Http\Controllers
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