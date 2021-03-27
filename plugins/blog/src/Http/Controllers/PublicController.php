<?php


namespace Ocart\Blog\Http\Controllers;


use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Theme\Facades\Theme;

class PublicController extends BaseController
{
    public function index()
    {
        return Theme::scope('index', [], 'plugins/blog::index');
    }

    public function about()
    {
        return Theme::scope('about', [], 'plugins/blog::about');
    }

    public function Atriment()
    {
        return Theme::scope('atriment', [], 'plugins/blog::atriment');
    }

    public function Information()
    {
        return Theme::scope('information', [], 'plugins/blog::information');
    }
}
