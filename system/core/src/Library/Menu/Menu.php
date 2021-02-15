<?php


namespace System\Core\Library\Menu;


class Menu
{
    /**
     * @var array
     */
    protected static $menu = [];

    /**
     * @param $menu
     * @return bool
     */
    public static function exists($menu) {
        return array_key_exists($menu, self::$menu);
    }

    /**
     * @param $menu
     * @param $callback
     * @return Builder|mixed
     */
    public static function make($menu, $callback) {
        if (!self::exists($menu)) {
            self::$menu[$menu] = new Builder();
        }

        if ($callback) {
            $callback(self::$menu[$menu]);
        }

        return self::$menu[$menu];
    }

    /**
     * @param $menu
     * @return mixed|null
     */
    public static function get($menu) {
        if (!self::exists($menu)) {
            return null;
        }

        return self::$menu[$menu];
    }
}
