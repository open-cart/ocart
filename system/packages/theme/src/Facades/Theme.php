<?php


namespace Ocart\Theme\Facades;


use Illuminate\Support\Facades\Facade;
use Ocart\Theme\ThemeConfig;

/**
 * @method static scope($view)
 *
 * @see ThemeConfig
 */
class Theme extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ThemeConfig::class;
    }
}
