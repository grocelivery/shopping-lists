<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Services\ShoppingList;

use Grocelivery\ShoppingLists\Models\Product;
use Grocelivery\ShoppingLists\Models\ShoppingList;
use Grocelivery\Utils\Clients\GeolocalizerClient;
use Grocelivery\Utils\Exceptions\GeolocalizerClientException;

/**
 * Class ShoppingListCreator
 * @package Grocelivery\ShoppingLists\Services\ShoppingList
 */
class ShoppingListCreator
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
     * @param array $data
     * @return ShoppingList
     * @throws GeolocalizerClientException
     */
    public function create(array $data): ShoppingList
    {
        $point = $this->createLocationPoint($data['name'], $data['location']);

        $shoppingList = new ShoppingList([
            'name' => $data['name'],
            'description' => $data['description'],
            'end_date' => $data['endDate'],
            'location_id' => $point['id'],
            'customer_id' => $data['customerId'],
        ]);

        $products = $this->createProducts($data['products']);

        $shoppingList->save();
        $shoppingList->products()->saveMany($products);

        return $shoppingList;
    }

    /**
     * @param string $name
     * @param array $location
     * @return array
     * @throws GeolocalizerClientException
     */
    protected function createLocationPoint(string $name, array $location): array
    {
        $payload = [
            'deliveryPlace' => $this->client->getPlaceByCoordinates($location),
        ];

        return $this->client
            ->createPoint('shoppingList', $name, $location, $payload)
            ->get('point');
    }

    /**
     * @param array $data
     * @return array
     */
    protected function createProducts(array $data): array
    {
        $products = [];

        foreach ($data as $product) {
            $products[] = new Product([
                'name' => $product['name'],
                'description' => $product['description'],
                'max_price' => $product['maxPrice'],
            ]);
        }

        return $products;
    }
}