<?php
namespace Ocart\PluginManagement\Http\Controllers;

use Composer\Autoload\ClassLoader;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class PluginManagementController extends Controller
{
    public function index()
    {
        page_title()->setTitle(trans('packages/plugin-management::plugin.index'));

        $list = [];

        $plugins = array_filter(glob(plugin_path('*')), 'is_dir');

        if (!empty($plugins)) {
            foreach ($plugins as $pluginPath) {

                if (!File::isDirectory($pluginPath) || !File::exists($pluginPath . '/plugin.json')) {
                    continue;
                }

                $content = get_file_data($pluginPath . '/plugin.json');

                if (!empty($content)) {
                    $content->status = 0;
                    $content->config = 0;
                    $content->namespaceConfig = $content->namespace . 'AppConfig';
                    $content->path = $pluginPath;

                    if (class_exists($content->namespaceConfig)) {
                        $content->status = 1;
                        $content->config = (new $content->namespaceConfig)->config();
                    }
                    $list[] = $content;
;                }
            }
        }

        return view('packages/plugin-management::index')
            ->with('plugins', $list);
    }

    /**
     * Update plugin
     *
     * @return  [type]  [return description]
     */
    public function update()
    {
        $key = request('key');
        $content = get_file_data($key . '/plugin.json');

        $content->namespaceConfig = $content->namespace . 'AppConfig';

        $response = [];

        if (!class_exists($content->namespaceConfig)) {
            $loader = new ClassLoader();
            $namespace = $content->namespace;

            $loader->setPsr4($namespace, plugin_path($content->configKey . '/src'));
            $loader->register(true);

            $response = (new $content->namespaceConfig)->enable();
        } else {
            $response = (new $content->namespaceConfig)->disable();
        }

        return response()->json($response);
    }
}
