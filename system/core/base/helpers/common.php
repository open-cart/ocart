<?php

use System\Core\Library\Menu\Builder;

if (!function_exists('platform_path')) {
    /**
     * @return string
     */
    function platform_path($path = null): string
    {
        return base_path('system/' . $path);
    }
}

if (!function_exists('get_file_data')) {
    /**
     * @param string $file
     * @param bool $toArray
     * @return bool|mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    function get_file_data($file, $toArray = true)
    {
        $file = \Illuminate\Support\Facades\File::get($file);
        if (!empty($file)) {
            if ($toArray) {
                return json_decode($file, false);
            }
            return $file;
        }
        if (!$toArray) {
            return null;
        }
        return [];
    }
}

if (!function_exists('dashboard_menu')) {
    /**
     * @return \System\Core\Library\DashboardMenu
     */
    function dashboard_menu(): \System\Core\Library\DashboardMenu
    {
        return \System\Core\Facades\DashboardMenuFacade::getFacadeRoot();
    }
}

if (!function_exists('apply_filters')) {
    /**
     * @return mixed
     */
    function apply_filters()
    {
        $args = func_get_args();
        return \System\Core\Facades\FilterFacade::fire(array_shift($args), $args);
    }
}

if (!function_exists('add_filter')) {
    /**
     * @param $hook
     * @param $callback
     * @param int $priority
     * @param int $arguments
     */
    function add_filter($hook, $callback, $priority = 20, $arguments = 1)
    {
        \System\Core\Facades\FilterFacade::addListener($hook, $callback, $priority, $arguments);
    }
}

if (!function_exists('add_action')) {
    /**
     * @param $hook
     * @param $callback
     * @param int $priority
     * @param int $arguments
     */
    function add_action($hook, $callback, $priority = 20, $arguments = 1)
    {
        \System\Core\Facades\ActionFacade::addListener($hook, $callback, $priority, $arguments);
    }
}

if (!function_exists('do_action')) {
    function do_action()
    {
        $args = func_get_args();
        return \System\Core\Facades\ActionFacade::fire(array_shift($args), $args);
    }
}
if (!function_exists('page_title')) {
    /**
     * @return \System\Core\Library\PageTitle;
     */
    function page_title()
    {
        return \System\Core\Facades\PageTitleFacade::getFacadeRoot();
    }
}

if (!function_exists('get_meta_data')) {
    /**
     * @param Model $object
     * @param $key
     * @param boolean $single
     * @param array $select
     * @return mixed
     */
    function get_meta_data($object, $key, $single = false, $select = ['meta_value'])
    {
        return \System\Core\Facades\MetaBox::getMetaData($object, $key, $single, $select);
    }
}
