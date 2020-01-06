<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->post('/', 'Controller@getInfo');

$router->group(['middleware' => 'auth'], function () use ($router): void {
    $router->post('/', 'ShoppingList\Create@create');
    $router->get('/nearby', 'ShoppingList\Search@nearby');
    $router->get('/{id}', 'ShoppingList\Show@show');

    $router->post('/{shoppingListId}/conversation', 'Conversation\ConversationController@create');
    $router->post('/conversation/{id}/message', 'Conversation\ConversationController@postMessage');
    $router->get('/conversation/{id}', 'Conversation\ConversationController@show');

    $router->post('/broadcast/auth', 'Broadcast\AuthController@auth');
});