<?php

use \Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => ADMIN_MIDDLEWARE,
        'namespace' => 'Ocart\\Dashboard\\Http\\Controllers',
    ],
    function() {
        Route::group([
            'prefix' => ADMIN_PREFIX,
        ], function() {
            Route::get('', 'DashboardController@index')->name('dashboard.index');
        });
    }
);