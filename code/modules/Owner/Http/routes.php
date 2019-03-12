<?php

Route::group(['middleware' => 'web', 'prefix' => 'owner', 'namespace' => 'Modules\Owner\Http\Controllers'], function()
{
    Route::get('/', 'OwnerController@index');
});
