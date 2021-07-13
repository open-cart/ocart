<?php

namespace Ocart\Core\Facades;

use Illuminate\Support\Facades\Facade;
use Ocart\Core\Supports\SlugSupport;

/**
 * Class Slug
 * @package Ocart\Core\Facades
 *
 * @method static string getPrefix($model, $default = null)
 * @method static SlugSupport registerPrefix($name, $value)
 * @method static array getPrefixes()
 */
class Slug extends Facade
{

    protected static function getFacadeAccessor()
    {
        return SlugSupport::class;
    }
}
