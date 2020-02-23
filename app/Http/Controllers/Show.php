<?php

declare(strict_types=1);

namespace Grocelivery\AdsCatalog\Http\Controllers;

use Grocelivery\AdsCatalog\Http\Resources\ShoppingListResource;
use Grocelivery\AdsCatalog\Models\ShoppingList;
use Grocelivery\Utils\Interfaces\JsonResponseInterface;
use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class Show
 * @package Grocelivery\AdsCatalog\Http\Controllers
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