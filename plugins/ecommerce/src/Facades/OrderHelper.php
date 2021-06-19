<?php

namespace Ocart\Ecommerce\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string processHistoryVariables($history)
 *
 * @see \Ocart\Ecommerce\Supports\EcommerceHelper
 */
class OrderHelper extends Facade
{

    protected static function getFacadeAccessor()
    {
        return \Ocart\Ecommerce\Supports\OrderHelper::class;
    }
}