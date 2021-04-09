<?php

namespace Ocart\Ecommerce\Facades;

use Illuminate\Support\Facades\Facade;
use Ocart\Ecommerce\Models\Currency;

/**
 * @method static void setApplicationCurrency(Currency $currency)
 * @method static Currency getApplicationCurrency()
 *
 * @see
 */
class CurrencySupport extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ocart\Ecommerce\Supports\CurrencySupport::class;
    }
}