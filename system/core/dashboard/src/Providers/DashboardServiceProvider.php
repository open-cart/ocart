<?php
namespace Ocart\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
use Ocart\Dashboard\Repositories\DashboardWidgetRepository;
use Ocart\Dashboard\Repositories\DashboardWidgetRepositoryEloquent;
use Ocart\Dashboard\Repositories\DashboardWidgetSettingRepository;
use Ocart\Dashboard\Repositories\DashboardWidgetSettingRepositoryEloquent;
use Ocart\Dashboard\Supports\DashboardWidgetBuilder;

class DashboardServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->setNamespace('core/dashboard');
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(DashboardWidgetRepository::class, DashboardWidgetRepositoryEloquent::class);
        $this->app->bind(DashboardWidgetSettingRepository::class, DashboardWidgetSettingRepositoryEloquent::class);
    }

    public function boot()
    {
        $this
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadAndPublishConfigurations([])
            ->loadMigrations()
            ->publishAssets();

//        Gate::define('dashboard.index', function () {
//            return true;
//        });

//        Event::listen(RouteMatched::class, function () {
//            dashboard_menu()
//                ->registerItem([
//                    'id'          => 'cms-core-dashboard',
//                    'priority'    => 0,
//                    'parent_id'   => null,
//                    'name'        => 'core/base::layouts.dashboard',
//                    'icon'        => 'fa fa-home',
//                    'url'         => route('dashboard.index'),
//                    'permissions' => ['public'],
//                ]);
//        });

//        add_dashboard_widget(1)->useStatsWidget()->setKey('widget_posts_recent');
//        add_dashboard_widget(2)->useStatsWidget()->setKey('widget_posts_recent2');
//        add_dashboard_widget(3)->useStatsWidget()->setKey('widget_posts_recent3');
//        add_dashboard_widget(4)->useStatsWidget()->setKey('widget_posts_recent4');
//        add_dashboard_widget(5)->setKey('widget_posts_recent6');
    }
}