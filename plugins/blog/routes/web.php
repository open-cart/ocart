<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => ADMIN_PREFIX,
    'middleware' => ADMIN_MIDDLEWARE,
    'namespace' => 'Ocart\Blog\Http\Controllers',
], function () {
    Route::group(['prefix'=>'post', 'as' => 'posts.'], function () {
        Route::resource('', 'PostController')->parameters(['' => 'id']);
    });
});
