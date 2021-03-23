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
        if (empty($url)) {
            return $default;
        }

        if ($url == config('packages.media.media.default-img')) {
            return url($url);
        }

        if ($size && array_key_exists($size, TnMedia::getSizes())) {
            $url = str_replace(
                File::name($url) . '.' . File::extension($url),
                File::name($url) . '-' . TnMedia::getSize($size) . '.' . File::extension($url),
                $url
            );
        }

        if ($relativePath) {
            return $url;
        }

        if ($url == '__image__') {
            return TnMedia::url($default);
        }

        return TnMedia::url($url);
    }
}