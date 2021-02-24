<?php

use \Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => ADMIN_PREFIX,
    'middleware' => ADMIN_MIDDLEWARE,
    'namespace' => 'Ocart\Theme\Http\Controllers',
], function () {
    Route::group(['prefix'=>'theme'], function () {
//        Route::resource('', 'ThemeController')->parameters(['' => 'id']);
        Route::get('/', [
            'as'         => 'themes.index',
            'uses'       => 'ThemeController@index',
            'permission' => 'theme.index',
        ]);

        Route::post('active', [
            'as'         => 'theme.active',
            'uses'       => 'ThemeController@postActivateTheme',
            'permission' => 'theme.index',
        ]);
    });
});
