<?php
use Ocart\Blog\Supports\PostFormat;
use Ocart\Blog\Repositories\Interfaces\CategoryRepository;
use Ocart\Core\Supports\SortItemsWithChildrenSupport;

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
        $repo = app(CategoryRepository::class);

        $repo->orderBy($repo->getModel()->qualifyColumn('name'), 'ASC');

        $categories = $repo->all();

        /** @var SortItemsWithChildrenSupport $sortSupport */
        $sortSupport = app(SortItemsWithChildrenSupport::class);

        return $sortSupport->setItems($categories)->setChildrenProperty('child_cats')->sort();
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

if (!function_exists('get_list_posts_feature_paginate')) {
    function get_list_posts_feature_paginate($limit = 8, $columns = ['*'])
    {
        /** @var \Ocart\Blog\Repositories\Interfaces\PostRepository $repo */
        /** @var \Ocart\Blog\Repositories\PostRepositoryEloquent $repo */
        $repo = app(\Ocart\Blog\Repositories\Interfaces\PostRepository::class);

        return $repo->getFeaturePaginate($limit, $columns);
    }
}

if (!function_exists('get_list_posts_feature_format_type')) {
    function get_list_posts_feature_format_type($type, $limit = 9)
    {
        /** @var \Ocart\Blog\Repositories\Interfaces\PostRepository $repo */
        /** @var \Ocart\Blog\Repositories\PostRepositoryEloquent $repo */
        $repo = app(\Ocart\Blog\Repositories\Interfaces\PostRepository::class);
        return $repo->getFeatureFormatType($type, $limit);
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

if (!function_exists('get_list_posts_category')) {
    function get_list_posts_category($categoryId = 1, $limit = 9) {
        /** @var \Ocart\Blog\Repositories\Interfaces\PostRepository $repo */
        /** @var \Ocart\Blog\Repositories\PostRepositoryEloquent $repo */
        $repo = app(\Ocart\Blog\Repositories\Interfaces\PostRepository::class);

        return $repo->getRelate($categoryId, $limit);
    }
}

if (!function_exists('get_post_category')) {
    function get_post_category($categoryId = 1) {
        $repo = app(CategoryRepository::class);
        $category = $repo->findByField('id', $categoryId)->first();
        return $category;
    }
}

if (!function_exists('get_post_category_children')) {
    function get_post_category_children($categoryId = 1) {
        $repo = app(CategoryRepository::class);
        $category_children = $repo->findByField('parent_id', $categoryId);
        return $category_children;
    }
}
