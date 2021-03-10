<?php


namespace Ocart\Core\Facades;


use Illuminate\Support\Facades\Facade;
use Ocart\Core\Library\Filter;

class FilterFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return Filter::class;
    }
}
