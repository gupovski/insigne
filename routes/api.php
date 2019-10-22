<?php

Route::middleware('api.basic.auth')->group(function () {

    Route::resource('user', 'Api\ApiUserController',[
        'only' => ['show','update']
    ]);

    Route::get('users', 'Api\ApiUserController@index');
});
