<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Ocart\Contact\Http\Controllers',
], function () {
    Route::group([
        'prefix' => ADMIN_PREFIX,
        'middleware' => ADMIN_MIDDLEWARE,
    ], function () {
        Route::group(['prefix'=>'contacts', 'as' => 'contacts.'], function () {
            Route::resource('', 'ContactController')->parameters(['' => 'id']);
        });
    });

    Route::group(['middleware' => 'web'], function (){
        Route::post('contact/send', [
            'as'   => 'public.send.contact',
            'uses' => 'PublicController@postSendContact',
        ]);
    });
});