<?php

use \Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => ADMIN_MIDDLEWARE,
        'namespace' => 'Ocart\\Setting\\Http\\Controllers',
    ],
    function() {
        Route::group([
            'prefix' => ADMIN_PREFIX,
        ], function() {
            Route::group(['prefix' => 'email', 'permission' => 'settings.email'], function () {
                Route::get('', [
                    'as'   => 'settings.email',
                    'uses' => 'SettingController@getEmailConfig',
                ]);

                Route::post('', [
                    'as'   => 'settings.email.edit',
                    'uses' => 'SettingController@postEditEmailConfig',
                ]);

                Route::get('templates/edit/{name}', [
                    'as'   => 'settings.email.template.edit',
                    'uses' => 'SettingController@getEditEmailTemplate',
                ]);

                Route::post('templates/edit/{name}', [
                    'as'   => 'settings.email.template.store',
                    'uses' => 'SettingController@postEditEmailTemplate',
                ]);

                Route::post('test/send', [
                    'as'   => 'setting.email.send.test',
                    'uses' => 'SettingController@postSendTestEmail',
                ]);
            });
        });
    }
);