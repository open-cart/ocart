<?php


namespace Ocart\Blog\Providers;


use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Blog\Repositories\PostRepository;
use Ocart\Blog\Repositories\PostRepositoryEloquent;
use System\Core\Library\Helper;
use System\Core\Traits\LoadAndPublishDataTrait;

class BlogServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(PostRepository::class, PostRepositoryEloquent::class);
    }

    public function boot()
    {
        $this
            ->setBasePath(base_path() .'/')
            ->setNamespace('plugins/blog')
            ->loadAndPublishConfigurations([])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
//            ->loadAndPublishTranslations()
            ->loadMigrations();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-blog-post',
                'priority'    => 1,
                'parent_id'   => 'cms-core-content',
                'name'        => 'Blog/Tin tức',
                'icon'        => null,
                'url'         => route('posts.index'),
                'permissions' => [],
                'active'      => false,
            ]);
        });
    }
}
