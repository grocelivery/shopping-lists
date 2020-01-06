<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Http\Resources;

use Grocelivery\Utils\Resources\JsonResource;

/**
 * Class ConversationResource
 * @package Grocelivery\ShoppingLists\Http\Resources
 */
class ConversationResource extends JsonResource
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        $messages = $this->resource['messages']->sortBy('created_at');

        return [
            'id' => $this->resource['id'],
            'shoppingListId' => $this->resource['shopping_list_id'],
            'contractorId' => $this->resource['contractor_id'],
            'messages' => (new MessageResource($messages))->map()
        ];
    }
}