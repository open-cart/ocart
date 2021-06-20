<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'web',
    'namespace' => 'Ocart\EcommerceReview\Http\Controllers',
], function () {
    Route::group([
        'prefix' => ADMIN_PREFIX,
        'middleware' => ADMIN_MIDDLEWARE,
        'as' => 'ec_review.'
    ], function () {
        Route::group(['prefix' => 'ec_review', 'as' => 'reviews.'], function () {
            Route::resource('', 'ReviewController')->parameters(['' => 'id']);
        });
    });
});

Route::group([
    'middleware' => ['web', 'auth'],
    'namespace' => 'Ocart\EcommerceReview\Http\Controllers',
], function () {
    Route::post('review/create', 'PublicController@postCreateReview')
        ->name(PUBLIC_ROUTE_REVIEWS_CREATE);
});