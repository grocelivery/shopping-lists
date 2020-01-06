<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Events\Conversation;

use Grocelivery\ShoppingLists\Events\Event;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;

/**
 * Class MessageSent
 * @package Grocelivery\ShoppingLists\Events\Conversation
 */
class MessageSent extends Event
{
    /** @var string */
    protected $conversationId;

    /**
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'messageSent';
    }

    /**
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new PrivateChannel("conversation.$this->conversationId");
    }

    /**
     * @param string $conversationId
     */
    public function setConversationId(string $conversationId): void
    {
        $this->conversationId = $conversationId;
    }
}