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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->post('register', 'AuthController@register');
        $router->post('sign-in', 'AuthController@postLogin');
        $router->post('recover-password', 'AuthController@recoverPassword');
    });
});
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->group(['prefix' => 'api'], function () use ($router) {
        $router->group(['prefix' => 'user'], function () use ($router) {
            $router->get('companies', 'CompanyController@list');
            $router->get('companies/{id}', 'CompanyController@company');
            $router->post('companies', 'CompanyController@create');
        });
    });
});
