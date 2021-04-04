<?php

namespace Ocart\Ecommerce\Facades;

use Illuminate\Support\Facades\Facade;

class CurrencySupport extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ocart\Ecommerce\Supports\CurrencySupport::class;
    }
}