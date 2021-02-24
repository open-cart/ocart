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
