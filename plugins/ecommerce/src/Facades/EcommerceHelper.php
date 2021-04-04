<?php

namespace Ocart\Ecommerce\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static boolean isCartEnabled()
 * @method static boolean isTaxEnabled()
 *
 * @see \Ocart\Ecommerce\Supports\EcommerceHelper
 */
class EcommerceHelper extends Facade
{

    protected static function getFacadeAccessor()
    {
        return \Ocart\Ecommerce\Supports\EcommerceHelper::class;
    }
}