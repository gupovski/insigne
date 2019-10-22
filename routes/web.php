<?php
Route::get('users/{$id}/{$subscribe_id}/edit', 'UserController@edit')->name('user.edit');

Route::resource('users', 'UserController',[
    'only' => ['index', 'update','edit']
]);
