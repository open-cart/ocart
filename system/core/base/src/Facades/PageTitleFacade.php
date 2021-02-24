<?php


namespace System\Core\Facades;


use Illuminate\Support\Facades\Facade;
use System\Core\Library\PageTitle;

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
