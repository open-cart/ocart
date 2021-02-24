<?php

namespace Ocart\PluginManagement\Providers;

use Composer\Autoload\ClassLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Ocart\PluginManagement\Models\AdminConfig;
use System\Core\Library\Helper;

class PluginManagementServiceProvider extends ServiceProvider
{

    public function register()
    {
        Helper::autoload(__DIR__.'/../../helpers');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'packages/plugin-management');

        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'packages/plugin-management');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $loader = new ClassLoader();

        $plugins = AdminConfig::getPluginCode();

        $providers = [];
        $namespaces = [];

        foreach ($plugins as $plugin) {
            $config = get_file_data(plugin_path($plugin->key) . '/plugin.json');

            $namespace = $config->namespace;

            $namespaces[plugin_path($plugin->key . '/src')] = $namespace;
            $providers = array_merge($providers, $config->providers);
        }

        foreach ($namespaces as $path => $namespace) {
            $loader->setPsr4($namespace, $path);
        }

        $loader->register();

        foreach ($providers as $provider) {
            if (!class_exists($provider)) {
                continue;
            }

            $this->app->register($provider);
        }

        Event::listen(RouteMatched::class, function() {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins',
                'parent_id'   => null,
                'name'        => 'packages/plugin-management::plugin.menu',
                'icon'        => null,
                'url'         => '',
                'permissions' => [],
                'active'      => false,
            ])->registerItem([
                'id'          => 'cms-plugins-plugin',
                'parent_id'   => 'cms-plugins',
                'name'        => 'packages/plugin-management::plugin.index',
                'icon'        => null,
                'url'         => route('admin::plugin'),
                'permissions' => [],
                'active'      => false,
            ]);
        });
    }
}
