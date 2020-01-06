<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Http\Controllers\Broadcast;

use Illuminate\Http\Request;
use Pusher\Pusher;
use Pusher\PusherException;

/**
 * Class AuthController
 * @package Grocelivery\ShoppingLists\Http\Controllers\Broadcast
 */
class AuthController
{
    /**
     * @param Request $request
     * @return string
     * @throws PusherException
     */
    public function auth(Request $request): string
    {
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID')
        );

        return $pusher->socket_auth(
            $request->request->get('channel_name'),
            $request->request->get('socket_id')
        );
    }
}