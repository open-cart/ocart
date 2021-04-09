<?php


namespace Ocart\Core\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static boolean saveMetaBoxData($object, $key, $value, $options = null)
 * @method static mixed deleteMetaData($model, $key)
 *
 * @see \Ocart\Core\Library\MetaBox
 */
class MetaBox extends Facade
{

    protected static function getFacadeAccessor()
    {
        return \Ocart\Core\Library\MetaBox::class;
    }
}
