<?php

namespace Ocart\Blog\Http\Controllers;


use Ocart\Blog\Tables\PostTable;
use Ocart\Core\Http\Controllers\BaseController;

class PostController extends BaseController
{
    public function index(PostTable $blog)
    {
        return $blog->render();
    }
}
