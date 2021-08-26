<?php
namespace Ocart\Menu\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use \Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{
    public function register()
    {
        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id' => 'cms-core-content-menu',
                'parent_id' => 'cms-plugins',
                'name' => trans('packages/menu::menus.menu'),
                'icon' => null,
                'url' => route('menus.index'),
                'permissions' => [
                    'menus.index',
                    'menus.create',
                    'menus.update',
                    'menus.destroy',
                ],
                'active' => false,
            ]);
        });
    }

    public function boot()
    {

    }
}