<?php

Route::namespace('Api')->group(function () {
    Route::group(['prefix' => 'v1', 'namespace' => 'V1'], function () {
        Route::resource('users', 'UsersController',['except'=>['create','edit']]);
    });
});