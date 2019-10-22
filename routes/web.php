<?php

Route::resource('users', 'UserController',[
    'only' => ['index', 'update','edit']
]);
