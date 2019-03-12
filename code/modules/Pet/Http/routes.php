<?php

Route::group(['middleware' => 'web', 'prefix' => 'pet', 'namespace' => 'modules\Pet\Http\Controllers'], function()
{
    Route::get('/', 'PetController@index');
});
