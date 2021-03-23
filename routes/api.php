<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('api')->get('home', 'HomeController@index');
Route::namespace('api')->get('menu', 'HomeController@menu');

Route::namespace('api')->get('product/{id}', 'ProductController@getProduct');

Route::namespace('api')->get('category/{parent_id}/{id}', 'CategoryController@getCategory');

//Route::namespace('api')->get('test', function(){
//    return response()->json([
//        'data' => 'My first test string'
//    ]);
//});



