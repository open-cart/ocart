<?php

namespace System\Core\Providers;

use System\Core\Admin\Models\AdminConfig;
use Illuminate\Support\ServiceProvider;

class PluginServiceProvider extends ServiceProvider
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
//        $plugins = AdminConfig::getPluginCode();
//        foreach ($plugins as $plugin) {
//            $config = file_get_contents(app_path('Plugins/' . $plugin->key).'/config.json');
//            $config = json_decode($config, true);
//            foreach ($config['providers'] as $provider) {
//                $this->app->register($provider);
//            }
//        }
    }
}
