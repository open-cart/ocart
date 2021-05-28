<?php


namespace Ocart\Theme\Http\Controllers;


use Illuminate\Support\Str;
use Ocart\SeoHelper\Facades\SeoHelper;

class PublicController
{

    function getIndex()
    {
        $title = get_title();
        $description = get_deps();
        SeoHelper::setTitle($title);
        SeoHelper::setDescription($description);
        $meta = SeoHelper::openGraph();
        $meta->setTitle($title);
        $meta->setDescription(strip_tags($description));
        $meta->setType('home');
        return \Theme::scope('index');
    }

    public function getView($slug)
    {
        $result = apply_filters(BASE_FILTER_PUBLIC_SINGLE_DATA, $slug);
        if (empty($result['page'])) {
            abort(404);
        }

        $title = $result['page']->name;
        $description = Str::limit(strip_tags($result['page']->description), 250);

        SeoHelper::setTitle($title);
        SeoHelper::setDescription($description);
        $meta = SeoHelper::openGraph();
        $meta->setTitle($title);
        $meta->setDescription($description);

        return \Theme::scope('page', $result, 'packages.page::themes.page');
    }
}
