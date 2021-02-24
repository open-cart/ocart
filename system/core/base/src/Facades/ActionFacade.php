<?php


namespace System\Core\Facades;


use Illuminate\Support\Facades\Facade;
use System\Core\Library\Action;

class ActionFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return Action::class;
    }
}
