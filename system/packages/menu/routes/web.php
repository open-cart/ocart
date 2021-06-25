<?php

use \Illuminate\Support\Facades\Route;

//Route::group([]);

Route::group([
    'prefix' => ADMIN_PREFIX,
    'middleware' => ADMIN_MIDDLEWARE,
    'namespace' => 'Ocart\Menu\Http\Controllers',
], function () {
    Route::group(['prefix'=>'menu', 'as' => 'menus.'], function () {
        Route::resource('', 'MenuController')
            ->parameters(['' => 'id']);
    });
});
