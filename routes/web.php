<?php

use App\Http\Controllers\ProvinceController;

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
    'prefix' => 'province',
    'as' => 'province.'
], function () use ($router) {
    $router->get('/',['as' => 'index', 'uses' => 'ProvinceController@index']);
    $router->post('/',['as' => 'store', 'uses' => 'ProvinceController@store']);
    $router->get('/{province}',['as' => 'show', 'uses' => 'ProvinceController@show']);
    $router->put('/{province}',['as' => 'update', 'uses' => 'ProvinceController@update']);
    $router->delete('/{province}',['as' => 'delete', 'uses' => 'ProvinceController@destroy']);
});