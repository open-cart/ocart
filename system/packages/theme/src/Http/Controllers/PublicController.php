<?php


namespace Ocart\Theme\Http\Controllers;


use Ocart\Page\Repositories\PageRepository;

class PublicController
{

    function getIndex()
    {
        return \Theme::scope('index');
    }

    public function getView($slug)
    {
        $result = apply_filters('BASE_FILTER_PUBLIC_SINGLE_DATA', $slug);

        if (!$result['page']) {
            abort(404);
        }

        return \Theme::scope('page', $result);
    }
}
