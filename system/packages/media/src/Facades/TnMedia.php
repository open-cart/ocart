<?php

namespace Ocart\Media\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string renderHeader()
 * @method static string renderContent()
 * @method static string renderFooter()
 * @method static string url($path)
 * @method static string getImageUrl($url, $size = null, $default = null)
 * @method static string getImagePath($url, $size = null, $default = null)
 * @method static \Ocart\Media\TnMedia addSize(string $name, int $width, int $height)
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