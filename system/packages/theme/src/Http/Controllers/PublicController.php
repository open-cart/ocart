<?php


namespace Ocart\Theme\Http\Controllers;


class PublicController
{

    function getIndex()
    {
        return \Theme::scope('index');
    }

    public function getView($slug)
    {
        $result = apply_filters(BASE_FILTER_PUBLIC_SINGLE_DATA, $slug);

        if (empty($result['page'])) {
            abort(404);
        }

        return \Theme::scope('page', $result);
    }
}
