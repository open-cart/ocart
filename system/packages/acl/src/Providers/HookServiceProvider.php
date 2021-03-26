<?php

namespace Ocart\Acl\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\Acl\Widgets\UserStatsWidget;

class HookServiceProvider extends ServiceProvider
{

    public function boot()
    {
        add_dashboard_widget(1)
            ->create(UserStatsWidget::class)
            ->setTitle('User Stats')
            ->setKey('widget_users_stats');

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
                'url' => route('system.roles.index'),
                'permissions' => [
                    'system.roles.index',
                    'system.roles.create',
                    'system.roles.update',
                    'system.roles.destroy',
                ],
                'active' => false,
            ])->registerItem([
                'id' => 'cms-system-user-users',
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