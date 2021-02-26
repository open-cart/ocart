<?php

use Ocart\Setting\Facades\Setting;

if (!function_exists('setting')) {
    /**
     * Get the setting instance.
     *
     * @param $key
     * @param $default
     *
     * @return array|\Ocart\Setting\SettingStore|string|null
     */
    function setting($key = null, $default = null)
    {
        if (!empty($key)) {
            try {
                return Setting::get($key, $default);
            } catch (Exception $exception) {
                return $default;
            }
        }

        return Setting::getFacadeRoot();
    }
}
