<?php
namespace Ocart\PluginManagement;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Ocart\Setting\Facades\Setting;

class Plugin
{
    /**
     * @param $plugin
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Exception
     */
    public function activate($plugin)
    {
        $content = get_file_data(plugin_path($plugin . '/plugin.json'));

        $content->namespaceConfig = $content->namespace . 'AppConfig';

        $activatedPlugins = get_active_plugins();

        if (!class_exists($content->namespaceConfig)) {
            $loader = new ClassLoader();
            $namespace = $content->namespace;

            $loader->setPsr4($namespace, plugin_path($content->configKey . '/src'));
            $loader->register(true);
        }

        if (in_array($plugin, $activatedPlugins)) {
            throw new \Exception('This plugin is activated already!');
        }

        /**
         * Yêu cầu bật các plugins đã được khai báo trước khi bật plugin này
         */
        if (!empty($content->require)) {
            $valid = count(array_intersect($content->require,
                    $activatedPlugins)) == count($content->require);
            if (!$valid) {
                throw new \Exception(trans('packages/plugin-management::plugin.missing_required_plugins', [
                    'plugins' => implode(',', $content->require),
                ]));
            }
        }

        if (class_exists($content->namespaceConfig)) {
            call_user_func([$content->namespaceConfig, 'activate']);
        }

        if (File::isDirectory(plugin_path($plugin . '/public'))) {
            File::copyDirectory(plugin_path($plugin . '/public'),
                public_path('vendor/core/plugins/' . $plugin));
        }

        if (File::isDirectory(plugin_path($plugin . '/database/migrations'))) {
            Artisan::call('migrate', [
                '--force' => true,
                '--path'  => str_replace(base_path(), '', plugin_path($plugin . '/database/migrations')),
            ]);
        }

        Setting::set('activated_plugins', json_encode(array_values(array_merge($activatedPlugins, [$plugin]))))
            ->save();

        Artisan::call('cache:clear');
    }

    /**
     * @param $plugin
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function deactivate($plugin)
    {
        $content = get_file_data(plugin_path($plugin . '/plugin.json'));
        $content->namespaceConfig = $content->namespace . 'AppConfig';

        $activatedPlugins = get_active_plugins();

        if (!in_array($plugin, $activatedPlugins)) {
            throw new \Exception('This plugin is deactivated already!');
        }

        if (class_exists($content->namespaceConfig)) {
            call_user_func([$content->namespaceConfig, 'deactivate']);
        }

        if (($key = array_search($plugin, $activatedPlugins)) !== false) {
            unset($activatedPlugins[$key]);
        }

        Setting::set('activated_plugins', json_encode(array_values($activatedPlugins)))
            ->save();

        Artisan::call('cache:clear');
    }
}
