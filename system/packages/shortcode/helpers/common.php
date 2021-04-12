<?php

if (!function_exists('shortcode')) {
    /**
     * @return \Ocart\Shortcode\Shortcode
     */
    function shortcode()
    {
        return app('shortcode');
    }
}

if (!function_exists('add_shortcode')) {
    /**
     * @param string $key
     * @param string $name
     * @param null|string $description
     * @param Callable|string $callback
     * @return \Ocart\Shortcode\Shortcode
     */
    function add_shortcode($key, $name, $description = null, $callback = null)
    {
        return shortcode()->register($key, $name, $description, $callback);
    }
}