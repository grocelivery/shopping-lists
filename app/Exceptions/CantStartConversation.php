<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Exceptions;

use Grocelivery\Utils\Exceptions\BadRequestException;

/**
 * Class CantStartConversation
 * @package Grocelivery\ShoppingLists\Exceptions
 */
class CantStartConversation extends BadRequestException
{
    /**
     * @var string
     */
    protected $message = "Can't start conversation.";
}