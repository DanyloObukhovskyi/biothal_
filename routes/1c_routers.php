<?php

/**
 * Routers for 1C urls.
 * */
Route::group(['prefix' => 'import'], function () {

    Route::get('/get/data', 'ImportTo1CController@getDataToImport');
    Route::get('/get/test_data', 'ImportTo1CController@getDataToImport');
    Route::get('/get/hard_data', 'ImportTo1CController@getDataToImport');

});