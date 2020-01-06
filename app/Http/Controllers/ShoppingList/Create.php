<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Http\Controllers\ShoppingList;

use Grocelivery\ShoppingLists\Http\Controllers\Controller;
use Grocelivery\ShoppingLists\Http\Requests\CreateShoppingList;
use Grocelivery\ShoppingLists\Http\Resources\ShoppingListResource;
use Grocelivery\ShoppingLists\Services\ShoppingList\ShoppingListCreator;
use Grocelivery\Utils\Exceptions\GeolocalizerClientException;
use Grocelivery\Utils\Interfaces\JsonResponseInterface;
use Grocelivery\Utils\Responses\JsonResponse;

/**
 * Class Create
 * @package Grocelivery\ShoppingLists\Http\Controllers\ShoppingList
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
     * @throws GeolocalizerClientException
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