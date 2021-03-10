<?php

namespace Ocart\Media\Http\Controllers;

use Ocart\Core\Http\Controllers\BaseController;

class MediaController extends BaseController
{

    public function index(){
        return view('packages/media::index');
    }
}
