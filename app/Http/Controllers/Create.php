<?php

declare(strict_types=1);

namespace Grocelivery\AdsCatalog\Http\Controllers;

use Grocelivery\AdsCatalog\Http\Requests\CreateShoppingList;
use Grocelivery\AdsCatalog\Http\Resources\ShoppingListResource;
use Grocelivery\AdsCatalog\Services\ShoppingListCreator;
use Grocelivery\Utils\Responses\JsonResponse;
use Grocelivery\Utils\Interfaces\JsonResponseInterface;

/**
 * Class Create
 * @package Grocelivery\AdsCatalog\Http\Controllers
 */
class Create extends Controller
{
    /** @var ShoppingListCreator */
    protected $creator;

    /**
     * CreateController constructor.
     * @param JsonResponse $response
     * @param ShoppingListCreator $creator
     */
    public function __construct(JsonResponse $response, ShoppingListCreator $creator)
    {
        parent::__construct($response);
        $this->creator = $creator;
    }

    /**
     * @param CreateShoppingList $request
     * @return JsonResponseInterface
     */
    public function create(CreateShoppingList $request): JsonResponseInterface
    {
        $data = $request->all();
        $data['customerId'] = $request->user()->getId();

        $shoppingList = $this->creator->create($data);

        return $this->response
            ->setMessage('Shopping list created.')
            ->withResource('shoppingList', new ShoppingListResource($shoppingList));
    }
}