<?php

namespace Ocart\PluginManagement\Providers;

use Composer\Autoload\ClassLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Ocart\Setting\Setting;
use Ocart\Core\Library\Helper;

class PluginManagementServiceProvider extends ServiceProvider
{

    public function register()
    {
        Helper::autoload(__DIR__.'/../../helpers');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'packages.plugin-management');

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
        $this->loadPlugins();

        Event::listen(RouteMatched::class, function() {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins',
                'parent_id'   => null,
                'priority'    => 200,
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
                'permissions' => [
                    'plugins.index'
                ],
                'active'      => false,
            ]);
        });
    }

    protected function loadPlugins()
    {
        if (!check_database_connection() && !Schema::hasTable(with(new Setting())->getTable())) {
            return;
        }

        $loader = new ClassLoader();

        $activatedPlugins = get_active_plugins();

        $providers = [];
        $namespaces = [];

        foreach ($activatedPlugins as $plugin) {
            $config = get_file_data(plugin_path($plugin . '/plugin.json'), true);

            $namespace = $config->namespace;

            if (!isset($config->require) || count($config->require) == 0) {
                $namespaces[plugin_path($plugin . '/src')] = $namespace;
                $providers = array_merge($providers, $config->providers);
            } else {
                if ($this->checkRequirePlugin($activatedPlugins, $config->require)) {
                    $namespaces[plugin_path($plugin . '/src')] = $namespace;
                    $providers = array_merge($providers, $config->providers);
                }
            }
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
    }

    protected function checkRequirePlugin($activatedPlugins, $require)
    {
        foreach ($require as $plugin) {
            if (!in_array($plugin, $activatedPlugins)) {
                return false;
            }
        }

        return true;
    }
}
