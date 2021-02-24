<?php


namespace System\Core\Library;


use System\Core\Library\MapData\Builder;

class MapData
{
    /**
     * @var array
     */
    protected static $providers = [];

    /**
     * @param $provider
     * @return bool
     */
    public static function exists($provider) {
        return array_key_exists($provider, self::$providers);
    }

    /**
     * @param $name
     * @param $callback
     * @return Builder|mixed
     */
    public static function make($name, $callback) {
        if (!self::exists($name)) {
            self::$providers[$name] = new Builder();
        }

        if ($callback) {
            $callback(self::$providers[$name]);
        }

        return self::$providers[$name];
    }

    /**
     * @param $providers
     * @return Builder|null
     */
    public static function get($provider) {
        if (!self::exists($provider)) {
            return null;
        }

        return self::$providers[$provider];
    }
}
