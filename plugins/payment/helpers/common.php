<?php

if (!function_exists('get_payment_setting')) {
    /**
     * @param string $key
     * @param null $type
     * @param null $default
     * @return string|null
     */
    function get_payment_setting($key, $type = null, $default = null)
    {
        if (!empty($type)) {
            $key = 'payment_' . $type . '_' . $key;
        } else {
            $key = 'payment_' . $key;
        }

        return setting($key, $default);
    }
}
