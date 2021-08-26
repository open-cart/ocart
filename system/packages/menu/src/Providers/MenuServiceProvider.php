<?php

namespace Ocart\Menu\Providers;

use Ocart\Core\Library\Helper;
use \Ocart\Core\Traits\LoadAndPublishDataTrait;
use \Illuminate\Support\ServiceProvider;
use Ocart\Menu\Repositories\MenuNodeRepository;
use Ocart\Menu\Repositories\MenuRepository;
use Ocart\Menu\Repositories\Caches\MenuCacheDecorator;
use Ocart\Menu\Repositories\Caches\MenuNodeCacheDecorator;

class MenuServiceProvider extends ServiceProvider
{
    use  LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->bind(MenuRepository::class, MenuCacheDecorator::class);
        $this->app->bind(MenuNodeRepository::class, MenuNodeCacheDecorator::class);

    }

    public function boot()
    {
        $this->setNamespace('packages/menu')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations();
    }
}