<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Http\Resources;

use Grocelivery\Utils\Resources\JsonResource;

/**
 * Class ProductResource
 * @package Grocelivery\ShoppingLists\Http\Resources
 */
class ProductResource extends JsonResource
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
            'maxPrice' => $this->resource['max_price'],
        ];
    }
}