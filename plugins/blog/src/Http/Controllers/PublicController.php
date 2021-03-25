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
        $post = $this->repo->find($id);

        return Theme::scope('post',  compact('post'),'packages/blog::post');
    }

    /**
     * Danh muc bai viet
     * @return mixed
     */
    public function postCategory($id)
    {
        $category = $this->repoCategory->find($id);

        $posts = $this->repo->postForCategory($category->id);

        return Theme::scope('post-category',  compact('category', 'posts'),'packages/post::post-category');
    }
}