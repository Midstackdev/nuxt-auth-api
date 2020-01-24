<?php

Route::group(['namespace' => 'Auth'], function() {

    Route::post('/register', 'RegisterController@register');
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LogoutController@logout');

    Route::get('/user', 'MeController@me');

});