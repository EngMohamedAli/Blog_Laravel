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

$router->group(['prefix' => 'api/v1'] , function () use ($router)
{
    $router->group(['prefix' => 'users'] , function () use ($router)
    {
        $router->get('index','UserController@index');
        $router->get('view/{id}','UserController@view');
        $router->post('add','UserController@create');
        $router->put('edit/{id}','UserController@update');
        $router->delete('delete/{id}','UserController@delete');
    });
    $router->group(['prefix' => 'posts' , 'middleware' => 'auth'] , function () use ($router)
    {
        $router->get('index','PostController@index');
        $router->get('view/{id}','PostController@view');
        $router->post('add','PostController@create');
        $router->put('edit/{id}','PostController@update');
        $router->delete('delete/{id}','PostController@delete');
    });
});

/*$route->group(['prefix' => 'admin'] , function () use ($router){
});*/