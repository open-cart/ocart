<?php
use \Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('packages.media.media.route.prefix'),
    'middleware' => ADMIN_MIDDLEWARE,
    'namespace' => 'Ocart\Media\Http\Controllers',
], function () {
    Route::get('', 'MediaController@index')->name('media.index');
    Route::get('list', 'MediaController@list')->name('media.list');

    Route::group(['prefix'=> 'files'], function () {
        Route::post('upload', [
            'as'   => 'media.files.upload',
            'uses' => 'MediaFileController@postUpload',
        ]);
    });

    Route::group(['prefix' => 'folders'], function () {
        Route::post('create', [
            'as'   => 'media.folders.create',
            'uses' => 'MediaFolderController@store',
        ]);
    });
});
