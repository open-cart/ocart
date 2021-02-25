<?php


namespace System\Core\Facades;


use Illuminate\Support\Facades\Facade;

class MetaBox extends Facade
{

    protected static function getFacadeAccessor()
    {
        return \System\Core\Library\MetaBox::class;
    }
}
