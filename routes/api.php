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

    Route::group(['prefix' => 'checkout'], function () {
        Route::post('/regions', 'CheckoutController@getRegions')
            ->name('checkout.regions.get');

        Route::post('/cities', 'CheckoutController@getRegionCities')
            ->name('checkout.cities.get');

        Route::post('/postal/offices', 'CheckoutController@getPostalOffices')
            ->name('checkout.postal.offices.get');
    });
});
