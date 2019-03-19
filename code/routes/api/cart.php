<?php
Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'cart', 'namespace' => 'Modules\Cart\Http\Controllers'], function () {
        Route::get('/search', 'CartController@search');
        Route::post('/create', 'CartController@create')->middleware('cors');
    });
});

