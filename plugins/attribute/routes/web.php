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

        Route::post('product/add_version', 'ProductController@addVersion')
            ->name('ecommerce.attribute_groups.add_version');
        Route::post('product/update_version', 'ProductController@updateVersion')
            ->name('ecommerce.attribute_groups.update_version');

    });
});
