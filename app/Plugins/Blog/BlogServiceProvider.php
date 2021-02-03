<?php


namespace App\Plugins\Blog;


use Core\Library\Menu\Link;
use Core\Library\Menu\Menu;
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
    }

    public function boot()
    {
        Menu::make('admin', function ($menu) {
            $menu->get('store')->appendMenu(
                Link::noLink(__('Plugins/Blog::lang.blog_content')),
            )->addChildren(function ($item) {
                $item->add(
                    Link::route('plugin_blog::index', __('Plugins/Blog::lang.page_title'))
                );
                $item->add(
                    Link::to('',  __('Plugins/Blog::lang.news_title'))
                );
            });
        });
    }
}
