<?php

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

$router->group(['prefix' => 'api'], function ($router) {
    $router->group(['prefix' => 'home'], function ($router) {
        $router->get('/', 'MyHomeController@index');
    });
    $router->group(['prefix' => 'playlist'], function ($router) {
        $router->get('/', 'PlaylistController@index');
        $router->get('/{id}', 'PlaylistController@show');
    });
    $router->group(['prefix' => 'audio'], function ($router) {
        $router->get('/', 'AudioController@index');
        $router->get('/{id}', 'AudioController@show');
    });
});
