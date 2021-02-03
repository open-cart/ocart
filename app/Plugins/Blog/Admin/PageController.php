<?php


namespace App\Plugins\Blog\Admin;


use Illuminate\Routing\Controller;

class PageController extends Controller
{

    function index()
    {
        return view('blog::blog');
    }
}
