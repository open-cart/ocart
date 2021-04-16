<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['web'],
    'namespace' => 'Ocart\Distributor\Http\Controllers',
], function () {
    Route::group([
        'prefix' => ADMIN_PREFIX,
        'middleware' => ADMIN_MIDDLEWARE,
    ],
        function () {
        Route::group(['prefix'=>'distributors', 'as' => 'distributors.'], function () {
            Route::resource('', 'DistributorController')->parameters(['' => 'id']);
        });
    });

    Route::get('list-distributor', 'DistributorController@list')->name('list-distributor');


});

//Route::group([
//    'middleware' => ['web'],
//    'namespace' => 'Ocart\Blog\Http\Controllers',
//], function () {
//    Route::get('post/{id}', 'PublicController@post');
//    Route::get('post-category/{id}', 'PublicController@postCategory');
//
//});
