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
            Route::get('general', [
                'as'         => 'settings.options',
                'uses'       => 'SettingController@getOptions',
                'permission' => 'settings.options',
            ]);

            Route::post('general/edit', [
                'as'         => 'settings.edit',
                'uses'       => 'SettingController@postEdit',
                'permission' => 'settings.options',
            ]);

            Route::get('permalink', [
                'as' => 'slug.settings',
                'uses' => 'SettingController@getPermalink',
                'permission' => 'settings.options'
            ]);

            Route::post('permalink', [
                'uses' => 'SettingController@postPermalink',
                'permission' => 'settings.options'
            ]);

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