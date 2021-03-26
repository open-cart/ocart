<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Ocart\Blog\Http\Controllers',
], function () {
    Route::group([
        'prefix' => ADMIN_PREFIX,
        'middleware' => ADMIN_MIDDLEWARE,
    ], function () {
        Route::group(['prefix'=>'posts', 'as' => 'blog.posts.'], function () {
            Route::resource('', 'PostController')->parameters(['' => 'id']);
        });
        Route::group(['prefix'=>'tags', 'as' => 'blog.tags.'], function () {
            Route::resource('', 'TagController')->parameters(['' => 'id']);
        });
        Route::group(['prefix'=>'categories', 'as' => 'blog.categories.'], function () {
            Route::resource('', 'CategoryController')->parameters(['' => 'id']);
        });
    });

    Route::group([
        'middleware' => ['web'],
    ], function () {
        // controller public
    });
});

Route::group([
    'middleware' => ['web'],
    'namespace' => 'Ocart\Blog\Http\Controllers',
], function () {
    Route::get('post/{id}', 'PublicController@post');
    Route::get('post-category/{id}', 'PublicController@postCategory');

});
