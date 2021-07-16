<?php


namespace Ocart\Theme\Facades;


use Illuminate\Support\Facades\Facade;
use Ocart\Theme\ThemeConfig;

/**
 * @method static array constructSections()
 * @method static \Ocart\Theme\ThemeOption setSection(array $section)
 * @method static \Ocart\Theme\ThemeOption setSections(array $sections)
 * @method static boolean saveOptions()
 * @method static boolean|array getField(string $id)
 * @method static \Ocart\Theme\ThemeOption setOption($key, $value)
 * @method static mixed getOption($key, $default = null)
 *
 * @see ThemeConfig
 */
class ThemeOption extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ocart\Theme\ThemeOption::class;
    }
}
