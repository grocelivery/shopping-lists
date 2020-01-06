<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Http\Controllers\Conversation;

use Grocelivery\ShoppingLists\Events\Conversation\MessageSent;
use Grocelivery\ShoppingLists\Http\Controllers\Controller;
use Grocelivery\ShoppingLists\Http\Requests\PostMessage;
use Grocelivery\ShoppingLists\Http\Resources\ConversationResource;
use Grocelivery\ShoppingLists\Services\Conversation\ConversationManager;
use Grocelivery\ShoppingLists\Models\Conversation;
use Grocelivery\Utils\Interfaces\JsonResponseInterface;
use Grocelivery\Utils\Requests\FormRequest;
use Grocelivery\Utils\Responses\JsonResponse;
use Grocelivery\ShoppingLists\Exceptions\CantStartConversation;

/**
 * Class ConversationController
 * @package Grocelivery\ShoppingLists\Http\Controllers\Conversation
 */
class ConversationController extends Controller
{
    /** @var ConversationManager */
    protected $conversationManager;

    /**
     * ConversationController constructor.
     * @param JsonResponse $response
     * @param ConversationManager $conversationManager
     */
    public function __construct(JsonResponse $response, ConversationManager $conversationManager)
    {
        parent::__construct($response);
        $this->conversationManager = $conversationManager;
    }

    /**
     * @param PostMessage $request
     * @return JsonResponseInterface
     * @throws CantStartConversation
     */
    public function create(PostMessage $request): JsonResponseInterface
    {
        $conversation = $this->conversationManager->create(
            $request->attributes->get('shoppingListId'),
            $request->user()->getId(),
            $request->input('content')
        );

        return $this->response
            ->withResource('conversation', new ConversationResource($conversation));
    }

    /**
     * @param FormRequest $request
     * @return JsonResponseInterface
     */
    public function show(FormRequest $request): JsonResponseInterface
    {
        $conversation = Conversation::query()->findOrFail($request->attributes->get('id'));

        return $this->response
            ->withResource('conversation', new ConversationResource($conversation));
    }

    /**
     * @param PostMessage $request
     * @return JsonResponseInterface
     * @throws CantStartConversation
     */
    public function postMessage(PostMessage $request): JsonResponseInterface
    {
        $conversation = $this->conversationManager->postMessage(
            $request->attributes->get('id'),
            $request->user()->getId(),
            $request->input('content')
        );

        return $this->response
            ->withResource('conversation', new ConversationResource($conversation));
    }
}