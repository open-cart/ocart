<?php

namespace Ocart\Ecommerce\Http\Controllers;

use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Theme\Facades\Theme;

class PublicController extends BaseController
{

    public function index()
    {
        return Theme::scope('product',  [],'package/ecommerce::product');
    }
}