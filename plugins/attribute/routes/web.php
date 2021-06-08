<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Ocart\Attribute\Http\Controllers',
], function () {
    Route::group([
        'prefix' => ADMIN_PREFIX,
        'middleware' => ADMIN_MIDDLEWARE,
    ], function () {
        Route::group(['prefix'=>'attribute_groups', 'as' => 'ecommerce.attribute_groups.'], function () {
            Route::resource('', 'ProductAttributeGroupController')->parameters(['' => 'id']);
        });
    });
});
