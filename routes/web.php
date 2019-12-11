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
use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Demo
$router->get('/api/demo', 'Api\DemoController@index');
$router->get('/api/demo/{category}', 'Api\DemoController@show');
$router->post('/api/demo', 'Api\DemoController@store');

// Categories
$router->get('/api/categories', 'Api\CategoryController@index');
$router->get('/api/categories/{category}', 'Api\CategoryController@show');
$router->post('/api/categories', 'Api\CategoryController@store');
$router->put('/api/categories/{category}', 'Api\CategoryController@update');
$router->delete('/api/categories/{category}', 'Api\CategoryController@destroy');
