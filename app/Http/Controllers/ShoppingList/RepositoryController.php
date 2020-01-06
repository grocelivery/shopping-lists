<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Http\Controllers\ShoppingList;

use Grocelivery\ShoppingLists\Services\ShoppingList\ShoppingListRepository;
use Grocelivery\Utils\Responses\JsonResponse;
use Grocelivery\ShoppingLists\Http\Controllers\Controller;

/**
 * Class RepositoryController
 * @package Grocelivery\ShoppingLists\Http\Controllers\ShoppingList
 */
abstract class RepositoryController extends Controller
{
    /** @var ShoppingListRepository */
    protected $repository;

    /**
     * RepositoryController constructor.
     * @param JsonResponse $response
     * @param ShoppingListRepository $repository
     */
    public function __construct(JsonResponse $response, ShoppingListRepository $repository)
    {
        parent::__construct($response);
        $this->repository = $repository;
    }
}