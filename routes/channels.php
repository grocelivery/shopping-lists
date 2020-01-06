<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('conversation.{token}', function ($user, $token) {
    return true;
});