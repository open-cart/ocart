<?php
use \Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => ADMIN_PREFIX,
        'middleware' => ADMIN_MIDDLEWARE,
        'namespace' => 'Ocart\PluginManagement\Http\Controllers',
    ],function() {
        Route::group(['prefix' => 'plugin'], function () {
            Route::get('/plugins', 'PluginManagementController@index')->name('admin::plugin');

            Route::post('/update', [
                'as' => 'plugins.change.status',
                'uses' => 'PluginManagementController@update',
                'permission' => 'plugins.index',
            ]);

//            Route::post('/enable', 'PluginManagementController@enable')->name('admin::enable');
//            Route::post('/disable', 'PluginManagementController@disable')->name('admin::disable');
            Route::post('/install', 'PluginManagementController@install')->name('admin_plugin::install');
            Route::post('/uninstall', 'PluginManagementController@uninstall')->name('admin_plugin::uninstall');
        });
});

