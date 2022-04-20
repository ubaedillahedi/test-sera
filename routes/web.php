<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group([
    'prefix' => 'api'
], function ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->post('save', 'FirebaseController@store');
});

$router->group([
    'prefix' => 'api/firebase'
], function ($router) {
    $router->get('/', 'FirebaseController@index');
    $router->get('/{id}', 'FirebaseController@detail');
    $router->post('/save', 'FirebaseController@store');
    $router->post('/update/{id}', 'FirebaseController@update');
    $router->post('/delete/{id}', 'FirebaseController@delete');
});

$router->group([
    'prefix' => 'api/integration'
], function ($router) {
    $router->post('/login', 'IntegrationController@login');
    $router->post('/register', 'IntegrationController@register');
});

$router->group([
    'prefix' => 'api/filter-object'
], function ($router) {
    $router->get('/', 'FilterObjectController@index');
});
