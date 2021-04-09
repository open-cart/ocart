<?php

if (!function_exists('seo_helper_support')) {
    function seo_helper_support($model) {
        return in_array(get_class($model), config('packages.seo-helper.general.supported', []));
    }
}