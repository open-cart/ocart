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

//        $repo->orderBy($repo->getModel()->qualifyColumn('is_default'), 'DESC');
//        $repo->orderBy($repo->getModel()->qualifyColumn('order'), 'ASC');
        $repo->orderBy($repo->getModel()->qualifyColumn('name'), 'ASC');

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
    function get_list_posts($limit = 10, $columns = ['*']) {
        /** @var \Ocart\Blog\Repositories\Interfaces\PostRepository $repo */
        $repo = app(\Ocart\Blog\Repositories\Interfaces\PostRepository::class);

        return $repo->paginate($limit, $columns);
    }
}

if (!function_exists('get_list_posts_feature')) {
    function get_list_posts_feature($limit = 9)
    {
        /** @var \Ocart\Blog\Repositories\Interfaces\PostRepository $repo */
        /** @var \Ocart\Blog\Repositories\PostRepositoryEloquent $repo */
        $repo = app(\Ocart\Blog\Repositories\Interfaces\PostRepository::class);
        return $repo->getFeature($limit);
    }
}

if (!function_exists('get_list_posts_relate')) {
    function get_list_posts_relate($categoryId = 1, $limit = 9) {
        /** @var \Ocart\Blog\Repositories\Interfaces\PostRepository $repo */
        /** @var \Ocart\Blog\Repositories\PostRepositoryEloquent $repo */
        $repo = app(\Ocart\Blog\Repositories\Interfaces\PostRepository::class);

        return $repo->getRelate($categoryId, $limit);
    }
}
