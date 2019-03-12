<?php
Route::group(['prefix' => 'v1'], function () {
    // API Routes Sim
    Route::group(['prefix' => 'mpet', 'namespace' => 'Modules\Pet\Http\Controllers\V1'], function () {
        Route::group(['prefix' => 'pet'], function () {
            Route::get('/search', 'PetController@search');
            Route::get('/detail/{id}', 'PetController@detail');
            Route::post('/create', 'PetController@create');
            Route::put('/update', 'PetController@update');
            Route::delete('/delete', 'PetController@delete');
        });
        Route::group(['prefix' => 'pettype'], function () {
            Route::get('/search', 'PettypeController@search');
            Route::get('/detail/{id}', 'PettypeController@detail');
            Route::post('/create', 'PettypeController@create');
            Route::put('/update', 'PettypeController@update');
            Route::delete('/delete', 'PettypeController@delete');
        });
    });
});
