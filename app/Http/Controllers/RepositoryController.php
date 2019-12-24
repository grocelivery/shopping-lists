<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Http\Controllers;

use Grocelivery\ShoppingLists\Services\ShoppingListRepository;
use Grocelivery\Utils\Responses\JsonResponse;

/**
 * Class RepositoryController
 * @package Grocelivery\ShoppingLists\Http\Controllers
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