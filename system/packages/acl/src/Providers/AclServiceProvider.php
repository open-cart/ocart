<?php
namespace Ocart\Acl\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Acl\Repositories\RoleRepository;
use Ocart\Acl\Repositories\RoleRepositoryEloquent;
use Ocart\Acl\Repositories\UserRepository;
use Ocart\Acl\Repositories\UserRepositoryEloquent;
use Ocart\Core\Traits\LoadAndPublishDataTrait;

class AclServiceProvider extends ServiceProvider
{
    use  LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(RoleRepository::class, RoleRepositoryEloquent::class);
        $this->app->register(HookServiceProvider::class);
    }

    public function boot()
    {
        $this->setNamespace('packages/acl')
            ->loadAndPublishConfigurations([])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations();
    }
}