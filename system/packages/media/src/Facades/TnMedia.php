<?php

namespace Ocart\Media\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string renderHeader()
 * @method static string renderContent()
 * @method static string renderFooter()
 *
 * Class \Ocart\Media\TnMedia
 * @package Ocart\Media\Facades
 */
class TnMedia extends Facade
{

    protected static function getFacadeAccessor()
    {
        return \Ocart\Media\TnMedia::class;
    }
}