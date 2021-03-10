<?php


namespace Ocart\Core\Facades;


use Illuminate\Support\Facades\Facade;

class MetaBox extends Facade
{

    protected static function getFacadeAccessor()
    {
        return \Ocart\Core\Library\MetaBox::class;
    }
}
