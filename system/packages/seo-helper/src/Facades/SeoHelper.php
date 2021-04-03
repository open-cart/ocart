<?php

namespace Ocart\SeoHelper\Facades;

use Artesaos\SEOTools\Contracts\OpenGraph;
use Illuminate\Support\Facades\Facade;
use Ocart\SeoHelper\Manager;

/**
 * @method static OpenGraph openGraph()
 * @method static void setSeoOpenGraph($seoOpenGraph)
 * @method static void setTitle($title)
 * @method static void setDescription($description)
 * @method static boolean saveMetaData($model, \Illuminate\Http\Request $request, $repository)
 * @method static boolean deleteMetaData($model, $key)
 * @method static Manager registerModule($model)
 *
 * @see Manager
 */
class SeoHelper extends Facade
{

    public static function getFacadeAccessor()
    {
        return Manager::class;
    }
}
