<?php

Route::group([
    'prefix' => ADMIN_PREFIX,
    'middleware' => ADMIN_MIDDLEWARE,
    'namespace' => 'App\Plugins\Blog\Admin',
], function () {
    Route::group(['prefix'=>'blog'], function () {
        Route::get('/', 'PageController@index')->name('plugin_blog::admin.index');
        Route::get('/create', 'PageController@create')->name('plugin_blog::admin.create');
        Route::post('/create', 'PageController@createPost')->name('plugin_blog::admin.create');
        Route::post('/delete', 'PageController@delete')->name('plugin_blog::admin.delete');
        Route::get('/edit/{id}', 'PageController@edit')->name('plugin_blog::admin.edit');
        Route::post('/edit/{id}', 'PageController@editPost')->name('plugin_blog::admin.edit');
    });
});
