<?php
namespace Ocart\Menu\Facades;

use Illuminate\Support\Facades\Facade;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class Menu
 * @package Ocart\Menu\Facades
 *
 * @method static string registerMenuOptions(RepositoryInterface $repository, string $name)
 * @method static string generateSelect($args = [])
 */
class Menu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ocart\Menu\Supports\Menu::class;
    }
}