<?php

if (!function_exists('plugin_path')) {
    /**
     * @return string
     *
     */
    function plugin_path($path = null)
    {
        return base_path('plugins' . DIRECTORY_SEPARATOR . $path);
    }
}

/**
 * Get all class plugin
 *
 * @return  [array]
 */
if (!function_exists('get_all_plugin2')) {
    function get_all_plugin2()
    {
        $arrClass = [];
        $dirs = array_filter(glob(plugin_path('*')), 'is_dir');
        if ($dirs) {
            foreach ($dirs as $dir) {
                $tmp = explode('/', $dir);
                $nameSpace = '\App\Plugins\\' . end($tmp);
                $nameSpaceConfig = $nameSpace . '\\AppConfig';
                if (file_exists($dir . '/AppConfig.php') && class_exists($nameSpaceConfig)) {
                    $arrClass[end($tmp)] = [
                        'nameSpace' => $nameSpace,
                        'AppConfig' => new $nameSpaceConfig
                    ];
                }
            }
        }
        return $arrClass;
    }
}

if (!function_exists('get_active_plugins')) {
    /**
     * @return array
     */
    function get_active_plugins()
    {
        return json_decode(setting('activated_plugins', '[]'), true);
    }
}

if (!function_exists('is_active_plugin')) {
    /**
     * @param string $plugin
     * @return bool
     */
    function is_active_plugin($plugin = '')
    {
        return in_array($plugin, get_active_plugins());
    }
}
