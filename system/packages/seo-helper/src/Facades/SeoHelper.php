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
 *
 * Class SeoHelper
 * @package Ocart\SeoHelper\Facades
 */
class SeoHelper extends Facade
{

    public static function getFacadeAccessor()
    {
        return Manager::class;
    }
}
