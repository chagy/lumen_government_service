<?php
$router->post('/auth/register',['as' => 'register','uses' => 'AuthController@register']);

$router->get('/test/auth',['middleware' => 'auth:api',function() {
    return auth()->user();
}]);


$router->group([
    'prefix'        => 'government-service',
    'as'            => 'government.service.',
    'middleware'    => 'auth:api'
], function () use ($router) {
    $router->get('/',['as' => 'index', 'uses' => 'GovernmentServiceController@index']);
    $router->post('/',['as' => 'store', 'uses' => 'GovernmentServiceController@store']);
    $router->get('/{department}',['as' => 'show', 'uses' => 'GovernmentServiceController@show']);
    $router->put('/{department}',['as' => 'update', 'uses' => 'GovernmentServiceController@update']);
    $router->delete('/{department}',['as' => 'delete', 'uses' => 'GovernmentServiceController@destroy']);
    $router->put('/restore/{department}',['as' => 'restore', 'uses' => 'GovernmentServiceController@restore']);
    $router->delete('/force-delete/{department}',['as' => 'forceDelete', 'uses' => 'GovernmentServiceController@forceDelete']);
});

$router->group([
    'prefix' => 'department',
    'as' => 'department.'
], function () use ($router) {
    $router->get('/',['as' => 'index', 'uses' => 'DepartmentController@index']);
    $router->post('/',['as' => 'store', 'uses' => 'DepartmentController@store']);
    $router->get('/{department}',['as' => 'show', 'uses' => 'DepartmentController@show']);
    $router->put('/{department}',['as' => 'update', 'uses' => 'DepartmentController@update']);
    $router->delete('/{department}',['as' => 'delete', 'uses' => 'DepartmentController@destroy']);
    $router->put('/restore/{department}',['as' => 'restore', 'uses' => 'DepartmentController@restore']);
    $router->delete('/force-delete/{department}',['as' => 'forceDelete', 'uses' => 'DepartmentController@forceDelete']);
});

$router->group([
    'prefix' => 'position',
    'as' => 'position.'
], function () use ($router) {
    $router->get('/',['as' => 'index', 'uses' => 'PositionController@index']);
    $router->post('/',['as' => 'store', 'uses' => 'PositionController@store']);
    $router->get('/{position}',['as' => 'show', 'uses' => 'PositionController@show']);
    $router->put('/{position}',['as' => 'update', 'uses' => 'PositionController@update']);
    $router->delete('/{position}',['as' => 'delete', 'uses' => 'PositionController@destroy']);
    $router->put('/restore/{position}',['as' => 'restore', 'uses' => 'PositionController@restore']);
    $router->delete('/force-delete/{position}',['as' => 'forceDelete', 'uses' => 'PositionController@forceDelete']);
});

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