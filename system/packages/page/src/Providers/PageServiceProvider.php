<?php
namespace Ocart\Page\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Ocart\Core\Facades\Slug;
use Ocart\Page\Models\Page;
use Ocart\Page\Repositories\PageRepository;
use Ocart\Page\Repositories\PageRepositoryEloquent;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;

class PageServiceProvider extends \Illuminate\Support\ServiceProvider
{

    use  LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(PageRepository::class, PageRepositoryEloquent::class);

        Slug::registerPrefix(Page::class, [
            'label' => 'Pages',
            'value' => ''
        ]);
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
                'name' => trans('packages/page::pages.menu'),
                'icon' => null,
                'url' => route('pages.index'),
                'permissions' => [
                    'pages.index',
                    'pages.create',
                    'pages.update',
                    'pages.destroy',
                ],
                'active' => false,
            ]);
        });
    }
}
