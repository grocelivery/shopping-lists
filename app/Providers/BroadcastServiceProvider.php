<?php

declare(strict_types=1);

namespace Grocelivery\ShoppingLists\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

/**
 * Class BroadcastServiceProvider
 * @package Grocelivery\ShoppingLists\Providers
 */
class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        Broadcast::routes( ['middleware' => ['auth:api']]);

        require base_path('routes/channels.php');
    }
}