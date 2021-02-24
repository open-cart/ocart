<?php


namespace App\Plugins\Blog;


use App\Plugins\Blog\Repositories\PageDescriptionRepository;
use App\Plugins\Blog\Repositories\PageDescriptionRepositoryEloquent;
use App\Plugins\Blog\Repositories\PageRepository;
use App\Plugins\Blog\Repositories\PageRepositoryEloquent;
use System\Core\Library\MapData;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadTranslationsFrom(__DIR__ . '/Lang/', 'Plugins/Blog');
        $this->loadViewsFrom(__DIR__ . '/Views', 'blog');

        $this->loadRoutesFrom(__DIR__ . '/route.php');
        require_once __DIR__ . '/helpers.php';

        $this->app->bind(PageRepository::class, PageRepositoryEloquent::class);
        $this->app->bind(PageDescriptionRepository::class, PageDescriptionRepositoryEloquent::class);
    }

    public function boot()
    {
//        Menu::make('admin', function ($menu) {
//            $menu->get('store')->appendMenu(
//                Link::noLink(__('Plugins/Blog::lang.blog_content')),
//            )->addChildren(function ($item) {
//                $item->add(
//                    Link::route('plugin_blog::admin.index', __('Plugins/Blog::lang.page_title'))
//                );
//                $item->add(
//                    Link::to('',  __('Plugins/Blog::lang.news_title'))
//                );
//            });
//        });

        MapData::make('plugin::post', function ($data) {
            $data->register('store_id', 'session_store_id', session('store_id', 1));
        });
    }
}
