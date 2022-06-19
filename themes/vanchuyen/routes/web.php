<?php

use Illuminate\Support\Facades\Route;

Route::get('nguyen', function() {
    return Theme::layout('guest')->scope('test-page');
});

Route::group([
    'middleware' => 'web'
],
    function(){
        Route::get('user-profile', function () {
            return Theme::layout('default')->scope('user-profile');
        })->name('user-profile')->middleware(['auth']);

        Route::get('sitemap', function() {
            // create new sitemap object
            $sitemap = App::make('sitemap');

            // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
            // by default cache is disabled
            $sitemap->setCache('laravel.sitemap', 60);
            // check if there is cached sitemap and build new only if is not
            if (!$sitemap->isCached()) {
                // add item to the sitemap (url, date, priority, freq)
                $sitemap->add(URL::to('/'), date("Y/m/d h:i:sa"), '1.0', 'daily');

                // get all page
                $pages = \Ocart\Page\Models\Page::orderBy('created_at', 'desc')->get();
                // add every page to the sitemap
                foreach ($pages as $page) {
                    $sitemap->add($page->url, $page->created_at, '0.9', 'monthly');
                }

                if (is_active_plugin('ecommerce')){
                    // get all product & category
                    $categories_product = \Ocart\Ecommerce\Models\Category::orderBy('created_at', 'desc')->get();
                    $products = \Ocart\Ecommerce\Models\Product::orderBy('created_at', 'desc')->get();
                    // add every product & category to the sitemap
                    foreach ($categories_product as $category) {
                        $sitemap->add($category->url, $category->created_at, '1.0', 'monthly');
                    }
                    foreach ($products as $product) {
                        $sitemap->add($product->url, $product->created_at, '1.0', 'hourly');
                    }

                }

                if (is_active_plugin('blog')){
                    // get all posts & category
                    $categories_post = \Ocart\Blog\Models\Category::orderBy('created_at', 'desc')->get();
                    $posts = \Ocart\Blog\Models\Post::orderBy('created_at', 'desc')->get();
                    // add every post & category to the sitemap
                    foreach ($categories_post as $category) {
                        $sitemap->add($category->url, $category->created_at, '1.0', 'monthly');
                    }
                    foreach ($posts as $post) {
                        $sitemap->add($post->url, $post->created_at, '1.0', 'hourly');
                    }
                }
            }

            // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
            return $sitemap->render('xml');
        });
    }
);
