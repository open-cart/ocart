<?php


namespace System\Core\Facades;


use Illuminate\Support\Facades\Facade;
use System\Core\Library\Action;

/**
 *
 * @see Action
 *
 * Class ActionFacade
 * @package System\Core\Facades
 */
class ActionFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return Action::class;
    }
}
