<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Http\Requests;

use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class PostMessage
 * @package Grocelivery\ShoppingLists\Http\Requests
 */
class PostMessage extends FormRequest
{
    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'content' => 'required|string',
        ];
    }
}