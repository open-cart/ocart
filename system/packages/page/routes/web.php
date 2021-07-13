<?php

use \Illuminate\Support\Facades\Route;
use Ocart\Core\Facades\Slug;
use Ocart\Page\Models\Page;

//Route::group([]);

Route::group([
    'prefix' => ADMIN_PREFIX,
    'middleware' => ADMIN_MIDDLEWARE,
    'namespace' => 'Ocart\Page\Http\Controllers',
], function () {
    Route::group(['prefix'=>'page', 'as' => 'pages.'], function () {
        Route::resource(Slug::getPrefix(Page::class, ''), 'PageController')
            ->parameters(['' => 'id']);
    });
});
