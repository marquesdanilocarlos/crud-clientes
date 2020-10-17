<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->post('login', 'Auth\LoginController@login');
$router->post('register', 'Auth\RegisterController@register');


$router->get('clientes', 'ClientController@index');
$router->post('clientes', 'ClientController@store');
$router->get('clientes/{id}', 'ClientController@show');
$router->put('clientes/{id}', 'ClientController@update');
$router->delete('clientes/{id}', 'ClientController@destroy');

$router->group(['middleware' => 'auth'], function () use ($router) {

});
