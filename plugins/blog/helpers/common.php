<?php
use Ocart\Blog\Supports\PostFormat;
use Ocart\Blog\Repositories\Interfaces\CategoryRepository;

if (!function_exists('register_post_format')) {
    /**
     * @param array $formats
     * @return void
     *
     */
    function register_post_format(array $formats)
    {
        PostFormat::registerPostFormat($formats);
    }
}

if (!function_exists('get_post_formats')) {
    /**
     * @param bool $convert_to_list
     * @return array
     *
     */
    function get_post_formats($convert_to_list = false)
    {
        return PostFormat::getPostFormats($convert_to_list);
    }
}

if (!function_exists('get_blog_categories')) {
    /**
     * @param array $args
     * @return array|mixed
     */
    function get_blog_categories(array $args = [])
    {
        $indent = Arr::get($args, 'indent', '——');

        $repo = app(CategoryRepository::class);

        $repo->orderBy($repo->getModel()->qualifyColumn('is_default'), 'DESC');
        $repo->orderBy($repo->getModel()->qualifyColumn('order'), 'ASC');
        $categories = $repo->all();

        $categories = sort_item_with_children($categories);

        foreach ($categories as $category) {
            $indentText = '';
            $depth = (int)$category->depth;
            for ($i = 0; $i < $depth; $i++) {
                $indentText .= $indent;
            }
            $category->indent_text = $indentText;
        }

        return $categories;
    }
}


if (!function_exists('get_list_posts')) {
    function get_list_posts() {
        /** @var \Ocart\Blog\Repositories\Interfaces\PostRepository $repo */
        $repo = app(\Ocart\Blog\Repositories\Interfaces\PostRepository::class);

        return $repo->all();
    }
}

if (!function_exists('get_list_posts_feature')) {
    function get_list_posts_feature($limit = 1)
    {
        /** @var \Ocart\Blog\Repositories\Interfaces\PostRepository $repo */
        $repo = app(\Ocart\Blog\Repositories\Interfaces\PostRepository::class);
        return $repo->getFeature($limit);
    }
}