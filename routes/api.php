<?php

use Laravel\Lumen\Routing\Router;

const UUID = '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}';

/** @var Router $router */
$router->get('/', 'Controller@getInfo');

$router->group(['middleware' => 'auth'], function () use ($router): void {
    $router->post('/', 'Create@create');
    $router->get('/nearby', 'Search@nearby');
    $router->get('/{id}', 'Show@show');
});