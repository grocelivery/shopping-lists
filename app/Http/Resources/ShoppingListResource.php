<?php

declare(strict_types=1);

namespace Grocelivery\AdsCatalog\Http\Resources;

use Grocelivery\Utils\Clients\GeolocalizerClient;
use Grocelivery\Utils\Resources\JsonResource;

/**
 * Class ShoppingListResource
 * @package Grocelivery\AdsCatalog\Http\Resources
 */
class ShoppingListResource extends JsonResource
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->resource['id'],
            'name' => $this->resource['name'],
            'description' => $this->resource['description'],
            'endDate' => $this->resource['end_date'],
            'products' => (new ProductResource($this->resource['products']))->map(),
            'value' => $this->resource->products()->sum('max_price'),
            'deliveryPlace' => $this->getDeliveryPlace(),
        ];
    }

    /**
     * @return string
     */
    protected function getDeliveryPlace(): string
    {
        $client = app()->make(GeolocalizerClient::class);
        $point = $client->getPointById('shoppingList', $this->resource['location_id'])->get('point');

        return $point['payload']['deliveryPlace'];
    }
}