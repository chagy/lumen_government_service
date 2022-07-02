<?php

$router->group([
    'prefix' => 'sub-district',
    'as' => 'sub.district.'
], function () use ($router) {
    $router->get('/',['as' => 'index', 'uses' => 'SubDistrictController@index']);
    $router->post('/',['as' => 'store', 'uses' => 'SubDistrictController@store']);
    $router->get('/{sub_district}',['as' => 'show', 'uses' => 'SubDistrictController@show']);
    $router->put('/{sub_district}',['as' => 'update', 'uses' => 'SubDistrictController@update']);
    $router->delete('/{sub_district}',['as' => 'delete', 'uses' => 'SubDistrictController@destroy']);
    $router->put('/restore/{sub_district}',['as' => 'restore', 'uses' => 'SubDistrictController@restore']);
    $router->delete('/force-delete/{sub_district}',['as' => 'forceDelete', 'uses' => 'SubDistrictController@forceDelete']);
});

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