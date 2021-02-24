<?php

namespace System\Core\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use System\Core\Library\DashboardMenu;

/**
 * @method static DashboardMenu registerItem(array $options)
 * @method static DashboardMenu removeItem($id, $parentId = null)
 * @method static Collection getAll()
 *
 * @see \System\Core\Library\DashboardMenu
 */
class DashboardMenuFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return DashboardMenu::class;
    }
}
