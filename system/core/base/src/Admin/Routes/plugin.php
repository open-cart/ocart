<?php

Route::group(['prefix' => 'plugin'], function () {
    Route::get('/plugins', 'PluginController@index')->name('admin::plugin');
    Route::post('/enable', 'PluginController@enable')->name('admin_plugin::enable');
    Route::post('/disable', 'PluginController@disable')->name('admin_plugin::disable');
    Route::post('/install', 'PluginController@install')->name('admin_plugin::install');
    Route::post('/uninstall', 'PluginController@uninstall')->name('admin_plugin::uninstall');
});
