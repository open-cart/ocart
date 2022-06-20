<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{

    public function changeLanguage($language)
    {
        session()->put('language', $language);

        return redirect()->back();
    }

}
