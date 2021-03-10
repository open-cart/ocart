<?php


namespace Ocart\Core\Facades;


use Illuminate\Support\Facades\Facade;
use Ocart\Core\Library\PageTitle;

class PageTitleFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return PageTitle::class;
    }
}
