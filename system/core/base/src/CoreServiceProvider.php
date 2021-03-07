<?php

namespace System\Core;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Routing\ResourceRegistrar;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Prettus\Repository\Criteria\RequestCriteria;
use System\Core\Library\CustomResourceRegistrar;
use System\Core\Providers\BreadcrumsServiceProvider;
use System\Core\Repositories\MetaBoxRepository;
use System\Core\Repositories\MetaBoxRepositoryEloquent;
use System\Core\Traits\LoadAndPublishDataTrait;
use Illuminate\Database\Schema\Builder;

class CoreServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        parent::register();
        foreach (glob(__DIR__.'/../helpers/*.php') as $filename) {
            require_once $filename;
        }

//        $this->app->bind(LengthAwarePaginator::class, CustomPaginator::class);
        $this->app->bind(ResourceRegistrar::class, CustomResourceRegistrar::class);
        $this->app->bind(MetaBoxRepository::class, MetaBoxRepositoryEloquent::class);
        $this->app->bind(RequestCriteria::class, \System\Core\Criteria\RequestCriteria::class);


        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'core');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'core/base');

        $this->app->register(BreadcrumsServiceProvider::class);

        Builder::defaultStringLength(191);
    }

    public function boot()
    {
        $this->setNamespace('core/base')->loadMigrations()->loadAndPublishTranslations();

        // Route Admin
        if (file_exists(__DIR__ . '/../routes/web.php')) {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        }
    }
}
