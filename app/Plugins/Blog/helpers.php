<?php

function oc_trans($key = null, $replace = [], $locale = null) {
    if (is_null($key)) {
        return app('translator');
    }
    if (app('translator')->has('blog.'.$key)) {
        return app('translator')->get('blog.'.$key, $replace, $locale);
    }

    return app('translator')->get('Plugins/Blog::'.$key, $replace, $locale);
}

if (!function_exists('apply_filters')) {
    /**
     * @return mixed
     */
    function apply_filters()
    {
        $args = func_get_args();
        return \App\Plugins\Blog\Admin\FilterFacade::fire(array_shift($args), $args);
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
        \App\Plugins\Blog\Admin\FilterFacade::addListener($hook, $callback, $priority, $arguments);
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
        \App\Plugins\Blog\Admin\ActionFacade::addListener($hook, $callback, $priority, $arguments);
    }
}

if (!function_exists('do_action')) {
    function do_action()
    {
        $args = func_get_args();
        return \App\Plugins\Blog\Admin\ActionFacade::fire(array_shift($args), $args);
    }
}
