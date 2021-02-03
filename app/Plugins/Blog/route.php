<?php

Route::group([
    'prefix' => ADMIN_PREFIX,
    'middleware' => ADMIN_MIDDLEWARE,
    'namespace' => 'App\Plugins\Blog\Admin',
], function () {
    Route::group(['prefix'=>'blog'], function () {
        Route::get('/', 'PageController@index')->name('plugin_blog::index');
    });
});
