<?php


namespace Ocart\Theme\Http\Controllers;


use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Str;
use Ocart\SeoHelper\Facades\SeoHelper;
use Ocart\Theme\Facades\Theme;

class PublicController
{

    function getIndex()
    {
        $title = get_title();
        $description = get_deps();
        $seo_og_image = \TnMedia::getImageUrl(get_seo_og_image(), asset('/images/no-image.jpg'));

        SeoHelper::setTitle($title);
        SeoHelper::setDescription($description);
        $meta = SeoHelper::openGraph();
        $meta->setTitle($title);
        $meta->setDescription(strip_tags($description));
        $meta->setType('home');
        $meta->addImage($seo_og_image);

        return \Theme::scope('index');
    }

    public function getView($slug)
    {
        $result = apply_filters(BASE_FILTER_PUBLIC_SINGLE_DATA, $slug);

        if (empty($result['page'])) {
            abort(404);
        }

        return \Theme::scope('page', $result, 'packages.page::themes.page');
    }
}
