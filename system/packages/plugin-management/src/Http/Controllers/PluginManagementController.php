<?php
namespace Ocart\PluginManagement\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Ocart\Core\Events\UpdatedContentEvent;
use Ocart\PluginManagement\Plugin;
use Ocart\Core\Http\Responses\BaseHttpResponse;

class PluginManagementController extends Controller
{
    public function index()
    {
        page_title()->setTitle(trans('packages/plugin-management::plugin.index'));

        $list = [];

        $plugins = array_filter(glob(plugin_path('*')), 'is_dir');

        $activatedPlugins = get_active_plugins();

        if (!empty($plugins)) {
            foreach ($plugins as $pluginPath) {
                $plugin = Arr::last(explode(DIRECTORY_SEPARATOR, $pluginPath));

                if (!File::isDirectory($pluginPath) || !File::exists($pluginPath . '/plugin.json')) {
                    continue;
                }

                $content = get_file_data($pluginPath . '/plugin.json');

                if (!empty($content)) {
                    $content->status = 0;
                    $content->config = 0;
                    $content->namespaceConfig = $content->namespace . 'AppConfig';
                    $content->path = $pluginPath;

                    if (in_array($plugin, $activatedPlugins)) {
                        $content->status = 1;
                    }

                    if (class_exists($content->namespaceConfig)) {
//                        $content->status = 1;
                        $content->config = (new $content->namespaceConfig)->config();
                    }
                    $list[$plugin] = $content;
;                }
            }
        }

        return view('packages.plugin-management::index')
            ->with('plugins', $list);
    }

    /**
     * Update plugin
     *
     * @param BaseHttpResponse $response
     * @param Plugin $pluginManager
     * @return BaseHttpResponse [type]  [return description]
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function update(BaseHttpResponse $response, Plugin $pluginManager)
    {
        $plugin = strtolower(request('key'));

        $content = get_file_data(plugin_path($plugin . '/plugin.json'));

        if (!$content) {
            return $response
                ->setMessage(trans('packages.plugin-management::plugin.invalid_plugin'))
                ->setError();
        }

        $activatedPlugins = get_active_plugins();

        try {
            if (!in_array($plugin, $activatedPlugins)) {
                $pluginManager->activate($plugin);
            } else {
                $pluginManager->deactivate($plugin);
            }

            event(new UpdatedContentEvent(SYSTEM_MODULE_PLUGIN_MANAGEMENT_SCREEN_NAME, request(), $plugin));

            return $response->setMessage(trans('packages/plugin-management::plugin.update_plugin_status_success'));
        } catch (\Exception $ex) {
            return $response
                ->setError()
                ->setMessage($ex->getMessage());
        }
    }
}
