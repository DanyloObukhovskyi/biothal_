<?php

use Illuminate\Support\Facades\Route;

Route::namespace('api')->get('home', 'HomeController@index');

Route::namespace('api')->get('menu', 'HomeController@menu');

Route::namespace('api')->get('footer', 'HomeController@footer');

Route::namespace('api')->get('category/{parent_id}/{id}', 'CategoryController@getCategory');

Route::namespace('api')->get('category/{id}/{children_id}', 'CategoryController@getSubCategory');

Route::namespace('api')->get('category/{id}', 'CategoryController@getCategory');

Route::group(['namespace' => 'Api'], function () {
    Route::group(['prefix' => 'sales'], function () {
        Route::post('/global', 'SalesController@getGlobalSales')
            ->name('sales.global.all');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::post('/recommended', 'ProductController@getRecommendedProduct')
            ->name('sales.global.all');
    });

    Route::namespace('api')
        ->get('product/{id}', 'ProductController@getProduct');
});
//Route::namespace('api')->get('test', function(){
//    return response()->json([
//        'data' => 'My first test string'
//    ]);
//});

//Route::namespace('api')->post('login', 'Auth\LoginController@loginToProfile');
//Route::namespace('api')->post('loggedOut', 'Auth\LoginController@loggedOut');

Route::post('register', 'Auth\RegisterController@create');
Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::post('refresh', 'AuthController@refresh');
Route::post('me', 'AuthController@me');
Route::post('checkUser', 'AuthController@checkUser');
Route::post('profile', 'ProfileController@getProfile');
Route::post('updateProfile', 'ProfileController@updateProfile');
Route::post('changePassword', 'ProfileController@changePassword');
Route::post('addImage', 'ProfileController@addImage');
Route::post('deleteImage', 'ProfileController@deleteImage');
