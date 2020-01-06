<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Models;

use Grocelivery\Utils\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Product
 * @package Grocelivery\ShoppingLists\Models
 * @property string $id
 * @property string $shopping_list_id
 * @property string $contractor_id
 */
class Conversation extends Model
{
    use UsesUuid;

    /**
     * @return BelongsTo
     */
    public function shoppingList(): BelongsTo
    {
        return $this->belongsTo(ShoppingList::class);
    }

    /**
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @param string $userId
     * @return bool
     */
    public function isMember(string $userId): bool
    {
        return $this->contractor_id === $userId || $this->shoppingList->customer_id === $userId;
    }
}