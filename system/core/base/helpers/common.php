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

if (!function_exists('check_database_connection')) {
    /**
     * @return boolean
     */
    function check_database_connection(): bool
    {
        try {
            DB::connection(config('database.default'))->reconnect();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}

if (!function_exists('html_attributes_builder')) {
    /**
     * @param array $attributes
     * @return string
     */
    function html_attributes_builder(array $attributes): string
    {
        $html = [];

        foreach ((array)$attributes as $key => $value) {
            $element = html_attribute_element($key, $value);

            if (!empty($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }
}

if (!function_exists('html_attribute_element')) {
    /**
     * @param $key
     * @param $value
     * @return string
     */
    function html_attribute_element($key, $value)
    {
        if (is_numeric($key)) {
            return $value;
        }

        // Treat boolean attributes as HTML properties
        if (is_bool($value) && $key != 'value') {
            return $value ? $key : '';
        }

        if (!empty($value)) {
            return $key . '="' . e($value) . '"';
        }

        return '';
    }
}

if (!function_exists('get_function_callback')) {
    function get_function_callback($callback)
    {
        if (is_string($callback)) {
            if (strpos($callback, '@')) {
                $callback = explode('@', $callback);
                return [app('\\' . $callback[0]), $callback[1]];
            }

            return $callback;
        } elseif ($callback instanceof Closure) {
            return $callback;
        } elseif (is_array($callback)) {
            return $callback;
        }

        return false;
    }
}

if (!function_exists('filter_form')) {
    function filter_form($screenName, $positionName, $callback)
    {
        return function ($screen, $position, $model) use ($screenName, $positionName, $callback) {
            if ($screen === $screenName && $positionName === $position) {
                return call_user_func_array(get_function_callback($callback), [$screen, $position, $model]);
            }
        };
    }
}
