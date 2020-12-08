<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index')->name('home');
Route::get('category', 'HomeController@Category')->name('category');

Route::get('product/{id}', 'ProductController@getProduct');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::post('test1', 'TestController@test')->name('test1');
});

Route::get('test', 'TestController@index')->name('test');
Route::get('test/ip','TestController@getMailing');
Route::get('test/pagin', 'TestController@home');
Route::get('stripe', 'StripePaymentController@stripe')->middleware('test');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post')->middleware('test');

Route::get('portmone', 'PortmoneController@index');
Route::get('success', 'PortmoneController@success')->name('success');

Route::get('face', 'FaceController@getAllCategory');
Route::post('buyCartHome', 'CartController@insInCartHome');
Route::post('buyCart', 'CartController@insInCart');
Route::post('delCart', 'CartController@delCart');
Route::get('checkout', 'CartController@checkout');

