<?php


namespace Ocart\Core\Facades;


use Illuminate\Support\Facades\Facade;
use Ocart\Core\Library\Action;

/**
 *
 * @see Action
 *
 * Class ActionFacade
 * @package Ocart\Core\Facades
 */
class ActionFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return Action::class;
    }
}
