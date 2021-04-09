<?php


namespace Ocart\Blog\Providers;


use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Blog\Models\Category;
use Ocart\Blog\Models\Post;
use Ocart\Blog\Models\Tag;
use Ocart\Blog\Repositories\CategoryRepositoryEloquent;
use Ocart\Blog\Repositories\Interfaces\CategoryRepository;
use Ocart\Blog\Repositories\Interfaces\PostRepository;
use Ocart\Blog\Repositories\Interfaces\TagRepository;
use Ocart\Blog\Repositories\PostRepositoryEloquent;
use Ocart\Blog\Repositories\TagRepositoryEloquent;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
use Ocart\SeoHelper\Facades\SeoHelper;

class BlogServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(PostRepository::class, PostRepositoryEloquent::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(TagRepository::class, TagRepositoryEloquent::class);
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
                'priority'    => 101,
                'parent_id'   => 'cms-core-content',
                'name'        => 'Blog/Tin tức',
                'icon'        => null,
                'url'         => route('blog.posts.index'),
                'permissions' => [
                    'blog.posts.index',
                    'blog.posts.create',
                    'blog.posts.update',
                    'blog.posts.destroy',
                ],
                'active'      => false,
            ])->registerItem([
                'id'          => 'cms-plugins-blog-categories',
                'priority'    => 102,
                'parent_id'   => 'cms-core-content',
                'name'        => 'Danh mục',
                'icon'        => null,
                'url'         => route('blog.categories.index'),
                'permissions' => [
                    'blog.categories.index',
                    'blog.categories.create',
                    'blog.categories.update',
                    'blog.categories.destroy',
                ],
                'active'      => false,
            ])->registerItem([
                'id'          => 'cms-plugins-blog-tags',
                'priority'    => 103,
                'parent_id'   => 'cms-core-content',
                'name'        => 'Tags',
                'icon'        => null,
                'url'         => route('blog.tags.index'),
                'permissions' => [
                    'blog.tags.index',
                    'blog.tags.create',
                    'blog.tags.update',
                    'blog.tags.destroy',
                ],
                'active'      => false,
            ]);
        });

        $this->booted(function () {
            SeoHelper::registerModule([Post::class, Category::class, Tag::class]);
        });
    }
}
