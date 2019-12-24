<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Http\Requests;

use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class NearbyShoppingLists
 * @package Grocelivery\ShoppingLists\Http\Requests
 */
class NearbyShoppingLists extends FormRequest
{
    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'location' => 'required|array',
            'location.latitude' => 'required|numeric|min:-90|max:90',
            'location.longitude' => 'required|numeric|min:-180|max:180',
            'range' => 'required|int',
        ];
    }
}