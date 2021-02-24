<?php
use \Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => config('const.ADMIN_PREFIX', 'admin'),
        'middleware' => config('const.ADMIN_MIDDLEWARE', ['web']),
        'namespace' => config('const.ADMIN_NAMESPACE', 'Ocart\PluginManagement\Http\Controllers'),
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

