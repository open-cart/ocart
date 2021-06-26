<?php

use \Illuminate\Support\Facades\Route;

\Illuminate\Support\Facades\Route::group([
//    'prefix' => ADMIN_PREFIX,
    'middleware' => ['web'],
    'namespace' => 'Ocart\Theme\Http\Controllers',
], function () {
    Route::group(['prefix'=>''], function () {
        Route::get('/', 'PublicController@getIndex')->name('home');

        Route::get('{slug?}.html', [
            'as'   => 'public.single',
            'uses' => 'PublicController@getView',
        ])->name('public_page');
    });
});
