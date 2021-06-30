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

if (!function_exists('get_setting_email_status_key')) {
    /**
     * @param $templateKey
     * @return string
     */
    function get_setting_email_status_key($templateKey)
    {
        return str_replace('.', '_', $templateKey . '_' . 'status');
    }
}

if (!function_exists('get_setting_email_status')) {
    /**
     * @param $templateKey
     * @param $module
     * @return array|\Ocart\Setting\SettingStore|string|null
     */
    function get_setting_email_status($templateKey, $module)
    {
        $default = \Ocart\Core\Facades\EmailHandler::module($module)->getConfig($templateKey, 'enabled', true);
        return setting(get_setting_email_status_key($templateKey), $default);
    }
}