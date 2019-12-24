<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Http\Resources;

use Grocelivery\Utils\Resources\JsonResource;

/**
 * Class AnonymizedLocationResource
 * @package Grocelivery\ShoppingLists\Http\Resources
 */
class AnonymizedLocationResource extends JsonResource
{
    /** @var float */
    protected const MAX_DEGREE_OFFSET = 0.00097; // which means roughly around 100m offset

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'latitude' => $this->anonymize((float)$this->resource['location'][1]),
            'longitude' => $this->anonymize((float)$this->resource['location'][0]),
        ];
    }

    /**
     * @param float $value
     * @return float
     */
    protected function anonymize(float $value): float
    {
        $randomOffset = static::MAX_DEGREE_OFFSET * mt_rand(-10, 10) / 10;
        return round($value + $randomOffset, 8);
    }
}