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

$router->post('/utilizador/edit/{id}', 'SenhoriosController@updateUtilizador');
$router->post('/utilizador/edit/profilePic/{id}', 'SenhoriosController@storeProfileImg');


$router->get('/senhorios/', 'SenhoriosController@getAllSenhorios');
$router->group(['prefix' => '/senhorio/'], function() use ($router){
    $router->get('/home', 'SenhoriosController@senhorioHome');
    $router->get('/homeDisp', 'SenhoriosController@senhorioHomeDisp');
    $router->get('/{id}', 'SenhoriosController@getSenhorio');    
    $router->get('/wallet/', 'SenhoriosController@showWallet');
    $router->post('/wallet/add', 'SenhoriosController@addSaldo');
});

$router->group(['prefix' => '/propriedades/'], function() use ($router){
    $router->get('/', 'PropriedadesController@getAllPropriedades');
    $router->get('/{id}', 'PropriedadesController@getPropertiesFromSenhorio');
    $router->delete('/{id}', 'PropriedadesController@destroyPropriedadeSenhorio');
    $router->delete('/', 'PropriedadesController@destroyAllPropriedades');
});
$router->group(['prefix' => '/propriedade/'], function() use ($router){
    $router->get('/add', function ()  {
        return view('senhorioAddProperty');
    });
    $router->get('/{id}', 'PropriedadesController@getPropriedade');
    $router->post('/', 'PropriedadesController@storePropriedade');
    $router->put('/{id}', 'PropriedadesController@updatePropriedade');
    $router->delete('/{id}', 'PropriedadesController@destroyPropriedade');
});