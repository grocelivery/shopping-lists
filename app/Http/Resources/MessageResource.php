<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Http\Resources;

use Grocelivery\Utils\Resources\JsonResource;

/**
 * Class MessageResource
 * @package Grocelivery\ShoppingLists\Http\Resources
 */
class MessageResource extends JsonResource
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'senderId' => $this->resource['sender_id'],
            'content' => $this->resource['content'],
            'sentAt' => $this->resource['created_at'],
        ];
    }
}