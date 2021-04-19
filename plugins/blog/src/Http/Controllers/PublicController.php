<?php

namespace Ocart\Blog\Http\Controllers;

use Ocart\Blog\Repositories\Interfaces\CategoryRepository;
use Ocart\Blog\Repositories\Interfaces\PostRepository;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Theme\Facades\Theme;

class PublicController extends BaseController
{

    /**
     * @var PostRepository
     */
    protected $repo;
    protected $repoCategory;

    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->repo = $postRepository;
        $this->repoCategory = $categoryRepository;
    }

    /**
     * Chi tiet bai viet
     * @return mixed
     */
    public function post($id)
    {
        $post = $this->repo->with('categories')->find($id);

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, POST_MODULE_SCREEN_NAME, $post);

        return Theme::scope('post',  compact('post'),'packages/blog::post');
    }

    /**
     * Danh muc bai viet
     * @return mixed
     */
    public function postCategory($id)
    {
        $category = $this->repoCategory->find($id);

        $posts = $this->repo->postForCategory($category->id, 9);

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, BLOG_CATEGORY_MODULE_SCREEN_NAME, $category);

        return Theme::scope('post-category',  compact('category', 'posts'),'packages/post::post-category');
    }
}