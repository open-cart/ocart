<?php
namespace Ocart\Setting\Facades;

use Illuminate\Support\Facades\Facade;
use Ocart\Setting\SettingManager;
use Ocart\Setting\SettingStore;

/**
 * @method static array read()
 * @method static void write(array $data)
 * @method static mixed get($key, $default = null)
 * @method static boolean has($key)
 * @method static SettingStore set($key, $value = null)
 * @method static SettingStore forget($key)
 * @method static SettingStore forgetAll()
 * @method static array all()
 * @method static void save()
 *
 * @see SettingManager
 */
class Setting extends Facade
{

    protected static function getFacadeAccessor()
    {
        return SettingManager::class;
    }
}
