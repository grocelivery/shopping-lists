<?php

declare(strict_types=1);

namespace Grocelivery\AdsCatalog\Http\Resources;

use Grocelivery\Utils\Resources\JsonResource;

/**
 * Class NearbyShoppingListResource
 * @package Grocelivery\AdsCatalog\Http\Resources
 */
class NearbyShoppingListResource extends JsonResource
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->resource['id'],
            'customer' => [
                'id' => $this->resource['customer_id'],
            ],
            'name' => $this->resource['name'],
            'description' => $this->resource['description'],
            'endDate' => $this->resource['end_date'],
            'value' => $this->resource->products()->sum('max_price'),
            'deliveryPlace' => $this->resource['location']['payload']['deliveryPlace'],
            'location' => AnonymizedLocationResource::fromArray($this->resource['location'])->map()
        ];
    }
}