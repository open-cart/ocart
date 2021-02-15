<?php


namespace System\Core\Admin\Controllers;


use System\Core\Admin\Models\AdminConfig;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class PluginController extends Controller
{

    public function index()
    {
        $plugins = get_all_plugin();
        $pluginsInstalled = AdminConfig::getPluginCode(false);

        return view('admin/plugin')
            ->with('pluginsInstalled', $pluginsInstalled)
            ->with('plugins', $plugins);
    }

    public function install()
    {
        $key = request('key');
        $namespace = get_plugin_namespace($key);
        $response = (new $namespace)->install();
        return response()->json($response);
    }

    /**
     * Uninstall plugin
     *
     * @return  [type]  [return description]
     */
    public function uninstall()
    {
        $key = request('key');
        $onlyRemoveData = request('onlyRemoveData');
        $namespace = get_plugin_namespace($key);
        $response = (new $namespace)->uninstall();
        if (!$onlyRemoveData) {
            File::deleteDirectory(app_path('Plugins/'.$key));
            File::deleteDirectory(public_path('Plugins/'.$key));
        }
        return response()->json($response);
    }

    /**
     * Enable plugin
     *
     * @return  [type]  [return description]
     */
    public function enable()
    {
        $key = request('key');
        $namespace = get_plugin_namespace($key);
        $response = (new $namespace)->enable();
        return response()->json($response);
    }

    /**
     * disable plugin
     */
    public function disable()
    {
        $key = request('key');
        $namespace = get_plugin_namespace($key);
        $response = (new $namespace)->disable();
        return response()->json($response);
    }
}
