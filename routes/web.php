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
$router->group([
    'prefix' => 'district',
    'as' => 'district.'
], function () use ($router) {
    $router->get('/',['as' => 'index', 'uses' => 'DistrictController@index']);
    $router->post('/',['as' => 'store', 'uses' => 'DistrictController@store']);
    $router->get('/{district}',['as' => 'show', 'uses' => 'DistrictController@show']);
    $router->put('/{district}',['as' => 'update', 'uses' => 'DistrictController@update']);
    $router->delete('/{district}',['as' => 'delete', 'uses' => 'DistrictController@destroy']);
    $router->put('/restore/{district}',['as' => 'restore', 'uses' => 'DistrictController@restore']);
    $router->delete('/force-delete/{district}',['as' => 'forceDelete', 'uses' => 'DistrictController@forceDelete']);
});

$router->group([
    'prefix' => 'province',
    'as' => 'province.'
], function () use ($router) {
    $router->get('/',['as' => 'index', 'uses' => 'ProvinceController@index']);
    $router->post('/',['as' => 'store', 'uses' => 'ProvinceController@store']);
    $router->get('/{province}',['as' => 'show', 'uses' => 'ProvinceController@show']);
    $router->put('/{province}',['as' => 'update', 'uses' => 'ProvinceController@update']);
    $router->delete('/{province}',['as' => 'delete', 'uses' => 'ProvinceController@destroy']);
    $router->put('/restore/{province}',['as' => 'restore', 'uses' => 'ProvinceController@restore']);
    $router->delete('/force-delete/{province}',['as' => 'forceDelete', 'uses' => 'ProvinceController@forceDelete']);
});