<?php

use \Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => ADMIN_PREFIX,
    'middleware' => ADMIN_MIDDLEWARE,
    'namespace' => 'Ocart\Theme\Http\Controllers',
], function () {
    Route::group(['prefix'=>'theme'], function () {
//        Route::resource('', 'ThemeController')->parameters(['' => 'id']);
        Route::get('/all', [
            'as'         => 'themes.index',
            'uses'       => 'ThemeController@index',
            'permission' => 'theme.index',
        ]);

        Route::get('/options', [
            'as'         => 'theme.options',
            'uses'       => 'ThemeController@getOptions',
            'permission' => 'theme.index',
        ]);
        Route::post('/options', [
            'uses'       => 'ThemeController@postOptions',
            'permission' => 'theme.index',
        ]);

        Route::post('active', [
            'as'         => 'themes.activate',
            'uses'       => 'ThemeController@postActivateTheme',
            'permission' => 'theme.index',
        ]);
        Route::post('update', [
            'as'         => 'themes.update',
            'uses'       => 'ThemeController@postUpdateTheme',
            'permission' => 'theme.index',
        ]);
    });
});
