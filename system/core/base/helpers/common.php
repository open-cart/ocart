<?php

use Ocart\Core\Library\Menu\Builder;

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
                return json_decode($file, true);
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
     * @return \Ocart\Core\Library\DashboardMenu
     */
    function dashboard_menu(): \Ocart\Core\Library\DashboardMenu
    {
        return \Ocart\Core\Facades\DashboardMenuFacade::getFacadeRoot();
    }
}

if (!function_exists('apply_filters')) {
    /**
     * @return mixed
     */
    function apply_filters(string $name, $result, ...$args)
    {
        $args = func_get_args();
        return app('action_hook.filter')->fire(array_shift($args), $args);
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
        app('action_hook.filter')->addListener($hook, $callback, $priority, $arguments);
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
        app('action_hook.action')->addListener($hook, $callback, $priority, $arguments);
    }
}

if (!function_exists('do_action')) {
    function do_action()
    {
        $args = func_get_args();
        return app('action_hook.action')->fire(array_shift($args), $args);
    }
}
if (!function_exists('page_title')) {
    /**
     * @return \Ocart\Core\Library\PageTitle;
     */
    function page_title()
    {
        return \Ocart\Core\Facades\PageTitleFacade::getFacadeRoot();
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
        return \Ocart\Core\Facades\MetaBox::getMetaData($object, $key, $single, $select);
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

use Illuminate\Support\Collection;

if (!function_exists('sort_item_with_children')) {
    /**
     * Sort parents before children
     * @param Collection|array $list
     * @param array $result
     * @param int $parent
     * @param int $depth
     * @return array
     */
    function sort_item_with_children($list, array &$result = [], $parent = null, $depth = 0): array
    {
        if ($list instanceof Collection) {
            $listArr = [];
            foreach ($list as $item) {
                $listArr[] = $item;
            }
            $list = $listArr;
        }

        foreach ($list as $key => $object) {
            if ((int)$object->parent_id == (int)$parent) {
                array_push($result, $object);
                $object->depth = $depth;
                unset($list[$key]);
                sort_item_with_children($list, $result, $object->id, $depth + 1);
            }
        }

        return $result;
    }
}
if (!function_exists('parent_recursive')) {
    /**
     * Sort parents before children
     * @param array $list
     * @param int $parentId
     * @return array
     */
    function parent_recursive(array $list, $parentId = 0) {
        $result = array();

        foreach ($list as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = parent_recursive($list, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $result[] = $element;
            }
        }

        return $result;
    }
}

if (!function_exists('get_meta_head')) {
    function get_meta_head(){
        return setting('meta_head', null);
    }
}

if (!function_exists('get_meta_footer')) {
    function get_meta_footer(){
        return setting('meta_footer', null);
    }
}

if (!function_exists('get_logo')) {
    function get_logo(){
        return setting('logo', '/images/logo-default.jpg');
    }
}
if (!function_exists('get_logo_footer')) {
    function get_logo_footer(){
        return setting('logo_footer', null);
    }
}

if (!function_exists('get_favicon')) {
    function get_favicon(){
        return setting('favicon', '/images/favicon-default.jpg');
    }
}

if (!function_exists('get_title')) {
    function get_title(){
        return setting('title', 'Giới thiệu công ty');
    }
}

if (!function_exists('get_deps')) {
    function get_deps(){
        return setting('deps', 'Mô tả công ty');
    }
}

if (!function_exists('get_domain')) {
    function get_domain(){
        return setting('domain', 'Sevenweb.vn');
    }
}

if (!function_exists('get_banner')) {
    function get_banner(){
        return json_decode(setting('banner', "[]"));
    }
}

if (!function_exists('get_partner')) {
    function get_partner(){
        return json_decode(setting('partner', "[]"));
    }
}

if (!function_exists('get_config_sections')) {
    function get_config_sections(){
        return json_decode(setting('config_sections', '[]'), true);
    }
}

if (!function_exists('get_menu_main')) {
    function get_menu_main(){
        return json_decode(setting('menu_main', null));
    }
}

if (!function_exists('get_menu_footer')) {
    function get_menu_footer(){
        return json_decode(setting('menu_footer', null));
    }
}

if (!function_exists('get_deps_footer')) {
    function get_deps_footer(){
        return setting('deps_footer', null);
    }
}

if (!function_exists('get_phone')) {
    function get_phone(){
        return setting('phone', null);
    }
}

if (!function_exists('get_address')) {
    function get_address(){
        return setting('address', null);
    }
}

if (!function_exists('get_address2')) {
    function get_address2(){
        return setting('address2', null);
    }
}

if (!function_exists('get_fb_chat')) {
    function get_fb_chat(){
        return setting('fb_chat', null);
    }
}

if (!function_exists('get_products_menu')) {
    function get_products_menu(){
        return json_decode(setting('products_menu', null));
    }
}

if (!function_exists('get_cms_version')) {
    /**
     * @return string
     */
    function get_cms_version(): string
    {
        try {
            return trim(get_file_data(platform_path('core/VERSION'), false));
        } catch (Exception $exception) {
            return '1.0';
        }
    }
}