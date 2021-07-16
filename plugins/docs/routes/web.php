<?php

Route::group([
    'middleware' => ['web'],
    'namespace' => 'Ocart\Docs\Http\Controllers',
], function () {
    Route::get('cms/{version}/{slug}', 'PublicController@post')->name('docs_view');

    Route::post('/preview-markdown', function () {
        return \Ocart\Docs\Markdown::parse(request()->input('text'));
    });
});