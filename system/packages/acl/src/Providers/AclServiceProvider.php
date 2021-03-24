<?php
namespace Ocart\Acl\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Acl\Repositories\UserRepository;
use Ocart\Acl\Repositories\UserRepositoryEloquent;
use Ocart\Core\Traits\LoadAndPublishDataTrait;

class AclServiceProvider extends ServiceProvider
{
    use  LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
    }

    public function boot()
    {
        $this->setNamespace('packages/acl')
            ->loadAndPublishConfigurations([])
            ->loadRoutes(['web'])
//            ->loadAndPublishViews()
//            ->loadAndPublishTranslations()
            ->loadMigrations();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id' => 'cms-system-content',
                'priority'    => 999,
                'parent_id' => null,
                'name' => 'packages/acl::systems.manager',
                'icon' => null,
                'url' => '',
                'permissions' => [],
                'active' => false,
            ])->registerItem([
                'id' => 'cms-system-role-roles',
                'parent_id' => 'cms-system-content',
                'name' => 'Roles & permissions',
                'icon' => null,
                'url' => route('system.users.index'),
                'permissions' => [
                    'system.users.index',
                    'system.users.create',
                    'system.users.update',
                    'system.users.destroy',
                ],
                'active' => false,
            ])->registerItem([
                'id' => 'cms-system-role-roles2',
                'parent_id' => 'cms-system-content',
                'name' => 'Users',
                'icon' => null,
                'url' => route('system.users.index'),
                'permissions' => [
                    'system.users.index',
                    'system.users.create',
                    'system.users.update',
                    'system.users.destroy',
                ],
                'active' => false,
            ]);
        });
    }
}