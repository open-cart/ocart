<?php
namespace Ocart\Payment\Facades;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Ocart\Payment\PaymentManager;
use Ocart\Payment\Services\ProduceServiceInterface;
use Closure;

/**
 * Class Payment
 * @package Ocart\Payment\Facades
 *
 * @method static ProduceServiceInterface driver(string $name)
 * @method static mixed execute(Request $request)
 * @method static PaymentManager extend($driver, Closure $callback)
 *
 * @see PaymentManager
 * @see ProduceServiceInterface
 */
class Payment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PaymentManager::class;
    }
}