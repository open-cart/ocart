<?php

namespace Ocart\Core;

use Botble\Assets\Assets;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Routing\ResourceRegistrar;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Core\Assets\CustomAsset;
use Ocart\Core\Providers\FormServiceProvider;
use Prettus\Repository\Criteria\RequestCriteria;
use Ocart\Core\Library\CustomResourceRegistrar;
use Ocart\Core\Providers\BreadcrumsServiceProvider;
use Ocart\Core\Repositories\MetaBoxRepository;
use Ocart\Core\Repositories\MetaBoxRepositoryEloquent;
use Ocart\Core\Traits\LoadAndPublishDataTrait;
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
        $this->app->bind(RequestCriteria::class, \Ocart\Core\Criteria\RequestCriteria::class);
        $this->app->bind(Assets::class, CustomAsset::class);


        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'core');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'core/base');

        $this->app->register(BreadcrumsServiceProvider::class);
        $this->app->register(FormServiceProvider::class);

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
