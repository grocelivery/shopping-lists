<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Services\Conversation;

use Grocelivery\ShoppingLists\Events\Conversation\MessageSent;
use Grocelivery\ShoppingLists\Exceptions\CantStartConversation;
use Grocelivery\ShoppingLists\Http\Resources\MessageResource;
use Grocelivery\ShoppingLists\Models\Conversation;
use Grocelivery\ShoppingLists\Models\Message;
use Grocelivery\ShoppingLists\Services\ShoppingList\ShoppingListRepository;

/**
 * Class ConversationManager
 * @package Grocelivery\ShoppingLists\Services\Conversation
 */
class ConversationManager
{
    /** @var ShoppingListRepository */
    protected $shoppingListRepository;

    /**
     * ConversationManager constructor.
     * @param ShoppingListRepository $shoppingListRepository
     */
    public function __construct(ShoppingListRepository $shoppingListRepository)
    {
        $this->shoppingListRepository = $shoppingListRepository;
    }

    /**
     * @param string $shoppingListId
     * @param string $contractorId
     * @param string $content
     * @return Conversation
     * @throws CantStartConversation
     */
    public function create(string $shoppingListId, string $contractorId, string $content): Conversation
    {
        if ($this->shoppingListRepository->isCustomerOf($contractorId, $shoppingListId)) {
            throw new CantStartConversation();
        }
        if ($this->shoppingListRepository->hasConversation($shoppingListId, $contractorId)) {
            throw new CantStartConversation();
        }

        $shoppingList = $this->shoppingListRepository->getById($shoppingListId);

        $conversation = new Conversation();
        $conversation->contractor_id = $contractorId;

        /** @var Conversation $conversation */
        $conversation = $shoppingList->conversations()->save($conversation);

        $this->postMessage($conversation->id, $conversation->contractor_id, $content);

        return $conversation;
    }

    /**
     * @param string $conversationId
     * @param string $senderId
     * @param string $content
     * @return Conversation
     * @throws CantStartConversation
     */
    public function postMessage(string $conversationId, string $senderId, string $content): Conversation
    {
        /** @var Conversation $conversation */
        $conversation = Conversation::query()->findOrFail($conversationId);

        if (!$conversation->isMember($senderId)) {
            throw new CantStartConversation();
        }

        $message = new Message();
        $message->sender_id = $senderId;
        $message->content = $content;

        /** @var Conversation $conversation */
        $conversation->messages()->save($message);

        $event = new MessageSent();
        $event->setConversationId($conversation->id);
        $event->setData((new MessageResource($message))->map());

        event($event);

        return $conversation;
    }
}