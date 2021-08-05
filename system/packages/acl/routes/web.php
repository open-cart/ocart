<?php

use \Illuminate\Support\Facades\Route;

//Route::group([]);

Route::group([
    'prefix' => ADMIN_PREFIX,
    'middleware' => ADMIN_MIDDLEWARE,
    'namespace' => 'Ocart\Acl\Http\Controllers',
    'as' => 'system.'
], function () {
    Route::group(['prefix'=>'users', 'as' => 'users.'], function () {
        Route::resource('', 'UserController')->parameters(['' => 'id']);
    });
    Route::group(['prefix'=>'roles', 'as' => 'roles.'], function () {
        Route::resource('', 'RoleController')->parameters(['' => 'id']);
    });
});

//dd(\App\Models\Admin::first()->hasPermission('ads.index1'));
//dd(\Ocart\Acl\Models\Role::first()->roles);