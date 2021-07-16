<?php


if (!function_exists('theme_path')) {
    /**
     * @return string
     *
     */
    function theme_path($path = null)
    {
        return base_path('themes' . DIRECTORY_SEPARATOR . $path);
    }
}


if (!function_exists('theme_options')) {
    /**
     * @param array $options
     * @return \Ocart\Theme\Facades\ThemeOption
     */
    function theme_options($options = array())
    {
        return \Ocart\Theme\Facades\ThemeOption::getFacadeRoot();
    }
}