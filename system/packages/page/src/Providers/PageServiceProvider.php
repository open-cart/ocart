<?php
namespace Ocart\Page\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Ocart\Page\Repositories\PageDescriptionRepository;
use Ocart\Page\Repositories\PageDescriptionRepositoryEloquent;
use Ocart\Page\Repositories\PageRepository;
use Ocart\Page\Repositories\PageRepositoryEloquent;
use System\Core\Library\Helper;
use System\Core\Traits\LoadAndPublishDataTrait;

class PageServiceProvider extends \Illuminate\Support\ServiceProvider
{

    use  LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(PageRepository::class, PageRepositoryEloquent::class);
        $this->app->bind(PageDescriptionRepository::class, PageDescriptionRepositoryEloquent::class);
    }

    public function boot()
    {
        $this->setNamespace('packages/page')
            ->loadAndPublishConfigurations(['general'])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations();
        $this->loadViewsFrom(__DIR__ . '/../../resources/views','blog');

        add_filter(BEFORE_QUERY_CRITERIA, function ($query, $model) {
            return $query;
        }, 1, 2);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id' => 'cms-core-content',
                'parent_id' => null,
                'name' => 'packages/page::pages.content',
                'icon' => null,
                'url' => '',
                'permissions' => [],
                'active' => false,
            ])->registerItem([
                'id' => 'cms-core-content-page',
                'parent_id' => 'cms-core-content',
                'name' => 'packages/page::pages.menu',
                'icon' => null,
                'url' => route('pages.index'),
                'permissions' => [],
                'active' => false,
            ]);
        });
    }
}
