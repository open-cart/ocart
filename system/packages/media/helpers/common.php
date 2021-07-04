<?php

if (!function_exists('is_image')) {
    /**
     * Is the mime type an image
     *
     * @param $mimeType
     * @return bool
     */
    function is_image($mimeType)
    {
        return Str::startsWith($mimeType, 'image/');
    }
}

if (!function_exists('get_image_url')) {
    /**
     * @param $url
     * @param $size
     * @param bool $relativePath
     * @param null $default
     * @return string
     */
    function get_image_url($url, $size = null, $relativePath = false, $default = null)
    {
        return TnMedia::getImageUrl($url, $size, $default);
    }
}