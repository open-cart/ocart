<?php

namespace Ocart\Media\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string renderHeader()
 * @method static string renderContent()
 * @method static string renderFooter()
 * @method static string url($path)
 *
 * @see \Ocart\Media\TnMedia
 */
class TnMedia extends Facade
{

    protected static function getFacadeAccessor()
    {
        return \Ocart\Media\TnMedia::class;
    }
}