<?php

declare(strict_types=1);

namespace Grocelivery\AdsCatalog\Services;

use Grocelivery\AdsCatalog\Models\ShoppingList;
use Grocelivery\Utils\Clients\GeolocalizerClient;
use Illuminate\Support\Collection;

/**
 * Class ShoppingListRepository
 * @package Grocelivery\AdsCatalog\Services
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
}