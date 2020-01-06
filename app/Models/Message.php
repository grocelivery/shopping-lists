<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Models;

use Grocelivery\Utils\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Message
 * @package Grocelivery\ShoppingLists\Models
 * @property string $id
 * @property string $conversation_id
 * @property string $sender_id
 * @property string $content
 */
class Message extends Model
{
    use UsesUuid;

    /**
     * @return BelongsTo
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }
}