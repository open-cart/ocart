<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => ADMIN_PREFIX,
    'middleware' => ADMIN_MIDDLEWARE,
    'namespace' => 'Ocart\Blog\Http\Controllers',
], function () {
    Route::group(['prefix'=>'posts', 'as' => 'posts.'], function () {
        Route::resource('', 'PostController')->parameters(['' => 'id']);
    });
    Route::group(['prefix'=>'tags', 'as' => 'blog.tags.'], function () {
        Route::resource('', 'TagController')->parameters(['' => 'id']);
    });
    Route::group(['prefix'=>'categories', 'as' => 'blog.categories.'], function () {
        Route::resource('', 'CategoryController')->parameters(['' => 'id']);
    });
});
