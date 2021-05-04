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

$router->get('/senhorios/', 'SenhoriosController@getAllSenhorios');
$router->group(['prefix' => '/senhorio/'], function() use ($router){
    $router->get('/{id}', 'SenhoriosController@getSenhorio');
});

$router->group(['prefix' => '/propriedades/'], function() use ($router){
    $router->get('/', 'PropriedadesController@getAllPropriedades');
    $router->get('/{id}', 'PropriedadesController@getPropertiesFromSenhorio');
    $router->delete('/{id}', 'PropriedadesController@destroyPropriedadeSenhorio');
    $router->delete('/', 'PropriedadesController@destroyAllPropriedades');
});
$router->group(['prefix' => '/propriedade/'], function() use ($router){
    $router->get('/{id}', 'PropriedadesController@getPropriedade');
    $router->post('/', 'PropriedadesController@storePropriedade');
    $router->put('/{id}', 'PropriedadesController@updatePropriedade');
    $router->delete('/{id}', 'PropriedadesController@destroyPropriedade');
});