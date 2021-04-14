<?php


namespace Ocart\Distributor\Providers;


use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Core\Library\Helper;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
use Ocart\Distributor\Repositories\DistributorRepositoryEloquent;
use Ocart\Distributor\Repositories\Interfaces\DistributorRepository;

class DistributorServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(DistributorRepository::class, DistributorRepositoryEloquent::class);
    }

    public function boot()
    {
        $this
            ->setBasePath(base_path() .'/')
            ->setNamespace('plugins/distributor')
            ->loadAndPublishConfigurations([])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-distributors',
                'priority'    => 6,
                'parent_id'   => null,
                'name'        => trans('plugins/distributor::distributor.distributor'),
                'icon'        => null,
                'url'         => route('distributors.index'),
                'permissions' => [],
                'active'      => false,
            ])->registerItem([
                'id'          => 'cms-plugins-distributors-index',
                'priority'    => 102,
                'parent_id'   => 'cms-plugins-distributors',
                'name'        => trans('plugins/distributor::distributor.distributor'),
                'icon'        => null,
                'url'         => route('distributors.index'),
                'permissions' => [
                    'distributors.index',
                    'distributors.create',
                    'distributors.update',
                    'distributors.destroy',
                ],
                'active'      => false,
            ]);
        });
    }
}
