<?php

use Illuminate\Support\Facades\Route;

Route::namespace('api')->get('home', 'HomeController@index');

Route::namespace('api')->get('menu', 'HomeController@menu');

Route::namespace('api')->get('footer', 'HomeController@footer');

Route::namespace('api')->get('product/{id}', 'ProductController@getProduct');

Route::namespace('api')->get('category/{id}/{children_id}', 'CategoryController@getSubCategory');

Route::namespace('api')->get('category/{id}', 'CategoryController@getCategory');
