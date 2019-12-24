<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Http\Requests;

use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class CreateShoppingList
 * @package Grocelivery\ShoppingLists\Http\Requests
 */
class CreateShoppingList extends FormRequest
{
    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:3',
            'location' => 'required|array',
            'location.latitude' => 'required|numeric|min:-90|max:90',
            'location.longitude' => 'required|numeric|min:-180|max:180',
            'endDate' => 'required|date',
            'products' => 'required|array',
            'products.*.name' => 'required|string|min:3|max:100',
            'products.*.description' => 'string|min:3',
            'products.*.maxPrice' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }
}