<?php

namespace Ocart\Core\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id' => 'cms-system-content',
                'priority' => 999,
                'parent_id' => null,
                'name' => trans('packages/acl::menu.manager'),
                'icon' => null,
                'url' => '',
                'permissions' => [],
                'active' => false,
            ])
                ->registerItem([
                    'id' => 'cms-system-caches',
                    'parent_id' => 'cms-system-content',
                    'name' => trans('core/base::cache.cache_management'),
                    'icon' => null,
                    'url' => route('system.cache'),
                    'permissions' => [
                        'superuser',
                    ],
                    'active' => false,
                ])->registerItem([
                    'id' => 'cms-system-info',
                    'parent_id' => 'cms-system-content',
                    'name' => trans('core/base::system.system_information'),
                    'icon' => null,
                    'url' => route('system.information'),
                    'permissions' => [
                        'superuser',
                    ],
                    'active' => false,
                ]);
        });
    }
}
