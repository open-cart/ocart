<?php


/**
 * Get all class plugin
 *
 * @return  [array]
 */
if (!function_exists('get_all_plugin')) {
    function get_all_plugin()
    {
        $arrClass = [];
        $dirs = array_filter(glob(app_path() . '/Plugins/*'), 'is_dir');
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

if (!function_exists('get_class_plugin_config')) {
    function get_class_plugin_config()
    {
        $arrClass = [];
        $dirs = array_filter(glob(app_path() . '/Plugins/*'), 'is_dir');
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

/**
 * Get namespace module
 *
 * @param   [string]  $code  Block, Cms, Payment, shipping..
 * @param   [string]  $key  Content,Paypal, Cash..
 *
 * @return  [array]
 */
if (!function_exists('get_plugin_namespace')) {
    function get_plugin_namespace($key)
    {
        $key = word_format_class($key);
        $nameSpace = '\App\Plugins\\' . $key;
        $nameSpace = $nameSpace . '\AppConfig';

        return $nameSpace;
    }
}

if (!function_exists('word_format_class')) {
    /*
    Format class name
     */
    function word_format_class($word)
    {
        $word = Str::camel($word);
        $word = ucfirst($word);
        return $word;
    }
}
