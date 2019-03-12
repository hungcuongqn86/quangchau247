<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'App\Http\Controllers\API\PassportController@login');
Route::post('register', 'App\Http\Controllers\API\PassportController@register');
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('get-details', 'App\Http\Controllers\API\PassportController@getDetails');
});

// API Routes System
Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'media'], function () {
        Route::group(['namespace' => 'Modules\Common\Http\Controllers'], function () {
            Route::post('/upload', 'MediaController@upload');
            Route::delete('/delete', 'MediaController@delete');
        });
    });
});

// API Routes Pet
require __DIR__ . '/api/pet.php';