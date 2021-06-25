<?php
namespace Ocart\Menu\Providers;

use Ocart\Core\Library\Helper;
use \Ocart\Core\Traits\LoadAndPublishDataTrait;
use \Illuminate\Support\ServiceProvider;
use Ocart\Menu\Repositories\MenuNodeRepository;
use Ocart\Menu\Repositories\MenuNodeRepositoryEloquent;
use Ocart\Menu\Repositories\MenuRepository;
use Ocart\Menu\Repositories\MenuRepositoryEloquent;

class MenuServiceProvider extends ServiceProvider
{
    use  LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(MenuRepository::class, MenuRepositoryEloquent::class);
        $this->app->bind(MenuNodeRepository::class, MenuNodeRepositoryEloquent::class);

    }

    public function boot()
    {
        $this->setNamespace('packages/menu')
//            ->loadAndPublishConfigurations(['general'])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations();
    }
}