<?php

use \Illuminate\Support\Facades\Route;

//Route::group([]);

Route::group([
    'prefix' => ADMIN_PREFIX,
    'middleware' => ADMIN_MIDDLEWARE,
    'namespace' => 'Ocart\Page\Http\Controllers',
], function () {
    Route::group(['prefix'=>'page', 'as' => 'pages.'], function () {
        Route::resource('', 'PageController')
            ->parameters(['' => 'id']);
    });
});
