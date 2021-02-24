<?php


namespace System\Core\Facades;


use Illuminate\Support\Facades\Facade;
use System\Core\Library\Filter;

class FilterFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return Filter::class;
    }
}
