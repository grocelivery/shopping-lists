<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Class Event
 * @package Grocelivery\ShoppingLists\Events
 */
abstract class Event implements ShouldBroadcast
{
    use InteractsWithSockets;

    /** @var array */
    protected $data = [];

    /**
     * @return string
     */
    abstract public function broadcastAs(): string;

    /**
     * @return Channel
     */
    abstract public function broadcastOn(): Channel;

    /**
     * @return array
     */
    public function broadcastWith(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }
}