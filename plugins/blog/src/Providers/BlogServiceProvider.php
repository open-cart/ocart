<?php


namespace Ocart\Blog\Providers;


use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{

    public function boot()
    {

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-blog-post',
                'priority'    => 1,
                'parent_id'   => 'cms-core-content',
                'name'        => 'Blog/Tin tức',
                'icon'        => null,
                'url'         => '',
                'permissions' => [],
                'active'      => false,
            ]);
        });
    }
}
