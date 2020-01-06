<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Services\ShoppingList;

use Grocelivery\ShoppingLists\Models\ShoppingList;
use Grocelivery\Utils\Clients\GeolocalizerClient;
use Illuminate\Support\Collection;

/**
 * Class ShoppingListRepository
 * @package Grocelivery\ShoppingLists\Services\ShoppingList
 */
class ShoppingListRepository
{
    /** @var GeolocalizerClient */
    protected $client;

    /**
     * ShoppingListCreator constructor.
     * @param GeolocalizerClient $client
     */
    public function __construct(GeolocalizerClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $id
     * @return ShoppingList
     */
    public function getById(string $id): ShoppingList
    {
        /** @var ShoppingList $shoppingList */
        $shoppingList = ShoppingList::query()->findOrFail($id);
        return $shoppingList;
    }

    /**
     * @param array $location
     * @param int $range
     * @return Collection
     */
    public function searchNearby(array $location, int $range): Collection
    {
        $locations = $this->client
            ->searchInRange('shoppingList', $location, $range)
            ->get('results');

        $locations = collect($locations);

        $lists = $this->getByPointIds($locations->pluck('id')->toArray());

        $listsWithLocations = $locations->map(function (array $location) use ($lists): ShoppingList {
            $list = $lists->where('location_id', $location['id'])->first();
            $list->setAttribute('location', $location);
            return $list;
        });

        return $listsWithLocations;
    }

    /**
     * @param array $pointIds
     * @return Collection
     */
    public function getByPointIds(array $pointIds): Collection
    {
        return ShoppingList::query()
            ->whereIn('location_id', $pointIds)
            ->get();
    }

    /**
     * @param string $userId
     * @param string $id
     * @return bool
     */
    public function isCustomerOf(string $userId, string $id): bool
    {
        return ShoppingList::query()
            ->where('id', $id)
            ->where('customer_id', $userId)
            ->exists();
    }

    /**
     * @param string $id
     * @param string $contractorId
     * @return bool
     */
    public function hasConversation(string $id, string $contractorId): bool
    {
        $shoppingList = $this->getById($id);

        return $shoppingList->conversations()
            ->where('contractor_id', $contractorId)
            ->exists();
    }
}