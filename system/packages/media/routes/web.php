<?php
use \Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Ocart\Media\Repositories\Interfaces\MediaFileRepository;

Route::group([
    'prefix' => config('packages.media.media.route.prefix'),
    'middleware' => ['web'],
//    'middleware' => ADMIN_MIDDLEWARE,
    'namespace' => 'Ocart\Media\Http\Controllers',
], function () {
    Route::get('', 'MediaController@index')->name('media.index');
    Route::get('list', 'MediaController@list')->name('media.list');

    Route::post('delete_file', 'MediaController@delete')->name('media.delete');

    Route::post('rename', 'MediaController@postRename')->name('media.rename');

    Route::group(['prefix'=> 'files'], function () {
        Route::post('upload', [
            'as'   => 'media.files.upload',
            'uses' => 'MediaFileController@postUpload',
        ]);
    });

    Route::group(['prefix' => 'folders'], function () {
        Route::post('create', [
            'as'   => 'media.folders.create',
            'uses' => 'MediaFolderController@store',
        ]);
    });
});

Route::get('storage/images/{img}', function ($img) {
    $repo = app(MediaFileRepository::class);
    $file = $repo->findByField('name', File::name($img))->first();
    if (!$file) {
        $file = $repo->findByField('name', $img)->first();
    }
    if ($file) {
        $img = str_replace('upload/', '', $file->url);
    }

    $fm = '';

    if( strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' ) !== false ) {
        // webp is supported!
        $fm = 'webp';
    }

    $server = League\Glide\ServerFactory::create([
        'source' => Storage::path('upload'),
        'cache' => storage_path('framework/cache/images'),
//        'driver' => 'imagick',
    ]);

    $req = request();
    $req->merge(['fm' => $fm]);
    //$req->merge(['fit' => 'crop']);

    $server->outputImage($img, $req->all());
});