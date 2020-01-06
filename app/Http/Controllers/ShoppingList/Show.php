<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Http\Controllers\ShoppingList;

use Grocelivery\ShoppingLists\Http\Resources\ShoppingListResource;
use Grocelivery\Utils\Interfaces\JsonResponseInterface;
use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class Show
 * @package Grocelivery\ShoppingLists\Http\Controllers\ShoppingList
 */
class Show extends RepositoryController
{
    /**
     * @param FormRequest $request
     * @return JsonResponseInterface
     */
    public function show(FormRequest $request): JsonResponseInterface
    {
        $list =  $this->repository
            ->getById($request->attributes->get('id'));

        return $this->response
            ->withResource('shoppingList', new ShoppingListResource($list));
    }
}