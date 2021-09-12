<?php

use Illuminate\Support\Facades\Route;
use Ocart\Core\Facades\Slug;
use \Ocart\Blog\Models\Post;
use Ocart\Blog\Models\Category;
use Ocart\Blog\Models\Tag;

Route::group([
    'namespace' => 'Ocart\Blog\Http\Controllers',
], function () {
    Route::group([
        'prefix' => ADMIN_PREFIX,
        'middleware' => ADMIN_MIDDLEWARE,
    ], function () {
        Route::group(['prefix'=>'posts', 'as' => 'blog.posts.'], function () {
            Route::resource('', 'PostController')->parameters(['' => 'id']);
        });
        Route::group(['prefix'=>'tags', 'as' => 'blog.tags.'], function () {
            Route::resource('', 'TagController')->parameters(['' => 'id']);
        });
        Route::group(['prefix'=>'categories', 'as' => 'blog.categories.'], function () {
            Route::resource('', 'CategoryController')->parameters(['' => 'id']);
        });

        Route::get('ajax_search_tags', 'TagController@ajaxSearchTags')->name('ajax_search_tags');
    });

    Route::group([
        'middleware' => ['web'],
    ], function () {
        // controller public
    });
});

// Route frontend
Route::group([
    'middleware' => ['web'],
    'namespace' => 'Ocart\Blog\Http\Controllers',
], function () {
    Route::get(Slug::getPrefix(Post::class, 'post').'/{slug}', 'PublicController@post')
        ->name(ROUTE_BLOG_POST_SCREEN_NAME);

    Route::get(Slug::getPrefix(Category::class, 'post-category').'/{slug}', 'PublicController@postCategory')
        ->name(ROUTE_BLOG_POST_CATEGORY_SCREEN_NAME);

    Route::get(Slug::getPrefix(Tag::class, 'post-tag').'/{slug}', 'PublicController@postTag')
        ->name(ROUTE_BLOG_POST_TAG_SCREEN_NAME);

    Route::get(Slug::getPrefix(Post::class, 'post'), 'PublicController@blog')
        ->name(ROUTE_BLOG_PAGE_SCREEN_NAME);
});
